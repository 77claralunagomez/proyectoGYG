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

    public function agregar(){
        
        return view('head')
            . view('navbar')
            . view('agregarproducto')
            . view('footer');
    }

    public function nuevoproducto(){
     
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

        $productoModel->insert([
            'id_categoria' => $this->request->getPost('categoria'),
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'cantidad' => $this->request->getPost('cantidad'),
            'url_imagen' => $rutaImagen,
            'activo' => 1 // si usás un campo activo
        ]);

        return redirect()->to('catalogo')->with('mensaje', 'Producto agregado con éxito');

    }

    public function eliminarProducto()
    {
        $id = $this->request->getPost('id');

        $productoModel = new ProductosModel();
        $productoModel->delete($id);

        return redirect()->to('catalogo')->with('mensaje', 'Producto eliminado correctamente');
    }

    public function editarproducto($id = null) {
       
       //if($id == null){}
        $productoModel = new ProductosModel();
        $resultado = $productoModel->where('activo', 1)->findAll();
         return view('head')
            . view('navbar')
            . view('editarproducto',$resultado)
            . view('footer');

    }

}
