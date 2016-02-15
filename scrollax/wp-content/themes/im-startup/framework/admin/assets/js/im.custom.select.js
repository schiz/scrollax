missAdmin.customSelects = function(e) {
	// Font select
	jQuery('.typography_option_set').delegate('.single_font', 'click', function(e){
		if(jQuery.browser.msie) {
			jQuery(this).parent().prev().val(jQuery(this).attr('title'));
		}else{
			jQuery(this).parent().next().val(jQuery(this).attr('title'));
		}
		
		jQuery('.font_images').css('display','none');
		e.preventDefault();
	});
	// Pattern select
	jQuery('.single_pattern').click(function(e) {
		jQuery(this).parent().parent().find(".background_image_url").val("../" + jQuery(this).attr('title'));
		jQuery('.pattern_images').css('display','none');
		e.preventDefault();
	});
};
