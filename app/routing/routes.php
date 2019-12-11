<?php 


$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', 'App\Controllers\Indexcontroller@show', 'homepage');
$router->map( 'GET', '/featured', 'App\Controllers\Productscontroller@getFeaturedProducts', 'getFeatured');
$router->map( 'GET', '/get-products', 'App\Controllers\Productscontroller@getProducts', 'getProducts');
$router->map( 'POST', '/load-more', 'App\Controllers\Productscontroller@loadMoreProducts', 'loadMoreProducts');

// map Product details page
$router->map( 'GET', '/product/[i:id]', 'App\Controllers\Productscontroller@show', 'products');

// Demo page
$router->map( 'GET', '/demo', 'App\Controllers\Democontroller@show', 'demopage');

// map Cart routes
require_once( __DIR__ . '/cart_routes.php');

// map Auth routes
require_once( __DIR__ . '/auth_routes.php');

// map Admin routes
require_once( __DIR__ . '/admin_routes.php');

 ?>