<?php 


$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', 'App\Controllers\Indexcontroller@show', 'homepage');

// map Admin Dashboard
$router->map( 'GET', '/admin', 'App\Controllers\Admin\Dashboardcontroller@show', 'admin_dashboard');
$router->map( 'POST', '/admin', 'App\Controllers\Admin\Dashboardcontroller@store', 'admin_form');

// map Product Categories
$router->map( 'GET', '/admin/products/categories',
                     'App\Controllers\Admin\ProductCategoriescontroller@show', 'product_categories');
$router->map( 'POST', '/admin/products/categories',
                      'App\Controllers\Admin\ProductCategoriescontroller@store', 'manage_product_categories');

 ?>