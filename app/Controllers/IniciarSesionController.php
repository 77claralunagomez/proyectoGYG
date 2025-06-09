<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class IniciarSesionController extends BaseController
{
    public function index()
    {
        return view('iniciarsesion');
    }

    public function autenticar()
    {
        $rules = [
            'email' => 'required',
            'pass' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $userModel = new UsuariosModel();
        $post = $this->request->getPost(['email', 'pass']);

        $usuario = $userModel->validarUsuario($post['email'], $post['pass']);

        if ($usuario !== null) {
            $this->setSession($usuario);
            return redirect()->to(base_url());
        }

        return redirect()->back()->withInput()->with('errors', 'El usuario y/o contrasena son incorrectos.');
    }

    private function setSession($userData)
    {
        $data = [
            'logged_in' => true,
            'email' => $userData['email'],
            'nombre' => $userData['nombre']
        ];
        $this->session->set($data);
    }

    public function cerrarSesion()
    {
        if ($this->session->get('logged_in')) {
            $this->session->destroy();
        }
        return redirect()->to(base_url()); // Redirige al inicio u otra página
    }
}
