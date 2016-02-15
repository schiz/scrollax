jQuery(document).ready(function(){
    scrollWrapper = jQuery('.scroll-box');
    scrollContent = jQuery('.scroll-box .grid');
/*
    if( Modernizr.touch == false ){

        scrollWrapper.mousewheel(function(event, delta, deltaX, deltaY) {
            var currentScroll = parseInt( jQuery(this).scrollLeft());
            jQuery(this).scrollLeft( currentScroll + (-deltaY*100) );
            var finalRight = ((scrollContent.width() -   jQuery(this).scrollLeft()) == scrollWrapper.width());
            var finalLeft =  (jQuery(this).scrollLeft() == 0);
            if( finalRight && (deltaY < 0) ) {
                var windowScroll = jQuery(window).scrollTop();
                windowScroll +=50;
                jQuery(window).scrollTop(windowScroll);
            } else if(finalLeft && (deltaY > 0) ){
                var windowScroll = jQuery(window).scrollTop();
                windowScroll -=50;
                jQuery(window).scrollTop(windowScroll);
            }
        });
    }
*/

        scrollWrapper.niceScroll({cursorcolor:"",
            cursorwidth:"16px",
            cursorborder:"none",
            enablemousewheel: false,
            cursorborderradius:"0px",
            cursoropacitymin:"1",
            background:"",
            railpadding:{top:"20px"}
        }).rail.css({'height':'15px'});

});


