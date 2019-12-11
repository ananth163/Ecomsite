<?php 

namespace App\Controllers\Admin;

use App\Classes\Collection;
use App\Classes\Orders;
use App\Classes\Pagination;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Session;
use App\Controllers\Basecontroller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;


/**
 * Dashboard controller class
 */

class Dashboardcontroller extends Basecontroller
{
	public function __construct()
	{
		// Verify if user is admin
		if(!Role::is('admin'))
		{
			Redirect::to('/login');

			exit();
		}

		// Inject Pagination container
		new Pagination;

	}

	public function show()
	{
		
		$orders = Order::where('status', 'Completed')->get()->unique('order_no')->count();

		$products = Product::all()->count();

		$payments = Payment::where('status', 'Success')->get()->sum('amount');

		$users = User::all()->count();

		return view('admin/dashboard', compact('orders', 'products', 'payments', 'users'));
		
	}

	public function showPayments()
	{
		$payments = Payment::with('user')->paginate(10, ['*'], 'p1');

		return view('admin/payments', compact('payments'));
		
	}

	public function showOrders()
	{
		// Get all orders available
		$orderNumbers = Orders::getAll();

		$ordersList = array_map(function ($orderNumber) {
								
								return new Orders($orderNumber);

					}, $orderNumbers);

		$orders = (new Collection($ordersList))->paginate(10);

		return view('admin/orders', compact('orders'));
	}

	public function showOrder($orderNo)
	{
		$order = new Orders($orderNo);

		return view('orders/order', compact('order'));						
	}

	public function showUsers()
	{
		// Get all users available
		$users = User::paginate(10);

		return view('admin/users', compact('users'));
	}

	public function getCharts()
	{
		$payments = Payment::select(Capsule::raw("sum(amount/100) as amount, DATE_FORMAT(created_at, '%m-%Y') as new_date"))
						->where('status', 'Success')
						->groupBy(Capsule::raw('YEAR(created_at) , MONTH(created_at)'))->get();

		$orders = Order::select(Capsule::raw("COUNT(DISTINCT order_no) as count, DATE_FORMAT(created_at, '%m-%Y') as new_date"))
						->where('status', 'Completed')
						->groupBy(Capsule::raw('YEAR(created_at) , MONTH(created_at)'))->get();

		echo json_encode(compact('payments', 'orders'));

		exit();
	}

	public function store ()
	{
		
		if (Request::hasType('POST')) {
			var_dump(Request::fetchType('POST'));
		}
	}


}

 ?>