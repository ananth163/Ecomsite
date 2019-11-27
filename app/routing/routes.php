<?php 


$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', 'App\Controllers\Indexcontroller@show', 'homepage');
$router->map( 'GET', '/featured', 'App\Controllers\FeaturedProductscontroller@show', 'featured');

// Demo page
$router->map( 'GET', '/demo', 'App\Controllers\Democontroller@show', 'demopage');

// map Admin routes
require_once( __DIR__ . '/admin_routes.php');

 ?>