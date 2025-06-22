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

    public function dashboard()
    {
        if (!session()->get('logged_in') || session()->get('rol') != 1) {
            return redirect()->to('/');
        }

        $usuarioModel = new UsuariosModel();
        $facturaModel = new FacturaModel();

        // Capturamos el término de búsqueda (puede venir vacío o no estar)
        $busquedaFactura = $this->request->getGet('buscar_factura');

        // Base de la consulta de facturas
        $facturaQuery = $facturaModel
            ->select('factura.*, usuarios.nombre AS nombre_usuario')
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

        $facturas = $facturaQuery->findAll(5);

        // Datos para la vista
        $data = [
            'facturas' => $facturas,
            'busquedaFactura' => $busquedaFactura,

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
        return redirect()->to('admin/dashboard')->with('mensaje', 'Producto activado');
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
