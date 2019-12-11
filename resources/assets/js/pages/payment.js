(function () {
	
	'use strict';

	SITE.home.payment = function() {
		
		// Create a Stripe client.
		var stripe = Stripe('pk_test_QZRSXCzK4ss2Imsg2KXkvT3y00jJwSf1P7');
		
		// Create an instance of Elements.
		var elements = stripe.elements();
		
		// Custom styling passed to options when creating an Element.
		var style = {
		  base: {
		    color: '#32325d',
		    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
		    fontSmoothing: 'antialiased',
		    fontSize: '16px',
		    '::placeholder': {
		      color: '#aab7c4'
		    }
		  },
		  invalid: {
		    color: '#fa755a',
		    iconColor: '#fa755a'
		  }
		};
		
		// Create an instance of the card Element.
		var card = elements.create('card', {style: style});

		// Add an instance of the card Element into the `card-element` <div>.
		card.mount('#card-element');
		
		// Handle real-time validation errors from the card Element.
		card.addEventListener('change', function(event) {
		  var displayError = document.getElementById('card-errors');
		  if (event.error) {
		    displayError.textContent = event.error.message;
		  } else {
		    displayError.textContent = '';
		  }
		});				

		// Submit the Payment to Stripe
		var submitButton = document.getElementById('submit');
		var cardMessage = document.getElementById('card-message');

		submitButton.addEventListener('click', function(ev) {
		  ev.preventDefault();
		  // Pass the PaymentIntent's client secret to the client
		  var clientSecret;
		  var token = $('.payment-form').data('token');
		  var amount = $('.payment-form').data('amount');
		  var currency = $('.payment-form').data('currency');
		  var userID = $('.payment-form').data('user');
		  var orderNO = $('.payment-form').data('order');
		  var data = $.param({token: token, amount: amount, currency: currency, user_id: userID, order_no: orderNO});
		  cardMessage.textContent = "Processing Card Payment....";
		  axios.post('/cart/payment/intent', data)
		  .then(function(response) {
		  	clientSecret = response.data.client_secret;
		  	stripe.confirmCardPayment(clientSecret, {
		    payment_method: {card: card}
		  }).then(function(result) {
		  		cardMessage.textContent = JSON.stringify(result,null,2);
		    	if (result.error) {
		    	  // Show error to your customer (e.g., insufficient funds)
		    	  console.log(result.error.message);
		    	  $('.payment-form').empty();
		    	    var content;
		    	    var data = $.param({message: result.error.message})
		    	    axios.post('/cart/payment/failed', data)
		    	    	.then(function(response){
		    	    		content = response.data;		    	    		
		    	    		console.log(content);
		    	    		$('.result').html(content);
		    	    	});
		    	    console.log(result);
		    	} else {
		    	  // The payment has been processed!
		    	  if (result.paymentIntent.status === 'succeeded') {
		    	    // Show a success message to your customer
		    	    // There's a risk of the customer closing the window before callback
		    	    // execution. Set up a webhook or plugin to listen for the
		    	    // payment_intent.succeeded event that handles any business critical
		    	    // post-payment actions.
		    	    $('.payment-form').empty();
		    	    var content;
		    	    axios.get('/cart/payment/success?order=' + orderNO)
		    	    	.then(function(response){
		    	    		content = response.data;		    	    		
		    	    		console.log(content);
		    	    		// Update Cart
							$('.cart').html("<i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbsp;Cart");
		    	    		$('.result').html(content);
		    	    	});
		    	    console.log(result);
		    	  }
		    }
		  });
		  });
		  		  
		  
		});

		
		
			}

})();