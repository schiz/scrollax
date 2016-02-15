	missAdmin.clearSliderHeight = function() {
		jQuery('#miss_slideshow_tab').css({height: ''});
	};

	missAdmin.refreshSliderHeight = function() {
		jQuery('#miss_slideshow_tab').css({
		      height: function(index, value) {
		        return parseFloat(value);
		      }
		});
	};

	missAdmin.refreshMenuKeys = function (_this) {
		var _this = _this,
		    addKeys = new Array;
		sliderIDs = _this.find('li')
		sliderIDs.each(function(i) {
			var thisID = jQuery(this).attr('id').match(/\d+/g);
			addKeys.push(thisID);
		});
		addKeys.push('#');
		_this.parent().find('.menu-keys').val(addKeys.toString());
	};

	missAdmin.menuAdd = function() {
		jQuery('.miss_add_menu').live('click', function(e){
			
			missAdmin.clearSliderHeight();
			var _this = jQuery(this).parent().parent(),
				 append = _this.find('.menu-to-edit'),
				 menuItem = _this.find('.sample-to-edit li'),
				 menuEdit = append.find('li'),
				 count = menuEdit.length,
				 allIds = new Array;
			menuEdit.each( function() {
				if(jQuery(this).attr('id')){
					menuEditId = jQuery(this).attr('id').match(/\d+/g);
					if(menuEditId){
						allIds.push(parseInt(menuEditId));
					}
				}
			});
			var newID = ( jQuery(append).css('display') == 'none' )? count : count+1,
			    template = menuItem;
			
			while (jQuery.inArray(newID, allIds) != -1 ) {
				newID++;
			}
			var newClone = template.clone()
				.attr('id',template.attr('id').replace('#',newID))
				.find('*').each( function() {
					if( jQuery(this).hasClass('item-title') ) {
						var newTitle = jQuery(this).text().replace(/\d+/g,newID);
						jQuery(this).text(newTitle);
					}
					var attrId = jQuery(this).attr('id');
					if (attrId) jQuery(this).attr('id', attrId.replace('#',newID));
					var attrHref = jQuery(this).attr('href');
					if (attrHref) jQuery(this).attr('href', attrHref.replace('#',newID));
					var attrFor = jQuery(this).attr('for');
					if (attrFor) jQuery(this).attr('for', attrFor.replace('#',newID));
					var attrName = jQuery(this).attr('name');
					if (attrName) jQuery(this).attr('name', attrName.replace('#',newID));
				}).end();
			var newAppend = jQuery(append).append(function(index, html) {
				if( jQuery(this).css('display') == 'none' ){
					jQuery(_this).find('.menu_clear').css('display','block');
					jQuery(this).empty();
					jQuery(this).css('display','block');
				}
				return newClone;
			});
			if(newAppend) {
				missAdmin.clearSliderHeight();
				
				var _regex = new RegExp( "(.*)menu-item-settings-" + newID, "i"),
				    _match,
				    _item;
				
				append.find('li').children().filter(function() {
				    _find = this.id.match(_regex);
					if(_find){
						_match = _find;
					}
				});
				if(_match){
					_item = jQuery('#'+_match[0]).parent();
					
					jQuery('#'+_match[0]).slideToggle('fast', function() {
					    missAdmin.refreshSliderHeight();
					});
					if(_item.hasClass('menu-item-edit-inactive')){
						_item.removeClass('menu-item-edit-inactive');
						_item.addClass('menu-item-edit-active');
					}else{
						_item.removeClass('menu-item-edit-active');
						_item.addClass('menu-item-edit-inactive');
					}
				}
				missAdmin.refreshMenuKeys(append);
			}
			e.preventDefault();
		});
	};

	missAdmin.menuSort = function() {
		jQuery(".menu-to-edit").sortable({
			handle: '.menu-item-handle',
			placeholder: 'sortable-placeholder',
			start: function() {
				jQuery('#wpwrap').css('overflow','hidden');
			},
			update: function(event, ui) {
				_this = jQuery(this);
				missAdmin.refreshMenuKeys(_this);
			}
		});
	};

	missAdmin.menuEdit = function() {
		jQuery('.item-edit').live( 'click', function(e) {
			jQuery.fx.off = false;
			missAdmin.clearSliderHeight();
			var settings = jQuery(this).attr('href');
			var item = jQuery('#'+settings).parent();
			
			jQuery('#'+settings).slideToggle('fast', function() {
			    missAdmin.refreshSliderHeight();
			});
			if(item.hasClass('menu-item-edit-inactive')){
				item.removeClass('menu-item-edit-inactive');
				item.addClass('menu-item-edit-active');
			}else{
				item.removeClass('menu-item-edit-active');
				item.addClass('menu-item-edit-inactive');
			}
			e.preventDefault();
		});
	};

	missAdmin.menuCancel = function() {
		jQuery('.slider_cancel').live( 'click', function(e) {
			
			missAdmin.clearSliderHeight();
			var settings = jQuery(this).attr('href');
			var item = jQuery('#'+settings).parent();
			
			jQuery('#'+settings).slideToggle('fast', function() {
			    missAdmin.refreshSliderHeight();
			});
			if(item.hasClass('menu-item-edit-inactive')){
				item.removeClass('menu-item-edit-inactive');
				item.addClass('menu-item-edit-active');
			}else{
				item.removeClass('menu-item-edit-active');
				item.addClass('menu-item-edit-inactive');
			}
			e.preventDefault();
		});
	};

	missAdmin.menuDelete = function() {
		jQuery('.slider_deletion').live( 'click', function(e) {
			var _this = jQuery(this).parent().parent().parent().parent();
			var sliderRM = jQuery(this).attr('id').replace('delete-','');
			var el = _this.find('#'+sliderRM);
			el.addClass('deleting').animate({
					opacity : 0,
					height: 0
				}, 350, function() {
					el.remove();
					missAdmin.refreshMenuKeys(_this);
					missAdmin.clearSliderHeight();
					if(jQuery(_this).is(':empty')){
						jQuery(_this).parent().find('.menu_clear').css('display','none');
						jQuery(_this).css('display','none');
					}
				});
			e.preventDefault();
		});
	};

	missAdmin.menuRefresh = function() {
		jQuery('.slideshow_option_set').find('li').each(function(i) {
				var newID = i+1;
				jQuery(this).find('.item-title').text('Slideshow '+newID);
		});
		jQuery('.sociable_option_set select option:selected').each(function(i) {
			icon = jQuery(this).parent().attr('id').match(/edit-menu-sociable-icon-([0-9]+)/);
			if( icon ) {
				custom = jQuery(this).parent().parent().parent().parent().children().eq(2).find('input').val();
				if( custom ) {
					j = (i/2)+1;
					jQuery(this).parent().parent().parent().parent().parent().find('.item-title').text('Sociable '+j);
				} else {
					_text = jQuery(this).text();
					jQuery(this).parent().parent().parent().parent().parent().find('.item-title').text(_text);
				}
			}
		});
	};
