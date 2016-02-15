/**
 * Theme updates downloader
 */
missAdmin.updatesDownloader = function() {
jQuery(document).ready(function() {
  jQuery(".dltv").click(
    function() {
      jQuery(".miss-popup-overlay").fadeOut("slow", function() { jQuery(this).remove(); } );
      var url = 'http://themeforest.net/user/pixum/download_purchase/',
          caption = jQuery('<h3>' + jQuery(this).attr("data-download") + ' ' + jQuery(this).attr("data-title") + ' ' + jQuery(this).attr("data-version") + '</h3>'),
          postfix = '?accessor=wordpress_theme',
          overlay = jQuery('<div />').addClass('miss-popup-overlay'),
          popup = jQuery('<div />').addClass('miss-popup'),
          forms = {
            container: jQuery('<form />').addClass('download_credentials'),

            fields: {
              title: jQuery('<label/>').text( jQuery(this).attr("data-purchase-code-title") ),
              key: jQuery('<input type="text" name="purchase-key" value="" />').addClass("purchaseCode").css({'width':'100%', 'height': '32px'}).val( jQuery("#purchase_code").val() ),
            }

          },
          buttons = jQuery('<a />').bind('click', function() {
            var info = {
              redirecting: jQuery('<div class="info redirecting" />').text('Redirecting, please wait...'),
              done: jQuery('<div class="info done" />').text('Done')
            };
            // Validate Purchase Code
            if ( jQuery(".purchaseCode").val() ) {
              jQuery(".miss-popup-overlay .miss-popup form").fadeOut('400', function() {
                jQuery(this).remove();
              });
              setTimeout(function() {
                jQuery(".miss-popup-overlay .miss-popup").append(info.redirecting);
              }, 500);

              setTimeout(function() {
                jQuery(".miss-popup-overlay .miss-popup .info").remove();
                jQuery(".miss-popup-overlay .miss-popup").append(info.done);

				setTimeout( function() {
					jQuery(".miss-popup-overlay").fadeOut("slow", function() { jQuery(this).remove(); } );
				}, 1000);

                window.location.replace( url + forms.fields.key.val() );
                return true;
              }, 1000);
              jQuery(".purchaseCode").on("change", function() {
                jQuery(this).css("color", "#303030");
              });
            } else {
              jQuery(".purchaseCode").attr("value", "Invalid purchase code!").css({ color: '#cc0000' });
              //jQuery(".purchaseCode").val("Invalid purchase code!").animate({ color: '#cc0000' },100);
              setTimeout( function() {
                jQuery(".miss-popup-overlay").fadeOut("slow", function() { jQuery(this).remove(); } );
              }, 1000);
            }
          }).addClass('download btn btn-small btn-success').text(jQuery(this).attr("data-download")),

          cancel = jQuery('<a />').bind('click', function() {
                jQuery(".miss-popup-overlay").fadeOut("slow", function() { jQuery(this).remove(); } );
          }).addClass('cancel btn btn-small').text(jQuery(this).attr("data-cancel")),
          
          btngroup = jQuery('<div />').addClass('btn-group'),
          releaseInfo = jQuery('<div />').html('<hr size="1" style="opacity: .3" /><a style="color: #ddd; font-size: 13px;" href="' + jQuery(this).attr("data-url") + '" target="_BLANK">' + jQuery(this).attr("data-view-title") + '</a>');

      forms.fields.title.appendTo(forms.container);
      forms.fields.key.appendTo(forms.container);
      buttons.appendTo(btngroup);
      cancel.appendTo(btngroup);
      btngroup.appendTo(forms.container);
      releaseInfo.appendTo(forms.container);
      caption.appendTo(popup);
      forms.container.appendTo(popup);
      popup.appendTo(overlay);
      popup.animate({ 'top': jQuery(window).height()/2 }, 400);
      overlay.appendTo("body");
      return false;
    }
  );
  // jQuery(".download").click(
  //   function() {
  //     var info = {
  //       redirecting: jQuery('<div class="info redirecting" />').text('Redirecting, please wait...'),
  //       done: jQuery('<div class="info done" />').text('Done')
  //     };

  //     jQuery(".miss-popup-overlay .miss-popup form").fadeOut('400', function() {
  //       jQuery(this).remove();
  //     });


  //     jQuery(".miss-popup-overlay .miss-popup").append(info.redirecting);
  //     return false;

  //   }
  // );
});
};
