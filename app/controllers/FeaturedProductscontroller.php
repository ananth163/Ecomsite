<?php 

/**
 * Featured products Controller
 */
namespace App\Controllers;

use App\Models\Product;

class FeaturedProductscontroller extends Basecontroller
{
	
	public function show()
	{

		$products = Product::where('featured', 1)->inRandomOrder()->limit(4)->get();

		echo json_encode($products);
		
						
	}
}

 ?>