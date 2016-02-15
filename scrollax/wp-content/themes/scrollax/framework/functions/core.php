<?php
/**
 * Deny hack attempt
 */
if ( !defined( 'ABSPATH' ) ) {
	header('HTTP/1.1 403 Forbidden');
	exit;
}


/**
 * Custom Module Loader
 * 
 * @since 1.7
 */
function modules_file_loader( $modules = Array( 'init' ) ){
	foreach ( $modules as $module ) {
		if (file_exists( __DIR__ . '/' . $module . '.php') ) {
			include_once( $module . '.php' );
		}
	}
}

if ( !function_exists('miss_options_toolbar') ):
/**
 *
 */
 
function miss_options_toolbar( $el ) {
    if ( is_admin_bar_showing() ) {
        global $wp_admin_bar, $wpdb;
        $el->add_menu( array(
        'id'    => 'my-item',
        'title' => 'Theme Options',
        'href'  =>  home_url() . '/wp-admin/themes.php?page=miss-options',
        'meta'  => array(
            'title' => __('Theme Options', MISS_TEXTDOMAIN),            
        )
       ) );
    }
}
endif;
 
/**
 *
 */
function miss_get_setting( $option = '' ) {
	$settings = '';

	if ( !$option )
		return false;

	$settings = get_option( MISS_SETTINGS );
	
	if( !empty( $settings[$option] ) )
		return $settings[$option];
		
	return false;
}

/**
 * 
 */
function miss_shortcodes() {
	$shortcodes = array();
	if ( is_dir( THEME_SHORTCODES ) ) {
		if ( $dh = opendir( THEME_SHORTCODES ) ) {
			while ( false !== ( $file = readdir( $dh ) ) ) {
				if( $file != '.' && $file != '..' && stristr( $file, '.php' ) !== false )
					$shortcodes[] = $file;
			}
			
			closedir( $dh );
		}
	}
	
	asort( $shortcodes );
	
	return $shortcodes;
}

/**
 * Disable Automatic Formatting on Posts
 *
 * @param string $content
 * @return string
 * function has been removed by themeforest restrictions
 */

/**
 *
 */
function miss_texturize_shortcode_before($content) {
	$content = preg_replace('/\]\[/im', "]\n[", $content);
	return $content;
}

/**
 *
 */
function miss_twitter_feed_cahce( $age, $url ) {
	if( strstr( $url, 'twitter.com/statuses/user_timeline' ) )
		$age = 900;
	
	return $age;
}

/**
 *
 */
function miss_twitter_feed_cahce_error() {
	return 86400;
}

/*
 * Return content group
 */
function miss_content_group($content) {
	return $content;
}


/**
 *
 */
function miss_stripslashes() {
	if ( function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc() ) {
		if( !empty( $_POST ) )
			$_POST = array_map( 'stripslashes_deep', $_POST );
		
		if( !empty( $_GET ) )
			$_GET = array_map( 'stripslashes_deep', $_GET );
		
		if( !empty( $_COOKIE ) )
			$_COOKIE = array_map( 'stripslashes_deep', $_COOKIE );
		
		if( !empty( $_REQUEST ) )
			$_REQUEST = array_map( 'stripslashes_deep', $_REQUEST );
	}
}

/**
 *
 */
function miss_strlen( $str ) {
	return strlen( $str ) > 1;
}

/**
 *
 */
function miss_mbstrlen( $str ) {
	return mb_strlen( $str,  get_option( 'blog_charset' ) ) > 1;
}


if ( !function_exists('miss_ie') ):
/**
 *
 */
function miss_ie() {
	if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
		return true;
	} else {
		return false;
	}
}

endif;


if ( !function_exists( 'miss_is_template' ) ) :
/**
 * Returns true on active page template
 * @since 1.5
 */
function miss_is_template($template = false) {
	return is_page_template($template);
}
endif;


/**
 *
 */
function miss_ajax_request() {
	if( ( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ) && ( strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) )
		return true;
		
	return false;
}

/**
 * Check if file is write-able
 * 
 * @param string $path
 * @return boolean
 */
