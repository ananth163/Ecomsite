<?php 

/**
 * Order Controller
 */
namespace App\Controllers;

use App\Classes\Orders;
use App\Classes\Redirect;
use App\Classes\Role;
use App\Classes\Session;

class Ordercontroller extends Basecontroller
{
	public function __construct()
	{
		// Verify if user is logged in
		if(!Role::is('user') || !Role::is('admin'))
		{
			Redirect::to('/login');

			exit();
		}
		
	}

	public function showOrder($orderNo)
	{
		$order = new Orders($orderNo);

		return view('orders/order', compact('order'));						
	}

	public function show()
	{
		// Get the user ID of the user
		$userID = Session::getValueFor('SESSION_USER_ID');

		// Get all orders for this User
		$orderNumbers = Orders::getForUser($userID);

		$orders = array_map(function ($orderNumber) {
								
								return new Orders($orderNumber);

					}, $orderNumbers);

		//var_dump($orders);

		//exit();

		return view('orders/all', compact('orders'));						
	}
}

 ?>