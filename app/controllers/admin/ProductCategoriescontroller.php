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
	 * Show all the product categories of application
	 *
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 * 
	 **/
	public function index($perPage)
	{
		//Get the paginated categories result
		return $categories = Category::paginate($perPage);
	}

	/**
	 * Show Product Categories
	 *
	 * @return Response
	 *
	 */
	public function show ()
	{
		return view('admin/products/categories', ['categories' => 
												  $this->index(5)]);
	}

	/**
	 * Store a new Product Category
	 *
	 * @return Response
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

		//Validate the request
		$validator = Validator::make($request, ['name' => 
			                                       'required|unique:categories|alpha']);

		if ($validator->fails()) {
			
			return view('admin/products/categories', ['categories' => $this->index(5),
										 		  	  'errors'  => $validator->errors()]);
		}

		// Store the Product category
		Category::create([
						'name' => $request->name,
						'slug' => slug($request->name) ]);

		return view('admin/products/categories', ['categories' => $this->index(5),
										 		  'success'  => 'Category created']);		
	}
}

 ?>