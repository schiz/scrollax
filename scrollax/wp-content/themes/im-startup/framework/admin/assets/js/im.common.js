missAdmin.fixField = function(field) {
	str = jQuery(field).val();
	jQuery(field).val(str.replace(/[^a-zA-Z_0-9]+/ig,''));
};

missAdmin.rangeField = function(field) {
	jQuery('.range-input-selector').change( function() {
		var el = jQuery(this);
		el.siblings('span.value').text( el.attr("value") );
	});
};


missAdmin.resizeThemeOptions = function () {
	var width = jQuery("#miss_body").width();
	var loaded = 0;
	var height = jQuery("#miss_body").height();
	jQuery("#miss_tab_content").css({ 'opacity' : 1, width: (width - 202) + "px", "min-height": height + "px" });
	// setTimeout( function () {
	// 	jQuery( "#miss_tab_content" ).stop().animate( { 'opacity' : 1 }, 800 );
	// }, 500 );
};

missAdmin.ajaxSubmit = function(postData) {
	jQuery.ajax({
		type: 'POST',
		dataType: 'json',
		data: postData,
		beforeSend: function(x) {
			if(x && x.overrideMimeType) {
				x.overrideMimeType('application/json;charset=UTF-8');
			}
		},
		success: function(data) {
			missAdmin.processJson(data);
		}
	});
};



missAdmin.processJson = function(data) {
	if(data.success == 'saved_sidebar')
	{
		missAdmin.addSidebar(data);
	}
	if(data.success == 'deleted_sidebar')
	{
		missAdmin.deleteSidebar(data);
	}
	if(data.success == 'options_saved')
	{
		missAdmin.menuRefresh();
	}
	if(data.success == 'skin_saved')
	{
		missAdmin.skinSaved(data);
	}

	// if(data.success == 'icons_loaded')
	// {
	// 	missAdmin.iconsLoad(data);
	// }

	if(data.success == 'icon_load')
	{
		missAdmin.iconAjaxOutput(data);
		return;
	}

	if(data.success == 'skin_edit')
	{
		missAdmin.skinCreateAjaxOutput(data);
		return;
	}

	if(data.success == 'skin_manage')
	{
		missAdmin.skinManageAjaxOutput(data);
		return;
	}
	if(data.success == 'skin_advanced')
	{
		missAdmin.skinAdvancedAjaxOutput(data);
		return;
	}
	if(jQuery.browser.safari) {
		bodyelem = jQuery('body');
	} else {
		bodyelem = jQuery('html');
	}
	  bodyelem.animate({
	    scrollTop:0
	  }, 'fast', function() {
		jQuery('#message').empty();
		var el = jQuery('#message').append('<h2>' + data.message + '</h2>'),
		    timer = ( data.image_error ) ? 15000 : 3000;
		el.fadeIn();
		jQuery('#ajax-loader').fadeOut('fast');
		jQuery('.ajax_feedback_activate_skin').fadeOut('fast');
		jQuery('.ajax_feedback_save_skin').css('display','none');
		jQuery('.cancel_skin_edit').parent().css('display','inline-block');
		el.queue(function(){
		  setTimeout(function(){
		    el.dequeue();
		  }, timer ); 
		}); 
		el.fadeOut();
	});
};

missAdmin.iconsLoad = function(data) {
	// jQuery('input[name=custom_skin_name]').val('');
	
	// if(data.skin_name){
	//	jQuery('#style_variations').prepend('<option value="' +data.skin_name+ '">' +data.skin_name+ '</option>');
	// }
	// if(jQuery('input[name=_miss_save_manage_skin]').length >0){
		// jQuery('.skin_generator_option_set').remove();
		// missAdmin.skinManageAjaxLoad();
	// }
};
