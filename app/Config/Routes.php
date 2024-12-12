<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home page route
$routes->get('/', function () {
    return view('home'); // Loads 'Views/home.php'
});

// Admin portal route
$routes->get('admin', function () {
    return view('admin/portal'); // Loads 'Views/admin/portal.php'
});

// Reservation-related routes
$routes->get('reservation/create', 'ReservationController::create'); // Show create form
$routes->post('reservation/create', 'ReservationController::create'); // Handle create form submission
$routes->get('reservation', 'ReservationController::index'); // List all reservations
$routes->get('reservation/update/(:segment)', 'ReservationController::update/$1'); // Update a reservation
$routes->get('reservation/delete/(:segment)', 'ReservationController::delete/$1'); // Delete a reservation
$routes->get('reservation/form', function () {
    return view('reservation/form'); // Loads 'Views/reservation/form.php'
});
$routes->get('reservation/list', 'ReservationController::index'); // List reservations again for consistency

// Admin authentication routes
$routes->get('admin/register', 'AdminController::register'); // Display register form
$routes->post('admin/register', 'AdminController::createAdmin'); // Handle register form submission
$routes->get('admin/login', 'AdminController::login'); // Display login form
$routes->post('admin/login', 'AdminController::authenticate'); // Handle login form submission
$routes->get('admin/logout', 'AdminController::logout'); // Logout the admin

// Admin dashboard routes
$routes->get('admin/dashboard', 'AdminController::dashboard'); // Admin dashboard view

// Admin user management routes
$routes->get('admin/users', 'AdminController::users'); // List admin users
$routes->get('admin/users/delete/(:segment)', 'AdminController::deleteUser/$1'); // Delete a user

// Admin content management routes
$routes->get('admin/content', 'AdminController::content'); // Show site content
$routes->post('admin/content/update', 'AdminController::updateContent'); // Update site content

// Grouped admin routes with 'authCheck' filter
$routes->group('admin', ['filter' => 'authCheck'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard'); // Authenticated access to dashboard
    $routes->get('users', 'AdminController::users'); // Authenticated access to user management
    $routes->get('content', 'AdminController::content'); // Authenticated access to content management
});
$routes->get('login', function() {
    return redirect()->to('/admin/login'); // Kullanıcıyı admin login sayfasına yönlendir
});
