missAdmin.colorPicker = function() {
	jQuery( '.bootstrap-colorpicker' ).ColorPicker().on( 'changeColor',
		function( el ){
			alert(el.toHex().color);
			jQuery(this).parent().find("span.add-on i").css('background-color', el.toHex().color );
		}
	);
	jQuery('[id*=_picker]').each(function(i){
		var _this = jQuery(this),
		_color = _this.next('input');
		jQuery(_this).children('div').css('backgroundColor', _color.val());
		jQuery(_color).keyup(function(event) { 
			var s = jQuery(this).val();
			var sub1 = s.substr(0, 1),
			    sub2 = s.substr(0, 2);
			if( (sub1 != '#' && sub1 != 'i' && sub1 != 't' && sub1 != 'r') && (sub2) ){
				jQuery(this).val('#'+sub1);
			}
			jQuery(_this).children('div').css('backgroundColor', jQuery(this).val());
		});
		
		jQuery(_this).ColorPicker({
			color: _color.val(),
			onShow: function (colpkr) {
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				jQuery(_this).children('div').css('backgroundColor', '#' + hex);
				jQuery(_this).next('input').attr('value','#' + hex);
			}
		});
		
		/* jQuery(_this).colorpicker().on({
			'hide' : function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			'show' : function (colpkr) {
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			'changeColor' : function (hsb, hex, rgb, rgba) {
				jQuery(_this).children('div').css('backgroundColor', '#' + hex);
				jQuery(_this).next('input').attr('value','#' + hex);
			}
		});
		*/
	}); //end each
};
