<?php 


$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', 'App\Controllers\Indexcontroller@show', 'homepage');





 ?>