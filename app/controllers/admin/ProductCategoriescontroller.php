<?php 

namespace App\Controllers\Admin;

use App\Classes\CSRFHandler;
use App\Classes\Request;
use App\Classes\Validator;
use App\Controllers\Basecontroller;
use App\Models\Category;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * For managing ProductCategories
 */
class ProductCategoriescontroller extends Basecontroller
{
	/**
	 * Show Product Categories
	 *
	 */
	public function show ()
	{
		$categories = Category::all();
		//var_dump($categories);
		//exit();

		return view('admin/categories', compact('categories'));
	}

	/**
	 * Store User updates in Database
	 *
	 */
	public function store ()
	{
		if (!Request::hasType('POST')) {
			
			return view('errors/404');			
		}

		$request = Request::fetchType('POST');

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			return view('errors/generic');
		}

		//Validate input
		$validator = Validator::make($request, ['name' => 
			                                       'unique:categories|min:5|max:8']);

		if ($validator->fails()) {
			
			var_dump($validator->errors());
			exit();
		}

		// Store the user input into Database
		$category = Category::create([
								'name' => $request->name,
							    'slug' => slug($request->name) ]);

		// Send a message to user
		$message = "Record Created";

		$categories = Category::all();

		return view('admin/categories', compact('categories', 'message'));		
	}
}

 ?>