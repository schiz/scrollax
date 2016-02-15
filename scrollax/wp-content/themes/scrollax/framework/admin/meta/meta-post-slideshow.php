<?php

$meta_boxes = array(
	'title' => sprintf( __( '%1$s Slideshow Post Options', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_post_slideshow_meta_box',
	'pages' => array( 'post' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __( 'Homepage Slider Image', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Upload the image you'd like to use for the slideshow.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_homepage_image',
			'toggle_class' => '_homepage_slider_image',
			'type' => 'upload'
		),
		array(
			'name' => __( 'Stage Effect', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Select the the staging effect that you'd like for this slide.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_homepage_slider_stage',
			'target' => 'slider_stage',
			'type' => 'select'
		),
		array(
			'name' => __( 'Disable Slider Text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Check this box if you'd like to disable the post excerpt content from appearing on the slideshow.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_homepage_disable_excerpt',
			'options' => array( 'true' => __( 'Check to disable slider text', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		)
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>
