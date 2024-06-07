<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//ROUTE AUTH
$routes->get('/', 'Login::loginqrcode');
$routes->get('/login', 'Login::index');
$routes->post('/login/proses', 'Login::proses');
$routes->post('/prosesqrcode', 'Login::prosesqrcode');
$routes->get('/logout', 'Login::logout');

//ROUTE DASHBOARD
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/profile', 'Dashboard::profile');
$routes->get('/notifikasi', 'Dashboard::notifikasi');
$routes->get('/hapusall', 'Dashboard::hapusall');
$routes->get('/readall', 'Dashboard::readall');
$routes->post('/profile/edit/proses', 'Dashboard::prosesedit');

//ROUTE ABSENSI
$routes->get('/absensi', 'Absensi::index');
$routes->get('/absensi/all', 'Absensi::all');
$routes->get('/absensi/izin/(:any)', 'Absensi::izin/$1');
$routes->post('/absensi/prosesizin', 'Absensi::prosesizin');
$routes->get('/absensi/sakit/(:any)', 'Absensi::sakit/$1');
$routes->post('/absensi/prosessakit', 'Absensi::prosessakit');
$routes->get('/absensi/absensikehadiran/(:any)', 'Absensi::absensikehadiran/$1');
$routes->post('/absensi/prosesabsensikehadiran', 'Absensi::prosesabsensikehadiran');
$routes->get('/absensi/absensikepulangan/(:any)', 'Absensi::absensikepulangan/$1');
$routes->post('/absensi/prosesabsensikepulangan', 'Absensi::prosesabsensikepulangan');
$routes->get('/absensi/eviden/(:any)', 'Absensi::eviden/$1');
$routes->match(['get','post'],'/absensi/validasiizin/(:any)', 'Absensi::validasiizin/$1');
$routes->match(['get','post'],'/absensi/validasisakit/(:any)', 'Absensi::validasisakit/$1');
$routes->post('/absensi/proseseviden', 'Absensi::proseseviden');
$routes->get('/absensi/suksesabsen', 'Absensi::suksesabsen');
$routes->get('/absensi/detail/(:any)', 'Absensi::detail/$1');
$routes->get('/absensi/hapus/(:any)', 'Absensi::hapus/$1');

//ROUTE KEPULANGAN
$routes->get('/kepulangan', 'Kepulangan::index');
$routes->get('/kepulangan/detail/(:any)', 'Kepulangan::detail/$1');
$routes->get('/kepulangan/hapus/(:any)', 'Kepulangan::hapus/$1');

//RUOTE EVIDEN
$routes->get('/eviden', 'Eviden::index');
$routes->get('/eviden/detail/(:any)', 'Eviden::detail/$1');
$routes->get('/eviden/hapus/(:any)', 'Eviden::hapus/$1');

//ROUTE PESERTA
$routes->get('/peserta', 'Peserta::index');
$routes->get('/peserta/tambah', 'Peserta::tambah');
$routes->post('/peserta/tambah/proses', 'Peserta::prosestambah');
$routes->get('/peserta/qrcode/(:any)', 'Peserta::generateqr/$1');
$routes->get('/peserta/detail/(:any)', 'Peserta::detail/$1');
$routes->get('/peserta/edit/(:any)', 'Peserta::edit/$1');
$routes->post('/peserta/edit/proses', 'Peserta::prosesedit');
$routes->get('/peserta/hapus/(:any)', 'Peserta::hapus/$1');
$routes->get('/peserta/download/(:any)', 'Peserta::download/$1');

//ROUTE MANAJEMEN AKUN
$routes->get('/manajemenakun/admin', 'ManajemenAkun::akunadmin');
$routes->get('/manajemenakun/dosenguru', 'ManajemenAkun::akundosenguru');
$routes->get('/manajemenakun/peserta', 'ManajemenAkun::akunpeserta');
$routes->get('/manajemenakun/tambah', 'ManajemenAkun::tambah');
$routes->post('/manajemenakun/tambah/proses', 'ManajemenAkun::prosestambah');
$routes->get('/manajemenakun/qrcode/(:any)', 'ManajemenAkun::generateqr/$1');
$routes->get('/manajemenakun/detail/(:any)', 'ManajemenAkun::detail/$1');
$routes->get('/manajemenakun/edit/(:any)', 'ManajemenAkun::edit/$1');
$routes->post('/manajemenakun/edit/proses', 'ManajemenAkun::prosesedit');
$routes->get('/manajemenakun/hapus/(:any)', 'ManajemenAkun::hapus/$1');
$routes->get('/manajemenakun/download/(:any)', 'ManajemenAkun::download/$1');