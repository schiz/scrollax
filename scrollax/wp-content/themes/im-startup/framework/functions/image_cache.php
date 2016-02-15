<?php
/**
 * Deny hack attempt
 */
if ( !ABSPATH ) {
	header('HTTP/1.1 403 Forbidden');
	die( __('Accedd Denied', MISS_TEXTDOMAIN) );
}


/**
 *
 */
function miss_get_remote_file_date( $uri ) {
	$header = @get_headers($uri, 1);
	if (stristr($header[0], '200')) {
		foreach($header as $key => $value) {
			if(strtolower( trim( $key ) )=="last-modified") {
				if ( !ini_get('date.timezone') ) {
					date_default_timezone_set('Europe/London');
				}
				if ( @strtotime( $value ) ) {
					$timestamp = @strtotime( $value );
					return $timestamp;
				} else {
					return 0;
				}
			}
		}
	}
}


/**
 *
 */
function miss_get_local_file_date( $file ) {

	if ( file_exists( $file ) ) {
		if ( !ini_get('date.timezone') ) {
			date_default_timezone_set('Europe/London');
		}
	    return filemtime( $filename );
	} else {
		return 0;
	}
}


/**
 *
 */
function miss_get_post_image( $args = array() ) {
	global $irish_framework_params;
	$defaults = array(
		'index' => '',
		'img_class' => '',
		'pid' => false,
		'src' => false,
		'column' => '',
		'thumb' => '',
		'width' => false,
		'height' => false,
		'link_class' => '',
		'video' => '',
		'link_to' => '',
		'no_link' => false,
		'noimage' => true,
		'preview_info_wrap' => true,
		'preload' => false,
		'prettyphoto' => true,
		'video_controls' => false,
		'echo' => true,
		'featured_post' => false
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	if ( $pid ) {
		$post_thumbnail_id = get_post_thumbnail_id( $pid );
	} else {
		$post_thumbnail_id = get_post_thumbnail_id();
	}

	$auto_img = miss_get_setting( 'auto_img' );

	if ( !is_string( $src ) ) {
		if ( ( empty( $post_thumbnail_id ) ) && ( $auto_img[0] ) ) {
			$image = miss_image_by_attachment();
			if( $image ) {
				$image[0] = $image['url'];
				$alt = $image['alt'];
			} else {
				if ( !empty( $placeholder ) && $noimage == true ) {
					//$image[0] = THEME_IMAGES_ASSETS . '/general/no-thumbnail.png';]
					return false;
				}
			}
			
		} elseif ( empty( $post_thumbnail_id ) && !empty( $placeholder ) ) {
			if ( !is_single() && $noimage == true ) {
				//$image[0] = THEME_IMAGES_ASSETS . '/general/no-thumbnail.png';]
				return false;
			}
		} elseif ( empty( $post_thumbnail_id ) ) {
			$image[0] = '';
			if ( !is_single() && $noimage == true ) {
				//$image[0] = THEME_IMAGES_ASSETS . '/general/no-thumbnail.png';
				return false;
			}
		}
		if( !empty( $post_thumbnail_id ) ) {
			$image = wp_get_attachment_image_src( $post_thumbnail_id, '' );
		}
	} else {
		$image[0] = $src;
	}

	if ( !isset($link_to) || $link_to == '' ) {
		$link_to = ( 
			!empty( $args['video'] ) ? 
				get_permalink() // $args['video'] 
				: 
				( ( is_single() && isset ( $image[0] ) ) ?	
					$image[0] 
					: 
					get_permalink() 
				)
		);
	}

	$video_src = ( get_post_meta( get_the_ID(), '_featured_video', true ) != false ) ? get_post_meta( get_the_ID(), '_featured_video', true ) : '';
	$preview_info_wrap = ( isset($args['preview_info_wrap']) ) ? $args['preview_info_wrap'] : true;
	$prettyphoto = ( isset( $prettyphoto ) ? get_post_type() . '_' . get_the_ID() : ( ( is_single() || is_page() ) && empty( $placeholder ) ? get_post_type() . '_' . get_the_ID() : false ) );
	$image_tags = miss_post_image_tags( $post_thumbnail_id, get_the_ID() );
	$img_args = array(
		'src' => $image[0],
		'video_src' => $video_src,
		'alt' => ( isset( $alt ) ? $alt : $image_tags['alt'] ),
		'title' => $image_tags['title'],
		'height' => $height,
		'width' => $width,
		'class' => '',
		'link_to' => $link_to,
		'no_link' => ( isset( $no_link ) ) ? $no_link : false,
		'preview_info_wrap' => ( isset( $preview_info_wrap ) ? $preview_info_wrap : false ),
		'prettyphoto' => $prettyphoto,
		'link_class' => $link_class,
		'preload' => $preload,
		'portfolio_full' => ( !empty( $portfolio_full ) ? true : false ),
		'video_controls' => $video_controls,
		'wp_resize' => ( !empty( $wp_resize ) ? true : true ),
	);
    if($get_src)
    {
        $img_args['get_src'] = true;
    }
	
	$post_img = miss_display_image( $img_args );

	$offset = $irish_framework_params->layout['images']['image_padding'];
	$load_width = $width + $offset;
	$load_height = $height + $offset;
	
	///$out = '<div class="services-image ' . $img_class . '"' . ( !empty( $inline_width ) ? ' data-style="width:' . $load_width . 'px;"' : '' ) . '>';
	
	/*if( empty( $placeholder ) ) {
		ob_start();
		miss_post_image_begin();
		$out .= ob_get_clean();
	}*/

	$out = $post_img;
	
    /*
	if( empty( $placeholder ) ) {
		ob_start();
		miss_post_image_end( $args );
		$out .= ob_get_clean();
	}*/
	
	//$out .= '</div>';
	if ($img_class != "na") {
		if ( !empty( $echo ) )
			echo $out;
		else
			return $out;
	}
}


/**
 *
 */
function miss_image_by_attachment() {
	$attachments = get_children(array(
		'post_parent' => get_the_ID(),
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'numberposts' => 1
	));
	
	if ( empty( $attachments ) )
		return false;
		
	foreach ( $attachments as $id => $attachment ) {
		$image = wp_get_attachment_image_src( $id, '' );
		$image_tags = miss_post_image_tags( $id );
		$alt = $image_tags['alt'];
	}
	
	return array( 'url' => $image[0], 'alt' => $alt );
}


/**
 *
 */
function miss_post_image_tags( $image_id, $post_id = '' ) {
	
	# Check to is if attachment image has alt
	$alt = '';
	$file_name = '';
	if( is_numeric( $image_id ) ) {
		$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		$alt = esc_attr(trim( $alt ));
	}
	
	# If no alt generate from file name
	if( empty( $alt ) ) {
		$file = get_attached_file( $image_id );
		$info = pathinfo( $file );
		if( isset( $info['extension'] ) )
			$file_name =	basename( $file, '.' . $info['extension'] );
		
		if( !empty( $file_name ) )
			$alt = esc_attr(ucwords(str_replace( '-', ' ', str_replace( '_', ' ', $file_name ) )));
	}
	
	# Generate title tag from post title
	$title = '';
	
	if( !empty( $post_id ) )
		$title = esc_attr( apply_filters( 'the_title', get_post_field( 'post_title', $post_id ) ) );
		
	return array( 'title' => $title, 'alt' => $alt );
}


/**
 *
 */
function miss_display_image( $args = array() ) {
	if ( !defined('THEME_HIRES') ) {
		define( 'THEME_HIRES', ( ( miss_get_setting('hires') == 'enabled') ? 2 : 1 ) );
	}

	global $wp_query, $irish_framework_params;
	//print_r($args);
	extract( $args );
	if ( ( empty( $src ) && empty( $video_src ) && $noimage == true ) || ( empty( $src ) && empty( $video_src ) && !is_single() ) ) {
		return '<img src="' . miss_wp_image( THEME_IMAGES_ASSETS . '/general/no-thumbnail.png' , $width, $height ) . '" />';
	}
	if ( empty( $src ) && empty( $video_src ) ) {
		return;
	}
	if ( empty( $src ) && !empty( $video_src ) ) 
	{
		$out = miss_video( array( 'url' => $video_src, 'width' => $width, 'height' => $height, 'parse' => true, 'video_controls' => $video_controls ) );
	} else {
		$image = $src;

		//Trying to build array from string
		// $image_path = explode( $_SERVER['SERVER_NAME'], $image );
		$image_path = explode( home_url( '/' ), $image );

		//For local images
		if( !empty( $image_path[1] ) ) {
			// In this case we'll define image ABSOLUTE PATH
			// $image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
			$image_path = ABSPATH . $image_path[1];
			$image_info = @getimagesize( $image_path );
		} else {
			// In this case we'll define iamge URI
			if ( ini_get( 'allow_url_fopen' ) ) {
				$image_path = $image;
				$image_info = @getimagesize( $image );
			} else if( function_exists('curl_init') ) {
				//if allow_url_fopen is off trying to reach curl
				$image_headers = get_headers( $image, 1 );
				if ( $image_headers['Content-Type'] == "image/jpeg" ) {
					$remote_extrnsion = ".jpg";
				}

				if ( $image_headers['Content-Type'] == "image/gif" ) {
					$remote_extrnsion = ".gif";
				}

				if ( $image_headers['Content-Type'] == "image/png" ) {
					$remote_extrnsion = ".png";
				}

				if ( is_writable( THEME_CACHE ) ) {
					if ( !file_exists( THEME_CACHE . '/downloads' ) ) {
						if ( @mkdir( THEME_CACHE . '/downloads' ) ) {
							// Crete safe index
							@touch( THEME_CACHE . '/downloads/index.html' );
						}
					}
					$image_downloads = THEME_CACHE . '/donwloads';
				} else {
					$image_downloads = THEME_CACHE;
				}

				// Trying to reach local file
		    	if ( file_exists( $image_downloads . '/' . md5( $image ) . $remote_extension ) ) {
					$image_path = $image_downloads . '/' . md5( $image ) . $remote_extension;
					$image_info = @getimagesize( $image_path );
		    	} else {
					if ( isset( $remote_extension ) && !empty( $remote_extension ) ) {
						$image_downloads .= '/' . md5( $image ) . $remote_extension;

						$ch = curl_init ( $image );
						curl_setopt($ch, CURLOPT_HEADER, 0);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
						$image_raw_data = curl_exec($ch);
						curl_close ($ch);

						//Unlinking if file exists
						if(file_exists($image_downloads)){
						    unlink($image_downloads);
						}
						$fp = fopen($image_downloads,'x');
						fwrite($fp, $image_raw_data);
						fclose($fp);

						$image_path = $image_downloads;
						$image_info = @getimagesize( $image_path );

					}
				}
			} else {

			}

		}

		# If we cannot get the image locally, try for an external URL
		if ( empty( $image_info ) )
			$image_info = @getimagesize( $image );
		
		if( miss_video( $args = array( 'url' => $image ) ) ) {
			$src = THEME_IMAGES_ASSETS . '/movie_thumb.png';	
		} else if ( ( empty( $image_info ) && $noimage == true ) || ( empty( $image_info ) && !is_single() ) ) {
			$src = THEME_IMAGES_ASSETS . '/general/no-thumbnail.png';
		}
		if ( empty( $image_info ) && $noimage == false ) {
			return;
		}
		# Auto crop width
		if( empty( $no_preload_img ) && ( empty( $width ) || !is_numeric( $width ) ) ) {
			$width = ( !empty( $width ) ) ? $width : '';
			$width = miss_auto_width( array( 'width' => $width, 'get_width' => $image_info[0] ) );
		}
		
		$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : $image_info[0];
		$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : $image_info[1];

		
		$image_resize = miss_get_setting( 'image_resize' );
		$image_alt = '';
		if( isset( $disable_resize ) ) {
			$image = $src;
		} elseif( !empty( $wp_resize ) ) {
			$image = miss_wp_image( $src, $width, $height );

			if ( THEME_HIRES == 2 ) {
				$image_alt .= ' data-retina="' . miss_wp_image( $src, ($width * THEME_HIRES), ($height * THEME_HIRES) ) . '"';
			}
	/* mark for changes */

		} elseif( !empty( $width ) and !empty( $height ) ) {
			$image = miss_wp_image( $src, $width, $height );
			if ( THEME_HIRES == 2 ) {
				$image_alt .= ' data-retina="' . miss_wp_image( $src, ($width * THEME_HIRES), ($height * THEME_HIRES) ) . '"';
			}
	/* END mark for changes */
		
		} elseif( ( miss_get_setting( 'image_resize_type' ) == 'timthumb' ) && ( !$image_resize[0] ) && ( miss_is_cache_writable() ) && ( $image_info[0] != $width || $image_info[1] != $height ) ) {
			$image = THEME_URI . '/framework/scripts/timthumb/thumb.php?src=' . miss_wpmu_image( $src ) . '&amp;w=' . $width . '&amp;h=' . $height . '&amp;zc=1&amp;q=100';
		
		} else {
			$image = $src;
		}
		$img_width = ( ( $width ) ? ' width="' . esc_attr( $width ) . '"' : '' );
		$img_height = ( ( $height ) ? ' height="' . esc_attr( $height ) . '"' : '' );
		
		$class = ( ( !empty( $class ) ) ? ' class="' . esc_attr( $class ) . ' image-resize w"' : ' class="image-resize w"' );
		$title = ( ( !empty( $title ) ) ? esc_attr( $title ) : '' );
		$alt = ( ( !empty( $alt ) ) ? esc_attr( $alt ) : '' );
		//echo $image;
        if($get_src)
        {
            $out = esc_url( $image );
        }
        else
        {
            $out = '<img' . $class . ' src="' . esc_url( $image ) . '" title="' . $title . '"' . $image_alt . ' alt="' . $alt . '"' /*. $img_width . $img_height*/ . ' />';
        }
	}
	/*if( isset( $preview_info_wrap ) && $preview_info_wrap != false ){
		$prettyphoto = ( $prettyphoto != false ) ? '[' . $prettyphoto . ']' : false;
		if ( $video_src != '' ) {
			$link = $video_src;
			$icon = 'im-icon-movie';
		} else {
			$link = $src;
			$icon = 'im-icon-zoom-in';
		}
		$out .= '<div class="preview_info_wrap">';
		if ( is_single() ) {
			$out .= '<a class="controls img single" href="' . esc_url( $link ) . '" rel="prettyPhoto' . $prettyphoto . '">';
			$out .= '<i class="' . $icon . '"></i>';
			$out .= '</a> <!-- /.controls -->';
		} else {
			$out .= '<a class="controls img" href="' . esc_url( $link ) . '" rel="prettyPhoto' . $prettyphoto . '">';
			$out .= '<i class="' . $icon . '"></i>';
			$out .= '</a> <!-- /.controls -->';
			$out .= '<a class="controls link" href="' . esc_url( $link_to ) . '" title="' . $title . '">';
			$out .= '<i class="im-icon-link"></i>';
			$out .= '</a> <!-- /.controls -->';
		}
		$out .= '</div>';
	};*/
	
	$link_style = '';
	
	# Image preloader
	$loader_img = '';
	/*if( !empty( $preload ) ) {
		$offset = $irish_framework_params->layout['images']['image_padding'];
		$load_width = $width + $offset;
		$load_height = $height + $offset;

		$no_preload_img = "1";
		
		if( empty( $no_preload_img ) ) {
			$link_style = ' style="background:no-repeat center center;display:block;position:relative;height:' .
			esc_attr( $load_height ) . 'px;width:' . esc_attr( $load_width ) . 'px;' .
			( $image_resize[0] ? 'overflow:hidden;' : '' ) . '"';
			
			$loader_img = '<div class="miss_preloader"><img src="' .
			esc_url( THEME_IMAGES_ASSETS . '/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.gif);background-position:left center; width:16px; height:16px;"></div>';
		}
		if( empty( $link_to ) && empty( $no_preload_img ) ) {
			$out = $loader_img . '<div class="plain post-image data-image">' . $out . '</div>';
		} else {
			$out = '<div class="plain post-image data-image">' . $out . '</div>';
		}
        
	}*/
	
	
	$effect = ( isset( $effect ) ) ? $effect : '';
	
	# Image links to
	/*if ( isset( $no_link ) && $no_link == true ) { 
		$link_class = ( !empty( $link_class ) ) ? ' class="' . $link_class . '"' : '';
		
		$group = ( !empty( $group ) ) ? '[' . $group . ']' : '';
		$rel = ( !empty( $prettyphoto ) && is_single() ) ? ' rel="prettyPhoto' . $group . '"' : '';
		
		$out = '<div ' . $link_class . $link_style . '>' . $out . $loader_img . '</div>';
	} */
/*
	elseif ( !empty( $link_to ) && $effect != 'border' ) {
		$link_class = ( !empty( $link_class ) ) ? ' class="' . $link_class . '"' : '';
		
		$group = ( !empty( $group ) ) ? '[' . $group . ']' : '';
		$rel = ( !empty( $prettyphoto ) && is_single() ) ? ' rel="prettyPhoto' . $group . '"' : '';
		
		$out = '<a' . $rel . ' href="' . esc_url( $link_to ) . '" title="' . $title . '"' . $link_class . $link_style . '>' . $out . $loader_img . '</a>';
	}
*/
	# Image effects
	/*if( !empty( $effect ) && $effect != 'framed' ) {
		$image = $out;
		$out = '';
		
		if( $effect == 'border' ) {
			if( trim( $align ) == 'aligncenter' ) {
				$out .= '<div class="' . trim( $align ) . '">';
				$aligncenter = true;
				$align = '';
			}
				
			$out .= '<span class="transparent_frame' . $align . '">' . $image;
			$out .= '<a href="' . esc_url( $link_to ) . '" rel="prettyPhoto">';
			$out .= '<img alt="" src="' . esc_url( THEME_IMAGES . '/shortcodes/transparent.gif' ) . '" style="height:' .
			esc_attr( $height-10 ) . 'px;width:' . esc_attr( $width-10 ) . 'px;" class="transparent_border">';
			
			$out .= '</a>';
			$out .= '</span>';
			
			if( isset( $aligncenter ) == 'aligncenter' )
				$out .= '</div>';
		}

		if( $effect == 'shadow' || $effect == 'framed_shadow' || $effect == 'reflect_shadow' ) {
			if( trim( $align ) == 'aligncenter' ) {
				$out .= '<div class="' . trim( $align ) . '">';
				$aligncenter = true;
				$align = '';
			}
			
			$out .= '<span class="shadow_frame' . $align . '">' . $image;
			$out .= '<img alt="" src="' . esc_url( THEME_IMAGES . '/shortcodes/image_shadow.png' ) . '" style="width:' .
			esc_attr( $width ) . 'px;' . ( $effect == 'reflect_shadow' ? 'top:' . -floor($width*0.128) . 'px;' : '' ) . '" class="image_shadow">';
			
			$out .= '</span>';
			
			if( isset( $aligncenter ) == 'aligncenter' )
				$out .= '</div>';
		}
		
		if( $effect == 'reflect' ) {
			if( trim( $align ) == 'aligncenter' ) {
				$out .= '<div class="' . trim( $align ) . '">';
				$aligncenter = true;
				$align = '';
			}
			
			$out .= $image;
			
			if( isset( $aligncenter ) == 'aligncenter' )
				$out .= '</div>';
		}
	}*/
	return $out;
}


/**
 *
 */
function miss_wp_image( $image, $width = '', $height = '' ) {
	if( empty( $image ) )
		return;
		
	global $irish_framework_params;
	$miss_wp_upload_dir = wp_upload_dir();

	$image_path = explode( home_url( '/' ), $image );
	$image_path = ABSPATH . $image_path[1];
	
	if ( preg_match( "((https|ftp|http)\:\/\/)", $image ) && function_exists( 'ini_get' ) && ini_get( 'allow_url_fopen' ) ) {

		$file_signature = miss_get_remote_file_date( $image );

	} else {

		$file_signature = miss_get_local_file_date( $image );

	}

	$image_info = pathinfo( $image_path );
	
	$image_sizes = @getimagesize( $image_path );
	
	# If we cannot get the image locally, try for an external URL
	if ( empty( $image_sizes ) )
		$image_sizes = @getimagesize( $image );
		
	if( miss_video( $args = array( 'url' => $image ) ) )
		$image = THEME_IMAGES_ASSETS . '/movie_thumb.png';
		
	elseif( empty( $image_sizes ) )
		$image = THEME_IMAGES_ASSETS . '/no-image.png';
		
	if( !miss_is_cache_writable() )
		return $image;
		
	$image_sizes[0] = ( !empty( $image_sizes[0] ) ) ? $image_sizes[0] : '';
	$image_sizes[1] = ( !empty( $image_sizes[1] ) ) ? $image_sizes[1] : '';
	
	# Auto crop width
	if( empty( $width ) || !is_numeric( $width ) ) {
		$width = miss_auto_width( array( 'width' => $width, 'get_width' => $image_sizes[0] ) );
	}
		
	$width = ( !empty( $_POST['img_width'] ) ? $_POST['img_width'] : ( !empty( $width ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : $image_sizes[0] ) );
	$height = ( !empty( $_POST['img_height'] ) ? $_POST['img_height'] : ( !empty( $height ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : $image_sizes[1] ) );
	
	$image_src[0] = THEME_CACHE_URI . '/' . basename( $image );
	$image_src[1] = $image_sizes[0];
	$image_src[2] = $image_sizes[1];
	
	$extension = '.'. $image_info['extension'];
	
	$no_ext_path = THEME_CACHE . '/' . $image_info['filename'];

	// Safe image cache
	$safe_file_name = md5( $image_info['filename'] . '-' . $width . 'x' . $height . '-' . $file_signature );
	$safe_file_path = '';

	// Build safe directory structure
	if ( is_writable( THEME_CACHE ) ) {
		$path_levels = array(
			1 => substr( $safe_file_name, 0,1 ),
		);

		// Level #1
		if ( is_array( $path_levels ) ) {
			if ( !file_exists( THEME_CACHE . '/' . $safe_file_path . '/' . $path_levels[1] ) ) {
				if ( @mkdir( THEME_CACHE . '/' . $safe_file_path . '/' . $path_levels[1] ) ) {
					$safe_file_path .= $path_levels[1] ;
					@touch( THEME_CACHE . '/' . $safe_file_path . '/index.html' );
				} else {
					$path_levels = false;
				}
			} else {
				$safe_file_path .= $path_levels[1] ;
			}
		}
	}
	$cropped_img_path = THEME_CACHE . '/' . $safe_file_path . '/' . $safe_file_name . $extension;
	$cropped_img_uri = $safe_file_path . '/' . $safe_file_name . $extension;

	# checking if the file size is larger than the target size
	# if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		# the file is larger, check if the resized version already exists
		if ( file_exists( $cropped_img_path ) ) {
			$image = str_replace( basename( $image_src[0] ), $cropped_img_uri, $image_src[0] );
		}

		if ( !file_exists( $cropped_img_path ) ) {
			$new_img_obj = wp_get_image_editor( $image_path );
			
			// If there's an error lets try WordPress's ABSPATH instead of $_SERVER['DOCUMENT_ROOT']
			if( is_wp_error( $new_img_obj ) ) {
				$new_img_obj = wp_get_image_editor( $image_path );
				if ( is_wp_error( $new_img_obj ) && function_exists( 'image_resize' ) ) {
					$cropped_img_path = image_resize( $image_path, $width, $height, $crop = true, $suffix = null, $dest_path = $safe_file_path );
					if ( is_wp_error( $new_img_obj ) ) {
						return false;
					}
				} else {
					$new_img_obj->resize($width, $height, true);
					$new_img_obj->save( $cropped_img_path );
				}
			} else {
				$new_img_obj->resize($width, $height, true);
				$new_img_obj->save( $cropped_img_path );
			}
			$new_img_path = $cropped_img_path;
			$new_img_size = getimagesize( (string) $cropped_img_path );
			$image = str_replace( basename( $image_src[0] ), $cropped_img_uri, $image_src[0] );
		}
	}
	
	return $image;
}

/**
 *
 */
function miss_wp_image_resize() {
	if( ( miss_ajax_request() ) && ( isset( $_POST['ajax_image_resize_url'] ) ) ) {
		
		$nonce = $_POST['j5M5601'];
		
		if( !wp_verify_nonce( $nonce, home_url() ) ) die('Security check');



		$image = stripslashes( $_POST['ajax_image_resize_url'] );
		
		if( !miss_is_cache_writable() )
		{
			$data = array('url' => $image );
			$echo = json_encode( $data );
			
		}
		else
		{
			$data = array('url' => miss_wp_image( $image ) );
			$echo = json_encode( $data );
		}
		
		@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
		echo $echo;

		exit();
	}
}


/**
 *
 */
function miss_wpmu_image( $src ) {
	if(is_multisite()){
		global $blog_id;
		if(is_subdomain_install()){
			if ( defined( 'DOMAIN_MAPPING' ) ){
				if(function_exists('get_original_url')){ //WordPress MU Domain Mapping
					return site_url().'/'.str_replace(str_replace(get_original_url('siteurl'),site_url(),get_blog_option($blog_id,'fileupload_url')),get_blog_option($blog_id,'upload_path'),$src);
				}else { //VHOST and directory enabled Domain Mapping plugin
					global $dm_map;
					if(isset($dm_map)){
						static $orig_urls = array();
						if ( ! isset( $orig_urls[ $blog_id ] ) ) {
							remove_filter( 'pre_option_siteurl', array(&$dm_map, 'domain_mapping_siteurl') );
							$orig_url = get_option( 'siteurl' );
							$orig_urls[ $blog_id ] = $orig_url;
							add_filter( 'pre_option_siteurl', array(&$dm_map, 'domain_mapping_siteurl') );
						}
						return site_url().'/'.str_replace(str_replace($orig_urls[$blog_id],site_url(),get_blog_option($blog_id,'fileupload_url')),get_blog_option($blog_id,'upload_path'),$src);
					}
				}
			}
			return site_url().'/'.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$src);
		}else{
			if ( defined( 'DOMAIN_MAPPING' ) ){
				if(function_exists('get_original_url')){ //WordPress MU Domain Mapping
					return site_url().'/'.str_replace(str_replace(get_original_url('siteurl'),site_url(),get_blog_option($blog_id,'fileupload_url')),get_blog_option($blog_id,'upload_path'),$src);
				}
			}
			$curSite =	get_current_site(1);
			$fileupload_url = get_blog_option($blog_id,'fileupload_url');
			if( strpos( $src, $fileupload_url ) !== false )
				return $curSite->path.str_replace($fileupload_url,get_blog_option($blog_id,'upload_path'),$src);
			else
				return str_replace(str_replace( 'files', '', $fileupload_url ) ,'/',$src);
		}
	}else{
		return $src;
	}
}

?>
