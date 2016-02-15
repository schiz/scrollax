(function( $ ){
	$.fn.miss_emerging = function() {
		/* emerging settings */
		var px_to_edge_screen = 150,
		animation_time = 100,
		interval = 100;
		delay = 0;

        jQuery(this).each( function(i){
            var el = jQuery(this),
            	top_of_object = el.position().top,
	            top_of_window = jQuery(window).scrollTop(),
	            window_heigth = jQuery(window).height(),
	            bottom_of_object = el.position().top + el.outerHeight(),
	            bottom_of_window = jQuery(window).scrollTop() + jQuery(window).height();
            
            if ( ( bottom_of_window - px_to_edge_screen >= top_of_object && top_of_window + px_to_edge_screen < bottom_of_object )
            || 
            ( top_of_object <= window_heigth ) ) {
                // setTimeout( function() {
					el.addClass('im-in-viewport');
                // }, delay );
            	// if ( top_of_object > window_heigth ) {
	                // delay += interval;
	            // }
            }
            
        });
	}
})( jQuery );
