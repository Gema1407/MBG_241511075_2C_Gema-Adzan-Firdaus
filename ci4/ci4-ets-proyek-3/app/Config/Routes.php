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
    $routes->get('/', 'Gudang::dashboardGudang');
    // melihat bahan baku
    $routes->get('bahan_baku', 'Gudang::lihatBahanBaku');
    // tampilan form tambah
    $routes->get('bahan_baku/tambah', 'Gudang::tambahBahanBaku');
    // menyimpan data
    $routes->post('bahan_baku/create', 'Gudang::createBahanBaku');
    // mengubah data bahan baku
    $routes->get('bahan_baku/edit/(:num)', 'Gudang::editBahanBaku/$1');
    $routes->post('bahan_baku/edit/(:num)', 'Gudang::updateBahanBaku/$1');
    $routes->post('bahan_baku/editStokBahanBaku/(:num)', 'Gudang::editStokBahanBaku/$1');
    $routes->get('bahan_baku/hapus/(:num)', 'Gudang::hapusBahanBaku/$1');
    // permintaan gudang
    $routes->get('permintaan', 'Gudang::daftarPermintaan');
    $routes->get('permintaan/detail/(:num)', 'Gudang::detailPermintaan/$1');
});


// Rute untuk Dapur (Client)
$routes->group('dapur', ['filter' => 'auth:dapur'], function ($routes) {
    $routes->get('/', 'Dapur::dashboardDapur');
    // riwayat permintaan
    $routes->get('riwayat', 'Dapur::riwayatPermintaan');
    $routes->get('riwayat/detail/(:num)', 'Dapur::detailPermintaan/$1');
    // buat permintaan
    $routes->get('permintaan/buat', 'Dapur::buatPermintaan');
    $routes->post('permintaan/simpan', 'Dapur::simpanPermintaan');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
