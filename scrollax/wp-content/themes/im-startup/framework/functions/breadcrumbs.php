<?php
/**
 * Breadcrumbs Functions
 *
 * @since 1.0
 * @param array $args
 * @return string
 */
function miss_get_breadcrumbs( $args = '' ) {
	global $wp_query;
	
	$breadcrumb_delimiter = miss_get_setting( 'breadcrumb_delimiter' );
	$delimiter = ( !empty( $breadcrumb_delimiter ) ) ? html_entity_decode(htmlentities( $breadcrumb_delimiter )) : '&raquo';

	/* Set up the default arguments for the breadcrumb. */
	$defaults = array(
		'prefix' => '',
		'suffix' => '',
		'title' => '',
		'home' => __( 'Home', MISS_TEXTDOMAIN ),
		'sep' => $delimiter,
		'front_page' => false,
		'bold' => true,
		'show_blog' => true,
		'singular_post_taxonomy' => null,
		'echo' => false
	);

	$args = apply_filters( 'miss_breadcrumbs_args', $args );

	$args = wp_parse_args( $args, $defaults );

	if ( is_front_page() && !$args['front_page'] )
		return apply_filters( 'miss_get_breadcrumbs', false );

	/* Format the title. */
	$html = ( !empty( $args['title'] ) ? '<span class="breadcrumbs-title">' . $args['title'] . '</span>': '' );

	/* Format the separator. */
	$separator = ( !empty( $args['sep'] ) ? ' <span class="delimiter">' . $args['sep'] . '</span> ' : ' <span class="delimiter">/</span> ' );

	$show_on_front = get_option('show_on_front');

	$home = '<a href="'. home_url( '/' ) .'" rel="home" class="home_breadcrumb">' . $args['home'] . '</a>';

	if ( 'page' == $show_on_front && $args['show_blog'] )
		$bloglink = $home . $separator . '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) . '</a>';

	else
		$bloglink = $home;
	
	if ( is_front_page() ) {
		$html .= miss_breadcrumbs_bold( $home, $args['bold'] );
	
	} elseif ( is_home() ) {
		$html .= $home . $separator . miss_breadcrumbs_bold( get_the_title( get_option( 'page_for_posts' ) ), $args['bold'] );
	
	} elseif ( function_exists('is_woocommerce') && is_woocommerce() ) {
		$html .= $home . $separator . __("Store", MISS_TEXTDOMAIN);
	/* If viewing a portfolio post. */	
	} elseif( is_singular( 'portfolio' ) ) {
		$html .= $home . $separator;
		$gallery_id = miss_get_setting('portfolio_page');
		if( !empty( $gallery_id ) ) {
			$html .= '<a href="' . get_permalink( $gallery_id ) . '" title="' . esc_attr( get_the_title( $gallery_id ) ) . '">' . get_the_title( $gallery_id ) . '</a>' . $separator;
		}
		
		$html .= miss_breadcrumbs_bold( get_the_title(), $args['bold'] );
	
	/* Added to refect miss_blog_page() */

	/* If viewing a singular post. */
	} elseif( is_singular( 'miss_gallery' ) ) {
		$html .= $home . $separator;
		$gallery_id = miss_get_setting('gallery_page');
		if( !empty( $gallery_id ) ) {
			$html .= '<a href="' . get_permalink( $gallery_id ) . '" title="' . esc_attr( get_the_title( $gallery_id ) ) . '">' . get_the_title( $gallery_id ) . '</a>' . $separator;
		}
		
		$html .= miss_breadcrumbs_bold( get_the_title(), $args['bold'] );
	} elseif( is_singular( 'news' ) ) {
		$html .= $home . $separator;
		$gallery_id = miss_get_setting('news_page');
		if( !empty( $gallery_id ) ) {
			$html .= '<a href="' . get_permalink( $gallery_id ) . '" title="' . esc_attr( get_the_title( $gallery_id ) ) . '">' . get_the_title( $gallery_id ) . '</a>' . $separator;
		}
		$html .= miss_breadcrumbs_bold( get_the_title(), $args['bold'] );
	} elseif( is_archive() && get_post_type() == 'news' ) {
		$html .= $home . $separator . __( 'News', MISS_TEXTDOMAIN );
	} elseif( get_post_type() == 'forum' || get_post_type() == 'topic' || get_post_type() == 'reply' ) {
 
		$html .= bbp_get_breadcrumb( array( 'before' => '', 'after' => '', 'sep' => $separator ) );

	} elseif( is_singular( 'benefits' ) ) {
		$html .= $home . $separator;
		$gallery_id = miss_get_setting('benefits_page');
		if( !empty( $gallery_id ) ) {
			$html .= '<a href="' . get_permalink( $gallery_id ) . '" title="' . esc_attr( get_the_title( $gallery_id ) ) . '">' . get_the_title( $gallery_id ) . '</a>' . $separator;
		}
		
		$html .= miss_breadcrumbs_bold( get_the_title(), $args['bold'] );
	} elseif ( is_singular() ) {
		$post_id = (int) $wp_query->get_queried_object_id();
		if ( isset( $wp_query ) && isset( $wp_query->post ) && is_object( $wp_query->post ) ) {

			if ( 'page' === $wp_query->post->post_type || 'pricetable' === $wp_query->post->post_type )
				$html .= $home . $separator;
	
			elseif ( 'page' !== $wp_query->post->post_type ) {
				$html .= $bloglink . $separator;
	
				if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
					$terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
					$html .= miss_breadcrumbs_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"], $separator ) . $separator;
				}
	
				elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) )
					$html .= get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' ) . $separator;
			}
	
			if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents = miss_breadcrumbs_get_parents( $wp_query->post->post_parent, $separator ) )
				$html .= $parents . $separator;
		} else {
			if ( miss_is_bp() ) {
				$html .= $home . $separator;
			}
		}

		$html .= miss_breadcrumbs_bold( get_the_title(), $args['bold'] );

	}

	/* If viewing any type of archive. */
	elseif ( is_archive() ) {

		$html .= $bloglink . $separator;

		if ( is_category() || is_tag() || is_tax() ) {

			$term = $wp_query->get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );

			if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = miss_breadcrumbs_get_term_parents( $term->parent, $term->taxonomy, $separator ) )
				$html .= $parents . $separator;

			$html .= miss_breadcrumbs_bold( $term->name, $args['bold'] );
		}
		elseif ( get_post_type() == 'news' ) {
			$html .= miss_breadcrumbs_bold( __( 'News', MISS_TEXTDOMAIN ) );
		}
		elseif ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
			$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
			$html .= miss_breadcrumbs_bold( $post_type_object->labels->name, $args['bold'] );
		}

		elseif ( is_date() ) {

			if ( is_day() )
				$html .= miss_breadcrumbs_bold( __( 'Archives for ', MISS_TEXTDOMAIN ) . get_the_time( 'F j, Y' ), $args['bold'] );
			
			elseif ( is_month() )
				$html .= miss_breadcrumbs_bold( __( 'Archives for ', MISS_TEXTDOMAIN ) . single_month_title( ' ', false ), $args['bold'] );
					
			elseif ( is_year() )
				$html .= miss_breadcrumbs_bold( __( 'Archives for ', MISS_TEXTDOMAIN ) . get_the_time( 'Y' ), $args['bold'] );
		}

		elseif ( is_author() )
			$html .= miss_breadcrumbs_bold( __( 'Archives by: ', MISS_TEXTDOMAIN ) . get_the_author_meta( 'display_name', $wp_query->post->post_author ), $args['bold'] );
	}
	/* If buddypress */
	elseif ( miss_is_bp() ) {

		global $bp; // we're outside the loop!
			//print_r( $bp );
		if (isset( $bp ) && is_object( $bp ) && isset( $bp->current_component) ) {
			
		
			// Assign some variables here	
			$homeurl = get_bloginfo('url');
			$bp_page1 = $bp->members->root_slug; // bp_get_members_root_slug() // slug for the Members page. The BuddyPress default is 'members'. 
			$bp_page2 = $bp->groups->root_slug; // bp_get_groups_root_slug() // slug for the Groups page. The BuddyPress default is 'groups'.	
			$bp_page3 = $bp->activity->root_slug; // bp_get_activity_root_slug() // slug for the Activity page. The BuddyPress default is 'activity'.	
			$bp_page4 = $bp->forums->root_slug; // bp_get_forums_root_slug() // slug for the Forums page. The BuddyPress default is 'forums'.
			//$bp_page5 = $bp->achievements->root_slug; // slug for the Achievements page. The BuddyPress default is 'achievements'.

			if ( bp_is_group() ) {
				$html .= $home . $separator . __( 'Groups', MISS_TEXTDOMAIN );

				if ( is_404() ) {
					$html .= $separator . miss_breadcrumbs_bold( __( 'Not Found', MISS_TEXTDOMAIN ), $args['bold'] );
				}
				
			}


			if ( bp_is_user() && !bp_is_register_page() ) {
				$html .=  $home . " $separator " . '<a href="' . $homeurl . '/' . $bp_page1 . '/">' . ucwords($bp_page1) . '</a>' . " $separator " . '<a href="' . $bp->displayed_user->domain . '">' . ucwords($bp->displayed_user->fullname)  . '</a>' . " $divider " . ucwords($bp->current_component)  . "";		
			}

			if ( !bp_is_blog_page() && ( is_page() || is_page($bp_page1) || is_page($bp_page2) || is_page($bp_page3) || is_page($bp_page4) ) && !bp_is_user() && !bp_is_single_item() && !bp_is_register_page() ) {
				$html .=  $home . " $separator " .  get_the_title()  . "";		
			}
			
			if ( bp_is_register_page() ) {
				$html .=  $home . " $separator " .  get_the_title()  . "";	
			}

			if ( bp_is_blog_page() && is_home() && $front == "page" ) {
				$html .=  "<a href='" . $homeurl . "'>$home</a>" . " $separator " . $blog ."";
			}
			
	    	if ( get_query_var('paged') ) {
		     	if ( bp_is_blog_page() && !(is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) ) $html .= ' (Page' . ' ' . get_query_var('paged') . ')';
			}


			/* 		$html .= $home . $separator . miss_breadcrumbs_bold( __( 'Search results for "', MISS_TEXTDOMAIN ) . stripslashes( strip_tags( get_search_query() ) ) . '"', $args['bold'] ); */
		}
	}
	/* If viewing search results. */
	elseif ( is_search() ) {
		$html .= $home . $separator . miss_breadcrumbs_bold( __( 'Search results for "', MISS_TEXTDOMAIN ) . stripslashes( strip_tags( get_search_query() ) ) . '"', $args['bold'] );
	}
	/* If viewing a 404 error page. */
	elseif ( is_404() ) {
		$html .= $home . $separator . miss_breadcrumbs_bold( __( 'Page Not Found', MISS_TEXTDOMAIN ), $args['bold'] );
	}

	else {
		$html = '';
	}

	if ( class_exists('TribeEventsPro') ) {

		if ( class_exists('TribeEvents') ) {
			$tec = TribeEvents::instance();
			$events_page = '<a href="' . home_url( '/' ) . trailingslashit( $tec->getOption( 'eventsSlug', 'events' ) ) . '" title="' . __( 'Events', MISS_TEXTDOMAIN ) . '">' . __( 'Events', MISS_TEXTDOMAIN ) . '</a>';
			$html_event = $home . $separator . $events_page;
		}
		if( function_exists('tribe_is_month') && tribe_is_month() ) {
			$html = $html_event;
			$html .= $separator . __( 'Events for', MISS_TEXTDOMAIN ) . ' ' . Date("F Y", strtotime($wp_query->get('start_date') ) );
		}

		if( function_exists('tribe_is_day') && tribe_is_day() ) {
			$html = $html_event;
			$html .= $separator . __( 'Events for', MISS_TEXTDOMAIN ) . ' ' . Date("l, F jS Y", strtotime($wp_query->get('start_date') ) );
		}

		if( function_exists('tribe_is_week') && tribe_is_week() ) {
			if ( function_exists( 'tribe_get_first_week_day' ) ) {
				$html = $html_event;
				$html .= $separator . sprintf( __('Events for week of %s', MISS_TEXTDOMAIN),
						Date("l, F jS Y", strtotime(tribe_get_first_week_day($wp_query->get('start_date'))))
				);
			}
		}
		if( (function_exists('tribe_is_map') && tribe_is_map() ) || ( function_exists('tribe_is_photo') && tribe_is_photo() ) ) {
			if( tribe_is_past() ) {
				$html = $html_event;
				$html .= $separator . __( 'Past Events', MISS_TEXTDOMAIN );
			} else {
				$html = $html_event;
				$html .= $separator . __( 'Upcoming Events', MISS_TEXTDOMAIN );
			}
		}
		if( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ){
			$html = $html_event;
			$html .= $separator . sprintf( '%s %s',
				__( 'All events for', MISS_TEXTDOMAIN ),
				get_the_title()
			);
		} 

	}

	//$breadcrumbs = '<div class="breadcrumb breadcrumbs"><div class="breadcrumbs-plus">';
	$breadcrumbs = $args['prefix'];
	$breadcrumbs .= $html;
	$breadcrumbs .= $args['suffix'];
	//$breadcrumbs .= '</div></div>';

	$breadcrumbs = apply_filters( 'miss_get_breadcrumbs', $breadcrumbs );

	if ( !$args['echo'] )
		return $breadcrumbs;

	echo $breadcrumbs;
}

