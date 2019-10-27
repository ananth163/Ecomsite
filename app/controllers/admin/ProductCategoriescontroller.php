<?php 

namespace App\Controllers\Admin;

use App\Classes\CSRFHandler;
use App\Classes\Request;
use App\Classes\Session;
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
	 * Delete Product Categories
	 *
	 * @return Response
	 *
	 **/
	public function delete ($id)
	{
		if (!Request::hasType('POST')) {
			
			header('HTTP/1.1 422 Unprocessable entry', true, 422);

			echo json_encode(['errors' => 'Invalid Request']);

			exit();			
		}

		$request = Request::fetchType('POST');

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			header('HTTP/1.1 422 Unprocessable entry', true, 422);

			echo json_encode(['errors' => 'Invalid Token']);

			exit();
		}

		// Get the Record to be deleted
		$record = Category::where('id', $id)->first();
		
		// Delete the Product category
		Category::destroy($id);

		//Add message to session;
		Session::setValueFor('success', "Record '{$record->name}' deleted successfully");
					
		echo json_encode(['success' => 'Record deleted successfully']);

		exit();
										 		  
	}

	/**
	 * Update Product Categories
	 *
	 * @return Response
	 *
	 **/
	public function edit ($id)
	{
		if (!Request::hasType('POST')) {
			
			header('HTTP/1.1 422 Unprocessable entry', true, 422);

			echo json_encode(['errors' => 'Invalid Request']);

			exit();			
		}

		$request = Request::fetchType('POST');

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			header('HTTP/1.1 422 Unprocessable entry', true, 422);

			echo json_encode(['errors' => 'Invalid Request']);

			exit();
		}

		//Validate the request
		$validator = Validator::make($request, ['name' => 
			                                       'required|unique:categories|alpha|min:5']);

		if ($validator->fails()) {
			
			header('HTTP/1.1 422 Unprocessable entry', true, 422);
			
			echo json_encode($validator->errors());
			
			exit();
		}

		// Store the Product category
		Category::where('id', $id)
					->update([
							'name' => $request->name,
						 		]);

		echo json_encode(['success' => 'Record updated successfully']);

		exit();
										 		  
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
			
			//return view('errors/404');
			echo "Invalid request";			
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