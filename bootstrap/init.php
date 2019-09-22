<?php 

use App\Routedispatcher;

// Start session if not already started

if (isset($_SESSION))  start_session();


// Load environment variables
require_once(__DIR__ . '/../app/config/_env.php');

// Load Autoloader
require_once(__DIR__ . '/../vendor/autoload.php');

// Load routes 
require_once(__DIR__ . '/../app/routing/routes.php');

// Instantiate Routedispatcher
new Routedispatcher($router);


 ?>