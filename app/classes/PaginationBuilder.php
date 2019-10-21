<?php 

// Required to bootstrap Eloquent pagination
use Philo\Blade\Blade;

\Illuminate\Pagination\LengthAwarePaginator::viewFactoryResolver(function () {
            
            $views = __DIR__ . '/../../resources/views' ;

			$cache = __DIR__ . '/../../bootstrap/cache' ;

			$blade = new Blade($views, $cache);
		
            return $blade->view();
        });

\Illuminate\Pagination\LengthAwarePaginator::defaultView('pagination/default');

\Illuminate\Pagination\Paginator::currentPathResolver(function () {
            return isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
        });

\Illuminate\Pagination\Paginator::currentPageResolver(function () {
            return $_GET['page'] ?? 1;
        });

 ?>