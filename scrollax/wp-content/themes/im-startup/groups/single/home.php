<?php
/**
 * BuddyPress Template Single Group Home
 *
 * @package missframework
 */
global $irish_framework_params;
get_header();

$layout = new miss_page_layout($layout = 'right_sidebar', $location = 'views/buddypress/groups', $type = 'single', $template = 'home' );
$layout->miss_render_page_layout();
get_footer();
?>