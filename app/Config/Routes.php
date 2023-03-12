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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/portfolio', 'Home::portfolio');



$routes->get('verification', 'Manage::verification');

$routes->group("manage", function($routes){
    $routes->get('', 'Manage::login');
    $routes->get('login', 'Manage::login');
    $routes->get('logout', 'Manage::logout');
    $routes->get('register', 'Manage::register');
    $routes->get('forget-password', 'Manage::forgetPassword');

    $routes->get('(:num)', 'Manage::dashboard');
    $routes->get('dashboard', 'Manage::dashboard');
    $routes->get('(:num)/dashboard', 'Manage::dashboard');

    $routes->get('users', 'Users::index');
    $routes->get('add-user', 'Users::addUser');
    $routes->get('edit-user', 'Users::editUser');
    $routes->get('permission-user', 'Users::editUserPermissions');

    $routes->get('permissions', 'Manage::permissions');
    $routes->get('add-permission', 'Manage::addPermission');
    $routes->get('edit-permission', 'Manage::editPermission');

    $routes->get('roles', 'Manage::roles');
    $routes->get('add-role', 'Manage::addRole');
    $routes->get('edit-role', 'Manage::editRole');

    $routes->get('students', 'Manage::students');
    $routes->get('add-student', 'Manage::addStudent');
    $routes->get('edit-student', 'Manage::editStudent');



    
});

$routes->group("manage/api", function($routes){
    $routes->match(['get', 'post'], 'auth', 'APIController::authenticate');
    $routes->post('add-user', 'APIUsers::addEditUser');
    $routes->post('edit-user', 'APIUsers::addEditUser');
    $routes->post('delete-user', 'APIUsers::deleteUser');
    $routes->get('fetch-user-form','APIUsers::fetchUserEditForm');
    
    $routes->post('add-role', 'APIRoles::addEditRole');
    $routes->post('edit-role', 'APIRoles::addEditRole');
    $routes->post('delete-role', 'APIRoles::deleteRole');

    $routes->post('add-permission', 'APIPermissions::addEditPermission');
    $routes->post('edit-permission', 'APIPermissions::addEditPermission');
    $routes->post('delete-permission', 'APIPermissions::deletePermission');


    $routes->get('search-name-email', 'APIController::searchNameEmail');
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
