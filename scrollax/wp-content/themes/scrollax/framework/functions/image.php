<?php 

if (!function_exists("miss_render_image_container")) :
/**
 * Render Image Container
 * @since 1.5
 */
function miss_render_image_container ($args) {
	extract($args);
	$out = '<img';
	if ( $src && !empty($src) ) {
		$out .= ' src="' . $src . '"';
	}
	if ( $alt && !empty($alt) ) {
		$out .= ' alt="' . $alt . '"';
	}
	if ( $title && !empty($title) ) {
		$out .= ' title="' . $title . '"';
	}
	if ( $class && !empty($class) ) {
		$out .= ' class="' . $class . '"';
	}
	$out .= ' />';
	return $out;
}
endif;

if (!function_exists("miss_render_link_container")) :
/**
 * Render Link Container
 * @since 1.5
 */
function miss_render_link_container ($args = Array(), $content = false) {
	$out = '<a';
	if ( $args['href'] && !empty($args['href']) ) {
		$out .= ' href="' . $args['href'] . '"';
	}
	if ( $args['title'] && !empty($args['title']) ) {
		$out .= ' title="' . $args['title'] . '"';
	}
	if ( $args['class'] && !empty($args['class']) ) {
		$out .= ' class="' . $args['class'] . '"';
	}
	$out .= '>';
	if ( $content && !empty($content) ) {
		$out .= $content;
	}
	$out .= '</a>';
	return $out;
}
endif;

if (!function_exists("miss_image_signature")) :

/**
 * Returning Image Information Array
 * @since 1.5
 */
function miss_image_signature ($thumb) {
	if( get_post_meta( get_the_ID(), 'app_lightbox', true ) == "yes" &&  get_post_meta( get_the_ID(), 'app_embed', true ) != "") {
		$link = Array(
			'href' => get_post_meta( get_the_ID(), 'app_embed', true ),
			'title' => get_the_title(),
			'class' => "prettyPhoto"
		);
		$img = Array(
			'src' => $thumb,
			'alt' => sprintf (__( "%1$s on Youtube", MISS_TEXTDOMAIN ), get_the_title() ),
			'title' => sprintf (__( "Watch %1$s on Youtube", MISS_TEXTDOMAIN ), get_the_title() ),
			'class' => "image-resize w loadOnVisible",
		);
	} else if ( get_post_meta( get_the_ID(), '_image', true ) ) {
		$link = Array(
			'href' => get_post_meta( get_the_ID(), '_image', true ),
			'title' => get_the_title(),
			'class' => "prettyPhoto"
		);
		$img = Array(
			'src' => $thumb,
			'alt' => sprintf(__( 'Open Image %1$s', MISS_TEXTDOMAIN ), get_the_title() ),
			'title' => sprintf(__( 'Show %1$s', MISS_TEXTDOMAIN ), get_the_title() ),
			'class' => "image-resize w loadOnVisible",
		);
	} else if ( get_post_meta( get_the_ID(), 'app_lightbox', true ) == "no" &&  get_post_meta( get_the_ID(), 'app_embed', true ) == "") {
		$link = Array(
			'href' => get_permalink(),
			'title' => get_the_title(),
			'class' => "pic"
		);
		$img = Array(
			'src' => $thumb,
			'alt' => sprintf(__( 'Find Out More About %1$s', MISS_TEXTDOMAIN ), get_the_title() ),
			'title' => sprintf(__( 'Find Out More', MISS_TEXTDOMAIN ), get_the_title() ),
			'class' => "image-resize w loadOnVisible",
		);
	} else if ( get_post_meta( get_the_ID(), 'app_lightbox', true ) == "no" &&  get_post_meta( get_the_ID(), 'app_embed', true ) != "") {
		$link = Array(
			'href' => get_permalink(),
			'title' => get_the_title(),
			'class' => "video"
		);
		$img = Array(
			'src' => $thumb,
			'alt' => sprintf(__( 'Find Out More About %1$s', MISS_TEXTDOMAIN ), get_the_title() ),
			'title' => sprintf(__( 'Find Out More', MISS_TEXTDOMAIN ), get_the_title() ),
			'class' => "image-resize w loadOnVisible",
		);
	} else {
		$link = Array(
			'href' => get_permalink(),
			'title' => get_the_title(),
			'class' => "pic"
		);
		$img = Array(
			'src' => $thumb,
			'alt' => sprintf(__( 'Find Out More About %1$s', MISS_TEXTDOMAIN ), get_the_title() ),
			'title' => sprintf(__( 'Find Out More', MISS_TEXTDOMAIN ), get_the_title() ),
			'class' => "image-resize w loadOnVisible",
		);
	}
	return Array( 'link' => $link, 'img' => $img );
}
endif;

/**
 * Theme Thumbnail
 * @since 1.5
 */

if ( function_exists( 'add_image_size' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 258, '' );
}
/**
 * Registering Default Image Size
 * @since 1.5
 */

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'large', '2048', '', true );
	add_image_size( 'medium', '520', '', true );
}
?>
