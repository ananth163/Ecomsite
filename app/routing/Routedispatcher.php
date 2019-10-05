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
		if ( !is_string($target) ) {
			
			throw new \Exception("Target of current route {$target} has incorrect type");
		
		}

		if( strpos($target, '@') == false )
		{

			throw new \Exception("Target of current route {$target} has incorrect separator");

		}

		list( $this->controller, $this->method ) = explode('@', $target); 
		
	}

	/** 
	 * Dispatches matched route
	 *
	 * @return void
	 *
	 **/ 

	protected function dispatch()
	{
		
		if( empty($this->controller) || empty($this->method) )
		{
			
			throw new \Exception('Cannot dispatch : controller or method is empty');
	
		} 

		$controller = new $this->controller();
			
		if ( !is_callable(array($controller, $this->method) ) )
		{
			
			throw new \Exception("The {$this->method} method does not exist in {$controller} controller");

		}

		$controller->{$this->method}(...array_values($this->params));	

	}
	
}


 ?>