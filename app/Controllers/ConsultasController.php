<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\ConsultasModel;

class ConsultasController extends BaseController
{
    public function index()
    {
        return view('contacto');
    }

    public function enviar()
    {
        log_message('debug', 'Método de la petición: ' . $this->request->getMethod());
        if ($this->request->getMethod() === 'POST') {
            $consultaModel = new ConsultasModel();

            if (session()->get('logged_in')) {
                // Buscar datos del usuario en la base por ID
                $idUsuario = session()->get('id_usuario');

                $usuarioModel = new UsuariosModel();
                $usuario = $usuarioModel->find($idUsuario);

                if ($usuario) {
                    $data = [
                        'id_usuario' => $idUsuario,
                        'nombre'     => $usuario['nombre'],
                        'apellido'   => $usuario['apellido'],
                        'email'      => $usuario['email'],
                        'mensaje'    => $this->request->getPost('mensaje'),
                        'activo'     => 1
                    ];

                    $consultaModel->insert($data);
                    return redirect()->back()->with('mensaje', 'Consulta enviada correctamente.');
                } else {
                    return redirect()->back()->with('mensaje', 'Error al obtener tus datos.');
                }
            } else {
                // Usuario no logueado
                $data = [
                    'id_usuario' => null,
                    'nombre'     => $this->request->getPost('nombre'),
                    'apellido'   => $this->request->getPost('apellido'),
                    'email'      => $this->request->getPost('email'),
                    'mensaje'    => $this->request->getPost('mensaje'),
                    'activo'     => 1
                ];

                $consultaModel->insert($data);
                return redirect()->back()->with('mensaje', 'Consulta enviada correctamente.');
            }
        }

        return redirect()->to('/');
    }

    public function verConsultas()
    {
        
    }
}
