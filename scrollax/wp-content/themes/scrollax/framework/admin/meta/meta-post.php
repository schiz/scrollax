<?php

$meta_boxes = array(
	'title' => sprintf( __( '%1$s General Post Options', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'miss_post_meta_box',
	'pages' => array( 'post' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	/**
	 * Deprecated
	 * @since 1.5
	 */
		array(
			'name' => __( 'Featured Video', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can paste a URI of a video here to display within your post.<br /><br />Examples on how to format the links.<br /><br />YouTube:<br /><br />http://www.youtube.com/watch?v=fxs970FMYIo<br /><br />Vimeo:<br /><br />http://vimeo.com/8736190', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_featured_video',
			'type' => 'text'
		),
		array(
			'name' => __( 'Disable Featured Image', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Check this box if you'd like to disable the featured post image from appearing on the single post, by checking this box the featured post image you have defined will only show on the blog index page and the designated widgets.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_disable_post_image',
			'options' => array( 'true' => __( 'Check to disable the featured image on this post', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Post Icon', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Please select post icon for some theme features such as Expose Slider.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_icon',
			'std' => 'im-icon-image-2',
			'default' => array_rand( miss_get_all_font_icons() ),
			'target' => 'all_icons',
			'type' => 'select'
		),
		array(
			'name' => __( 'Disable Social Bookmarks', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( "By default a social bookmarks module will display when viewing your posts.<br /><br />You can choose to disable it here.", MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_disable_social_bookmarks',
			'options' => array( 'true' => __( 'Disable the Social Bookmarks Module', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Post Display type', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Here, you can choose specific type of display this post.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_post_feature_display_type',
			'default' => 'default',
			'options' => array( 
				'default' => __( 'Display featured Image / Video', MISS_ADMIN_TEXTDOMAIN ),
				'additional_images' => __( 'Display Additional Post Images', MISS_ADMIN_TEXTDOMAIN ),
				'quote' => __( 'Display custom quote', MISS_ADMIN_TEXTDOMAIN ),
				'sound_cloud' => __( 'Display Sound Cloud', MISS_ADMIN_TEXTDOMAIN ),
				'image_left' => __( 'Display article, image left', MISS_ADMIN_TEXTDOMAIN ) 
			),
			'type' => 'radio'
		),
		array(
			'name' => __( 'Featured Quote', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Type here quote that you want to highlight', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_custom_quote',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Link on Featured Sound Cloud', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can define sound cloud URI here. <br />Example: https://soundcloud.com/vexare/children-vexare-remix', MISS_ADMIN_TEXTDOMAIN ),
			'id' => '_sound_cloud',
			'type' => 'text'
		),
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>
