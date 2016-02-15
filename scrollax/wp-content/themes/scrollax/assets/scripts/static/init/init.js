//if (Application) {
	if ( typeof(Application) === 'object' ) {
	//if ( typeof Application.Tweets.init() ) {
		/* Getting Tweets */
		Application.Tweets.init();
	}
//}

/* Static Options */
var options = {};
options.defaults = {
	flex: {
		works: {
			root: jQuery(".wp-carousel"),
			name: "wp-carousel",
			el: jQuery(".wp-carousel ul li"),
			total: jQuery(".wp-carousel ul li").length,
			limit: 4
		},
		partners: {
			root: jQuery(".partners"),
			name: "partners",
			el: jQuery(".partners .partners-wrap span2"),
			total: jQuery(".partners .partners-wrap span2").length,
			limit: 6
		},
		events: {
			root: jQuery(".wp-events"),
			name: "wp-events",
			el: jQuery(".wp-events ul li"),
			total: jQuery(".wp-events ul li").length,
			limit: 4
		}
	}
};

/* Fit Embedded Video */
jQuery('.video, .slide-content, .video-shortcode, .embedded').fitVids();

/* NoFlex Slider */
if(options.defaults.flex.works.total < options.defaults.flex.works.limit){
	options.defaults.flex.works.limit = 0;
}

if(options.defaults.flex.partners.total < options.defaults.flex.partners.limit){
	options.defaults.flex.partners.limit = 0;
}

if(options.defaults.flex.events.total < options.defaults.flex.events.limit){
	options.defaults.flex.events.limit = 0;
}
function flexBuilder (el, target, limit) {
	jQuery(function() {
		this.delay = false;
		el.touchwipe({
	     	wipeLeft: function() { jQuery("."+target+"-next").trigger("click"); },
	     	wipeRight: function() { jQuery("."+target+"-prev").trigger("click"); },
		});
		if (el.attr("data-autoplay") == true || el.attr("data-autoplay") == "true") {
			if ( el.attr("data-delay") ) {
				this.delay = el.attr("data-delay");
			}
		}
		el.find(".im-transform").addClass("im-in-viewport");
		var pdelay = parseInt(this.delay);
		//this.delay = el.attr("data-delay");
		el.jCarouselLite({
	        btnNext: "."+target+"-next",
	        btnPrev: "."+target+"-prev",
	        auto : pdelay,
	        speed: 500,
	        pauseOnHover: true,
	        easing : 'easeInOutCirc',
	        circular: true,
	        visible : limit,
	        scroll: 1
    	});
	});	
}

if(options.defaults.flex.works.total > 0){
	flexBuilder(
		options.defaults.flex.works.root,
		options.defaults.flex.works.name,
		options.defaults.flex.works.limit
	);
}

if(options.defaults.flex.partners.total > 0){
	flexBuilder(
		options.defaults.flex.partners.root,
		options.defaults.flex.partners.name,
		options.defaults.flex.partners.limit
	);
}

if(options.defaults.flex.events.total > 0){
}

/* Animation */
function addAnimation(el, a) {
	el.removeClass().addClass(a);
	var wait = window.setTimeout( function(){
		el.removeClass(a)
	},1300);
}
/* jQuery */
jQuery(document).ready(function(){
		jQuery('.flexslider').flexslider({
			animation: "slide",
			easing: "easeInOutCirc",
	        pauseOnHover: true,
			slideDirection: "horizontal"
			}
		);
		//Replace navi icons with font awesome
		jQuery(".flex-direction-nav li a.flex-next").html('<i class="fa-icon-chevron-right"></i>');
		jQuery(".flex-direction-nav li a.flex-prev").html('<i class="fa-icon-chevron-left"></i>');

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

jQuery('.loop_module.blog.blog_layout1 .loop_content.blog').each(function ( event ) {
	if ( jQuery(this).find('.meta_post_tag a').length > 3 ) {
	jQuery(this).find('.meta_post_tag').css({ 'float': 'left', 'clear': 'left' });
	}
} );
// .post_meta ').length );

	/* Variables */
	var footerHeight = jQuery('#footerwrap').outerHeight();
	var allPanels = jQuery('.accordion > .inner').hide();

	/* PrettyPhoto */
	jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
		overlay_gallery: false,
		social_tools: '',
		deeplinking: false,
		'theme': 'light_rounded'
	});
	//jQuery('.entry a').has('img').addClass('prettyPhoto');
	
	jQuery('.entry a img').click(function () {
	var desc = jQuery(this).attr('title');
	jQuery('.entry a').has('img').attr('title', desc);
	});
	
	jQuery("a[class^='prettyPhoto']").prettyPhoto({
		opacity: 0.50,
		theme: 'light_rounded',
		show_title: false,
		horizontal_padding: 20,
		deeplinking: false,
		social_tools: false
	});
	jQuery("span.AT").text('@');
	/* Init Preview Overlay */
