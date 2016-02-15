

jQuery(document).ready(function () {
  // Select Opening
  jQuery('._dropdown').dropdownSelectHandler();
  jQuery('.module-advantages').advantagesModule();
  jQuery('.module-posts').postsModule();
  jQuery('.woocommerce-cart').woocommerceCart();
});

jQuery.fn.dropdownSelectHandler = function () {
    return this.each(function (i, item) {
      var display    = jQuery(item).find(' > span.value');

      jQuery(item).on('click', function (event) {
          var open = jQuery(this).hasClass('open');

          if (open) {
              jQuery(this).removeClass('open');
          } else {
              jQuery('.dropdown.open').removeClass('open');
              jQuery(this).addClass('open');
          }

      });

      jQuery(item).find('.list-item').on('click', function (event) {
          display.text(jQuery(this).text());


      });
    });
}
jQuery.fn.advantagesModule = function () {
  return this.each(function (i, item) {
    
    jQuery(item).find('.advantage > a').each(function (m, item) {
      jQuery(item).on('click', function (event) {
        event.preventDefault();

        var container = jQuery(this).parent();
        var open      = container.hasClass('open');

        if (open) {
          return false;
        }

        container.siblings('.advantage').removeClass('open');
        container.addClass('open');
      });
    });
  });
}


jQuery.fn.postsModule = function () {
  return this.each(function (i, item) {
    
    jQuery(item).find('.posts-heading .posts-cell > a').on('click', function (event) {
        event.preventDefault();

        var container     = jQuery(this).parent();
        var active        = container.hasClass('active');
        var block         = jQuery(this).data('block');

        if (active) {
          return false;
        }

        container.siblings().removeClass('active');
        container.addClass('active');
        
        jQuery(item).find('.posts-content > .posts-block').hide()
          .filter('.' + block + '').show();
    });
  });
}

jQuery.fn.woocommerceCart = function () {
  return this.each(function (i, item) {
    var $item = jQuery(item);

    function subtotal () {
      var subtotal = 0;
      
      $item.find('.cart-item .price > .price-val').each(function (i, item) {
        subtotal += parseInt(jQuery(item).text());
      });

      $item.find('.subtotal > .cost > span').text(subtotal);
    }

    subtotal();

    jQuery(item).find('.button.delete-item').each(function (m, item) {
      jQuery(item).on('click', function (event) {
        jQuery(this).parents('.cart-item').fadeOut(500, function (event) {
          jQuery(this).remove();
        });
      });
    });

    jQuery(item).find('.button.update-total').on('click', function (event) {
      subtotal();
    })
  });
}