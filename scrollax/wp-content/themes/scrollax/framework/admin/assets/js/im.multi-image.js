missAdmin.multiImage = function() {
	var el = jQuery(".multi_image");
	el.each(function() {
		var _this = jQuery(this),
		    selects = jQuery(this).children('input'),
		    name = jQuery(this).attr("id");
		selects.each(function(i) {
			if(jQuery(this).val() != ''){
					jQuery(this).attr('id', name + '['+i+']');
					jQuery(this).attr('name', name + '['+i+']');
			}
			jQuery(this).unbind('change').bind('change',function() {
				if (jQuery(this).val() && selects.length == i + 1) {
					jQuery(this).clone().val("").appendTo(_this);
				} else if (!(jQuery(this).val())
						&& !(selects.length == i + 1)) {
					jQuery(this).remove();
				}
				missAdmin.multiImage();
			});
		})
	})
};
