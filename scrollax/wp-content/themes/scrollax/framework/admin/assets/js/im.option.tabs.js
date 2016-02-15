missAdmin.optionTabs = function() {
		jQuery('.miss_tab').css('display','none');
		jQuery('.miss_tab:first').css('display','block');
		jQuery('#miss_admin_tabs li:first').addClass('current');
		
		jQuery('#miss_admin_tabs li a').click(function(e){
			jQuery('#miss_admin_tabs li').removeClass('current');
			jQuery(this).parent().addClass('current');
			var clicked_tab = jQuery(this).attr('href');
			jQuery('.miss_tab').css('display','none');
			jQuery(clicked_tab).css('display','block');

			jQuery("#current_section_title span").text(jQuery(this).text());

			if(clicked_tab == '#miss_skins_tab'){
				//jQuery('.miss_admin_save').css('display','none');
				jQuery('.miss_reset_button').css('display','none');
				//jQuery('.miss_footer_submit').css('display','none');
			} else {
				jQuery('.miss_admin_save').css('display','block');
				jQuery('.miss_reset_button').css('display','inline-block');
				jQuery('.miss_footer_submit').css('display','inline-block');
			}
			e.preventDefault();
		});
};