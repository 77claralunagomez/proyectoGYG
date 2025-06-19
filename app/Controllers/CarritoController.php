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
      $cart = \Config\Services::cart();
      $productoModel = new ProductosModel();
      $producto = $productoModel->find($productoId);

      $cantidad = (int)$this->request->getPost('cantidad');

      if ($cantidad < 1) {
         return redirect()->back()->with('errors', 'Cantidad invalida');
      }

      if ($cantidad > $producto['cantidad']) {
         return redirect()->back()->with('errors', 'No hay suficiente stock');
      }

      if (!session()->get('logged_in')) {
         $existe = false;

         foreach ($cart->contents() as $item) {
            if ($item['id'] == $productoId) {
               $nuevaCantidad = $item['qty'] + $cantidad;

               if ($nuevaCantidad > $producto['cantidad']) {
                  return redirect()->back()->with('errors', 'No se puede agregar más productos, superó el stock disponible');
               }

               $cart->update([
                  'rowid' => $item['rowid'],
                  'qty'   => $nuevaCantidad
               ]);
               $existe = true;
               break;
            }
         }

         if (!$existe) {
            if ($cantidad > $producto['cantidad']) {
               return redirect()->back()->with('errors', 'No hay suficiente stock para agregar ese producto');
            }

            $cart->insert([
               'id'    => $producto['id_producto'],
               'qty'   => $cantidad,
               'price' => $producto['precio'],
               'name'  => $producto['nombre'],
            ]);
         }
      } else {
         // Usuario logueado → usar base de datos
         $carritoModel = new CarritoModel();
         $usuarioId = session()->get('id_usuario');

         // Verificar si ya está el producto en el carrito del usuario
         $existente = $carritoModel
            ->where('id_usuario', $usuarioId)
            ->where('id_producto', $productoId)
            ->first();

         if ($existente) {

            $existente['cantidad'] += $cantidad;
            // Actualizar cantidad
            if ($existente['cantidad'] > $producto['cantidad']) {
               return redirect()->back()->with('errors', 'No se pued agregar mas productos, supero el stock ');
            }

            // Ya que no hay campo 'precio_unitario' ni 'subtotal', no los usamos
            $carritoModel->save($existente);
         } else {
            // Insertar nuevo solo con los campos válidos
            $carritoModel->insert([
               'id_usuario'  => $usuarioId,
               'id_producto' => $producto['id_producto'],
               'cantidad'    => $cantidad
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

   public function verCarrito()
   {
      $items = [];

      if (!session()->get('logged_in')) {
         // Usuario NO logueado → obtener del carrito en sesión
         $cart = \Config\Services::cart();
         $items = $cart->contents();
      } else {
         // Usuario logueado → obtener desde DB
         $carritoModel = new CarritoModel();
         $productoModel = new ProductosModel();
         $usuarioId = session()->get('id_usuario');

         // Traer los items del carrito (solo contiene id_producto y cantidad)
         $carrito = $carritoModel->where('id_usuario', $usuarioId)->findAll();

         foreach ($carrito as $item) {
            // Obtener el producto asociado
            $producto = $productoModel->find($item['id_producto']);

            if ($producto) {
               $items[] = [
                  'id'    => $producto['id_producto'],
                  'name'  => $producto['nombre'],
                  'price' => $producto['precio'],
                  'qty'   => $item['cantidad'],
               ];
            }
         }
      }

      return view('carrito', ['items' => $items]);
   }

   public function eliminarDelCarrito($productoId)
   {
      if (!session()->get('logged_in')) {
         $cart = \Config\Services::cart();

         // Recorremos los items del carrito
         foreach ($cart->contents() as $item) {
            if ($item['id'] == $productoId) {
               $cart->remove($item['rowid']); // eliminamos el correcto
               break;
            }
         }

         return redirect()->to('/carrito')->with('success', 'Producto eliminado del carrito');
      }
   }
}
