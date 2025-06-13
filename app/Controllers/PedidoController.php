<?php

namespace App\Controllers;
 
use App\Models\PedidoModel;
use App\Models\ProductosModel;
use App\Models\CarritoModel;

class PedidoController extends BaseController
{
    protected $helpers = ['form'];

    public function verCarrito()
{
    $usuarioId = session()->get('id_usuario');

    if (!$usuarioId) {
        return redirect()->to('iniciarsesion')->with('error', 'Debés iniciar sesión.');
    }

    $carritoModel = new CarritoModel();
    $productoModel = new ProductosModel();

    $items = $carritoModel->where('id_usuario', $usuarioId)->findAll();

    $carrito = [];
    foreach ($items as $item) {
        $producto = $productoModel->find($item['id_producto']);
        if ($producto) {
            $producto['cantidad'] = $item['cantidad'];
            $carrito[] = $producto;
        }
    }

    return view('carrito', ['carrito' => $carrito]);
}


    public function agregarAlCarrito($idProducto)
{
    $cantidad = (int) $this->request->getPost('cantidad');
    if ($cantidad < 1) {
        return redirect()->back()->with('error', 'Cantidad inválida.');
    }

    $usuarioId = session()->get('id_usuario');

    if (!$usuarioId) {
        return redirect()->to('iniciarsesion')->with('error', 'Debés iniciar sesión.');
    }


    $productoModel = new ProductosModel();
    $carritoModel = new CarritoModel();

    $producto = $productoModel->find($idProducto);
    if (!$producto) {
        return redirect()->back()->with('error', 'Producto no encontrado.');
    }

    // Verificamos si el producto ya está en el carrito
    $existe = $carritoModel->where('id_usuario', $usuarioId)
                           ->where('id_producto', $idProducto)
                           ->first();

    if ($existe) {
        // Si ya está, actualizamos la cantidad
        $carritoModel->update($existe['id_carrito'], [
            'cantidad' => $existe['cantidad'] + $cantidad
        ]);
    } else {
        // Si no está, lo insertamos
        $carritoModel->insert([
            'id_usuario'  => $usuarioId,
            'id_producto' => $idProducto,
            'cantidad'    => $cantidad
        ]);
    }

    return redirect()->back()->with('success', 'Producto agregado al carrito.');
}


    public function comprarAhora($idProducto = null, $cantidad = null)
{
    $productosModel = new ProductosModel();
    $pedidoModel = new PedidoModel();
    $detalleModel = new DetalleFacturaModel();

    $usuarioId = session()->get('id_usuario');
 // asumimos que el usuario está logueado

    // 1. Si vienen productos desde el carrito
    $carrito = session()->get('carrito');

    if (!$carrito || empty($carrito)) {
        return redirect()->back()->with('error', 'No hay productos en el carrito.');
    }

    // 2. Calcular total
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // 3. Crear el pedido
    $pedidoData = [
        'id_usuario'      => $usuarioId,
        'fecha_pedido'    => date('Y-m-d'),
        'total'           => $total,
        'estado_pedido'   => 'pendiente',
        'direccion_envio' => 'Dirección genérica',
        'metodo_pago'     => 'efectivo',
    ];

    $idPedido = $pedidoModel->insert($pedidoData); // devuelve el ID insertado

    // 4. Insertar cada detalle
    foreach ($carrito as $item) {
        $detalleModel->insert([
            'id_pedido'    => $idPedido,
            'id_producto'  => $item['id_producto'],
            'cantidad'     => $item['cantidad'],
            'precio_unitario' => $item['precio'],
            'subtotal'     => $item['precio'] * $item['cantidad'],
        ]);
    }

    // 5. Limpiar el carrito
    session()->remove('carrito');

    return redirect()->to(base_url('carrito'))->with('success', 'Compra realizada con éxito.');
}


}