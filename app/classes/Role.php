<?php

namespace App\Classes;

use App\Classes\Session;

/** 
 *Handling User roles
 *
 **/

class Role {

	/**
	 * Check if Role matches the provided one
	 *
	 * @param string $role
	 *
	 * @return bool
	 *
	 **/	
	public function is ($role)
	{
		$message = 'You are not authorized to view this page';

		if (!isAuthenticated() || getUser()->role != $role)
		 {
			Session::setValueFor('error', $message);

			//var_dump($_SESSION);

			//exit();
		 	
		 	return false;
		 }

		return true;
	}
}

?>