(function() {

	'use strict';

	SITE.admin.update = function(){

		// Update and Save Category values
		$('.update-category').on('click', function(event){

			var token = $(this).data('token');
			var id 	  = $(this).attr('id');
			var name  = $('#updateitem-name-' + id).val();

			$.ajax({
				type	: 'POST',
				url		: '/admin/products/categories/' + id + '/edit',
				data	: { 'token' : token,
							'name'	: name },
				success : function(data){
							
							if(data.includes("success"))
							{
								var response = JSON.parse(data);

								$(".notification").css("display", 'block').removeClass('alert').addClass('success').delay(4000).slideUp(300)
								.html(response.success);
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

		// Load SubCategories
		$('.load-category').on('click',function(event){

			event.preventDefault();

			var id = $(this).attr('id');

			// Get Subcategories for given Category_id
			$.ajax('/admin/products/subcategories/' + id).
				
				done(function(content){
					
					$("#category-" +  id).html(content);

					$('#updateitem-' + id).foundation('open');
				})			
		})		


		//Paginate Subcategories
		$('.reveal-update').on('click', '.pagination a', function(event){

			event.preventDefault();

			//var page = $(this).attr('href').split('p2=')[1];

			var page = $(this).attr('href');

			$.ajax({

				//url 	: '/admin/products/subcategories/' + id + '?p2=' + page	
				url		: page					

			}).done(function(data){
				
				$('.reveal-subCategories').html(data);
								
			})
		})

		// Update Subcategory name
		$('.reveal-update').on('click', '.update-subCategory', function(event){

			var id 	  = $(this).attr('id').substring(5);

			var content = $('#subCategoryName-' + id).html();

    		$('#subCategoryName-' + id)
    						.html("<input id='input-" + id + "'type='text' value='" + content + "'></input>" );
    			
  			$('#edit-' + id).hide();

    		$('#delete-' + id).hide();

    		$('#save-' + id).show(); 			
			
			event.preventDefault();
		})

		//Save Subcategory values
		$('.reveal-subCategories').on('click', '.save', function(event){

			var id = $(this).attr('id').substring(5);

			var token = $(this).data('token');

			var name = $('#input-' + id).val();

			var old_category_id = $('#subCategoryGroup-' + id).data('category');

			var category_id = $('#subCategoryGroup-' + id).val();

			$.ajax({
				type	: 'POST',
				url		: '/admin/products/subcategories/' + id + '/edit',
				data	: { 'token' 	  : token,
							'name'		  : name,
							'category_id' : category_id },
				success : function(data){
						
							if(old_category_id != category_id)
							{
								$("#subCategory-" + id).empty();

								$(".notification").css("display", 'block').removeClass('alert').addClass('success').delay(2000).slideUp(300)
									.html("Record Updated Successfully");	

								return false;		
							
							}
							$("#subCategory-" + id).html(data);

							$(".notification").css("display", 'block').removeClass('alert').addClass('success').delay(2000).slideUp(300)
								.html("Record Updated Successfully");			
							
								},
				error	: function(request){

							var errors = JSON.parse(request.responseText);

							var ul = document.createElement('ul');

							$.each(errors, function(key, value){

								var li = document.createElement('li');

								li.appendChild(document.createTextNode(value));

								ul.appendChild(li);
							})

							$(".notification").css("display", 'block').addClass('alert').delay(2000).slideUp(300)
								.html(ul);

								}

			})


			event.preventDefault();
		})

		
	}
})();