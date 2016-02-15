/**
 * Shorcodes functions
 */
missAdmin.shortcodeSelect = function() {
	jQuery('.shortcode_selector select').val('');
	jQuery('.shortcode_type_selector select').val('');
	jQuery('.shortcode_selector select').change(function(){
		var selected = 'shortcode_'+jQuery(this).val();
		jQuery('.shortcode_wrap').each(function(){
			var el = jQuery(this),
			    _id = el.attr('id');
			if ( _id == selected ) {
				jQuery(this).children().each(function(){
					var _class = jQuery(this).attr('class');
					if( ( _class != 'shortcode_type_selector' ) && ( el.hasClass( 'shortcode_has_types' ) ) ) {
						jQuery(this).css({display: 'none'});
					}
				});
				jQuery(this).css({display: 'block'}).addClass('shortcode_selected');
			} else {
				jQuery(this).css({display: 'none'}).removeClass('shortcode_selected');
			}
		});
		var val = jQuery('#'+selected).find('.shortcode_type_selector select').val();
		if( val ) {
			jQuery('.shortcode_atts_'+val).css({display: 'block'});
		}
	});
	jQuery('.shortcode_wrap').each(function(){
		var el = jQuery(this);
		var selector = el.find('.shortcode_type_selector select');
		selector.change(function(){
			var val = 'shortcode_atts_'+jQuery(this).val()
			el.children().each(function(){
				var _this = jQuery(this);
				if( ( _this.hasClass( val ) ) ){ 
					_this.css({display: 'block'});
				} else {
					if ( !_this.hasClass( 'shortcode_type_selector' ) ){
						_this.css({display: 'none'});
					}
				}
			});
		});
	});
};

