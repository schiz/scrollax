/*
 * @package IrishMiss
 * @subpackage Radiostation
 */
//jQuery.noConflict();

/* functions for emerging */ 
jQuery(document).ready(function() {
/* emerging_group */

    //jQuery(".emerging_group > *, .emerging_item").animate( {'opacity':'0'}, 10 );
	// jQuery(".emerging_group > div, .emerging_item").miss_emerging();
 //    jQuery(window).scroll( function(){
	// 	jQuery(".emerging_group > div, .emerging_item").miss_emerging();
 //    });

});
/* END functions for emerging */ 

jQuery(document).ready(function() {


	
	/* 
	 * Hover fade
	 */
	jQuery('.hover_fade_js').live('hover', function(e) {
		if( e.type == 'mouseenter' )
			jQuery(this).stop().animate({opacity:0.7},400);

		if( e.type == 'mouseleave' )
			jQuery(this).stop().animate({opacity:1},400);
	});
	
	/* 
	 * toggle functions 
	 */
	jQuery('.toggle').toggle(function(){
		jQuery(this).addClass('active');
		}, function () {
		jQuery(this).removeClass('active');
	});

	// jQuery('.toggle').click(function(){
	// 	jQuery(this).next('.toggle_content').slideToggle();
	// });
	
	jQuery('.toggle_frame_set').each(function(i) {
		var _this = jQuery(this),
		    accordion = _this.find('.toggle_accordion'),
            toggle = _this.find('.toggle'),
            action = "click";
        if ( jQuery(window).width() < 979 ) {
            action = "mouseover";
        }
        if ( accordion.length > 0 ) {
    		accordion.bind( action, function(){
    			if( jQuery(this).next().is(':hidden') ) {
    				_this.find('.toggle_accordion').removeClass('active').next().slideUp();
    				jQuery(this).toggleClass('active').next().slideDown();
    			} else {
    				_this.find('.toggle_accordion').removeClass('active').next().slideUp();
    			}
    			return false;
    		});
        }
        if ( toggle.length > 0 ) {
            toggle.bind( action, function(){
                if( jQuery(this).next().is(':hidden') ) {
                    // _this.find('.toggle').removeClass('active').next().slideUp();
                    jQuery(this).toggleClass('active').next().slideDown();
                } else {
                    _this.find('.toggle').removeClass('active').next().slideUp();
                }
                return false;
            });
        }
	});
	
	/* 
	 * image reflect functions 
	 */
	jQuery('img.reflect').reflect({height:0.5,opacity:0.5});
	
	/* 
	 * spam protction on mailto: links
	 */
	jQuery('a.email_link_noreplace').nospam({
		replaceText: false,
		filterLevel: 'normal'
	});
	jQuery('a.email_link_replace').nospam({
		replaceText: true,
		filterLevel: 'normal'
	});

	/* 
	 * Contact form submit
	 */
	jQuery('.contact_form_submit').click(function() {
		clearInterval(preLoaderSmall);
		preLoaderCount = 0;
		missPreloaderSmall('.miss_contact_feedback');
		jQuery(this).next().css('display','inline-block');
	});
	
	/* 
	 * "target_blank" links
	 */
	jQuery('.flickr_badge_image a').attr('target', '_blank');
	jQuery('.target_blank').attr('target', '_blank');
	
});




/**
* hoverIntent r5 // 2007.03.27 // jQuery 1.1.2+
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
* 
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @author    Brian Cherne <brian@cherne.net>
*/
//(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY;};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev]);}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev]);};var handleHover=function(e){var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(p&&p!=this){try{p=p.parentNode;}catch(e){p=this;}}if(p==this){return false;}var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);}if(e.type=="mouseover"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob);},cfg.timeout);}}};return this.mouseover(handleHover).mouseout(handleHover);};})(jQuery);


/**
 * Resize function for the search widget
 */

// function SearchInputResize() {
// 	var get_search_button_size = jQuery('#searchsubmit').width();
// 	var padding = get_search_button_size + 50;
// 	jQuery('.search-form div').css('padding-right',padding);
// }

