var irishCall = {}

irishCall.animate = function() {
    if (jQuery.exists('.im-animate-element')) {
        jQuery(".im-animate-element:in-viewport").each(function (i) {
            var $this = jQuery(this);
            if (!$this.hasClass('im-in-viewport')) {
                setTimeout(function () {
                    $this.addClass('im-in-viewport');
                }, 200 * i);
            }
        });
    }
}

irishCall.is_touch = function() {
    return !!('ontouchstart' in window) || !! ('onmsgesturechange' in window);
}

irishCall.likeThis = function() {
    jQuery(".miss_hearts").click(
        function() {
            //var permalink = jQuery(this).attr("href");
            var post_id = jQuery(this).attr("data-id"),
                el = jQuery(this);
                jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: { 'miss-like': 1, 'post_id': post_id },
                    beforeSend: function(x) {
                        if(x && x.overrideMimeType) {
                            x.overrideMimeType('application/json;charset=UTF-8');
                        }
                    },
                    complete: function() {
                    },
                    success: function(data) {
                        el.find(".number").text( data.response.count );
                        if ( data.response.state === "dislike" ) {
                            el.removeClass("active");
                            el.find("i").attr("class", "fa-icon-heart-empty icon");
                        } else {
                            el.addClass("active");
                            el.find("i").attr("class", "fa-icon-heart icon");
                        }
                    }
                });
            return false;
        }
    );
}

// Work with retina
;(function() {
  "use strict";
    var device = (typeof exports == 'undefined' ? window : exports);
    var isRetina = function(){
    var mediaQuery = "(-webkit-min-device-pixel-ratio: 1.5),\
                      (min--moz-device-pixel-ratio: 1.5),\
                      (-o-min-device-pixel-ratio: 3/2),\
                      (min-resolution: 1.5dppx)";

    if (device.devicePixelRatio > 1) {
      return true;
    }

    if (device.matchMedia && device.matchMedia(mediaQuery).matches) {
      return true;
    }
    return false;
  }

  if ( isRetina() ) {
    jQuery('img[data-retina]').each( function(e) {
        var retinaSrc = jQuery(this).attr('data-retina');
        if ( retinaSrc.length > 0 ) {
            console.log('Task:' + jQuery(this).attr('src') + ' <- change to -> ' + retinaSrc );
            jQuery(this).attr('src', retinaSrc);
            console.log('Changed:' + jQuery(this).attr('src') );
        }
    });
  }


})();