missAdmin.shortcodeMultiply = function() {
	jQuery('.shortcode_selected .select').live('change', function(){
		var _html = new Array(),
			cloneCount = jQuery(this).val(),
			 _id;
		jQuery('.shortcode_selected').each(function(){
			_id = jQuery(this).attr('id');
			jQuery(this).children().each(function(){
				var _this = jQuery(this);
				
				if( ( _this.is(':visible') ) && ( !_this.hasClass( 'shortcode_type_selector' ) ) && ( !_this.hasClass( 'shortcode_multiplier' ) ) && ( !_this.hasClass( 'shortcode_dont_multiply' ) ) ) {
					if( !_this.hasClass( 'clone' ) ) {
						_html.push(_this.addClass( 'clone' ).clone());
						_this.removeClass( 'clone' );
					}
					if( _this.hasClass( 'clone' ) ) {
						_this.remove();
					}
				}
			});
		});
		var i=0;
			while ( i<cloneCount ) {
				for ( j in _html ) {
					var newClone = _html[j].clone().find('*').each( function() {
						var titleReplace = jQuery(this).hasClass('miss_option_header');
						if( titleReplace ) {
							text = jQuery(this).html();
							text = text.replace('1', i+2);
							jQuery(this).html(text);
						}
					}).end();
					jQuery('#' + _id).append(newClone);
				}
			  i++;
			 }
		});
};
missAdmin.tableMultiplier = function() {
	jQuery("input.table_field").click(
		function (e) {
			var _this = {
				'container': jQuery(this).parent().parent(),
				'v': jQuery(this).parent().find("select.table_field").val()
			};
			var newClone = _this.container.find( ".prototype." + _this.v ).clone().end().removeClass("prototype");
			_this.container.append(newClone);
			e.preventDefault();
		}
	);
}
missAdmin.shortcodeInsert = function() {
	jQuery('#shortcode_send').click(function(){		
		var scSelected = jQuery('.shortcode_selected'),
		    _val = ( scSelected.find('.shortcode_type_selector').length ) ? scSelected.find('.shortcode_type_selector select').val() : jQuery('.shortcode_selector select').val();
		if( !_val )
			return false;
		var str = '',
			_dom_selector = jQuery('select'),
			atts = '',
			_nestedVal = '';
			_nestedName = '';
			scSelectedAtts = 'shortcode_atts_'+_val,
			carriageReturn = false,
			rich = (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden(),
			_return = (rich) ? '<br />' : '\n';
		var shortCode = new Array(),
			optionalWrap = new Array(),
			multiDropdown = new Array(),
			chkBoxes = new Array(),
			scAtts = new Array(),
			scContent = new Array(),
			multiplyAtts = new Array();
		var attsCount = 0,
			contentCount = 0,
			attsMultiplyCount = 0,
			contentMultiplyCount = 0;
		var bootstrap_layout_check = [
				'span2_span2_span2_span2_span2_span2',
				'span4_span4_span4',
				'span6_span6',
				'span4_span8',
				'span8_span4',
				'span3_span9',
				'span9_span3',
				'span3_span3_span6',
				'span3_span6_span3',
				'span6_span3_span3',
				'span2_span10',
				'span10_span2',
				'span2_span2_span2_span6'
			];
			for ( var x = 0; x <= bootstrap_layout_check.length; x++ ) {
				if( _val == bootstrap_layout_check[x] ) {
					var _has_row = true;
				};
			}
		jQuery('.'+scSelectedAtts).each(function(i){
			_this = jQuery(this);
			_input = _this.find('.miss_option :input');
			_nestedVal = scSelected.find('input[type=hidden]').val();
			_nestedName = scSelected.find('input[type=hidden]').attr('name');
			if(_nestedName){
				_nestedName = _nestedName.match(/sc_nested_(.*)/);
			}
			// standard shortcodes

			if( (!_this.hasClass('shortcode_multiplier')) && (!_this.hasClass('shortcode_multiply')) ){
				
				if(_this.hasClass('shortcode_carriage_return')){
					carriageReturn = true;
				}
				
				atts = _input.attr('id').match(/[^-]+/gi);
				
				// shortcode content
				if(atts[2] == 'content'){
					shortCode.push(atts[1]);
					scContent.push(_input.val());
					contentCount++;
				}
				// shortcode atts
				if( (atts[2] != 'content') && (_input.val()) ){
					// multidropdown atts
					if( _input.parent().hasClass('multidropdown') ){
						multiLength = _this.find('.miss_option :input').length;
						_input.each(function(i){
							if(jQuery(this).val()) {
								multiDropdown.push(jQuery(this).val());
							}
							if( (i == multiLength -1) && (multiDropdown.length >0) ){
								atts = _input.parent().attr('id').match(/[^-]+/gi);
								scAtts.push(' ' + atts[2].replace(']', '') + '="' + multiDropdown.join(',') + '"');
								multiDropdown = new Array();
							}
						});
					} else if(_input[0].type == 'checkbox'){
						chkBoxLength = _this.find('.miss_option :checkbox').length;
						_input.each(function(i){
							if( (jQuery(this).attr('checked')) && (!_this.hasClass('shortcode_optional_wrap')) ){
								chkBoxes.push(jQuery(this).val());
							}
							if ( (i == chkBoxLength - 1) && (chkBoxes.length >0) ){
								scAtts.push(' ' + atts[2] + '="' + chkBoxes.join(',') + '"');
								chkBoxes = new Array();
							} else {
								if(_this.hasClass('shortcode_optional_wrap')){
									optionalWrap.push(true);
									if(jQuery(this).attr('checked')){
										optionalWrap.push(atts[2]);
									}
								}
							}
						});
					} else if(_input[0].type == 'radio'){
						_input.each(function(i){
							if(jQuery(this).attr('checked')){
								scAtts.push(' ' + atts[2].replace(/_[0-9]*/,'') + '="' + jQuery(this).val() + '"');
							}
						});
					} else {
						// all other atts
						if(_input.val()){
							scAtts.push(' ' + atts[2] + '="' + _input.val() + '"');
						} else {
							scAtts.push('');
						}
					}
					attsCount++;
				}
			}
			// multiplied shortcode atts
			if( _nestedName || optionalWrap ){
				if( _this.hasClass('shortcode_multiply') ){
					atts = _input.attr('id').match(/[^-]+/gi);
					// multiplied shortcode content
					if(atts[2] == 'content'){
						shortCode.push(atts[2]);
						scContent.push(_input.val());
						contentMultiplyCount++;
					}
					// multiplied shortcode atts
					if(atts[2] != 'content'){
						if(_input.val()){
							multiplyAtts.push(' ' + atts[2] + '="' + _input.val() + '"');
						} else {
							multiplyAtts.push('');
						}
						attsMultiplyCount++;
					}
				} else {
					// contact form shortcode
					if(_val == 'contactform'){
						if( i <= 4 ) {
							if( i==0 ) str += '[' + _val;
							if( (_input[0].type == 'checkbox') ) {
								_input.each(function(i){
									_chk = jQuery(_input[i]);
									if(_chk.attr('checked')){
										atts = _chk.val().match(/[^-]+/gi);
										str += ' ' + atts[0] + '="' + atts[1] + '"';
									}
								});
							} else if ( ( _input.val() ) && ( _input[0].type != 'checkbox' ) ) {
								str += ' ' + atts[2] + '="' + _input.val() + '"';
							}
							if( i==4 )	str += ']' + _return;
						} else {
							if(!_this.hasClass('contactform_clone')){
								str += '[' + _this.find('.miss_option_header').text().toLowerCase();
								_input.each(function(i){
									_id = jQuery(this).attr('id');
									if(_id){
										atts = _id.match(/[^-]+/gi);
										if( ( this.type == 'checkbox' ) && ( jQuery(this).attr('checked') ) ) {
											str += ' ' + atts[2] + '="' + jQuery(this).val() + '"';
										} else if ( ( jQuery(this).val() ) && ( this.type != 'checkbox' ) ) {
											str += ' ' + atts[2] + '="' + jQuery(this).val() + '"';
										}
									}
								});
								str += ']' + _return;
								contentMultiplyCount++;
							}
						}
					}
				}
			}
		});
		// scroll to top on shortcode send to editor
		if(jQuery.browser.safari){ bodyelem = jQuery('body') } else { bodyelem = jQuery('html') }
		  bodyelem.animate({
		    scrollTop:0
		  }, 'fast' );
		// return contact form shortcode
		if(_val == 'contactform'){
			if(contentMultiplyCount>0)
				str += '[/' + _val + ']' + _return;
			return send_to_editor(str);
		}
		// return nested or optionally wrapped shortcodes
		if( _nestedName || optionalWrap.length >0 ){
			for(var i in shortCode){
				attsNum = attsMultiplyCount/contentMultiplyCount;
				slice1 = attsNum*i;
				slice2 = (attsNum*i)+attsNum;
				if(optionalWrap.length >0){
					str += '[' + _val + multiplyAtts.slice(slice1,slice2).join('') + ']'+ scContent[i] + '[/' + _val + ']' + _return;
				} else {
					str += '[' + _nestedVal + multiplyAtts.slice(slice1,slice2).join('') + ']'+ scContent[i] + '[/' + _nestedVal + ']' + _return;
				}
			}
			if(optionalWrap.length >0){
				if(optionalWrap.length == 2){
					return send_to_editor('[' + optionalWrap[1] + ']' + _return + str + '[/' + optionalWrap[1] + ']' + _return);
				} else {
					return send_to_editor(str);
				}
			} else {
				return send_to_editor('[' + _val + scAtts.join('') + ']' + _return + str + '[/' + _val + ']' + _return);
			}
		}
		// return shortcodes with content
		if(shortCode.length >0){
			for(var i in shortCode){
				attsNum = attsCount/contentCount;
				slice1 = attsNum*i;
				slice2 = (attsNum*i)+attsNum;
				if(carriageReturn){
					str += '[' + shortCode[i] + scAtts.slice(slice1,slice2).join('') +']' + _return + scContent[i] + _return + '[/' + shortCode[i] + ']' + _return;
				} else {
					str += '[' + shortCode[i] + scAtts.slice(slice1,slice2).join('') +']' + scContent[i] + '[/' + shortCode[i] + ']' + _return;;
				}
			}
			if ( _has_row == true ) {
				str = '[row_fluid]\n' + str + '[/row_fluid]\n';
			}
			return send_to_editor(str);
		}
		// return all other shortcodes
		return send_to_editor('[' + _val + scAtts.join('') + ']');
	});
};