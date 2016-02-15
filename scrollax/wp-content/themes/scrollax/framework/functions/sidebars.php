<?php
if ( !function_exists( 'miss_sidebars' ) ) :
/**
 *
 */
function miss_sidebars() {
	# Register default widgetized areas
	$sidebars = array(
		'primary' => array(
			'name' => __( 'Primary Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The primary widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'home' => array(
			'name' => __( 'Homepage Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The homepage widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'footer1' => array(
			'name' => __( 'First Footer Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The first footer widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'footer2' => array(
			'name' => __( 'Second Footer Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The second footer widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'footer3' => array(
			'name' => __( 'Third Footer Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The third footer widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'footer4' => array(
			'name' => __( 'Fourth Footer Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The fourth footer widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'footer5' => array(
			'name' => __( 'Fifth Footer Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The fifth footer widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'footer6' => array(
			'name' => __( 'Sixth Footer Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The sixth footer widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'store' => array(
			'name' => __( 'Store Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The ecommerce widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'error404_2' => array(
			'name' => __( 'Error 404 Second Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The second (1/2) Error 404 widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'error404_3' => array(
			'name' => __( 'Error 404 Third Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The third (1/4) Error 404 widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'error404_4' => array(
			'name' => __( 'Error 404 Fourth Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The fourth (1/4) Error 404 widget area', MISS_ADMIN_TEXTDOMAIN )
		),
		'buddypress' => array(
			'name' => __( 'BuddyPress Widget Area', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The BuddyPress widget area', MISS_ADMIN_TEXTDOMAIN )
		),
	);

	foreach ( $sidebars as $type => $sidebar ){
		register_sidebar(array(
			'name' => $sidebar['name'],
			'id'=> $type,
			'description' => $sidebar['desc'],
			'before_widget' => '<div id="%1$s" class="module %2$s"><div class="wrap">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="header turquoise-tpl ribbon-style ribbon-light-style">',
			'after_title' => '</div>',
		));
	}
	
	# Register custom sidebars areas
	$custom_sidebars = get_option( MISS_SIDEBARS );
	if( !empty( $custom_sidebars ) ) {
		foreach ( $custom_sidebars as $id => $name ) {
			register_sidebar(array(
				'name' => $name,
				'id'=> "miss_custom_sidebar_{$id}",
				'description' => $name,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widgettitle"><span>',
				'after_title' => '</span></h4>',
			));
		}
	}
}
endif;

if ( !function_exists( 'miss_get_sidebar' ) ) :
/**
 *
 */
function miss_get_sidebar() {
	wp_reset_query();
	
	global $wp_query;
	
	if( is_404() ) return;
	
	$sidebar = true;
	
	if( is_singular() ) {
		$type = get_post_type();
		$post_obj = $wp_query->get_queried_object();
		
		$template = get_post_meta( $post_obj->ID, '_wp_page_template', true );
		$_layout = get_post_meta( $post_obj->ID, '_layout', true );
		
		if( $_layout == 'full_width' )
			$sidebar = false;
			
		if( ( $type == 'portfolio' ) && ( empty( $_layout ) ) )
			$sidebar = false;

		if( $template == 'templates/template-wiki.php' )
			$sidebar = false;
			
		if( strpos( $post_obj->post_content, '[portfolio' ) !== false && empty( $_layout ) )
			$sidebar = false;
	}
	
	if( ( is_front_page() ) && ( !is_active_sidebar( 'home' ) ) )
		$sidebar = false;
		
	$sidebar = apply_atomic( 'get_sidebar', $sidebar );

	if( $sidebar == true )
		get_sidebar();
}
endif;

if ( !function_exists( 'miss_dynamic_sidebar' ) ) :
/**
 *
 */
function miss_dynamic_sidebar() {
	wp_reset_query();
	
	global $wp_query, $post;
	
	$post_obj = $wp_query->get_queried_object();

	/*if( !empty( $post_obj->ID ) && !is_front_page() ) {
		$custom = get_post_meta( $post_obj->ID, '_custom_sidebar', true );
	}

	if( !is_front_page() && empty( $custom ) ) {
		$sidebar = 'primary';
	}

	if( !empty( $custom ) ) {
		$sidebar = $custom;
	}
		
	if( is_front_page() ) {
		$sidebar = 'home';
	}

	if ( miss_is_bp() ) {
		if ( bp_is_group() ) {
			$sidebar = 'buddypress';
		}
	}*/
    $sidebar = 'primary';

	if( function_exists('is_woocommerce') && is_woocommerce() ) {
		$sidebar = 'store';
	}

	if( function_exists('is_bbpress') && is_bbpress() ) {
		$sidebar = 'buddypress';
	}

	if( isset( $sidebar ) ) {
		dynamic_sidebar( $sidebar );
	}
}
endif;

?>