<?php 

namespace App\Classes;

use App\Classes\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Philo\Blade\Blade;

/**
 * Setup pagination
 **/
class Pagination {
	
	/**
	 * Instantiate the paginator
	 *
	 **/
	public function __construct ()
	{
		LengthAwarePaginator::viewFactoryResolver(function () {
            
            $views = ABSPATH . 'resources/views' ;

			$cache = ABSPATH . 'bootstrap/cache' ;

			$blade = new Blade($views, $cache);
		
            return $blade->view();
        });

		//\Illuminate\Pagination\LengthAwarePaginator::defaultView('pagination/default');

		Paginator::currentPathResolver(function () {
           
            return isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
        });

		Paginator::currentPageResolver(function ($pageName = 'page') {
            //return $_GET['p1'] ?? 1;
			$page = Request::query($pageName);

            if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
                return (int) $page;
            }

            return 1;

        });

	}
}


 ?>