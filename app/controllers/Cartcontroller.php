<?php 

/**
 * Cart Controller
 */
namespace App\Controllers;

use App\Classes\CSRFHandler;
use App\Classes\Cart;
use App\Classes\Request;
use App\Classes\Session;
use App\Models\Product;

class Cartcontroller extends Basecontroller
{
	
	public function add()
	{

		$request = Request::fetchType('POST');		

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			throw new \Exception("Unauthorized access");
			
		}
		
		// Add item to Cart
		$index = Cart::addItem( (array) $request->product);

		$totalItems = Cart::getItemsTotal();

		echo json_encode(compact('totalItems'));

		exit();
		
						
	}

	public function show()
	{
		// Get Items from Cart
		$items = Cart::getItems();

		$products = array_map( function($item) {

						$product = Product::where('id', $item['product_id'])->first()->attributesToArray();

						return json_decode(json_encode(array_merge($item, $product)), false);

					}

						, $items);

		// Get Sum total of Cart
		$subTotal = Cart::getTotal($products);

		//var_dump(Product::where('id', '<', 4)->get());

		//exit();

		return view('cart', compact('products', 'subTotal'));
	}

	public function delete()
	{
		$request = Request::fetchType('POST');		

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			throw new \Exception("Unauthorized access");
			
		}
		
		// Add item to Cart
		$index = Cart::removeItem($request->id);
	}
}

 ?>