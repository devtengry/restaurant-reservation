<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home/testURL', 'Home::testURL');
$routes->get('reservation/create', 'ReservationController::create');
$routes->get('reservation', 'ReservationController::index');
$routes->get('reservation/update/(:segment)', 'ReservationController::update/$1');
$routes->get('reservation/delete/(:segment)', 'ReservationController::delete/$1');
$routes->get('reservation/form', function () {
    echo view('reservation_form');
});
$routes->post('reservation/create', 'ReservationController::create');
