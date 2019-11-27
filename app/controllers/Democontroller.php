<?php 

/**
 * Index Controller
 */
namespace App\Controllers;

use App\Classes\Mail;
use App\Classes\Pagination;
use App\Models\Category;
use App\Models\SubCategory;

class Democontroller extends Basecontroller
{
	
	public function __construct ()
	{
		new Pagination;
	}
	public function show()
	{

		$category = Category::find(1)->with('subcategories')->get();

		//$subcategories = $category->subcategories;

		var_dump($category[0]->subcategories->paginate(3));
		exit();
		
						
	}
}

 ?>