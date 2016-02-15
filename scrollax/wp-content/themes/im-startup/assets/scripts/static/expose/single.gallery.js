jQuery(document).ready(function(){
    scrollWrapper = jQuery('.scroll-box');
    scrollContent = jQuery('.scroll-box .grid');
    scrollWrapper.niceScroll('.scroll-box .grid', {
        cursorcolor:miss_gallery_placeholder.color,
        cursorwidth:( miss_gallery_placeholder.height - 1 ) + "px",
        enablemousewheel: false,
        cursorborder:"none",
        cursorborderradius: miss_gallery_placeholder.radius + "px",
        cursoropacitymin:"1",
        background: miss_gallery_placeholder.bg,
        railpadding:{top:"0px"}
    }).rail.css({'height': miss_gallery_placeholder.radius + 'px'});

    jQuery(document).ready(function(){ 
      var miss_gallery_details = "hidden";
      jQuery(".gallery.air, .air-outset").animate({ height: jQuery(".gallery-single-item").height() + "px" }, 100) 
      jQuery(".air-outset .details .btn, .air-outset .details .btn2").click(
        function () {
          var miss_caption_hidden  = jQuery(this).attr('data-hidden'),
              miss_caption_visible = jQuery(this).attr('data-visible');

          if ( miss_gallery_details == "hidden" ) {
            jQuery(".gallery.air").stop().animate({ "width": "100%", "opacity": 1 }, 300, function() {
              jQuery( ".air-outset" ).animate({ "width": "25%" },300);
              jQuery( this ).css("display", "block").animate({ "width": "100%" },300);

            } );
            jQuery(this).html( '<i class="' + miss_caption_visible + '"></i>' );
            miss_gallery_details = "visible";


          } else {
            jQuery(".gallery.air").stop().animate({ "width": "0", "opacity": 0 }, 300, function() {
              jQuery( ".air-outset" ).animate({ "width": "50px" },300);
              jQuery( this ).css("display", "none").animate({ "width": "0" },300);
            } );
            miss_gallery_details = "hidden";
            jQuery(this).html( '<i class="' + miss_caption_hidden + '"></i>' );
          }
        }
      );
    });
});