function miss_is_writable( $file ) {
    $exists = file_exists( $file );
    
    $fp = @fopen( $file, 'a' );
    
    if ( $fp ) {
        fclose( $fp );
        
        if ( !$exists ) {
            @unlink( $file );
        }
        
        return true;
    }
    
    return false;
}
/*
 * Alternative UnSerialize
 */
function miss_unserialize ($value) {
	if (is_null($value))    {  return "N";  }
        elseif (is_bool($value))    {  return $value ? "b:0":"b:1";  }
        elseif (is_integer($value))    {  return "i:".$value;  }
        else    {  return "s:".strlen($value).":\"".$value."\"";  }
}
/*
 * Alternative Serialize
 */
function miss_serialize ($array) {
	$n = count($array);
        $result = "a:".$n.":{";
        $i = 1;
        foreach ($array as $key => $value)    {
            $result .= ser_value($key).";";
            $result .= (is_array($value)) ? serialize_data($value) : ser_value($value).";";
            }
        $result .= "}";

        return $result;
}


/**
 * Implement correct json decoder (miss_json_decode)
 * Function removed in core 1.5
 */

/**
 * Check if dir is write-able
 * 
 * @param string $dir
 * @return boolean
 */
function miss_is_writable_dir( $dir ) {
    $file = $dir . '/' . uniqid( mt_rand() ) . '.tmp';
    
    return miss_is_writable( $file );
}

/**
 *
 */
function miss_is_cache_writable() {
	
	# check if cache folder exists, if not try to create it
	if ( !@is_dir( THEME_CACHE ) ) {
		if ( !wp_mkdir_p( THEME_CACHE ) )
			return false;
	}
	
	# check if cache folder is writable, if not try to chmod
	if( !miss_is_writable_dir( THEME_CACHE ) ) {
		if( !@chmod( THEME_CACHE, 0777) )
			return false;
	}
	
	return true;
}

/**
 *
 */
function miss_is_styles_writable() {
	
	if( is_multisite() ) {
		global $blog_id;
		$wpmu_styles_path = $_SERVER['DOCUMENT_ROOT'] . '/' . get_blog_option( $blog_id, 'upload_path' ) . '/styles';

		# check if styles folder exists, if not try to create it
		if ( !@is_dir( $wpmu_styles_path ) ) {
			if ( !wp_mkdir_p( $wpmu_styles_path ) )
				return false;
		}

		# check if styles folder is writable, if not try to chmod
		if( !miss_is_writable_dir( $wpmu_styles_path ) ) {
			if( !@chmod( $wpmu_styles_path, 0777) )
				return false;
		}
		
		return true;
		
	} else {
		
		# check if styles folder exists, if not try to create it
		if ( !@is_dir( THEME_STYLES_DIR ) ) {
			if ( !wp_mkdir_p( THEME_STYLES_DIR ) )
				return false;
		}

		# check if styles folder is writable, if not try to chmod
		if( !miss_is_writable_dir( THEME_STYLES_DIR ) ) {
			if( !@chmod( THEME_STYLES_DIR, 0777) )
				return false;
		}

		return true;
	}
}

/**
 *
 */
function miss_is_wpmu_styles_writable() {
	
	if( !is_multisite() ) return false;
	
	global $blog_id;
	$wpmu_styles_path = $_SERVER['DOCUMENT_ROOT'] . get_blog_option( $blog_id, 'upload_path' ) . '/styles';
	
	# check if styles folder exists, if not try to create it
	if ( !@is_dir( $wpmu_styles_path ) ) {
		if ( !wp_mkdir_p( $wpmu_styles_path ) )
			return false;
	}
	
	# check if styles folder is writable, if not try to chmod
	if( !miss_is_writable_dir( $wpmu_styles_path ) ) {
		if( !@chmod( $wpmu_styles_path, 0777) )
			return false;
	}
	
	return true;
}

/**
 *
 */
function miss_is_sprite_writable() {
	
	# check if sprite folder exists, if not try to create it
	if ( !@is_dir( THEME_SPRITES_DIR ) ) {
		if ( !wp_mkdir_p( THEME_SPRITES_DIR ) )
			return false;
	}
	
	# check if styles folder is writable, if not try to chmod
	if( !miss_is_writable_dir( THEME_SPRITES_DIR ) ) {
		if( !@chmod( THEME_SPRITE, 0777) )
			return false;
	}
	
	return true;
}
/**
 *
 */
