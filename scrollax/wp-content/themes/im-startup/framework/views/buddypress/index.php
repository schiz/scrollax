<?php
/**
 * Page Template
 *
 * @package IrishMiss
 * @package Startup
 */
global $irish_framework_params;
get_header();

$layout = new miss_page_layout($layout = miss_buddypress_layout(), $location = 'views/buddypress', $type = 'buddypress', $template = 'index' );
$layout->miss_render_page_layout();
get_footer();
?>