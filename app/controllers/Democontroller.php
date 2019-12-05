<?php 

/**
 * Index Controller
 */
namespace App\Controllers;

use App\Classes\Session;
use App\Models\Product;


class Democontroller extends Basecontroller
{
	
	public function show()
	{

		$product = Product::where('id', 1)->first()->attributesToArray();

		var_dump($product);		

		exit();
		
						
	}
}

 ?>