<?php

/**
 * Smart Menu Walker
 *
 * @since 1.8
 */
class Megamenu_Walker_Nav_Menu extends Walker_Nav_Menu {

	function __construct() {
	}


	/**
	 * Single column menu
	 * Method: std_menu_item
	 *
	 * @since 1.8
	 */

	function std_menu_item( &$output, $args, $item, $depth ) {
		$indent = str_repeat("\t", $depth);
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names .= ( get_post_meta( $item->ID, '_miss_submenu_enable_full_width', true) ) ? ' submenu_enable_full_width': '';
		$class_names .= ' ' . $args->_miss_submenu_type;
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$link_class = ( get_post_meta( $item->ID, '_miss_disable_text', true) ) ? 'menu_item_without_text' : '';

		if ( !empty( $item->attr_title ) and !get_post_meta( $item->ID, '_miss_disable_teaser', true) ) {
			$link_class .= ' with_teaser';
			$link_before = $args->link_before . '<span class="half"><span>';
			$link_after = $args->link_after . '</span></span><small class="teaser">' . $item->attr_title . '</small>';
		} else {
			$link_before = '<span>' . $args->link_before;
			$link_after = '</span>' . $args->link_after;
		}

		if ( get_post_meta( $item->ID, '_miss_menu_item_icon', true) ) {
			$item->icon = get_post_meta( $item->ID, '_miss_menu_item_icon', true);
		} elseif ( get_post_meta( $item->object_id, '_icon', true) ) {
			$item->icon = get_post_meta( $item->object_id, '_icon', true);
		} else {
			$menu_type = ( get_post_meta( $item->ID, '_menu_item_type', true ) ) ? get_post_meta( $item->ID, '_menu_item_type', true ) : 'default';
			if ( $menu_type == "taxonomy" ) {
				$item->icon = 'fa-icon-reorder';
			} else {
				$item->icon = 'im-icon-checkmark-3';
			}
			// $item->icon = 'im-icon-checkmark-3';
		}
		$link_class .= ( get_post_meta( $item->ID, '_miss_disable_icon', true) ) ? ' disable_icon' : ' with_icon';

		$item_icon = '<i class="' . $item->icon . '"></i> ';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ( !empty( $item->url ) && get_post_meta( $item->ID, '_miss_disable_link', true) != '1' ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
		$attributes .= ! empty( $link_class ) ? ' class="' . $link_class . ' item"' : '';

		$item_output = '';
		$item_output .= $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= '<i class="fa-icon-caret-down"></i>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        //echo '<!--'.$output.'-->';
	}


	/**
     * Child pages dropdown
	 * method: pages_gallery_dropdown 
	 *
	 * @since 1.8
	 */
	function pages_gallery_dropdown( &$output, $args, $item, $depth ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names .= ( get_post_meta( $item->ID, '_miss_submenu_enable_full_width', true) ) ? ' submenu_enable_full_width': '';
		$class_names .= ' ' . $args->_miss_submenu_type;
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$link_class = ( get_post_meta( $item->ID, '_miss_disable_text', true) ) ? 'menu_item_without_text' : '';

		if ( !empty( $item->attr_title ) and !get_post_meta( $item->ID, '_miss_disable_teaser', true) ) {
			$link_class .= ' with_teaser';
			$link_before = $args->link_before . '<span class="half"><span>';
			$link_after = $args->link_after . '</span></span><small class="teaser">' . $item->attr_title . '</small>';
		} else {
			$link_before = '<span>' . $args->link_before;
			$link_after = '</span>' . $args->link_after;
		}

		if ( get_post_meta( $item->ID, '_miss_menu_item_icon', true) ) {
			$item->icon = get_post_meta( $item->ID, '_miss_menu_item_icon', true);
		} elseif ( get_post_meta( $item->object_id, '_icon', true) ) {
			$item->icon = get_post_meta( $item->object_id, '_icon', true);
		} else {
			$item->icon = 'im-icon-checkmark-3';
		}
		$link_class .= ( get_post_meta( $item->ID, '_miss_disable_icon', true) ) ? ' disable_icon' : ' with_icon';

		$columns = get_post_meta( $item->ID, '_miss_submenu_columns', true );
		$enable_full_width = get_post_meta( $item->ID, '_miss_submenu_enable_full_width', true );
		$dropdown_width = ( get_post_meta( $item->ID, '_miss_submenu_enable_full_width', true ) == true ) ? 1170 - 30 : 479 - 30; // 30 - padding 30px
		$item_width_height = floor( $dropdown_width / $columns ); 
		$details_height = floor( $dropdown_width / 3 );

		if ( get_the_post_thumbnail( $item->object_id, 'thumbnail' ) != false ) {
			global $irish_framework_params;
			$width = $irish_framework_params->layout['images']['menu_static_span6'][0];
			$height = $irish_framework_params->layout['images']['menu_static_span6'][1];
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $item->object_id ), 'large' );
			// $item_icon = '<img class="hover_fade_js image-resize w" src="' . miss_wp_image($thumb[0], $width, $height ) . '" alt="' . $item->title . '" title="' . $item->title . '" />';
			$item_icon = miss_get_post_image( $args = array( 'pid' => $post_object->ID, 'img_class' => 'hover_fade_js image-resize w', 'width' => $item_width_height, 'height' => $item_width_height, 'echo' => false, 'preview_info_wrap' => false, ) );
		} else {
			$item_icon = '<i class="' . $item->icon . '"></i> ';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ( !empty( $item->url ) && get_post_meta( $item->ID, '_miss_disable_link', true) != '1' )      ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ! empty( $link_class ) ? ' class="' . $link_class . '"' : '';

		$item_output = '';
		$item_output .= $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $item_icon;
		$item_output .= $link_before;
		$item_output .= '<span class="link_text">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';
		$item_output .= $link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$item_output .= '<div class="after_menu_details">';
		if ( get_the_post_thumbnail( $item->object_id, 'thumbnail' ) != false ) {
			$width = $irish_framework_params->layout['images']['menu_static_span12'][0];
			$height = $irish_framework_params->layout['images']['menu_static_span12'][1];
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $item->object_id ), 'large' );
			if ( miss_wp_image($thumb[0], $width, $height ) ) {
				// $item_output .= '<img src="' . miss_wp_image($thumb[0], $width, $height ) . '" alt="' . esc_attr( $item->title ) . '" title="' . $item->title . '" />';
				$item_output .= miss_get_post_image( $args = array( 'pid' => $post_object->ID, 'img_class' => 'hover_fade_js image-resize w', 'width' => $dropdown_width, 'height' => $details_height, 'echo' => false, 'preview_info_wrap' => false, ) );
			}
		}
		$item_output .= '<div class="post_icon pull-left"><i class="' . $item->icon . '"></i></div>';
		$item_output .= '<div class="post_title">';
		$item_output .= '<a rel="bookmark" href="' . esc_url( get_permalink($item->object_id) ) . '" title="' . esc_attr( get_the_title($item->object_id) ) . '">' . get_the_title($item->object_id) . '</a>';
		$item_output .= '</div>';
		$item_output .= '<div> <!-- /.after_menu_details -->';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}


	/**
	 * Create recent posts dropdown mini blog
	 * method: recent_posts_dropdown 
	 *
	 * @since 1.8
	 */
	function recent_posts_dropdown( &$output, $args ) {
		global $wpdb, $shortname, $irish_framework_params;

		// Menu type
		$menu_type = get_post_meta( $args['menu_main_parent'], '_menu_item_type', true );
		$showposts = get_post_meta( $args['menu_main_parent'], '_miss_submenu_columns', true) * 2;

		// WP Query template
		$menu_query = array(
			'showposts' => $showposts,
			'nopaging' => 0,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1
		);

		// Check if category selected
		if ( isset( $menu_type ) ) {
			$category_id = get_post_meta( $args['menu_main_parent'], '_menu_item_object_id', true );
			$category_term = get_post_meta( $args['menu_main_parent'], '_menu_item_object', true );

			if ( (isset( $category_term ) && !empty( $category_term ) ) && (isset( $category_id ) && !empty( $category_id ) && $menu_type == "taxonomy" ) ) {
				// $menu_query[$category_term] = $category_id;
				$menu_query['tax_query'] = array(
					array(
						'taxonomy' =>$category_term,
						'field' => 'id',
						'terms' => array( $category_id )
					)
				);
			}
		}

		$columns = get_post_meta( $args['menu_main_parent'], '_miss_submenu_columns', true );
		$enable_full_width = get_post_meta( $args['menu_main_parent'], '_miss_submenu_enable_full_width', true );
		$dropdown_width = ( get_post_meta( $args['menu_main_parent'], '_miss_submenu_enable_full_width', true ) == true ) ? 1170 - 30 : 479 - 30; // 30 - padding 30px
		$item_width_height = floor( $dropdown_width / $columns ); 
		$details_height = floor( $dropdown_width / 3 );

		// Get menu items
		$recent_query = get_posts( $menu_query );
		if ( count( $recent_query ) ) {
			foreach ( $recent_query as $key => $post_object ) {
				$output .= '<li class="post_preview li-menu-type-' . $menu_type . '">';
				$output .= '<a rel="bookmark" href="' . esc_url( get_permalink( $post_object->ID ) ) . '" title="' . esc_attr( $post_object->post_title ) . '">';
				if ( wp_get_attachment_image_src( get_post_thumbnail_id( $post_object->ID ), 'full' ) ) {
					$width = $irish_framework_params->layout['images']['menu_static_span6'][0];
					$height = $irish_framework_params->layout['images']['menu_static_span6'][1];
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_object->ID ), 'full' );
					$output .= miss_get_post_image( $args = array( 'pid' => $post_object->ID, 'img_class' => 'hover_fade_js image-resize w', 'width' => $item_width_height, 'height' => $item_width_height, 'echo' => false, 'preview_info_wrap' => false, ) );
				} else {
					$output .= ( get_post_meta( $post_object->ID, '_icon', true ) ) ? '<i class="' . get_post_meta( $post_object->ID, '_icon', true ) . '"></i> ' : '<i class="im-icon-quill-2"></i>';
				}
				$output .= '</a>';
				$output .= '<div class="after_menu_details">';
				if ( get_post_thumbnail_id( $post_object->ID ) != false ) {
					$width = $irish_framework_params->layout['images']['menu_static_span12'][0];
					$height = $irish_framework_params->layout['images']['menu_static_span12'][1];
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_object->ID ), 'full' );
					if ( miss_wp_image($thumb[0], $width, $height ) ) {
						$output .= miss_get_post_image( $args = array( 'pid' => $post_object->ID, 'img_class' => 'hover_fade_js image-resize w', 'width' => $dropdown_width, 'height' => $details_height, 'echo' => false, 'preview_info_wrap' => false, ) );
					}
				}
				$output .= '<div class="post_icon pull-left"><i class="' . get_post_meta( $post_object->ID, '_icon', true ) . '"></i></div>';
				$output .= '<div class="post_title">';
				$output .= '<a rel="bookmark" href="' . esc_url( get_permalink( $post_object->ID ) ) . '" title="' . esc_attr( $post_object->post_title ) . '">' . $post_object->post_title . '</a>';
				$output .= '</div>';
				$output .= '<div class="post_excerpt">';
				$output .= miss_excerpt( $post_object->post_content, apply_filters( 'miss_home_spotlight_excerpt', 60 ), apply_filters( 'miss_excerpt', THEME_ELLIPSIS ) );
				$output .= '</div>';
				$output .= '</div><!-- .after_menu_details -->';
				$output .= '</li><!-- .post_preview -->';
			} // end od foreach
		}
		$output .= '<li class="clearboth"></li><!-- .clearboth -->';
	}


	/**
	 * Custom content block
	 * Method: static_dropdown 
	 *
	 * @since 1.8
	 */
	function static_dropdown( &$output, $args ) {
			$output .= '<div class="submenu_custom_content">' . do_shortcode( get_post_meta( $args['menu_main_parent'], '_miss_submenu_custom_content', true) ) . '</div><!-- /.submenu_custom_content -->';
	}


	/**
     * Default WP start level
	 * START extended menu walker functions
	 *
	 * @since 1.8
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$submenu_classes = '';
		$submenu_classes .= ( get_post_meta( $args->menu_item_id, '_miss_submenu_disable_left_floating', true) ) ? ' floafright': ' floafleft';
		$submenu_classes .= ( get_post_meta( $args->menu_item_id, '_miss_submenu_disable_icons', true) ) ? ' submenu_disable_icons': '';
		$submenu_classes .= ( get_post_meta( $args->menu_item_id, '_miss_submenu_type', true) ) ? ' ' . get_post_meta( $args->menu_item_id, '_miss_submenu_type', true): ' std_dropdown';
		$submenu_classes .= ( get_post_meta( $args->menu_item_id, '_miss_submenu_columns', true) ) ? ' columns' . get_post_meta( $args->menu_item_id, '_miss_submenu_columns', true): ' columns2';
		$output .= "\n" . $indent . '<div class="dropdown-menu' . $submenu_classes . '">' . "\n";
	}


	/**
     * Default WP end level
	 * START extended menu walker functions
	 *
	 * @since 1.8
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
			$_miss_submenu_type = ( get_post_meta( $args->menu_main_parent, '_miss_submenu_type', true) ) ? get_post_meta( $args->menu_main_parent, '_miss_submenu_type', true) : 'std_dropdown';
			if ( $_miss_submenu_type == 'recent_posts_dropdown' ) {
				$args_submenu_type = array( 'menu_item_id' => $args->menu_item_id, 'menu_main_parent' => $args->menu_main_parent );
				call_user_func_array ( array( $this, 'recent_posts_dropdown' ), array( &$output, $args_submenu_type ) );
			}
			if ( $_miss_submenu_type != 'std_dropdown' and $_miss_submenu_type != 'multicolumn_dropdown' ) {
				$output .= '<div class="submenu_custom_content">' . do_shortcode( get_post_meta( $args->menu_main_parent, '_miss_submenu_custom_content', true) ) . '</div><!-- /.submenu_custom_content -->';
			} elseif ( $_miss_submenu_type == 'multicolumn_dropdown' && $args->menu_main_parent == $args->menu_item_parent && $depth == 0 ) {
				$output .= '<div class="submenu_custom_content">' . do_shortcode( get_post_meta( $args->menu_main_parent, '_miss_submenu_custom_content', true) ) . '</div><!-- /.submenu_custom_content -->';
			}
		$output .= '<li class="clearboth"></li>';
		$output .= "\n$indent</div>";
	}


	/**
     * Default WP start element
	 * START extended menu walker functions
	 *
	 * @since 1.8
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$args->_miss_submenu_type = ( get_post_meta( $item->menu_item_parent, '_miss_submenu_type', true) ) ? get_post_meta( $item->menu_item_parent, '_miss_submenu_type', true) : 'std_dropdown';

		// $args->menu_item_id = $item->ID;
		// $args->menu_item_parent = $item->menu_item_parent;
		// if ( $item->menu_item_parent == 0 ) {
		// 	$args->menu_main_parent = $item->ID;
		// } 

		$args->columns = ( get_post_meta( $args->menu_item_parent, '_miss_submenu_columns', true) ) ? get_post_meta( $args->menu_item_parent, '_miss_submenu_columns', true) : '2';
		if ( $args->_miss_submenu_type == 'pages_gallery_dropdown' ) {
			call_user_func_array ( array( $this, 'pages_gallery_dropdown' ), array( &$output, $args, $item, $depth ) );
		} else {
			call_user_func_array ( array( $this, 'std_menu_item' ), array( &$output, $args, $item, $depth ) );
		}
	}


	/**
     * Default WP element container
	 * START extended menu walker functions
	 *
	 * @since 1.8
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element and !isset( $args[0]->menu_main_parent ) )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) ) {
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		}

		$args[0]->menu_item_id = $element->ID;
		$args[0]->menu_item_parent = $element->menu_item_parent;
		if ( $element->menu_item_parent == 0 ) {
			$args[0]->menu_main_parent = $element->ID;
		} 

		$_miss_submenu_type = ( get_post_meta( $args[0]->menu_main_parent, '_miss_submenu_type', true) ) ? get_post_meta( $args[0]->menu_main_parent, '_miss_submenu_type', true) : 'std_dropdown';

		if ( ( $_miss_submenu_type != 'recent_posts_dropdown' and $_miss_submenu_type != 'static_dropdown' ) || $element->ID == $args[0]->menu_main_parent ) {
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			call_user_func_array(array($this, 'start_el'), $cb_args);

			$id = $element->$id_field;

			// descend only when the depth is right and there are childrens for this element
			if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

				foreach( $children_elements[ $id ] as $child ) {

					if ( !isset($newlevel) ) {
						$newlevel = true;
						//start the child delimiter
						$cb_args = array_merge( array(&$output, $depth), $args);
						call_user_func_array(array($this, 'start_lvl'), $cb_args);
					}
					$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
				} // end of foreach

				unset( $children_elements[ $id ] );

			} elseif ( $_miss_submenu_type == 'recent_posts_dropdown' || $_miss_submenu_type == 'static_dropdown' || get_post_meta( $args[0]->menu_main_parent, '_miss_submenu_custom_content', true) ) {
				$cb_args = array_merge( array(&$output, $depth), $args);
				call_user_func_array(array($this, 'start_lvl'), $cb_args);
				call_user_func_array(array($this, 'end_lvl'), $cb_args);
			}

			if ( isset($newlevel) && $newlevel ){
				//end the child delimiter
				$cb_args = array_merge( array(&$output, $depth), $args);
				call_user_func_array(array($this, 'end_lvl'), $cb_args);
			}
		} 

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);
	}
}


/**
 * Basic Bootstrap Menu Walker
 *
 * @since 1.5
 */
