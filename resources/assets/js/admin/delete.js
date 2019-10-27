(function() {

	'use strict';

	SITE.admin.delete = function(){

		// Get Category values
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
				error	: function(request){

							var errors = JSON.parse(request.responseText);

							console.log(errors);

							//var ul = document.createElement('ul');

							/*$.each(errors, function(key, value){

								var li = document.createElement('li');

								li.appendChild(document.createTextNode(value));

								ul.appendChild(li);
							})

							$(".notification").css("display", 'block').addClass('alert').delay(4000).slideUp(300)
								.html(ul);*/

								}

			})
			
			event.preventDefault();
		})

	}
})();