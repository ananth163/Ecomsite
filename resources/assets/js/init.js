(function(){

	'use strict';

	$(document).foundation();

	$(document).ready(function() {
		
		switch($('body').data('pageid'))
		{
			case 'home'				:
			 							break;
			case 'adminCategories'	:
										SITE.admin.update();
										SITE.admin.delete();
										break;
			default					: 
										//do nothing
		}

		})
	
	
})();