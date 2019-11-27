(function () {
	
	'use strict';

	SITE.home.initCarousel = function() {
		
		$('.hero-slider').slick({
			slidesToShow: 1,
			autoplay: true,
			arrows: false,
			dots: false,
			fade: true,
			autoplayHoverPause: false,
			slideToScroll: 1
		})

	}

})();