;(function(){
    "use strict";
    jQuery(document).ready(function(){

        //Mobile Fix
        if ( irishCall.is_touch() ) {
            jQuery('nav.main_menu > ul > li > a').click(function() {
                var el = jQuery(this);
                if ( !el.hasClass("hover") ) {
                    el.addClass("hover");
                    return false;
                } else {
                    window.location.replace( el.attr("href") );
                }
            });
        }

        // jQuery content preloader
        jQuery('body.has_jpreloader').jpreLoader({
            loaderVPos: '50%'
        });

        // function is_touch_device() {
        //     return !!('ontouchstart' in window) || !! ('onmsgesturechange' in window);
        // }
        if ( irishCall.is_touch() || jQuery(window).width() < 768 ) {
            jQuery('body').removeClass('im-transform');
        }

        function reduceElements() {
            if ( jQuery(window).width() < 979 ) {
                //Remove sticky menu handler for responsive layout
                jQuery('header.header').removeClass('sticky');
                // jQuery('header.header').attr('style','');
                // jQuery('.fullwidthbanner, .fullwidthbanner .banner').css("height","auto");
                jQuery('header.header').removeClass('sticky');
            }
        }

        reduceElements();

        jQuery(window).resize( function() {
            reduceElements();
        });

        jQuery.exists = function (el) {
            return (jQuery(el).length > 0);
        };

        /**
         * Search Form Navigation
         */
        jQuery(".search-button").toggle(
            function() {
                var el = jQuery(this);
                el.siblings(".search-form").fadeIn( 400 ).animate({ opacity: 1 }, { duration: 800, easing: 'easeInOutCirc' });
                return false;
            },
            function() {
                var el = jQuery(this);
                 el.siblings(".search-form").fadeOut( 400 );
                return false;
            }
        );


        /* Animated Contents */
        /* -------------------------------------------------------------------- */

        // function im_animated_contents() {
        //     if (jQuery.exists('.im-animate-element')) {
        //         jQuery(".im-animate-element:in-viewport").each(function (i) {
        //             var $this = jQuery(this);
        //             if (!$this.hasClass('im-in-viewport')) {
        //                 setTimeout(function () {
        //                     $this.addClass('im-in-viewport');
        //                 }, 200 * i);
        //             }
        //         });
        //     }
        // }

        irishCall.animate();

        //im_animated_contents();
        jQuery(window).scroll(function () {
            irishCall.animate();
            //im_animated_contents();
        });

        jQuery(".tweet_holder").find(".loading").remove();
            jQuery(".tweet_holder").cycle({
                fx: "scrollUp",
                easing: "easeInOutCirc",
                prev:   '.twitter_controls .twitter-prev',
                next:   '.twitter_controls .twitter-next'
        })

        jQuery(function(){

        missTheme.el = {
            'head': jQuery("header"),
            'navbar': jQuery("header.header").find(".navbar-relative-top"),
            'logoContainer': jQuery("header .header-inner .company_logo")
        };
        /* Navigation */
        if ( missTheme.options.header.params.height === null ) {
            missTheme.options.header.params.height = missTheme.el.head.height();
        }
        /* Logo Margins Resize */
        if ( jQuery( 'header.header' ).hasClass('sticky') ) {
            var $pos = jQuery('header.header.sticky').offset().top - 0,
                header_height = jQuery(".header.sticky").height();
                jQuery(window).on('scroll', function(){

                    if(jQuery(window).scrollTop() > $pos ) {

                        /**
                         * Add header class
                         */

                        header_height = jQuery(".header.sticky").height();

                        jQuery('header.header.sticky').addClass('fixed');
                        // Add custom margins for WP admin menu
                        if ( jQuery("#wpadminbar").length > 0 && jQuery("#wpadminbar").height() ) {
                            var sticky_opacity = jQuery('header.header.fixed').attr('data-opacity');
                            //header_height += jQuery("#wpadminbar").height();
                            jQuery('header.header.fixed').css( { 'margin-top': Math.round( jQuery("#wpadminbar").height() ) +'px', 'opacity': sticky_opacity } );
                        }

                        // jQuery("#ascrail2000-hr").css('margin-top', "-" + header_height + 'px');

                        /**
                         * Resize Logo
                         */
                    //     jQuery('header.header.sticky').find(".site_logo, .site_title").each(
                    //         function() {
                    //         //img.main_header_logo")
                    //             if ( missTheme.options.logo.options.width === null || missTheme.options.logo.options.height === null ) {
                    //                 missTheme.options.logo.options.width = jQuery(this).find("img.main_header_logo.primary-logo").width(),
                    //                 missTheme.options.logo.options.height = jQuery(this).find("img.main_header_logo.primary-logo").height();
                    //                 /* missTheme.options.logo.options.container_height = jQuery(this).height();*/
                    //             }
                    //             if ( missTheme.options.logo.options.width !== null || missTheme.options.logo.options.height !== null ) {
                    //                 jQuery(this).stop().animate(
                    //                   { "line-height": Math.round( missTheme.options.header.params.height /  missTheme.options.header.params.proportion ) + 'px'},
                    //                   { duration: missTheme.options.header.params.speed }
                    //                 );
                    //                 jQuery(this).find("img.primary-logo").stop().animate(
                    //                     {
                    //                         width:  Math.round( missTheme.options.logo.options.width /  missTheme.options.logo.options.proportion ) + 'px',
                    //                         height: Math.round( missTheme.options.logo.options.height /  missTheme.options.logo.options.proportion ) + 'px'
                    //                     },
                    //                     { duration: missTheme.options.header.params.speed }  );
                    //             }
                    //             //missTheme.options.logo.options.fontsize = jQuery(this).find(".site-text-logo").css("font-size");
                    //             jQuery(this).find(".site-text-logo").stop().animate(
                    //                 {
                    //                     'line-height': missTheme.options.header.params.height/2 + 'px',
                    //                     'font-size': missTheme.options.logo.options.fontsize / 2 + 'px'
                    //                 },
                    //                 { duration: missTheme.options.header.params.speed }
                    //             );
                        
                    //     missTheme.el.head.css('overflow','visible');
                    // }

                    // );
                    } else {

                        // jQuery("#ascrail2000-hr").css('margin-top', '0px');

                        // jQuery('header.header.sticky').find(".site_logo, .site_title").each(
                        //     function () {
                        //         if ( missTheme.options.logo.options.width !== null || missTheme.options.logo.options.height !== null ) {
                        //             jQuery(this).stop().animate( { 'line-height': Math.round( missTheme.options.header.params.height ) + 'px' }, {duration: 100 }  );
                        //             jQuery(this).find("img").stop().animate( { width: missTheme.options.logo.options.width + 'px', height: missTheme.options.logo.options.height + 'px' }, {duration: 100 }  );
                        //         }
                        //         /*
                        //          * Resize Navigation
                        //          */
                        //         // jQuery("header.header").find('.nav > li > a, .nav > li > a > i, .nav .nav-search-box').resizeNavbar(0, 0, ( missTheme.options.header.params.height ) );
                        //         // jQuery(this).find(".site-text-logo").stop().animate(
                        //         //     {
                        //         //         'height': missTheme.options.header.params.height + 'px',
                        //         //         'line-height': missTheme.options.header.params.height + 'px',
                        //         //         'font-size': missTheme.options.logo.options.fontsize + 'px'
                        //         //     },
                        //         //     { duration: missTheme.options.header.params.speed }
                        //         // );
                        //     }

                        // );
                        /*
                         * Resize Header
                         */

                        // missTheme.el.head.stop().animate( {
                        //     height: Math.round( missTheme.options.header.params.height ) + 'px',
                        //     'min-height': Math.round( missTheme.options.header.params.height ) + 'px'
                        // }, { duration: missTheme.options.header.params.speed }  );
                        // missTheme.el.head.css('overflow','visible');

                        if ( jQuery("#wpadminbar").height() ) {
                            jQuery('header.header.fixed').animate( { 'margin-top': 0 },500 );
                        }

                        jQuery('header.header.sticky').css( { 'margin-top' : 0, 'opacity': 1 } );
                        jQuery('header.header.sticky').removeClass('fixed');
                    }
                });

            }


        });



        // Initiate like buttons
        irishCall.likeThis();

        /* BuddyPress Functionality */
        jQuery('#new-topic-button').toggle(
            function() {
                jQuery("#new-topic-post").slideDown('slow');
                return false;
            },
            function() {
                jQuery("#new-topic-post").slideUp('fast');
                return false;

            }
            
        );

        /* WooCommerce Functionality */
        jQuery('.product_meta .sku_wrapper').prepend('<i class="im-icon-stack-2" />');
        jQuery('.product_meta .posted_in').prepend('<i class="im-icon-stack-list" />');
        jQuery('.product_meta .tagged_as').prepend('<i class="im-icon-tag-7" />');


        /**
         * Framed Tabs
         */
        if(jQuery('ul.tabs').length > 0){
            jQuery('ul.tabs').tabs('> .tabs_content');
        }

        if(jQuery('ul.tabs.vertical').length > 0){
            jQuery('ul.tabs.vertical').tabs('> .tabs_content.vertical');
            jQuery('ul.tabs.vertical').data('tabs').onBeforeClick(function(e,index) {
                this.getTabs().parent().removeClass('current');
                this.getTabs().eq(index).parent().addClass('current');



            });
        }
        if(jQuery('ul.blog_tabs').length > 0){
            jQuery('ul.blog_tabs').tabs('> .blog_tabs_content');
            jQuery('ul.blog_tabs').data('tabs').onClick(function(index) {
                
            });
        }

        /* Tabs */
        // var tabContainers = jQuery('div.tabs > div');
        // tabContainers.hide().filter(':first').show();
        // jQuery('div.tabs ul.tabNavigation a').click(function () {
        //     tabContainers.hide();
        //     tabContainers.filter(this.hash).show();
        //     jQuery('div.tabs ul.tabNavigation a').removeClass('current');
        //     jQuery(this).addClass('active');
        //     return false;
        // }).filter(':first').click();

        /**
         * Vertical Tabs
         */

        jQuery(".tabs_container.vertical").each(function () {
            var maxHeight = 0,
                tabHeight = jQuery(this).find("ul.tabs.vertical").height();

            jQuery(this).find(".tabs_content.vertical .tabs_wrap").each( function () {
                var outerHeight = jQuery(this).parent().outerHeight();
                if ( outerHeight > maxHeight ) {
                    maxHeight = outerHeight;
                }
            });

            if ( tabHeight > maxHeight ) {
                maxHeight = tabHeight;
            }
            if ( tabHeight < maxHeight ) {
                tabHeight = maxHeight;
            }
            jQuery(this).find("ul.tabs.vertical").animate({ 'min-height' : (tabHeight + 40) + 'px' }, 500 );
            jQuery(this).find(".tabs_content.vertical .tabs_wrap").animate({ 'min-height' : maxHeight + 'px' }, 500 );
        });

        /* Hot Updates */
        jQuery('.hot_updates_tabs li a').click( function() {
            var target = jQuery(this).attr('data-target');
            jQuery('.hot_updates .wrap ul').slideUp('fast');
            jQuery('.hot_updates_tabs li a').removeClass('current');
            jQuery(this).addClass('current');
            jQuery('.hot_updates .wrap .' + target ).slideDown('slow');
        });
        /* gMap Fix:on-show */
        if( typeof gmap_id_1 !== "undefined" ) { 
            if ( gmap_id_1 !== null ) {
                    jQuery('#gmap_id_1').on('shown', function () {
                    google.maps.event.trigger(gmap_id_1, 'resize');
                });
            }
        }
        if( typeof gmap_id_2 !== "undefined" ) { 
            if ( gmap_id_2 !== null ) {
                    jQuery('#gmap_id_2').on('shown', function () {
                    google.maps.event.trigger(gmap_id_2, 'resize');
                });
            }
        }
        if( typeof gmap_id_3 !== "undefined" ) { 
            if ( gmap_id_3 !== null ) {
                    jQuery('#gmap_id_3').on('shown', function () {
                    google.maps.event.trigger(gmap_id_3, 'resize');
                });
            }
        }
        if( typeof gmap_id_4 !== "undefined" ) { 
            if ( gmap_id_4 !== null ) {
                    jQuery('#gmap_id_4').on('shown', function () {
                    google.maps.event.trigger(gmap_id_4, 'resize');
                });
            }
        }



        /* gMap nav Menu Fix */
        if (jQuery("nav").find(".msmw_map").length > 0 ) {
            jQuery("nav li > a").on("hover", function() {
                jQuery(this).parent().find(".msmw_map").each( function() {
                    if( typeof jQuery(this).attr('id') !== "undefined" ) { 
                        if ( jQuery(this).attr('id') !== null ) {
                            google.maps.event.trigger(jQuery(this).attr('id'), 'resize');
                            if( typeof gmap_id_1 !== "undefined" ) { 
                                google.maps.event.trigger(gmap_id_1, 'resize');
                            }
                            if( typeof gmap_id_2 !== "undefined" ) { 
                                google.maps.event.trigger(gmap_id_2, 'resize');
                            }
                            if( typeof gmap_id_3 !== "undefined" ) { 
                                google.maps.event.trigger(gmap_id_3, 'resize');
                            }
                            if( typeof gmap_id_4 !== "undefined" ) { 
                                google.maps.event.trigger(gmap_id_4, 'resize');
                            }

                        }
                    }
                } );
            });
        }
    });
})();

