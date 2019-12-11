<?php 

/**
 * Payment Controller
 */
namespace App\Controllers;

use App\Classes\CSRFHandler;
use App\Classes\Cart;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Session;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use \Stripe\Exception\SignatureVerificationException;
use \Stripe\PaymentIntent;
use \Stripe\Stripe;
use \Stripe\Webhook;

class Paymentcontroller extends Basecontroller
{
	public function __construct()
	{
		// Verify if user is logged in
		if(!Role::is('admin') || !Role::is('user'))
		{
			Redirect::to('/login');

			exit();
		}
		
	}

	public function showPaymentForm()
	{
		Cart()->saveOrder();

		return view('orders/payment');						
	}

	public function showSuccess()
	{
		$request = Request::fetchType('GET');

		$order = $request->order;

		Cart::clear();

		return view('orders/success', compact('order'));						
	}

	public function showFail()
	{
		
		$request = Request::fetchType('POST');

		$message = $request->message;

		return view('orders/fail', compact('message'));						
	}

	/**
	 * Get Payment Intent
	 * 
	 * @return string Client secret
	 *
	 **/
	public function getPaymentIntent()
	{
		$request = Request::fetchType('POST');		

		// Check if Request token is valid
		if (!CSRFHandler::validateToken($request->token)) {
			
			throw new \Exception("Unauthorized access");
			
		}

		$secret = getenv('STRIPE_SECRET_KEY');

		// Set Stripe secret key
		Stripe::setApiKey($secret);

		$intent = PaymentIntent::create([
    		'amount' => $request->amount,
    		'currency' => $request->currency
		]);

		Payment::create(['user_id' 		 => $request->user_id,
						 'client_secret' => $intent->client_secret,
						 'order_no'		 => $request->order_no,
						 'amount'		 => $request->amount,
						 'status'		 => 'Pending'
						 ]);

		echo json_encode(['client_secret' => $intent->client_secret]);
	}

	/**
	 * Verify Payment 
	 *
	 **/
	public function verifyPayment()
	{
		//$request = Request::fetchType('POST');

		$secret = getenv('STRIPE_SECRET_KEY');

		// Set Stripe secret key
		Stripe::setApiKey($secret);

		// If you are testing your webhook locally with the Stripe CLI you
		// can find the endpoint's secret by running `stripe listen`
		// Otherwise, find your endpoint's secret in your webhook settings in the Developer Dashboard
		$endpoint_secret = getenv('STRIPE_WEBHOOK_SECRET');

		$payload = @file_get_contents('php://input');
		$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
		$event = null;

		try {
		    $event = Webhook::constructEvent(
		        $payload, $sig_header, $endpoint_secret
		    );
		} catch(\UnexpectedValueException $e) {
		    // Invalid payload
		    http_response_code(400);
		    exit();
		} catch(SignatureVerificationException $e) {
		    // Invalid signature
		    http_response_code(400);
		    exit();
		}

		$content = 'var_dump($event)';

		$file = 'testdata.txt';

		file_put_contents($file, $content);

		// Handle the event
		switch ($event->type) {
		    case 'payment_intent.succeeded':
		        
		        $paymentIntent = $event->data->object; // contains a StripePaymentIntent
		        //handlePaymentIntentSucceeded($paymentIntent);
		        
		        // Mark the payment to Success
		        $payment = Payment::where('client_secret', $paymentIntent->client_secret );
		        					
		        $payment->update(['status' => 'Success']);

		        Order::where('order_no', $payment->first()->order_no)
		        	  ->update(['status' => 'Completed']);

		        break;

		    case 'payment_intent.payment_failed':
		    		    	
		    		    	$paymentIntent = $event->data->object; // contains a StripePaymentIntent
		    		    	
		    		    	# Mark payment as failure
		    				Payment::where('client_secret', $paymentIntent->client_secret )
		        					->update(['status' => 'Failed']);
		    		    	break;	

		    // ... handle other event types
		    default:
		        // Unexpected event type
		        http_response_code(400);
		        exit();
		}
		
		http_response_code(200);
			}

	
}

 ?>