<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 🏠 Default route → Redirect to login
$routes->get('/', 'Auth::login');

// 🔐 Authentication Routes (ADMIN)
$routes->get('login', 'Auth::login');
$routes->post('auth/verifyLogin', 'Auth::verifyLogin');
$routes->get('register', 'Auth::register');
$routes->post('auth/saveRegister', 'Auth::saveRegister');
$routes->get('logout', 'Auth::logout');

// 🔧 System Mode Toggle Route (Admin Only)
$routes->get('settings/toggleSystemMode', 'Settings::toggleSystemMode');
$routes->get('network/logs', 'Students::networkLogs'); 


// 🎓 Student Authentication Routes
$routes->get('student/login', 'StudentController::login');
$routes->post('student/loginSubmit', 'StudentController::loginSubmit');
$routes->get('student/register', 'StudentController::register');
$routes->post('student/registerSubmit', 'StudentController::registerSubmit');

// ✅ Student Bill Clearance (only allowed if system is ONLINE)
$routes->group('', ['filter' => 'maintenance'], function ($routes) {
    $routes->get('student_home', 'Students::billClearance');
    $routes->post('billing/markPaid', 'BillingController::markPaid');
});

// 🎓 Students CRUD Routes (Admin Only)
$routes->group('students', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Students::index');
    $routes->get('create', 'Students::create');
    $routes->post('store', 'Students::store');
    $routes->get('edit/(:num)', 'Students::edit/$1');
    $routes->post('update/(:num)', 'Students::update/$1');
    $routes->get('delete/(:num)', 'Students::delete/$1');
    $routes->get('print', 'Students::print');


});

// 🎉 Events Routes (Admin Only)
$routes->group('events', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Events::index');
    $routes->get('create', 'Events::create');
    $routes->post('store', 'Events::store');

});
