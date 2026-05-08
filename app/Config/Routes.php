<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UtilisateurController::login');
$routes->get('/login', 'UtilisateurController::login');

$routes->post('/check-user', 'UtilisateurController::checkUser');

$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/signin', 'UtilisateurController::signin');

$routes->post('/create-user', 'UtilisateurController::createUser');

