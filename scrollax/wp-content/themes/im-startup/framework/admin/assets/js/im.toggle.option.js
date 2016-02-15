missAdmin.optionToggle = function() {
	var toggle = jQuery('.toggle_true'),
	    val;
	toggle.each(function() {
		if(jQuery(this).is('select')){
			val = jQuery(this).val();
		}else{
			_this = jQuery(this);
			chk = _this.attr('checked');
			if(chk){
				val = jQuery(this).val();
			}
		}
		var nameMatch = jQuery(this).attr('name').match(/\[[^\]]*/),
			_name = ( nameMatch )? nameMatch[0].replace( '[', '') : jQuery(this).attr('name'),
			el = jQuery('*[class^="'+_name+'_"]'),
		    attrID = _name + '_' +val;
		el.each(function() {
			if(jQuery(this).hasClass(attrID)){
				jQuery(this).css({display:"block"});
			}else{
				jQuery(this).css({display:"none"});
			}
		});
		jQuery(this).change(function() {
			var _id = jQuery(this).attr('id');
			if(_id == 'slider_custom_1' || _id == 'slider_custom_2' || _id == 'homepage_slider') {
				missAdmin.clearSliderHeight();
			}
			var nameMatch = jQuery(this).attr('name').match(/\[[^\]]*/),
				_name = ( nameMatch )? nameMatch[0].replace( '[', '') : jQuery(this).attr('name'),
			    attrID = _name + '_' +jQuery(this).val();
			el.each(function() {
				if(jQuery(this).hasClass(attrID)){
					jQuery(this).css({display:'block'});
				}else{
					jQuery(this).css({display:'none'});
				}
			});
			if(_id == 'slider_custom_1') {
				missAdmin.refreshSliderHeight();
			}
		});
	});
};
