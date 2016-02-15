<?php
/**
 * Deny hack attempt
 */
if ( !ABSPATH ) {
	header('HTTP/1.1 403 Forbidden');
	die( __('Accedd Denied', MISS_TEXTDOMAIN) );
}

/**
 * Generate Cache
 */
function miss_generate_css_cache( $css ) {
	if( $css ) {
		if ( !isset($_GET['skin']) && file_exists( THEME_SKIN_CACHE ) && filesize( THEME_SKIN_CACHE ) > 16  && THEME_ENABLE_SKIN_CACHE == true ) {
			header( "Location: " . THEME_SKIN_CACHE_URI );
					
		} else {
			if ( !isset($_GET['skin']) && THEME_ENABLE_SKIN_CACHE == true ) {
				@file_put_contents( THEME_SKIN_CACHE, str_replace( array("\n","\t",'\"'), array("", "",'"'), $css ) );
			}
			echo $css . "\n";
		}
	}
}

function miss_ms_rgba($rgba = 'rgba(255,255,255,1)') {
        $hex = "#";
        $color = explode("rgba",$rgba);
        $color = str_replace(array("(",")",";"," "), array("","","",""), $color[1]);
        $el = explode(",",$color);
        $hex.= str_pad(dechex($el[0]), 2, "0", STR_PAD_LEFT);
        $hex.= str_pad(dechex($el[1]), 2, "0", STR_PAD_LEFT);
        $hex.= str_pad(dechex($el[2]), 2, "0", STR_PAD_LEFT);
        return $hex;
}

function miss_get_css( $value = '' ) {
	if ( isset( $value ) && !empty( $value ) || is_array( $value )  )  { 
		global $miss_css_model;
		//Check if caching mode is enabled
		if ( !isset($_GET['skin']) && THEME_ENABLE_SKIN_DB == true ) {
			$miss_css_stored = get_option( MISS_SKINS, false );
		} else {
			$miss_css_stored = ''; //REMOVE IT	
		}

		if ( isset( $_GET ) && isset( $_GET['skin'] ) ) {
			//if ( file_exists( 'models/' . $_GET['skin'] . '.php' ) ) {
				include_once( 'models/' . $_GET['skin'] . '.php' );
			//}
		} else if ( @file_exists( __DIR__ . '/models/' . $_GET['cssgenerator'] . '.model.php') ) {
			include_once( 'models/' . $_GET['cssgenerator'] . '.model.php' );
		}
		if ( is_array( $value ) ) {
			foreach( $value as $key => $sep ) {
				if ( !empty( $sep ) && $miss_css_stored && isset( $miss_css_stored[$key] ) && isset( $miss_css_stored[$key][$sep] ) ) {
					return $miss_css_stored[$key][$sep];
				}
			}
		} else {
			if ( !isset( $miss_css_model ) ) {
				include( 'models/ux.model.php' );
			}

			return ( $miss_css_stored &&
				isset( $miss_css_stored[$value] ) )
			? $miss_css_stored[$value]
			: ( (
				isset( $miss_css_model ) &&
				isset( $miss_css_model[$value] )
			) ? $miss_css_model[$value] : '' );

			// return miss_get_setting( 'miss_skin-' . $value ) ? miss_get_setting( 'miss_skin-' . $value ) : ( $miss_css_model[$value] ? $miss_css_model[$value] : '' );
		}

	} else {
		return '';
	}
}

