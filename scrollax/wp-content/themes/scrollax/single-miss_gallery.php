<?php
/**
 * Single Template
 *
 * @package MissFramework
 * @subpackage StartUp Theme
 */
global $irish_framework_params;
get_header();

$layout = new miss_page_layout($layout = miss_page_layout(), $location = 'views/single', $type = 'single', $template = 'gallery' );
$layout->miss_render_page_layout();
get_footer();
?>