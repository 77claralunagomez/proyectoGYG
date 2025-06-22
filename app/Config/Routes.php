<?php

use App\Controllers\IniciarSesionController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('contacto', 'Home::contacto');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('aboutUs', 'Home::aboutUs');
$routes->get('terminos', 'Home::terminos');
$routes->get('empresa', 'Home::empresa');
$routes->get('legales', 'Home::legales');
$routes->get('ayuda', 'Home::ayuda');
$routes->get('atencion', 'Home::atencion');



/*Catalogo */
$routes->get('catalogo', 'ProductosController::index');
$routes->get('agregarproducto', 'ProductosController::agregar');
$routes->get('productos-desactivados', 'ProductosController::verDesactivados');
$routes->post('activarProducto', 'ProductosController::activarProducto');
$routes->post('desactivarProducto', 'ProductosController::desactivarProducto');
$routes->post('nuevoproducto', 'ProductosController::nuevoproducto');
$routes->post('eliminarProducto', 'ProductosController::eliminarProducto');
$routes->get('producto/(:num)', 'ProductosController::ver/$1');
$routes->get('editarproducto/(:num)', 'ProductosController::editarproducto/$1');
$routes->post('editarproducto/(:num)', 'ProductosController::actualizarProducto/$1');

/*Carrito */
$routes->get('carrito', 'CarritoController::verCarrito');
$routes->post('agregarAlCarrito/(:num)', 'CarritoController::agregarAlCarrito/$1');
$routes->post('eliminarDelCarrito/(:num)', 'CarritoController::eliminarDelCarrito/$1');

/* factura */
$routes->get('factura/ver/(:num)', 'FacturaController::ver/$1');
$routes->get('finalizarCompra', 'FacturaController::finalizarCompra');


/*registrarse */
$routes->get('registrar', 'UsuariosController::index');
$routes->post('registrar', 'UsuariosController::crear');


/* Inicio de sesion */
$routes->get('iniciarsesion', 'IniciarSesionController::index');
$routes->post('autenticar', 'IniciarSesionController::autenticar'); 
$routes->get('cerrarSesion', 'IniciarSesionController::cerrarSesion');

/* Usuarios */
$routes->get('admin/dashboard', 'UsuariosController::dashboard');
$routes->post('admin/usuario/eliminar', 'UsuariosController::eliminarUsuario');
$routes->get('admin/factura/(:num)', 'UsuariosController::verFactura/$1');



