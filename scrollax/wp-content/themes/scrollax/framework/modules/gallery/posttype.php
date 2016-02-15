<?php
/**
 * Gallery Post Type
 *
 * @package MissFramework
 */

/*register_post_type('miss_gallery', array(
	'labels' => array(
		'name' => _x('Albums', 'post type general name', MISS_ADMIN_TEXTDOMAIN ),
		'singular_name' => _x('Album', 'post type singular name', MISS_ADMIN_TEXTDOMAIN ),
		'add_new' => _x('Add New', 'miss_gallery', MISS_ADMIN_TEXTDOMAIN ),
		'add_new_item' => __('Add New Album', MISS_ADMIN_TEXTDOMAIN ),
		'edit_item' => __('Edit Album', MISS_ADMIN_TEXTDOMAIN ),
		'new_item' => __('New Album', MISS_ADMIN_TEXTDOMAIN ),
		'view_item' => __('View Album', MISS_ADMIN_TEXTDOMAIN ),
		'search_items' => __('Search Albums', MISS_ADMIN_TEXTDOMAIN ),
		'not_found' =>  __('No albums found', MISS_ADMIN_TEXTDOMAIN ),
		'not_found_in_trash' => __('No albums found in Trash', MISS_ADMIN_TEXTDOMAIN ), 
		'parent_item_colon' => ''
	),
	'singular_label' => __('Album', MISS_ADMIN_TEXTDOMAIN ),
    'public'                => true,
    'publicly_queryable'    => true,
    'query_var'             => true,
    'rewrite'               => array( 'slug' => MISS_REWRITE_GALLERY, 'with_front' => false ),
    'capability_type'       => 'post',
    'has_archive'           => false,
    'hierarchical'          => false,
	'menu_icon'             => MISS_PHOTOALBUMS_URI . '/images/admin_ico_gallery.png',
    'supports'              => array( 'title', 'excerpt' )
));*/
// flush_rewrite_rules();

//add_action('init', 'miss_gallery_post_type');

?>