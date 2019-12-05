<?php 

namespace App\Classes;

use App\Classes\Session;

/**
 * Cart handler
 **/

class Cart 
{
	/**
	 * Add Item to the Cart
	 *
	 * If item already present in the Cart, increment the quantity. Otherwise
	 * append it to Session array
	 *
	 * @param array $product ['product_id' => product_id, 'quantity' => quantity]
	 *
	 **/
	
	public static function addItem($product)
	{
		// Get products already in the cart
		$productList = empty(Session::getValueFor('user_cart')) ? [] : Session::getValueFor('user_cart');

		// Check if product is already present in Cart
		$index = array_search($product['product_id'], array_column($productList, 'product_id'));

		// If not present, add it to Cart
		if ($index === false)
		{
			array_push($productList, $product);
		
		}		

		// If already present, increase the quantity of product
		$productList[$index]['quantity']++;
				
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
	
	public static function removeItem($productID)
	{
		// Get products already in the cart
		$productList = empty(Session::getValueFor('user_cart')) ? [] : Session::getValueFor('user_cart');

		// Check if product is already present in Cart
		$index = array_search($productID, array_column($productList, 'product_id'));

		// If not present, throw an Exception
		if ($index === false)
		{
			throw new Exception("Malicious activity. Tried to Delete Item not in Cart");	
		
		}		

		// If already present, remove the product
		array_splice($productList, $index, 1);

		if (!empty($productList)) {
			
			Session::setValueFor('user_cart', $productList);
		}
				
		Session::flush('user_cart');		
	}	

	/**
	 * Get Total No. of Items in Cart
	 *
	 * @return int No. of items in Cart
	 *
	 **/
	
	public static function getItemsTotal()
	{
		// Get Total items in the cart
		return count(Session::getValueFor('user_cart'));
		
	}

	/**
	 * Get Sum Total of Items in Cart
	 *
	 * @return int $total Sum Total of items in Cart
	 *
	 **/
	
	public static function getTotal($products)
	{
		$total = 0;

		foreach ($products as $product) {
			
			$total += $product->quantity * $product->price;
		}

		return $total;
		
	}

	/**
	 * Get all Items in Cart
	 *
	 * @return array $products
	 *
	 **/
	
	public static function getItems()
	{
		// Get products already in the cart
		return empty(Session::getValueFor('user_cart')) ? [] : Session::getValueFor('user_cart');
		
	}
}

 ?>