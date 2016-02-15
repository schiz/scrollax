jQuery(window).load(function(){
	var $container = jQuery('.container-isotope');
	// Resize Work Items
	/*
	$container.find(".work-item a img").each(function () {
		var el = jQuery(this);
		var _h = ( jQuery(this).height() ) + 4 + 58;
		el.parent().parent().css("height", _h + "px");
	});
	*/
	
	// Initialize Isotope
	$container.isotope({
		itemSelector: '.autoload-item',
		animationEngine : 'best-available',
	  	animationOptions: {
	     	duration: 300,
	     	easing: 'easeInOutBounce',
	     	queue: false
	   	}
	});
	jQuery('.isonav a').click(function(){
		jQuery('.isonav a').removeClass('iso-active');
		jQuery(this).addClass('iso-active');
		var selector = jQuery(this).attr('data-filter');
	  	$container.isotope({ filter: selector });
	  	return false;
	});

});
jQuery(document).ready(function(){
	jQuery(function(){
		$pos = jQuery('.isonav').offset().top - 0;
		jQuery(window).on('scroll', function(){
		});
	});
});