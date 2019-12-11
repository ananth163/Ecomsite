<?php 

// map Cart
$router->map( 'POST', '/cart/add/', 'App\Controllers\Cartcontroller@add', 'add_to_cart');
$router->map( 'GET', '/cart', 'App\Controllers\Cartcontroller@show', 'cartPage');
$router->map( 'POST', '/cart/update', 'App\Controllers\Cartcontroller@update', 'update_cart');
$router->map( 'POST', '/cart/delete', 'App\Controllers\Cartcontroller@delete', 'remove_cart');

// Checkout
$router->map( 'POST', '/cart/checkout', 'App\Controllers\Cartcontroller@showCheckout', 'checkout');

// Payment
$router->map( 'GET', '/cart/payment', 'App\Controllers\Paymentcontroller@showPaymentForm', 'payment_form');
$router->map( 'POST', '/cart/payment/intent', 'App\Controllers\Paymentcontroller@getPaymentIntent', 'payment_intent');
$router->map( 'POST', '/cart/payment/webhook', 'App\Controllers\Paymentcontroller@verifyPayment', 'verify_payment');
$router->map( 'GET', '/cart/payment/success', 'App\Controllers\Paymentcontroller@showSuccess', 'success_payment');
$router->map( 'POST', '/cart/payment/failed', 'App\Controllers\Paymentcontroller@showFail', 'fail_payment');

// Order
$router->map( 'GET', '/orders', 'App\Controllers\Ordercontroller@show', 'all_orders');
$router->map( 'GET', '/orders/[a:order]', 'App\Controllers\Ordercontroller@showOrder', 'show_order');

 ?>