<?php

namespace Config;

use Config\Services;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Route default akan mengarah ke login
$routes->get('/', 'Auth::index');

// Rute Autentikasi
$routes->get('/login', 'Auth::index', ['filter' => 'noauth']);
$routes->post('/login', 'Auth::login', ['filter' => 'noauth']);
$routes->get('/logout', 'Auth::logout');

// Rute untuk Gudang (Admin)
$routes->group('gudang', ['filter' => 'auth:gudang'], function ($routes) {
    $routes->get('/', 'Gudang::index');
    $routes->get('bahan-baku/new', 'Gudang::newBahanBaku');
    $routes->post('bahan-baku', 'Gudang::createBahanBaku');
});

// Rute untuk Dapur (Client)
$routes->group('dapur', ['filter' => 'auth:dapur'], function ($routes) {
    $routes->get('/', 'Dapur::index');
    // Tambahkan rute lain untuk fitur dapur di sini
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}