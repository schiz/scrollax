<?php
/**
 * Skin Generator
 * @since 1.0
 */

class missSkinGenerator extends missOptionGenerator {
	
	private $default;
	private $patterns;
	private $stylesheet;
	private $load_type;
	private $colorscheme;
	private $stylesdir;
	
	/**
	 *
	 */
	function __construct() {
		if ( !is_admin() ) return;
			
		add_action( 'admin_init', array( &$this, 'init' ) );
		
		$this->assign_patterns();
		$this->styles_dir();
		$this->activate_skin( 'ux.model.aqua.php', $suppress_msg = true, $init = true );
		$this->default = 'ux.model.aqua.php';
	}
	
	/**
	 *
	 */
	function assign_patterns() {
		$this->patterns = array();
		$this->patterns['background']['patterns'] = 'Background';
		$this->patterns['color']['patterns'] = 'Color';
		$this->patterns['link']['patterns'] = 'Link';
		$this->patterns['typography']['patterns'] = 'Font';
		$this->patterns['border']['patterns'] = 'Border';
		$this->patterns['toggle_start']['patterns'] = ' ~';
		$this->patterns['toggle_end']['patterns'] = 'End ~';
	}
	
	/**
	 *
	 */
	function init() {
		
		if( ( miss_ajax_request() ) && ( isset( $_POST['miss_admin_wpnonce'] ) ) ) {
			check_ajax_referer( MISS_SETTINGS . '_wpnonce', 'miss_admin_wpnonce' );
			
			# Load skin to edit
			if( isset( $_POST['_miss_skin_ajax_load'] ) ) {
				
				if( $_POST['_miss_skin_ajax_load'] == 'create' )
					$this->stylesheet = $this->default;
				else
					$this->stylesheet = $_POST['_miss_skin_ajax_load'];
				
				$this->load_type = $_POST['skin_generator'];
				
				$data = array( 'success' => 'skin_edit', 'html' => $this->options_output() );
				$this->json_process( $data );
				
			# Save new skin
			} elseif( isset( $_POST['_miss_save_custom_skin'] ) ) {
				if( isset( $_POST['_miss_save_manage_skin'] ) )
					$this->stylesheet = $_POST['_miss_save_manage_skin'];
				else
					$this->stylesheet = $this->default;
				
				$data = $this->file_write( $_POST['custom_skin_name'] );
				$this->json_process( $data );
				
			# Save existing skin
			} elseif( isset( $_POST['_miss_save_existing_skin'] ) ) {
				$this->stylesheet = $_POST['_miss_save_manage_skin'];
				$data = $this->file_write( $_POST['_miss_save_manage_skin'], $overwrite = true );
				$this->json_process( $data );

			# Advanced Skin Edit
			} elseif( isset( $_POST['_miss_advanced_skin_edit'] ) ) {
				$this->stylesheet = $_POST['_miss_advanced_skin_edit'];
				$data = array( 'success' => 'skin_advanced', 'html' => $this->advanced_edit() );
				$this->json_process( $data );
				
			# Load skins to manage
			} elseif( isset( $_POST['_miss_manage_custom_skin'] ) ) {
				$data = array( 'success' => 'skin_edit', 'html' => $this->manage_skin() ); //skin_manage
				$this->json_process( $data );

			# Activate new skin
			} elseif ( isset( $_POST['_miss_activate_skin'] ) ) {
				$data =  $this->activate_skin( $_POST['_miss_activate_skin'], $suppress_msg = false );
				$this->json_process( $data );
				
			# Delete skin
			} elseif ( isset( $_POST['_miss_delete_custom_skin'] ) ) {
				$data = $this->delete_skin( $_POST['_miss_delete_custom_skin'] );
				$this->json_process( $data );
			
			# Export skin
			} elseif ( isset( $_POST['_miss_export_custom_skin'] ) ) {
				$data = $this->file_export( $_POST['_miss_export_custom_skin'] );
				$this->json_process( $data );
				
			# Upload skin	
			} elseif ( isset( $_POST['_miss_upload_custom_skin'] ) ) {
				$data = $this->unzip_skin( $_POST['_miss_upload_custom_skin'] );
				$this->json_process( $data );
			}
		}
		
	}
	
