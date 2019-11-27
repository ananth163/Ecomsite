<?php 

namespace App\Controllers\Admin;

use App\Classes\CSRFHandler;
use App\Classes\Mail;
use App\Classes\Pagination;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Validator;
use App\Controllers\Basecontroller;
use App\Models\SubCategory;
use Illuminate\Database\Capsule\Manager as Capsule;


/**
 * For managing SubCategories
 */
class SubCategoriescontroller extends Basecontroller
{
	
	/**
	 * Instantiate the controller
	 *
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 * 
	 **/
	public function __construct()
	{
		// Inject Pagination container
		new Pagination;

		// Inject mailer
		$this->mail = new Mail;  	   	     
						
	}

	/**
	 * Delete SubCategories
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
		$record = SubCategory::where('id', $id)->first();
		
		// Delete the Product category
		SubCategory::destroy($id);

		//Add message to session;
		//Session::setValueFor('success', "Record '{$record->name}' deleted successfully");
					
		echo json_encode(['success' => 'Record deleted successfully']);

		exit();
										 		  
	}

	/**
	 * Update SubCategories
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
			                                       'required|unique:categories|alpha']);

		if ($validator->fails()) {
			
			header('HTTP/1.1 422 Unprocessable entry', true, 422);
			
			echo json_encode($validator->errors());
			
			exit();
		}

		// Store the Subcategory
		try{

			SubCategory::where('id', $id)
						->update([
								'name' => $request->name,
								'category_id' => $request->category_id
						 		]);
		} catch(\Illuminate\Database\QueryException $ex) {

			// Display error message to user and send error to Admin
			header('HTTP/1.1 422 Unprocessable entry', true, 422);

			echo json_encode(['errors' => 'Invalid Update']);

			$errdata = [
        				'type' 	  => 'QueryException',
        				'message' => $ex->getMessage()
        				  ];

			$data   =  ['recipient' => getenv('ADMIN_EMAIL'),
						'subject'   => 'An Exception Occurred',
						'view'      => 'emails/exception.php',
						'body'      => $errdata ];

			$this->mail->send($data);

			exit();
		}
		

		// Get the Updated record
		$subCategory = SubCategory::where('id', $id)->first();

		return view('admin/products/subcategories/updatedSubCategory', compact('subCategory') );

		exit();
										 		  
	}
	
	/**
	 * Show SubCategories
	 *
	 * @return Response
	 *
	 */
	public function show ($id)
	{
		//Get list of SubCategories for given category_id
		$subCategories = SubCategory::where('category_id', $id);

        // If a category is selected, return list of Subcategories
        $selected = Request::query('selected');

        if (! empty($selected)) {
        	
        	echo json_encode($subCategories->get());

        	exit();
        }

        // Paginate the result
        $subCategories = $subCategories->paginate(3, ['*'], 'p2');
		
		return view('admin/products/subcategories/subcategories', compact('subCategories'));
	}

	/**
	 * Store a new Sub Category
	 *
	 * @return Response
	 *
	 */
	public function store ()
	{
		if (!Request::hasType('POST')) {
			
			//return view('errors/404');
			header('HTTP/1.1 422 Unprocessable entry', true, 422);

			echo json_encode(['errors' => 'Invalid Request']);

			exit();			
		}

		$request = Request::fetchType('POST');

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			//return view('errors/generic');
			header('HTTP/1.1 422 Unprocessable entry', true, 422);

			echo json_encode(['errors' => 'Invalid Token']);

			exit();
		}

		//Validate the request
		$validator = Validator::make($request, ['name' => 
			                                       'required|unique:sub_categories|mixed']);

		if ($validator->fails()) {
			
			header('HTTP/1.1 422 Unprocessable entry', true, 422);
			
			echo json_encode($validator->errors());
			
			exit();
		}

		// Store the Product category
		SubCategory::create([
						'name' 			=> $request->name,
						'slug' 			=> slug($request->name),
						'category_id'	=> $request->category_id ]);

		echo json_encode(['success' => 'Record created successfully']);

		exit();		
	}
}

 ?>