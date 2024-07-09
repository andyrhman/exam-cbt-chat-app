<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// * Authentication
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->get('login/logout', 'Login::logout');
$routes->post('/login/check_login', 'Login::check_login');

// * Admin
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/manage_profile', 'Admin::manage_profile');
$routes->post('/admin/manage_profile/update', 'Admin::update_profile');
$routes->post('/admin/manage_profile/changePassword', 'Admin::update_password');
$routes->post('/admin/manage_profile/register', 'Register::create');

$routes->get('/admin/classes', 'Admin::manage_class');

$routes->get('/admin/teacher', 'Admin::manage_teacher');
$routes->post('/admin/teacher/create_teacher', 'Admin::create_teacher');
$routes->post('/admin/teacher/update_teacher', 'Admin::update_teacher');
$routes->post('/admin/teacher/delete_teacher', 'Admin::delete_teacher');

// * Setting
$routes->get('/setting/system_settings', 'Setting::system_settings');
$routes->post('/setting/system_settings/update', 'Setting::update_settings');
$routes->post('/setting/system_settings/logo', 'Setting::update_logo');
$routes->post('/setting/system_settings/theme', 'Setting::update_theme');

// * Get Data
$routes->get('modal/popup/(:any)/(:num)', 'Modal::popup/$1/$2');


