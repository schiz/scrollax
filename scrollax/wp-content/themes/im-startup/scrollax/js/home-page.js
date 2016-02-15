jQuery(document).ready(function () {
  jQuery('.skill-meter .meter').skillMeter();
  jQuery('.text-field.placeholder').textFieldPlaceholder();
  jQuery('#feedback_form').formHandler();
  jQuery('.hover-slide-effect').hoverHandler();
  jQuery('.section-header').headerHandler();
  
  jQuery('.custom_select').each(function() {
     
     if(jQuery(this).find('option:selected').size() > 0)
     {
        jQuery(this).find('span').html(jQuery(this).find('option:selected').html());
     }
     else
     {
        jQuery(this).find('span').html(jQuery(this).find('option').eq(0).html());
     }
  });
  jQuery('.custom_select').change(function() {
     if(jQuery(this).find('option:selected').size() > 0)
     {
        jQuery(this).find('span').html(jQuery(this).find('option:selected').html());
     }
     else
     {
        jQuery(this).find('span').html(jQuery(this).find('option').eq(0).html());
     }
  });
  
  
  jQuery('body').parallax("50%", -1);
  jQuery('[class*="main-section-"]').parallax("50%", -1);
});

(function ($) {
  $.fn.textFieldPlaceholder = function () {
    this.on('blur', function(event) {
      var val = $(this).val();
      
      $(this).attr('data-val', val);

    });
  };
})(jQuery);

(function ($) {
  $.fn.hoverHandler = function (options) {    
    var defaults = {
        'managingLayer': '.hover-slide-effect',
        'eventLayer'   : '.preview'
    };
    var settings      = $.extend(defaults, options),
        managingLayer = settings.managingLayer,
        eventLayer    = settings.eventLayer;

    this.each(function (i, item) {
      var eachCurrent = $(item);

      eachCurrent.find(eventLayer).on('mouseenter', function (event) {
        eachCurrent.addClass('hover');
      });

      eachCurrent.on('mouseleave', function (event) {
        eachCurrent.removeClass('hover');
      });
    });
  };
})(jQuery);

(function ($) {
  $.fn.headerHandler = function () {
    this.each(function (i, item) {
      var breaking  = $(item).find('.breaking-alignment'),
          disturbed = $(item).find('.header');

      if (breaking.length) {
        var widthDifference = disturbed.width() - $(item).width();

        disturbed.find('span').css('marginRight', widthDifference + 'px')
      }
    });
  };
})(jQuery);



(function ($) {
  $.fn.skillMeter = function () {
    var timeoutMeterId, result, effectStart, effectOccurred, containerWidth, factor;

    timeoutMeterId = [];
    result         = [];
    effectStart    = [];
    effectOccurred = [];
    containerWidth = [];
    factor         = [];

    function animateStart(i, progressLine, counter) {
      factor[i] = 100 / containerWidth[i];

      timeoutMeterId[i] = setInterval(function () {
        var calcPoint, calcPercentage;

        calcPoint      = parseInt(progressLine.width());
        calcPercentage = parseInt((factor[i] * calcPoint).toFixed());

        if (!(result[i] === calcPercentage)) {
          counter.text(calcPercentage);
          result[i] = calcPercentage;
        }

        if ((effectOccurred[i] === false) && (calcPoint > effectStart[i])) {
          progressLine.addClass('switch');
          
          effectOccurred[i] = true;
        }

      }, 10);
    }

    function animateEnd (i) {
      clearInterval(timeoutMeterId[i]);
    }

    return this.each(function (i, item) {
      var localContainerWidth,
          localEffectStart,
          localEffect;

      localContainerWidth = parseInt($(item).width());
      localEffect         = $(item).data('effect');

      switch (localEffect) {
        case 'full-width-beginning':
          localEffectStart = 75
          break
        case 'full-width-endind':
          localEffectStart = (localContainerWidth - 125)
          break
        case 'limited-width-beginning':
          localEffectStart    = localContainerWidth,
          localContainerWidth = (localContainerWidth - 100)
          break
        default:
          localEffectStart = 75
      }
      
      containerWidth[i] = localContainerWidth;
      effectStart[i]    = localEffectStart;
      effectOccurred[i] = false;

      $(item).width(localContainerWidth);

      $(item).on('emerged.emerge', function (event) {
        $(event.currentTarget).off();

        var progressLine, counter;

        progressLine = $(this).find('.progress-line');
        counter      = $(this).find('.counter');

        progressLine.addClass('animate').on({
          'animationstart mozanimationstart webkitAnimationStart oAnimationStart msanimationstart': function (event) {
            animateStart(i, progressLine, counter);
          },
          'animationend mozanimationend webkitAnimationEnd oAnimationEnd msanimationend': function (event) {
            animateEnd(i);
          }
        });
      }).emerge({
            interval : 20,
           threshold : 'auto',
               recur : true,
                auto : 0.0, // default (meaning 0.5 * screen width/height threshold)
          visibility : true
      });
    });
  };
})(jQuery);

function get_lastpost_ajax(type, limit, offset, catin)
{
    var ajaxurl = "./wp-admin/admin-ajax.php";
    var data = { action: "get_lastpost_ajax", type: type, limit: limit, offset: offset, catin: catin };
    //alert(type+' '+limit+' '+offset+' '+catin);
    jQuery.post(ajaxurl, data, function(response) {  
        jQuery('#'+lpost_id).append(response);
        //alert(response)
    });
}

(function ($) {
  $.fn.formHandler = function () {
    this.each(function (i, item) {
      $(item).submit(function() {
        var th = this;
        var data    = $(this).serialize();
        var ajaxurl = "http://scrollax.mnb-t.com/scrollax/wp-admin/admin-ajax.php";
        

        $.post(ajaxurl, data, function(response) {  
            th.reset();
            alert(response);  
        });

        return false;
      });
    });
  };
})(jQuery);