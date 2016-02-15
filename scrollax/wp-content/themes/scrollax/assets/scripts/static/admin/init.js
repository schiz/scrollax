jQuery(document).ready(function(){
	jQuery('#app_customfilter').css('display','none');
	jQuery('#app_customhome').css('display','none');

	if (jQuery("#page_template").val() == "template-work-category.php") {
		jQuery('#app_customfilter').slideDown("slow");
	}
	if (jQuery("#page_template").val() == "template-home.php") {
		jQuery('#app_customhome').slideDown("slow");
	}

	jQuery("#page_template").change(function () {
		if (jQuery(this).val() == "template-work-category.php") {
			jQuery('#app_customhome').slideUp("slow");		
			jQuery('#app_customfilter').slideDown("slow");
		} else if (jQuery(this).val() == "template-home.php") {
			jQuery('#app_customfilter').slideUp("slow");
			jQuery('#app_customhome').slideDown("slow");		
		} else {
			jQuery('#app_customhome').slideUp("slow");		
			jQuery('#app_customfilter').slideUp("slow");
		}
	});
});
