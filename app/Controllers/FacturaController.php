<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel; // Asegúrate que el nombre de la clase sea DetalleFacturaModel
use App\Models\CarritoModel;   // Necesitarás el modelo de carrito
use App\Models\ProductosModel;

class FacturaController extends BaseController
{
    public function ver($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $facturaModel = new FacturaModel();

        // Traer la factura junto con el nombre del cliente
        $factura = $facturaModel
            ->select('factura.*, usuarios.nombre as nombre_cliente')
            ->join('usuarios', 'usuarios.id_usuario = factura.id_usuario')
            ->where('factura.id_factura', $id)
            ->first();

        if (!$factura) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Factura no encontrada.');
        }

        $usuarioActual = session()->get('id_usuario');
        if ($usuarioActual !== $factura['id_usuario']) {
            return redirect()->back()->with('error', 'No tienes accesso a esa factura');
        }

        $detalleModel = new DetalleFacturaModel();
        $detalles = $detalleModel
            ->select('detallefactura.*, productos.nombre as nombre_producto, productos.precio as precio_unitario')
            ->join('productos', 'productos.id_producto = detallefactura.id_producto')
            ->where('detallefactura.id_factura', $id)
            ->findAll();

        return view('factura', [
            'factura' => $factura,
            'detalles' => $detalles
        ]);
    }


    public function finalizarCompra()
    {
        $usuarioId = session()->get('id_usuario');

        $carritoModel = new CarritoModel();
        $facturaModel = new FacturaModel();
        $detalleFacturaModel = new DetalleFacturaModel();
        $productoModel = new ProductosModel();

        // 1. Traer los ítems del carrito
        $items = $carritoModel
            ->select('carrito.*, productos.precio as precio_unitario, productos.stock as stock_actual')
            ->join('productos', 'productos.id_producto = carrito.id_producto')
            ->where('carrito.id_usuario', $usuarioId)
            ->findAll();

        if (empty($items)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // 2. Validar stock disponible
        foreach ($items as $item) {
            if ($item['cantidad'] > $item['stock_actual']) {
                return redirect()->back()->with('error', "No hay suficiente stock para el producto ID {$item['id_producto']}. Stock disponible: {$item['stock_actual']}.");
            }
        }

        // 3. Calcular total
        $total = 0;
        foreach ($items as $item) {
            $total += $item['cantidad'] * $item['precio_unitario'];
        }

        // 4. Insertar la factura
        $idFactura = $facturaModel->insert([
            'id_usuario' => $usuarioId,
            'fecha_factura' => date('Y-m-d H:i:s'),
            'total' => $total,
        ]);

        // 5. Insertar los detalles y actualizar stock
        foreach ($items as $item) {
            $detalleFacturaModel->insert([
                'id_factura' => $idFactura,
                'id_producto' => $item['id_producto'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $item['cantidad'] * $item['precio_unitario'],
            ]);

            // Calcular el nuevo stock
            $nuevoStock = $item['stock_actual'] - $item['cantidad'];

            // Preparar los datos para actualizar el producto
            $datosActualizacion = ['stock' => $nuevoStock];

            // Si el nuevo stock es 0, desactivar el producto
            if ($nuevoStock <= 0) {
                $datosActualizacion['activo'] = 0;
            }

            // Actualizar el producto
            $productoModel->update($item['id_producto'], $datosActualizacion);
        }

        // 6. Vaciar el carrito del usuario
        $carritoModel->where('id_usuario', $usuarioId)->delete();

        // 7. Redirigir a la vista de la factura
        return redirect()->to('factura/ver/' . $idFactura);
    }
}
