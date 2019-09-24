<?php 

// Load environment variables
require_once(__DIR__ . '/app/config/_env.php');

// Load Autoloader
require_once(__DIR__ . '/vendor/autoload.php');


return [
    'dbname' => getenv('DB_NAME'),
    'user' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'host' => getenv('DB_HOST'),
    'driver' => getenv('DB_DRIVER_MIGRATION'),
];

 ?>