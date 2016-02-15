/**
 * Skin Generator
 */
missAdmin.skinActivate = function() {
	jQuery('#miss_skins_tab').delegate('#miss_activate_skin', 'click', function(e){
		jQuery('.ajax_feedback_activate_skin').css('display','inline');
		var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
			 skinAction = jQuery('<input>', { type: 'text', name:'_miss_activate_skin', val: jQuery(this).parent().find('select').val() }),
			 postData = skinAction.add(_wpNonce).serialize();
		missAdmin.ajaxSubmit(postData);
		e.preventDefault();
	});
};

missAdmin.skinGenOptions = function() {
	jQuery('input[name="skin_generator"]').change(function(){
		var _val = jQuery(this).val();
		if(_val == 'create'){
			missAdmin.skinCreateAjaxLoad('create');
		}
		if(_val == 'manage'){
			missAdmin.skinManageAjaxLoad();
		}
	});
};

missAdmin.skinCreateAjaxLoad = function(stylesheet) {
	jQuery('.skin_generator_option_set').remove();
	jQuery('#ajax_feedback_skin_loader').css( 'display', 'block' );
	var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
		loadType = jQuery('input[name=skin_generator]'),
		styleSheet = jQuery('<input>', { type: 'text', name:'_miss_skin_ajax_load', val: stylesheet }),
		postData = _wpNonce.add(loadType).add(styleSheet).serialize();
	missAdmin.ajaxSubmit(postData);
},

missAdmin.skinManageAjaxLoad = function() {
	jQuery('.skin_generator_manage').remove();
	jQuery('#ajax_feedback_skin_loader').css( 'display', 'block' );
	
	var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
	    skinAction = jQuery('<input>', { type: 'text', name:'_miss_manage_custom_skin', val: true }),
	    postData = skinAction.add(_wpNonce).serialize();
	
	missAdmin.ajaxSubmit(postData);
};

missAdmin.skinAdvancedAjaxLoad = function() {
	jQuery('#miss_skins_tab').undelegate('.miss_skin_advanced', 'click');
	jQuery('#miss_skins_tab').delegate('.miss_skin_advanced', 'click', function(e){
		jQuery('.skin_generator_manage').remove();
		jQuery('#ajax_feedback_skin_loader').css( 'display', 'block' );
		var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
			skinAction = jQuery('<input>', { type: 'text', name:'_miss_advanced_skin_edit', val: jQuery(this).attr('rel') }),
			postData = skinAction.add(_wpNonce).serialize();
		missAdmin.ajaxSubmit(postData);
		e.preventDefault();
	});
};

missAdmin.skinAdvancedAjaxOutput = function(data) {
	jQuery('#ajax_feedback_skin_loader').css( 'display', 'none' );
	jQuery(data.html).appendTo('#miss_skins_tab');
	missAdmin.cancelSkinEdit();
	missAdmin.saveSkinNew();
	missAdmin.saveSkinEdit();
};

missAdmin.skinManageAjaxOutput = function(data) {
	jQuery('#ajax_feedback_skin_loader').css( 'display', 'none' );
	jQuery(data.html).appendTo('#miss_skins_tab');
	missAdmin.optionToggle();
/* 	missAdmin.skinUploader(); */
	missAdmin.skinManager();
	missAdmin.skinDelete();
	missAdmin.skinExport();
	missAdmin.skinAdvancedAjaxLoad();
};

missAdmin.skinCreateAjaxOutput = function(data) {
	jQuery('#ajax_feedback_skin_loader').css( 'display', 'none' );
	jQuery(data.html).appendTo('#miss_skins_tab');
	missAdmin.optionToggle();
	missAdmin.colorPicker();
	missAdmin.cancelSkinEdit();
	missAdmin.saveSkinNew();
	missAdmin.saveSkinEdit();
	missAdmin.customDropdowns();
	missAdmin.customSelects();
	
	// option toggles
	jQuery('#miss_skins_tab .trigger a').click(function(e){
		if( jQuery(this).find('span').text() == '[+]' ){
			jQuery(this).find('span').text('[-]');
		} else {
			jQuery(this).find('span').text('[+]');
		}
		jQuery.fx.off = true;
		jQuery(this).parent().toggleClass('active').next().toggle();
		jQuery.fx.off = false;
		e.preventDefault();
	});
};

