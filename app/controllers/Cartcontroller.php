<?php 

/**
 * Cart Controller
 */
namespace App\Controllers;

use App\Classes\CSRFHandler;
use App\Classes\Cart;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Order;


class Cartcontroller extends Basecontroller
{
	
	/**
	 * @var object Cart instance
	 *
	 **/
	protected $cart;

	public function __construct()
	{
		// Instantiate cart
		$this->cart = new Cart();
	}
	public function add()
	{

		$request = Request::fetchType('POST');		

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			throw new \Exception("Unauthorized access");
			
		}

		// If Cart is Empty, Create new Order
		if ($this->cart->isEmpty()) {
			
			$this->cart->createOrder();
		}
		
		// Add item to Cart
		$this->cart->addItem( (array) $request->product);

		$totalItems = $this->cart->getItemsTotal();

		echo json_encode(compact('totalItems'));

		exit();
		
						
	}

	public function show()
	{
		// Get Product details of each Item in Cart
		$products = $this->cart->getProducts();		

		//var_dump($products);

		//exit();

		return view('orders/cart', compact('products'));
	}

	public function delete()
	{
		$request = Request::fetchType('POST');		

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			throw new \Exception("Unauthorized access");
			
		}
		
		// Remove item from Cart
		$index = $this->cart->removeItem($request->id);
	}

	public function update()
	{
		$request = Request::fetchType('POST');		

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			throw new \Exception("Unauthorized access");
			
		}
		
		// Update the item in Cart
		$index = $this->cart->updateItem( (array) $request->product);
	}

	
}

 ?>