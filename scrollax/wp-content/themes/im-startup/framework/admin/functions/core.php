<?php
/**
 * Deny hack attempt
 */
if ( !defined( 'ABSPATH' ) ) {
	header('HTTP/1.1 403 Forbidden');
	exit;
}


/**
 * General
 */
function miss_options_init() {
	register_setting( MISS_SETTINGS, MISS_SETTINGS );
	
	# Add default options if they don't exist
	add_option( MISS_SETTINGS, miss_default_options( 'settings' ) );
	add_option( MISS_INTERNAL_SETTINGS, miss_default_options( 'internal' ) );
	# delete_option(MISS_SETTINGS);
	# delete_option(MISS_INTERNAL_SETTINGS);

	if( miss_ajax_request() ) {
		# Ajax option save
		if( isset( $_POST['miss_option_save'] ) ) {
			miss_ajax_option_save();
			
		# Sidebar option save
		} elseif( isset( $_POST['miss_sidebar_save'] ) ) {
			miss_sidebar_option_save();
			
		} elseif( isset( $_POST['miss_sidebar_delete'] ) ) {
			miss_sidebar_option_delete();
			
		} elseif( isset( $_POST['action'] ) && $_POST['action'] == 'add-menu-item' ) {
			add_filter( 'nav_menu_description', create_function('','return "";') );
		}
	}
	
	# Option import
	if( ( !miss_ajax_request() ) && ( isset( $_POST['miss_import_options'] ) ) ) {
		miss_import_options( $_POST[MISS_SETTINGS]['import_options'] );

	# Reset options
	} elseif( ( !miss_ajax_request() ) && ( isset( $_POST[MISS_SETTINGS]['reset'] ) ) ) {
		update_option( MISS_SETTINGS, miss_default_options( 'settings' ) );
		delete_option( MISS_SIDEBARS );
		wp_redirect( admin_url( 'admin.php?page=miss-options&reset=true' ) );
		exit;
		
	# $_POST option save
	} elseif( ( !miss_ajax_request() ) && ( isset( $_POST['miss_admin_wpnonce'] ) ) ) {
		unset(  $_POST[MISS_SETTINGS]['export_options'] );
	}
	
}

/**
 * Theme sidebar remove
 */
function miss_sidebar_option_delete() {
	check_ajax_referer( MISS_SETTINGS . '_wpnonce', 'miss_admin_wpnonce' );
	
	$data = $_POST;
	
	$saved_sidebars = get_option( MISS_SIDEBARS );
	
	$msg = array( 'success' => false, 'sidebar_id' => $data['sidebar_id'], 'message' => sprintf( __( 'Error: Sidebar &quot;%1$s&quot; not deleted, please try again.', MISS_ADMIN_TEXTDOMAIN ), $data['miss_sidebar_delete'] ) );
	
	unset( $saved_sidebars[$data['sidebar_id']] );
	
	if( update_option( MISS_SIDEBARS, $saved_sidebars ) ) {
		$msg = array( 'success' => 'deleted_sidebar', 'sidebar_id' => $data['sidebar_id'], 'message' => sprintf( __( 'Sidebar &quot;%1$s&quot; Deleted.', MISS_ADMIN_TEXTDOMAIN ), $data['miss_sidebar_delete'] ) );
	}
	
	$echo = json_encode( $msg );

	@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
	echo $echo;
	exit;
}

/**
 * Theme sidebar store
 */
