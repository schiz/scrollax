/*
 * @package IrishMiss
 * @subpackage Startup
 */
jQuery.noConflict();

/*
 * Preload image function
 */
(function($) {
  var cache = [];
  // Arguments are image paths relative to the current page.
  $.preLoadImages = function() {
    var args_len = arguments.length;
    for (var i = args_len; i--;) {
      var cacheImage = document.createElement('img');
      cacheImage.src = arguments[i];
      cache.push(cacheImage);
    }
  }
})(jQuery)

// Preload loading images
jQuery.preLoadImages(
assetsUri+ '/dummy/transparent.gif',
assetsUri+ '/preloaders/preloader.gif'
);

/*
 * Preloader image
 */
var preLoader = null;
var preLoaderCount = 0;
function missPreloader(img_class) {

}

var preLoaderSmall = null;
var preLoaderSmallCount = 0;
function missPreloaderSmall(img_class) {

}

var preLoaderLarge = null;
var preLoaderLargeCount = 0;
function missPreloaderLarge(img_class) {

}

missPreloader('.miss_preloader');
missPreloaderLarge('.miss_preloader_large');

/*
 * Preloader
 */
(function($)
{
	$.fn.preloader = function(options) {
		var defaults = {
			selector: '',
			imgSelector: 'img',
			imgAppend: 'a',
			fade: true,
			delay: 500,
			fadein: 400,
			imageResize: imageResize,
			resizeDisabled: resizeDisabled,
			nonce: imageNonce,
			beforeShowAll: function(){},
			onDone: function(){},
			oneachload: function(image){}
			
		},
		options = $.extend({}, defaults, options);
		
		var ua = $.browser,
			uaVersion = ua.version.substring(0,1);
		
		if(options.imageResize == 'wordpress')
			options.delay = 0;
			
		return this.each(function() {
			
			options.beforeShowAll.call(this);
			
			var $this = $(this),
				 images = $this.find(options.imgSelector),
				 count = images.length;
				
			$this.load = {
				
				preload: function(count) {
					if(count>0) {
						$this.load.loadImage(0,count);
					} else {
						return;
					}
				},
				
				loadImage: function(i,count) {
					if(i<count) {
						var imgId = Math.floor(Math.random()*1000)+'_img_';
						$this.load.append(i,imgId);

						if(options.imageResize == 'timthumb' || options.resizeDisabled == 'true')
							$this.load.loader(i,$(images[i]).attr('src'),imgId);
							
						if( (options.imageResize == 'wordpress') && (options.resizeDisabled == false) )
								$this.load.resize(i,imgId);
						
					} else {
						options.onDone.call(this);
					}
				},
				
				append: function(i,imgId) {
				//	$(this).animate({'width': $(images[i]).attr('width') + 'px'}, 100);
				//	$(this).animate({'height': $(images[i]).attr('height') + 'px'}, 100);

						$('<div id="'+imgId+(i+1)+'"></div>').each(function() {
							if( options.imgAppend ) {
								$(this).appendTo($this.find(options.imgAppend).eq(i));
							} else {
								$(this).appendTo($(options.selector));
							}
						});
				},
				
				loader: function(i,image,imgId) {
					var newImage = new Image(),
						currImage = $('#'+imgId+(i+1)),
						title = ( $(images[i]).attr('title') ) ? $(images[i]).attr('title') : '';
						
		        $(newImage).load(function () {
					$(this).animate({'width': $(images[i]).attr('width') + 'px'}, 100);
					$(this).animate({'height': $(images[i]).attr('height') + 'px'}, 100);
				//	$(this).attr('width', $(images[i]).attr('width'));
				//	$(this).attr('height', $(images[i]).attr('height'));
					
						$(images[i]).parent().remove()
						if( options.fade ) {
							$(this).css('display','none');
							$(currImage).html(this);
							//$(currImage).append(this);

							j = i+1;
							
							// Remove preloader
							$(this).parent().prev().delay(j*options.delay).queue(function() {
								$(this).remove();
							});
							
						// FadeIn image
						$(this).delay(j*options.delay).fadeIn(options.fadein).queue(function() {
								$(this).addClass($(images[i]).attr('class'));
								if( $(this).parent().parent().is('a')) {
									if(($(this).parent().parent().attr('rel'))){
										if($(this).parent().parent().attr('rel').match('prettyPhoto')){
											var filename = $(this).parent().parent().attr('href'),
												videos=['swf','youtube','vimeo','mov'];
											for(var v in videos){
											    if(filename.match(videos[v])){
													var video_icon = true;
												}else{
													var zoom_icon = true;
												}
											}
										}
									}
									
									$(this).parent().prev().remove();
									
								} else {
									$(this).parent().prev().remove();
								}
								
							if( video_icon ){
								$(this).parent().parent().css('backgroundImage','url(' +assetsUri+ '/play.png)');
								
							}else if(zoom_icon){
								$(this).parent().parent().css('backgroundImage','url(' +assetsUri+ '/zoom.png)');
							}
							
							options.oneachload.call(this, this);
						});
						if( (!ua.msie) || (uaVersion >= '9' && ua.msie) ){
							$this.load.loadImage(i+1,count);
						}
						
					} else {
						$(this).addClass($(images[i]).attr('class'));
						$(currImage).html(this);
						//$(currImage).append(this);
						if( (!ua.msie) || (uaVersion >= '9' && ua.msie) ){
							$this.load.loadImage(i+1,count);
						}
						options.oneachload.call(this, this);
					}
						
		        }).error(function () {
					// try to load next item
					$this.load.loadImage(i+1,count);
		        })
				  .attr('src', image)
				  .attr('title', title)
				  .attr('alt', $(images[i]).attr('alt'));
				
			 	  if(uaVersion <= '8' && ua.msie){
					  $this.load.loadImage(i+1,count);
				  }
				
				},
				
				resize: function(i,imgId) {
					var imgResize = $('<input>', { type: 'text', name:'ajax_image_resize_url', val: $(images[i]).attr('src') })
						imgWidth = $('<input>', { type: 'text', name:'img_width', val: $(images[i]).attr('width') }),
						imgHeight = $('<input>', { type: 'text', name:'img_height', val: $(images[i]).attr('height') }),
						j5M5601 = $('<input>', { type: 'text', name:'j5M5601', val: options.nonce });
						
					postData = imgResize.add(imgWidth).add(imgHeight).add(j5M5601).serialize();
					
					$.ajax({
						type: 'POST',
						dataType: 'json',
						data: postData,
						beforeSend: function(x) {
					        if(x && x.overrideMimeType) {
					            x.overrideMimeType('application/json;charset=UTF-8');
					        }
					    },
						success: function(data) {
							$this.load.loader(i,data.url,imgId);
					    }
					});
				}
				
			};
			
			$this.load.preload(count);
		});
	}
})(jQuery);

