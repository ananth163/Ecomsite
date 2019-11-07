(function() {

	'use strict';

	SITE.admin.create = function(){

		// Update Category values
		$('.create-subcategory').on('click', function(event){

			var token = $(this).data('token');
			var id 	  = $(this).attr('id');
			var name  = $('#create-' + id).val();

			$.ajax({
				type	: 'POST',
				url		: '/admin/products/subcategories/' + id + '/create',
				data	: { 'token' 		: token,
							'name'			: name,
							'category_id'	: id   },
				success : function(data){
							
							if(data.includes("success"))
							{
								var response = JSON.parse(data);

								// Reset input field
								$('#create-' + id).val(null);
								
								// Display success message
								$(".notification").css("display", 'block').removeClass('alert').addClass('success').delay(4000).slideUp(300)
								.html(response.success);

								// Update SubCategories

								// Get Subcategories for given Category_id
								$.ajax('/admin/products/subcategories/' + id).
				
								done(function(content){
					
									$("#category-" +  id).html(content);

								})
							} 					
							
								},
				error	: function(request){

							var errors = JSON.parse(request.responseText);

							var ul = document.createElement('ul');

							$.each(errors, function(key, value){

								var li = document.createElement('li');

								li.appendChild(document.createTextNode(value));

								ul.appendChild(li);
							})

							$(".notification").css("display", 'block').addClass('alert').delay(4000).slideUp(300)
								.html(ul);

								}

			})
			event.preventDefault();
		})

	}
})();