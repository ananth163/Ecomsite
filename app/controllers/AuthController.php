<?php 

/**
 * Auth Controller
 */
namespace App\Controllers;

use App\Classes\CSRFHandler;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Validator;
use App\Models\User;

class Authcontroller extends Basecontroller
{
	/**
	 * Show Registration form
	 *
	 **/	
	public function showRegistration()
	{

		return view('user/register');						
	}

	/**
	 * Show Login form
	 *
	 **/	
	public function showLogin()
	{

		return view('user/login');						
	}

	/**
	 * Register User
	 *
	 **/	
	public function register()
	{
		$request = Request::fetchType('POST');		

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			throw new \Exception("Unauthorized access");
			
		}

		//Validate the request
		$validator = Validator::make($request, ['username' 		   => 
			                                       		'required|min:5|max:15|unique:users|mixed',
			                                    'email' 	   =>
			                                			'required|email|unique:users',
			                                	'password'  => 
			                                			 'required|min:8|max:20|mixed',
			                                	'password2' =>
			                                			 'error:same@Passwords do not match|same:password'
			                                	]);

		if ($validator->fails()) {
			
			return view('user/register', ['errors'  => 
														$validator->errors() ]);
		}

		$pepper = getenv('pepper');

		$pwd_peppered = hash_hmac("sha256", $request->password, $pepper);

		// Store the User record in database
		User::create([
						'username' => $request->username,
						'email'	   => $request->email,
						'password' => password_hash($pwd_peppered, PASSWORD_BCRYPT) ]);

		//var_dump($request);

		//exit();

		Session::setValueFor('success', 'Account created successfully. Please Login');

		Redirect::to('/login');						
	}

	/**
	 * Login User
	 *
	 **/	
	public function login()
	{
		$request = Request::fetchType('POST');		

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			throw new \Exception("Unauthorized access");
			
		}

		//Validate the request
		$validator = Validator::make($request, ['signin' 		   => 
			                                       		'required|mixed',			                                    
			                                	'password'  => 
			                                			 'required|mixed'
			                                	]);

		if ($validator->fails()) {
			
			return view('user/login', ['errors'  => 
													$validator->errors() ]);
		}

		$pepper = getenv('pepper');

		$pwd_peppered = hash_hmac("sha256", $request->password, $pepper);

		// Get the user details
		$user = User::where('username', $request->signin)
			  			->orWhere('email', $request->signin)
			  			->first();

		if(!$user)
		{
			return view('user/login', ['errors'  => 
													(array) 'Username or Password is Incorrect.' ]);
		}
		
		// Check if login is valid
		if (!password_verify($pwd_peppered, $user->password)) {
			
			return view('user/login', ['errors'  => 
													(array) 'Username or Password is Incorrect.' ]);
		}

		//var_dump($user);

		//exit();

		Session::setValueFor('SESSION_USER_ID', $user->id);

		Redirect::to('/');						
	}

	/**
	 * Logout User
	 *
	 **/	
	public function logout()
	{
		Session::clear();

		Redirect::to('/');						
	}
}

 ?>