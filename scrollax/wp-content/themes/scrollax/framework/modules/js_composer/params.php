<?php
/**
 * Visual Composer Params
 * @package MissFramework
 * @since 1.7
 */

if ( !function_exists( 'im_wbp_range' ) && function_exists( 'add_shortcode_param' ) ) :
/**
 * Range
 */
function im_wbp_range($param, $param_value) {
	$dependency = vc_generate_dependencies_attributes($param);
	$value = __( $param_value, "js_composer" );
	$value = $param_value;
	$html = '<div class="im-range-option im-range-input"><input name="'.$param['param_name'].'" min="'.$param['min'].'" max="'.$param['max'].'" step="'.$param['step'].'" class="range-input-selector range-input-composer wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="range" value="'.$value.'" ' . $dependency . '/><span class="value">' . $value . '</span><span class="unit">' . $param['unit'] . '</span></div>';

	return $html;
	}

add_shortcode_param('range', 'im_wbp_range', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/range.js');

endif;

if ( !function_exists( 'im_wbp_number' ) && function_exists( 'add_shortcode_param' ) ) :
/**
 * Number
 */
function im_wbp_number($param, $param_value) {
	$dependency = vc_generate_dependencies_attributes($param);
	$value = __( $param_value, "js_composer" );
	$value = $param_value;

//  "admin_enqueue_js" => IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/temp.js',

	$html = '<div class="im-range-option im-range-input"><input name="'.$param['param_name'].'" min="'.$param['min'].'" max="'.$param['max'].'" step="'.$param['step'].'" class="range-input-selector range-input-composer wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="number" value="'.$value.'" ' . $dependency . '/> <span class="unit">' . $param['unit'] . '</span></div>';

	return $html;
	}

add_shortcode_param('number', 'im_wbp_number');

endif;


if ( !function_exists( 'im_wbp_textfield' ) && function_exists( 'add_shortcode_param' ) ) :
/**
 * textfield
 */
function im_wbp_textfield($param, $param_value) {
	$dependency = vc_generate_dependencies_attributes($param);
    $value = __( $param_value, "js_composer" );
    $value = $param_value;
    $html = '<input size="80" name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$value.'" ' . $dependency . '/>';
    $margin_bottom = isset( $param['margin_bottom'] ) ? $param['margin_bottom'] : '0';
    $html .= '<div style="margin-bottom:'.$margin_bottom.'px"></div>';

	return $html;
	}

add_shortcode_param('im_textfield', 'im_wbp_textfield');

endif;

if ( !function_exists( 'im_wbp_color_small' ) && function_exists( 'add_shortcode_param' ) ) :
/**
 * Color
 */
function im_wbp_color_small($param, $param_value) {
	$dependency = vc_generate_dependencies_attributes($param);
	$value = __( $param_value, "js_composer" );
	$value = $param_value;
	$html = '<input name="'.$param['param_name'].'" class="color-picker wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="minicolors" value="'.$value.'" ' . $dependency . '/>';
	$margin_bottom = isset( $param['margin_bottom'] ) ? $param['margin_bottom'] : '0';
	$html .= '<div style="margin-bottom:'.$margin_bottom.'px"></div>';
	return $html;
}
add_shortcode_param('im_color_small', 'im_wbp_color_small');

endif;


if ( !function_exists( 'im_wbp_color' ) && function_exists( 'add_shortcode_param' ) ) :
/**
 * Color
 */
function im_wbp_color($param, $param_value) {
	$dependency = vc_generate_dependencies_attributes($param);
	$value = __( $param_value, "js_composer" );
	$value = $param_value;
	$format = $param['format'] ? $param['format'] : 'rgba';
	$html  = '<div class="input-append color bootstrap-colorpicker" data-color="'.$value.'" data-color-format="' . $format . '" ' . $dependency . '/>';
	$html .= '<input type="text" class="color-picker wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" name="'.$param['param_name'].'" value="'.$value.'" data-color-format="' . $format . '" />';
	$html .= '<span class="add-on"><i style="background-color: ' . $value . ';"></i></span>';
	$html .= '</div>';
	$margin_bottom = isset( $param['margin_bottom'] ) ? $param['margin_bottom'] : '0';
	$html .= '<div style="margin-bottom:'.$margin_bottom.'px"></div>';
	return $html;
}
add_shortcode_param('im_color', 'im_wbp_color');

endif;



if ( !function_exists( 'im_wbp_icon' ) && function_exists( 'add_shortcode_param' ) ) :
/**
 * Icons
 */
function im_wbp_icon($param, $param_value) {
	$dependency = vc_generate_dependencies_attributes($param);
	$value = __( $param_value, "js_composer" );
	$value = $param_value;
	$html = "";
	if ( is_admin() ) {
	    //$html .= '<script src="' . IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/icons.js"></script>';
	}

	$html .= '<form class="im-filter-icons" action="#">';
	$html .= '<input autocomplete="off" size="60" placeholder="Search an icon..." type="text" class="page-composer-icon-filter" value="" name="icon-filter-by-name" />';
	$html .= '</form>';
	$html .= '<div class="btn-group" style="width:100%;"><a style="text-decoration: none;" href="#" class="btn im-toggle-icons">' . __('Show Icons', MISS_ADMIN_TEXTDOMAIN ) . '</a><a class="btn disabled im-icon-preview"><i class="' . $value . '"></i></a></div>';
	$html .= '<div class="im-visual-selector im-font-icons-wrapper" style="display: none">';
	if( isset($param['encoding']) && $param['encoding'] == 'true') {
	     foreach ( $param['value'] as $option => $key ) {
	       if($key) {
	      $html .= '<a class="im_icon_selector" href="#" title="Class Name : '.$key.'" rel="'.$key.'"><i class="'.$key.'" ></i></a>';
	        } else {
	            $html .= '<a class="im-no-icon" href="#" rel="">x</a>';
	        }
	      }   
	} else {
	    foreach ( $param['value'] as $option => $key ) {
	    if($key) {
	        $html .= '<a class="im_icon_selector im_' . $key . '" href="#" title="Class: '.$key.'" rel="'.$key.'"><i class="'.$key.'" ></i><span class="hidden">' . $key .'</span></a>';
	        } else {
	            $html .= '<a class="im-no-icon" href="#" rel="">x</a>';
	        }
	    }
	}

	$html .= '<input name="'.$param['param_name'].'" id="'.$param['param_name'].'" class="wpb_vc_param_value '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.$value.'" ' . $dependency . '/>';
	$html .= '</div>';
	return $html;
}
add_shortcode_param( 'im_icon', 'im_wbp_icon', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/icons.js' );

endif;






        // Textfield - input
        // if ( $param['type'] == 'textfield' ) {
        //     $value = __( $param_value, "js_composer" );
        //     $value = $param_value;
        //     $param_line .= '<input size="80" name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$value.'" ' . $dependency . '/>';
        //     $margin_bottom = isset( $param['margin_bottom'] ) ? $param['margin_bottom'] : '0';
        //     $param_line .= '<div style="margin-bottom:'.$margin_bottom.'px"></div>';
        // }

//add_action( 'init', 'miss_js_composer_shortcodes_init' );