function miss_nospam( $email, $filterLevel = 'normal' ) {
	$email = strrev( $email );
	$email = preg_replace( '[@]', '//', $email );
	$email = preg_replace( '[\.]', '/', $email );

	if( $filterLevel == 'low' ) 	{
		$email = strrev( $email );
	}
	
	return $email;
}

/**
 *
 */
function miss_auto_width( $args ) {
	global $wp_query, $irish_framework_params;
	
	extract( $args );
	
	if( is_front_page() ) {
		$homepage_layout = miss_get_setting( 'homepage_layout' );
		$img_type = ( $homepage_layout == 'right_sidebar' ? 'big_sidebar_images' : ( $homepage_layout == 'full_width' ? 'images' : 'small_sidebar_images' ) );
		$img_size = ( $width == 'span6' ? 'blog_layout3' : ( $width == 'span4' ? 'blog_layout4'
		: ( $width == 'span3' ? 'blog_layout5' : 'blog_layout1' ) ) );
		
		$new_width = $irish_framework_params->layout[$img_type][$img_size][0];
		
		if( $img_size == 'blog_layout1' && $get_width > $new_width )
			return $new_width;
			
		elseif( $img_size == 'blog_layout1' && $get_width < $new_width )
			return $width;
			
		else
			return $new_width;
	}
	
	
	$post_obj = $wp_query->get_queried_object();
	if( !empty( $post_obj ) ) {
		$_layout = get_post_meta( $post_obj->ID, '_layout', true );
		$template = get_post_meta( $post_obj->ID, '_wp_page_template', true );

		$img_type = ( $template == 'templates/template-wiki.php' ? 'small_sidebar_images' : ( $_layout == 'right_sidebar' ? 'big_sidebar_images'
		: ( $_layout == 'full_width' ? 'images' : 'small_sidebar_images' ) ) );
		
		$img_size = ( $width == 'span6' ? 'blog_layout3' : ( $width == 'span4' ? 'blog_layout4'
		: ( $width == 'span3' ? 'blog_layout5' : 'blog_layout1' ) ) );
		
		$new_width = $irish_framework_params->layout[$img_type][$img_size][0];
		
		if( $img_size == 'blog_layout1' && $get_width > $new_width )
			return $new_width;
			
		elseif( $img_size == 'blog_layout1' && $get_width < $new_width )
			return $width;
			
		else
			return $new_width;
	}
	
	return $width;
}

/**
 *
 */

function miss_encode( $content, $serialize = false ) {
	
	if( $serialize )
		$encode = rtrim(strtr(base64_encode(gzdeflate(htmlspecialchars(serialize( $content )), 9)), '+/', '-_'), '=');
	else
		$encode = rtrim(strtr(base64_encode(gzdeflate(htmlspecialchars( $content ), 9)), '+/', '-_'), '=');
		
	
	return $encode;
}

/**
 *
 */

function miss_decode( $content, $unserialize = false ) {
	$decode = @gzinflate(base64_decode(strtr( $content, '-_', '+/')));
	
	if( !$unserialize )
		$decode = htmlspecialchars_decode( $decode );
	else
		$decode = unserialize(htmlspecialchars_decode( $decode ) );
	
	return $decode;
}

/**
 *
 */
function miss_video( $args = array() ) {
	
	extract( $args );
	
	# Vimeo video
	if( preg_match_all( '#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i', $url, $matches ) ) {
		if( !empty( $parse ) )
			return do_shortcode( '[vimeo url="' . $url . '" title="0" fs="0" portrait="0" height="' . $height . '" width="' . $width . '"]' );
		else
			return 'vimeo';
		
	} elseif( preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(.*?)#i', $url, $matches ) ) {
		if( !empty( $parse ) )
			return do_shortcode( '[youtube url="' . $url . '" controls="' . ( empty( $video_controls ) ? 0 : 1 ) . '" showinfo="0" fs="1" height="' . $height . '" width="' . $width . '"]' );
		else
			return 'youtube';
			
	} else {
		return false;
	}
}

