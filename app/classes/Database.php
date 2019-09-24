<?php 

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;



/**
 * A DB Helper class to handle Databases and to initialize DB connections
 **/

class Database {
	
	/**
	 * Construct method. 
	 *
	 **/
	public function __construct ()
	{
		
		$db = new Capsule;

		$db->addConnection([
    'driver'    => getenv('DB_DRIVER'),
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USERNAME'),
    'password'  => getenv('DB_PASSWORD'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
	]);

	// Make this Capsule instance available globally via static methods... 
	$db->setAsGlobal();

	}

}

 ?>