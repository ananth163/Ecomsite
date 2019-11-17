(function () {
	
	'use strict';

	SITE.admin.changeEvent = function() {
		
		$('#product-category').on('change', function () {
			
			var category_id = $('#product-category' + ' option:selected').val();

			$('#product-subcategory').html('Select Subcategory');

			// Get Subcategories for given Category_id
			$.ajax({

				type 	: 'GET',
				url 	: '/admin/products/subcategories/' + category_id,
				data	: {'selected' : true},				
				success	: function(content){
					
							var subCategories = JSON.parse(content);

							if(subCategories.length)
							{
								$.each(subCategories, function (key, value) {
									
									$('#product-subcategory').append('<option value="' + value.id + '"> ' + value.name + '</option>');
								})
							} else
							{
								$('#product-subcategory').append('<option value=""> No SubCategories</option>');
							}
				}
		})
	})

	}

})();