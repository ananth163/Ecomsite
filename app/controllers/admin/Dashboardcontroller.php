<?php 

namespace App\Controllers\Admin;

use App\Controllers\Basecontroller;

/**
 * Dashboard controller class
 */

class Dashboardcontroller extends Basecontroller
{
	
	function show()
	{
		
		return view('admin/dashboard');
		
	}
}

 ?>