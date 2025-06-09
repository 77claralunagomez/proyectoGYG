<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('head');
        echo view('navbar');
        echo view('index');
        echo view('comercializacion');
        echo view('aboutUs');
        echo view('footer');
    }

    public function contacto(){
        echo view('head');
        echo view('navbar');
        echo view('contacto');
        echo view('footer');
    }
    public function comercializacion(){
        echo view('head');
        echo view('navbar');
        echo view('comercializacion');
        echo view('footer');

    }

    public function aboutUs(){
        echo view('head');
        echo view('navbar');
        echo view('aboutUs');
        echo view('footer');

    }

    public function terminos(){
        echo view('head');
        echo view('navbar');
        echo view('terminos');
        echo view('footer');

    }
}
