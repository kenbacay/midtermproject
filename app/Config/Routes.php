<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public pages
$routes->get('/', 'Tasks::today');
$routes->get('tasks', 'Tasks::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'Pages::about');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Task management
$routes->get('tasks/new', 'Tasks::newTask');
$routes->post('tasks/create', 'Tasks::create');

$routes->get('tasks/edit/(:num)', 'Tasks::edit/$1');
$routes->post('tasks/update/(:num)', 'Tasks::update/$1');

$routes->post('tasks/delete/(:num)', 'Tasks::delete/$1');