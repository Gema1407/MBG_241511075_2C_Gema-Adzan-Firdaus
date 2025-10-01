<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('auth/login/(:segment)', 'Auth::loginForm/$1');
$routes->post('auth/register', 'Auth::processRegister');