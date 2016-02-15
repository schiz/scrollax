<?php
/**
 * Single Attachment Template
 *
 * @package MissFramework
 * @subpackage StartUp Theme
 */
global $irish_framework_params;

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		echo '<img src="' .$post->guid .'" alt="' . get_the_title() . '" title="' . get_the_title() . '" width="100%" />';
	}
}
get_footer();
?>