(function() {
        var b;
        jQuery(".container.partners").hover(function () {
            clearTimeout(b)
        }, function () {
            setTimeout(function () {
                jQuery("img", ".container.partners").stop().animate({
                    scale: 1,
                    opacity: 1
                }, 400).removeClass("active")
            }, 400)
        });
        var a = jQuery(".container.partners");
        jQuery("img", a).mouseover(function (d) {
            var c = jQuery(this);
            if (!c.hasClass("active")) {
                jQuery("img.active", a).removeClass("active");
                c.addClass("active");
                jQuery("img:not(.active)", a).stop().animate({
                    scale: 0.8,
                    opacity: 0.3
                }, 400);
                jQuery("img.active", a).stop().animate({
                    scale: 1,
                    opacity: 1
                }, 200)
            }
        });

} )();

(function() {
        /* Sticky sidebar */
        if ( jQuery( '.sidebar' ).length > 0 ) {
            if ( jQuery( '.sidebar' ).hasClass('sticky') && jQuery(window).width() > 767 ) {
                var sidebar_initial_position = jQuery( '.sidebar' ).offset().top,
                    header_height = jQuery("header.header").height(),
                    site_info = jQuery("section.site_info").height(),
                    s_all_offsets = jQuery("section.site_info").height() + jQuery("section.page_caption").height(),
                    s_header_height = 0, s_after_header_height = 0, s_max_path_size = 0, s_current_position = 0, sidebar_position = 0;
                    max_content_height = 0,
                    content_top = 0,
                    fixed_elements = 0,
                    offset_top = 0,
                    offset_bottom = 0,
                    sidebar_initial_position = sidebar_initial_position - header_height - site_info;
                    // sidebar_initial_position = sidebar_initial_position.top;
                    // sidebar_initial_position = sidebar_initial_position;

                    console.log( sidebar_initial_position );

                    jQuery(window).on('scroll', function(){
                        clearTimeout(jQuery.data(this, 'scrollTimer'));

                        jQuery.data(this, 'scrollTimer', setTimeout(function() {

                            if( jQuery(window).scrollTop() > sidebar_initial_position ) {


                                // console.log( sidebar_initial_position );

                                sidebar_initial_position = jQuery( '.primary_content' ).offset().top + header_height;

                                fixed_elements = 0;
                                if ( jQuery( '#wpadminbar' ).length > 0 ) {
                                    fixed_elements += jQuery("#wpadminbar").height();
                                }
                                if ( jQuery( 'header.header.sticky' ).length > 0 ) {
                                    fixed_elements += jQuery("header.header").height()
                                }


                                // console.log( sidebar_initial_position );

                                // if ( jQuery( 'section.after_header' ).length > 0 ) {
                                //     minus += jQuery("section.after_header").height();

                                //     // console.log( minus );
                                // }
                                // if ( jQuery( '.slider_module' ).length > 0 ) {
                                //     minus += jQuery(".slider_module").height();

                                //     // console.log( minus );
                                // }



                                // sidebar_initial_position = sidebar_initial_position - minus;

                                // console.log( sidebar_initial_position );
                                // max_content_height = jQuery('section.main_content').offset().top + jQuery('section.main_content').height() + header_height;
                                // sidebar_initial_position = jQuery('section.main_content').offset().top;
                                // /**
                                //  * Add sidebar class and re-count top property
                                //  */
                                // if ( jQuery( 'header.header' ).hasClass('sticky') ) {
                                //     s_header_height = 0;
                                // } else {
                                //     s_header_height = header_height;
                                // };

                                // if ( jQuery( 'section.after_header' ).length > 0 ) {
                                //     s_after_header_height = jQuery("section.after_header").height();
                                // } else if ( jQuery( '.slider_module' ).length > 0 ) {
                                //     s_after_header_height = jQuery(".slider_module").height();
                                // } else {
                                //     s_after_header_height = 0;
                                // }
                                // s_max_path_size = max_content_height;// + jQuery("header.header").height();
                                // s_current_position = jQuery(window).scrollTop() + jQuery('.sidebar.sticky').height() + s_all_offsets;
                                offset_top = jQuery(window).scrollTop() - jQuery('.primary_content').offset().top;

                                offset_bottom = ( jQuery('.primary_content').height() - jQuery('.sidebar').height() ) - offset_top;



                                if ( offset_bottom > 0 ) {
                                } else {
                                    offset_bottom = 0;
                                }

                                s_current_position = jQuery(window).scrollTop() + fixed_elements;
                                s_max_path_size = jQuery('.primary_content').height() - jQuery('.sidebar').height();

                                // s_current_position = s_current_position

                                if (  offset_top > 0 ) {
                                    offset_top += fixed_elements;
                                   //s_current_position = jQuery(window).scrollTop() + jQuery("header.header").height() - offset_top;
                                } else {
                                    offset_top = 0;
                                }
                                    // s_current_position = jQuery(window).scrollTop() + jQuery("header.header").height() - offset_top;


                                // Sidebar offset
                                if ( s_max_path_size > s_current_position ) {
                                    sidebar_position = offset_top;
                                } else if ( s_max_path_size < s_current_position ) {
                                    //sidebar_position = sidebar_position;
                                    console.log(' s_max_path_size < s_current_position ');
                                }
                            } else {
                                /**
                                 * Remuve sidebar class
                                 */
                                sidebar_position = 0;
                            }

                            jQuery('.sidebar.sticky').animate( { 'margin-top': sidebar_position + 'px' }, { duration: 1000, easing: 'easeInOutCirc' } );

                        }, 1050));
                    }
                );
            };
        };
} )();
;(function() {
    "use strict";
    // jQuery(".tabs_container.vertical .tabs.vertical li").click(
    // 	function() {
    //         var el = jQuery(this).parent().parent(),
    //         	maxHeight = 0,
    //         	tabHeight = jQuery(this).find("ul.tabs.vertical");
    //         el.find(".tabs_content.vertical .tabs_wrap").each( function () {
    //             var outerHeight = el.parent().outerHeight();
    //             if ( outerHeight > maxHeight ) {
    //                 maxHeight = outerHeight;
    //             }
    //         });
    //         if ( tabHeight > maxHeight ) {
    //         	maxHeight = tabHeight;
    //         } else {
	   //          el.find("ul.tabs.vertical").animate({ 'min-height' : maxHeight }, 500 );
    //         }
    //         el.find(".tabs_content.vertical .tabs_wrap").animate({ 'min-height' : maxHeight }, 500 );
    // 	}
    // );

    //Fixing tabs by adding current class to first class
    // if (jQuery("nav").find("ul.tabs").length > 0 ) {
    //     alert(jQuery("nav").find("ul.tabs li a.current").length);
    //     if ( jQuery("nav").find("ul.tabs li a.current").length == 0 ) {
    //      alert(1);
    //         jQuery("nav li > a").on("hover", function() {
    //             jQuery(this).parent().find('ul.tabs li.current a').addClass('current');
    //         });
    //     }
    // }
})();
