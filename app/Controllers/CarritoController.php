<?php

namespace App\Controllers;

use App\Models\PedidoModel;
use App\Models\ProductosModel;
use App\Models\CarritoModel;

class CarritoController extends BaseController
{

   public function __construct()
   {
    helper(['form', 'url', 'cart']);
    $cart = \Config\Services::cart();
    $session = session();
   }

   /*public function agregarAlCarrito(){
      $cart = \Config\Services::cart();
      $request = \Config\Services::request();

      $cart->insert(array(
         'id_producto' => $request->getPost('id_producto'),
         'qty' => 1,
         'nombre' => $request->getPost('nombre'),
         'precio' => $request->getPost('precio'),
         'url_imagen' => $request->getPost('url_imagen'),
         'categoria' => $request->getPost('categoria'),
      ));
      return redirect()->back()->withInput();
   }*/

   public function agregarAlCarrito($productoId)
   {
      $productoModel = new ProductosModel();
      $producto = $productoModel->find($productoId);

      if (!$producto) {
         return redirect()->back()->with('error', 'Producto no encontrado.');
      }

      if (!session()->get('logged_in')) {
         // Usuario no logueado → usar sesión
         $cart = \Config\Services::cart();
         $cart->insert([
            'id'      => $producto['id_producto'],
            'qty'     => $producto['cantidad'],
            'price'   => $producto['precio'],
            'name'    => $producto['nombre'],
         ]);
      } else {
         // Usuario logueado → usar base de datos
         $carritoModel = new CarritoModel();
         $usuarioId = session()->get('id_usuario');

         // Verificar si ya está el producto en el carrito del usuario
         $existente = $carritoModel
            ->where('id_usuario', $usuarioId)
            ->where('producto_id', $productoId)
            ->first();

         if ($existente) {
            // Actualizar cantidad
            $existente['cantidad'] += 1;
            $existente['subtotal'] = $existente['cantidad'] * $existente['precio_unitario'];
            $carritoModel->save($existente);
         } else {
            // Insertar nuevo
            $carritoModel->insert([
               'id_usuario'      => $usuarioId,
               'producto_id'     => $producto['id'],
               'nombre'          => $producto['nombre'],
               'cantidad'        => 1,
               'precio_unitario' => $producto['precio'],
               'subtotal'        => $producto['precio'],
            ]);
         }
      }

      return redirect()->to('/carrito')->with('success', 'Producto agregado al carrito');
   }


   public function actualizarCarrito()
   {

      $cart = \Config\Services::cart();
      $request = \Config\Services::request();

      $cart->update(array(
         'id_producto' => $request->getPost('id_producto'),
         'qty' => 1,
         'nombre' => $request->getPost('nombre'),
         'precio' => $request->getPost('precio'),
         'url_imagen' => $request->getPost('url_imagen'),
         'categoria' => $request->getPost('categoria'),
      ));
      return redirect()->back()->withInput();
   }

   public function verCarrito() {
      if (session()->get('logged_in')) {
        // Usuario logueado → obtener carrito desde la base de datos
        $carritoModel = new \App\Models\CarritoModel();
        $usuarioId = session()->get('id_usuario');
        $items = $carritoModel->where('id_usuario', $usuarioId)->findAll();
    } else {
        // Usuario no logueado → obtener carrito desde la sesión
        $cart = \Config\Services::cart();
        $items = $cart->contents();
    }

    return view('carrito', ['items' => $items]);
   }
}
