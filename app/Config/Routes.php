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
/*Catalogo */
$routes->get('catalogo', 'ProductosController::index');
$routes->get('agregarproducto', 'ProductosController::agregar');
$routes->post('nuevoproducto', 'ProductosController::nuevoproducto');
$routes->post('eliminarProducto', 'ProductosController::eliminarProducto');
$routes->get('producto/(:num)', 'ProductosController::ver/$1');

/*Pedido */
$routes->get('carrito', 'PedidoController::verCarrito');
$routes->post('carrito/agregar/(:num)', 'PedidoController::agregarAlCarrito/$1');

$routes->get('editarproducto/(:num)', 'ProductosController::editarproducto/$1');
$routes->post('editarproducto/(:num)', 'ProductosController::actualizarProducto/$1');


/*registrarse */
$routes->get('registrar', 'UsuariosController::index');
$routes->post('registrar', 'UsuariosController::crear');

/* Inicio de sesion */
$routes->get('iniciarsesion', 'IniciarSesionController::index'); // Ajusta según tu controlador de login
$routes->post('autenticar', 'IniciarSesionController::autenticar'); 
$routes->get('cerrarSesion', 'IniciarSesionController::cerrarSesion');
