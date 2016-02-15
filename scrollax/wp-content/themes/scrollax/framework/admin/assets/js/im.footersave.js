missAdmin.footerSave = function(field) {
		jQuery('.miss_footer_submit').click(function(e){
			if(jQuery('#import_options')[0].value.length>20) { 
				jQuery('form#miss_admin_form').prepend( jQuery("<input>", { type: "hidden", name:"miss_import_options", val: true }) );
				return true;
			}
		if(jQuery.browser.safari){ bodyelem = jQuery('body') } else { bodyelem = jQuery('html') }
		  bodyelem.animate({
		    scrollTop:0
		  }, 'fast', function() {
			jQuery('form#miss_admin_form').submit();
		  });
		e.preventDefault();
		});
};