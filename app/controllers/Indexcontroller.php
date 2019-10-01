<?php 

/**
 * 
 */
namespace App\Controllers;

use App\Classes\Mail;

class Indexcontroller extends Basecontroller
{
	
	function show()
	{
		//echo "This is Indexcontroller";

		$mail = new Mail;

		$datas = ["recipient" => 'aarmsha@gmail.com',
				 "subject"   => 'Test email',
				 "view"      => 'emails/test.php',
				 "body"      => 'This is test email'];

		if ( $mail->send($data) ) {
			echo "Mail sent successfully";
		} else {
			echo "Mail failed";
		}
		
	}
}

 ?>