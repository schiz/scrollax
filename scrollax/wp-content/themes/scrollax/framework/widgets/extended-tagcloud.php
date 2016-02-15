<?php
/* Customisation */
function miss_tag_cloud_args( $args ) {
	$args = Array (
		'number' => 20,
		'largest' => 12,
		'smallest' => 12,
		'unit' => 'px'
	);
	return $args;
}
function miss_tag_cloud_count( $return ) {
/*	$tags = explode('
', $return);
	$store = '';
	foreach ( $tags as $tag ) {
		$store .= '<span>' . $tag . '</span>';
	}
*/
	return $return . '<div class="clearboth"></div>';
}

add_filter( 'wp_tag_cloud', 'miss_tag_cloud_count' );
add_filter( 'widget_tag_cloud_args', 'miss_tag_cloud_args' );
?>