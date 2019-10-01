<?php 

use App\Classes\ErrorHandler;
use App\Routedispatcher;

// Start session if not already started

if (isset($_SESSION))  start_session();


// Load environment variables
require_once(__DIR__ . '/../app/config/_env.php');

// Load Autoloader
require_once(__DIR__ . '/../vendor/autoload.php');

// Instantiate Database class
new App\Classes\Database;

// Load custom error handler
ErrorHandler::register();

//set_error_handler( 'handleError' );



 /*           $whoops = new \Whoops\Run;

            $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);

            $whoops->register();*/

// Load routes 
require_once(__DIR__ . '/../app/routing/routes.php');

// Instantiate Routedispatcher
new Routedispatcher($router);


 ?>