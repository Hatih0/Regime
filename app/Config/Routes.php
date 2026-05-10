<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UtilisateurController::index');

$routes->get('/userAuth', 'UtilisateurController::login');

$routes->post('/check-user', 'UtilisateurController::checkUser');

$routes->get('/dashboard', 'DashboardController::index');

// $routes->get('/userProfil', 'UtilisateurController::profil');
$routes->get('/user-profile', 'UtilisateurController::getUserProfile');

$routes->get('/adminAuth', 'AdminController::login');

$routes->post('/adminAuth', 'AdminController::authenticate');

$routes->get('/logout', function() {
    session()->destroy();
    return redirect()->to('/');
});

$routes->get('/admin/logout', function() {
    session()->destroy();
    return redirect()->to('/adminAuth');
});

$routes->group('', ['filter' => 'adminauth'], static function ($routes) {
    $routes->get('/only-admin', 'AdminController::onlyAdmin');

    $routes->get('/regimes', 'RegimeController::index');
    $routes->get('/regimes/showForm', 'RegimeController::create');
    $routes->post('/regimes/create', 'RegimeController::store');
    $routes->get('/regimes/(:num)/view', 'RegimeController::show/$1');
    $routes->post('/regimes/(:num)/edit', 'RegimeController::update/$1');
    $routes->get('/regimes/(:num)/delete', 'RegimeController::delete/$1');

    $routes->get('/exercices', 'ExerciceController::index');
    $routes->get('/exercices/showForm', 'ExerciceController::create');
    $routes->post('/exercices/create', 'ExerciceController::store');
    $routes->get('/exercices/(:num)/view', 'ExerciceController::show/$1');
    $routes->post('/exercices/(:num)/edit', 'ExerciceController::update/$1');
    $routes->get('/exercices/(:num)/delete', 'ExerciceController::delete/$1');

    $routes->get('/admin/codes', 'AdminController::codesList');
    $routes->post('/admin/codes/generate', 'AdminController::generateCodes');

});

$routes->get('/signin', 'UtilisateurController::signin');
$routes->get('/login', 'UtilisateurController::login');

$routes->post('create-user', 'UtilisateurController::createUser');

$routes->get('choix-objectif', 'ObjectifUtilisateurController::choixObjectif');

$routes->post('create-objectif', 'ObjectifUtilisateurController::createObjectifUser');

$routes->get('user-profile', 'UtilisateurController::getUserProfile');

$routes->post('update-utilisateur', 'UtilisateurController::updateUtilisateur');
$routes->post('update-sante', 'UtilisateurController::updateSante');
$routes->post('update-objectif', 'UtilisateurController::updateObjectif');

$routes->get('/wallet', 'UtilisateurController::wallet');
$routes->post('/wallet/recharge', 'UtilisateurController::rechargeWithCode');

$routes->get('/gold', 'UtilisateurController::goldPage');
$routes->post('/buy-gold', 'UtilisateurController::buyGold');

$routes->get('choix-regime', 'RegimeController::choixRegime');
$routes->post('calcul-regime', 'RegimeController::calculRegime');

$routes->post('export/pdf', 'RegimeController::pdfExport');