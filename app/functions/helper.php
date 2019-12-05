<?php 

use App\Classes\Session;
use App\Models\User;
use Philo\Blade\Blade;

/**
 * Function to load views from Blade Templating Engine
 *
 * @param string $path Path to the view files
 *
 * @param array $data
 *
 **/

function view( $path = '', $data = [] )
{
	$views = __DIR__ . '/../../resources/views' ;

	$cache = __DIR__ . '/../../bootstrap/cache' ;

	$blade = new Blade($views, $cache);

	echo $blade->view()->make($path, $data)->render();
}

/**
 * Get the evaluated view contents for the given view
 * 
 * @param string $view
 * 
 * @param array $data Data to pass to the view
 *
 * @return string $content HTML content from the view
 *
 **/
 function make( $view, $data )
 {
 	
 	extract($data);

 	// Start Output buffering
 	ob_start();

 	require_once( __DIR__ . "/../../resources/views/{$view}");

 	// Get contents of the file and end output buffering
 	$content = ob_get_clean();

 	return $content;

 } 

 /**
  * Converts string into slug
  *
  * @param string $name
  *
  * @return string slug
  *
  **/
 function slug( $string )
 {
 	//Remove all characters other than letters, numbers, whitespace and underscore
 	$string = preg_replace('/[^\_\p{L}\p{N}\p{Z}]+/u', '', mb_strtolower($string));
 	
 	// Replace underscores and whitespaces with a dash
 	$string = preg_replace('/[\_\s]+/', '-', $string);

 	// Remove whitespaces at beginning and end of the string
 	$string = trim($string, '-');

 	return $string;
 }

 /**
  * Checks if User authenticated
  *
  * @return bool
  *
  **/
 function isAuthenticated( )
 {
    return Session::hasKey('SESSION_USER_ID');
 }

 /**
  * Get the logged In User details
  *
  * @return User Collection
  *
  **/
 function getUser( )
 {
    if (!isAuthenticated()) {
      
      return '';
    }

    return User::findorFail(Session::getValueFor('SESSION_USER_ID'));
 }

 
 ?>