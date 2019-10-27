<?php 


$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', 'App\Controllers\Indexcontroller@show', 'homepage');

// map Admin page
$router->map( 'GET', '/admin', 'App\Controllers\Admin\Dashboardcontroller@show', 'admin_dashboard');
$router->map( 'POST', '/admin', 'App\Controllers\Admin\Dashboardcontroller@store', 'admin_form');

// map Categories page
$router->map( 'GET', '/admin/products/categories',
                     'App\Controllers\Admin\ProductCategoriescontroller@show', 'show_product_categories');
$router->map( 'POST', '/admin/products/categories',
                      'App\Controllers\Admin\ProductCategoriescontroller@store', 'create_product_categories');
$router->map( 'POST', '/admin/products/categories/[i:id]/edit',
                      'App\Controllers\Admin\ProductCategoriescontroller@edit', 'update_product_categories');
$router->map( 'POST', '/admin/products/categories/[i:id]/delete',
                      'App\Controllers\Admin\ProductCategoriescontroller@delete', 'delete_product_categories');

 ?>