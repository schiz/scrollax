(function($){ 
    $.fn.extend({ 
	
		IgniterTooltip: function() {
			
			//our main container
			var mainCont = this;
			
			//when hovered
			this.hover(function() {
				
				mainCont.children('span').children('span').css({ display: 'block' });
				mainCont.children('span').stop().css({ display: 'block', opacity: 0, bottom: '30px' }).animate({ opacity: 1, bottom: '40px' }, 200);
				
			}, function() {
				
				mainCont.children('span').stop().animate({ opacity: 0, bottom: '50px' }, 200, function() {
					
					jQuery(this).hide();
					
				});
				
			});
			
		},
		
		closeNotification: function() {
			
			//our main container
			var mainCont = this;
			
			//when clicked
			this.children('span.close').click(function() {
				
				mainCont.slideUp(300);
				
			});
			
		},
		
		igniterImageSlider: function() {
			
			//main container
			var mainCont = this;
			
			//main height and width
			var slideHeight = mainCont.children('.igniterimage-slider-images').height();
			var slideWidth = mainCont.children('.igniterimage-slider-images').width();
			
			//lets fix the images and add the current class to the first one
			var i = 1;
			mainCont.children('.igniterimage-slider-images').children('li').each(function() {
				
				if(i === 1) { jQuery(this).addClass('current').css({ display: 'block', left: 0 }).addClass('igniterslide_'+i); }
				else { jQuery(this).css({ display: 'block', left: slideWidth }).addClass('igniterslide_'+i); }
				
				mainCont.children('.igniterimage-slider-selector').append('<li></li>');
				
				i++;
				
			});
			
			//lets set the left od our selector
			var totalSel = mainCont.children('.igniterimage-slider-selector').children('li:not(.border)').length;
			var mainSelWidth = ((totalSel * 11));
			var selLeft = (slideWidth / 2) - (mainSelWidth / 2);
			
			mainCont.children('.igniterimage-slider-selector').css({ left: selLeft });
			
			//let's set up the selectors
			var i = 1;
			mainCont.children('.igniterimage-slider-selector').children('li:not(.border)').each(function() {
				
				if(i === 1) { jQuery(this).addClass('ignitersel_'+i).addClass('current'); }
				else { jQuery(this).addClass('ignitersel_'+i); }
				
				i++;
				
			});
			
			//when clicking in a next arrow
			mainCont.children('.arrow-right').click(function() {
				
				mainCont.igniterImageSlideCallNext();
				
			});
			
			//when clicking in a previous arrow
			mainCont.children('.arrow-left').click(function() {
				
				mainCont.igniterImageSlideCallPrev();
				
			});
			
			//when selector is clicked
			mainCont.children('.igniterimage-slider-selector').children('li:not(.border)').click(function() {
				
				var newSlide = jQuery(this).attr('class').split('_');
				
				var slideCur = jQuery(this).attr('class').split(' ');
				
				if(slideCur[1] != 'current') {
				
					mainCont.igniterImageSlideCallSlide(newSlide[1]);
					
				}
				
			});
			
		},
		
		igniterImageSlideCallNext: function() {
			
			//main container
			var mainCont = this;
			
			//main height and width
			var slideHeight = mainCont.children('.igniterimage-slider-images').height();
			var slideWidth = mainCont.children('.igniterimage-slider-images').width();
			
			//find next and current
			var current = mainCont.children('.igniterimage-slider-images').children('li.current');
			var next = current.next();
			
			//if next does not exist select the first slide
			if(next.length == 0) { next = mainCont.children('.igniterimage-slider-images').children('li:first'); }
			
			//find next and current selectors
			var currentSel = mainCont.children('.igniterimage-slider-selector').children('li.current');
			var nextSel = currentSel.next();
			
			//if next does not exist select the first selector
			if(nextSel.length == 0) { nextSel = mainCont.children('.igniterimage-slider-selector').children('li:not(.border):first'); }
			
			//animates the next one
			next.css({ left: slideWidth }).stop().animate({ left: 0 }, 200,function() {
				
				jQuery(this).addClass('current');
				currentSel.removeClass('current');
				
			});
			
			//animates the current one
			current.stop().animate({ left: -slideWidth }, 200,function() {
				
				jQuery(this).removeClass('current');
				nextSel.addClass('current');
				
			});
			
		},
		
		igniterImageSlideCallPrev: function() {
			
			//main container
			var mainCont = this;
			
			//main height and width
			var slideHeight = mainCont.children('.igniterimage-slider-images').height();
			var slideWidth = mainCont.children('.igniterimage-slider-images').width();
			
			//find next and current
			var current = mainCont.children('.igniterimage-slider-images').children('li.current');
			var prev = current.prev();
			
			//if next does not exist select the first slide
			if(prev.length == 0) { prev = mainCont.children('.igniterimage-slider-images').children('li:last'); }
			
			//find next and current selector
			var currentSel = mainCont.children('.igniterimage-slider-selector').children('li.current');
			var prevSel = currentSel.prev(':not(.border)');
			
			//if next does not exist select the first selector
			if(prevSel.length == 0) { prevSel = mainCont.children('.igniterimage-slider-selector').children('li:not(.border):last'); }
			
			//animates the next one
			prev.css({ left: -slideWidth }).stop().animate({ left: 0 }, 200,function() {
				
				jQuery(this).addClass('current');
				prevSel.addClass('current');
				
			});
			
			//animates the current one
			current.stop().animate({ left: slideWidth }, 200,function() {
				
				jQuery(this).removeClass('current');
				currentSel.removeClass('current');
				
			});
			
		},
		
		igniterImageSlideCallSlide: function(num) {
			
			//main container
			var mainCont = this;
			
			//main height and width
			var slideHeight = mainCont.children('.igniterimage-slider-images').height();
			var slideWidth = mainCont.children('.igniterimage-slider-images').width();
			
			//find next and current
			var current = mainCont.children('.igniterimage-slider-images').children('li.current');
			var next = mainCont.children('.igniterimage-slider-images').children('li.igniterslide_'+num);
			
			//find next and current selectors
			var currentSel = mainCont.children('.igniterimage-slider-selector').children('li.current');
			var nextSel = mainCont.children('.igniterimage-slider-selector').children('li.ignitersel_'+num);
			
			//animates the next one
			next.css({ left: slideWidth }).stop().animate({ left: 0 }, 200,function() {
				
				jQuery(this).addClass('current');
				currentSel.removeClass('current');
				
			});
			
			//animates the current one
			current.stop().animate({ left: -slideWidth }, 200,function() {
				
				jQuery(this).removeClass('current');
				nextSel.addClass('current');
				
			});
			
		},
		
		igniterToggle: function() {
			
			//main container
			var mainCont = this;
			
			if(mainCont.attr('class') == 'ignitertoggle-open') { mainCont.children('.toggle-content').css({ 'display': 'block' }) }
			
			//when clicked
			mainCont.children('.toggle-handler').click(function() {
				
				if(mainCont.children('.toggle-content').css('display') == 'none') {
					
					mainCont.removeClass('ignitertoggle-closed').addClass('ignitertoggle-open');
					mainCont.children('.toggle-content').slideDown(200);
					
				} else {
					
					mainCont.children('.toggle-content').slideUp(200);
					mainCont.removeClass('ignitertoggle-open').addClass('ignitertoggle-closed');
					
				}
				
			});
			
		},
		
		igniterTabbed: function() {
			
			
			//main container
			var mainCont = this;
			
			//categorizes our tabs
			var i = 1;
			mainCont.children('.tabs').children('li').each(function() {
				
				jQuery(this).addClass('tab_'+i);
				i++;
				
			});
			
			//categorizes our tabbed
			var i = 1;
			mainCont.children('.tabbed').children('li').each(function() {
				
				jQuery(this).addClass('tabbed_'+i);
				i++;
				
			});
			
			//set up the current tab and tabbed
			mainCont.children('.tabs').children('li:first').addClass('current');
			mainCont.children('.tabbed').children('li:first').addClass('current');
			
			//when user clicks a tab
			mainCont.children('.tabs').children('li').click(function() {
				
				
				var tempClass = jQuery(this).attr('class').split(' ');
				
				if(tempClass[1] != 'current') {
					
					var myClass = tempClass[0].split('_');
					
					//removes the current
					mainCont.children('.tabbed').children('li.current').removeClass('current');
					mainCont.children('.tabs').children('li.current').removeClass('current');
					
					//adds a new current
					mainCont.children('.tabbed').children('li.tabbed_'+myClass[1]).addClass('current');
					mainCont.children('.tabs').children('li.tab_'+myClass[1]).addClass('current');
					
				}
				
			});
			
		}
	
	});
	
})(jQuery);
