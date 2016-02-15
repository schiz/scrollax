<?php
/**
 *
 */
function miss_head() {
	do_atomic( 'head' );
}

/**
 *
 */
function miss_header() {
	do_atomic( 'header' );
}
/**
 *
 */

function miss_after_header() {
	do_atomic( 'after_header' );
}

/**
 *
 */
function miss_main_menu_begin() {
	do_atomic( 'main_menu_begin' );
}

/**
 *
 */
function miss_main_menu_end() {
	do_atomic( 'main_menu_end' );
}

/**
 *
 */
function miss_intro_begin() {
	do_atomic( 'intro_begin' );
}

/**
 *
 */
function miss_intro_end() {
	do_atomic( 'intro_end' );
}

/**
 *
 */
function miss_slider_region() {
	do_atomic( 'slider_region' );
}

/**
 *
 */
function miss_before_page_content() {
	do_atomic( 'before_page_content' );
}

/**
 *
 */
function miss_page_caption() {
	do_atomic( 'page_caption' );
}

/**
 *
 */
function miss_post_image_begin() {
	do_atomic( 'post_image_begin' );
}

/**
 *
 */
function miss_post_image_end( $args = array()  ) {
	do_atomic( 'post_image_end', $args );
}

/**
 *
 */
function miss_portfolio_image_begin() {
	do_atomic( 'portfolio_image_begin' );
}

/**
 *
 */
function miss_portfolio_image_end( $args = array() ) {
	do_atomic( 'portfolio_image_end', $args );
}

/**
 *
 */
function miss_before_portfolio_image() {
	do_atomic( 'before_portfolio_image' );
}

/**
 *
 */
function miss_after_portfolio_image() {
	do_atomic( 'after_portfolio_image' );
}

/**
 *
 */
function miss_before_post( $args = array() ) {
	do_atomic( 'before_post', $args );
}

/**
 *
 */
function miss_singular_after_post() {
	do_atomic( 'singular_after_post' );
}


/**
 *
 */
function miss_after_post() {
	do_atomic( 'after_post' );
}


/**
 *
 */
function miss_after_woocommerce_loop() {
	do_atomic( 'after_woocommerce_loop' );
}

/**
 *
 */
function miss_after_comments() {
	do_atomic( 'after_comments' );
}

/**
 *
 */
function miss_before_entry() {
	do_atomic( 'before_entry' );
}

/**
 *
 */
function miss_post_meta_row() {
	do_atomic( 'post_meta_row' );
}

/**
 *
 */
function miss_after_entry() {
	do_atomic( 'after_entry' );
}

/**
 *
 */
function miss_after_page_content() {
	do_atomic( 'after_page_content' );
}

/**
 *
 */
function miss_sidebar_begin() {
	do_atomic( 'sidebar_begin' );
}

/**
 *
 */
function miss_sidebar_end() {
	do_atomic( 'sidebar_end' );
}

/**
 *
 */
function miss_after_main() {
	do_atomic( 'after_main' );
}

/**
 *
 */
function miss_body_end() {
	do_atomic( 'body_end' );
}

?>
