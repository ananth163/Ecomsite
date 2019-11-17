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

// Products management
$router->map( 'GET', '/admin/products/create',
                     'App\Controllers\Admin\Productscontroller@showForm', 'show_form');
$router->map( 'POST', '/admin/products/create',
                      'App\Controllers\Admin\Productscontroller@store', 'create_products');
$router->map( 'GET', '/admin/products/manage_inventory',
                     'App\Controllers\Admin\Productscontroller@show', 'show_products');
$router->map( 'GET', '/admin/products/[i:id]/edit',
                      'App\Controllers\Admin\Productscontroller@showForm', 'show_editForm');
$router->map( 'POST', '/admin/products/[i:id]/edit',
                      'App\Controllers\Admin\Productscontroller@edit', 'update_products');
$router->map( 'POST', '/admin/products/[i:id]/delete',
                      'App\Controllers\Admin\Productscontroller@delete', 'delete_products');

 ?>