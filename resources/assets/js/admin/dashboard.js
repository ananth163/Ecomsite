(function () {
	
	'use strict';

	SITE.admin.dashboard = function() {
		
		var order   = document.getElementById('order');
		var revenue = document.getElementById('revenue');

		var orderLabel = [];
		var revenueLabel = [];

		var orderData = [];
		var revenueData = [];

		axios.get('/admin/charts')
			.then(function(response){

				response.data.orders.forEach(function(monthly){
					
					orderLabel.push(monthly.new_date);
					orderData.push(monthly.count);
				});

				response.data.payments.forEach(function(monthly){
					
					revenueLabel.push(monthly.new_date);
					revenueData.push(monthly.amount);
				});

				var orderChart = new Chart(order, {

					type: 'line',
					data: {
						labels: orderLabel,
						datasets: [{
							label: '#Orders',
							data: orderData,
							backgroundColor: ['#81c784'] 
		
						}]
		
					}
				});

				var revenueChart = new Chart(revenue, {

					type: 'bar',
					data: {
						labels: orderLabel,
						datasets: [{
							label: '#Revenue',
							data: revenueData,
							backgroundColor: [
            		    		'rgba(255, 99, 132, 0.2)',
            		    		'rgba(54, 162, 235, 0.2)',
            		    		'rgba(255, 206, 86, 0.2)',
            		    		'rgba(75, 192, 192, 0.2)',
            		    		'rgba(153, 102, 255, 0.2)',
            		    		'rgba(255, 159, 64, 0.2)'
            				],
            				borderColor: [
            				    'rgba(255, 99, 132, 1)',
            				    'rgba(54, 162, 235, 1)',
            				    'rgba(255, 206, 86, 1)',
            				    'rgba(75, 192, 192, 1)',
            				    'rgba(153, 102, 255, 1)',
            				    'rgba(255, 159, 64, 1)'
            				],
            				borderWidth: 1
		
						}]

					}
				});



			});

		

		

	}

})();