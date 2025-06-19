<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel; // Asegúrate que el nombre de la clase sea DetalleFacturaModel
use App\Models\CarritoModel;   // Necesitarás el modelo de carrito

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

        // 1. Traer los ítems del carrito
        $items = $carritoModel
            ->select('carrito.*, productos.precio as precio_unitario')
            ->join('productos', 'productos.id_producto = carrito.id_producto')
            ->where('carrito.id_usuario', $usuarioId)
            ->findAll();

        if (empty($items)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // 2. Calcular total
        $total = 0;
        foreach ($items as $item) {
            $total += $item['cantidad'] * $item['precio_unitario'];
        }

        // 3. Insertar la factura
        $idFactura = $facturaModel->insert([
            'id_usuario' => $usuarioId,
            'fecha_factura' => date('Y-m-d H:i:s'),
            'total' => $total,
        ]);

        // 4. Insertar los detalles
        foreach ($items as $item) {
            $detalleFacturaModel->insert([
                'id_factura' => $idFactura,
                'id_producto' => $item['id_producto'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $item['cantidad'] * $item['precio_unitario'],
            ]);

            // Opcional: Actualizar stock del producto aquí
        }

        // 5. Vaciar el carrito del usuario
        $carritoModel->where('id_usuario', $usuarioId)->delete();

        // 6. Redirigir a la vista de la factura
        return redirect()->to('factura/ver/' . $idFactura);
    }
}
