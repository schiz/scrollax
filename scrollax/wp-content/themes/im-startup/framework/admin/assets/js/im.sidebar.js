missAdmin.addSidebar = function(data) {
	var _this = jQuery('#sidebar-to-edit'),
		menuItem = jQuery('#sample-sidebar-item li'),
		template;
	if( jQuery(_this).css('display') == 'none' ){
		jQuery(_this).parent().find('.menu_clear').css('display','block');
		jQuery(_this).empty();
		jQuery(_this).css('display','block');
	}
	template = menuItem;
	template.clone()
		.attr('id',template.attr('id').replace(':',data.sidebar_id))
		.find('*').each( function() {
			jQuery(this).find('.sidebar-title').text(data.sidebar);
			var attrId = jQuery(this).attr('rel');
			if (attrId) jQuery(this).attr('rel', attrId.replace(':',data.sidebar_id));
		}).end()
		.appendTo(jQuery('#sidebar-to-edit'));
	jQuery('input[name=sidebar_action]').val('');
	jQuery('#custom_sidebars').val('');
};

missAdmin.sidebarDelete = function() {
		jQuery('.delete_sidebar').live( 'click', function(e) {
			if (confirm(objectL10n.sidebarDelete)) {
				jQuery('#ajax-loader').css({display:'block'});
				var sidebar = jQuery(this).attr('rel'),
					sidebarId = sidebar.match(/\d+/g);
					sidebarDelete = jQuery('#' +sidebar).find('.sidebar-title').text();
				var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
					allInputs = jQuery('<input>', { type: 'text', name:'miss_sidebar_delete', val: sidebarDelete }),
					sidebarRm = jQuery('<input>', { type: 'text', name:'sidebar_id', val: parseInt(sidebarId) }),
					action = jQuery('input[name=action]'),
					postData = _wpNonce.add(allInputs).add(sidebarRm).add(action).serialize();
				missAdmin.ajaxSubmit(postData);
				e.preventDefault();
			} else {
				e.preventDefault();
			}
		});
};
/* Extending */
missAdmin.deleteSidebar = function(data) {
		var el = jQuery('#sidebar-item-' +data.sidebar_id);
		el.addClass('deleting').animate({
				opacity : 0,
				height: 0
			}, 350, function() {
				el.remove();
				_this = jQuery('#sidebar-to-edit');
				if(jQuery(_this).is(':empty')){
					jQuery(_this).parent().find('.menu_clear').css('display','none');
					jQuery(_this).css('display','none');
				}
			});
};

missAdmin.saveSidebar = function() {
		jQuery('.miss_add_sidebar').click(function(e){
			if( !jQuery("#custom_sidebars").val() ){
				alert(objectL10n.sidebarEmpty);
			}
			if( jQuery("#custom_sidebars").val() ) {
				jQuery('#ajax-loader').css({display:'block'});
				var _this = jQuery('#sidebar-to-edit'),
				    sidebarEdit = _this.find('li'),
				    count = sidebarEdit.length,
				    newID = ( _this.css('display') == 'none' )? count : count+1,
				    allIds = new Array;
				sidebarEdit.each( function() {
					if(jQuery(this).attr('id')){
						sidebarEditId = jQuery(this).attr('id').match(/\d+/g);
						if(sidebarEditId){
							allIds.push(parseInt(sidebarEditId));
						}
					}
				});
				while (jQuery.inArray(newID, allIds) != -1 ) {
					newID++;
				}
				var _wpNonce = jQuery('input[name=miss_admin_wpnonce]'),
					allInputs = jQuery("#custom_sidebars"),
					action = jQuery('input[name=action]'),
					sidebarAction = jQuery('<input>', { type: 'text', name:'miss_sidebar_save', val: true }),
					sidebarId = jQuery('<input>', { type: 'text', name:'miss_sidebar_id', val: newID }),
					postData = _wpNonce.add(allInputs).add(action).add(sidebarAction).add(sidebarId).serialize();
				missAdmin.ajaxSubmit(postData);
			}
			e.preventDefault();
		});
};
