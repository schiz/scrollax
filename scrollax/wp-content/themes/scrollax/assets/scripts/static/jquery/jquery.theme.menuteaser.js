//Menu teaser
(function(){
	jQuery(document).ready(function(){
		if ( jQuery('header.header').hasClass("teaser-menu") ) {
			missTheme.options.header.params.teaser = 13;
		}
		jQuery('header.header.teaser-menu').find("nav > ul li a").each(
			function () {
				if ( jQuery(this).attr('title') ) {
					jQuery( '<small class="teaser">' + jQuery(this).attr('title') + '</small>' ).appendTo(this).animate({opacity: '1'},800);
				}
			}
		);
	});
})();
