<?php
/**
 * Archive Template
 *
 * @package IrishMiss
 * @package Startup
 */
global $irish_framework_params, $post;
get_header();

//miss_archive();
$layout = new miss_page_layout($layout = miss_page_layout(), $location = 'views/loops', $type = 'loop', $template = get_post_type() );
$layout->miss_render_page_layout();

get_footer();
?>