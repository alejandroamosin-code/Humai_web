<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Home
$routes->get('/', 'Home::index');

// Registration
$routes->get('/register', 'Registration::index');   // show form
$routes->post('/register', 'Registration::store'); // handle submission

// Login / Auth
$routes->get('/login', 'Auth::login');             // show form
$routes->post('/login', 'Auth::authenticate');    // submit login
$routes->get('/logout', 'Auth::logout');          // logout

// Protected routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('users/edit/(:num)', 'Users::edit/$1');
    $routes->post('users/update/(:num)', 'Users::update/$1');
    $routes->get('users', 'Users::index');
    $routes->get('logs', 'Logs::index'); // Route to Logs controller's index method for displaying logs
    $routes->get('disease', 'Disease::index');

    $routes->get('manage', 'ImageController::index');
    $routes->post('images/upload', 'ImageController::upload');
     // Show uploaded list;

    $routes->get('faq', 'FaqController::index');
    $routes->get('faq/edit/(:num)', 'FaqController::edit/$1');
    $routes->post('faq/update/(:num)', 'FaqController::update/$1');
    $routes->get('faq/delete/(:num)', 'FaqController::delete/$1');

    $routes->get('feedback', 'FeedbackController::index');
    $routes->get('feedback/delete/(:num)', 'FeedbackController::delete/$1');
    $routes->post('feedback/search', 'FeedbackController::search');
    
});


 // API Routes (for React Native Mobile App)
$routes->group('api', ['filter' => 'cors'], function($routes) {
    // Public routes
    $routes->post('login', 'ApiController::login');
    $routes->post('register', 'ApiController::register');
    
    // User routes
    $routes->get('users', 'ApiController::users');
    $routes->get('user/(:num)', 'ApiController::user/$1');
    $routes->put('user/(:num)', 'ApiController::updateUser/$1');
    $routes->delete('user/(:num)', 'ApiController::deleteUser/$1');
});