<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class ProductosController extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        $productoModel = new ProductosModel();

        $resultado = $productoModel->where('activo', 1)->findAll(); // devuelve cada uno de los productos de array

        // Puedes pasar los datos a la vista
        return view('head')
            . view('navbar')
            . view('catalogo', ['productos' => $resultado])
            . view('footer');
    }

    public function agregar(){
        
        return view('head')
            . view('navbar')
            . view('agregarproducto');
    }

    public function nuevoproducto(){
     
        reglas = [

        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'url_imagen',
        'categoria'
        ]


    }

    public function create(){

    }
}
