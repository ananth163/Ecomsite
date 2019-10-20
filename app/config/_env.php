<?php 

use Dotenv\Dotenv;

define('BASE_PATH', realpath(__DIR__."/../../"));

//require_once(BASE_PATH . '/vendor/autoload.php');

$dotenv = Dotenv::create(BASE_PATH);

$dotenv->load();

 ?>