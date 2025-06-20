<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('index');
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
}