function miss_sidebar_option_save() {
	check_ajax_referer( MISS_SETTINGS . '_wpnonce', 'miss_admin_wpnonce' );
	
	$data = $_POST;
	
	$saved_sidebars = get_option( MISS_SIDEBARS );
	
	$msg = array( 'success' => false, 'sidebar' => $data['custom_sidebars'], 'message' => sprintf( __( 'Error: Sidebar &quot;%1$s&quot; not saved, please try again.', MISS_ADMIN_TEXTDOMAIN ), $data['custom_sidebars'] ) );
	
	if( empty( $saved_sidebars ) ) {
		$update_sidebar[$data['miss_sidebar_id']] = $data['custom_sidebars'];
		
		if( update_option( MISS_SIDEBARS, $update_sidebar ) )
			$msg = array( 'success' => 'saved_sidebar', 'sidebar' => $data['custom_sidebars'], 'sidebar_id' => $data['miss_sidebar_id'], 'message' => sprintf( __( 'Sidebar &quot;%1$s&quot; Added.', MISS_ADMIN_TEXTDOMAIN ), $data['custom_sidebars'] ) );
		
	} elseif( is_array( $saved_sidebars ) ) {
		
		if( in_array( $data['custom_sidebars'], $saved_sidebars ) ) {
			$msg = array( 'success' => false, 'sidebar' => $data['custom_sidebars'], 'message' => sprintf( __( 'Sidebar &quot;%1$s&quot; Already Exists.', MISS_ADMIN_TEXTDOMAIN ), $data['custom_sidebars'] ) );
			
		} elseif( !in_array( $data['custom_sidebars'], $saved_sidebars ) ) {
			$sidebar[$data['miss_sidebar_id']] = $data['custom_sidebars'];
			$update_sidebar = $saved_sidebars + $sidebar;
			
			if( update_option( MISS_SIDEBARS, $update_sidebar ) )
				$msg = array( 'success' => 'saved_sidebar', 'sidebar' => $data['custom_sidebars'], 'sidebar_id' => $data['miss_sidebar_id'], 'message' => sprintf( __( 'Sidebar &quot;%1$s&quot; Added.', MISS_ADMIN_TEXTDOMAIN ), $data['custom_sidebars'] ) );
			
		}
	}
		
	$echo = json_encode( $msg );

	@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
	echo $echo;
	exit;
}

/**
 * Ajax store
 */
function miss_ajax_option_save() {
	check_ajax_referer( MISS_SETTINGS . '_wpnonce', 'miss_admin_wpnonce' );
	
	$data = $_POST;
	
	unset( $data['_wp_http_referer'], $data['_wpnonce'], $data['action'], $data['miss_full_submit'], $data[MISS_SETTINGS]['export_options'] );
	unset( $data['miss_admin_wpnonce'], $data['miss_option_save'], $data['option_page'] );
	
	$msg = array( 'success' => false, 'message' => __( 'Error: Options not saved, please try again.', MISS_ADMIN_TEXTDOMAIN ) );
	
	if( get_option( MISS_SETTINGS ) != $data[MISS_SETTINGS] ) {
		
		if( update_option( MISS_SETTINGS, $data[MISS_SETTINGS] ) )
			$msg = array( 'success' => 'options_saved', 'message' => __( 'Options Saved.', MISS_ADMIN_TEXTDOMAIN ) );
			
	} else {
		$msg = array( 'success' => true, 'message' => __( 'Options Saved.', MISS_ADMIN_TEXTDOMAIN ) );
	}
	
	$echo = json_encode( $msg );

	@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
	echo $echo;
	exit;
}

/**
 * Theme shortcode generator
 */
function miss_shortcode_generator() {
	global $irish_framework_params;
	
	$shortcodes = miss_shortcodes();
	
	$options = array();
	
	foreach( $shortcodes as $shortcode ) {
		$shortcode = str_replace( '.php', '',$shortcode );
		$shortcode = preg_replace( '/[0-9-]/', '', $shortcode );
		
		if( $shortcode[0] != '_' ) {
			$class = 'miss' . ucwords( $shortcode );
			$options[] = call_user_func( array( &$class, '_options'), $class );
		}
	}
	
	return $options;
}

/**
 * Check WordPress version
 */
