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

// * Class
$routes->get('/admin/classes', 'Admin::manage_class');
$routes->post('/admin/classes/create_class', 'Admin::create_class');
$routes->post('/admin/classes/update_class/(:num)', 'Admin::update_class/$1');
$routes->get('/admin/classes/delete/(:num)', 'Admin::delete_class/$1');

// * Section
$routes->get('/admin/section', 'Admin::manage_section');
$routes->post('/admin/section/create_section', 'Admin::create_section');
$routes->post('/admin/section/update_section/(:num)', 'Admin::update_section/$1');
$routes->get('/admin/section/delete/(:num)', 'Admin::delete_section/$1');

// * Teacher
$routes->get('/admin/teacher', 'Admin::manage_teacher');
$routes->post('/admin/teacher/create_teacher', 'Admin::create_teacher');
$routes->post('/admin/teacher/update_teacher/(:num)', 'Admin::update_teacher/$1');
$routes->get('/admin/teacher/delete/(:num)', 'Admin::delete_teacher/$1');

// * Settings
$routes->get('/setting/system_settings', 'Setting::system_settings');
$routes->post('/setting/system_settings/update', 'Setting::update_settings');
$routes->post('/setting/system_settings/logo', 'Setting::update_logo');
$routes->post('/setting/system_settings/theme', 'Setting::update_theme');

// * Get Data
$routes->get('modal/popup/(:any)/(:num)', 'Modal::popup/$1/$2');
$routes->get('/admin/classes/get_all_classes', 'Admin::get_all_classes');
$routes->get('/admin/teacher/get_all_teachers', 'Admin::get_all_teachers');


