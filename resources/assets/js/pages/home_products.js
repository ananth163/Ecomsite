(function () {
	
	'use strict';

	SITE.home.products = function() {
		
		var app = new Vue({
			
			el: '#products',

			data: {
					featured: [],
					products: [],
					count: 0,
					loading: false 
			},

			methods: {

					getProducts: function() {

						this.loading = true;

						axios.all(
							[axios.get('/featured'), axios.get('/get-products')])
						.then( axios.spread(function(featuredResponse, productsResponse){

							app.featured = featuredResponse.data.featured;

							app.products = productsResponse.data.products;

							app.count = productsResponse.data.count;

							app.loading = false;
						} ))
					},

					loadMoreProducts: function() {

						this.loading = true;

						var data = $.param({next: 2, count: app.count});

						axios.post('/load-more', data)
						.then( function(response){

							app.products = response.data.products;

							app.count = response.data.count;

							app.loading = false;
							
						} )
					},

					addToCart: function(id) {

						var token = $('.display-products').data('token');

						var data = $.param({product: {product_id: id, quantity: 1}, token: token});

						axios.post('/cart/add/', data).then( function(response){

							var total = response.data.totalItems;

							// Display success message
							$(".notify").css("display", 'block').delay(4000).slideUp(300)
								.html("Item added to Cart");
							
							// Update Cart
							$('.cart').html("<i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbsp;Cart(" + total + ")");

						})

					},

					stringLimit: function(string, value) {

						if(string.length > value)
						{
							return string.substring(0, value-3) + '...';
						} else {
							return string;
						}
					}
			},

			created: function() {

				this.getProducts();
			},

			mounted: function() {

				$(window).scroll(function(){
					
					if ( $(window).height() + $(window).scrollTop() == $(document).height() )
					{
					
						app.loadMoreProducts();
					
					}
				})				
			}

		});

	}

})();