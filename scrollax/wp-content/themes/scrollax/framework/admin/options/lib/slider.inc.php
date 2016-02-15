<?php
/**
 * Slider
 * @since 1.5
 */

$option_tabs['miss_slideshow_tab'] = array('class' => 'slider', 'title' => __( 'Image Slider', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_slideshow_tab' => $option_tabs ),
		'class'=> 'slider',
		'icon' => 'icon-slider.png',
		'type' => 'tab_start'
	),

		array(
			'name' => __( 'Text Shorten', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'homepage_slider_flexslider_trim',
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Title Length', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This option will make title shorten by trimming words.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_info_title_len',
			'default' => '120',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),

		array(
			'name' => __( 'Description Length', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This option will make slider description shorten by trimming words.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_info_descr_len',
			'default' => '120',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),
		array(
			'type' => 'toggle_end'
		),

		array(
			'name' => __( 'Advanced Flex Slider Settings', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'slider_option_toggle',
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select your animation type, "fade" or "slide"', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_animation',
			'target' => 'flex_animation',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'select',
			'options' => array( 
				'fade' => __( 'Fade', MISS_ADMIN_TEXTDOMAIN ),
				'slide' => __( 'Slide', MISS_ADMIN_TEXTDOMAIN )
			),
		),

		array(
			'name' => __( 'Direction', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select the sliding direction, "horizontal" or "vertical"', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_direction',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'select',
			'options' => array( 
				'vertical' => __( 'Vertical', MISS_ADMIN_TEXTDOMAIN ),
				'horizontal' => __( 'Horizontal', MISS_ADMIN_TEXTDOMAIN )
			),
		),

		array(
			'name' => __( 'Slideshow', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Animate slider automatically', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_slideshow',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Slideshow Speed', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Set the speed of the slideshow cycling, in milliseconds', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_slideshow_speed',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),

		array(
			'name' => __( 'Animation Duration', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Set the speed of animations, in milliseconds', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_animation_duration',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),

		array(
			'name' => __( 'Direction Navigation', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Create navigation for previous/next navigation? (true/false)', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_direction_navigation',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Control Navigation', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Create navigation for paging control of each slide?', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_control_navigation',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),

		array(
			'name' => __( 'Keyboard Navigation', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Allow slider navigating via keyboard left/right keys', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_keyboard_navigation',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),

		array(
			'name' => __( 'Mousewheel Navigation', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Allow slider navigating via mousewheel', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_mousewheel_navigation',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),

		array(
			'name' => __( 'Previous Text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Set the text for the "previous" directionNav item', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_prevtext',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),

		array(
			'name' => __( 'Next Text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Set the text for the "next" directionNav item', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_nexttext',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),

		array(
			'name' => __( 'Pause / Play Dynamic element', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Create pause/play dynamic element', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_pauseplay',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),

		array(
			'name' => __( 'Pause Text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Set the text for the "pause" pausePlay item', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_pausetext',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),

		array(
			'name' => __( 'Play Text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Set the text for the "play" pausePlay item', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_playtext',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),

		array(
			'name' => __( 'Randomize', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Randomize slide order', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_randomize',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),

		array(
			'name' => __( 'Starting slide', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The slide that the slider should start on. Array notation (0 = first slide)', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_startingslide',
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'text'
		),

		array(
			'name' => __( 'Animation Loop', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Should the animation loop? If false, directionNav will received "disable" classes at either end', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_loop',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),

		array(
			'name' => __( 'Pause on Action', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Pause the slideshow when interacting with control elements, highly recommended.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_pauseonaction',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),

		array(
			'name' => __( 'Pause on Hover', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Pause the slideshow when hovering over slider, then resume when no longer hovering', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'flex_pauseonhover',
			'options' => array( 
				'true' => __( 'True', MISS_ADMIN_TEXTDOMAIN ),
				'false' => __( 'False', MISS_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_flexslider',
			'type' => 'radio'
		),
		
		array(
			'type' => 'toggle_end'
		),
		
	array(
		'type' => 'tab_end'
	),
);
	