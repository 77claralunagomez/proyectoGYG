<?php

namespace App\Controllers;
 
use App\Models\UsuariosModel;

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

           'nombre' => 'required|max_length[50]' ,
           'apellido' => 'required|max_length[50]' ,
           'domicilio' => 'required|max_length[255]' ,
           'email' => 'required|max_length[100]|valid_email|is_unique[usuarios.email]' ,
            'pass' => 'required|max_length[100]|min_length[5]',
            'repassword' => 'matches[pass]'
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $usuariosModel =  new UsuariosModel();
        $post = $this->request->getPost(['nombre','apellido', 'domicilio', 'email','pass',]);

        $usuariosModel->insert([
            'nombre' => $post['nombre'], 
            'apellido' => $post['apellido'], 
            'domicilio' => $post['domicilio'], 
            'email' => $post['email'], 
            'pass' => password_hash($post['pass'], PASSWORD_DEFAULT),
            'rol' => 2,
            'activo' => 1
        ]);
        return redirect()->to(base_url('iniciarsesion'));
    }

}