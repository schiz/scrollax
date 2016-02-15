<?php
/**
 * Home Template
 *
 * @package IrishMiss
 * @package Startup
 */

get_header();
$post_obj = $wp_query->get_queried_object();
if ( ( !empty( $post_obj->ID ) && get_option('page_for_posts') == $post_obj->ID ) ) {
    $page_template = 'blog';
} else {
    $page_template = 'blog';
//    $page_template = 'default';
}
$layout = new miss_page_layout($layout = miss_page_layout(), $location = 'views/loops', $template = $page_template );
$layout->miss_render_page_layout();
get_footer();
?>