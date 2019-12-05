<?php 


$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', 'App\Controllers\Indexcontroller@show', 'homepage');
$router->map( 'GET', '/featured', 'App\Controllers\Productscontroller@getFeaturedProducts', 'getFeatured');
$router->map( 'GET', '/get-products', 'App\Controllers\Productscontroller@getProducts', 'getProducts');
$router->map( 'POST', '/load-more', 'App\Controllers\Productscontroller@loadMoreProducts', 'loadMoreProducts');

// map Product details page
$router->map( 'GET', '/product/[i:id]', 'App\Controllers\Productscontroller@show', 'products');

// map Cart
$router->map( 'POST', '/cart/add/', 'App\Controllers\Cartcontroller@add', 'add_to_cart');
$router->map( 'GET', '/cart', 'App\Controllers\Cartcontroller@show', 'cartPage');
$router->map( 'POST', '/cart/update', 'App\Controllers\Cartcontroller@update', 'update_cart');
$router->map( 'POST', '/cart/delete', 'App\Controllers\Cartcontroller@delete', 'remove_cart');

// Demo page
$router->map( 'GET', '/demo', 'App\Controllers\Democontroller@show', 'demopage');

// map Admin routes
require_once( __DIR__ . '/admin_routes.php');

 ?>