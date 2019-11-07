<?php 

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

/** Mailer class to send mails 
   **/

class Mail {
	
	/**
	 * @var object Stores object of PHPMailer class
	 **/
	protected $mail;

	/**
	 * Create an instance of Mail
	 **/
	public function __construct ()
	{
		// Instantiation and passing `true` to enable exceptions
		$this->mail = new PHPMailer(true);

		$this->setup();

	}

	/**
	 * Setup required mail settings 
	 **/
	protected function setup()
	{
		//Server settings                  
    	
    	//Set AuthType
    	$this->mail->AuthType = 'LOGIN';

    	// Send using SMTP
    	$this->mail->isSMTP();                                            
    	
    	// Set the SMTP server to send through
    	$this->mail->Host       = getenv('SMTP_HOST');                    
    	
    	// Enable SMTP authentication
    	$this->mail->SMTPAuth   = true;                                   
    	
    	// SMTP username
    	$this->mail->Username   = getenv('SMTP_USERNAME');                     
    
    	// SMTP password
    	$this->mail->Password   = getenv('SMTP_PASSWORD');                               
    
    	// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    	$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    	/**
    	 * Todo: Remove this once app deployed to PROD environment
    	 *
    	 **/
    	// Workaround for SSL connection failure in local environment
    	$this->mail->SMTPOptions = array(
    		'ssl' => array(
        	'verify_peer' => false,
        	'verify_peer_name' => false,
        	'allow_self_signed' => true
    			)
			); 

    	$environment = getenv('APP_ENV');

    	if ($environment == 'local') {
    		// Enable verbose debug output
    		//$this->mail->SMTPDebug = SMTP::DEBUG_SERVER; 

    		// Workaround for SSL connection failure in local environment
    		$this->mail->SMTPOptions = array(
    		'ssl' => array(
        	'verify_peer' => false,
        	'verify_peer_name' => false,
        	'allow_self_signed' => true
    			)
			);  
    	}    	      
    	
    	// TCP port to connect to
    	$this->mail->Port       = getenv('SMTP_PORT');  

	}

	/**
	 * To send e-mails
	 *
	 * @param array $data 
	 *
	 * $data = ['recipient' => '',
	 *			'subject'   => '',
	 *			'view'      => '',
	 *			'body'      => ''];
	 *
	 * @return bool PHPMailer::send() True if mail sent successfully
	 *
	 **/
	public function send ( $data )
	{
		
		try {
			    //Recipients    			
    			$this->mail->addAddress($data['recipient']);     // Add a recipient
    
    			// Content
    
    			// Set email format to HTML
    			$this->mail->isHTML(true); 

    			$this->mail->setFrom('from@example.com', 'Mailer');                               
    			
    			$this->mail->Subject = $data['subject'];
    
    			$this->mail->Body    = make( $data['view'], array( 'body' => $data['body'] ) );
    
    			return $this->mail->send();

		} catch (Exception $e) {
    
    			echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
		
		}

	}
}


 ?>