missAdmin.saveSkinNew = function() {
	jQuery('#miss_skins_tab').undelegate('.save_custom_skin', 'click');
	jQuery('#miss_skins_tab').delegate('.save_custom_skin', 'click', function(e){
		if( !jQuery('input[name=custom_skin_name]').val() ){
			alert(objectL10n.skinEmpty);
		}
		if( jQuery('input[name=custom_skin_name]').val() ){
			jQuery(this).parent().parent().find('.cancel_skin_edit').parent().css('display','none');
			jQuery('.ajax_feedback_save_skin').css('display','inline-block');
			var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
				 allInputs = jQuery('#miss_skins_tab').find(':input'),
				 skinAction = jQuery('<input>', { type: 'text', name:'_miss_save_custom_skin', val: true }),
				 postData = skinAction.add(allInputs).add(_wpNonce).serialize();
			missAdmin.ajaxSubmit(postData);
		}
		e.preventDefault();
	});
};

missAdmin.saveSkinEdit = function() {
	jQuery('#miss_skins_tab').undelegate('.save_manage_skin', 'click');
	jQuery('#miss_skins_tab').delegate('.save_manage_skin', 'click', function(e){
		if (confirm(objectL10n.skinOverwriteConfirm)) {
			//jQuery(this).parent().parent().find('.cancel_skin_edit').parent().css('display','none');
			jQuery(this).parent().find('.cancel_skin_edit').parent().css('display','none');
			jQuery('.ajax_feedback_save_skin').css('display','inline-block');
			var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
				allInputs = jQuery('#miss_skins_tab').find(':input'),
				skinAction = jQuery('<input>', { type: 'text', name:'_miss_save_existing_skin', val: true }),
				postData = skinAction.add(allInputs).add(_wpNonce).serialize();
				missAdmin.ajaxSubmit(postData);
		}
		e.preventDefault();
	});
};

missAdmin.skinSaved = function(data) {
	jQuery('input[name=custom_skin_name]').val('');
	
	if(data.skin_name){
	//	jQuery('#style_variations').prepend('<option value="' +data.skin_name+ '">' +data.skin_name+ '</option>');
	}
	if(jQuery('input[name=_miss_save_manage_skin]').length >0){
		jQuery('.skin_generator_option_set').remove();
		missAdmin.skinManageAjaxLoad();
	}
};

missAdmin.cancelSkinEdit = function() {
	jQuery('#miss_skins_tab').undelegate('.cancel_skin_edit', 'click');
	jQuery('#miss_skins_tab').delegate('.cancel_skin_edit', 'click', function(e){
		jQuery('.skin_generator_manage').remove();
		missAdmin.skinManageAjaxLoad();
		e.preventDefault();
	});
};

missAdmin.skinManager = function() {
	jQuery('#miss_skins_tab').undelegate('.miss_skin_edit', 'click');
	jQuery('#miss_skins_tab').delegate('.miss_skin_edit', 'click', function(e){
		jQuery('.skin_generator_manage').remove();
		missAdmin.skinCreateAjaxLoad(jQuery(this).attr('rel'));
		e.preventDefault();
	});
};

missAdmin.skinDelete = function() {
	jQuery('#miss_skins_tab').undelegate('.miss_skin_delete', 'click');
	jQuery('#miss_skins_tab').delegate('.miss_skin_delete', 'click', function(e){
		if (confirm(objectL10n.skinDeleteConfirm)) {
			var _this = jQuery(this),
				_wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
				skinName = _this.attr('rel'),
				skinAction = jQuery('<input>', { type: 'text', name:'_miss_delete_custom_skin', val: skinName }),
				postData = skinAction.add(_wpNonce).serialize();
				_this.parent().css('display','none');
				_this.parent().parent().find('.ajax_feedback_manage_skin').css('display','inline');
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
						if(data.success){
							jQuery('#style_variations option[value="' +skinName+ '"]').remove();
							_this.parent().parent().find('.ajax_feedback_manage_skin').remove();
							_this.parent().parent().parent().css('background-color', 'red').animate({
								opacity : 0,
								height: 0
							}, 350, function() {
								_this.parent().parent().parent().remove();
							});
						} else {
							_this.parent().css('display','block');
							_this.parent().parent().find('.ajax_feedback_manage_skin').css('display','none');
						}
						missAdmin.processJson(data);
					}
				});
			}
		e.preventDefault();
	});
};