function miss_check_wp_version(){
	global $wp_version;
	
	$check_WP = '3.0';
	$is_ok = version_compare($wp_version, $check_WP, '>=');
	
	if ( ($is_ok == FALSE) ) {
		return false;
	}
	
	return true;
}

/**
 * 
 */
function miss_wpmu_style_option() {
	$styles = array();
	if( is_multisite() ) {
		global $blog_id;
		$wpmu_styles_path = $_SERVER['DOCUMENT_ROOT'] . '/' . get_blog_option( $blog_id, 'upload_path' ) . '/styles/skins';
		if(is_dir( $wpmu_styles_path ) ) {
			if($open_dirs = opendir( $wpmu_styles_path ) ) {
				while(($style = readdir($open_dirs)) !== false) {
					if(stristr($style, '.css') !== false) {
						$theme_name = md5( THEME_NAME ) . 'muskin_';
						$style_mu = str_replace( $theme_name, '', $style );
						$styles[$style_mu] = @filemtime( $wpmu_styles_path . $style);
						
						if( stristr($style, 'muskin_') !== false && stristr($style, $theme_name) === false )
							unset($styles[$style_mu]);
						
					}
				}
			}
		}
	}
	
	return $styles;
}

/**
 * Theme branding
 */
function miss_style_option() {
	$styles = array();
	$sort_styles = array();
	
	if( is_dir( THEME_SKINS ) ) {
		if( $open_dirs = opendir( THEME_SKINS ) ) {
			while(($style = readdir($open_dirs)) !== false) {
				// if(stristr($style, '.css') !== false) {
				if(stristr($style, '.php') !== false) {
					$styles[$style] = @filemtime(TEMPLATEPATH . '/assets/styles/skins' . $style);
				}
			}
		}
	}
	
	$styles = array_merge( $styles, miss_wpmu_style_option() );
	
	arsort($styles);
	
	$nt_writable = get_option( MISS_SKIN_NT_WRITABLE );
	if( !empty( $nt_writable ) ) {
		foreach ( $nt_writable as $key => $val ) {
			$val = $val . '.css';
			$sort_styles[$val] = $val;
		}
	}
	
	foreach ($styles as $key => $val) {
		$sort_styles[$key] = ucwords( str_replace( array( '.php', '.' ), array( '', ' ' ), $key ) );
	}
	
	unset( $sort_styles['_create_new.css'], $sort_styles['ux.model.php'] );
	
	return $sort_styles;
}
/**
 * Theme slide types
 */
function miss_slider_types() {
	$types = Array(
		'no' => __('Without Slider', MISS_ADMIN_TEXTDOMAIN ),
		'layerslider' => __('Layer Slider', MISS_ADMIN_TEXTDOMAIN ),
		'revslider' => __('Revolution Slider', MISS_ADMIN_TEXTDOMAIN ),
		'expose' => __('Recent Posts Grid (Expose)', MISS_ADMIN_TEXTDOMAIN ),
		'roadmap' => __('Road Map', MISS_ADMIN_TEXTDOMAIN ),
		'featured' => __('Banner', MISS_ADMIN_TEXTDOMAIN ),
	);
	return $types;
}

/**
 * Layer Slider List
 */
function miss_ls_slides() {
global $wpdb;
$slides_array = array();
 	if ( function_exists("layerslider_activation_scripts") ) {
		// Table name
		$ls_table_name = $wpdb->prefix . "layerslider";
		// Get sliders
		$ls_query = "SELECT id, name FROM $ls_table_name
	            WHERE flag_hidden = '0' AND flag_deleted = '0'
	            ORDER BY date_c ASC LIMIT 100";
		$sliders = $wpdb->get_results( $ls_query );
	                    
	                    // Iterate over the sliders
		foreach($sliders as $key => $item) {
			if (empty($item->name)) {
					$slide_name = __("Untitled", MISS_ADMIN_TEXTDOMAIN) . " " . $item->id;
			} else {
				$slide_name = $item->name;
			}
			$slides_array[$item->id] = $slide_name;
		}
	} else {
		$slides_array[0] = __("Please install LayerSlider WP", MISS_ADMIN_TEXTDOMAIN);
	}
	return $slides_array;
}