/**
 * Gets parent pages of any post type.
 *
 * @since 0.3
 * @param int $post_id ID of the post whose parents we want.
 * @param string $separator.
 * @return string $html String of parent page links.
 */
function miss_breadcrumbs_get_parents( $post_id = '', $separator = '/' ) {

	$html = array();

	if ( $post_id == 0 )
		return;

	while ( $post_id ) {
		$page = get_page( $post_id );
		$parents[]  = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';
		$post_id = $page->post_parent;
	}

	if ( $parents )
		$html = array_reverse( $parents );

	return join( $separator, $html );
}

/**
 * Searches for term parents of hierarchical taxonomies.
 *
 * @since 0.3
 * @param int $parent_id The ID of the first parent.
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 * @return string $html String of links to parent terms.
 */
function miss_breadcrumbs_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {

	$html = array();
	$parents = array();

	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return;

	while ( $parent_id ) {
		$parent = get_term( $parent_id, $taxonomy );
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';
		$parent_id = $parent->parent;
	}

	if ( $parents )
		$html = array_reverse( $parents );

	return join( $separator, $html );
}

/**
 * Return a Input with <strong> tag.
 *
 * @since 0.1
 * @return string
 */
function miss_breadcrumbs_bold( $input, $bold ) {
	if ( $bold )
		return '<span class="current_breadcrumb">'. $input . '</span>';

	return $input;
}
?>