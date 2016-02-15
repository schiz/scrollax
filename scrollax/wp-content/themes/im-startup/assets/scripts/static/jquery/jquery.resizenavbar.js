(function( $ ){
	$.fn.resizeNavbar = function(p,o,h) { 
				var height = jQuery(this).height();
				if ( p > 0 ) {
					var sumHeight = Math.round( ( h / p ) - o );
				} else {
					var sumHeight = h;
				}
				jQuery(this).stop().animate({ opacity: 1, 'line-height': sumHeight +'px' }, { duration: 100 } );
	}
})( jQuery );