<?php 

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;



/**
 * A DB Helper class to handle Databases and to initialize DB connections
 **/

class Database {
	
	/**
	 * Create a new Database connection. 
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

	// Set the event dispatcher used by Eloquent models... (optional)
	$db->setEventDispatcher(new Dispatcher(new Container));

	// Make this Capsule instance available globally via static methods... 
	$db->setAsGlobal();

	// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
	$db->bootEloquent();

	}

}

 ?>