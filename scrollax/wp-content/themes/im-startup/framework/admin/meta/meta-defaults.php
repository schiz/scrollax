<?php
global $wpdb;
$meta_boxes = array(
	'title' => sprintf( __( '%1$s Page Layout', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_side_meta_box',
	'pages' => array( 'page', 'post', 'portfolio', 'news', 'service', 'partners', 'pricetable', 'tribe_events', 'events', 'vacancy' ),
	'callback' => '',
	'context' => 'side',
	'priority' => 'default',
	'fields' => array(
		array(
			'name' => __( 'Layout', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your page.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_layout',
			'toggle_class' => 'page_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/1.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/threefourth_fourth.png',
			),
			'default' => 'right_sidebar',
			'type' => 'layout'
		),

		array(
			'name' => __( 'Page Tagline', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Tagline appears right after page title.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_page_tagline',
			'toggle_class' => 'page_tagline',
			'options' => array( 'true' => __( 'Alternative page title.', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'text'
		),

	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>
