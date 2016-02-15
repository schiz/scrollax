
/**
 * ./work/im-startup/assets/scripts/static/isotope/infinitescroll.js
 * Generated: 2013-09-13 16:56:51 +0100
 */


var infinite_scroll={loading:{img:"<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",msgText:"<?php _e( 'Loading the next set of posts...', 'custom' ); ?>",finishedMsg:"<?php _e( 'All posts loaded.', 'custom' ); ?>"},nextSelector:".auto-more a",navSelector:".auto-more",itemSelector:".container-isotope",contentSelector:"#l1"};
/**
 * ./work/im-startup/assets/scripts/static/isotope/init.isotope.works.js
 * Generated: 2013-09-13 16:56:51 +0100
 */


jQuery(window).load(function(){var e=jQuery(".container-isotope");e.isotope({itemSelector:".autoload-item",animationEngine:"best-available",animationOptions:{duration:300,easing:"easeInOutBounce",queue:!1}}),jQuery(".isonav a").click(function(){jQuery(".isonav a").removeClass("iso-active"),jQuery(this).addClass("iso-active");var o=jQuery(this).attr("data-filter");return e.isotope({filter:o}),!1})}),jQuery(document).ready(function(){jQuery(function(){$pos=jQuery(".isonav").offset().top-0,jQuery(window).on("scroll",function(){})})});