	/**
	 *
	 */
	function json_response( $args = array() ) {
		extract( $args );
		
		if( $type == 'skin_saved' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; saved.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'skin_activated' )
			return sprintf( __( 'Style &quot;%1$s&quot; has been activated.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_activated' )
			return __( 'Error: Custom skin not activated, please try again.', MISS_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'skin_exists' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; already exists, please select a different name.', MISS_ADMIN_TEXTDOMAIN ), $name );
		
		elseif( $type == 'not_saved' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; not saved, please try again.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'unzipped' )
			return sprintf( _n( 'Upload Successful. The following skin was added: %1$s', 'Upload Successful. sThe following skins were added: %1$s', count( $cssfile ) ), join( ', ', $cssfile ) );
			
		elseif( $type == 'not_unzipped' )
			return __( 'Error: The skin you uploaded could not be unzipped.', MISS_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'unzipped_nocss' )
			return __( 'Error: No valid &quot;.css&quot; files were found.', MISS_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'skin_deleted' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; has been deleted.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_deleted' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; not deleted, please try again.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'active_skin' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; is currently the active skin, please deactivate it before deleting.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'error_loading' )
			return sprintf( __( 'There was an error loading the following skin &quot;%1$s&quot;, please make sure the following folder is writable by your server: &quot;%2$s&quot;', MISS_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', $this->stylesdir ) );
			
		elseif( $type == 'not_exported' )
			return sprintf( __( 'Error: The skin &quot;%1$s&quot; could not be exported, please make sure the following folder is writable by your server: &quot;%2$s&quot;', MISS_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', $this->stylesdir ) );
			
		elseif( $type == 'not_exported_2' )
			return sprintf( __( 'Error: The skin &quot;%1$s&quot; could not be exported, please try again.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_exported_img' )
			return sprintf( _n( 'The following image could not be add to your export, it will have to be added to your skin manually: %1$s', 'The following images could not be add to your export, they will have to be added to your skin manually: %1$s', count( $image_error ) ), join( ', ', $image_error ) );
			
		elseif( $type == 'upload_error' )
			return sprintf( __( 'Error: The skin %1$s could not be uploaded, unzip it manually and upload it to the following directory on your server: %2$s', MISS_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', $this->stylesdir ) );
			
		elseif( $type == 'upload_exists' )
			return sprintf( __( 'The skin %1$s already exists.', MISS_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'invalid_ext' )
			return __( 'Error: File has an invalid extension, it should be .zip', MISS_ADMIN_TEXTDOMAIN );
	}
	
	/**
	 *
	 */
	function json_process( $data ) {
		$content = ( miss_ajax_request() ) ? 'application/json;' : 'text/html;';
		$echo = json_encode( $data );
		@header( "Content-Type: {$content} charset=" . get_option( 'blog_charset' ) );
		echo $echo;
		exit();
	}
	
	/**
	 *
	 */
	function styles_dir() {
		if( is_multisite() ) {
			global $blog_id;
			if( $blog_id != 1 )
				$this->stylesdir = $_SERVER['DOCUMENT_ROOT'] . '/' . get_blog_option( $blog_id, 'upload_path' ) . '/styles/skins';
			else
				$this->stylesdir = THEME_STYLES_DIR . '/skins';
				
		} else {
			$this->stylesdir = THEME_STYLES_DIR . '/skins';
		}
	}
	
	/**
	 *
	 */
	function image_filter( $image, $export = false ) {
		if( is_multisite() || $export == true ) {
			# check for relative image path
			if( strpos( $image, 'http' ) === false ) {

				$style_uri = explode( '/', THEME_ASSETS . '/styles/skins' );
				
				if( $export == true )
					$style_dir = explode( '/', $this->stylesdir );
				else
					$style_dir = explode( '/', THEME_ASSETS_DIR . '/styles/skins' );

				$relative_img_path = explode( '/', $image );
				$relative_img_path_backup = $relative_img_path;

				for( $j=0; $j<count($relative_img_path_backup); $j++ ) {
					if( $relative_img_path_backup[$j] == '..' ) {
						array_pop($style_uri);
						array_pop($style_dir);
						array_shift($relative_img_path);
					}
				}
				
				if( $export ) {
					$images_dir = implode( '/', $style_dir ) . '/' . implode( '/', $relative_img_path );
					$images['directory'] = str_replace(str_replace( $_SERVER['DOCUMENT_ROOT'], '', THEME_ASSETS_DIR . '/styles/skins//' ), '/', $images_dir );
					
					$images_url = implode( '/', $style_uri ) . '/' . implode( '/', $relative_img_path );
					$images['url'] = str_replace(str_replace( $_SERVER['DOCUMENT_ROOT'], '', THEME_ASSETS_DIR . '/styles/skins//' ), '/', $images_url );
					return $images;
					
				} else {
					$path = str_replace( $_SERVER['DOCUMENT_ROOT'], '' ,implode( '/', $style_dir ) . '/' . implode( '/', $relative_img_path ) );
					return 'url(' . str_replace(str_replace( $_SERVER['DOCUMENT_ROOT'], '', THEME_ASSETS_DIR . '/styles/skins//' ), '/', $path ) . ')';
				}

			} elseif ( strpos( $image, 'http' ) !== false ) {
				if( $export ) {
				 	$img['url'] = $image;
					return $img;
				} else {
					return 'url(' . $image . ')';
				}
			}
			
		} else {
			return 'url(' . $image . ')';
		}
	}
	
	/**
	 * Write theme skin & reset cache
	 */
	function file_write( $name, $overwrite = false ) {
		//$name = str_replace('.css', '', $name );
		$skin_name = "Theme";
		$slug = 'miss_' . THEME_SLUG . '_options';
		$post_styles = $_POST[ $slug ]['skin'];
		//print_r($post_styles);
		$styles_clean = Array();
		if ( isset ( $post_styles ) ) {
			foreach( $post_styles as $key => $value ) {
				add_option( MISS_SKINS, '');
				update_option( MISS_SKINS, $post_styles );
				// update_option( MISS_SKINS, $skin_name );
				//update_option( THEME_CSS_PREFIX . $key, $value );

				//Reset cache
				@file_put_contents( THEME_SKIN_CACHE, '');
			}

		}

		return array( 'success' => 'skin_saved', 'skin_name' => $skin_name, 'message' => $this->json_response( $args = array( 'type' => 'skin_saved', 'name' => 'Theme' ) ) );
		exit;
	}
	
	/**
	 *
	 */
	function sprite_gen( $name ) {
		if( empty( $this->colorscheme ) || !function_exists('gd_info') || !miss_is_sprite_writable() )
			return false;
			
		if( @is_file( THEME_STYLES_DIR . '/' . $name . '/' . 'custom_sprite.png' ) )
			return THEME_STYLES . '/' . $name . '/' . 'custom_sprite.png';
		
		$color = $this->colorscheme;
		
		if ( $color[0] == '#' )
	        $color = substr( $color, 1 );
	    if ( strlen( $color ) == 6 )
	        list( $r, $g, $b ) = array( $color[0].$color[1],$color[2].$color[3],$color[4].$color[5] );
	    elseif (strlen($color) == 3)
	        list( $r, $g, $b ) = array( $color[0].$color[0], $color[1].$color[1], $color[2].$color[2] );
	    else
	        return false;
	
		$r = hexdec( $r ) - 40;
		$g = hexdec( $g ) - 40;
		$b = hexdec( $b ) - 40;
		
		$img_sprite = THEME_SPRITES_DIR . "/icons_{$color}.png";
		
		if( @is_file( $img_sprite ) )
			return THEME_SPRITES . "/icons_{$color}.png";
		
		if( @is_file( THEME_IMAGES_DIR . "/sprites/icons_{$color}.png" ) )
			return THEME_IMAGES . "/sprites/icons_{$color}.png";
			
		if( !function_exists( 'imagefilter' ) )
			return THEME_IMAGES_ASSETS . '/sprite_template.png';
		
		# Colorize template sprite
		$im = @imagecreatefrompng( THEME_IMAGES_DIR . '/sprites/sprite_template.png' );
		
		if( !$im )
			THEME_IMAGES_ASSETS . '/sprites/sprite_template.png';
		
		imagealphablending( $im, true );
		imagesavealpha( $im, true );
		imagefilter( $im, IMG_FILTER_COLORIZE, $r, $g, $b );
		$im_new = imagepng( $im, $img_sprite );
		imagedestroy( $im );
		
		if( $im_new ) {
			@chmod( $img_sprite, 0000666 );
			return THEME_SPRITES . "/icons_{$color}.png";
		} else {
			return THEME_IMAGES_ASSETS . '/sprite_template.png';
		}
	}
	
	/**
	 *
	 */
	function update_skin( $saved_skins, $update_skin ) {
		if( $saved_skins != $update_skin ) {
			add_option( MISS_SKINS, '' );

			if( update_option( MISS_SKINS, $update_skin ) ) {
				return true;
			} elseif ( add_option( MISS_SKINS, $update_skin ) ) {
				return true;
			} else {
				return false;
			}
				
		} else {
			return true;
		}

		return false;
	}
	
	/**
	 *
	 */
	function skin_nt_writable( $name, $nt_writable ) {		
		array_push( $nt_writable, $name );
		
		if( update_option( MISS_SKIN_NT_WRITABLE, $nt_writable ) )
			return true;
		else
			return false;
	}
	
	/**
	 *
	 */
	function skin_writable( $name ) {
		$saved_skins = get_option( MISS_SKIN_NT_WRITABLE );
		
		if( empty( $saved_skins ) )
			return false;
		
		$found = false;
		foreach( $saved_skins as $key => $value ) {
			if( $value == $name ) {
				$found = true;
				unset( $saved_skins[$key] );
			}
		}
		
		if( $found ) {
			if( update_option( MISS_SKIN_NT_WRITABLE, $saved_skins ) )
				return true;
			else
				return false;
			
		} else {
			return false;
		}
	}
	
	/**
	 *
	 */
	function activate_skin( $name, $suppress_msg = true, $init = false ) {
		$saved_skins = ( get_option( MISS_ACTIVE_SKIN ) ) ? get_option( MISS_ACTIVE_SKIN ) : array();

		if( $init && !empty( $saved_skins ) )
			return true;
		
		if( $suppress_msg && !$init ) {
			if( !isset( $saved_skins['style_variations'] ) )
				return true;
			
			elseif( $saved_skins['style_variations'] != $name )
				return true;
		}
		
		$this->stylesheet = $name;
		$fonts = array(); 

		$parse_options = $this->parse_options();
		foreach( $parse_options as $key => $value ) {
			if( !empty( $value['name'] ) )
				if( strpos( $value['name'], 'font' ) !== false ) {
					if( ( !empty( $value['properties'] ) ) && ( !empty( $value['declaration'] ) ) )
						foreach( $value['properties'] as $i => $properties ) {
							if( $properties == 'font-family' ) {
								$value['declaration'] = str_replace( array( "\r\n", "\r", "\n" ), '', $value['declaration'] );
								$fonts[$value['declaration']] = $value['value'][$i];
							}
						}
				}
		}
		foreach( $fonts as $declaration => $font ) {
			$fonts[$declaration] = $font;
		}
		$update_skin = array( 'fonts' => $fonts, 'style_variations' => $name );
		
		if( array_key_exists( $name, miss_wpmu_style_option() ) ) {
			$update_skin = array_merge( $update_skin, array( 'wpmu' => true ) );
		}

		if( $suppress_msg ) {
			if( $saved_skins != $update_skin ) {
				if( update_option( MISS_ACTIVE_SKIN, $update_skin ) )
					return true;
				else
					return false;

			} else {
				return true;
			}

			return false;
		}
		
		
		if( $saved_skins != $update_skin ) {
			if( update_option( MISS_ACTIVE_SKIN, $update_skin ) ) {
				if( is_dir( THEME_SKINS ) ) {
					if ( file_exists( THEME_SKINS . '/' . $name ) ) {
						include( THEME_SKINS . '/' . $name );
						$this->update_skin( $name, $miss_css_model );

						//Reset cache
						@file_put_contents( THEME_SKIN_CACHE, '' );
					}
				}

				return array( 'success' => 'skin_activated', 'message' => $this->json_response( $args = array( 'type' => 'skin_activated', 'name' => $name ) ) );
			} else {
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_activated' ) ) );
			}
				
		} else {
			return array( 'success' => 'skin_activated', 'message' => $this->json_response( $args = array( 'type' => 'skin_activated', 'name' => $name ) ) );
		}
		
		return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_activated' ) ) );
	}
	
	/**
	 *
	 */
	function unzip_skin( $name ) {
		if( !class_exists( 'PclZip' ) )
			require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
		
		$zipfile = $this->stylesdir . '/' . $name;
		$archive = new PclZip( $zipfile );
		$extract = $archive->extract( PCLZIP_OPT_PATH, $this->stylesdir, PCLZIP_OPT_SET_CHMOD, 0666 );
		
		if ( $extract == 0 ) {
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_unzipped' ) ) );
		} else {
			@chmod( $this->stylesdir . '/' . str_replace('.zip', '', $name) , 0000777 );
			@unlink( $zipfile );
		}
			
			
		$cssfile = array();
		if( !empty( $extract ) ) {
			foreach( $extract as $file ) {
				$filepath = str_replace( $this->stylesdir, '', $file['filename'] );
				$explode_path = explode( '/', $filepath );

				if( !empty( $explode_path[1] ) ) {
					if( strpos( $explode_path[1], '.css' ) !== false ) {
						$cssfile[$explode_path[1]] = '&quot;' . str_replace('.css', '', $explode_path[1] ) . '&quot;';
					}
				}
			}
		}
		
		if( empty( $cssfile ) )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'unzipped_nocss' ) ) );
			
		touch( $this->stylesdir . '/' . $explode_path[1] . '.css' );
		if( is_multisite() ) {
			global $blog_id;
			if( $blog_id != 1 )
				rename( $this->stylesdir . '/' . $explode_path[1] . '.css', $this->stylesdir . '/' . md5( THEME_NAME ) . 'muskin_' . $explode_path[1] . '.css' );
		}
			
		$loader = '<span class="ajax_feedback_manage_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></span>';
			
		foreach( $cssfile as $key => $value ) {
			$out = '<tr>';
			$out .= '<td>' . $key . '</td>';

			$out .= '<td>';
			$out .= '<div class="btn-group">';
			$out .= '<a href="#" rel="' . $key . '" class="btn miss_skin_edit">' . __( 'Edit', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '<a href="#" rel="' . $key . '" class="btn miss_skin_export">' . __( 'Export', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '<a href="#" rel="' . $key . '" class="btn miss_skin_advanced">' . __( 'Advanced', MISS_ADMIN_TEXTDOMAIN ) . '</a>';
			$out .= '<a href="#" rel="' . $key . '" class="btn miss_skin_delete">' . __( 'Delete', MISS_ADMIN_TEXTDOMAIN ) . '</a>' . $loader;
			$out .= '</div>';
			$out .= '</tr>';
		}
		
		return array( 'success' => 'unzip_skin', 'skin_name' => $cssfile, 'html' => $out, 'message' => $this->json_response( $args = array( 'type' => 'unzipped', 'cssfile' => $cssfile ) ) );
	}
	
	/**
	 *
	 */
	function delete_skin( $name ) {
		
		$stylesheet = str_replace('.css', '', $name );
		$active_skin = get_option( MISS_ACTIVE_SKIN );
		
		if( $name == $active_skin['style_variations'] )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'active_skin', 'name' => $stylesheet ) ) );
		
		if( !miss_is_styles_writable() ) {
			$nt_writable = get_option( MISS_SKIN_NT_WRITABLE );
			
			if( empty( $nt_writable ) )
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
				
			if( in_array( $stylesheet, $nt_writable ) ) {
				$saved_skins = get_option( MISS_SKINS );
				$update_skin = $saved_skins;
				unset( $update_skin[$stylesheet] );
				
				if( ( $this->update_skin( $saved_skins, $update_skin ) ) && ( $this->skin_writable( $stylesheet ) ) )
					return array( 'success' => true, 'message' => $this->json_response( $args = array( 'type' => 'skin_deleted', 'name' => $stylesheet ) ) );
				else
					return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
					
			} else {
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
			}
			 
		} else {
			
			if( is_multisite() ) {
				global $blog_id;
				if( $blog_id != 1 )
					$name = md5( THEME_NAME ) . 'muskin_' . $name;
			}
			
			if( @is_file( $this->stylesdir . '/' . $name ) ) {
				$saved_skins = get_option( MISS_SKINS );
				$update_skin = $saved_skins;
				unset( $update_skin[$stylesheet] );
				$this->update_skin( $saved_skins, $update_skin );
				$this->skin_writable( $stylesheet );
				
				if( @unlink( $this->stylesdir . '/' . $name ) )
					return array( 'success' => true, 'message' => $this->json_response( $args = array( 'type' => 'skin_deleted', 'name' => $stylesheet ) ) );
				else
					return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
				
			} else {
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
			}
		}
		
		return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
	}
	
	/**
	 * Advanced Style Editor
	 */
	function advanced_edit() {
		$out = '';
		
		$content = $this->get_contents( $this->stylesheet );
		
		if( empty( $content ) ) {
			$out .= '<div class="skin_generator_manage advanced_skin_option_set">';
			$out .= '<div class="miss_option_set skin_generator_error">' . $this->json_response( $args = array( 'type' => 'error_loading', 'name' => $this->stylesheet ) );
			$out .= '<div class="edit_skin_button"><span class="btn btn-small cancel_skin_edit">' . __( 'Return to Skin Manager', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';
			$out .= '</div>';
			$out .= '</div>';
			
			return $out;
		}
		
		$out .= '<div class="skin_generator_manage advanced_skin_option_set">';
		
		$out .= '<textarea tabindex="1" id="advanced_edit" name="advanced_edit" rows="35" cols="72">' . $content . '</textarea>';

		$out .= '<div class="input-append inline miss_option_set edit_skin_save btn-group">';
		
		$out .= '<input name="custom_skin_name" type="text" id="custom_skin_name" class="miss_textfield" onkeyup="missAdmin.fixField(this);">';
		
		$out .= '<div class="btn edit_skin_button"><span class="save_custom_skin">' . __( 'Save As New Skin', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';
		
		$out .= '<div class="btn edit_skin_button"><span class="save_manage_skin">' . __( 'Save Skin', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';
		
		$out .= '<div class="btn edit_skin_button"><span class="cancel_skin_edit">' . __( 'Cancel Edit', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';
		
		$out .= '<div class="ajax_feedback_save_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';
		
		$out .= '<input type="hidden" name="_miss_save_manage_skin" value="' . $this->stylesheet . '" />';

		$out .= '</div>';
		
		$out .= '</div>';
		
		return $out;
	}
	
	/**
	 * Style List
	 * @since 1.7
	 */
	function manage_skin() {
		$loader = '<span class="ajax_feedback_manage_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></span>';
		$css_model = THEME_CSS_MODEL . '/ux.model.php';
		
		$out = '<div class="skin_generator_manage skins_option_set">';
		if ( file_exists( $css_model ) )  {
			include( $css_model );	
	

$miss_admin_css_model = Array(
	/* Body */
	'body' => Array(
		'title' => 'Body and style defaults',
		'params' => Array(
			'body_color' => Array(
				'title' => __( 'Default Font Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'body_font_family' => Array(
				'title' => __( 'Default Font Family', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_family',
			),
			'body_font_weight' => Array(
				'title' => __( 'Default Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'body_font_size' => Array(
				'title' => __( 'Default Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'body_bg_color' => Array(
				'title' => __( 'Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'body_bg_image' => Array(
				'title' => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'upload',
			),
			'body_bg_repeat' => Array(
				'title' => __( 'Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_repeat',
			),
			'body_bg_attachment' => Array(
				'title' => __( 'Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_attachment',
			),
			'body_bg_position' => Array(
				'title' => __( 'Background Position', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'body_border_color' => Array(
				'title' => __( 'Default Border Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'body_line_height' => Array(
				'title' => __( 'Default Line Height', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'most_link_color' => Array(
				'title' => __( 'Global Link Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'most_link_color_hover' => Array(
				'title' => __( 'Global Link Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'most_icon_color' => Array(
				'title' => __( 'Global Icon Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'comment_by_author_bg' => Array(
				'title' => __( 'Comment By Author Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),
	/* Boxed */
	'boxed' => Array(
		'title' => 'Boxed layout',
		'params' => Array(
			'boxed_bg_color' => Array(
				'title' => __( 'Box Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'boxed_bg_image' => Array(
				'title' => __( 'Box Background Image', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'upload',
			),
			'boxed_bg_repeat' => Array(
				'title' => __( 'Box Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_repeat',
			),
			'boxed_bg_attachment' => Array(
				'title' => __( 'Box Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_attachment',
			),
			'boxed_bg_position' => Array(
				'title' => __( 'Box Background Position', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
		)
	),
	/* Extra Header */
	'extra_header' => Array(
		'title' => 'Extra header',
		'params' => Array(
			'extra_header_height' => Array(
				'title' => __( 'Height', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'numeral',
			),
			'extra_header_font_size' => Array(
				'title' => __( 'Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'extra_header_text_color' => Array(
				'title' => __( 'Text Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'extra_header_link_color' => Array(
				'title' => __( 'Link Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'extra_header_hover_color' => Array(
				'title' => __( 'Link Hover Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'extra_header_bg_color' => Array(
				'title' => __( 'Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'extra_header_bg_image' => Array(
				'title' => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'upload',
			),
			'extra_header_bg_repeat' => Array(
				'title' => __( 'Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_repeat',
			),
			'extra_header_bg_attachment' => Array(
				'title' => __( 'Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_attachment',
			),
			'extra_header_bg_position' => Array(
				'title' => __( 'Background Position', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'extra_header_gradient' => Array(
				'title' => __( 'Header Gradient', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
		)
	),

	/* Header */
	'header' => Array(
		'title' => 'Header',
		'params' => Array(
			'header_bg_color' => Array(
				'title' => __( 'Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'header_bg_image' => Array(
				'title' => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'upload',
			),
			'header_bg_repeat' => Array(
				'title' => __( 'Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_repeat',
			),
			'header_bg_attachment' => Array(
				'title' => __( 'Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_attachment',
			),
			'header_bg_position' => Array(
				'title' => __( 'Background Position', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'header_gradient' => Array(
				'title' => __( 'Header Gradient', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'header_font_family' => Array(
				'title' => __( 'Header Elements Font Family', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_family',
			),
		)
	),

	/* Primary Menu */
	'menu' => Array(
		'title' => 'Primary menu',
		'params' => Array(
			'main_menu_gradient' => Array(
				'title' => __( 'Primary Menu Gradient', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			
			'main_menu_bg_image' => Array(
				'title' => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'upload',
			),
			'main_menu_bg_repeat' => Array(
				'title' => __( 'Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_repeat',
			),
			'main_menu_attachment' => Array(
				'title' => __( 'Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_attachment',
			),
			'main_menu_position' => Array(
				'title' => __( 'Background Position', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'main_menu_item_bg_color' => Array(
				'title' => __( 'Main Menu Item BG Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_item_bg_color_hover' => Array(
				'title' => __( 'Main Menu Item BG Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_color' => Array(
				'title' => __( 'Main Menu Text Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_color_hover' => Array(
				'title' => __( 'Main Menu Text Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_icon_color' => Array(
				'title' => __( 'Main Menu Icon Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_icon_color_hover' => Array(
				'title' => __( 'Main Menu Icon Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_font_family' => Array(
				'title' => __( 'Main Menu Font Family', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_family',
			),
			'main_menu_font_size' => Array(
				'title' => __( 'Main Menu Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'main_menu_font_weight' => Array(
				'title' => __( 'Main Menu Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'main_menu_dropdown_font_size' => Array(
				'title' => __( 'Main Menu Dropdown Elements Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'main_menu_dropdown_border_color' => Array(
				'title' => __( 'Main Menu Dropdown Border Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_dropdown_item_bg' => Array(
				'title' => __( 'Main Menu Dropdown Item Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_dropdown_item_bg_hover' => Array(
				'title' => __( 'Main menu Dropdown Item Background Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_dropdown_item_color' => Array(
				'title' => __( 'Main Menu Dropdown Item Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'main_menu_dropdown_item_color_hover' => Array(
				'title' => __( 'Main menu Dropdown Item Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* Page Caption And Before Main Content */
	'page_caption_and_before_main_content_sections' => Array(
		'title' => 'Page caption & before main sections',
		'params' => Array(
			'page_caption_and_before_main_content_sections_gradient' => Array(
				'title' => __( 'Sections Gradient', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'breadcrumbs_color' => Array(
				'title' => __( 'Breadcrumbs Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'breadcrumbs_font_size' => Array(
				'title' => __( 'Breadcrumbs Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'most_caption_color' => Array(
				'title' => __( 'Caption Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'most_caption_font_size' => Array(
				'title' => __( 'Caption Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'most_caption_font_weight' => Array(
				'title' => __( 'Caption Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'most_caption_tagline_color' => Array(
				'title' => __( 'Caption Tagline Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'most_caption_tagline_font_size' => Array(
				'title' => __( 'Caption Tagline Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'most_caption_tagline_font_weight' => Array(
				'title' => __( 'Caption Tagline Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'alt_caption_color' => Array(
				'title' => __( 'Alt Caption Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'alt_text_color' => Array(
				'title' => __( 'Alt Text Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),
	/* Buttons */
	'buttons' => Array(
		'title' => 'Buttons',
		'params' => Array(
			/* Style #1 */
			'btn_1_gradient' => Array(
				'title' => __( 'Button #1 Gradient Background', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'btn_1_font_size' => Array(
				'title' => __( 'Button #1 Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'btn_1_font_weight' => Array(
				'title' => __( 'Button #1 Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),

			/* Style #2 */
			'btn_2_gradient' => Array(
				'title' => __( 'Button #2 Gradient Background', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'btn_2_font_size' => Array(
				'title' => __( 'Button #2 Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'btn_2_font_weight' => Array(
				'title' => __( 'Button #2 Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
		)
	),
	/* Global Tabs */
	'globa_tabs' => Array(
		'title' => 'Tabs global options',
		'params' => Array(
			'tab_color' => Array(
				'title' => __( 'Tab Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'tab_color_hover' => Array(
				'title' => __( 'Active Tab Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'tab_font_size' => Array(
				'title' => __( 'Tab Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'tab_font_weight' => Array(
				'title' => __( 'Tab Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
		)
	),

	/* Horizontal Tabs */
	'horizontal_tabs' => Array(
		'title' => 'Horizontal tabs',
		'params' => Array(
			'tab_gradient' => Array(
				'title' => __( 'Tab Gradient Background', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'tab_gradient_hover' => Array(
				'title' => __( 'Tab Gradient Background', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
		)
	),

	/* Vertical Tabs */
	'vertical_tabs' => Array(
		'title' => 'Vertical tabs',
		'params' => Array(
			'tab_vertical_gradient' => Array(
				'title' => __( 'Tab Gradient Background', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'tab_vertical_gradient_hover' => Array(
				'title' => __( 'Active Tab Gradient Background', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
		)
	),

	/* Toggles */
	'toggles' => Array(
		'title' => 'Toggles',
		'params' => Array(
			'toggle_bg' => Array(
				'title' => __( 'Toggle Background', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'toggle_color' => Array(
				'title' => __( 'Toggle Caption Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'toggle_color_hover' => Array(
				'title' => __( 'Toggle Caption Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* Color Frame & Bottom Bulk Box Field */
	'box_frames' => Array(
		'title' => 'Frame',
		'params' => Array(
			'color_frame_gradient' => Array(
				'title' => __( 'Colour Frame Gradient', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'color_frame_wrap_bg' => Array(
				'title' => __( 'Color Frame Wrap Background', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* Sidebar Framed Caption */
	'sidebar_box_frames' => Array(
		'title' => 'Sidebar: Captions',
		'params' => Array(
			'sidebar_framed_caption_color' => Array(
				'title' => __( 'Caption Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'sidebar_framed_caption_font_size' => Array(
				'title' => __( 'Caption Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'sidebar_framed_caption_font_weight' => Array(
				'title' => __( 'Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
		)
	),

	/* Sidebar WIDGETS */
	'sidebar_widgets' => Array(
		'title' => 'Sidebar: Widget options',
		'params' => Array(
			'sidebar_widget_text_color' => Array(
				'title' => __( 'Text Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'sidebar_widget_link_color' => Array(
				'title' => __( 'Link Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'sidebar_widget_link_color_hover' => Array(
				'title' => __( 'Active Link Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'sidebar_widget_link_font_size' => Array(
				'title' => __( 'Link Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'sidebar_widget_link_font_weight' => Array(
				'title' => __( 'Link Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'sidebar_widget_list_marker_color' => Array(
				'title' => __( 'Bullet Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* Preview Info Wrap (circle icon on hover image) */
	'image_circle_icon' => Array(
		'title' => 'Preview info overlay (image hover with icons)',
		'params' => Array(
			'preview_info_wrap_gradient' => Array(
				'title' => __( 'Preview Info Wrap Gradient', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'preview_info_wrap_icon_color' => Array(
				'title' => __( 'Preview Info Wrap Icon Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'preview_info_wrap_icon_bg' => Array(
				'title' => __( 'Preview Info Wrap Icon Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* H1-H6 Headings */
	'headings' => Array(
		'title' => 'Headings',
		'params' => Array(
			'content_h_font_family' => Array(
				'title' => __( 'Font Family', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_family',
			),
			'content_h1_font_size' => Array(
				'title' => __( 'H1 Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'content_h2_font_size' => Array(
				'title' => __( 'H2 Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'content_h3_font_size' => Array(
				'title' => __( 'H3 Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'content_h4_font_size' => Array(
				'title' => __( 'H4 Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'content_h5_font_size' => Array(
				'title' => __( 'H5 Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'content_h6_font_size' => Array(
				'title' => __( 'H6 Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
		)
	),

	/* Blogging And All Shortcodes Post Title */
	'titles' => Array(
		'title' => 'Posts and blogging',
		'params' => Array(
			'shortcodes_grid_title_font_size' => Array(
				'title' => __( 'Shortcodes Grid Title Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'shortcodes_grid_title_font_weight' => Array(
				'title' => __( 'Shortcodes Grid Title Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'post_more_link_color' => Array(
				'title' => __( 'Post More Link Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'post_more_link_color_hover' => Array(
				'title' => __( 'Post More Link Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),


	/* Forms */
	'forms' => Array(
		'title' => 'Forms',
		'params' => Array(
			'form_field_bg' => Array(
				'title' => __( 'Field Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'form_field_color' => Array(
				'title' => __( 'Field Text Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* Boxed Date */
	'boxed_date' => Array(
		'title' => 'Boxed date',
		'params' => Array(
			'boxed_date_day_bg' => Array(
				'title' => __( 'Boxed Date First Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'boxed_date_month_bg' => Array(
				'title' => __( 'Boxed Date Second Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'boxed_date_day_color' => Array(
				'title' => __( 'Boxed Date Day Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'footer_boxed_date_day_bg' => Array(
				'title' => __( 'Footer Boxed Date First Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'footer_boxed_date_month_bg' => Array(
				'title' => __( 'Footer Boxed Date Second Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'footer_boxed_date_day_color' => Array(
				'title' => __( 'Footer Boxed Date Day Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* Meta Tags and WP Pagenavi */
	'pagenavi_isotope' => Array(
		'title' => 'Meta tags and pagination',
		'params' => Array(
			'pagenavi_gradient' => Array(
				'title' => __( 'Pager Gradient', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'pagenavi_gradient_hover' => Array(
				'title' => __( 'Pager Gradient Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'meta_tags_color' => Array(
				'title' => __( 'Meta Tags Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'meta_tags_color_hover' => Array(
				'title' => __( 'Meta Tags Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'pagenavi_shadow' => Array(
				'title' => __( 'Pager Shadow', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'boxshadow',
			),
		)
	),

	/* Before Footer */
	'before_footer' => Array(
		'title' => 'Before footer',
		'params' => Array(
			'before_footer_bg' => Array(
				'title' => __( 'Before Footer Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'before_footer_bg_image' => Array(
				'title' => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'upload',
			),
			'before_footer_bg_repeat' => Array(
				'title' => __( 'Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_repeat',
			),
			'before_footer_bg_attachment' => Array(
				'title' => __( 'Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_attachment',
			),
			'before_footer_bg_position' => Array(
				'title' => __( 'Background Position', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'before_footer_caption_color' => Array(
				'title' => __( 'Before Footer Caption Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'before_footer_caption_tagline_color' => Array(
				'title' => __( 'Before Footer Tagline Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'before_footer_caption_font_size' => Array(
				'title' => __( 'Before Footer Caption Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'before_footer_caption_font_weight' => Array(
				'title' => __( 'Before Footer Caption Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'before_footer_text_color' => Array(
				'title' => __( 'Before Footer Text Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'before_footer_text_font_size' => Array(
				'title' => __( 'Before Footer Text Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'before_footer_link_color' => Array(
				'title' => __( 'Before Footer Link Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'before_footer_link_color_hover' => Array(
				'title' => __( 'Before Footer Link Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'before_footer_icon_color' => Array(
				'title' => __( 'Before Footer Icon Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'before_footer_icon_color_hover' => Array(
				'title' => __( 'Before Footer Icon Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* Footer */
	'footer' => Array(
		'title' => 'Footer',
		'params' => Array(
			'footer_bg' => Array(
				'title' => __( 'Footer Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'footer_bg_image' => Array(
				'title' => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'upload',
			),
			'footer_bg_repeat' => Array(
				'title' => __( 'Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_repeat',
			),
			'footer_bg_attachment' => Array(
				'title' => __( 'Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'background_attachment',
			),
			'footer_bg_position' => Array(
				'title' => __( 'Background Position', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'footer_text_color' => Array(
				'title' => __( 'Footer Text Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'footer_link_color' => Array(
				'title' => __( 'Footer Link Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'footer_link_color_hover' => Array(
				'title' => __( 'Footer Link Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'footer_icon_color' => Array(
				'title' => __( 'Footer Icon Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'footer_icon_color_hover' => Array(
				'title' => __( 'Footer Icon Colour Hover', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

	/* Woocommerce */
	'woocommerce' => Array(
		'title' => 'WooCommerce',
		'params' => Array(
			'woo_onsale_bg' => Array(
				'title' => __( 'On-Sale Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_onsale_color' => Array(
				'title' => __( 'On-Sale Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_onsale_font_size' => Array(
				'title' => __( 'On-Sale Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'woo_onsale_font_weight' => Array(
				'title' => __( 'On-Sale Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'woo_product_title_color' => Array(
				'title' => __( 'Product Title Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_product_title_font_size' => Array(
				'title' => __( 'Product Title Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'woo_product_title_font_weight' => Array(
				'title' => __( 'Product Title Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'woo_product_price_color' => Array(
				'title' => __( 'Product Price Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_product_price_font_size' => Array(
				'title' => __( 'Product Price Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'woo_product_price_font_weight' => Array(
				'title' => __( 'Product Price Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'woo_product_old_price_color' => Array(
				'title' => __( 'Product Old Price Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_product_old_price_font_size' => Array(
				'title' => __( 'Product Old Price Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'woo_product_old_price_font_weight' => Array(
				'title' => __( 'Product Old Price Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'woo_product_add_to_cart_font_size' => Array(
				'title' => __( 'Product add To Cart Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'woo_product_add_to_cart_font_weight' => Array(
				'title' => __( 'Product add To Cart Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'woo_table_header_gradient' => Array(
				'title' => __( 'Table Header Gradient', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'gradient',
			),
			'woo_table_header_color' => Array(
				'title' => __( 'Table Header Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_table_header_font_size' => Array(
				'title' => __( 'Table Header Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'woo_table_header_font_weight' => Array(
				'title' => __( 'Table Header Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'woo_table_odd_row_bg' => Array(
				'title' => __( 'Table Odd Row Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_table_even_row_bg' => Array(
				'title' => __( 'Table Even Row Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_table_cell_color' => Array(
				'title' => __( 'Table Cell Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
			'woo_table_cell_font_size' => Array(
				'title' => __( 'Table Cell Font Size', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'text',
			),
			'woo_table_cell_font_weight' => Array(
				'title' => __( 'Table Cell Font Weight', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'font_weight',
			),
			'woo_payment_bg' => Array(
				'title' => __( 'Payment Background Colour', MISS_ADMIN_TEXTDOMAIN ),
				'type' => 'color',
			),
		)
	),

);


			$out .= '<div class="input-append  miss_option_set edit_skin_save btn-grou1p">';
			$out .= '<div class="edit_skin_button btn btn-success"><span class="save_manage_skin">' . __( 'Save Style', MISS_ADMIN_TEXTDOMAIN ) . '</span></div> ';
			$out .= '<div class="edit_skin_button btn btn-warning pull-right"><span class="cancel_skin_edit"><i class="fa-icon-remove"></i> ' . __( 'Reset Style', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';
			$out .= '<div class="ajax_feedback_save_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';
			$out .= '</div>';

			$miss_css_stored = get_option( MISS_SKINS, false );
			//print_r( $miss_css_stored );

			foreach( $miss_admin_css_model as $group ) {

				$out .= '<div class="miss_option_set toggle_option_set section_toggle"><h5 class="option_toggle caption trigger" style="color: #6c7caa; cursor: pointer; font-size: 16px;"><a><i class="fa-icon-adjust"></i> ' . sprintf( __( '%s', MISS_ADMIN_TEXTDOMAIN ), $group['title'] ) . '</a></h5><div class="toggle_container" style="display: none">';
				if ( isset( $group['params'] ) && is_array( $group['params'] ) ) {
					foreach( $group['params'] as $key => $option ) {
						if ( isset( $option['title'] ) ) {
							$default = (isset( $miss_css_stored ) && isset( $miss_css_stored[$key] ) ) ? $miss_css_stored[$key] : $miss_css_model[$key];
							$value = Array(
								'option' => $option['type'],
								'title' => sprintf( __( '%s', MISS_ADMIN_TEXTDOMAIN ), $option['title'] ),
								'name' => $key,
								'default' => $default,
								'value' => $default,
								'target' => $option['type']
							);
							if( method_exists( $this, $value['option'] ) ) {
								if ( isset($value['properties']) && is_array( $value['properties'] ) ) {
									$custom_property = Array();
									foreach ( $value['properties'] as $property_key => $property_value ) {
										//Removing -misskit prefix from CSS property
										$custom_property[] = str_replace( MISS_KIT, "", $property_value );
									}
									$value['properties'] = $custom_property;
								}
								$out .= $this->$value['option'](array(
									'name' => $value['title'],
									'id' => 'skin][' . $value['name'],
									'default' => $value['value'],
									'alpha' => true,
									'target' => $value['option'],
									'properties' => $value['name']
								));
							}
						}
					} 
				}
				$out .= '</div><!-- /End Toggle Content -->';
				$out .= '</div><!-- /End Toggle -->';
			}
			$out .= '<div class="input-append  miss_option_set edit_skin_save btn-grou1p">';
			$out .= '<div class="edit_skin_button btn btn-success"><span class="save_manage_skin">' . __( 'Save Style', MISS_ADMIN_TEXTDOMAIN ) . '</span></div> ';
			$out .= '<div class="edit_skin_button btn btn-warning pull-right"><span class="cancel_skin_edit"><i class="fa-icon-remove"></i> ' . __( 'Reset Style', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';

			$out .= '<div class="ajax_feedback_save_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';

			$out .= '</div>';
			$out .= '<input type="hidden" name="_miss_save_manage_skin" value="Theme" />';
			$out .= '<div class="miss_option_set toggle_option_set section_toggle"><h5 class="option_toggle caption trigger" style="color: #6c7caa; cursor: pointer; font-size: 16px;"><a><i class="fa-icon-adjust"></i> ' . __( 'Developers Property List', MISS_ADMIN_TEXTDOMAIN ) . '</a></h5><div class="toggle_container" style="display: none">';

				$out .= '<table class="table table-bordered table-striped">';
				$out .= '<thead><tr><th>' . __( 'Key', MISS_ADMIN_TEXTDOMAIN ) . '</th><th>' . __( 'Value', MISS_ADMIN_TEXTDOMAIN ) . '</th></tr></thead>';
				$out .= '<tbody>';

				foreach( $miss_css_model as $property => $value ) {
					$out .= '<tr>';
					$out .= '<td width="60%">' . $property . '</td>';
					if ( !is_array( $value ) ) {
						$out .= '<td width="40%">' . $value . '</td>';
					} else {
						$out .= '<td width="40%">' . implode( ':',$value ) . '</td>';
					}
					$out .= '</tr>';
					
				}			

			$out .= '</div><!-- /End Toggle Content -->';
			$out .= '</div><!-- /End Toggle -->';

			$out .= '</tbody>';
			$out .= '</table>';
		} else {
			$out .= '<div style="text-align: center">' . __('Unable to loade CSS model. Please reinstall theme.', MISS_ADMIN_TEXTDOMAIN ) . '</div>';
		}

		$out .= '</div>';
		
		return $out;
	}
		
	/**
	 *
	 */
	function filter_results( $m1,$m2,$m3,$m4,$m5,$m6,$post_styles ) {
		$post_key = str_replace( '-', '_', sanitize_title( $m2 ) );
		$post_styles[$post_key] = ( isset( $post_styles[$post_key] ) ) ? $post_styles[$post_key] : '';
		
		$replace_value = ( empty( $post_styles[$post_key] ) ) ? $m5 : '';
		
		$orginal_value = preg_split( '/(\s)*?(!important)?;([^:]*):*(\s)*(url\()*|^([^:]*):*(\s)*(url\()*/', $m5 );
		$properties = preg_split( '/:([^;]*);/', $m5 );

		if( is_array( $post_styles[$post_key] ) ) {
			$i=0;
			array_pop( $orginal_value );
			array_shift( $orginal_value );
			error_reporting(0);
			foreach( $post_styles[$post_key] as $key => $value ) {
				if( ( $orginal_value[$i] && $value ) && ( strpos( $orginal_value[$i], $value ) !== false ) && ( strpos( $orginal_value[$i], '@' ) !== false ) ) {
					$replace_value .= '/*' . $key . ':' . ( strpos( $key, 'image' ) !== false && strpos( $value, 'none' ) === false ? 'url(' . $value . ')' : $value ) . '@;*/';
				} else {
					$replace_value .= $key . ':' . ( strpos( $key, 'image' ) !== false && strpos( $value, 'none' ) === false ? 'url(' . $value . ')' : $value ) . ';';
				}
				$i++;
			}
			
		} else {
			if( !empty( $post_styles[$post_key] ) ) {
				$properties[0] = str_replace( '/*', '', $properties[0] );
				
				if(  ( strpos( $orginal_value[1], $post_styles[$post_key] ) !== false ) && ( strpos( $orginal_value[1], '@' ) !== false ) )
					$replace_value = '/*' . $properties[0] . ':' . ( strpos( $properties[0], 'image' ) !== false && strpos( $post_styles[$post_key], 'none' ) === false ? 'url(' . $post_styles[$post_key] . ')' : $post_styles[$post_key] ) . '@;*/';
				else
					$replace_value = $properties[0] . ':' . ( strpos( $properties[0], 'image' ) !== false && strpos( $post_styles[$post_key], 'none' ) === false ? 'url(' . $post_styles[$post_key] . ')' : $post_styles[$post_key] ) . ';';
			}
		}
		
		if( $m2 == 'Color Scheme' )
			$this->colorscheme = $post_styles[$post_key];
		
		return $m1.$m2.$m3.$m4. stripslashes( $replace_value ) .$m6;
	}
	
	/**
	 *
	 */
	function options_output() {
		$out = '';
		
		$parse_options = $this->parse_options();
		
		if( empty( $parse_options ) ) {
			$out .= '<div class="skin_generator_' . $this->load_type . ' skin_generator_option_set">';
			
			$out .= '<div class="miss_option_set skin_generator_error">' . $this->json_response( $args = array( 'type' => 'error_loading', 'name' => $this->stylesheet ) );
			$out .= '<div class="edit_skin_button"><span class="button cancel_skin_edit">' . __( 'Return to Skin Manager', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';
			
			$out .= '</div>';
			$out .= '</div>';
			
			return $out;
		}
		
		$out .= '<div class="skin_generator_' . $this->load_type . ' skin_generator_option_set">';
		
		foreach( $parse_options as $key => $value ) {
			if( !empty( $value['option'] ) ) {
				if( method_exists( $this, $value['option'] ) ) {
					if ( isset($value['properties']) && is_array( $value['properties'] ) ) {
						$custom_property = Array();
						foreach ( $value['properties'] as $property_key => $property_value ) {
							//Removing -misskit prefix from CSS property
							$custom_property[] = str_replace( MISS_KIT, "", $property_value );
						}
						$value['properties'] = $custom_property;
					}
					$out .= $this->$value['option'](array(
						'name' => $value['title'],
						'id' => $value['name'],
						'default' => $value['value'],
						'target' => $value['option'],
						'properties' => $value['properties']
					));
				}
			}
		}
		
		if( $this->load_type == 'create' ) {
			$out .= '<div class="miss_option_set create_skin_save">';
			
			$out .= '<div class="miss_option_header">' . __( 'Save Skin As', MISS_ADMIN_TEXTDOMAIN ) . '</div>';

			$out .= '<div class="input-append inline miss_option_set btn-group">';

			$out .= '<input name="custom_skin_name" type="text" id="custom_skin_name" class="miss_textfield" onkeyup="missAdmin.fixField(this);">';

			$out .= '<div class="edit_skin_button btn"><span class="save_custom_skin">' . __( 'Save Skin', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';

			$out .= '<div class="ajax_feedback_save_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';

			$out .= '</div>';
			
			$out .= '</div>';
		}
		
		if( $this->load_type == 'manage' ) {
			$out .= '<div class="input-append inline miss_option_set edit_skin_save btn-group">';
			$out .= '<input name="custom_skin_name" type="text" id="custom_skin_name" class="miss_textfield" onkeyup="missAdmin.fixField(this);">';
			$out .= '<div class="edit_skin_button btn"><span class="save_custom_skin">' . __( 'Save As New Skin', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';
			$out .= '<div class="edit_skin_button btn"><span class="save_manage_skin">' . __( 'Save Skin', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';
			$out .= '<div class="edit_skin_button btn"><span class="cancel_skin_edit">' . __( 'Cancel Edit', MISS_ADMIN_TEXTDOMAIN ) . '</span></div>';

			$out .= '<div class="ajax_feedback_save_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';

			$out .= '</div>';
			$out .= '<input type="hidden" name="_miss_save_manage_skin" value="' . $this->stylesheet . '" />';
		}
		
		$out .= '</div>';
		
		return $out;
	}
	

	/**
	 *
	 */
	function rgb2hex($rgb) {
		$hex = "#";
		$hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);
		return $hex; // returns the hex value including the number sign (#)
	//}
	}
	
	
	/**
	 *
	 */

	function parse_options() {

		$input_data = $this->get_contents( $this->stylesheet );
		
		if( empty( $input_data ) )
			return false;

		# preg match css styles
		preg_match_all( '%(\n.*?)(/\*:.*?)(.*?)(\*/?.*?)(\s*)([^}^~]*)(~?|}?.*?)%is', $input_data, $matches );

		$names = $matches[3];
		$values = str_replace( '@', '', $matches[6] );
		$declaration = preg_replace( '/\n|\{/', '', $matches[1] );

		$css_options = array();
		
		for( $i=0; $i<count($matches[0]); $i++ ) {

			$key = str_replace( '-', '_', sanitize_title( $names[$i] ) );
			
			$css_options[$key]['name'] = $key;
			$css_options[$key]['title'] = $names[$i];
			$css_options[$key]['declaration'] = $declaration[$i];
			$css_options[$key]['value'] = preg_split( '/(\s)*?(!important)?;([^:]*):*(\s)*(url\()*|^([^:]*):*(\s)*(url\()*/', $values[$i] );
			$css_options[$key]['properties'] = preg_split( '/:([^;]*);/', preg_replace( '%/\*|\*/%', '', $values[$i] ) );
			
			if( is_array( $css_options[$key]['value'] ) )
				array_pop( $css_options[$key]['value'] );
				
			if( is_array( $css_options[$key]['properties'] ) )
				array_pop( $css_options[$key]['properties'] );
			
			if( is_array( $css_options[$key]['value'] ) )
				array_shift( $css_options[$key]['value'] );
			
			foreach( $this->patterns as $option => $pattern ) {
				if( strpos( $names[$i], $pattern['patterns'] ) !== false )
					$css_options[$key]['option'] = $option;
			}
		}

		return $css_options;
	}
	
	/**
	 *
	 */
	public function get_contents( $filename ) {

	    if( array_key_exists( $filename, miss_wpmu_style_option() ) ) {
	        global $blog_id;
	        $uri = get_blog_option( $blog_id,'fileupload_url') . '/styles/skins/' . md5( THEME_NAME ) . 'muskin_' . $filename;
			$dir = $_SERVER['DOCUMENT_ROOT'] . '/' . get_blog_option( $blog_id, 'upload_path' ) . '/styles/skins/' . md5( THEME_NAME ) . 'muskin_' . $filename;
	    } else {
	        $uri = THEME_ASSETS . '/styles/skins/' . $filename;
	        $dir = THEME_ASSETS_DIR . '/styles/skins/' . $filename;
	    }

	    # Use curl if it exists
	    if (function_exists('curl_init')) {

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $uri);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	        $contents = curl_exec($ch);
	        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	        curl_close($ch);

	        # Read from database if there is a bad response
	        $bad_responses = array( '400', '401', '403', '404', '0' );
	        if ( in_array( $http_code, $bad_responses ) ) {
	            $skin_name = str_replace('.css', '', $filename );
	            $content = get_option( MISS_SKINS );
	            if( !empty( $content[$skin_name] ) ) {
	                return miss_decode( $content[$skin_name] );

	            # If we still don't have any content fopen css file and get contents
	            } elseif ( $fh_input = @fopen($dir, 'r') ) {

	                $input_data = fread($fh_input, filesize($dir));
	                fclose($fh_input);

	                # Return content if response is good
	                if ( $input_data )
	                    return $input_data;
	                else
	                    return false;
	            }

	        }

	        # Return content if response is good
	        if ( $contents ) {
	            return $contents;

	        } else {

	            # If we still don't have any content read from the database
	            $skin_name = str_replace('.css', '', $filename );
	            $content = get_option( MISS_SKINS );
	            if( !empty( $content[$skin_name] ) ) {
	                return miss_decode( $content[$skin_name] );

	            # If we still don't have any content fopen css file and get contents
	            } elseif ( $fh_input = @fopen($dir, 'r') ) {

	                $input_data = fread($fh_input, filesize($dir));
	                fclose($fh_input);

	                # Return content if response is good
	                if ( $input_data )
	                    return $input_data;
	                else
	                    return false;
	            }

	        }

	    # If curl is not installed fopen css file and get contents
	    } elseif ( $fh_input = @fopen($dir, 'r') ) {
	        $input_data = fread($fh_input, filesize($dir));
	        fclose($fh_input);

	        # Return content if response is good
	        if ( $input_data ) {
	            return $input_data;

	        } else {

	            # If we still don't have any content read from the database
	            $skin_name = str_replace('.css', '', $filename );
	            $content = get_option( MISS_SKINS );
	            if( !empty( $content[$skin_name] ) )
	                return miss_decode( $content[$skin_name] );
	            else
	                return false;
	        }

	    } else {
	        # Read from database
	        $skin_name = str_replace('.css', '', $filename );
	        $content = get_option( MISS_SKINS );
	        if( !empty( $content[$skin_name] ) )
	            return miss_decode( $content[$skin_name] );
	        else
	            return false;
	    }
	}
	
	/**
	 *
	 */
	function file_export( $export_file ) {
		$skin_zip = $this->stylesdir . '/skin_zip/';
		
		# check if styles folder is writable
		if( !miss_is_styles_writable() )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported', 'name' => $export_file ) ) );
			
		# make skin_zip folder to create zip
		if ( !wp_mkdir_p( $skin_zip ) )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported', 'name' => $export_file ) ) );
			
		# check if skin_zip folder is writable, if not try to chmod
		if( !miss_is_writable_dir( $skin_zip ) ) {
			if( !@chmod( $skin_zip, 0777) )
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported', 'name' => $export_file ) ) );
		}
		
		# get stylesheet contents
		if( $this->get_contents( $export_file ) )
			$input_data = $this->get_contents( $export_file );
		else
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported_2', 'name' => $export_file ) ) );
		
		# Set artificially high memory_limit

		# preg match all RGB colours

		# preg match all image urls
		preg_match_all( '/url\(([^\)]*)\)/', $input_data, $matches );
		
		# loop through all matches and create $images path string array
		$images = array();
		for( $i=0; $i<count($matches[1]); $i++ ) {
			
			$image_filter = $this->image_filter( $matches[1][$i], $export = true );
			
			if( isset( $image_filter['directory'] ) )
				$images[$i]['directory'] = $image_filter['directory'];
				
			if( isset( $image_filter['url'] ) )
				$images[$i]['url'] = $image_filter['url'];
		}
		
		# if $images array !empty loop thourgh and move to skin_zip
		if( !empty( $images ) ) {
			require_once( THEME_ADMIN_CLASSES . '/get-image.php' );
			$get_image = new GetImage;
			$get_image_error = array();
			$images_to_zip = array();
			
			foreach( $images as $image ) {
				
				# if we have a dir path first try and copy image
				if( !empty( $image['directory'] ) ) {
					$path_parts = pathinfo( $image['directory'] );
					if( @copy( $image['directory'], $skin_zip . $path_parts['basename'] ) ) {
						$images_to_zip[$path_parts['basename']] = $skin_zip . $path_parts['basename'];
						@chmod( $skin_zip . $path_parts['basename'], 0000666 );
						unset( $image['url'] );
					}
				}
				
				# get image
				if( !empty( $image['url'] ) ) {
					
					$path_parts = pathinfo( $image['url'] );
					$get_image->source = $image['url'];
					$get_image->save_to = $skin_zip;
					
					# Use curl if it exists
					if ( (function_exists('curl_init')) && ( !ini_get( 'safe_mode' ) ) && ( !ini_get( 'open_basedir' ) ) ) {
						if( $get_image->download('curl') ) {
							$images_to_zip[$path_parts['basename']] = $skin_zip . $path_parts['basename'];
							unset( $image['url'] );
						}
						
					# Use gd if it exists
					} elseif ( function_exists('gd_info') ) {
						if( $get_image->download('gd') ) {
							$images_to_zip[$path_parts['basename']] = $skin_zip . $path_parts['basename'];
							unset( $image['url'] );
						}
						
					# Use fread
					} else {
						if( $get_image->download('fread') ) {
							$images_to_zip[$path_parts['basename']] = $skin_zip . $path_parts['basename'];
							unset( $image['url'] );
						}
					}
				}
				
				if( !empty( $image['url'] ) )
					$get_image_error[] = $image['url'];
			}
		}
		
		# zip file name
		$zip_name = str_replace( '.css', '', $export_file );
		
		# preg_replace new image path in stylesheet if $images_to_zip !empty
		if( !empty( $images_to_zip ) ) {
			foreach( $images_to_zip as $image => $val ) {
				$new_path = 'url(' . $zip_name . '/' . $image;
				$patterns = "/url\((.*\/)$image/";
				$input_data = @preg_replace( $patterns, $new_path, $input_data );
			}
		}
		
		# write new image paths to stylesheet
		$css_writable = true;
		
		define( 'PCLZIP_TEMPORARY_DIR', $skin_zip );
		# create zip file
		if( $css_writable ) {
			if(!class_exists('PclZip'))
				require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
				
			
			$archive = new PclZip( $skin_zip . $zip_name . '.zip' );
			$v_list = $archive->create( $skin_zip . $export_file, PCLZIP_OPT_REMOVE_ALL_PATH );
			
			if( $v_list != 0 ) {
				# if $images_to_zip array !empty add images to zip
				if ( ( $v_list != 0 ) && ( !empty( $images_to_zip ) ) ) {
					$archive = new PclZip( $skin_zip . $zip_name . '.zip');
				  	$v_list = $archive->add( $images_to_zip, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_ADD_PATH, $zip_name );
				
					# error adding images to zip
					if ($v_list == 0) {
						die("Error : ".$archive->errorInfo(true));
						$get_image_error = array_merge( (array)$get_image_error, array_keys( $images_to_zip ) );
					}
				}
				
			# couldn't create zip file
			} else {
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported_2', 'name' => $export_file ) ) );
			}
			
		# couldn't write to css file
		} else {
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported', 'name' => $export_file ) ) );
		}
		
		# if $get_image_error !empty
		if( !empty( $get_image_error ) ) {
			foreach( $get_image_error as $image ) {
				$path_parts = pathinfo( $image );
				
				if( $path_parts['basename'] != 'none' ) {
					$image_error[] = '&quot;' . $path_parts['basename'] . '&quot;';
				}
			}
			
			if( !empty( $image_error ) )
				$return_zip['message'] = $this->json_response( $args = array( 'type' => 'not_exported_img', 'image_error' => $image_error ) );
				$return_zip['image_error'] = true;
		}
		
		$return_zip['dl_skin'] = THEME_JS_INIT . '/dl-skin.php';
		$return_zip['zip'] = $skin_zip . $zip_name . '.zip';
		$return_zip['rmdir'] = $skin_zip;
		$return_zip['success'] = true;
		
		return $return_zip;
	}
	
	/**
	 * 
	 */
	public static function skin_upload() {
			
		$allowed_ext = array( 'zip' );
		$size_limit = 50 * 1024 * 1024;
		
		if( is_multisite() ) {
			global $blog_id;
			if( $blog_id != 1 )
				$stylesdir = $_SERVER['DOCUMENT_ROOT'] . '/' . get_blog_option( $blog_id, 'upload_path' ) . '/styles/skins';
			else
				$stylesdir = THEME_STYLES_DIR . '/skins';
				
		} else {
			$stylesdir = THEME_STYLES_DIR . '/skins';
		}
		
		/**
		 * Handle file uploads via XMLHttpRequest
		 */
		if ( isset( $_GET['qqfile'] ) ) {
			
			if( !miss_is_styles_writable() )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
			
			# Return error if there's no content length
			if( isset( $_SERVER["CONTENT_LENGTH"] ) )
				$filesize = (int)$_SERVER["CONTENT_LENGTH"];
			else
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
				
			# Return error if file is to large
			if ( $filesize > $size_limit )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
			
			$pathinfo = pathinfo( $_GET['qqfile'] );
	        $filename = $pathinfo['filename'];
	        $ext = $pathinfo['extension'];
			$path = $stylesdir . '/' . $filename . '.' . $ext;
			
			# Return error if file isn't a zip
			if( !in_array( strtolower( $ext ), $allowed_ext ) )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'invalid_ext' ) ) ) );
			
			# Return error if file already exists
			if( @is_file( $stylesdir . '/' . $filename . '.css' ) )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_exists', 'name' => $filename ) ) ) );
			
			$input = fopen( 'php://input', 'r' );
	        $temp = tmpfile();
	        $real_size = stream_copy_to_stream( $input, $temp );
	        fclose( $input );
			
			# Check that the file sizes match
	        if ( $real_size != $filesize )
	            self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
			
			# Write zip to styles folder
			$file_uploaded = true;
			if ( !$fh = @fopen( $path, 'w' ) ) $file_uploaded = false;
			fseek( $temp, 0, SEEK_SET );
			if ( !@stream_copy_to_stream( $temp, $fh ) ) $file_uploaded = false;
			if ( $fh ) fclose( $fh );
			
			if( $file_uploaded )
				self::json_process( array( 'success' => true ) );
			else
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
				

		/**
		 * Handle file uploads via regular form post (uses the $_FILES array)
		 */
        } elseif ( isset( $_FILES['qqfile'] ) ) {
	
			$filesize = $_FILES['qqfile']['size'];

			# Return error if file is to large
			if ( $filesize > $size_limit )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $filename ) ) ) );
			
			$pathinfo = pathinfo( $_FILES['qqfile']['name'] );
	        $filename = $pathinfo['filename'];
	        $ext = $pathinfo['extension'];
			$path = $stylesdir . '/' . $filename . '.' . $ext;
			
			# Return error if file isn't a zip
			if( !in_array( strtolower( $ext ), $allowed_ext ) )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'invalid_ext' ) ) ) );
			
			# Return error if file already exists
			if( @is_file( $stylesdir . '/' . $filename . '.css' ) )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_exists', 'name' => $filename ) ) ) );
		    
			if( !@move_uploaded_file ($_FILES['qqfile']['tmp_name'], $path ) )
	            self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $filename ) ) ) );
			else
				self::json_process( array( 'success' => true ) );
            
        } else {
	
            self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => '' ) ) ) );

        }

	}
	
}

?>
