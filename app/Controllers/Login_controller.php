<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PersonasModel;
use App\Models\UsuariosModel;

class Login_controller extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
    }

    public function auth()
    {
        $session = session(); // Iniciamos el objeto sesión
        $model = new UsuariosModel(); // Instanciamos el modelo

        $email = $this->request->getVar('email'); // Obtenemos el email desde el formulario
        $pass = $this->request->getVar('pass');   // Obtenemos el password desde el formulario

        $data = $model->where('email', $email)->first(); // Consulta a la tabla usuarios por email

        if ($data) { // Si se encontró un usuario con ese email
            $pass_verify = password_verify($pass, $data['pass']); // Verifica el password con hash

            if ($pass_verify) {
                // Si la contraseña es correcta, guardamos datos en la sesión
                $ses_data = [
                    'id'       => $data['id_usuario'],
                    'email'    => $data['email'],
                    'nombre'   => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'rol'      => $data['id_rol'],
                    'activo'   => $data['activo'],
                    'logged_in'    => true
                ];
                $session->set($ses_data); // Establece los datos en la sesión
                $session->setFlashdata('msg', '¡Bienvenido!'); // Mensaje de bienvenida
                return redirect()->to('/'); // Redirecciona a la página principal
            } else {
                $session->setFlashdata('msg', 'Contrasena incorrecta'); // Mensaje de error
                return redirect()->to('/login'); // Redirige al login
            }
        } else {
            // Si no encontró el usuario
            $session->setFlashdata('msg', 'No ingreso un email o el mismo es incorrecto');
            return redirect()->to('/login');
        }
    }
    public function logout() //cuandi cierra sesion
    {
       $session = session();
       $session->destroy();
       return redirect()->to('/');


    }

    public function store()
    {
        $personasModel = new PersonasModel();
        $usuariosModel = new UsuariosModel();

        // Validaciones básicas
        $validation = \Config\Services::validation();
        $validation->setRules([
            'dni'      => 'required|is_unique[personas.dni]',
            'nombre'   => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'email'    => 'required|valid_email|is_unique[usuarios.email]',
            'pass'     => 'required|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Guardar en personas
        $idPersona = $personasModel->insert([
            'dni'        => $this->request->getPost('dni'),
            'nombre'     => $this->request->getPost('nombre'),
            'apellido'   => $this->request->getPost('apellido'),
            'id_domicilio' => 1, // suponiendo domicilio fijo o crear formulario para eso
            'telefono'   => $this->request->getPost('telefono')
        ]);

        // Guardar en usuarios
        $usuariosModel->insert([
            'id_personas' => $idPersona,
            'id_rol'      => 2, // por defecto rol "usuario"
            'email'       => $this->request->getPost('email'),
            'pass'        => password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT),
            'activo'      => 1
        ]);

        return redirect()->to('/login')->with('msg', 'Registro exitoso. ¡Ahora inicia sesión!');
    }

}
