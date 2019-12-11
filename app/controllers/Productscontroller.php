<?php 

/**
 * Featured products Controller
 */
namespace App\Controllers;

use App\Classes\Request;
use App\Models\Product;

class Productscontroller extends Basecontroller
{
	
	public function getFeaturedProducts()
	{

		$products = Product::where('featured', 1)->inRandomOrder()->limit(4)->get();

		echo json_encode(['featured' => $products]);		
						
	}

	public function getProducts()
	{

		$products = Product::where('featured', 0)->skip(0)->limit(8)->get();

		$count = count($products);

		echo json_encode(compact('products', 'count'));		
						
	}

	public function loadMoreProducts()
	{

		$request = Request::fetchType('POST');

		$count = $request->count;

		$next = $request->next;

		$perPage = $count + $next;

		$products = Product::where('featured', 0)->skip(0)->limit($perPage)->get();

		echo json_encode(['products' => $products, 'count' => $perPage]);		
						
	}

	public function show($id)
	{

		$product = Product::where('id', $id)->with('category', 'subcategory')->first();

		//var_dump($product);
		//exit();
		
		if (! $product) {
			return view('errors/404');
		}

		$similarProducts = Product::where('category_id', $product->category_id)
							->where('id', '!=', $id)->inRandomOrder()->limit(8)->get();

		//var_dump($similarProducts->chunk(4));
		//exit();
		return view('product', compact('product', 'similarProducts'));		
						
	}
}

 ?>