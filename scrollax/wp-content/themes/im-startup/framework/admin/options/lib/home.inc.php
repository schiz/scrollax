<?php
/**
 * Home
 * @since 1.5
 */
$option_tabs['miss_homepage_tab'] = array('class' => 'home', 'title' => __( 'Homepage', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_homepage_tab' => $option_tabs ),
		'class'=> 'home',
		'icon' => 'icon-home.png',
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Default Layout', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You have ability to choose between a left, right, or no sidebar layout for your homepage, feel free to choose wherever you like.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'homepage_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/columns/home/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/columns/home/2.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/columns/home/3.png',
			),
			'type' => 'layout'
		),

		array(
			'name' => __( 'Custom Homepage Text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can add additional text / shortcode / content for homepage.<br /><br />This will display under the slider and call to action button.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'content',
			'type' => 'editor'
		),
	array(
		'type' => 'tab_end'
	),

);