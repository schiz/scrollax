missAdmin.optionSave = function() {
	jQuery('form#miss_admin_form').submit(function(e){
		if(jQuery('#import_options')[0].value.length>20) {
			jQuery('form#miss_admin_form').prepend( jQuery("<input>", { type: "hidden", name:"miss_import_options", val: true }) );
			return true;
		}
		if(jQuery('#miss_full_submit').val() == 1){
			
			return true;
			
		} else {
			jQuery('#ajax-loader').css({display:'block'});
			tinyMCE.triggerSave();
			var formData = jQuery(this),
				optionSave = jQuery("<input>", { type: "text", name:"miss_option_save", val: true }),
				postData = formData.add(optionSave).serialize();
			missAdmin.ajaxSubmit(postData);
			e.preventDefault();
		}
	});
};