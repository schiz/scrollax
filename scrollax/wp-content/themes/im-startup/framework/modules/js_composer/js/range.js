/**
 * Visual Composer Range Post Type
 *
 * @package startup
 */

jQuery(document).ready(function($) {
	jQuery('.range-input-selector').change( function() {
		var el = jQuery(this);
		el.siblings('span.value').text( el.attr("value") );
	});
});