/* 	miss_preview_overlay(".has_preview a"); */

	jQuery('#footerwrap').css({height: footerHeight});
	

	/* Animation */

	/* Close Parent */
	jQuery(".closeParent").click(
		function() {
			jQuery(this).parent().slideUp("slow");
		}
	);

	/* Progress Bar */
	jQuery(".progress-bars").each(function() {
		var delay;
		delay = 0;
		jQuery(this).find(".scorebar .scorebar-inner.has_animation").each(function () {
			var el = jQuery(this);
			delay = delay + 300;
			setTimeout(function () {
				el.animate({"width": el.attr("data-score")+"%" },500);
			}, delay);
			delay = delay + 300;
		});
	});

	/* Lazy Load */
	jQuery("img.loadOnVisible").lazyload({
		threshold : 200,
		effect: "fadeIn"
	});

	/* Navigatio Search */
	jQuery("#primary-nav .nav-search-box .search-button").click(
		function () {
			var el = jQuery(this).parent().find("input.search-input");
			var button = jQuery(this);
			if (button.attr("data-state") == "inactive") {
				button.attr("data-state", "active");
				el.animate(
					{
						'opacity': 1,
						'width': '150px'
					}, 500
				);
			} else {
				button.attr("data-state", "inactive");
				el.animate(
					{
						'opacity': 0,
						'width': '0px'
					}, 500
				);
			}
		}
	);

	/* Scroll to Top */
	jQuery("a[href='#top']").click(function() {
	  jQuery("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});

	/*
	each(function() {
		var delay;
		delay = 0;
		jQuery(this).find(".scorebar .scorebar-inner.has_animation").each(function () {
			var el = jQuery(this);
			delay = delay + 300;
			setTimeout(function () {
				el.animate({"width": el.attr("data-score")+"%" },500);
			}, delay);
			delay = delay + 300;
		});
	});
	*/

	/* Testimonials Live Feed */
	jQuery("#testimonials").cycle({
		fx: "scrollUp",
		easing: "easeInOutCirc",
		before: function() {
			jQuery(this).find('.author').animate({'opacity': 0}, 300);
			// jQuery(this).find('.author').removeClass('rollOut').addClass("rollIn");
		},
		after: function() {
			jQuery(this).find('.author').animate({'opacity': 1}, 300);
			// jQuery(this).find('.author').addClass('rollOut').removeClass("rollIn");
		}
	});

	/* Accordion */
	jQuery('.accordion > .title > a').click(function() {
		var el = jQuery(this);
		$target =  el.parent().next();
		if(!el.parent().hasClass('active')){
			allPanels.slideUp(500, 'easeOutCirc');
			$target.slideDown(500, 'easeOutCirc');
			el.parent().parent().find('.title').removeClass('active');
			el.parent().addClass('active');
		} else {
			allPanels.slideUp(500, 'easeOutCirc');
			el.parent().removeClass('active');
		}
		return false;
	});

	/* Toggle */
	jQuery(".toggle .title").toggle(function(){
		jQuery(this).addClass("active").closest('.toggle').find('.inner').slideDown(500, 'easeOutCirc');
		}, function () {
		jQuery(this).removeClass("active").closest('.toggle').find('.inner').slideUp(500, 'easeOutCirc');
	});

	/* Alert */
	jQuery(".alert-message a").click(function(){
		jQuery(this).parent().slideUp();
		return false;
	});
	/* Sticky */
	jQuery(window).load(function () {
		jQuery("#footerwrap").stickyFooter();
	});
	jQuery("ul.share_this_list li a.socialBookmark").click(
		function (event) {
		var width  = 675,
			height = 400,
			url = this.href,
			left = (jQuery(window).width()  - width)  / 2,
			top = (jQuery(window).height() - height) / 2,
			opts = 'status=1' +
				',width='  + width  +
				',height=' + height +
				',top='    + top    +
				',left='   + left;
			window.open(
				url,
				'sharethis',
				opts
			);
			return false;
		}
	);
});

/* Sidebar Nav */
var menuItemState = "fold";
jQuery(".widget_nav_menu ul.menu li ul.sub-menu").slideUp();
jQuery('.widget_nav_menu ul.menu li a').click(function () {
	var menuItem = jQuery(this).parent().find("ul.sub-menu");
	if (menuItem.html() != null) {
		if (menuItemState == "fold") {
			menuItem.slideDown();
			menuItemState = "unfold";
		} else {
			menuItem.slideUp();
			menuItemState = "fold";
		}
		return false;
	}
});



/* Plugins */
jQuery('#back-to-top a[href*=#]').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
	&& location.hostname == this.hostname) {
		var $target = jQuery(this.hash);
		$target = $target.length && $target || jQuery('[name=' + this.hash.slice(1) +']');
		if ($target.length) {
			var targetOffset = $target.offset().top;
			jQuery('html,body').animate({scrollTop: targetOffset}, 600);
			return false;
		}
	}
});

/*!
 * jQuery Cookie Plugin
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function($) {
	$.cookie = function(key, value, options) {
		// key and at least value given, set cookie...
		if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
			options = $.extend({}, options);
			if (value === null || value === undefined) {
				options.expires = -1;
			}
			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}
			value = String(value);
			return (document.cookie = [
				encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}
		// key and possibly options given, get cookie...
		options = value || {};
		var decode = options.raw ? function(s) { return s; } : decodeURIComponent;
		var pairs = document.cookie.split('; ');
		for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
			if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
		}
		return null;
	};
})(jQuery);

/* Sticky Footer Plugin */
(function($){
	var footer;
	$.fn.extend({
		stickyFooter: function(options) {
			footer = this;
			positionFooter();
			jQuery(window)
				.scroll(positionFooter)
				.resize(positionFooter);
			function positionFooter() {
				var docHeight = jQuery(document.body).height() - jQuery("#sticky-footer-push").height();
				if(docHeight < jQuery(window).height()){
					var diff = jQuery(window).height() - docHeight;
					if (!jQuery("#sticky-footer-push").length > 0) {
						jQuery(footer).before('<div id="sticky-footer-push"></div>');
					}
					jQuery("#sticky-footer-push").height(diff);
				}
			}
		}
	});
})(jQuery);
//prettyPrint();
