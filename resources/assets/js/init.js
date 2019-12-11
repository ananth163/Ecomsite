(function(){

	'use strict';

	$(document).foundation();	

	$(document).ready(function() {
		
		switch($('body').data('pageid'))
		{
			case 'homepage'			: 	SITE.home.initCarousel();
										SITE.home.products();
			 							break;
			
			case 'products'			: 	SITE.home.products();
			 							break;

			case 'cart'				: 	SITE.home.cart();
			 							break;

			case 'payment'			: 	SITE.home.payment();
			 							break;

			case 'login'			: 	SITE.home.login();
			 							break;

			case 'adminProducts'	: 	SITE.admin.changeEvent();
										SITE.admin.delete();
										break;

			case 'adminDashboard'	: 	SITE.admin.dashboard();
										break;
			case 'adminCategories'	:
										SITE.admin.update();
										SITE.admin.delete();
										SITE.admin.create();
										break;
			default					: 
										//do nothing
		}

		})
	
	
})();