<?php 


$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', 'App\Controllers\Indexcontroller@show', 'homepage');

// map Admin URL's
$router->map( 'GET', '/admin', 'App\Controllers\Admin\Dashboardcontroller@show', 'admin');


 ?>