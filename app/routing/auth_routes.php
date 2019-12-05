<?php 

// map Registration page
$router->map( 'GET', '/sign-up', 'App\Controllers\Authcontroller@showRegistration', 'registrationPage');
$router->map( 'POST', '/sign-up', 'App\Controllers\Authcontroller@register', 'register_user');

// map Login page
$router->map( 'GET', '/login', 'App\Controllers\Authcontroller@showLogin', 'loginPage');
$router->map( 'POST', '/login', 'App\Controllers\Authcontroller@login', 'login_user');

// map Logout route
$router->map( 'GET', '/logout', 'App\Controllers\Authcontroller@logout', 'logout');

 ?>