<?php
/**
 * BuddyPress Template Forum Index
 *
 * @package missframework
 */
global $irish_framework_params;
get_header();

$layout = new miss_page_layout($layout = miss_page_layout(), $location = 'views/buddypress/forums', $type = 'forum', $template = 'index' );
$layout->miss_render_page_layout();

get_footer();
?>