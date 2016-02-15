<?php
/**
 * Pricetable Post Type
 *
 * @package MissFramework
 */
register_post_type('pricetable',array(
	'labels' => array(
		'name' => __('Pricing Tables', 'pricetable'),
		'singular_name' => __('Pricing Table', 'pricetable'),
		'add_new' => __('Add New', 'book', 'pricetable'),
		'add_new_item' => __('Add New Pricing Table', 'pricetable'),
		'edit_item' => __('Edit Pricing Table', 'pricetable'),
		'new_item' => __('New Pricing Table', 'pricetable'),
		'all_items' => __('All Pricing Tables', 'pricetable'),
		'view_item' => __('View Pricing Table', 'pricetable'),
		'search_items' => __('Search Pricing Tables', 'pricetable'),
		'not_found' =>  __('No Pricing Tables found', 'pricetable'),
	),
	'public' => true,
	'has_archive' => false,
	'rewrite' => array( 'slug' => 'pricetable','with_front' => FALSE),
	'capability_type' => 'post',
	'hierarchical' => false,
	'publicly_queryable' => true,
	'show_ui' => true,		'query_var' => true,
	'supports' => array( 'title', 'editor', 'revisions', 'thumbnail', 'excerpt' ),
	'menu_icon' => THEME_ASSETS . '/images/pricetable/icon.png',
));
// flush_rewrite_rules();
?>