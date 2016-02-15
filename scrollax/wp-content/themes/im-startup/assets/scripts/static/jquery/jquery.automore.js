/* Show More */
//;(function(){
//    "use strict";
//        jQuery(document).ready(function(){

function missShowMorePosts() {
  var el = jQuery('.auto-more'),
      $container = "section.main_content .primary_content",
      href = null;

  if ( jQuery("a.next-page").length > 0 ) {
    // if (el.find("a.next-page").length == 0) {
    //   return;
    // }
    href = el.find("a.next-page").attr('href');
    var loader = jQuery('<div class="im-rogger1"/><div class="im-rogger2"/>');
    el.html(loader);

      /* Request */
     jQuery.ajax({
      'url': href,
      'type': 'GET',
      'success': function(data, textStatus, jqXHR) {
          jQuery('.auto-more').remove();
          // jQuery('.woocommerce-ordering', data).remove();
          data = jQuery(data).find("section.main_content .primary_content > *");
          jQuery($container).append(data);
      },

      'error': function(jqXHR, textStatus, errorThrow) {

      },
      'complete': function(jqXHR, textStatus) {
      }
    });
  }
  el = null;
}

/* ShowMore Features for AJAX Blog Loading */
function missIsVisible(elem) {
  if (elem.length == 0) {
    return;
  }
  var docViewTop = jQuery(window).scrollTop();
  var docViewBottom = docViewTop + jQuery(window).height();
  var elemTop = jQuery(elem).offset().top;
  var elemBottom = elemTop + jQuery(elem).height();
  return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
    && (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop));
}


  jQuery(document).ready(function() {
    miss_automore = jQuery(".auto-more a.next-page");
    if ( miss_automore.length > 0 ) {
      var windowHeight = jQuery(window).height(),
            amPos = miss_automore.offset();

      jQuery(document).scroll(function() {
        if ( miss_automore.length > 0 ) {
          amPos = miss_automore.offset();
          if ( ( jQuery(window).scrollTop() + ( windowHeight + ( windowHeight * 3 ) ) ) >= amPos.top ) {
            missShowMorePosts();
          }
          // if ( missIsVisible( miss_automore ) ) {
          //    missShowMorePosts();
          // }
        }
      });
    }
  });
