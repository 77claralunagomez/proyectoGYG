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

      $cantidadSolicitada = (int)$this->request->getPost('stock'); // stock enviado por el form

      // Validaciones básicas
      if ($cantidadSolicitada < 1) {
         return redirect()->back()->with('errors', 'Cantidad inválida.');
      }

      if ($cantidadSolicitada > $producto['stock']) {
         return redirect()->back()->with('errors', 'No hay suficiente stock disponible.');
      }

      // Usuario NO logueado → carrito de sesión
      if (!session()->get('logged_in')) {
         $existe = false;

         foreach ($cart->contents() as $item) {
            if ($item['id'] == $productoId) {
               $nuevaCantidad = $item['qty'] + $cantidadSolicitada;

               if ($nuevaCantidad > $producto['stock']) {
                  return redirect()->back()->with('errors', 'No se puede agregar más productos. Stock insuficiente.');
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
            $cart->insert([
               'id'    => $producto['id_producto'],
               'qty'   => $cantidadSolicitada,
               'price' => $producto['precio'],
               'name'  => $producto['nombre'],
            ]);
         }
      }
      // Usuario logueado → guardar en BD
      else {
         $carritoModel = new CarritoModel();
         $usuarioId = session()->get('id_usuario');

         $existente = $carritoModel
            ->where('id_usuario', $usuarioId)
            ->where('id_producto', $productoId)
            ->select('id_carrito, cantidad') // Seleccionamos el ID del registro y la cantidad actual
            ->first();

         if ($existente) {
            $nuevaCantidad = $existente['cantidad'] + $cantidadSolicitada;

            if ($nuevaCantidad > $producto['stock']) {
               return redirect()->back()->with('errors', 'No se puede agregar más productos. Stock insuficiente.');
            }

            $carritoModel->update($existente['id_carrito'], [
               'cantidad' => $nuevaCantidad
            ]);
         } else {
            $carritoModel->insert([
               'id_usuario'  => $usuarioId,
               'id_producto' => $producto['id_producto'],
               'cantidad'    => $cantidadSolicitada
            ]);
         }
      }

      return redirect()->to('/carrito')->with('success', 'Producto agregado al carrito.');
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
      } else {
         $carritoModel = new CarritoModel();
         $usuarioId = session()->get('id_usuario');

         $carritoModel
            ->where('id_usuario', $usuarioId)
            ->where('id_producto', $productoId)
            ->delete();

         return redirect()->to('/carrito')->with('success', 'Producto eliminado del carrito');
      }
   }
}