class Bootstrapwp_Walker_Nav_Menu extends Walker_Nav_Menu {

	function __construct() {
	}

	/**
     * Default WP start level
	 * START extended menu walker functions
	 *
	 * @since 1.8
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n" . $indent . '<ul class="dropdown-menu">' . "\n";
	}
}


/**
 *
 */
class missDescriptionWalker extends Walker_Nav_Menu {

	/**
     * Default WP start element
	 * START extended menu walker functions
	 *
	 * @since 1.5
	 */
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		/* Incompatible with Walker_Nav_Menu: function start_el(&$output, $item, $depth, $args) */
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$prepend = '<span>';
		$append = '</span>';

		$description  = ! empty( $item->description ) ? '<small>'.esc_attr( $item->description ).'</small>' : '';

		if($depth != 0)
		{
			$description = $append = $prepend = "";
		}

		 $item_output = $args->before;
		 $item_output .= '<a'. $attributes .'>';
		 $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		 $item_output .= $description.$args->link_after;
		 $item_output .= '</a>';
		 $item_output .= $args->after;

		 $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}


	/**
     * Default WP display element
	 * START extended menu walker functions
	 *
	 * @since 1.5
	 */

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
		$id_field = $this->db_fields['id'];
		if (!empty($children_elements[$element->$id_field])) { 
			$element->classes[] = 'menu_arrow'; //enter any classname you like here!
		}
		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

}

?>
