/*
 * Contact ajaxForm
 */
(function($)
{
	$(function() {
		try {
			
			$('div.miss_form > form').ajaxForm({
				
				data: { '_miss_form_ajax_submit': 1 },
				dataType: 'json',
				success: function(data) {
					if($.browser.safari){ bodyelem = $('body') } else { bodyelem = $('html') }
					
					jQuery(data.into).find(':input').each(function() {
						jQuery(this).removeClass('required_error');
					});
					
					if(data.errors) {
						
						if(data.errored_fields){
							$('.miss_message').remove();
							for(var i in data.errored_fields){
							    $('#' +data.errored_fields[i]).addClass('required_error');
							}
							bodyelem.animate({ scrollTop: $(data.into).offset().top-80
					  		}, 'slow', function(){
								jQuery('.miss_contact_feedback').css('display','none');
							});
						}
						
						if(data.errored_fields == '' || !data.sidebar){
							if(data.errors) {
							  	bodyelem.animate({
							    	scrollTop: $(data.into).offset().top-80
							  		}, 'slow', function(){
										$('.miss_message').remove();
										$(data.errors).css('display', 'none').prependTo(data.into).slideDown('slow');
										jQuery('.miss_contact_feedback').css('display','none');
								});
							}
						}
					}
					 
					if( data.mail_sent ) {
						$('.miss_message').remove();
						$(data.into + ' > form').remove(); 
						bodyelem.animate({
					    	scrollTop: $(data.into).offset().top-80
					  		}, 'slow', function(){
								$(data.success).css('display', 'none').prependTo(data.into).slideDown('slow');
								jQuery('.miss_contact_feedback').css('display','none');
						});
					}
				}
				 
			});
			
		} catch (e) {
			//suppress error
		}
	});
	
})(jQuery);