<?php

namespace App\Controllers;

class UsuariosController extends BaseController
{
    protected $helpers = ['form'];
    public function index():string
    {
     return view('registrar');

    }

    public function crear(){
         //reglas
        $rules= [
           'email' => 'required|max_length[100]|valid_email|is_unique[usuarios.email]' ,
            'pass' => 'required|max_length[100]|min_length[5]',
            'repassword' => 'matches[pass]'
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
    }
}