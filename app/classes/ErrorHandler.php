<?php

namespace App\Classes;

//use Whoops\Handler\PrettyPageHandler;
//use Whoops\Run;

/**
 * Custom ErrorHandler class
 **/
class ErrorHandler
{
    
    /**
     * Registers an error handler with PHP
     *
     *  Whoops for Local environment
     *  
     *  handleError for Production 
     *
     **/
     public static function register()
     {

     	$environment = getenv('APP_ENV');

        if ( $environment === "local") {
            
            // For local environment instantiate Whoops
            
            $whoops = new \Whoops\Run;

            $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);

            $whoops->register();
                  
        } else {

        	set_error_handler( [ new static, 'handleError' ] );

        }

     } 

    /**
     * Callback function to handle errors with Whoops in local
     *   and send e-mail to admin in case of production errors
     *
     * @param integer $errno contains the level of the error raised
     *
     * @param string $errstr contains the error message
     *
     * @param string $errfile contains the filename that the error was raised in
     *
     * @param integer $errline contains the line number the error was raised at
     *
     * @return boolean  If FALSE is returned then the normal error handler continues.
     *
     **/

    public function handleError( $errno, $errstr, $errfile, $errline )
    {
            
            // For production environment email Admin

            // Get error type
        	$errtype = $this->mapErrorCode( $errno );

        	$errdata = [
        				'type' 	  => $errtype,
        				'message' => $errstr,
        				'file'    => $errfile,
        				'line'	  => $errline ];

            /** returns False if email is not delivered
             * and Default error Handler is then called
             * and error displayed to user
             **/

            $this->emailAdmin( $errdata )->showErrorMessage();

    }

    /**
     * Map an error code into an Error word.
     *
     * @param int $code Error code to map
     *
     * @return string Type of error.
     *
     **/
    protected function mapErrorCode($code)
    {
    
        switch ($code) {
        
            case E_PARSE:			
            						$error = 'Parse Error' ;

            						break;
        
            case E_ERROR:			

            						$error = 'Error' ;

            						break;         						
        
            case E_CORE_ERROR:

             						$error = 'Core Error' ;

            						break;

            case E_COMPILE_ERROR:

            						$error = 'Compile Error' ;

            						break;

            case E_USER_ERROR:
                                	$error = 'User Error';
                                	
                                	break;
        
            case E_WARNING:

            						$error = 'Warning' ;

            						break;

            case E_USER_WARNING:

            						$error = 'User warning' ;

            						break;

            case E_COMPILE_WARNING:

            						$error = 'Compile Warning' ;

            						break;

            case E_RECOVERABLE_ERROR:
                                    $error = 'Recoverable Error';
            						
            						break;
        
        	case E_NOTICE:

            						$error = 'Notice' ;

            						break;

        	case E_USER_NOTICE:
            						$error = 'User Notice';
            						
            						break;
        
        	case E_STRICT:
            						$error = 'Strict';
            						
            						break;
        
        	case E_DEPRECATED:

            						$error = 'Deprecated' ;

            						break;

        	case E_USER_DEPRECATED:
            						$error = 'User Deprecated';
            						
            						break;
        	default:
            						break;
    	}

        return $error;
    }


    /**
     * Sends error messages to Admin
     *
     * @param string $body Body of the email
     *
     * @return $this
     *
     **/
    protected function emailAdmin($body)
    {
        $mail = new Mail;

      	$data = [	'recipient' => getenv('ADMIN_EMAIL'),
					'subject'   => 'An Error Occurred',
					'view'      => 'emails/error.php',
					'body'      => $body ];

        $mail->send($data);

        return $this;
    }

    /**
     * Show error to Browser
     *
     **/
    protected function showErrorMessage()
    {

    	ob_end_clean();

    	view('errors/generic');

    	exit();
    }
}

 ?>
