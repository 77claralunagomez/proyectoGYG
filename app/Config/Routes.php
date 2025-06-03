<?php

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
$routes->get('registrar', 'UsuariosController::index');
$routes->post('registrar', 'UsuariosController::crear');
$routes->get('login', 'LoginController::index'); // Ajusta según tu controlador de login
/*Rutas para el login */
