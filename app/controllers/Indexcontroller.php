<?php 

/**
 * Index Controller
 */
namespace App\Controllers;

use App\Classes\Mail;

class Indexcontroller extends Basecontroller
{
	
	function show()
	{

		echo "Indexcontroller<br>";
		echo slug(" Te!st t,h_.-+i!s   script! ");
						
	}
}

 ?>