<?php 

use Philo\Blade\Blade;

/**
 * Function to load views from Blade Templating Engine
 *
 * @param string $path Path to the view files
 *
 * @param array $data
 *
 **/

function view($path, array $data = [])
{
	$views = __DIR__ . '/../../resources/views' ;
	$cache = __DIR__ . '/../../bootstrap/cache' ;

	$blade = new Blade($views, $cache);

	echo $blade->view()->make($path, $data)->render();
}

 ?>