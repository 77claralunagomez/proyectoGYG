<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
{
    $productosModel = new \App\Models\ProductosModel();
    $data['productos'] = $productosModel->findAll(); // o un subset como productos destacados
    return view('index', $data);
}

    public function contacto()
    {
        return view('contacto');
    }
    public function comercializacion()
    {
        return view('comercializacion');
    }

    public function aboutUs()
    { 
        return view('aboutUs');
    }

    public function terminos()
    {
        return view('terminos');
    }
    public function empresa()
    {
        return view('empresa');
    }

    public function legales()
    {
        return view('legales');
    }

    public function ayuda()
    {
        return view('ayuda');
    }

    public function atencion()
    {
        return view('atencion');
    }
}