/**
 *
 */
function miss_blog_page() {
	$blog_page = miss_get_setting( 'blog_page' );
	return apply_filters( 'miss_blog_page', $blog_page );
}

/**
 *
 */
function my_post_limit($limit) { 
	global $paged, $irish_framework_params;
	if (empty($paged)) {
			$paged = 1;
	}
	$postperpage = intval($irish_framework_params->posts_per_page);
	$pgstrt = ((intval($paged) -1) * $postperpage)+$irish_framework_params->offset . ', ';
	$limit = 'LIMIT '.$pgstrt.$postperpage;
	return $limit;
}

/**
 *
 */
function miss_get_page_query() {
	global $irish_framework_params, $paged;
	
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		
	return $paged;
}

/**
 *
 */
function miss_excerpt( $text, $length = 100, $ellipsis = '...' ) {
	$text = ( $text == '' ) ? get_the_content('') : $text;
	$text = preg_replace( '`\[(.*)]*\]`','',$text );
	if ( strlen ( $text ) > $length ) {
		$text = strip_tags( $text  );
		$text = substr( $text, 0, $length );
		$text = substr( $text, 0, strripos($text, " " ) );
		$text = $text.$ellipsis;
	}
	return $text;
}

/**
 *
 */
function miss_exclude_category_string( $minus = true ) {
	$exclude_categories = miss_get_setting( 'exclude_categories' );
	
	if( is_array( $exclude_categories ) ) {
		foreach ( $exclude_categories as $key => $value ) {
			if( $minus )
				$exclude_cats[$key] = -$value;
			else
				$exclude_cats[$key] = $value;
		}
		
		$exclude_cats = join( ',', $exclude_cats );
			
		return $exclude_cats;
	}
	
	return false;
}

/**
 *
 */
function miss_exclude_category_array( $minus = true ) {
	$exclude_categories = miss_get_setting( 'exclude_categories' );
	if( is_array( $exclude_categories ) ) {
		foreach ( $exclude_categories as $key => $value ) {
			if( $minus ) {
				$exclude_cats[$key] = -$value;
			} else {
				$exclude_cats[$key] = $value;
			}
		}
		return $exclude_cats;
	}
	return false;
}

/**
 *
 */
function miss_exclude_category_feed() {
	$exclude_categories = miss_exclude_category_string();
	
	if( !empty( $exclude_categories ) ) {
		if ( is_feed() )
			set_query_var( 'cat', $exclude_categories );
	}
}

/**
 *
 */
function miss_exclude_category_widget( $cat_args ) {
	$exclude_categories = miss_get_setting( 'exclude_categories' );

	if( is_array( $exclude_categories ) )
		$cat_args['exclude'] = join( ',', $exclude_categories );

 	return $cat_args;
}

/**
 *
 */
function miss_portfolio_comment_url( $nav = false ) {
	global $wpdb, $post, $wp_rewrite;
	
	if( !is_singular( 'portfolio' ) ) return;
	
	$gallery_name = get_query_var( 'gallery' );
	$gallery_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '" . $gallery_name . "'" );
	$get_post = get_post( $gallery_id );
	
	$paginate = ( $nav ) ? 'comment-page-%#%/' : '';

	if( $wp_rewrite->using_permalinks() )
		$redirect_to = home_url() . '/portfolio/' . $post->post_name. '/gallery/' . $get_post->post_name . '/' . $paginate;
		
	elseif( $nav )
		$redirect_to = add_query_arg( 'cpage', '%#%' );
	
	else
		$redirect_to = htmlspecialchars( add_query_arg( array( 'gallery' => $get_post->post_name ), get_permalink( $post->ID )) );
		
	if( $nav && $wp_rewrite->using_permalinks() )
		return array( 'base' => $redirect_to );
		
	elseif( $nav )
		return array();
		
	else
		return $redirect_to;
}

/*
 *
 */
