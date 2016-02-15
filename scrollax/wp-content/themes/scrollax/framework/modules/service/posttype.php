<?php
/**
 * Services Post Type
 *
 * @package MissFramework
 */
register_post_type('service', array(
	'labels' => array(
		'name' => _x('Services', 'post type general name', MISS_ADMIN_TEXTDOMAIN ),
		'singular_name' => _x('Services', 'post type singular name', MISS_ADMIN_TEXTDOMAIN ),
		'add_new' => _x('Add New', 'service', MISS_ADMIN_TEXTDOMAIN ),
		'add_new_item' => __('Add Services', MISS_ADMIN_TEXTDOMAIN ),
		'edit_item' => __('Edit Services', MISS_ADMIN_TEXTDOMAIN ),
		'new_item' => __('Add Services', MISS_ADMIN_TEXTDOMAIN ),
		'view_item' => __('View Services', MISS_ADMIN_TEXTDOMAIN ),
		'search_items' => __('Search Services', MISS_ADMIN_TEXTDOMAIN ),
		'not_found' =>  __('No services found', MISS_ADMIN_TEXTDOMAIN ),
		'not_found_in_trash' => __('No services found in Trash', MISS_ADMIN_TEXTDOMAIN ), 
		'parent_item_colon' => ''
	),
	'singular_label' => __('Services', MISS_ADMIN_TEXTDOMAIN ),
	'public' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/news.png',
	'capability_type' => 'post',
	'hierarchical' => true,
	'rewrite' => array( 'slug' => MISS_REWRITE_NEWS, 'with_front' => false ),
	'has_archive' => true,
	'query_var' => true,
	'supports' => array( 'title', 'editor', 'thumbnail' )
));
?>