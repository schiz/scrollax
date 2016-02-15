missAdmin.customDropdowns = function() {
	/**
	 * Font Select
	 */
	var isIE = ( jQuery.browser.msie ) ? true : false;
	if( isIE ){
		jQuery('.typography_option_set .miss_option').append('<iframe class="fontiehack" src="javascript:false;" marginwidth="0" marginheight="0" align="bottom" scrolling="no" frameborder="0" style="position:absolute; right:0; top:0px; display:block; filter:alpha(opacity=0);"></iframe><div class="font_select"></div>');
	}else{
		jQuery('.typography_option_set .miss_option').append('<div class="font_select"></div>');
	}
	jQuery('.font_select').click(function(e) {
		
		if( isIE ){
			var fonts = jQuery(this).prev().prev(),
				fontImages = fonts;
		}else{
			var fonts = jQuery(this).prev(),
				fontImages = fonts.prev();
		}
		var fontList = fonts.find('option'),
		    fontTitle = '',
		    fontClass;
		if(fontImages.hasClass('font_images')){
			if(fontImages[0].style.display != 'block'){
				jQuery('.font_images').css('display','none');
				jQuery('.pattern_images').css('display','none');
				document.onclick = function() {
					document.onclick = function() {
						jQuery('.font_images').css('display','none');
						jQuery('.pattern_images').css('display','none');
						document.onclick = null;
					}
				}
				fontImages.css('display','block');
			}
			return;
		}
		fontList.each(function(){
			fontClass = this.text.replace(/ /g, '').toLowerCase();
			fontTitle += '<a title=\'' +this.value+ '\' href="#" class="single_font ' +fontClass+ '">' +this.text+ '</a>';
		});
		jQuery('.font_images').css('display','none');
		jQuery('.pattern_images').css('display','none');
		document.onclick = function() {
			document.onclick = function() {
				jQuery('.font_images').css('display','none');
				jQuery('.pattern_images').css('display','none');
				document.onclick = null;
			}
		}
		jQuery('<div class="font_images">' +fontTitle+ '</div>').insertBefore(jQuery(this).prev()).css('display','block');
		e.preventDefault();
	});
	/**
	 * Pattern selector
	 */
	jQuery('.preset_pattern').click(function(e) {
		var patterns  = jQuery(this).parent().parent().find(".pattern_images");
		//if(patterns.style.display != 'block') {
			jQuery('.font_images').css('display', 'none');//fadeOut(300);
			jQuery('.pattern_images').css('display', 'none');//.fadeOut(300);

			document.onclick = function() {
				document.onclick = function() {
					jQuery('.font_images').css('display','none');
					jQuery('.pattern_images').css('display','none');
					document.onclick = null;
				}
			}

			
			patterns.fadeIn(300);
		//}
		
		e.preventDefault();
	});
};