function miss_multi_tax_terms($where) {
    global $wp_query;
    global $wpdb;
    if (isset($wp_query->query_vars['term']) && (strpos($wp_query->query_vars['term'], ',') !== false && strpos($where, "AND 0") !== false) ) {
        # it's failing because taxonomies can't handle multiple terms
        # first, get the terms
        $term_arr = explode(",", $wp_query->query_vars['term']);
        foreach($term_arr as $term_item) {
            $terms[] = get_terms($wp_query->query_vars['taxonomy'], array('slug' => $term_item));
        }

        # next, get the id of posts with that term in that tax
        foreach ( $terms as $term ) {
            $term_ids[] = $term[0]->term_id;
        }
        $post_ids = get_objects_in_term($term_ids, $wp_query->query_vars['taxonomy']);

        if ( !is_wp_error($post_ids) && count($post_ids) ) {
            # build the new query
            $new_where = " AND $wpdb->posts.ID IN (" . implode(', ', $post_ids) . ") ";
            # re-add any other query vars via concatenation on the $new_where string below here

            # now, sub out the bad where with the good
            $where = str_replace("AND 0", $new_where, $where);
        } else {
            # give up
        }
    }

    return $where;
}

/**
 * Theme Menu
 *
 * @package MissFramework
 * @since 1.7
 */

if ( !function_exists( 'miss_menus' ) ) :
/**
 *
 */
function miss_menus() {
	register_nav_menu( 'top-menu', __( 'Extra Top Menu', MISS_ADMIN_TEXTDOMAIN ) );
	register_nav_menu( 'primary-menu', __( 'Primary Menu', MISS_ADMIN_TEXTDOMAIN ) );
	register_nav_menu( 'footer-links', __( 'Footer Menu', MISS_ADMIN_TEXTDOMAIN ) );

}
endif;

/**
 *
 */
function miss_page_menu_args( $args ) {
	$args['show_home'] = true;
	$args['link_before'] = '<span>';
	$args['link_after'] = '</span>';
	return $args;
}


/**
 *
 */
function miss_n_round($num, $tonearest) {
   return floor($num/$tonearest)*$tonearest;
}


/* Custom Login Logo */
function miss_custom_login_logo() {
	if (miss_get_setting("login_logo_url")) {
		$out = '<style type="text/css">#login h1 a { background:url('.miss_get_setting("login_logo_url").') no-repeat center center !important; background-size: 100% auto !important; }
    </style>';
    print $out;
	}
}


if ( !function_exists( 'include_files_in_dir' ) ) :
/**
 * Module Loader Methods
 */
	function include_files_in_dir( $dir, $no_more = false, $f_name = null ) {
	    $dir_init = $dir;
	    $dir = dirname(__FILE__).$dir;
	    if (!file_exists($dir)) {
	        throw new Exception("Directory $dir does not exist");
	    }
	    $files = array();
	    if ($handle = opendir( $dir )) {
	        while( false !== ($file = @readdir($handle)) ) {
	            if ( is_dir( $dir.$file ) && !preg_match('/^\./', $file) && !$no_more ) {
	                include_files_in_dir( $dir_init.$file."/", true, $f_name );
	            } else {
	                if ( $f_name && $f_name == $file ) {
	                	$files[] = $dir.$file;
	                } elseif ( !$f_name && preg_match('/^[^~]{1}.*\.php$/', $file) ) {
	                	$files[] = $dir.$file;
	                }
	            }
	        }
	        @closedir($handle);
	    }
	    sort($files);
	    foreach($files as $file) {
	        include_once $file;
	    }
	}
endif;


if ( !function_exists( 'miss_load_modules' ) ) :
/**
 * Module Loader 
 */
function miss_load_modules() {
		include_files_in_dir( "/../modules/", false, 'init.php' );
}
endif;


if ( !function_exists( 'miss_is_blog' ) ) :
/**
 * Return "true" if current page is "main blog page".
 */
function miss_is_blog() {
	global $wp_query;
	$post_obj = $wp_query->get_queried_object();
	if ( is_object( $post_obj ) && isset( $post_obj->ID ) && $post_obj->ID == get_option( 'page_for_posts' ) ){
		return true;
	};
}
endif;


if ( !function_exists( 'miss_page_title' ) ) :
/**
 *
 */
