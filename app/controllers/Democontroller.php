<?php 

/**
 * Index Controller
 */
namespace App\Controllers;

use App\Classes\Session;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Stripe\Stripe;


class Democontroller extends Basecontroller
{
	
	public function show()
	{

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		/*Stripe::setApiKey('sk_test_Wi4vf1wALhk8ayILg1dLdDPq00BfS3CSqJ');

		$intent = \Stripe\PaymentIntent::create([
    		'amount' => 1099,
    		'currency' => 'inr'
		]);*/
		
		$payments = Payment::select(Capsule::raw("sum(amount) as amount, DATE_FORMAT(created_at, '%m-%Y') as new_date"))
						->where('status', 'Success')
						->groupBy(Capsule::raw('YEAR(created_at) , MONTH(created_at)'))->get()->toJSON();

		$orders_old = Order::select(Capsule::raw("order_no , created_at, status, user_id"))
						->with('user', 'payments')->groupBy(Capsule::raw('order_no'))->paginate(3);

		$orderp = Order::where('status', 'Completed')->get()->unique('order_no')->count();

		$order = Order::all()->groupBy('order_no');

		$orders = Payment::with('user')->paginate(10, ['*'], 'p1');

		/*$products = array_map( function($order) {

						$product = $order['product'];

						$product['quantity'] = $order['total'];

						return json_decode(json_encode($product), false);

					}

						, $orders);*/
		// ['Success' => [0 => ['amount' => 'def'] ]]

		var_dump($orders_old);	

		exit();		
						
	}
}

 ?>