<?php
/**
 * Template Name: White, no title
 *
 * @package IrishMiss
 * @package Startup
 */
global $irish_framework_params;
get_header();

$layout = new miss_page_layout($layout = miss_page_layout(), $location = 'views/single', $type = 'single', 'white' );
$layout->miss_render_page_layout();

get_footer();
?>