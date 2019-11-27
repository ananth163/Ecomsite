(function () {
	
	'use strict';

	SITE.home.products = function() {
		
		var app = new Vue({
			
			el: '#featured',

			data: {
					featured: [],
					loading: false 
			},

			methods: {

					getFeaturedProducts: function() {

						this.loading = true,
						axios.get("/featured").then( function(response){

							console.log(response.data);
						})
					}
			},

			created: function() {

				this.getFeaturedProducts();
			}

		});

	}

})();