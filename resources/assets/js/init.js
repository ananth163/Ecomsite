(function(){

	'use strict';

	$(document).foundation();

	$(document).ready(function() {
		
		switch($('body').data('pageid'))
		{
			case 'home'				:
			 							break;
			
			case 'adminProducts'	: 	SITE.admin.changeEvent();
										SITE.admin.delete();
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