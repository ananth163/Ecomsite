(function () {
	
	'use strict';

	SITE.home.login = function() {
		
		// Show Password when checked
		$('#show-password').click( function() {
			
			$(this).is(':checked') ? $('#pwd-input').attr('type', 'text') : $('#pwd-input').attr('type', 'password');
		})

	}

}) ();