<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class ProductosController extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index()
    {
        $productoModel = new ProductosModel();

        $resultado = $productoModel->where('activo', 1)->findAll(); // devuelve cada uno de los productos de array

        // Puedes pasar los datos a la vista
        return view('catalogo', ['productos' => $resultado]);
    }

    public function agregar()
    {

        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');   
        }
        return view('head')
            . view('navbar')
            . view('agregarproducto');
    }

    public function nuevoproducto()
    {

        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $rules = [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'cantidad' => 'required',
            'categoria' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $imagen = $this->request->getFile('imagen');
        $rutaImagen = null;

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName(); // nombre aleatorio
            $imagen->move('public/uploads/productos/', $nombreImagen);
            $rutaImagen = 'public/uploads/productos/' . $nombreImagen;
        }

        // Guardá el producto
        $productoModel = new ProductosModel();

        $post = $this->request->getPost(['nombre', 'descripcion', 'precio', 'cantidad', 'categoria']);

        $productoModel->insert([
            'nombre' => trim($post['nombre']),
            'descripcion' => trim($post['descripcion']),
            'precio' => $post['precio'],
            'cantidad' => $post['cantidad'],
            'url_imagen' => $rutaImagen,
            'activo' => 1, // si usás un campo activo
            'categoria' => $post['categoria']
        ]);

        return redirect()->to('catalogo')->with('mensaje', 'Producto agregado con éxito');
    }


    public function eliminarProducto()
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $id = $this->request->getPost('id');

        $productoModel = new ProductosModel();
        $productoModel->delete($id);

        return redirect()->to('catalogo')->with('mensaje', 'Producto eliminado correctamente');
    }

    public function editarproducto($id = null)
    {

        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        if ($id == null) {
            return redirect()->to('catalogo');
        }

        $productoModel = new ProductosModel();

        $resultado['producto'] = $productoModel->find($id);

        return view('head')
            . view('navbar')
            . view('editarproducto', $resultado);
    }

    public function actualizarProducto($id = null)
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }
        $rules = [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'cantidad' => 'required',
            'categoria' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $imagen = $this->request->getFile('imagen');
        $rutaImagen = null;

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName(); // nombre aleatorio
            $imagen->move('public/uploads/productos/', $nombreImagen);
            $rutaImagen = 'public/uploads/productos/' . $nombreImagen;
        }

        // Guardá el producto
        $productoModel = new ProductosModel();
        $post = $this->request->getPost(['nombre', 'descripcion', 'precio', 'cantidad', 'categoria']);

        $productoModel->update($id, [
            'nombre' => trim($post['nombre']),
            'descripcion' => trim($post['descripcion']),
            'precio' => $post['precio'],
            'cantidad' => $post['cantidad'],
            'url_imagen' => $rutaImagen,
            'activo' => 1, // si usás un campo activo
            'categoria' => $post['categoria']
        ]);

        return redirect()->to('catalogo')->with('mensaje', 'Producto agregado con éxito');
    }

    public function ver($id)
    {
        $productoModel = new ProductosModel();
        $producto = $productoModel->find($id);

        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado");
        }

        return view('verproducto', ['producto' => $producto]);
    }
}
