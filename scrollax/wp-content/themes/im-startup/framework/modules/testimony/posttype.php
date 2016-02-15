<?php
/**
 * Testimonials Post Type
 *
 * @package MissFramework
 */
register_post_type('testimonials', array(
	'labels' => array(
		'name' => _x('Testimonials', 'post type general name', MISS_ADMIN_TEXTDOMAIN ),
		'singular_name' => _x('Testimony', 'post type singular name', MISS_ADMIN_TEXTDOMAIN ),
		'add_new' => _x('Add New', 'service', MISS_ADMIN_TEXTDOMAIN ),
		'add_new_item' => __('Add New Testimony', MISS_ADMIN_TEXTDOMAIN ),
		'edit_item' => __('Edit Testimonial', MISS_ADMIN_TEXTDOMAIN ),
		'new_item' => __('New Testimonial', MISS_ADMIN_TEXTDOMAIN ),
		'search_items' => __('Search Testimonial', MISS_ADMIN_TEXTDOMAIN ),
		'not_found' =>  __('No testimonials found', MISS_ADMIN_TEXTDOMAIN ),
		'not_found_in_trash' => __('No testimonials found in Trash', MISS_ADMIN_TEXTDOMAIN ), 
		'parent_item_colon' => ''
	),
	'singular_label' => __('Testimonial', MISS_ADMIN_TEXTDOMAIN ),
	'public' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => true,
	'rewrite' => array( 'slug' => MISS_REWRITE_TESTIMONIALS, 'with_front' => false ),
	'has_archive' => true,
	'query_var' => true,
	'supports' => array( 'title', 'editor', 'thumbnail' )
));
?>