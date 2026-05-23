<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'AuthController::login');
$routes->post('/login/authenticate', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/', 'Home::index');
$routes->get('/users', 'UserController::index');
$routes->get('/users/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');
$routes->get('/users/edit/(:num)', 'UserController::edit/$1');
$routes->post('/users/update/(:num)', 'UserController::update/$1');
$routes->post('/users/delete/(:num)', 'UserController::delete/$1');

$routes->get('/employees', 'EmployeeController::index');
$routes->get('/employees/create', 'EmployeeController::create');
$routes->post('/employees/store', 'EmployeeController::store');
$routes->get('/employees/edit/(:num)', 'EmployeeController::edit/$1');
$routes->post('/employees/update/(:num)', 'EmployeeController::update/$1');
$routes->post('/employees/delete/(:num)', 'EmployeeController::delete/$1');
