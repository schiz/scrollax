missAdmin.layoutSelect = function() {
	var el = jQuery('.layout_option_set');
	el.each(function(){
		var _this = jQuery(this),
		    _input = _this.find(':input');
		jQuery(_this).find('a').each(function(){
			if(jQuery(this).attr('rel')==_input.val()){
				jQuery(this).addClass('selected');
			}
			jQuery(this).click(function(e){
				if(jQuery(this).hasClass('selected')){
					jQuery(this).removeClass('selected');
					jQuery(_input).val('');
				} else {
					jQuery(_input).val(jQuery(this).attr('rel'));
					jQuery(_this).find('.selected').removeClass('selected');
					jQuery(this).addClass('selected');
				}
				e.preventDefault();
			});
			
		});
		
	});
};