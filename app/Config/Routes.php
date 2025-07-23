<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');

// Karyawan
$routes->get('/karyawan', 'Karyawan::index');
$routes->get('/karyawan/create', 'Karyawan::create');
$routes->post('/karyawan/store', 'Karyawan::store');
$routes->get('/karyawan/edit/(:num)', 'Karyawan::edit/$1');
$routes->post('/karyawan/update/(:num)', 'Karyawan::update/$1');
$routes->delete('/karyawan/delete/(:num)', 'Karyawan::delete/$1');
$routes->get('/karyawan/detail/(:segment)', 'Karyawan::detail/$1');
$routes->get('/karyawan/pdf', 'Karyawan::pdf');


// Kehadiran
$routes->get('/kehadiran', 'Kehadiran::index');
$routes->get('/kehadiran/create', 'Kehadiran::create');
$routes->post('/kehadiran/store', 'Kehadiran::store');

// Izin
$routes->get('/izin', 'Izin::index');
$routes->get('/izin/create', 'Izin::create');
$routes->post('/izin/store', 'Izin::store');

// Gaji
$routes->get('/gaji', 'Gaji::index');
$routes->get('/gaji/slip/(:num)', 'Gaji::slip/$1');


// Tunjangan
$routes->get('/tunjangan', 'Tunjangan::index');
$routes->post('/tunjangan/update/(:num)', 'Tunjangan::update/$1');

// Potongan
$routes->get('/potongan', 'Potongan::index');
$routes->post('/potongan/update/(:num)', 'Potongan::update/$1');

// Users
$routes->get('/users', 'Users::index');
$routes->get('/users/create', 'Users::create');
$routes->post('/users/store', 'Users::store');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update/(:num)', 'Users::update/$1');
$routes->delete('/users/delete/(:num)', 'Users::delete/$1');

// Cuti
$routes->get('/cuti', 'Cuti::index');
$routes->get('/cuti/create', 'Cuti::create');
$routes->post('/cuti/store', 'Cuti::store');
$routes->get('/cuti/approve/(:num)', 'Cuti::approve/$1');
$routes->get('/cuti/reject/(:num)', 'Cuti::reject/$1');

// Penilaian Kinerja
$routes->get('/penilaian_kinerja', 'PenilaianKinerja::index');
$routes->get('/penilaian_kinerja/create', 'PenilaianKinerja::create');
$routes->post('/penilaian_kinerja/store', 'PenilaianKinerja::store');


$routes->get('/migrate', function() {
    $migrate = \Config\Services::migrations();
    try {
        $migrate->latest();
        echo 'Migrations run successfully!';
    } catch (\Throwable $e) {
        echo $e->getMessage();
    }
});

$routes->get('/seed', function() {
    $seeder = \Config\Database::seeder();
    try {
        $seeder->call('KaryawanSeeder');
        echo 'Seeder run successfully!';
    } catch (\Throwable $e) {
        echo $e->getMessage();
    }
});




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
