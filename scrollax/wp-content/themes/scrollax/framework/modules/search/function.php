<?php
/**
 * Search
 *
 * @package MissFramework
 * @since 1.7
 */


if ( !function_exists( 'miss_search' ) ) :
/**
 *
 */
function miss_search() {
	$layout = Array (
		"blog_layout" => "blog_layout1",
		"main_class" => "post_grid blog_layout1",
		"post_class" => "post_grid_module",
		"content_class" => "post_grid_content",
		"img_class" => "na"
	);
	get_template_part( 'loop', 'search' );
}
endif;


if ( !function_exists( 'miss_nav_search_box' ) ) :
/**
 * Navigation Search Box
 * @since 1.5
 */
function miss_nav_search_box($items, $args) {
	$disable_searchbox = apply_atomic( 'disable_searchbox', miss_get_setting( 'disable_searchbox' ) );
	if( !empty( $disable_searchbox ) ) {
		return $items;
	}
	

	if( $args->theme_location == 'primary-menu' ) {
		ob_start();
		get_search_form();
		$searchform = ob_get_contents();
		ob_end_clean();
		$items .= '<li class="nav-search-box">' . $searchform . '<a class="search-button inactive" data-state="inactive">' . __("Search", MISS_TEXTDOMAIN) . '</a></li>';
	}
	return $items;
}
endif;

?>