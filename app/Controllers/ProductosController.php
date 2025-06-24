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
        return view('agregarproducto');
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
            'stock' => 'required',
            'categoria' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $imagen = $this->request->getFile('imagen');
        $rutaImagen = null;

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getClientName();
            $imagen->move('public/uploads/productos/', $nombreImagen);
            $rutaImagen = 'public/uploads/productos/' . $nombreImagen;
        }

        // Guardá el producto
        $productoModel = new ProductosModel();

        $post = $this->request->getPost(['nombre', 'descripcion', 'precio', 'stock', 'categoria']);

        $productoModel->insert([
            'nombre' => trim($post['nombre']),
            'descripcion' => trim($post['descripcion']),
            'precio' => $post['precio'],
            'stock' => $post['stock'],
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

        return view('editarproducto', $resultado);
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
            'stock' => 'required',
            'categoria' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $imagen = $this->request->getFile('imagen');
        $rutaImagen = $this->request->getPost('imagen_actual'); // Se usa por defecto

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            // lógica para guardar imagen nueva si fue subida
            $nombreOriginal = $imagen->getName();
            $hashSubida = md5_file($imagen->getTempName());
            $directorio = 'public/uploads/productos/';
            $rutaCompletaDestino = $directorio . $nombreOriginal;

            $imagenYaExiste = false;

            if (file_exists($rutaCompletaDestino)) {
                $hashExistente = md5_file($rutaCompletaDestino);
                if ($hashExistente === $hashSubida) {
                    $imagenYaExiste = true;
                } else {
                    $nombreSinExtension = pathinfo($nombreOriginal, PATHINFO_FILENAME);
                    $extension = $imagen->getClientExtension();
                    $nombreOriginal = $nombreSinExtension . '_' . time() . '.' . $extension;
                    $rutaCompletaDestino = $directorio . $nombreOriginal;
                }
            }

            if (!$imagenYaExiste) {
                $imagen->move($directorio, $nombreOriginal);
            }

            $rutaImagen = $rutaCompletaDestino;
        }


        // Guardá el producto
        $productoModel = new ProductosModel();
        $post = $this->request->getPost(['nombre', 'descripcion', 'precio', 'stock', 'categoria']);

        $productoModel->update($id, [
            'nombre' => trim($post['nombre']),
            'descripcion' => trim($post['descripcion']),
            'precio' => $post['precio'],
            'stock' => $post['stock'],
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

    public function verDesactivados()
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $productoModel = new ProductosModel();

        $resultado = $productoModel->where('activo', 0)->findAll(); // devuelve cada uno de los productos de array
        // Puedes pasar los datos a la vista
        return view('productos-desactivados', ['productos' => $resultado]);
    }

    public function desactivarProducto()
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $id = $this->request->getPost('id');

        $productoModel = new ProductosModel();
        $productoModel->update($id, ['activo' => 0]);
        return redirect()->to('catalogo')->with('mensaje', 'Producto eliminado correctamente');
    }

    public function activarProducto()
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $id = $this->request->getPost('id');

        $productoModel = new ProductosModel();
        $productoModel->update($id, ['activo' => 1]);
        return redirect()->to('productos-desactivados')->with('mensaje', 'Producto activado');
    }

    
}
