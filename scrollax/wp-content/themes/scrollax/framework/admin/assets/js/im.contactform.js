/**
 * Contact form functions
 */
missAdmin.cloneContactForm = function() {
	jQuery('#multiply_contactform').click(function(e){
		_this = jQuery(this).parent();
		el = _this.parent().parent().children(':visible');
		count = el.length;
		_clone = 'clone_' + _this.children().eq(0).val();
		var newClone = jQuery('.'+_clone).clone().find('*').each( function(){
			var attrId = jQuery(this).attr('id');
			if (attrId) jQuery(this).attr('id', attrId.replace('#',count));
			var attrName = jQuery(this).attr('name');
			if (attrName) jQuery(this).attr('name', attrName.replace('#',count));
			var attrFor = jQuery(this).attr('for');
			if (attrFor) jQuery(this).attr('for', attrFor.replace('#',count));
		}).end()
		.appendTo('.contactform_toggle_container').css('display', 'block')
		.removeClass(_clone).removeClass('contactform_clone').addClass('contact_form_custom');
		e.preventDefault();
	});
};

missAdmin.deleteContactForm = function() {
	jQuery('.contactform_field_deletion').live( 'click', function(){
		jQuery(this).parent().parent().remove()
		return false;
	});
};

missAdmin.responderContactForm = function() {
	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();
	jQuery(':input').live('keyup', function(e){
	    delay(function(){
			var tags = new Array();
			_this = jQuery('#shortcode_contactform');
			_this.find(':input').each( function() {
				_id = jQuery(this).attr('id');
				if(_id){
					if( (_id.match(/\bsc-contactform-label/)) && (jQuery(this).val()) ){
						tags.push('%' + jQuery(this).val() + '%')
					}
				}
			});
			_this.find('.contactform_available_tags span').html( '%return%&nbsp;&nbsp;&nbsp;&nbsp;' + tags.join('&nbsp;&nbsp;&nbsp;&nbsp;'));
	    }, 500 );
	});
};
