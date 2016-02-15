missAdmin.templateOptions = function () {
	var el = jQuery("#page_template");
	var option = el.val();
	el.bind("change", function () {
		option = jQuery(this).val();
	});

	/* Defaults */

	/* Header Slider */
	var el_slider = jQuery("#slider_type");
	var slider_type = el_slider.val()

	templateOptionsSliderType( slider_type );

	el_slider.bind("change", function () {
		slider_type = jQuery(this).val();
		templateOptionsSliderType( slider_type );
	});
	function templateOptionsSliderType( slider_type ) {
		if ( slider_type == "layerslider" ) {
			jQuery("._layer_slider.miss_option_set.select_option_set").slideDown("slow");
			jQuery(".header_slider_featured_options").slideUp("fast");
			jQuery(".header_slider_roadmap_options").slideUp("fast");
			jQuery("._revslider.miss_option_set.select_option_set").slideUp("fast");
			jQuery(".header_slider_expose_category").slideUp("fast");
		} else if ( slider_type == "featured" ) {
			jQuery(".header_slider_featured_options").slideDown("slow");
			jQuery(".header_slider_roadmap_options").slideUp("fast");
			jQuery("._layer_slider.miss_option_set.select_option_set").slideUp("slow");
			jQuery("._revslider.miss_option_set.select_option_set").slideUp("fast");
			jQuery(".header_slider_expose_category").slideUp("fast");
		} else if ( slider_type == "roadmap" ) {
			jQuery(".header_slider_featured_options").slideUp("fast");
			jQuery(".header_slider_roadmap_options").slideDown("slow");
			jQuery("._layer_slider.miss_option_set.select_option_set").slideUp("slow");
			jQuery("._revslider.miss_option_set.select_option_set").slideUp("fast");
			jQuery(".header_slider_expose_category").slideUp("fast");
		} else if ( slider_type == "revslider" ) {
			jQuery("._revslider.miss_option_set.select_option_set").slideDown("slow");
			jQuery("._layer_slider.miss_option_set.select_option_set").slideUp("fast");
			jQuery(".header_slider_featured_options").slideUp("fast");
			jQuery(".header_slider_roadmap_options").slideUp("fast");
			jQuery(".header_slider_expose_category").slideUp("fast");
		} else if ( slider_type == "expose" ) {
			jQuery(".header_slider_expose_category").slideDown("slow");
			jQuery("._revslider.miss_option_set.select_option_set").slideUp("fast");
			jQuery("._layer_slider.miss_option_set.select_option_set").slideUp("fast");
			jQuery(".header_slider_featured_options").slideUp("fast");
			jQuery(".header_slider_roadmap_options").slideUp("fast");
		} else {
			jQuery(".header_slider_featured_options").slideUp("fast");
			jQuery(".header_slider_roadmap_options").slideUp("fast");
			jQuery("._layer_slider.miss_option_set.select_option_set").slideUp("fast");
			jQuery("._revslider.miss_option_set.select_option_set").slideUp("fast");
			jQuery(".header_slider_expose_category").slideUp("fast");
		}
	}

	/* Home */
	templateOptionsHomeTemplate( option );

	function templateOptionsHomeTemplate( optionSet ) {
		if ( optionSet == "templates/template-home.php" ) {
			jQuery(".section_region_spotlight").slideDown("slow");
			jQuery(".section_region_services").slideDown("slow");
			jQuery(".section_region_articles").slideDown("slow");
			jQuery(".section_region_news").slideDown("slow");
			jQuery(".section_block_testimony").slideDown("slow");
			jQuery(".section_block_whatson").slideDown("slow");
			jQuery(".section_carousel_portfolio").slideDown("slow");
			jQuery(".section_carousel_partners").slideDown("slow");

			jQuery(".page_layout.miss_option_set").slideUp("fast");
			jQuery("#postimagediv").slideUp("fast");
			jQuery(".custom_sidebar.miss_option_set.select_option_set").slideUp("fast");

		} else {
			jQuery(".section_region_spotlight").slideUp("fast");
			jQuery(".section_region_services").slideUp("fast");
			jQuery(".section_region_articles").slideUp("fast");
			jQuery(".section_region_news").slideUp("fast");
			jQuery(".section_block_testimony").slideUp("fast");
			jQuery(".section_block_whatson").slideUp("fast");
			jQuery(".section_carousel_portfolio").slideUp("fast");
			jQuery(".section_carousel_partners").slideUp("fast");

			jQuery(".page_layout.miss_option_set").slideDown("slow");
			jQuery("#postimagediv").slideDown("slow");
			jQuery(".custom_sidebar.miss_option_set.select_option_set").slideDown("slow");
		}
		
	}
	if ( option == "templates/template-home.php" ) {
		// jQuery(".page_layout.miss_option_set").slideUp("fast");
		// jQuery("#postimagediv").slideUp("fast");
		// jQuery(".custom_sidebar.miss_option_set.select_option_set").slideUp("fast");
	}
	/* Portfolio */
	if ( option != "templates/template-works.php" && option != "templates/template-works-static.php" ) {
		jQuery(".portfolio_layout.miss_option_set").slideUp("fast");
		jQuery(".portfolio_term.miss_option_set").slideUp("fast");
		jQuery(".portfolio_limit.miss_option_set").slideUp("fast");
	}

	/* On Change */
	el.bind("change", function () {
		/* Home Item Layout */
		option = jQuery(this).val();
		templateOptionsHomeTemplate( option );
		// if (option == "template-home.php" ) {
		// 	jQuery(".page_layout.miss_option_set").slideUp("fast");
		// 	jQuery("#postimagediv").slideUp("fast");
		// 	jQuery(".custom_sidebar.miss_option_set.select_option_set").slideUp("fast");

		// 	jQuery(".section_region_spotlight").slideDown("slow");
		// 	jQuery(".section_region_services").slideDown("slow");
		// 	jQuery(".section_region_articles").slideDown("slow");
		// 	jQuery(".section_region_news").slideDown("slow");
		// 	jQuery(".section_block_testimony").slideDown("slow");
		// 	jQuery(".section_block_whatson").slideDown("slow");
		// 	jQuery(".section_carousel_portfolio").slideDown("slow");
		// 	jQuery(".section_carousel_partners").slideDown("slow");

		// } else {
		// 	jQuery(".page_layout.miss_option_set").slideDown("slow");
		// 	jQuery("#postimagediv").slideDown("slow");
		// 	jQuery(".custom_sidebar.miss_option_set.select_option_set").slideDown("slow");

		// 	jQuery(".section_region_spotlight").slideUp("slow");
		// 	jQuery(".section_region_services").slideUp("slow");
		// 	jQuery(".section_region_articles").slideUp("slow");
		// 	jQuery(".section_region_news").slideUp("slow");
		// 	jQuery(".section_block_testimony").slideUp("slow");
		// 	jQuery(".section_block_whatson").slideUp("slow");
		// 	jQuery(".section_carousel_portfolio").slideUp("slow");
		// 	jQuery(".section_carousel_partners").slideUp("slow");
		// }

		/* Portfolio Item Layout */
		if (option == "templates/template-works.php" || option == "templates/template-works-static.php" ) {
			jQuery(".portfolio_layout.miss_option_set").slideDown("slow");
			jQuery(".portfolio_term.miss_option_set").slideDown("slow");
			jQuery(".portfolio_limit.miss_option_set").slideDown("slow");
		} else {
			jQuery(".portfolio_layout.miss_option_set").slideUp("fast");
			jQuery(".portfolio_term.miss_option_set").slideUp("fast");
			jQuery(".portfolio_limit.miss_option_set").slideUp("fast");
		}
	});
}
