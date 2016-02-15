missAdmin.resetUnlock = function () {
		jQuery('.miss_reset_button .locker').on('click',function(e){
			jQuery(this).toggleClass(function() {
			  if (jQuery(this).is('.unlock')) {
				var el = jQuery(this);
				setTimeout(function () {
					missFramework.unlock = true;
					el
						.parent(".miss_reset_button")
						.addClass("active");
				}, 500);
				setTimeout(function () {
					missFramework.unlock = false;
					el
						.parent(".miss_reset_button")
						.removeClass("active");
					el.removeClass('lock');
					el.addClass('unlock');
				},10000);
			    return 'lock';
			  } else {
				jQuery(this).parent().removeClass("active");
				missFramework.unlock = false;
			    return 'unlock';
			  }
			});
		});
};