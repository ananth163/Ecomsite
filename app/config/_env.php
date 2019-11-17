<?php 

use Dotenv\Dotenv;

/** Define BASE_PATH as this project's root directory */
if ( ! defined( 'BASE_PATH' ) ) {
	define('BASE_PATH', realpath(__DIR__."/../../"));
}

$dotenv = Dotenv::create(BASE_PATH);

$dotenv->load();

 ?>