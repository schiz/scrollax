<?php
/**
 * BuddyPress Template Members Notifications Settings
 *
 * @package missframework
 */
global $irish_framework_params;
get_header();

$layout = new miss_page_layout($layout = miss_page_layout(), $location = 'views/buddypress/members', $type = 'settings', $template = 'notifications' );
$layout->miss_render_page_layout();

get_footer();
?>