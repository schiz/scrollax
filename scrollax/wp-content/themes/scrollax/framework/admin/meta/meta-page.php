<?php
global $wpdb;
$meta_boxes = array(
	'title' => sprintf( __( '%1$s General Page Options', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_page_meta_box',
	'pages' => array( 'page', 'product' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
        array(
	                'name'          => __( 'Page Theme', MISS_ADMIN_TEXTDOMAIN ),
	                'id'            => "page_theme",
	                'desc'          => 'Select page theme.',
	                'type'          => 'select',
	                'options'       => array('black' => 'Black', 'white' => 'White'),
                    'toggle_class'  => '_page_theme',
	                'multiple'      => false,
                    'default'       => 'black',
	        ),

		array(
			'name' => __( 'Post Icon', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Please select post icon for some theme features such as Expose Slider.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_icon',
			'std' => 'im-icon-image-2',
			'default' => array_rand( miss_get_all_font_icons() ),
			'target' => 'all_icons',
			'type' => 'icons'
		),
		array(
			'name' => __( 'Header Slider', MISS_ADMIN_TEXTDOMAIN ),
                        'toggle_class' => 'header_slider',
			'type' => 'toggle_start'
		),
	        array(

	                'name'          => __( 'Slider Type', MISS_ADMIN_TEXTDOMAIN ),
	                'id'            => "slider_type",
	                'desc'          => 'Select slider.',
	                'type'          => 'select',
	                'options'       => miss_slider_types(),
                    'toggle_class'  => '_slider_type',
	                'multiple'      => false,
	        ),

	        array(
	                'name'          => __( 'Layer Slide', MISS_ADMIN_TEXTDOMAIN ),
	                'std'           => 'na',
	                'id'            => "layerslider_id",
	                'desc'          => __( 'Please select layer slider group.', MISS_ADMIN_TEXTDOMAIN ),
	                'type'          => 'select',
	                'options'       => miss_ls_slides(),
                    'toggle_class'  => '_layer_slider',
	                'multiple'      => false
	        ),

	        array(
	                'name'          => __( 'Revolution Slide', MISS_ADMIN_TEXTDOMAIN ),
	                'id'            => "revslider_alias",
	                'desc'          => __( 'Please select revolution slider group.', MISS_ADMIN_TEXTDOMAIN ),
	                'type'          => 'select',
	                'options'       => miss_rev_slides(),
	                'toggle_class'  => '_revslider',
	                'multiple'      => false
	        ),

		array(
			'type' => 'toggle_end'
		),

		array(
			'name'    => __( 'Expose Category', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select post category for Expose Slider.', MISS_ADMIN_TEXTDOMAIN ),
			'id'  => '_expose_category',
			'toggle_class' => 'header_slider_expose_category',
			'target' => 'cat',
			'type' => 'multidropdown'
		),

		/* Feature Image */
		array(
			'name' => __( 'Banner Options', MISS_ADMIN_TEXTDOMAIN ),
                        'toggle_class' => 'header_slider_featured_options',
			'type' => 'toggle_start'
		),
		array(
			'name'    => __( 'Image Size', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Edit image size.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => Array('w' => 2000, 'h' => 388),
			'id'  => 'featured_size',
			'toggle_class' => 'header_slider_featured_width',
			'type' => 'resize',
		),
		array(
			'name'    => __( 'Disable Banner', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this option to remove Banner capabilities for slider.', MISS_ADMIN_TEXTDOMAIN ),
			'id'  => 'featured_banner_disabled',
			'toggle_class' => 'header_slider_featured_disable_banner',
			'options' => array( 'true' => __( 'Check this option to use featured images as background image.', MISS_ADMIN_TEXTDOMAIN ) ),
			'type'    => 'checkbox'
		),
		array(
			'name'    => __( 'Banner Position', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select banner position.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'right',
			'options' => Array(
				'left' => 'Pull Left',
				'right' => 'Pull Right',
			),
			'id'  => 'featured_banner_position',
			'toggle_class' => 'header_slider_featured_banner_position',
			'type' => 'select',
		),
		array(
			'name'    => __( 'Banner Size', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter custom banner size.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => Array('w' => 484, 'h' => 200),
			'id'  => 'featured_banner_size',
			'toggle_class' => 'header_slider_featured_banner_size',
			'type' => 'resize',
		),
		array(
			'name'    => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter main caption.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Startup',
			'id'  => 'featured_caption',
			'toggle_class' => 'header_slider_featured_caption',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Button Caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter button caption.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Learn More',
			'id'  => 'featured_button_caption',
			'toggle_class' => 'header_slider_featured_button_caption',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Button Link', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter button link.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '#',
			'id'  => 'featured_button_link',
			'toggle_class' => 'header_slider_featured_button_link',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Banner Text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter main text.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Thank you for using Startup Theme.',
			'id'  => 'featured_content',
			'toggle_class' => 'header_slider_featured_content',
			'type' => 'textarea',
		),
		array(
			'name'    => __( 'Image', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload foreground image.', MISS_ADMIN_TEXTDOMAIN ),
			'id'  => 'featured_fg',
			'toggle_class' => 'header_slider_featured_fg',
			'type' => 'upload',
		),
		array(
			'name'    => __( 'Image Position', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select foreground image position.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'left',
			'options' => Array(
				'left' => 'Pull Left',
				'right' => 'Pull Right'
			),
			'id'  => 'featured_fg_position',
			'toggle_class' => 'header_slider_featured_fg_position',
			'type' => 'select',
		),
		array(
			'name'    => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload image for background.', MISS_ADMIN_TEXTDOMAIN ),
			'id'  => 'featured_bg',
			'toggle_class' => 'header_slider_featured_bg',
			'type' => 'upload',
		),
		array(
			'name'    => __( 'Background Colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Define background colour. By default is transparent.', MISS_ADMIN_TEXTDOMAIN ),
			'id'  => 'featured_bg_color',
			'alpha' => true,
			'default' => 'rgba(255,255,255,0)',
			'toggle_class' => 'header_slider_featured_bg_color',
			'type' => 'color',
		),

		array(
			'name'    => __( 'Caption Colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select caption colour.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '#ffffff',
			'id'  => 'featured_caption_color',
			'toggle_class' => 'header_slider_featured_caption_color',
			'type' => 'color',
		),
		array(
			'name'    => __( 'Caption Font Size', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter caption font size with pixels.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '55px',
			'id'  => 'featured_caption_font_size',
			'toggle_class' => 'header_slider_featured_caption_color',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Content Colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select content colour.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '#ffffff',
			'id'  => 'featured_content_color',
			'toggle_class' => 'header_slider_featured_content_color',
			'type' => 'color',
		),
		array(
			'name'    => __( 'Content Font Size', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter content font size with pixels.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '21px',
			'id'  => 'featured_content_font_size',
			'toggle_class' => 'header_slider_featured_caption_color',
			'type' => 'text',
		),

		array(
			'name'    => __( 'Full Width', MISS_ADMIN_TEXTDOMAIN ),
			'id'      => 'featured_size_full_width',
			'desc'    => __( 'Use image in full width.', MISS_ADMIN_TEXTDOMAIN ),
			'options' => array( 'true' => __( 'Check this option to disable image width resizing.', MISS_ADMIN_TEXTDOMAIN ) ),
			'type'    => 'checkbox'
		),
		array(
			'name'    => __( 'Featured Image as Background', MISS_ADMIN_TEXTDOMAIN ),
			'id'      => 'featured_featured_as_background',
			'desc'    => __( 'Use featured image as background.', MISS_ADMIN_TEXTDOMAIN ),
			'options' => array( 'true' => __( 'Check this option to use featured images as background image.', MISS_ADMIN_TEXTDOMAIN ) ),
			'type'    => 'checkbox'
		),
		array(
			'name'    => __( 'Disable Button', MISS_ADMIN_TEXTDOMAIN ),
			'id'      => 'featured_disable_button',
			'desc'    => __( 'This option will remove button from banner.', MISS_ADMIN_TEXTDOMAIN ),
			'options' => array( 'true' => __( 'Check this option to remove button from banner.', MISS_ADMIN_TEXTDOMAIN ) ),
			'type'    => 'checkbox'
		),
		array(
			'type' => 'toggle_end'
		),

		/**
		 * Roadmap Settings
		 */
		array(
			'name' => __( 'Roadmap Options', MISS_ADMIN_TEXTDOMAIN ),
                        'toggle_class' => 'header_slider_roadmap_options',
			'type' => 'toggle_start'
		),
		array(
			'name'    => __( 'Office Name', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter office name or title (optional).', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '',
			'id'  => '_roadmap_title',
			'toggle_class' => 'header_slider_roadmap_title',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Height', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter map size.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '412',
			'id'  => '_roadmap_height',
			'toggle_class' => 'header_slider_roadmap_height',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Address', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter map address.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Hyde Park, London, United Kingdom',
			'id'  => '_roadmap_address',
			'toggle_class' => 'header_slider_roadmap_address',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Zoom', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter map zoom level.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '14',
			'id'  => '_roadmap_zoom',
			'toggle_class' => 'header_slider_roadmap_zoom',
			'type' => 'text',
		),

		array(
			'name' => __( 'Map Type', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select which type of map you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_roadmap_type',
			'default' => 'ROADMAP',
			'options' => array(
				'ROADMAP' => __('Roadmap', MISS_ADMIN_TEXTDOMAIN ),
				'SATELLITE' => __('Satellite', MISS_ADMIN_TEXTDOMAIN ),
				'HYBRID' => __('Hybrid', MISS_ADMIN_TEXTDOMAIN ),
				'TERRAIN' => __('Terrain', MISS_ADMIN_TEXTDOMAIN ),
			),
			'type' => 'select',
		),

		array(
			'name'    => __( 'Marker', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload map placemark.', MISS_ADMIN_TEXTDOMAIN ),
			'id'  => '_roadmap_placemarks',
			'toggle_class' => 'header_slider_roadmap_placemark',
			'type' => 'upload',
		),
		array(
			'type' => 'toggle_end'
		),

		/*
		 * Portfolio Layout Settings
		 */
		array(
			'name' => __( 'Portfolio Items', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Define layout for portfolio items.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'portfolio_layout',
			'options' => array(
				'span12' => THEME_ADMIN_ASSETS_URI . '/images/columns/portfolio/1.png',
				'span6' => THEME_ADMIN_ASSETS_URI . '/images/columns/portfolio/2.png',
				'span4' => THEME_ADMIN_ASSETS_URI . '/images/columns/portfolio/3.png',
				'span3' => THEME_ADMIN_ASSETS_URI . '/images/columns/portfolio/4.png',
			),
			'default' => 'span3',
			'toggle_class' => 'portfolio_layout',
			'type' => 'layout'
		),
		array(
			'name' => __( 'Portfolio Display Style', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Define Style for portfolio items.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'portfolio_display_style',
			'options' => array(
				'' =>  __('Default Style', MISS_ADMIN_TEXTDOMAIN ),
				'without_title' =>  __('Disable Title And Tags', MISS_ADMIN_TEXTDOMAIN ),
				'circle' =>  __('Round to the Circle (Without Title And Tags)', MISS_ADMIN_TEXTDOMAIN ),
			),
			'toggle_class' => 'portfolio_display_style',
			'type' => 'select'
		),
        array(
                'name'    => __( 'Portfolio Category', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Select portfolio taxonomy...', MISS_ADMIN_TEXTDOMAIN ),
				'id' => 'portfolio_term',
				'target' => 'portfolio_category',
				'toggle_class' => 'portfolio_term',
				'type' => 'multidropdown',
        ),
        array(
                'name'    => __( 'Number of Items', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'Define number of portfolio items per page.', MISS_ADMIN_TEXTDOMAIN ),
				'default' => '16',
                'id'      => 'portfolio_limit',
				'toggle_class' => 'portfolio_limit',
				'type' => 'text',
        ),

		/*
		 * Updates
		 */
		array(
			'name' => __( 'Recent Updates Section', MISS_ADMIN_TEXTDOMAIN ),
                        'toggle_class' => 'region_spotlight',
			'type' => 'toggle_start'
		),

            			array(
                            'name'    => __( 'Enable Recent Updates', MISS_ADMIN_TEXTDOMAIN ),
                            'id'      => 'spotlight_enable',
            				'options' => array( 'true' => __( 'Check this option to enable  Updates box on this page', MISS_ADMIN_TEXTDOMAIN ) ),
            				'type' => 'checkbox'
            			),

                   		array(
                			'name' => __( 'Layout Type', MISS_ADMIN_TEXTDOMAIN ),
                			'desc' => __( 'You can choose between a left, right or full width layout for this block.', MISS_ADMIN_TEXTDOMAIN ),
                			'id' => 'spotlight_layout',
                			'options' => array(
                				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/1.png',
                				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/fourth_threefourth.png',
                				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/threefourth_fourth.png',
                			),
                			'default' => 'left_sidebar',
                			'type' => 'layout'
                		),


                        array(
                                'name'    => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'spotlight_caption',
                                'default' => __( 'Recent Updates', MISS_ADMIN_TEXTDOMAIN ),
                                'desc'    => __( 'Enter spotlight block caption.', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

                        array(
                                'name'    => __( 'Title Length', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'spotlight_trim_title',
                                'default'     => '20',
                                'desc'    => __( 'Trim post title in preview box', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

                        array(
                                'name'    => __( 'Body Length', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'spotlight_trim_content',
                                'default' => '40',
                                'desc'    => __( 'Trim post content in preview box', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),
                        array(
                                'name'    => __( 'Enable Read More Button', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'spotlight_readmore_enable',
                                'desc'    => __( 'This option will enable Updates Read More buttons', MISS_ADMIN_TEXTDOMAIN ),
                				'options' => array( 'true' => __( 'Check this option to enable READ MORE buttons inside spotlight elements on this page', MISS_ADMIN_TEXTDOMAIN ) ),
                				'type'    => 'checkbox'
                        ),

                        array(
                                'name'    => __( 'Updates Category', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'spotlight_term',
                				'target' => 'cat',
                				'toggle_class' => 'spotlight_term',
                				'type' => 'select',
                        ),

                        array(
                                'name'    => __( 'Twitter Caption', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => '_tw_caption',
                                'default' => __( 'Recent Updates', MISS_ADMIN_TEXTDOMAIN ),
                                'desc'    => __( 'Specify twitter block caption.', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

                        array(
                                'name'    => __( 'Twitter Username', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => '_tw_user',
                                'default' => __( 'envato', MISS_ADMIN_TEXTDOMAIN ),
                                'desc'    => __( 'Specify your twitter user.', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

                        array(
                                'name'    => __( 'Max Tweets', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => '_tw_limit',
                                'default' => __( '5', MISS_ADMIN_TEXTDOMAIN ),
                                'desc'    => __( 'Specify number of tweets.', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

		array(
			'type' => 'toggle_end'
		),

		/*
		 * News Section
		 */
		array(
			'name' => __( 'News', MISS_ADMIN_TEXTDOMAIN ),
                        'toggle_class' => 'region_news',
			'type' => 'toggle_start'
		),

			array(
                                'name'    => __( 'Enable News', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'news_enable',
				'options' => array( 'true' => __( 'Check this option to enable news box on this page', MISS_ADMIN_TEXTDOMAIN ) ),
				'type' => 'checkbox'
			),
			array(
				'name' => __( 'News Layout', MISS_ADMIN_TEXTDOMAIN ),
				'desc' => __( 'You can choose between a left, right or full width layout for this block.', MISS_ADMIN_TEXTDOMAIN ),
				'id' => 'news_layout',
				'options' => array(
					'full_width' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/1.png',
					'split' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/2.png',
				),
				'default' => 'split',
				'type' => 'layout'
			),
 

                        array(
                                'name'    => __( 'News Caption', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'news_caption',
                                'default' => __( 'Recent News', MISS_ADMIN_TEXTDOMAIN ),
                                'desc'    => __( 'Enter news block caption.', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

                        array(
                                'name'    => __( 'News Title Length', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'news_trim_title',
                                'default'     => '40',
                                'desc'    => __( 'Trim post title in preview box', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

                        array(
                                'name'    => __( 'News Body Length', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'news_trim_content',
                                'default'     => '120',
                                'desc'    => __( 'Trim post content in preview box', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

                        array(
                                'name'    => __( 'Number of News', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'news_limit',
                                'default'     => '3',
                                'desc'    => __( 'Enter number of news to display in one block', MISS_ADMIN_TEXTDOMAIN ),
                                'type'    => 'text',
                        ),

                        array(
                                'name'    => __( 'Date Style', MISS_ADMIN_TEXTDOMAIN ),
                                'id'      => 'news_date_style',
                                'default'     => 'circled',
                                'std'     => 'circled',
                                'desc'    => 'Select date style',
                                'type'    => 'select',
                                'options' => Array(
	                            	'circled' => 'Circle',
	                            	'rounded' => 'Rounded Box',
	                            	'rectangled' => 'Rectangle',
	                            ),
                        ),

                        array(
                                'name'    => 'Enable Read More Button',
                                'id'      => 'news_readmore_enable',
                                'desc'    => 'This option will enable News Read More buttons',
        			'options' => array( 'true' => __( 'Check this option to enable READ MORE buttons inside news elements on this page', MISS_ADMIN_TEXTDOMAIN ) ),
        			'type' => 'checkbox'
                        ),
                       array(
                                'name' => __( 'News Page', MISS_ADMIN_TEXTDOMAIN ),
                                'desc' => __( "Enter the custom news page address that you'd like use.", MISS_ADMIN_TEXTDOMAIN ),
                                'id' => 'news_url',
                                'default' => '#',
                                'type' => 'text'
                        ),
                        array(
                                'name' => __( 'More Caption', MISS_ADMIN_TEXTDOMAIN ),
                                'desc' => __( "Enter caption for MORE button.", MISS_ADMIN_TEXTDOMAIN ),
                                'default' => __( 'More News', MISS_ADMIN_TEXTDOMAIN ),
                                'id' => 'news_more',
                                'type' => 'text'
                        ),


		array(
			'type' => 'toggle_end'
		),


		/*
		 * Latest Works Carousel
		 */
		array(
			'name' => __( 'Gallery', MISS_ADMIN_TEXTDOMAIN ),
                        'toggle_class' => 'carousel_portfolio',
			'type' => 'toggle_start'
		),
						array(
                            'name'    => 'Enable Gallery',
                            'id'      => 'carousel_portfolio_enable',
							'options' => array( 'true' => __( 'Check this option to enable portfolio carousel on this page', MISS_ADMIN_TEXTDOMAIN ) ),
							'type' => 'checkbox'
						),
						array(
                            'name'    => 'Auto Play',
                            'id'      => 'carousel_portfolio_autoplay',
							'options' => array( 'true' => __( 'Check this option to enable gallery carousel auto play on this page', MISS_ADMIN_TEXTDOMAIN ) ),
							'type' => 'checkbox'
						),
                        array(
                                'name'    => 'Carousel Caption',
                                'id'      => 'carousel_portfolio_caption',
                                'default'     => 'Our Works',
                                'desc'    => 'Enter carousel caption.',
                                'type'    => 'text',
                        ),
                        array(
                                'name'    => 'Carousel Delay',
                                'id'      => 'carousel_portfolio_delay',
                                'default'     => '3000',
                                'desc'    => 'Set carousel delay.',
                                'type'    => 'text',
                        ),
                        array(
                                'name'    => 'Carousel Delay',
                                'id'      => 'carousel_portfolio_delay',
                                'default'     => '3000',
                                'desc'    => 'Set carousel delay.',
                                'type'    => 'text',
                        ),
                        array(
                                'name' => __( 'Gallery Page', MISS_ADMIN_TEXTDOMAIN ),
                                'desc' => __( "Enter the custom gallery page address that you'd like use.", MISS_ADMIN_TEXTDOMAIN ),
                                'id' => 'portfolio_url',
                                'default' => '#',
                                'type' => 'text'
                        ),
                        array(
                                'name' => __( 'More Caption', MISS_ADMIN_TEXTDOMAIN ),
                                'desc' => __( "Enter caption for MORE button.", MISS_ADMIN_TEXTDOMAIN ),
                                'default' => __( 'More', MISS_ADMIN_TEXTDOMAIN ),
                                'id' => 'portfolio_more',
                                'type' => 'text'
                        ),

		array(
			'type' => 'toggle_end'
		),
		/*
		 * Footer Banner
		 */
		array(
			'name' => __( 'Footer Banner', MISS_ADMIN_TEXTDOMAIN ),
                        'toggle_class' => 'footer_slider',
			'type' => 'toggle_start'
		),


		array(
			'name'    => __( 'Disable Banner', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this option to disable footer banner.', MISS_ADMIN_TEXTDOMAIN ),
			'id'  => 'footer_banner_disabled',
			'toggle_class' => 'footer_slider',
			'default' => 'true',
			'options' => array( 
				'true' => __( 'Disable Banner', MISS_ADMIN_TEXTDOMAIN ), 
				'false' => __( 'Enable Banner', MISS_ADMIN_TEXTDOMAIN )
			),
			'type'    => 'radio'
		),
		array(
			'name'    => __( 'Banner Height', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Edit image size.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '124px',
			'id'  => 'footer_height',
			'toggle_class' => 'footer_slider',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter main caption.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Startup',
			'id'  => 'footer_caption',
			'toggle_class' => 'footer_slider',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Banner Text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter main text.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Thank you for using Startup Theme.',
			'id'  => 'footer_content',
			'toggle_class' => 'footer_slider',
			'type' => 'textarea',
		),
		array(
			'name'    => __( 'Button Caption', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter button caption.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'Learn More',
			'id'  => 'footer_button_caption',
			'toggle_class' => 'footer_slider',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Button Link', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter button link.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '#',
			'id'  => 'footer_button_link',
			'toggle_class' => 'footer_slider',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Button Position', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please select foreground button position.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'left',
			'options' => Array(
				'left' => 'Pull Left',
				'right' => 'Pull Right'
			),
			'id'  => 'footer_button_position',
			'toggle_class' => 'footer_slider',
			'type' => 'select',
		),
		array(
			'name'    => __( 'Disable Button', MISS_ADMIN_TEXTDOMAIN ),
			'id'      => 'footer_disable_button',
			'desc'    => __( 'This option may remove button from banner.', MISS_ADMIN_TEXTDOMAIN ),
			'options' => array( 'true' => __( 'Check this option to remove button from banner.', MISS_ADMIN_TEXTDOMAIN ) ),
			'type'    => 'checkbox'
		),
		array(
			'name'    => __( 'Caption Colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select caption colour.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '#ffffff',
			'id'  => 'footer_caption_color',
			'toggle_class' => 'footer_slider',
			'type' => 'color',
		),
		array(
			'name'    => __( 'Caption Font Size', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter caption font size with pixels.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '24px',
			'id'  => 'footer_caption_font_size',
			'toggle_class' => 'footer_slider',
			'type' => 'text',
		),
		array(
			'name'    => __( 'Content Colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select content colour.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '#ffffff',
			'id'  => 'footer_content_color',
			'toggle_class' => 'footer_slider',
			'type' => 'color',
		),
		array(
			'name'    => __( 'Content Font Size', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter content font size with pixels.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '14px',
			'id'  => 'footer_content_font_size',
			'toggle_class' => 'footer_slider',
			'type' => 'text',
		),

		array(
			'name'    => __( 'Background Colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please specify custom background colour.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => 'rgba(255,255,255, 0)',
			'id'  => 'footer_bg_color',
			'toggle_class' => 'footer_slider',
			'type' => 'color',
		),
		array(
			'name'    => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload background image.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '',
			'id'  => 'footer_bg_image',
			'toggle_class' => 'footer_slider',
			'type' => 'upload',
		),
		array(
			'name'    => __( 'Background Gradient Primary Colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please specify gradient primary colour.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '',
			'id'  => 'footer_bg_gradient_top',
			'toggle_class' => 'footer_slider',
			'type' => 'color',
		),
		array(
			'name'    => __( 'Background Gradient Secondary Colour', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please specify gradient secondary colour.', MISS_ADMIN_TEXTDOMAIN ),
			'default' => '',
			'id'  => 'footer_bg_gradient_bottom',
			'toggle_class' => 'footer_slider',
			'type' => 'color',
		),

		array(
			'type' => 'toggle_end'
		),
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>
