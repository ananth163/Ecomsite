<?php 


$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', 'App\Controllers\Indexcontroller@show', 'homepage');

// map Admin routes
require_once( __DIR__ . '/admin_routes.php');

 ?>