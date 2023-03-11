<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Main');
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
$routes->group('admin', ['filter' => 'checkauthadmin'], function ($routes) {
    $routes->get("/", "Admin\Main::index", ['as' => 'admin.main']);
    
    // Order
    $routes->get('orders', 'Admin\Order::index', ['as' => 'admin.order']);
    $routes->get('order/edit/(:num)', 'Admin\Order::edit/$1', ['as' => 'admin.order.edit']);
    
    // User
    $routes->get('user', 'Admin\User::index', ['as' => 'admin.user']);
    $routes->get('user/new', 'Admin\User::new', ['as' => 'admin.user.new']);
    $routes->post('user/create', 'Admin\User::create', ['as' => 'admin.user.create']);
    $routes->get('user/edit/(:num)', 'Admin\User::edit/$1', ['as' => 'admin.user.edit']);
    $routes->get('user/show/(:num)', 'Admin\User::show/$1', ['as' => 'admin.user.show']);
    $routes->post('user/update/(:num)', 'Admin\User::update/$1', ['as' => 'admin.user.update']);
    $routes->get('logout', 'Admin\User::logout', ['as' => 'admin.logout']);

    // Category
    $routes->get('category', 'Admin\Category::index', ['as' => 'admin.category']);
    $routes->get('category/new', 'Admin\Category::new', ['as' => 'admin.category.new']);
    $routes->post('category/create', 'Admin\Category::create', ['as' => 'admin.category.create']);
    $routes->get('category/edit/(:num)', 'Admin\Category::edit/$1', ['as' => 'admin.category.edit']);
    $routes->post('category/update/(:num)', 'Admin\Category::update/$1', ['as' => 'admin.category.update']);
    $routes->get('category/delete/(:num)', 'Admin\Category::delete/$1', ['as' => 'admin.category.delete']);
    
    // Product
    $routes->get('product', 'Admin\Product::index', ['as' => 'admin.product']);
    $routes->get('product/new', 'Admin\Product::new', ['as' => 'admin.product.new']);
    $routes->post('product/create', 'Admin\Product::create', ['as' => 'admin.product.create']);
    $routes->get('product/edit/(:num)', 'Admin\Product::edit/$1', ['as' => 'admin.product.edit']);
    $routes->post('product/update/(:num)', 'Admin\Product::update/$1', ['as' => 'admin.product.update']);
    $routes->get('product/delete/(:num)', 'Admin\Product::delete/$1', ['as' => 'admin.product.delete']);
    
});

$routes->match(['get', 'post'], 'admin/login', 'Admin\User::login', ['as' => 'admin.login']);

$routes->get('/', 'Main::index', ['as' => 'main.index']);
$routes->get('page/(:segment)', 'Page::show/$1', ['as' => 'page.show']);
$routes->get('product/(:segment)', 'Product::show/$1', ['as' => 'product.show']);
$routes->get('category/(:segment)', 'Category::show/$1', ['as' => 'category.show']);

// Cart
$routes->get('cart/add/(:num)', 'Cart::add/$1', ['as' => 'cart.add']);
$routes->get('cart/delete/(:num)', 'Cart::delete/$1', ['as' => 'cart.delete']);
$routes->get('cart/clear', 'Cart::clear', ['as' => 'cart.clear']);
$routes->get('cart/show', 'Cart::show', ['as' => 'cart.show']);
$routes->get('cart/view', 'Cart::view', ['as' => 'cart.view']);
$routes->post('cart/checkout', 'Cart::checkout', ['as' => 'cart.checkout']);

// User
$routes->match(['get', 'post'], 'user/login', 'User::login', ['as' => 'user.login']);
$routes->match(['get', 'post'], 'user/signup', 'User::signup', ['as' => 'user.signup']);
$routes->get('user/cabinet', 'User::cabinet', ['as' => 'user.cabinet']);
$routes->get('user/orders', 'User::orders', ['as' => 'user.orders']);
$routes->get('user/order/(:num)', 'User::order/$1', ['as' => 'user.order']);
$routes->match(['get', 'post'], 'user/credentials', 'User::credentials', ['as' => 'user.credentials']);
$routes->get('user/logout', 'User::logout', ['as' => 'user.logout']);

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
