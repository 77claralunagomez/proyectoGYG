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
$routes->get('/dashboard','Dashboard::index',['filter'=>'auth']);
/*Rutas para el login */
$routes->get('/login', 'Home::login');
$routes->get('/enviarlogin', 'Login_controller::auth');
$routes->get('/panel', 'Panel_controller::index', ['filter'=> 'auth']);
$routes->get('/logout', 'Login_controller::logout');

/*Registrar */
$routes->get('/register', 'Home::register');
$routes->post('/store', 'Login_controller::store');

