<?php
/**
 * News Post Type
 *
 * @package MissFramework
 */
register_post_type('news', array(
	'labels' => array(
		'name' => _x('News', 'post type general name', MISS_ADMIN_TEXTDOMAIN ),
		'singular_name' => _x('News', 'post type singular name', MISS_ADMIN_TEXTDOMAIN ),
		'add_new' => _x('Add New', 'service', MISS_ADMIN_TEXTDOMAIN ),
		'add_new_item' => __('Add News', MISS_ADMIN_TEXTDOMAIN ),
		'edit_item' => __('Edit News', MISS_ADMIN_TEXTDOMAIN ),
		'new_item' => __('Add News', MISS_ADMIN_TEXTDOMAIN ),
		'view_item' => __('View News', MISS_ADMIN_TEXTDOMAIN ),
		'search_items' => __('Search News', MISS_ADMIN_TEXTDOMAIN ),
		'not_found' =>  __('No news found', MISS_ADMIN_TEXTDOMAIN ),
		'not_found_in_trash' => __('No news found in Trash', MISS_ADMIN_TEXTDOMAIN ), 
		'parent_item_colon' => ''
	),
	'singular_label' => __('News', MISS_ADMIN_TEXTDOMAIN ),
	'public' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/news.png',
	'capability_type' => 'post',
	'hierarchical' => true,
	'rewrite' => array( 'slug' => MISS_REWRITE_NEWS, 'with_front' => false ),
	'has_archive' => true,
	'query_var' => true,
	'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
    'taxonomies' => array( 'post_tag'),
));
?>