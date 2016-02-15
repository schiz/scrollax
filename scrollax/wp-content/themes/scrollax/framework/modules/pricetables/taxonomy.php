<?php
/**
 * Register taxonomy for Benefits
 *
 * @package MissFramework
 */
register_taxonomy('benefits_category','benefits',array(
	'hierarchical' => true,
	'labels' => array(
		'name' => _x( 'Benefits Categories', 'taxonomy general name', MISS_ADMIN_TEXTDOMAIN ),
		'singular_name' => _x( 'Benefits Category', 'taxonomy singular name', MISS_ADMIN_TEXTDOMAIN ),
		'search_items' =>  __( 'Search Categories', MISS_ADMIN_TEXTDOMAIN ),
		'popular_items' => __( 'Popular Categories', MISS_ADMIN_TEXTDOMAIN ),
		'miss_items' => __( 'All Categories', MISS_ADMIN_TEXTDOMAIN ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Benefits Category', MISS_ADMIN_TEXTDOMAIN ), 
		'update_item' => __( 'Update Benefits Category', MISS_ADMIN_TEXTDOMAIN ),
		'add_new_item' => __( 'Add New Benefits Category', MISS_ADMIN_TEXTDOMAIN ),
		'new_item_name' => __( 'New Benefits Category Name', MISS_ADMIN_TEXTDOMAIN ),
		'separate_items_with_commas' => __( 'Separate Benefits category with commas', MISS_ADMIN_TEXTDOMAIN ),
		'add_or_remove_items' => __( 'Add or remove benefits category', MISS_ADMIN_TEXTDOMAIN ),
		'choose_from_most_used' => __( 'Choose from the most used benefits category', MISS_ADMIN_TEXTDOMAIN )
	),
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => true,
));
?>