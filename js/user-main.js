$(document).ready(function() {

	var $carousel = $('#featured-ad').flexslider({
		animation      : "fade",
		controlNav     : false,
		directionNav   : false,
		animationLoop  : true,
		direction      : "horizontal",
		animationSpeed : 900,
		slideshowSpeed : 5000,
		pauseOnHover   : false
	});

    $carousel.imagesLoaded().progress(function(){
        $carousel.flexslider();
    });
	
});