<?php
/**
 * BuddyPress Template Groups Loop
 *
 * @package missframework
 */
global $irish_framework_params;

$layout = new miss_page_layout($layout = 'full_width', $location = 'views/buddypress/groups', $type = 'buddypress', $template = 'loop' );
$layout->miss_render_page_layout();
?>