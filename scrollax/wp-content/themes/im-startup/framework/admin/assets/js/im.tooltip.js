missAdmin.tooltipHelp = function() {
		jQuery('.miss_option_help a.tooltip-icon').click(function(e){
			e.preventDefault();
		});
		jQuery('.miss_option_help a.tooltip-icon').live('mouseover',function(){
		   if (!jQuery(this).hasClass("tooledUp")){
		      jQuery(this).tooltip({ delay: 150, predelay: 0, effect: 'slide', relative: true, direction: 'top', offset: [-4, -138], opacity: 0.9, relative: true, tipClass: 'miss_help_tooltip' });
		      jQuery(this).tooltip().show();
		      jQuery(this).addClass("tooledUp");
		      }
		});
};