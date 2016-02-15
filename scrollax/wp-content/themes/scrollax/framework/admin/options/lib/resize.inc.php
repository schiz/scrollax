<?php
/**
 * Image Resizing
 * @since 1.5
 */

$option_tabs['miss_imageresizing_tab'] = array('class' => 'resize', 'title' => __( 'Image Resizing', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_imageresizing_tab' => $option_tabs ),
		'icon' => 'icon-resize.png',
		'class'=> 'resize',
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Disable Image Resizing', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this option to disable all image resizing.<br />Images will be displayed in the dimensions as they were uploaded. This option is not recommended.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'image_resize',
			'options' => array( 'true' => __( 'Disable Image Resizing', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),

		array(
			'name' => __( 'Image Resizing Method', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose the way you wish to use for image resizing. Here is present WordPress Built-In (recommended) resizing and Timthumb script.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'image_resize_type',
			'options' => array( 
				'wordpress' => __( 'Built-In WordPress', MISS_ADMIN_TEXTDOMAIN ),
				'timthumb' => __( 'Timthumb', MISS_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),

		array(
			'name' => __( 'Auto Featured Image', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'By default features such as the portfolio and blog will use the "featured image" in your posts.<br /><br />Check this if you wish to use the first image uploaded to your post instead of the featured image.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'auto_img',
			'options' => array( 'true' => __( 'Enable Auto Featured Image Selection', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => "checkbox"
		),
		
		array(
			'name' => __( 'Portfolio Images Sizes', MISS_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),
		
		array(
			'name' => __( 'One Column Portfolio', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the one column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'one_column_portfolio_big',
			'type' => 'resize'
		),

		array(
			'name' => __( 'Two Column Portfolio', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you\'d like the two column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'two_column_portfolio_big',
			'type' => 'resize'
		),

		array(
			'name' => __( 'Three Column Portfolio', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the three column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'three_column_portfolio_big',
			'type' => 'resize'
		),

		array(
			'name' => __( 'Four Column Portfolio', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'four_column_portfolio_big',
			'type' => 'resize'
		),

		array(
			'name' => __( 'Portfolio Single Post', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the portfolio single images to use.<br /><br />These are the images displayed on the portfolio single post.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'portfolio_single_full_big',
			'type' => 'resize'
		),

		array(
			'type' => 'toggle_end'
		),


		array(
			'name' => __( 'Blog Images Sizes', MISS_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'One Column Blog (First Variant)', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the one column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_layout1_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'One Column Blog (Second Variant)', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the two column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_layout2_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Two Column Blog', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the three column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_layout3_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Three Column Blog', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_layout4_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Four Column Blog', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_layout5_big',
			'type' => 'resize'
		),

		array(
			'name' => __( 'Small Post List', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "small" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'small_post_list_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Medium Post List', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "medium" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'medium_post_list_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Large Post List', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "large" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a right sidebar layout.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'large_post_list_big',
			'type' => 'resize'
		),

		array(
			'name' => __( 'Additional Posts Module', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the additional posts thumbnails to use.<br /><br />These are the images displayed in the additional posts module.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'additional_posts_grid_big',
			'type' => 'resize'
		),

		array(
			'type' => 'toggle_end'
		),

		array(
			'name' => __( 'Override Options', MISS_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Override image directory', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this option to override theme path (ABSOLUTE and URL).', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'image_override_enable',
			'options' => array( 'true' => __( 'Override image path', MISS_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),

		array(
			'name' => __( 'Override website URL', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This option can override website URL for images.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'image_override_url',
			'default' => get_template_directory_uri(),
			'toggle_class' => 'image_override_url',
			'type' => 'text'
		),

		array(
			'name' => __( 'Override website ABSOLUTE PATH', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This option can override website ABSOLUTE PATH for images.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'image_override_path',
			'default' => get_template_directory(),
			'toggle_class' => 'image_override_path',
			'type' => 'text'
		),

		array(
			'type' => 'toggle_end'
		),
		

	array(
		'type' => 'tab_end'
	),
);