/**
 * Revolution Slider List
 */
function miss_rev_slides() {
global $wpdb;
$slides_array = array();
 	if ( class_exists("UniteBaseClassRev") ) {

		// Table name
		$rev_table_name = $wpdb->prefix . "revslider_sliders";
		// Get sliders
		$rev_query = "SELECT alias FROM $rev_table_name
	            ORDER BY title ASC LIMIT 100";
		$sliders = $wpdb->get_results( $rev_query );
	                    
	                    // Iterate over the sliders
		foreach($sliders as $key => $item) {
			if (empty($item->title)) {
					$slide_name = $item->alias;
			} else {
				$slide_name = $item->title;
			}
			$slides_array[$item->alias] = $slide_name;
		}
	} else {
		$slides_array[0] = __("Please install Slider Revolution Plugin", MISS_ADMIN_TEXTDOMAIN);
	}

	return $slides_array;
}



if ( !function_exists( 'miss_css_animation' ) ) :

function miss_css_animation() {
	return array(
	    ''              => "none",
	    "fade-in"       => "Fade In",
	    "scale-up"      => "Scale Up",
	    "right-to-left" => "Right to Left",
	    "left-to-right" => "Left to Right",
	    "bottom-to-top" => "Bottom to Top",
	    "top-to-bottom" => "Top to Bottom",
	);
}
endif;


if ( !function_exists( 'miss_get_all_font_icons' ) ) :
/**
 * all font icons
 */
function miss_get_all_font_icons() {

	$variation = miss_icomoon_option();
	$all_icons = Array();
	foreach( $variation as $key => $value ) {
		$all_icons[$key] = $value . ' (IcoMoon)';
	}
	$variation = miss_icon_variations();
	foreach( $variation as $key => $value ) {
		$all_icons[$key] = $value . ' (FontAwesome)';
	}
	asort( $all_icons );

	return $all_icons;
}
endif;


/**
 * Theme skin patterns
 */
function miss_pattern_presets() {
	$patterns = array();
	$pic_types = array( 'jpg', 'jpeg', 'gif', 'png' );

	if( is_dir( THEME_PATTERNS_DIR ) ) {
		if( $open_dirs = opendir( THEME_PATTERNS_DIR ) ) {
			while( ( $pattern = readdir( $open_dirs ) ) !== false ) {
				$parts = explode( '.', $pattern );
				$ext = strtolower( $parts[count($parts) - 1] );
				
				if( in_array( $ext, $pic_types ) ) {
					$patterns[$pattern] = $parts[count($parts) - 2];
				}
			}
		}
	}
	
	asort( $patterns );
	
	return $patterns;
}


/**
 * Theme typography
 */
