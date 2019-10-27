(function() {

	'use strict';

	SITE.admin.update = function(){

		// Get Category values
		$('.update-category').on('click', function(event){

			var token = $(this).data('token');
			var id 	  = $(this).attr('id');
			var name  = $('#item-name-' + id).val();

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

	}
})();