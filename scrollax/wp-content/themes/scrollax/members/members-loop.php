<?php
/**
 * BuddyPress Template Members Loop
 *
 * @package missframework
 */
global $irish_framework_params;
$layout = new miss_page_layout($layout = 'full_width', $location = 'views/buddypress/members', $type = 'members', $template = 'loop' );
$layout->miss_render_page_layout();
?>
