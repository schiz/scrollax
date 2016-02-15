missAdmin.icons = function() {
	jQuery.fn.iconLabels = function(){
		var el = jQuery(this),
			rel = el.attr('rel'),
			title = el.attr('title'),
			container = jQuery("<div class='tooltip iconTooltip'></div>").animate({
				'opacity': 1
			},800),
			inner = jQuery("<div />").addClass('inner'),
			preview = jQuery("<div />").addClass('preview'),
			prev1 = jQuery('<i class="' + rel + '" style="font-size: 12px; color: #fff"></i> '),
			prev2 = jQuery('<i class="' + rel + '" style="font-size: 18px; color: #efefef"></i> '),
			prev3 = jQuery('<i class="' + rel + '" style="font-size: 26px; color: #e5e5e5"></i> ');
		var icoMoon=rel.match(/^im-/g);
		var fontAwesome=rel.match(/^fa-/g);

		//Reset title
		el.attr('title', '');

		// inner.text( title );	
		jQuery('<div><strong>Icon Preview:</strong></div>').appendTo( preview );

		prev1.appendTo( preview );
		prev2.appendTo( preview );
		prev3.appendTo( preview );

		jQuery('<div><strong>Custom Usage:</strong><pre>&lt;i class="' + rel + '"&gt;&lt;/i&gt;</pre></div>').appendTo( preview );

		if ( icoMoon ) {
			jQuery('<div>Vendor: Ico Moon</div>').appendTo( preview );
		}
		if ( fontAwesome ) {
			jQuery('<div>Vendor: Font Awesome</div>').appendTo( preview );
		}

		preview.appendTo( inner );

		inner.appendTo( container );

		el.hover(
			function() { container.appendTo(this); },
			function() {
				container.remove();
				jQuery(document).find('.iconTooltip').remove();
			}
		);
		
	};

	jQuery(document).ready(function($) {

		// Set visibility to 0
		var im_visible_icon_selector = 0;
		var search_icon = 0;

		jQuery('.im-toggle-icons').click(function() {
			var elToggle = jQuery(this);
			if ( im_visible_icon_selector == 0) {
				// _wpNonce.add(loadType).add(styleSheet).serialize();
				// jQuery('.loadIconsBtn').click( function () {

				// missAdmin.ajaxSubmit('?miss_get_icons_ajax=true');
				var default_value = jQuery(this).siblings('input').val();
				var query = {'_miss_get_icons_ajax': true};
				var preloader = jQuery('<div class="im-rogger-container small"><div class="im-rogger1 small"></div></div>');
						// alert(query);

				// missAdmin.iconsAjaxLoad( jQuery(this) );
				jQuery.ajax({
					type: 'POST',
					dataType: 'json',
					data: query,
					beforeSend: function(x) {
						if(x && x.overrideMimeType) {
							x.overrideMimeType('application/json;charset=UTF-8');
							elToggle.parent().append( preloader );
						}
					},
					success: function(data) {
						// jQuery('.im_icon_selector', data.html ).each(
						// 	function(e) {
						// 		jQuery(this).iconLabels();
						// 	}
						// );
						elToggle.parent().find('.im-rogger-container').remove();

						elToggle.parent().siblings('.im-font-icons-wrapper').find('.icons-list').html( data.html )
						.find('.im_icon_selector', data.html ).each(
							function(e) {
								jQuery(this).iconLabels();
								// .find('a').each(function() {
									jQuery(this).parent().find('.current').removeClass('current');
									if(jQuery(this).attr('rel')==default_value){
											jQuery(this).addClass('current');
									}

									// if ( default_value.length > 0 ) {
									// 	jQuery(this).parent().parent().siblings('.im-icon-preview').addClass( default_value );
									// }

									// Asign curent icon
									jQuery(this).click(function(){
										default_value = jQuery(this).attr('rel');
										// alert('clicked');
										elToggle.parent().parent().find('input.icon_field').val(jQuery(this).attr('rel'));
										// jQuery(this).parent('.im-visual-selector').find('.current').removeClass('current');
										jQuery(this).addClass('current');
										elToggle.parent().find('.im-icon-preview')
											.html('<i class="' + jQuery(this).attr('rel') + '" />');
										
										//jQuery('.im-font-icons-wrapper').slideUp(500);

										// elToggle.parent().siblings('.im-font-icons-wrapper').find('.icons-list').empty();

										// im_visible_icon_selector = 0;
										return false;
									})
								});
						// alert(data.html);
						// missAdmin.processJson(data);

						elToggle.parent().siblings('.im-font-icons-wrapper').slideDown(500);
						im_visible_icon_selector = 1;
					}
				});
			} else {
				var elToggle = jQuery(this);
				elToggle.parent().siblings('.im-font-icons-wrapper').slideUp(500);
				im_visible_icon_selector = 0;
				search_icon = 0;
				setTimeout( function() { elToggle.parent().siblings('.im-font-icons-wrapper').find('.icons-list').empty(); }, 500);
			}
			return false;
		});
		jQuery('.page-composer-icon-filter')
		  .on( 'change', function () {
		    var filter = jQuery(this).val(),
		    	list = jQuery(this).parent().parent().find('.im-font-icons-wrapper');

			if ( im_visible_icon_selector == 0 && search_icon == 0) {
				jQuery(this).parent().parent().find('.im-toggle-icons').trigger('click');
				search_icon = 1;
			}
		    if(filter) {
		      jQuery(list).find("span:not(:Contains(" + filter + "))").parent().hide();
		      jQuery(list).find("span:Contains(" + filter + ")").parent().show();
		    } else {
		      jQuery(list).find("a").show();
		    }
		  })
		.keyup( function () {
		    jQuery(this).change();
		});
	});
};