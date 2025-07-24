<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Inicio::index');
$routes->get('/usuario', 'Usuario::index');
$routes->get('/usuario/nuevo', 'Usuario::nuevo');
$routes->post('/usuario/guardar', 'Usuario::guardar');
$routes->get('/usuario/editar/(:num)', 'Usuario::editar/$1');
$routes->post('/usuario/actualizar/(:num)', 'Usuario::actualizar/$1');
$routes->get('/usuario/eliminar/(:num)', 'Usuario::eliminar/$1');

//$routes->get('usuarioadmin/crearadmin', 'UsuarioAdmin::crearAdmin');
$routes->get('/login', 'Auth::loginForm');

$routes->get('/logout', 'Auth::logout');
$routes->post('/login', 'Auth::validar');
// CANCHAS
// Mostrar listado de canchas
$routes->get('/cancha', 'Cancha::index');
$routes->get('/cancha/nuevo', 'Cancha::nuevo');
$routes->post('/cancha/guardar', 'Cancha::guardar');
$routes->get('/cancha/editar/(:num)', 'Cancha::editar/$1');
$routes->post('/cancha/actualizar/(:num)', 'Cancha::actualizar/$1');
$routes->get('/cancha/eliminar/(:num)', 'Cancha::eliminar/$1');

//HORARIOS 
$routes->get('/horario_disponible', 'HorarioDisponible::index');
$routes->get('/horario_disponible/nuevo', 'HorarioDisponible::nuevo');
$routes->post('/horario_disponible/guardar', 'HorarioDisponible::guardar');
$routes->get('/horario_disponible/editar/(:num)', 'HorarioDisponible::editar/$1');
$routes->post('/horario_disponible/actualizar/(:num)', 'HorarioDisponible::actualizar/$1');
$routes->get('/horario_disponible/eliminar/(:num)', 'HorarioDisponible::eliminar/$1');
//RESERVCAS
$routes->get('/reserva', 'Reserva::index');
$routes->get('/reserva/nuevo', 'Reserva::nuevo');
$routes->post('/reserva/guardar', 'Reserva::guardar');
$routes->get('/reserva/editar/(:num)', 'Reserva::editar/$1');
$routes->post('/reserva/actualizar/(:num)', 'Reserva::actualizar/$1');
$routes->get('/reserva/eliminar/(:num)', 'Reserva::eliminar/$1');
$routes->get('/dashboard', 'Dashboard::index');


//PAGO
$routes->get('/pago', 'Pago::index');
$routes->get('/pago/nuevo', 'Pago::nuevo');
$routes->post('/pago/guardar', 'Pago::guardar');
$routes->get('/pago/editar/(:num)', 'Pago::editar/$1');
$routes->post('/pago/actualizar/(:num)', 'Pago::actualizar/$1');
$routes->get('/pago/eliminar/(:num)', 'Pago::eliminar/$1');

//INCIDENCIAS
$routes->get('/incidencia', 'Incidencia::index');
$routes->get('/incidencia/nuevo', 'Incidencia::nuevo');
$routes->post('/incidencia/guardar', 'Incidencia::guardar');
$routes->get('/incidencia/editar/(:num)', 'Incidencia::editar/$1');
$routes->post('/incidencia/actualizar/(:num)', 'Incidencia::actualizar/$1');
$routes->get('/incidencia/eliminar/(:num)', 'Incidencia::eliminar/$1');







