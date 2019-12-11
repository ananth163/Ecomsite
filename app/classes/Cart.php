<?php 

namespace App\Classes;

use App\Classes\Session;
use App\Models\Order;
use App\Models\Product;

/**
 * Cart handler
 **/

class Cart 
{
	/**
	 * @var int $tax 
	 *
	 **/
	protected $tax = 0.05;

	/**
	 * @var int $shipping 
	 *
	 **/
	protected $shipping = 15;

	/**
	 * Get all Items in Cart
	 *
	 * @return array Items ['product_id' , 'quantity']
	 *
	 **/
	
	public function getItems()
	{
		if (!Session::hasKey('user_cart')) {
			
			return [];
		}

		// Get products already in the cart
		return Session::getValueFor('user_cart');
		
	}

	/**
	 * Get Index of the Product in ProductList array
	 *
	 * @param array $product
	 *
	 * @param array #productList
	 *
	 * @return int Index of the product or false
	 *
	 **/
	public function getIndex($product, $productList)
	{
		// Check if product is already present in Cart
		return array_search($product['product_id'], array_column($productList, 'product_id'));
	}

	/**
	 * Add Item to the Cart
	 *
	 * If item already present in the Cart, increment the quantity. Otherwise
	 * append it to Session array
	 *
	 * @param array $product ['product_id' => product_id, 'quantity' => quantity]
	 *
	 **/
	
	public function addItem($product)
	{
		// Get products already in the cart
		$productList = $this->getItems();

		// Get index of the product in Cart
		$index = $this->getIndex($product, $productList);

		// If not present, add it to Cart
		if ($index === false)
		{
			array_push($productList, $product);
		
		} else {
			// If already present, increase the quantity of product
			$productList[$index]['quantity']++;
		}		
				
		Session::setValueFor('user_cart', $productList);
		
	}

	/**
	 * Update the Cart
	 *
	 * If item already present in the Cart, update the quantity. Otherwise
	 * throw and exception
	 *
	 * @param array $product ['product_id' => product_id, 'quantity' => quantity]
	 *
	 **/
	
	public function updateItem($product)
	{
		// Get products already in the cart
		$productList = $this->getItems();

		// Get index of the product in Cart
		$index = $this->getIndex($product, $productList);

		// If not present, throw an exception
		if ($index === false)
		{
			throw new \Exception("Malicious activity. Tried to update Item not in Cart");			
		
		}		

		// If already present, update the quantity of product
		$productList[$index]['quantity'] = $product['quantity'];
				
		Session::setValueFor('user_cart', $productList);		
	}

	/**
	 * Remove Item from the Cart
	 *
	 * If item already present in the Cart, remove. Otherwise
	 * throw exception
	 *
	 * @param int $productID 
	 *
	 **/	
	public function removeItem($productID)
	{
		// Get products already in the cart
		$productList = $this->getItems();

		// Check if product is already present in Cart
		$index = array_search($productID, array_column($productList, 'product_id'));

		// If not present, throw an Exception
		if ($index === false)
		{
			throw new \Exception("Malicious activity. Tried to Delete Item not in Cart");	
		
		}		

		// If already present, remove the product
		array_splice($productList, $index, 1);

		if (!empty($productList)) {
			
			Session::setValueFor('user_cart', $productList);

			exit();
		}
				
		Session::flush('user_cart');		
	}

	/**
	 * Get Total No. of Items in Cart
	 *
	 * @return int No. of items in Cart
	 *
	 **/
	
	public function getItemsTotal()
	{
		return count($this->getItems());		
	}

	/**
	 * Checks if Cart is Empty
	 *
	 * @return bool
	 *
	 **/
	 public function isEmpty( )
	 {
	    return $this->getItemsTotal() < 1;
	 }

	 /**
	 * Get all Product details in Cart
	 *
	 * @return array $products Product details of each item in cart
	 *
	 **/
	
	public function getProducts()
	{
		// Get Items from Cart
		$items = $this->getItems();

		$products = array_map( function($item) {

						$product = Product::where('id', $item['product_id'])->first()->attributesToArray();

						return json_decode(json_encode(array_merge($item, $product)), false);

					}

						, $items);

		return $products;
		
	}	

	

	/**
	 * Get Sum Total of Items in Cart
	 *
	 * @return int $total Sum Total of items in Cart
	 *
	 **/
	
	public function getSubTotal()
	{
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
		return $this->getSubTotal() * $this->tax;
		
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

	/**
	 * Get Amount in Cents
	 *
	 * @return int $total Amount to pay in Cents
	 *
	 **/
	
	public function getAmountInCents()
	{
		return round( (float) $this->getAmount(), 2) * 100;
		
	}

	/**
	 * Clear all Items in Cart
	 *
	 **/
	
	public function clear()
	{
		// Remove cart from Session
		Session::removeKey('order_no');
		
		Session::removeKey('user_cart');
		
	}

	public function createOrder()
	{
		if (!Session::hasKey('order_no')) {
			
			$orderNo = strtoupper(uniqid());

			Session::setValueFor('order_no', $orderNo);
		}
		
	}

	public function getOrderNo()
	{
		if (!Session::hasKey('order_no')) {
			
			$this->create();			
		}

		return Session::getValueFor('order_no');
		
	}

	public function saveOrder($status = 'Pending')
	{
		
		$orderNumber = $this->getOrderNo();

		$userID = getUser()->id;

		$productList = Cart::getItems();

		foreach ($productList as $product) {
			//If product already present in order, update record
			// If not, create new record
			$order = Order::updateOrCreate(
								['order_no'   => $orderNumber, 
								 'user_id'    => $userID,
								 'product_id' => $product['product_id']],
								['status'     => $status,
								 'total'	  => $product['quantity'] ]
			);

		}

		// Get records from Order, which are not present in Session
		// and Delete them

		$order = Order::where('order_no', $orderNumber)
						->where('user_id', $userID)
						->whereNotIn('product_id', array_column($productList, 'product_id'))
						->delete();

		
		
	}

	
}

 ?>