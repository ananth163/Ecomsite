<?php 

namespace App;

use AltoRouter;

class Routedispatcher {
	
	/**
	 * @var mixed
	 **/
	protected $match;

	/**
	 * @var array
	 **/

	protected $params;

	/**
	 * @var string
	 **/

	protected $controller;

	/**
	 * @var string
	 **/

	protected $method;

	/** 
	 * Constructor method
	 *
	 * @param object $router An object of AltoRouter class
	 *
	 **/

	public function __construct (AltoRouter $router)
	{
		
		$this->match = $router->match();

		// Parse & dispatch target if there is a match
		if ($this->match) {

			$this->params = $this->match['params'];

			$this->parsetarget($this->match['target']);
			
			$this->dispatch();

		} else {
			
			view('errors/404');

		}
		
	}

	/** 
	 * Parses the target into valid controller and method properties
	 * 
	 * @param string $target in format Controller@method
	 *
	 * @return void
	 *
	 **/

	protected function parsetarget( $target )
	{
		if (is_string($target)) {
			
			if( strpos($target, '@') !== false ) {

				list( $this->controller, $this->method ) = explode('@', $target);

			} else {

				throw new \Exception("Target of current route {$target} has incorrect separator");
			}
		} else {
			
			throw new \Exception("Target of current route {$target} has incorrect type");

		}
		

	}

	/** 
	 * Dispatches matched route
	 *
	 * @return void
	 *
	 **/ 

	protected function dispatch()
	{
		if( !empty($this->controller) && !empty($this->method) )
		{
			//Instantiate Controller
			$controller = new $this->controller();
			
			if (is_callable(array($controller, $this->method))) {
			
				$controller->{$this->method}(...array_values($this->params));

			} else {
			
				throw new \Exception("The {$this->method} does not exist in {$controller}");

			}


		} else {

			throw new \Exception('Cannot dispatch : controller or method is empty');
		}		


	}

	
}


 ?>