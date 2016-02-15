<?php
/**
 * BuddyPress Template Members Index
 *
 * @package missframework
 */
global $irish_framework_params;
get_header();

$layout = new miss_page_layout($layout = miss_page_layout(), $location = 'views/buddypress/members', $type = 'members', $template = 'home' );
$layout->miss_render_page_layout();

get_footer();
?>