jQuery(window).load(function() {
		jQuery(".flex-direction-nav li a.flex-next").html('<i class="fa-icon-chevron-right"></i>');
		jQuery(".flex-direction-nav li a.flex-prev").html('<i class="fa-icon-chevron-left"></i>');

		jQuery('.flexslider').flexslider({
			animation: "slide",
			easing: "easeInOutCirc",
			slideDirection: "horizontal"
			}
		);
		jQuery('.flexslider').find(".im-transform").addClass("im-in-viewport");
		jQuery('.flexslider2').flexslider({
			animation: "slide",
			slideDirection: "horizontal",
	        start: function(slider) {
	        //    var $new_height = slider.slides.eq(0).height();
	            var $new_height = slider.slides.eq(0).height();
	            slider.height($new_height);
	        },
	        before: function(slider){
	            var $new_height = slider.slides.eq(slider.animatingTo).height();
	            if($new_height != slider.height()){
	                slider.animate({ height: $new_height  }, 300);
	            }
	        }
		});
});