function miss_page_title() {
	global $irish_framework_params, $wp_query;

	if( is_front_page() ) {
		return;
	}

	if( miss_is_template( 'templates/template-home.php' ) ) {
		return;
  	}
	
	$post_obj = $wp_query->get_queried_object();
	
	if( !empty( $post_obj ) && !empty( $post_obj->ID ) && get_post_meta( $post_obj->ID, '_disable_page_title', true ) ) {
		return;
	}

	$title = '';
	
	if( is_404() ) {
		$title = __( 'The requested page could not be found', MISS_TEXTDOMAIN );
		$page_tagline = __( 'Error 404', MISS_TEXTDOMAIN );

	}

	/**
	 * Events Calendar PRO Support
	 * 
	 * @since 1.8
	 */

	if ( class_exists('TribeEventsPro') ) {
		if( function_exists('tribe_is_month') && tribe_is_month() ) {
			$title = __( 'Events for', MISS_TEXTDOMAIN );
			$page_tagline = Date("F Y", strtotime($wp_query->get('start_date') ) );
		}

		if( function_exists('tribe_is_day') && tribe_is_day() ) {
			$title = __( 'Events for', MISS_TEXTDOMAIN );
			$page_tagline = Date("l, F jS Y", strtotime($wp_query->get('start_date') ) );
		}

		if( function_exists('tribe_is_week') && tribe_is_week() ) {
			if ( function_exists( 'tribe_get_first_week_day' ) ) {
				$title = sprintf( __('Events for week of %s', MISS_TEXTDOMAIN),
						Date("l, F jS Y", strtotime(tribe_get_first_week_day($wp_query->get('start_date'))))
				);
			}
			$page_tagline = '';
		}
		if( (function_exists('tribe_is_map') && tribe_is_map() ) || ( function_exists('tribe_is_photo') && tribe_is_photo() ) ) {
			if( tribe_is_past() ) {
				$title = __( 'Past Events', MISS_TEXTDOMAIN );
			} else {
				$title = __( 'Upcoming Events', MISS_TEXTDOMAIN );
			}
			$page_tagline = '';
		}
		if( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ){
			$title = sprintf( '%s %s',
				__( 'All events for', MISS_TEXTDOMAIN ),
				get_the_title()
			);
			$page_tagline = '';
		} 
	}

	$intro_options = miss_get_setting( 'intro_options' );
	if ( is_search() ) {
		$title = sprintf( __('Search Results for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . get_search_query() . '&rsquo;');
	} elseif ( is_category() ) {
		$title = sprintf( __('Category Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . single_cat_title('',false) . '&rsquo;');
	} elseif ( is_archive() || is_singular( 'post' ) ) {
		$title = sprintf( __( '%1$s', MISS_TEXTDOMAIN ), ( miss_get_setting( get_post_type() . '_page_caption' ) ? miss_get_setting( get_post_type() . '_page_caption' ) : get_post_type() ) );
	} elseif ( is_tag () ) {
		$title = sprintf( __('All Posts Tagged Tag: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . single_tag_title('',false) . '&rsquo;');
	} elseif ( is_day() ) {
		$title = sprintf( __('Daily Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . get_the_time('F jS, Y') . '&rsquo;');
	} elseif ( is_month() ) {
		$title = sprintf( __('Monthly Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . get_the_time('F, Y') . '&rsquo;');
	} elseif ( is_year() ) {
		$title = sprintf( __('Yearly Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . get_the_time('Y') . '&rsquo;');
	} elseif( is_singular( 'portfolio' ) ) {
		$gallery_id = miss_get_setting('portfolio_page');
		if( !empty( $gallery_id ) ) {
			$title = get_the_title( $gallery_id );
		}
	} elseif ( function_exists('is_woocommerce') && is_woocommerce() ) {
	            $shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
	       		$title = ( miss_get_setting( 'store_title' ) ) ? get_option( 'store_title' ) : ( ( get_option( 'woocommerce_shop_page_title' ) ) ? get_option( 'woocommerce_shop_page_title' ) : __('Store', MISS_TEXTDOMAIN ) );
				$page_tagline = ( miss_get_setting( 'product_page_tagline' ) ) ? get_option( 'product_page_tagline' ) : '';

	} elseif ( is_author() ) {
		global $author;
		$curauth = get_userdata( intval($author) );
		$title = sprintf( __('Author Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . $curauth->nickname . '&rsquo;');
            if ( is_search() ) {
	       		$title = printf( __( 'Search Results: &ldquo;%s&rdquo;', MISS_TEXTDOMAIN ), get_search_query() );

            } elseif ( is_tax() ) {
	            $title = single_term_title( "", false );
            } else {
	            $shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
	       		$title = ( miss_get_setting( 'store_title' ) ) ? get_option( 'store_title' ) : ( ( get_option( 'woocommerce_shop_page_title' ) ) ? get_option( 'woocommerce_shop_page_title' ) : __('Store', MISS_TEXTDOMAIN ) );
				$page_tagline = ( miss_get_setting( 'product_page_tagline' ) ) ? get_option( 'product_page_tagline' ) : '';
       		}
	}

	if( !empty( $title ) ) {
		if ( !empty( $page_tagline ) ) {
			$page_tagline = '<span class="page_tagline">' . $page_tagline . '</span>';
			$title .= $page_tagline;
		}
		return '<h1 class="page_title">' . $title . '</h1>';
	} else {
		global $wp_query;
		
		$post_obj = $wp_query->get_queried_object();
		$post_id = ( is_object( $post_obj ) && isset( $post_obj->ID ) ) ? $post_obj->ID : '';
		
		$page_title = get_the_title($post_id);

		if ( empty( $page_title ) ) {
			return false;
		}

		$_layout = get_post_meta( $post_id, '_intro_text', true );
		$template = get_post_meta( $post_id, '_wp_page_template', true );

		if ( !isset( $page_tagline ) ) {
			$page_tagline = get_post_meta( $post_id, '_page_tagline', true );
		}

		if ( !empty( $page_tagline ) ) {
			$page_tagline = '<span class="page_tagline">' . $page_tagline . '</span>';
		} else {
			$page_tagline = '';
		}
		if( is_page() ) {
			if( is_front_page() != 1  || $template != 'templates/template-home.php' )
				return the_title( '<h1 class="page_title">', $page_tagline . '</h1>', false );

			elseif( $_layout == 'default' && $intro_options == 'disable' && $template != 'templates/template-wiki.php' )
				return the_title( '<h1 class="page_title">', $page_tagline . '</h1>', false );
		} else {
			return '<h1 class="page_title">' . get_the_title($post_id) . $page_tagline . '</h1>';
		}
	}
}
endif;

if ( !function_exists( 'miss_get_basic_user_identification' ) ) :

/**
 * Get user identification include unauthorized via cookies
 */
function miss_get_basic_user_identification() {
	$miss_user = wp_get_current_user();
	if ( $miss_user->ID > 0 ) {
		return $miss_user->ID;
	} else {
		if ( isset( $_COOKIE ) ) {
			foreach( $_COOKIE as $miss_cookie_key => $miss_cookie ) {
				return md5( $miss_cookie_key );
				break;
			}
		} else {
			return false;
		}
	}
}

endif;


if ( !function_exists( 'miss_get_gwf' ) ):
/**
 * Return active Google Web Fonts
 * @since 1.8
 */
function miss_get_gwf() {
    $fonts = array();
    $gwf = miss_get_setting( 'google_web_fonts' );
    if( ($gwf['keys'] != '#') and ($gwf != '') ) {
        $gwf_keys = explode( ',', $gwf['keys'] );

		if ( array_key_exists('#', $gwf) ) {
			unset($gwf['#']);
			unset($gwf['keys']);
		};
		foreach ($gwf as $key => $value) {
			if (isset($gwf[$key]['gwf_face_name'])){
				$font_safe_key = $gwf[$key]['gwf_face_name'];
				// Set font
				$fonts[$font_safe_key] = $font_safe_key;
			}
		}
	}
    return $fonts;
}
endif;


if ( !function_exists( 'miss_remove_script_version' ) ):

function miss_remove_script_version( $src ){
	$parts = explode( '?ver=', $src );
	return $parts[0];
}

endif;

if ( !function_exists('miss_raw_excerpt') ):
	function miss_raw_excerpt($buffer) {
		return miss_excerpt( $buffer, 20, '' );
	}
endif;
?>
