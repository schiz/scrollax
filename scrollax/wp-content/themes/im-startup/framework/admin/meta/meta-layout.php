<?php
global $wpdb;
$meta_boxes = array(
	'title' => sprintf( __( '%1$s Page Layout', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_side_meta_box',
	'pages' => array( 'page','post','portfolio','news','partners' ),
	'callback' => '',
	'context' => 'side',
	'priority' => 'normal',
	'fields' => array(
		array(
			'name' => __( 'Layout', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your page.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/fourth_threefourth.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/columns/footer/threefourth_fourth.png',
			),
			'default' => 'right_sidebar',
			'type' => 'layout'
		),
		array(
			'name' => __( 'Custom Sidebar', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Select the custom sidebar that you'd like to be displayed on this page.<br /><br />Note:  You will need to first create a custom sidebar under the &quot;Sidebar&quot; tab in your theme's option panel before it will show up here.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_custom_sidebar',
			'target' => 'custom_sidebars',
			'type' => 'select'
		),
		array(
			'name' => __( 'Disable Breadcrumbs', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Disable breadcrumbs on a page by page basis.  Alternatively you can globally disable breadcrumbs under the &quot;General Settings&quot; tab in your theme's option panel.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_disable_breadcrumbs',
			'options' => array( 'true' => __( 'Check this option to disable breadcrumbs on this page', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		)
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>
