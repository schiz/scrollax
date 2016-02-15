<?php

$portfolio_box = array(
	'title' => 'Portfolio Options',
	'id' => 'miss_portfolio_meta_box',
	'pages' => array( 'portfolio' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
/**
 * Deprecated
 * @since 1.5
 */

            array(
                    'name' => __( 'Project Options', MISS_ADMIN_TEXTDOMAIN ),
                    'type' => 'toggle_start'
            ),
				array(
					'name' => __( 'About <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Enter additional project description. Shortcodes are available', MISS_ADMIN_TEXTDOMAIN ),
					'id' => '_about',
					"default" => '',
					"type" => "textarea"
				),

				array(
					'name' => __( 'Overview <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Enter additional project overview. Shortcodes are available', MISS_ADMIN_TEXTDOMAIN ),
					'id' => '_project_overview',
					"default" => '',
					"type" => "textarea"
				),

				array(
					'name' => __( 'Project Date <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Enter the date that the project was completed.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => '_date',
					"default" => '',
					"type" => "text"
				),
				array(
					'name' => __( 'Project Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Enter the url of the project for the "Visit Site" button.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => '_link',
					"default" => '',
					"class" => 'full',
					"type" => "text"
				),
				array(
					'name' => __( 'Project Short Description <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( "The text you enter here will show up next to or below the gallery image depending on which column layout you've selected.", MISS_ADMIN_TEXTDOMAIN ),
					'id' => '_teaser',
					'default' => '',
					'type' => 'textarea'
				),
				array(
					"name" => __( 'Fullsize Lightbox <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					"desc" => __( 'The fullsize images you would like to use for the portfolio lightbox pop-up demonstration.  If not assigned, it will use your featured image instead.', MISS_ADMIN_TEXTDOMAIN ),
					"id" => "_image",
					"button" => "Insert Image",
					"default" => '',
					"type" => "Upload",
				),
				array(
					"name" => __( 'Project Video Link URL<small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					"desc" => __( 'Flash, YouTube, Vimeo & iFrames.<br />Example:<br /><br />Vimeo:<br />http://vimeo.com/8011831<br /><br />YouTube:<br />http://www.youtube.com/watch?v=NN9MmXAuWPg<br /><br />.swf:<br />http://www.adobe.com/products/flashplayer/include/marquee/design.swf?width=792&height=294<br /><br />.mov:<br />http://trailers.apple.com/movies/disney/oceans/oceans-clip1_r640s.mov?width=640&height=272<br /><br />iFrame:<br />http://www.google.com?iframe=true&width=100%&height=100%<br />', MISS_ADMIN_TEXTDOMAIN ),
					"id" => "_featured_video",
					"default" => '',
					"class" => 'full',
					"type" => "text",
				),
				array(
					'name' => __( 'Link to post <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( "Check this option if you'd like the portfolio gallery image to link to the portfolio post instead of the jQuery lightbox image pop-up effect.", MISS_ADMIN_TEXTDOMAIN ),
					'id' => '_post',
					"options" => array( "true" => "Check to have the portfolio gallery image link to the portfolio post" ),
					'default' => '',
					'type' => 'checkbox'
				),
	        array(
				'type' => 'toggle_end'
	        ),
                array(
                        'name' => __( 'Slideshow', MISS_ADMIN_TEXTDOMAIN ),
                        'id' => 'slideshow',
                        'toggle_class' => 'slider_custom_custom',
                        'type' => 'slideshow'
                ),
		array(
			'name' => __( 'Disable Social Bookmarks', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "By default a social bookmarks module will display when viewing your posts.<br /><br />You can choose to disable it here.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_disable_social_bookmarks',
			'options' => array( 'true' => __( 'Disable the Social Bookmarks Module', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),

		array(
			'name' => __( 'Disable Read More Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Check this box if you'd like to disable the portfolio &quot;Read More&quot; button which links to the blog post.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_more',
			"options" => array( "true" => "Check to disable read more link" ),
			'default' => '',
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Fullsize Image <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Check this box if you'd like to disable the fullsize image that appears at the top of the portfolio blog post.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_fullsize',
			"options" => array( "true" => "Check to disable fullsize image on portfolio blog post." ),
			'default' => '',
			'type' => 'checkbox'
		)
	)
);
return array(
	'load' => true,
	'options' => $portfolio_box
);

?>
