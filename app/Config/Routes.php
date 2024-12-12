<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    return view('home');
});

$routes->get('admin', function () {
    return view('admin/portal');
});
$routes->get('reservation/list', 'ReservationController::index');

$routes->get('reservation/create', 'ReservationController::create');
$routes->post('reservation/create', 'ReservationController::create');
$routes->get('reservation/delete/(:segment)', 'ReservationController::delete/$1');

$routes->get('reservation', 'ReservationController::index');
$routes->get('reservation/update/(:segment)', 'ReservationController::update/$1');
$routes->get('reservation/delete/(:segment)', 'ReservationController::delete/$1');
$routes->get('reservation/form', function () {
    return view('reservation/form');
});

$routes->get('admin/register', 'AdminController::register');
$routes->post('admin/register', 'AdminController::createAdmin');
$routes->get('admin/login', 'AdminController::login');
$routes->post('admin/login', 'AdminController::authenticate');
$routes->get('admin/logout', 'AdminController::logout');

$routes->get('admin/dashboard', 'AdminController::dashboard');

$routes->get('admin/users', 'AdminController::users');
$routes->get('admin/users/delete/(:segment)', 'AdminController::deleteUser/$1');

$routes->get('admin/content', 'AdminController::content');
$routes->post('admin/content/update', 'AdminController::updateContent');

$routes->group('admin', ['filter' => 'authCheck'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users', 'AdminController::users');
    $routes->get('content', 'AdminController::content');
});
$routes->get('login', function() {
    return redirect()->to('/admin/login');
});
