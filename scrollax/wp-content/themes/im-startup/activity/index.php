<?php
/**
 * Template Name: BuddyPress - Activity Directory
 *
 * @package BuddyPress
 * @subpackage Theme
 */
global $irish_framework_params;
get_header();

$layout = new miss_page_layout($layout = miss_page_layout(), $location = 'views/buddypress/activity', $type = 'index', $template = 'activity' );
$layout->miss_render_page_layout();
get_footer();

?>