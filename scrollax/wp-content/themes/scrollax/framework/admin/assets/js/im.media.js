missAdmin.wpMedia = function() {
	var header_clicked = false,
		icon_clicked = false,
		fileInput = '',
		formID,
		tbframe_interval;
	jQuery('.upload_button').live("click", function(e) {

		if(jQuery(this).prev()[0].type == 'button') {
			fileInput = jQuery(this).prev().prev('input');
		} else {
			fileInput = jQuery(this).prev('input');
		}
		fileInput = jQuery(this).prev('input').attr('id');
		formID = jQuery(this).attr('rel');
		if (!formID) {
			formID = "0";
		}
		tb_show('', 'media-upload.php?post_id='+formID+'&amp;type=image&amp;miss_upload_button=1&amp;TB_iframe=true');
		tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);

		header_clicked = true;
		//jQuery( ".savesend input.button[value*='Insert into Post'], .media-item #go_button" ).attr( "value", "Use this File" );
		e.preventDefault();
		if (fileInput) {
			clearInterval(tbframe_interval);
		}
	});
	// Icon "Select Preset" button
	jQuery('.icon_preset_button').click(function(e){
		var iconShortcode = jQuery(this).attr('data-type');
		tb_show(objectL10n.iconTbTitle, missAjaxUrl+"/icons.php?height=300&amp;width=300&amp;shortcode="+iconShortcode+"&amp;TB_iframe=true");
		jQuery(this).attr('id', 'current_icon_type');
		icon_clicked = true;
		e.preventDefault();
	});
	window.original_tb_remove = window.tb_remove;
	window.tb_remove = function() {
		//if (!missWpVersion) { missWpVersion = "3.4"; }
		// if(header_clicked && missWpVersion>='3.3') {
		if(header_clicked) {
			deleteUserSetting('uploader');
			jQuery('.media-upload-form').removeClass('html-uploader');
		}
		if(icon_clicked){
			jQuery('.icon_preset_button').attr('id', '');
		}
		header_clicked = false;
		icon_clicked = false;
		window.original_tb_remove();
	}
	// Override send_to_editor function from original script
	// Writes URL into the textbox.
	// Note: If header is not clicked, we use the original function.
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html) {
		if (header_clicked) {
			if ( jQuery(html).html(html).find('img').length > 0 ) {
				imgurl = jQuery(html).html(html).find('img').attr('src');
			} else {//thumbnail-head-3803
				if ( jQuery(html).html(html).find('a').length > 0 ) {
					imgurl = jQuery(html).html(html).find('a').attr('href');
				} else {
					imgurl = htmlBits[1];
					var itemtitle = htmlBits[2];
					itemtitle = itemtitle.replace( '>', '' );
					itemtitle = itemtitle.replace( '</a>', '' );
	                imgurl = jQuery(html).attr('src');
				}
			}
			var image = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;
			var document = /(^.*\.pdf|doc|docx|ppt|pptx|odt*)/gi;
			var audio = /(^.*\.mp3|m4a|ogg|wav*)/gi;
			var video = /(^.*\.mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2*)/gi;
			if (imgurl.match(image)) {
			//	btnContent = '<img src="'+imgurl+'" alt="" /><a href="#" class="mlu_remove button">Remove Image</a>';
			}
			jQuery('#' + fileInput).val(imgurl);
			//if(jQuery('body').hasClass('version-3-3') || jQuery('body').hasClass('version-3-4-1')) {
				deleteUserSetting('uploader');
				jQuery('.media-upload-form').removeClass('html-uploader');
			//}
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}
	};
};