function miss_typography_options() {
	$font = array(
		'Core' => __( 'Core Fonts', MISS_ADMIN_TEXTDOMAIN ),
		"\"Source Sans Pro\", Arial, Helvetica, sans-serif" => 'Source Sans Pro',
		'optgroup' => 'optgroup',
		'Web' => __( 'System Fonts', MISS_ADMIN_TEXTDOMAIN ),
		'Arial, Helvetica, sans-serif' => 'Arial',
		'Verdana, Geneva, Tahoma, sans-serif' => 'Verdana',
		'"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif' => 'Lucida',
		'Georgia, Times, "Times New Roman", serif' => 'Georgia',
		'"Times New Roman", Times, Georgia, serif' => 'Times New Roman',
		'"Trebuchet MS", Tahoma, Arial, sans-serif' => 'Trebuchet',
		'"Courier New", Courier, monospace' => 'Courier New',
		'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif' => 'Impact',
		'Tahoma, Geneva, Verdana, sans-serif' => 'Tahoma',
		'inherit' =>'Inherit',
		'optgroup' => 'optgroup');
		
	$gwf = miss_get_gwf();

	if ( is_array( $gwf ) && count( $gwf ) > 0 ) {
		$gwf_array = array();
		$gwf_array['Google'] = __( 'Google Web Fonts', MISS_ADMIN_TEXTDOMAIN );
		foreach( miss_get_gwf() as $gwf_type_face ) {
			$gwf_quotes = "\"" . $gwf_type_face . "\"";
			$gwf_array[$gwf_quotes] = $gwf_type_face;
		}
		$gwf_array['optgroup'] = 'optgroup';
		$font = array_merge( $gwf_array, $font );
	}

	
	$size = range(1,100 );
	$transform = array( 'inherit', 'uppercase', 'lowercase' );
	$decoration = array( 'default', 'none', 'underline' );
	$size = array_merge( array('default', 'inherit'), $size);
	$weight = array( 'default', 'inherit', 'normal', 'bold', 100, 300, 400, 500, 600, 700, 800, 900 );
	$style = array( 'default', 'inherit', 'normal', 'italic', 'oblique' );
	$options = array( 'font-size' => $size, 'font-weight' => $weight,  'font-style' => $style, 'font-family' => $font, 'text-decoration' => $decoration );
	
	return $options;
}



/**
 * Theme dependencies
 */
function miss_dependencies( $post_id ) {
	global $irish_framework_params;
	
	if( !is_admin() ) return;
	
	  if ( empty( $irish_framework_params->dependencies ) && !empty( $_POST[MISS_SETTINGS] ) ) {
	    $post = $_POST;
		
		$dependencies = array();
		
		if( strpos( $post['post_content'], '[flex' ) !== false  ) { $dependencies[] = 'flex'; }
				
		if( strpos( $post['post_content'], '[contactform' ) !== false ) { $dependencies[] = 'contactform'; }
		
		if( strpos( $post['post_content'], 'post_content=\"full' ) ) { $dependencies[] = 'miss_scripts'; }
		
		$dependencies = serialize( $dependencies );
		update_post_meta( $post_id, '_' . THEME_SLUG .'_dependencies', $dependencies );
	  }
	
	$irish_framework_params->dependencies = true;
}

/**
 * Initialize Tinymce
 */
function miss_tinymce_init_size() {
	if( isset( $_GET['page'] ) ) {
		if( $_GET['page'] == 'miss-options' ) {
			$tinymce = 'TinyMCE_' . MISS_SETTINGS . '_content_size';
			if( !isset( $_COOKIE[$tinymce] ) )
				setcookie($tinymce, 'cw=577&ch=251');
		}
	}
}

/**
 * Theme import options
 */
function miss_import_options( $import ) {
	$imported_options = miss_decode( $import, $serialize = true );
	if( is_array( $imported_options ) ) {
		if( array_key_exists( 'missmyway_options_export', $imported_options ) ) {
			if( get_option( MISS_SETTINGS ) != $imported_options ) {
				if( update_option( MISS_SETTINGS, $imported_options ) )
					wp_redirect( admin_url( 'admin.php?page=miss-options&import=true' ) );
				else
					wp_redirect( admin_url( 'admin.php?page=miss-options&import=false' ) );
			} else {
				wp_redirect( admin_url( 'admin.php?page=miss-options&import=true' ) );
			}
		} else {
			wp_redirect( admin_url( 'admin.php?page=miss-options&import=false' ) );
		}
		
	} else {
		wp_redirect( admin_url( 'admin.php?page=miss-options&import=false' ) );
	}
	exit;
}

/**
 * Import theme defaults
 */
