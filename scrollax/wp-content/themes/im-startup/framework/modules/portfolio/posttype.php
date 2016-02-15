<?php
/**
 * Portfolio Post Type
 *
 * @package MissFramework
 */
register_post_type('portfolio', array(
	'labels' => array(
		'name' => _x('Portfolios', 'post type general name', MISS_ADMIN_TEXTDOMAIN ),
		'singular_name' => _x('Portfolio', 'post type singular name', MISS_ADMIN_TEXTDOMAIN ),
		'add_new' => _x('Add New', 'portfolio', MISS_ADMIN_TEXTDOMAIN ),
		'add_new_item' => __('Add New Portfolio', MISS_ADMIN_TEXTDOMAIN ),
		'edit_item' => __('Edit Portfolio', MISS_ADMIN_TEXTDOMAIN ),
		'new_item' => __('New Portfolio', MISS_ADMIN_TEXTDOMAIN ),
		'view_item' => __('View Portfolio', MISS_ADMIN_TEXTDOMAIN ),
		'search_items' => __('Search Portfolios', MISS_ADMIN_TEXTDOMAIN ),
		'not_found' =>  __('No portfolios found', MISS_ADMIN_TEXTDOMAIN ),
		'not_found_in_trash' => __('No portfolios found in Trash', MISS_ADMIN_TEXTDOMAIN ), 
		'parent_item_colon' => ''
	),
	'singular_label' => __('Portfolio', MISS_ADMIN_TEXTDOMAIN ),
	'public' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => true,
    'rewrite' => array( 'slug' => MISS_REWRITE_PORTFOLIO, 'with_front' => true ),
	'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/portfolio.png',
	'query_var' => true,
	'publicly_queryable' => true,
	'can_export' => true,
//	'rewrite' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments' ),
    'taxonomies' => array('post_tag') 
));
// flush_rewrite_rules();
?>