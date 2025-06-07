<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin::login');
$routes->get('/home/coba-parameter/(:alpha)/(:num)/(:alphanum)', 'Home::belajar_segment/$1/$2/$3');

//Routes untuk Register Admin
$routes->get('/admin/register', 'Admin::register');
$routes->post('/admin/process-register', 'Admin::process_register');


//Routes untuk login admin
$routes->get('/admin/login-admin', 'Admin::login');
$routes->get('/admin/logout', 'Admin::logout');
$routes->get('/admin/dashboard-admin', 'Admin::dashboard');
$routes->post('/admin/autentikasi-login', 'Admin::autentikasi');

//Routes untuk module admin
$routes->get('/admin/master-data-admin', 'Admin::master_data_admin'); 
$routes->get('/admin/input-data-admin', 'Admin::input_data_admin');
$routes->post('/admin/simpan-admin', 'Admin::simpan_data_admin');
$routes->get('/admin/edit-data-admin/(:alphanum)', 'Admin::edit_data_admin/$1');
$routes->post('/admin/update-admin', 'Admin::update_data_admin');
$routes->get('/admin/hapus-data-admin/(:alphanum)', 'Admin::hapus_data_admin/$1');

//Module Peminjaman
$routes->get('/admin/data-transaksi-peminjaman', 'Admin::data_transaksi_peminjaman');
$routes->get('/admin/peminjaman-step-1', 'Admin::peminjaman_step1');
$routes->get('/admin/tes-qr', 'Admin::tes_qr');
$routes->get('/admin/peminjaman-step-2', 'Admin::peminjaman_step2');
$routes->post('/admin/peminjaman-step-2', 'Admin::peminjaman_step2');
$routes->get('/admin/simpan-temp-pinjam/(:alphanum)', 'Admin::simpan_temp_pinjam/$1');
$routes->get('/admin/hapus-temp/(:alphanum)', 'Admin::hapus_peminjaman/$1');
$routes->get('/admin/simpan-transaksi-peminjaman', 'Admin::simpan_transaksi_peminjaman');


//Routes untuk module Anggota
$routes->get('/anggota/master-data-anggota', 'Anggota::master_data_anggota');
$routes->get('/anggota/input-anggota', 'Anggota::input_data_anggota');
$routes->post('/anggota/simpan-anggota', 'Anggota::simpan_data_anggota');
$routes->get('/anggota/edit-anggota/(:segment)', 'Anggota::edit_data_anggota/$1');
$routes->post('/anggota/update-anggota/(:segment)', 'Anggota::update_data_anggota/$1');
$routes->get('/anggota/hapus-anggota/(:segment)', 'Anggota::hapus_data_anggota/$1');

//Routes untuk module Kategori
$routes->get('/kategori/master-data-kategori', 'Kategori::master_data_kategori'); 
$routes->get('/kategori/input-data-kategori', 'Kategori::input_data_kategori');
$routes->post('/kategori/simpan-kategori', 'Kategori::simpan_data_kategori');
$routes->get('/kategori/edit-data-kategori/(:alphanum)', 'Kategori::edit_data_kategori/$1');
$routes->post('/kategori/update-kategori', 'Kategori::update_data_kategori');
$routes->get('/kategori/hapus-data-kategori/(:alphanum)', 'Kategori::hapus_data_kategori/$1');

//Routes untuk module Rak
$routes->get('/rak/master-data-rak', 'Rak::master_data_rak'); 
$routes->get('/rak/input-data-rak', 'Rak::input_data_rak');
$routes->post('/rak/simpan-rak', 'Rak::simpan_data_rak');
$routes->get('/rak/edit-data-rak/(:alphanum)', 'Rak::edit_data_rak/$1');
$routes->post('/rak/update-rak', 'Rak::update_data_rak');
$routes->get('/rak/hapus-data-rak/(:alphanum)', 'Rak::hapus_data_rak/$1');

//Routes untuk module buku
$routes->get('/buku/master-data-buku', 'Buku::master_data_buku'); 
$routes->get('/buku/edit-data-buku(:alphanum)', 'Buku::edit_data_buku/$1');
$routes->post('/buku/update-data-buku', 'Buku::update_data_buku');
$routes->get('/buku/hapus-data-buku/(:alphanum)', 'Buku::hapus_data_buku/$1');
$routes->get('/buku/input-data-buku', 'Buku::input_data_buku');
$routes->post('/buku/simpan-data-buku', 'Buku::simpan_data_buku');

//Routes untuk halaman data peminjaman
$routes->get('admin/data-transaksi-peminjamann', 'Admin::dataTransaksiPeminjaman');
$routes->get('admin/detail-transaksi/(:any)', 'Admin::detailTransaksi/$1');