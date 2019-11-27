<?php 

/**
 * Index Controller
 */
namespace App\Controllers;



class Indexcontroller extends Basecontroller
{
	
	public function show()
	{

		return view('home');
		
						
	}
}

 ?>