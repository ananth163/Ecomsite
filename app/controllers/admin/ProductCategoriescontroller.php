<?php 

namespace App\Controllers\Admin;

use App\Classes\CSRFHandler;
use App\Classes\Pagination;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Session;
use App\Classes\Validator;
use App\Controllers\Basecontroller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Capsule\Manager as Capsule;


/**
 * For managing ProductCategories
 */
class ProductCategoriescontroller extends Basecontroller
{
	
	/**
     * Paginated Categories.
     *
     * @var Illuminate\Pagination\LengthAwarePaginator
     */
    protected $categories;

    /**
	 * Instantiate the controller
	 *
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 * 
	 **/
	public function __construct()
	{
		// Verify if user is admin
		if(!Role::is('admin'))
		{
			Redirect::to('/login');

			exit();
		}

		// Inject Pagination container
		new Pagination;

		//Get the paginated categories result
		$this->categories = Category::paginate(10, ['*'], 'p1');

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

		// Get the Category to be deleted
		$category = Category::find($id);
		
		// Implement cascade Delete
		
		// Delete SubCategories associated with this Category
		$category->subcategories()->delete();

		// Delete the Category
		$category->delete();

		//Add message to session;
		Session::setValueFor('success', "Record '{$category->name}' deleted successfully");
					
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
		return view('admin/products/categories/categories', ['categories' 	  => 
												  				    $this->categories]	  );
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
			
			return view('admin/products/categories/categories', ['categories' => 
													  						$this->categories,
										 		  	  			 'errors'  => 
										 		  	  			 			$validator->errors()]);
		}

		// Store the Product category
		Category::create([
						'name' => $request->name,
						'slug' => slug($request->name) ]);

		// Update the paginated result
		$this->categories = Category::paginate(10, ['*'], 'p1');

		return view('admin/products/categories/categories', ['categories' => 
												  						$this->categories,
												  			 'success'  => 
												  			 			'Category created']);		
	}
}

 ?>