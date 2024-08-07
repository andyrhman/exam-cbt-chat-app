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

// * Subject
$routes->get('/admin/subject', 'Admin::manage_subject');
$routes->post('/admin/subject/create_subject', 'Admin::create_subject');
$routes->post('/admin/subject/update_subject/(:num)', 'Admin::update_subject/$1');
$routes->get('/admin/subject/delete/(:num)', 'Admin::delete_subject/$1');

// * Student
$routes->get('/admin/student', 'Admin::manage_student');
$routes->post('/admin/student/create_student', 'Admin::create_student');
$routes->post('/admin/student/update_student/(:num)', 'Admin::update_student/$1');
$routes->get('/admin/student/delete/(:num)', 'Admin::delete_student/$1');

// * Exam
$routes->get('/admin/create_online_exam', 'Admin::create_online_exam');
$routes->get('/admin/manage_online_exam', 'Admin::manage_online_exam');
$routes->post('/admin/manage_online_exam/create', 'Admin::create_exam');
$routes->get('/admin/manage_online_exam/delete/(:num)', 'Admin::delete_exam/$1');
$routes->get('/admin/manage_online_exam/(:any)', 'Admin::manage_online_exam/$1'); //! Always Keep this more general route last

// * Question
$routes->get('/admin/manage_online_exam_question', 'Admin::manage_online_exam_question');
$routes->get('/admin/manage_online_exam_question/(:any)', 'Admin::manage_online_exam_question/$1');
// $routes->get('/admin/manage_online_exam_question/(:any)/(:any)', 'Admin::load_question_type/$1/$2');


// * Settings
$routes->get('/setting/system_settings', 'Setting::system_settings');
$routes->post('/setting/system_settings/update', 'Setting::update_settings');
$routes->post('/setting/system_settings/logo', 'Setting::update_logo');
$routes->post('/setting/system_settings/theme', 'Setting::update_theme');

// * Get Data
$routes->get('modal/popup/(:any)/(:num)', 'Modal::popup/$1/$2');
$routes->get('/admin/get_class_sections/(:num)', 'Admin::get_class_sections/$1');
$routes->get('/admin/get_class_section_subject/(:num)', 'Admin::get_class_section_subject/$1');
$routes->get('/admin/classes/get_all_classes', 'Admin::get_all_classes');
$routes->get('/admin/teacher/get_all_teachers', 'Admin::get_all_teachers');


