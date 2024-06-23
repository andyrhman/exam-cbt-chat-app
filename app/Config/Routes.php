<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/check_login', 'Login::check_login');
$routes->get('/logout', 'Login::logout');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('login/logout', 'Login::logout');

