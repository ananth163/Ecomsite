<?php 

namespace App\Controllers\Admin;

use App\Classes\CSRFHandler;
use App\Classes\FileHandler;
use App\Classes\Pagination;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Session;
use App\Classes\Validator;
use App\Controllers\Basecontroller;
use App\Models\Product;

/**
 * Manage Products
 */

class Productscontroller extends Basecontroller
{
	
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

		//Get the paginated products result
		$this->products = Product::paginate(10);

	}

	/**
	 * Show Form for Product creation
	 *
	 * @return Response
	 *
	 */
	public function showForm($id = null)
	{
		
		if (! isset($id)) {
			
			return view( 'admin/products/create' );
		}

		$product = Product::where('id', $id)
							->with('category', 'subCategory')->first();

		return view( 'admin/products/edit', compact('product') );
		
	}

	/**
	 * Show Product inventory
	 *
	 * @return Response
	 *
	 */
	public function show ()
	{
		return view('admin/products/inventory', ['products'  => 
												  		$this->products]	  );
	}

	/**
	 * Delete Products
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

		// Get the Product to be deleted
		$product = Product::find($id);

		$ds = DIRECTORY_SEPARATOR;

		// Move product image to archive
		$imagePath = FileHandler::move($product->image_path, "images{$ds}archive{$ds}products");

		// Update path in database
		$product->image_path = $imagePath;

		$product->save();

		// Delete the Product
		$product->delete();

		//Add message to session;
		Session::setValueFor('success', "Record '{$product->name}' deleted successfully");
					
		echo json_encode(['success' => 'Record deleted successfully']);

		exit();
										 		  
	}

	/**
	 * Update Products
	 *
	 * @return Response
	 *
	 **/
	public function edit ($id)
	{
		
		if (!Request::hasType('POST')) {
			
			return view('errors/generic');			
		}

		$post = Request::fetchType('POST', Request::FETCH_ASSOC);

		$file = Request::fetchType('file', Request::FETCH_ASSOC);

		$request = json_decode(json_encode(array_merge($post, $file)), Request::FETCH_OBJ);

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			return view('errors/generic');
		}

		$product = Product::with('category', 'subCategory')->findorfail($id);
		
		//Validate the request
		$validator = Validator::make($request, ['name' 		   => 
			                                       		'required|min:3|max:70|mixed',
			                                    'price' 	   =>
			                                			'required|min:2|numeric',
			                                	'description'  => 
			                                			 'required|max:500|mixed',
			                                	'stock' 	   => 'required',
			                                	'category' 	   => 'required',
			                                	'subcategory'  => 'required',                                	
			                                	'productImage' =>
			                                			 'file|image|min:2048|max:1048576']);

		if ($validator->fails()) {
			
			return view('admin/products/edit', ['errors'  => 
														$validator->errors(),
												'product' =>
														$product ]);
		}		

		// If file modified, delete old file and update record
		if (! empty($file["productImage"]["name"])) {
			
			$ds = DIRECTORY_SEPARATOR;

			$oldImage = $product->image_path;

			// Store the uploaded file
			$imagePath = FileHandler::storeAs($file["productImage"],
											 "images{$ds}upload{$ds}products");

			if(! FileHandler::delete($oldImage) )
			{
				throw new \Exception("Error while deleting {$oldImage}");
				
			}

			$product->image_path = $imagePath;

		}

		// Save records to Database
		$product->name = $request->name;

		$product->price = $request->price;

		$product->description = trim($request->description);

		$product->stock = $request->stock;

		$product->category_id = $request->category;

		$product->sub_category_id = $request->subcategory;

		$product->save();		

		// Add message to session and redirect to inventory
		Session::setValueFor('success', "Record '{$product->name}' updated successfully");

		Redirect::to('/admin/products/manage_inventory');
										 		  
	}

	/**
	 * Store a new Product
	 *
	 * @return Response
	 *
	 */
	public function store ()
	{
		
		if (!Request::hasType('POST')) {
			
			return view('errors/generic');			
		}

		$post = Request::fetchType('POST', Request::FETCH_ASSOC);

		$file = Request::fetchType('file', Request::FETCH_ASSOC);

		$request = json_decode(json_encode(array_merge($post, $file)), Request::FETCH_OBJ);

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			return view('errors/generic');
		}

		//Validate the request
		$validator = Validator::make($request, ['name' 		   => 
			                                       		'required|min:3|max:70|unique:products|mixed',
			                                    'price' 	   =>
			                                			'required|min:2|numeric',
			                                	'description'  => 
			                                			 'required|max:500|mixed',
			                                	'stock' 	   => 'required',
			                                	'category' 	   => 'required',
			                                	'subcategory'  => 'required',                              	
			                                	'productImage' =>
			                                			 'file|required|image|min:2048|max:1048576']);

		if ($validator->fails()) {
			
			return view('admin/products/create', ['errors'  => 
														$validator->errors() ]);
		}

		$ds = DIRECTORY_SEPARATOR;

		// Store the uploaded file
		$imagePath = FileHandler::storeAs($file["productImage"], "images{$ds}upload{$ds}products");

		// Store Product in database
		Product::create([
						'name' 		  	  => $request->name,
						'price' 	  	  => $request->price,
						'description' 	  => $request->description,
						'stock' 	  	  => $request->stock,
						'category_id' 	  => $request->category,
						'sub_category_id' => $request->subcategory,
						'image_path'	  => $imagePath]);

		// Add message to session and redirect to inventory
		Session::setValueFor('success', "Record created successfully");

		Redirect::to('/admin/products/manage_inventory');

	}


}

 ?>