missAdmin.optionsToggleSlide = function() {
	jQuery('.option_toggle a').click(function(e){
		var val = '',
		    isSlider = ( jQuery(this).parent().hasClass('slider_option_toggle') ) ? true : false; 
		if( jQuery(this).find('span').text() == '[+]' ){
			jQuery(this).find('span').text('[-]');
		} else {
			jQuery(this).find('span').text('[+]');
		}
		if( isSlider ) {
			var slider = jQuery('*[id^="slider_custom_"]'),
			    val;
			slider.each(function() {
				_this = jQuery(this);
				chk = _this.attr('checked');
				if( chk == true){
					val = jQuery(this).val();
				}
			});
			missAdmin.clearSliderHeight();
		}
		jQuery.fx.off = true;
		jQuery(this).parent().toggleClass('active').next().toggle('fast', function() {
			jQuery.fx.off = true;
			
			if( isSlider ) {
				missAdmin.refreshSliderHeight();
			}
		});
		jQuery.fx.off = false;
		e.preventDefault();
	});
};