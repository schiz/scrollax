<?php
/**
 * BuddyPress Template Forum Loop
 *
 * @package missframework
 */
global $irish_framework_params;
$layout = new miss_page_layout($layout = 'full_width', $location = 'views/buddypress/forums', $type = 'forum', $template = 'loop' );
$layout->miss_render_page_layout();
?>
