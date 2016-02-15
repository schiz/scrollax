<?php
/**
 * Visual Composer Shortcodes
 * @package MissFramework
 * @since 1.7
 */

if ( !function_exists( 'miss_js_composer_shortcodes_init' ) ) :
/**
 *
 */
function miss_js_composer_shortcodes_init() {
	if ( function_exists('vc_map') ) {
		// init shortcodes for visual composer
		$js_composer_shortcodes = array();
		$dir = dirname(__FILE__) . '/shortcodes/'; //($dir != '') ? '/' . $dir : '';
		if ( is_dir( $dir ) ) {
			if ( $dh = opendir( $dir  ) ) {
				while ( false !== ( $file = readdir( $dh ) ) ) {
					if( $file != '.' && $file != '..' && stristr( $file, '.php' ) !== false )
						$js_composer_shortcodes[] = $file;
				}
				
				closedir( $dh );
			}
		}
		
		asort( $js_composer_shortcodes );
		foreach( $js_composer_shortcodes as $shortcodes ) {
			require_once 'shortcodes/' . $shortcodes;
			$class = 'misscomposer' . ucfirst( preg_replace( '/[0-9-_]/', '', str_replace( '.php', '', $shortcodes ) ) );
			$class_methods = get_class_methods( $class );

			if (isset($class_methods)) {
				foreach( $class_methods as $shortcode ) {
					if( $shortcode[0] != '_') {
						add_shortcode( $shortcode, array( $class, $shortcode ) );
						if( is_admin() ) {
							if ( function_exists( 'vc_map' ) ) {
								vc_map( call_user_func( array( $class, '_options' ), $shortcode ) ); //static method
								//$class = new $class;
								//vc_map( $class::_options( $shortcode ) );
							}
						}
					}
				}
			}
		}
	}
}
endif;


if ( !function_exists( 'miss_js_composer_css_animation' ) ) :

/**
 *
 */

function miss_js_composer_css_animation() {
	return array(
	    "none" => '',
	    "Fade In" => "fade-in",
	    "Scale Up" => "scale-up",
	    "Right to Left" => "right-to-left",
	    "Left to Right" => "left-to-right",
	    "Bottom to Top" => "bottom-to-top",
	    "Top to Bottom" => "top-to-bottom",
	);
}
endif;

if ( !function_exists( 'miss_array_int_to_sting' ) ) :

/**
 *
 */

function miss_array_int_to_sting( $array = array() ) {
	foreach ($array as $key => $value) {
		$convetred_array[$key] = (string) $value;
	}
	return $convetred_array;
}
endif;


if ( !function_exists( 'miss_vc_multiple_params' ) ) :

/**
 *
 */

function miss_vc_multiple_params( $count = 1, $params = array(), $multiplier = 'multiplier' ) {
	$new_params = array();
	$i = 0;
	for ( $j=1; $j <= $count; $j++) {
		foreach( $params as $store => $values) {
			$c = $j+$i;
			foreach( $values as $property => $value ) {
				if ( $property == 'param_name' || $property == 'heading' || $property == 'description' ) {
					$value = str_replace('{{1}}', $j, $value);
				}
				$new_params[$c][$property] = $value;
			}
			$new_params[$c]['dependency'] = array(
				'element' => $multiplier, 
				'value' => miss_array_int_to_sting( range($j, $count) ),
			);
			$i++;
		}
	}
	return $new_params;
}
endif;
