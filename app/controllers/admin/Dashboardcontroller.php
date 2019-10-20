<?php 

namespace App\Controllers\Admin;

use App\Classes\Request;
use App\Classes\Session;
use App\Controllers\Basecontroller;

/**
 * Dashboard controller class
 */

class Dashboardcontroller extends Basecontroller
{
	
	public function show()
	{
		
		Session::setValueFor('admin', 'Hello Admin');
		
		Session::removeKey('admin');
		
		if (Session::hasKey('admin')) {
			
			$msg = Session::getValueFor('admin');

		} else { $msg = 'Not defne'; }

		return view('admin/dashboard', [ 'admin' => $msg ]);
		
	}

	public function store ()
	{
		
		if (Request::hasType('POST')) {
			var_dump(Request::fetchType('POST'));
		}
	}


}

 ?>