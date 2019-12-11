<?php 

namespace App\Classes;

use App\Classes\Cart;
use App\Classes\Session;
use App\Models\Order;
use App\Models\Product;

/**
 * Order handler
 **/

class Orders 
{
	/**
	 * @param int orderNumber
	 **/
	public $orderNumber;

	/**
	 * @param array $products
	 **/
	public $products;

	/**
	 * @param date placed_at
	 **/
	public $placedAt;

	/**
	 * @param string status
	 **/
	public $status;

	/**
	 * @param int subTotal
	 **/
	public $subTotal;

	/**
	 * @param int Tax
	 **/
	public $tax;

	/**
	 * @param int Taxrate
	 **/
	public $taxRate = 0.05;

	/**
	 * @param int Shipping
	 **/
	public $shipping = 15;

	/**
	 * @param int Amount
	 **/
	public $amount;

	/**
	 * @param string Username
	 **/
	public $username;
	
	/** Instantiate Orders
	 *
	 **/
	public function __construct($orderNumber)
	{
		$this->orderNumber = $orderNumber;

		$this->products = $this->getProducts();

		$this->subTotal = $this->getSubTotal();

		$this->tax = $this->getFormattedTax();

		$this->amount = $this->getFormattedAmount();
	}

	/**
	 * Get Orders for the provided User
	 * 
	 * @param int $userID 
	 *
	 * @return array Orders for the user
	 *
	 **/
	public static function getForUser($userID)
	{
		return Order::where('user_id', $userID)->get()->pluck('order_no')->unique()->toArray();
	}

	/**
	 * Get all available Orders
	 *
	 * @return array Orders 
	 *
	 **/
	public static function getAll()
	{
		return Order::all()->pluck('order_no')->unique()->toArray();
	}


	/**
	 * Get Products from the given Order
	 *
	 * @param string $order Order No.
	 *
	 * @return array List of Products
	 *
	 **/
	public function getProducts()
	{
		//Fetch the Orders
		$orders = Order::where('order_no', $this->orderNumber)->with('product' , 'user')->get();

		// Get order creation date
		$this->placedAt = $orders->first()->updated_at->toFormattedDateString();

		// Get User who created Order
		$this->username = $orders->first()->user->username;

		// Get order status
		$this->status =  $orders->first()->status;

		$products = array_map( function($order) {

						$product = $order['product'];

						$product['quantity'] = $order['total'];

						return json_decode(json_encode($product), false);

					}

						, $orders->toArray());

		return $products;
	}

	/**
	 * Get SubTotal for the given Order
	 *
	 * @param string $order Order No.
	 *
	 * @return array List of Products
	 *
	 **/
	public function getSubTotal()
	{
		//Fetch the Products
		$products = $this->getProducts();

		$subTotal = 0;

		foreach ($products as $product) {
			
			$subTotal += $product->quantity * $product->price;
		}

		return $subTotal;
	}

	/**
	 * Get Tax Amount
	 *
	 * @return int $tax Tax to pay
	 *
	 **/
	
	public function getTax()
	{
		return $this->getSubTotal() * $this->taxRate;
		
	}

	/**
	 * Get Tax to pay after format
	 *
	 * @return int $total Amount to pay
	 *
	 **/
	
	public function getFormattedTax()
	{
		return number_format($this->getTax(), 2);
		
	}

	/**
	 * Get Amount to pay
	 *
	 * @return int $total Amount to pay
	 *
	 **/
	
	public function getAmount()
	{
		return $this->getSubTotal() + $this->getTax() + $this->shipping;
		
	}

	/**
	 * Get Amount to pay after format
	 *
	 * @return int $total Amount to pay
	 *
	 **/
	
	public function getFormattedAmount()
	{
		return number_format($this->getAmount(), 2);
		
	}
	

	
}

 ?>