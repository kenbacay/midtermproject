<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->get('dashboard', 'Auth::dashboard');
$routes->get('logout', 'Auth::logout');