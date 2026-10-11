<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Authentication routes
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Protected management routes
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Product pages
    $routes->get('/', 'Products::index');
    $routes->get('products', 'Products::index');

    $routes->get('products/new', 'Products::newProduct');
    $routes->post('products/create', 'Products::create');

    $routes->get('products/edit/(:num)', 'Products::edit/$1');
    $routes->post('products/update/(:num)', 'Products::update/$1');
    $routes->post('products/delete/(:num)', 'Products::delete/$1');

    // Customer pages
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/new', 'Customers::newCustomer');
    $routes->post('customers/create', 'Customers::create');

    $routes->get('customers/edit/(:num)', 'Customers::edit/$1');
    $routes->post('customers/update/(:num)', 'Customers::update/$1');
    $routes->post('customers/delete/(:num)', 'Customers::delete/$1');

    // Staff/user pages
    $routes->get('users', 'Users::index');
    $routes->get('users/new', 'Users::newUser');
    $routes->post('users/create', 'Users::create');

    $routes->get('users/edit/(:num)', 'Users::edit/$1');
    $routes->post('users/update/(:num)', 'Users::update/$1');
    $routes->post('users/delete/(:num)', 'Users::delete/$1');

    // Sales pages
$routes->get('sales/new', 'Sales::newSale');
$routes->post('sales/create', 'Sales::create');
$routes->get('sales/history', 'Sales::history');

$routes->get('products/image/(:segment)', 'Products::image/$1');
$routes->get('users/avatar/(:segment)', 'Users::avatar/$1');
});