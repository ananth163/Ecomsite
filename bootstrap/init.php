<?php 

use App\Classes\ErrorHandler;
use App\Routedispatcher;

// Start session if not already started
if (!isset($_SESSION))  session_start();

// Load Autoloader
require_once(__DIR__ . '/../vendor/autoload.php');

// Load environment variables
require_once(__DIR__ . '/../app/config/_env.php');

// Load custom error handler
ErrorHandler::load( getenv('APP_ENV') )->register();

// Load Pagination Builder
require_once(__DIR__ . '/../app/classes/PaginationBuilder.php');

// Instantiate Database class
new App\Classes\Database;

// Load routes 
require_once(__DIR__ . '/../app/routing/routes.php');

// Instantiate Routedispatcher
new Routedispatcher($router);


 ?>