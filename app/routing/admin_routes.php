<?php 

// Admin Dashboard
$router->map( 'GET', '/admin', 'App\Controllers\Admin\Dashboardcontroller@show', 'admin_dashboard');
$router->map( 'POST', '/admin', 'App\Controllers\Admin\Dashboardcontroller@store', 'admin_form');

// Product Categories management
$router->map( 'GET', '/admin/products/categories',
                     'App\Controllers\Admin\ProductCategoriescontroller@show', 'show_product_categories');
$router->map( 'POST', '/admin/products/categories',
                      'App\Controllers\Admin\ProductCategoriescontroller@store', 'create_product_categories');
$router->map( 'POST', '/admin/products/categories/[i:id]/edit',
                      'App\Controllers\Admin\ProductCategoriescontroller@edit', 'update_product_categories');
$router->map( 'POST', '/admin/products/categories/[i:id]/delete',
                      'App\Controllers\Admin\ProductCategoriescontroller@delete', 'delete_product_categories');

// SubCategories management
$router->map( 'GET', '/admin/products/subcategories/[i:id]',
                     'App\Controllers\Admin\SubCategoriescontroller@show', 'show_sub_categories');
$router->map( 'POST', '/admin/products/subcategories/[i:id]/create',
                      'App\Controllers\Admin\SubCategoriescontroller@store', 'create_sub_categories');
$router->map( 'POST', '/admin/products/subcategories/[i:id]/edit',
                      'App\Controllers\Admin\SubCategoriescontroller@edit', 'update_sub_categories');
$router->map( 'POST', '/admin/products/subcategories/[i:id]/delete',
                      'App\Controllers\Admin\SubCategoriescontroller@delete', 'delete_sub_categories');

 ?>