function miss_default_options( $type ) {
	global $irish_framework_params;
	$options = '';
	$default_options = 'xRtpc9s29q9gZ2cy7axk8dTV2WmdxHHSOlsnrtfZdDociIQk2CTBAqBktZP_voBEkIBAHbYb95MT4l14eDcgOHa9wfhPNnad8YvfS8K_o4gVJGd4gTb__46NB9USyuEkRUn9Pay-z7FAqr8Oq68JZia461YrKVyRkkd8VSALa5qieyzQ6gVPCTahCCYxLbNJlKAUZ5gj2tCugHoNXlB9YnNCeUwSFM1QjijkhOqs4bg__hOPHYGiMArCeLWKx66-AGeoXvA0DTAOp9N6xddQcrRk9UKgKXMBY5jHq3otFGujWgDKpyTFpFr9IjaoCMIcpiuOYxbJPdXbVVpqNKK-xCXjJItixnYDj0zY2z2gbn3qJENSIdHmOG3G0zJNoyVO-NyypJjkHOUaTl-t_JpBOsO57_z2IpVnDnovZoL71r_nAWB8laJ_b5A4uuddmOJZPgaxoItoJa-Ef4tWgM8RRf8Av-KYZITkQPzNK1ycdeX_uvEcxXeC-d3mM2D4D0XeczZ_fwNdcIE4KBnAOackKWMESEmBOGRwQ2hyKfyAgV_mKEMC9IpDyq8LKW9vHqxFt4x641LRRCAjGlGY4JLVhuluGyanJdJMYmQSEUqgMJoLL6kd4zCN2rc15EjqszkbhXmWYC40iRkw170WEjX_ocW_wTWdK0N5aTiXWkggR62-lcJ8ZviWCiKMxBg2QWTjXMpuUyLsq17pG15MaIMz0PyClRMWUzzZrTkpZDQlNIPcsvY34PaqA_7XaGzYpnS5m-bsQ6k3V_zDk9G5b_inxeAsn6WYNW5WKwjnd1aI_Kfag9Tyfvrq8xuK8vjh5P0jyZ8jobb8geTtT_uZWYGslc0W1JcG7A6tmKV4t-N1_I4uk3KG6lDXfm1nQGnrpqfYi3g2b0xJkQ37DbyZlqMpvkdJpHnRYef3dI6kgDHmq5q-Xy06JyPbcoUTkYiJNHS32iWq79khQtQEhUgXkUS3DkITrnHlNaOSpo3qFfic82Lc6zEZZcviZFmcYCqcIMOMnYgw31sW3SrN9MoiJTBhPc9x_Z4z7EFKydKTpN2Too4heoUiue7YVzBsPnl10cRxDoX_Ey49eVvmOrs9WuZBTxI1hQ30gPZcTH3Tvrdyv2cosKK6_gtjznZS2dK0WnVV4pWUt1CYKP9EHSijcsExyTW1qHAuEy8rYG6UClMhS1fmdgFY3Gtlwg1KhTIQ4ASsVE5fYKExmAIynWKZ6qeykADTkpciT6xLEokJfs5FDEEKCi4gTqVHAi8Ac0GKAQgSuAI94PdD-S_5YYUgVQIapUFtg1O4kIWJafzO042_omseq6ILi0KEErm-O3B6o7b0JbiKrUjXjqFxIHYF2Zr-ijnJG_eva5t_uZ4PvvFc71sQhP3uYDhyDhBCmdC_bZHoHmZibz8YetIK0ApsRshMaGCJJpE0lSYh-yohu-t2SZnjbDmNpjBGUQ4zZNXTH0oRIRnMk31Z6xiCypdPXyL0GaED6al2ID011Q2R0LM4rbTM8qhuNKIJnplpVMm53HOQyhj3pM-aK1-SZ-SqjpPPKXrO3arYMxV-_zewbVgxnEs7XvdgR7BVFjMcOHs4K6jA72sGrXQ9EUG_SgjuQ3gORsfw9H1nP0_vITx97xie3iGe_kN4Bl5wDE_vAM_gITy9QXgET3fo7-cZPoin4x6zzxpKb2VZBoXBygFMJDoafgxbVYMN952oBfRFa8IzJNru7GFcm20cZUiO07LZFNIZehxbf3TMuXrDsCVIwEQ08iJDw42iWTSjOHnQnt3-MUblD7U9q1SNMzkyIgtEBVNkFDehbxY3EmgmCnU-P0nQQi9puJywsB7Oug2MXTpssSqgBtRXvHrXDFHWWxQ98VeAPpqro3sNx1wbYaoU-FIs2XWe5mZ2w6THVHsEV0BR-a-rLXOYWs8KS07sEqcyuDsUZSQpNTmVTjic2NpcY4mSKZMV_bqiZnsR64K9mgNHcnybEYqiScl5XR8ebFK9Fj1FMBeHa1SZg7pqTlAX5y1qFkeybjxxfngOugGGBd6Tlwe6YtaD0BhutyKqaqPxHC_QGFxKf7NJyCHxDhJK_AvIEePgP2c3V42Kw3qmJlrxjOQYpjvo1KdxM4dyiIdWgImWBE6ENkHJvrcnk9V8-hhykCKwRCAl5E5UHWBKqK1QeXja-FwbE_i21c9EEkB0ZSIoZXr9UWCruKl8WpFcT08PodE3bPpnPRLZtwlb074NiunliuiFYWK1gBtENieF2dEpVuvhY88-h2I9Z95lYUpjVQt6pU0wNY_XeLdHpiuxtKutWg_GpdMZGlLi9dRyi-hb-CZrxeRVtWxHnEpqNXo9cEJao2eimWwV8autiW4zN6RogdHS-ryZstkKkC24rPQ1o7djhWsBe4eD0BpYjiosn3GHO-RYpzx7zFLfcYic1RJbNjuOhBtDvQTYROXaiKqOog53xhBfmfESJzNUh7gvzTELXXNEMTRv3ep-unUYO6jPqpDubc6tj0ATCR3HyJxHH0b7UMK0mYN-kTcL-9BqLb7LZR2FUa5vf0e3_5TZ88iYPQdGi--0jYSZqH4m8OgrobpjV4m7gJTnokiKGIrbk5Ma64qw3VJuKPTdwauk4LKC2oPP4UwGOTv9vctzsliXAwDmCTi7j5HIH3lsB5vC5AJleJZmePAiZPT0WSrKhYzmNPXYixTXOXQR5D9dPq3wPSijH-4s1S2W2jYO3Wf1h0_fBmQi_D9Ky6NDSg6fLl1BUSZ6zXUrcVhIb2uEP8n2qXdwSLtf40LgWOUOn0G58vpcZKd1JDjChrfUYWDvUbPzDEY851kaPkrP3jMYQcyY_yjhDl0IP_1ub7Dp0kULIlqiR8kYHJLRe7qMS0KTQr4VeZSE4TMkq9vfS9GAPUq8_jOIl5ME3T5Ge3_rqwFvWHejHdfpuG5n1Bl0hh2nquTCTt94S-DUVyeYy3tlnLR0JbKosFs3Aks-j2AcCyOLOLlDTdkVKrLDYOAE_f4w6NK3_q3z4ePnz8FFfBGSny7OP56Pridv78_vP3waXry-pGevPv18emOXXjYfWSVS1LRzgVL4Cl3krz__V3Rdq-Wb-eL0dHodIrjMXt0sPl6n5-x9mF2wj-EfM7tAFGbAykxoQKjTbjMvP3H_mocsRadvbq9u4ZQNlnavX9PYlk8xuXzrvDk_m70vfvo9y-7mwfnr6VtelBP39PMvo-vLDzdv4Y_xzejDS8cqK7feG1XNTR2KlTEY16r1o6O7tsmdacVDHXaM4jlxPf_7uCm39djayq0u1Tf3m90iLdnDy9C9LJRb18Ht8aG3lf7A9Ia_yvH_InU9sHmTDu-azVs995BPYCOcT8lmdBGlmvO2PY1oQVw_jDiMGOiI9kzVnmMYCAmmWw2h_VTA0RFYKjpRNifLiBVIexhso_mtgkVJSQ9JaGAKM1wYbxUPwOcC9gC8oYEClgw9hIHskg_ADw2NydyI89lac0fNl-SA3Zx47Z8Rts8Zt1vteiT3Sl4A0LiF-ob1WlDa-uRbtN1biwMDtQ3EG5svcPWAvsESJ7yFMzQffLi7RN2-clEHReVbpK2hiba8Qd5c7TMr3vi2pWwQJjDPRfJxd7bs-1ronZVQ2NvQdU9ui5kdEEzW0d4IuUti7-tI7B0hsWdK_DU11rr15jD7zrFXk-3c_CN26z_ufIKvo5_gCImDoyXGmRzgRmQ9AGTHhNfNS8pdbhbYTl1h7Ih9rzZPEME7kR3tUFJz236nGKh9h-AVJRmMwekC5SXqgJconULGO-AdRal84KX9QuFSPmUbg298J_wWhGHYDYKgDwB4A--3vg50tLPue4jTMbgl8zwh6Af5DDERTHEujwzcoMkYVEe7XC5PzOWW94OVQvR0M1Ah94WIjaIkLlbfAXHugdiFsI73wjrAxfqXNeZ-KCmTdAUKskQUJYDk6rcN6189FM2vHuxwWZQ0nkOGDvxapR46SwvNVku4UsYSoXtt-D8RReiX_wM';
	$widgets = '';
	if( $type == 'settings' ) {
		# Set to "false" to create initial export
		$include_images = true;
		# Decode options and unserialize
		$default_options = miss_decode( $default_options, $serialize = true );
		foreach( $default_options as $key => $value ) {
			if( is_array( $value ) ) {
				foreach( $value as $key2 => $value2 ) {
					$default_options[$key][$key2] = str_replace( '%site_url%', THEME_IMAGES . '/activation', $value2 );
				}
			}
		}
		if( $include_images ) {
			# Add default image sizes to options array 
			foreach( $irish_framework_params->layout['images'] as $img_key_full => $image_full ) {
				$image_sizes_full['w'] = $image_full[0];
				$image_sizes_full['h'] = $image_full[1];
				$images_full["${img_key_full}_full"] = $image_sizes_full;
			}
			foreach( $irish_framework_params->layout['big_sidebar_images'] as $img_key_big => $image_big ) {
				$image_sizes_big['w'] = $image_big[0];
				$image_sizes_big['h'] = $image_big[1];
				$images_big["${img_key_big}_big"] = $image_sizes_big;
			}
			foreach( $irish_framework_params->layout['small_sidebar_images'] as $img_key_small => $image_small ) {
				$image_sizes_small['w'] = $image_small[0];
				$image_sizes_small['h'] = $image_small[1];
				$images_small["${img_key_small}_small"] = $image_sizes_small;
			}
			# Merge default options & images sizes 
			$image_merge1 = array_merge( $default_options, $images_full );
			$image_merge2 = array_merge( $image_merge1, $images_big );
			$options = array_merge( $image_merge2, $images_small );
			
		} else {
			$options = $default_options;
		}
	}
	if( $type == 'internal' ) {
		$options = array();
		
		if( defined( 'FRAMEWORK_VERSION' ) )
			$options['framework_version'] = FRAMEWORK_VERSION;
			
		if( defined( 'DOCUMENTATION_URL' ) )
			$options['documentation_url'] = DOCUMENTATION_URL;
			
		if( defined( 'SUPPORT_URL' ) )
			$options['support_url'] = SUPPORT_URL;
	}
	if( $type == 'widgets' ) {
		return;
	}
	return $options;
}
?>