missAdmin.skinExport = function() {
	jQuery('#miss_skins_tab').undelegate('.miss_skin_export', 'click');
	jQuery('#miss_skins_tab').delegate('.miss_skin_export', 'click', function(e){
		var _this = jQuery(this),
			_wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
			skinName = _this.attr('rel'),
			skinAction = jQuery('<input>', { type: 'text', name:'_miss_export_custom_skin', val: skinName }),
			postData = skinAction.add(_wpNonce).serialize();
		_this.parent().css('display','none');
		_this.parent().parent().find('.ajax_feedback_manage_skin').css('display','inline');
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			data: postData,
			beforeSubmit: '',
			beforeSend: function(x) {
				if(x && x.overrideMimeType) {
					x.overrideMimeType('application/json;charset=UTF-8');
				}
			},
			success: function(data) {
				if(data.success) {
					if(data.message){
						missAdmin.processJson(data);
					}
					var inputs = '';
					inputs+='<input type="hidden" name="_miss_download_skin" value="'+ data.zip +'" />';
					inputs+='<input type="hidden" name="_miss_delete_skin_zip" value="'+ data.rmdir +'" />';
					jQuery('<form action="' +data.dl_skin+ '" method="post">'+inputs+'</form>')
					.appendTo('body').submit().remove();
				} else {
					missAdmin.processJson(data);
				}
				_this.parent().css('display','block');
				_this.parent().parent().find('.ajax_feedback_manage_skin').css('display','none');
			}
		});
		e.preventDefault();
	});
};

/*
missAdmin.skinUploader = function() {
	if( !qq.UploadHandlerXhr.isSupported() ) {
		jQuery('.upload_limit').css('display','inline');
	}
	var uploader = new qq.FileUploader({
		element: jQuery('#file-uploader')[0],
		action: ajaxurl,
		params: { action: 'miss_skin_upload' },
		sizeLimit: 50 * 1024 * 1024,
		allowedExtensions: ['zip'],
		multiple: false,
		messages: {
	        typeError: objectL10n.typeError
	    },
		template: '<div class="qq-uploader">' +
			'<div class="qq-upload-drop-area"><span>Drop files here to upload</span></div>' +
			'<div class="qq-upload-button"><span class="button">Upload a Skin</span></div>' +
			'<ul class="qq-upload-list"></ul>' + 
			'</div>',
		onSubmit: function(id, fileName){
			if( !qq.UploadHandlerXhr.isSupported() ) {
				jQuery('.upload_limit').css('display','none');
			}
		},
		onCancel: function(id, fileName){
			if( !qq.UploadHandlerXhr.isSupported() ) {
				jQuery('.upload_limit').css('display','inline');
			}
		},
		onProgress: function(id, fileName, loaded, total){
			var item = uploader._getItemByFileId(id),
			    size = uploader._find( item, 'size' );
		qq.setText(size, objectL10n.skinUploading);
		},
		onComplete: function(id, fileName, responseJSON){
			var item = uploader._getItemByFileId(id),
			    size = uploader._find( item, 'size' );
			if(responseJSON.success){
				qq.setText(size, objectL10n.skinUnziping);
				jQuery(item).find('.qq-upload-size').prepend('<span class="qq-upload-spinner"></span>');
				var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
					 skinAction = jQuery('<input>', { type: 'text', name:'_miss_upload_custom_skin', val: fileName }),
					 postData = skinAction.add(_wpNonce).serialize();
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
							jQuery(item).remove();
							missAdmin.processJson(data);
							if( !qq.UploadHandlerXhr.isSupported() ) {
								jQuery('.upload_limit').css('display','inline');
							}
							if(data.html){
								jQuery('.skin_generator_manage tbody').prepend(data.html);
								
								var names = data.skin_name;
								for(var i in names){
									var newSkin = names[i].replace(/&quot;/g, '') + '.css';
									jQuery('#style_variations').prepend('<option value="' +newSkin+ '">' +newSkin+ '</option>');
								}
								
							}
						}
					});
			} else {
				jQuery(item).remove();
				missAdmin.processJson(responseJSON);
				if( !qq.UploadHandlerXhr.isSupported() ) {
					jQuery('.upload_limit').css('display','inline');
				}
			}
		}
   });
};
*/