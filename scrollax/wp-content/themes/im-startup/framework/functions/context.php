<?php
/**
 *
 */
function miss_get_context() {
	global $wp_query, $post, $irish_framework_params;
	$blog_page = miss_blog_page();

	# If $irish_framework_params->context has been set, don't run through the conditionals again. Just return the variable.
	if ( !empty( $irish_framework_params->context ) )
		if ( is_array( $irish_framework_params->context ) )
			return $irish_framework_params->context;

	$irish_framework_params->context = array();

	# Front page of the site.
	if ( is_front_page() )
		$irish_framework_params->context[] = 'home';

	# Blog page.
	if ( is_home() )
		$irish_framework_params->context[] = 'blog';
		
	# Mysite blog.
	if( !empty( $post->ID ) && $blog_page == $post->ID )
		$irish_framework_params->context[] = 'blog';

	# Singular views.
	elseif ( is_singular() ) {
		$irish_framework_params->context[] = 'singular';
		if (isset($wp_query->post->post_type)) {
			$irish_framework_params->context[] = "singular-{$wp_query->post->post_type}";
		}
		if (isset($wp_query->post->ID)) {
			$irish_framework_params->context[] = "singular-{$wp_query->post->post_type}-{$wp_query->post->ID}";
		}
	}

	# Archive views.
	elseif ( is_archive() ) {
		$irish_framework_params->context[] = 'archive';

		# Taxonomy archives.
		if ( is_tax() || is_category() || is_tag() ) {
			$term = $wp_query->get_queried_object();
			$irish_framework_params->context[] = 'taxonomy';
			$irish_framework_params->context[] = $term->taxonomy;
			$irish_framework_params->context[] = "{$term->taxonomy}-" . sanitize_html_class( $term->slug, $term->term_id );
		}

		# User/author archives.
		elseif ( is_author() ) {
			$irish_framework_params->context[] = 'user';
			$irish_framework_params->context[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', get_query_var( 'author' ) ), $wp_query->get_queried_object_id() );
		}

		# Time/Date archives.
		else {
			if ( is_date() ) {
				$irish_framework_params->context[] = 'date';
				if ( is_year() )
					$irish_framework_params->context[] = 'year';
				if ( is_month() )
					$irish_framework_params->context[] = 'month';
				if ( get_query_var( 'w' ) )
					$irish_framework_params->context[] = 'week';
				if ( is_day() )
					$irish_framework_params->context[] = 'day';
			}
			if ( is_time() ) {
				$irish_framework_params->context[] = 'time';
				if ( get_query_var( 'hour' ) )
					$irish_framework_params->context[] = 'hour';
				if ( get_query_var( 'minute' ) )
					$irish_framework_params->context[] = 'minute';
			}
		}
	}


	# Search results.
	elseif ( is_search() )
		$irish_framework_params->context[] = 'search';

	# Error 404 pages.
	elseif ( is_404() )
		$irish_framework_params->context[] = 'error-404';

	return $irish_framework_params->context;
}


if ( !function_exists( 'miss_body_class' ) ) :
/**
 *
 */
function miss_body_class( $class = array() ) {
	global $wp_query, $post;

	$classes = array();

	# CSS3 Transform Overlay.
	$classes[] = 'im-transform';

	# Has breadcrumbs
	if( ( !miss_get_setting( 'disable_breadcrumbs' ) ) && ( !is_front_page() ) && ( !empty( $post->ID ) && !get_post_meta( $post->ID, '_disable_breadcrumbs', true ) ) )
		$classes[] = 'has_breadcrumbs';

	# Has preloader
	if( ( miss_get_setting( 'jpreloader' ) ) )
		$classes[] = 'has_jpreloader';

	# Without Title
	if( isset($post->ID) && ( get_post_meta( $post->ID, '_disable_page_title', true ) ) )
		$classes[] = 'without_page_title';

	if( isset($post->ID) && ( get_post_meta( $post->ID, '_disable_page_title_margin', true ) ) )
		$classes[] = 'caption_nomargin';

	# Search sidebar
	if( is_search() ) 
		$classes[] = 'right_sidebar';

	# Archive sidebar
	if ( is_archive() )
		$classes[] = 'right_sidebar';

	#Boxed
	if ( miss_get_setting( 'layout_type' ) == "boxed" ) {
		$classes[] = 'boxed_layout';
	} else {
		$classes[] = 'flexible_layout';
	}

	#Rounded borders
	if( miss_get_setting( 'enable_border_radius' ) ) {
		$classes[] = 'has_soft_borders';
	}

	# Slider
	$meta_slider = ( isset($post->ID) ) ? get_post_meta( $post->ID, 'slider_type', true ) : '';
	
	if( is_front_page() || miss_get_setting( 'slider_page' ) || ( !empty( $meta_slider ) && $meta_slider != 'no' ) ) {
		if( !miss_get_setting( 'home_slider_disable' ) || ( !empty( $meta_slider ) && $meta_slider != 'no' ) ) {
			if ( $meta_slider != 'no' ) {
				$classes[] = 'has_slider';
				$classes[] = 'slider_nav_' . miss_get_setting( 'slider_nav' );
			}
		}
	}

	# Header extras
	$sociable = miss_get_setting( 'sociable' );
	$header_text = miss_get_setting( 'extra_header' );

	if( $sociable['keys'] != '#' )
		$classes[] = 'has_header_social';

	if( !empty( $header_text ) )
		$classes[] = 'has_header_text';

	if( has_nav_menu( 'header-links' ) )
		$classes[] = 'has_header_links';

	# Homepage
	if( is_front_page() ) {
		$classes[] = 'is_home';

		$classes[] = ( miss_get_setting( 'homepage_layout' ) )
		? miss_get_setting( 'homepage_layout' ): 'full_width';
	}

	# Is singluar post
	if( is_singular() ) {
		$type = get_post_type();
		$template = get_post_meta( $post->ID, '_wp_page_template', true );
		$_layout = get_post_meta( $post->ID, '_layout', true );
		
		if( $type == 'portfolio' )
			$classes[] = 'portfolio_single';
		
		if( $template == 'templates/template-sitemap.php' )
			$classes[] = 'sitemap';

		if( $template == 'templates/template-wiki.php' )
			$classes[] = 'full_width';

		elseif( !empty( $_layout ) )
			$classes[] = $_layout;

		elseif( strpos( $post->post_content, '[portfolio' ) !== false )
			$classes[] = 'full_width';

		elseif( $type == 'portfolio' )
			$classes[] = 'full_width';
		else
			$classes[] = 'right_sidebar';
	}

	# 404
	if( is_404() )
		$classes[] = 'full_width';
		
	# Footer
	foreach ( array( 'footer1', 'footer2', 'footer3', 'footer4', 'footer5', 'footer6' ) as $footer ) {
		$footer_sidebar[] = ( is_active_sidebar( $footer ) ) ? 'active' : 'inactive';
	}

	if ( !in_array( 'active', $footer_sidebar ) || miss_get_setting( 'footer_disable' ) ) {
		$classes[] = 'no_footer';
	}
	
	# Merge any custom classes
	if( is_array( $class ) ) {
		$classes = array_merge( $classes, $class );
	}

	# Merge any filtered body classes
	$filter_classes = apply_atomic( 'filter_body_class', '' );

	if( is_array( $filter_classes ) ) {
		$classes = array_merge( $classes, $filter_classes );
	}

	# Join all the classes into one string
	$class = join( ' ', $classes );

	# Print the body class
	echo apply_atomic( 'body_class', $class );
}
endif;
?>