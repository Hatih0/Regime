<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UtilisateurController::login');

$routes->post('/check-user', 'UtilisateurController::checkUser');

$routes->get('/dashboard', 'DashboardController::index');
