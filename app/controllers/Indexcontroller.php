<?php 

/**
 * Index Controller
 */
namespace App\Controllers;

use App\Classes\Mail;
use App\Classes\Pagination;
use App\Models\Category;
use App\Models\SubCategory;

class Indexcontroller extends Basecontroller
{
	
	public function __construct ()
	{
		new Pagination;
	}
	public function show()
	{

		$subCategory = Category::find(1);

		var_dump($subCategory->name);		

		//echo "No SubCategories available"; count(Category::find(26)->subcategories) >= 1

		//view('demo');
		
						
	}
}

 ?>