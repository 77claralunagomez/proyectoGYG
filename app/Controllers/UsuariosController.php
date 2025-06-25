<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;


class UsuariosController extends BaseController
{
    protected $helpers = ['form'];
    public function index(): string
    {
        return view('registrar');
    }

    public function crear(){
         //reglas
        $rules= [

           'nombre' => 'required|max_length[50]' ,
           'apellido' => 'required|max_length[50]' ,
           'domicilio' => 'required|max_length[255]',
           'email' => 'required|max_length[100]|valid_email|is_unique[usuarios.email]' ,
            'pass' => 'required|max_length[100]|min_length[5]',
            'repassword' => 'matches[pass]'
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $usuariosModel =  new UsuariosModel();
        $post = $this->request->getPost(['nombre','apellido','domicilio','email','pass',]);

        $usuariosModel->insert([
            'nombre' => $post['nombre'], 
            'apellido' => $post['apellido'], 
            'domicilio' => $post['domicilio'],
            'email' => $post['email'], 
            'pass' => password_hash($post['pass'], PASSWORD_DEFAULT),
            'rol' => 2,
            'activo' => 1
        ]);
        return redirect()->to('/');

    }
    public function dashboard()
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $usuarioModel = new UsuariosModel();
        $facturaModel = new FacturaModel();

        // Capturamos el término de búsqueda (puede venir vacío o no estar)
        $busquedaFactura = $this->request->getGet('buscar_factura');
        $busquedaUsuarios = $this->request->getGet('buscar_usuario');

        // Base de la consulta de facturas
        $facturaQuery = $facturaModel
            ->select('factura.*, usuarios.nombre')
            ->join('usuarios', 'usuarios.id_usuario = factura.id_usuario')
            ->orderBy('fecha_factura', 'DESC');

        if ($busquedaFactura !== null && $busquedaFactura !== '') {
            $facturaQuery
                ->groupStart()
                ->like('usuarios.nombre', $busquedaFactura)
                ->orLike('factura.fecha_factura', $busquedaFactura)
                ->orLike('factura.id_factura', $busquedaFactura)
                ->groupEnd();
        }

        $usuarioQuery = $usuarioModel
            ->select('usuarios.*')
            ->orderBy('id_usuario', 'DESC');

        if ($busquedaUsuarios !== null && $busquedaUsuarios !== '') {
            $usuarioQuery
                ->groupStart()
                ->like('usuarios.nombre', $busquedaUsuarios)
                ->orLike('usuarios.id_usuario', $busquedaUsuarios)
                ->orLike('usuarios.email', $busquedaUsuarios)
                ->groupEnd();
        }

        $facturas = $facturaQuery->findAll(15);
        $usuarios = $usuarioQuery->findAll(15);


        // Datos para la vista
        $data = [
            'facturas' => $facturas,
            'usuarios' => $usuarios,

            'busquedaFactura' => $busquedaFactura,
            'busquedaUsuarios' => $busquedaUsuarios,

            'totalUsuarios' => $usuarioModel->countAll(),
            'totalFacturas' => $facturaModel->countAll(),
            'totalVentas' => $facturaModel->selectSum('total')->first()['total'] ?? 0,

            'usuariosActivados' => $usuarioModel->where('activo', 1)->findAll(),
            'usuariosDesactivados' => $usuarioModel->where('activo', 0)->findAll()
        ];

        return view('admin/dashboard', $data);
    }


    public function eliminarUsuario()
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $id = $this->request->getPost('id_usuario');

        $UsuarioModel = new UsuariosModel();
        $UsuarioModel->update($id, ['activo' => 0]);
        return redirect()->to('admin/dashboard')->with('mensaje', 'Usuario Desactivado');
    }

    public function activarUsuario()
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $id = $this->request->getPost('id_usuario');

        $UsuarioModel = new UsuariosModel();
        $UsuarioModel->update($id, ['activo' => 1]);
        return redirect()->to('admin/dashboard')->with('mensaje', 'Usuario Activado');
    }

    public function verFactura($idFactura)
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $facturaModel = new FacturaModel();


        // Buscar factura con datos del usuario
        $factura = $facturaModel
            ->select('factura.*, usuarios.nombre AS nombre_usuario, usuarios.email')
            ->join('usuarios', 'usuarios.id_usuario = factura.id_usuario')
            ->where('factura.id_factura', $idFactura)
            ->first();


        // JOIN con productos para obtener nombre y precio
        $db = \Config\Database::connect();
        $builder = $db->table('detallefactura');
        $builder->select('detallefactura.*, productos.nombre AS nombre_producto, productos.precio');
        $builder->join('productos', 'productos.id_producto = detallefactura.id_producto');
        $builder->where('detallefactura.id_factura', $idFactura);
        $detalles = $builder->get()->getResultArray();

        $data = [
            'factura' => $factura,
            'detalles' => $detalles,
        ];

        return view('admin/verFactura', $data);
    }
}
