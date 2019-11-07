(function() {

	'use strict';

	SITE.admin.delete = function(){

		// Delete Category 
		$('.delete-category').on('click', function(event){

			var token = $(this).data('token');
			var id 	  = $(this).attr('id');
			
			$.ajax({
				type	: 'POST',
				url		: '/admin/products/categories/' + id + '/delete',
				data	: { 'token' : token,
							'id'	: id },
				success : function(data){
							
							if(data.includes("success"))
							{
								window.location.href = '/admin/products/categories';
							} 					
							
								},

			})
			
			event.preventDefault();
		})

		// Delete Subcategory
		$('.reveal-update').on('click', '.delete-subCategory', function(event){

			var id 	  		= $(this).attr('id').substring(7);
			var token 		= $(this).data('token');
			var category_id = $(this).data('categoryid');

			console.log(id);

			$.ajax({
				type	: 'POST',
				url		: '/admin/products/subcategories/' + id + '/delete',
				data	: { 'token' : token,
							'id'	: id },
				success : function(data){
							
							if(data.includes("success"))
							{
								//$("#subCategory-" + id).empty();

								$(".notification").css("display", 'block').removeClass('alert').addClass('success').delay(2000).slideUp(300)
									.html("Record Deleted Successfully");

								//Update SubCategories
								// Get Subcategories for given Category_id
								$.ajax('/admin/products/subcategories/' + category_id).
				
								done(function(content){
					
									$("#category-" +  category_id).html(content);

								})	

								return false;
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

			//var elem = new Foundation.Tooltip(element, options);

			//$('#delete-' + id).foundation(); 			
			
			event.preventDefault();
		})

	}
})();