function miss_css_gradient( $atts ) {
	if ( isset( $atts['disabled'] ) && $atts['disabled'] == true ) {
		return false;
	}
	if ( !isset( $atts['orientation'] ) || ( isset( $atts['orientation'] ) && empty( $atts['orientation'] ) ) ) {
		$atts['orientation'] = 'top';
	}
	if ( !isset( $atts['l1'] ) ) {
		$atts['l1'] = 0;
	}
	if ( !isset( $atts['l2'] ) ) {
		$atts['l2'] = 100;
	}
	if ( !isset( $atts['start'] ) ) {
		$atts['start'] = '';
	}
	if ( !isset( $atts['end'] ) ) {
		$atts['end'] = '';
	}
	return 'background-image: linear-gradient(' . $atts['orientation'] . ', ' . $atts['start'] . ' ' . $atts['l1'] . '%, ' . $atts['end'] . '  ' . $atts['l2'] . '%);background-image: -o-linear-gradient(' . $atts['orientation'] . ', ' . $atts['start'] . ' ' . $atts['l1'] . '%, ' . $atts['end'] . '  ' . $atts['l2'] . '%);background-image: -moz-linear-gradient(' . $atts['orientation'] . ', ' . $atts['start'] . ' ' . $atts['l1'] . '%, ' . $atts['end'] . '  ' . $atts['l2'] . '%);background-image: -webkit-linear-gradient(' . $atts['orientation'] . ', ' . $atts['start'] . ' ' . $atts['l1'] . '%, ' . $atts['end'] . '  ' . $atts['l2'] . '%);background-image: -ms-linear-gradient(' . $atts['orientation'] . ', ' . $atts['start'] . ' ' . $atts['l1'] . '%, ' . $atts['end'] . '  ' . $atts['l2'] . '%);background-image: -webkit-gradient(linear,' . $atts['orientation'] . ',color-stop(' . $atts['l1']/100 . ', ' . $atts['start'] . '),color-stop(' . $atts['l2']/100 . ', ' . $atts['end'] . ')); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="' . miss_ms_rgba( $atts['start'] ) . '", endColorstr="' . miss_ms_rgba( $atts['end'] ) . '",GradientType=0 );';
}
function miss_css_shadow( $atts = array('h' => 0, 'v' => 0, 'spread' => 0, 'blur' => 0, 'color' => 'rgba(0,0,0, 0)', 'inset' => false ) ) {
	$default = array('h' => 0, 'v' => 0, 'spread' => 0, 'blur' => 0, 'color' => 'rgba(0,0,0, 0)', 'inset' => false );
	extract( wp_parse_args( $atts, $default ) );
	if ( $inset == 'true' ) {
		$inset = ' inset';
	} else {
		$inset = '';
	}
	$css  = '';
	$css .= '-moz-box-shadow:' . $h . ' ' . $v . ' ' . $spread . ' ' . $blur . ' ' . $color . $inset . ';';
	$css .= '-webkit-box-shadow:' . $h . ' ' . $v . ' ' . $spread . ' ' . $blur . ' ' . $color . $inset . ';';
	$css .= '-o-box-shadow:' . $h . ' ' . $v . ' ' . $spread . ' ' . $blur . ' ' . $color . $inset . ';';
	$css .= '-ms-box-shadow:' . $h . ' ' . $v . ' ' . $spread . ' ' . $blur . ' ' . $color . $inset . ';';
	$css .= '-k-box-shadow:' . $h . ' ' . $v . ' ' . $spread . ' ' . $blur . ' ' . $color . $inset . ';';
	$css .= 'box-shadow:' . $h . ' ' . $v . ' ' . $spread . ' ' . $blur . ' ' . $color . $inset . ';';
	return $css;

}
/*
function miss_css_property_background ( $color = false, $image = false, $repeat = false, $position = false, $attachment = false, $size = false ) {
	$prop = Array( 'properties' => Array() );
		if ( $color )
			$prop['properties']['background-color'] = $color;

		if ( $image )
			$prop['properties']['background-image'] = $image;

		if ( $repeat )
			$prop['properties']['background-repeatrepeat'] = $repeat;

		if ( $position )
			$prop['properties']['background-position'] = $position;

		if ( $attachment )
			$prop['properties']['background-attachment'] = $attachment;

		return $prop;

	
}
*/


if ( isset( $_GET['cssgenerator'] ) && !empty( $_GET['cssgenerator'] ) ) {
	header("Content-type: text/css", true);
	//echo '/* CSS Generator  */';
	$generated = $start_time = microtime(true);
	$css = $_GET['cssgenerator'];
	if ( file_exists( dirname( __FILE__ ) . '/models/' . $_GET['cssgenerator'] . '.model.php') ) {
		include( 'sheets/' . $_GET['cssgenerator'] . '.php' );
	} else if ( file_exists( dirname( __FILE__ ) . '/sheets/' . $css . '.php' ) ) {
		include( 'sheets/' . $css . '.php' );
	} else {
		echo '/* Nothing To Do */';
	}
	die('/* CSS Generator Execution Time: ' . floatval( ( microtime(true) - $generated ) ) . ' seconds */');
}