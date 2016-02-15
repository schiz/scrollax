<?php
/**
 * Blog Layout
 * @since 1.5
 */

$option_tabs['miss_blog_tab'] = array('class' => 'layout', 'title' => __( 'Blog Layout', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_blog_tab' => $option_tabs ),
		'class'=> 'layout',
		'icon' => 'icon-layout.png',
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Blog title', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter custom title for Blog here.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_title',
			'default' =>  __( 'Blog', MISS_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'blog_title',
			'type' => 'text'
		),

/*
		array(
			'name' => __( 'Blog Page', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose one of your pages to use as a blog page.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_page',
			'target' => 'page',
			'type' => 'select'
		),
*/

/*		array(
			'name' => __( 'Pagination mode', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Please specify pagination mode for your blog posts and custom posts index.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'pagination_type',
			'default' => 'manual',
			'options' => array( 
				'manual' => __( 'Use classic pagination', MISS_ADMIN_TEXTDOMAIN ),
				'auto' => __( 'Load posts automatically where latest reached', MISS_ADMIN_TEXTDOMAIN ),
				// 'semi' => __( 'Use Load More button', MISS_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),
*/
		
		array(
			'name' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Turn on CSS3 transitions. You may specify animation effect.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_layout_animation',
			'default' => '',
			'type' => 'select',
			'target'=> 'css_animation',
			'shortcode_dont_multiply' => true,
			'shortcode_optional_wrap' => false
		),

	
	array(
		'type' => 'tab_end'
	)

);