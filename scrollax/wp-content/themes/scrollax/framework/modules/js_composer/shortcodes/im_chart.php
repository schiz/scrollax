<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImchart {
	
	/**
	 *
	 */

	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}

	public static function im_chart ( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			return array(
		        "name"      => __( "Radial Chart / Progress Bar", "js_composer" ),
		        "base"      => "im_chart",
				'icon'      => "im-icon-spinner-4",
		        "class"     => "im-chart-class",
				'category'  => __("Theme Short-Codes", MISS_ADMIN_TEXTDOMAIN ),
		        "params"    => array(
		            array(
		                "type" => "range",
		                "heading" => __( "Percent", "js_composer" ),
		                "param_name" => "percent",
		                "value" => "50",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "Select percentage to display on this graph", "js_composer" )
		            ),
		            array(
		                "type" => "colorpicker",
		                "heading" => __( "Bar Color", "js_composer" ),
		                "param_name" => "bar_color",
		                "value" => "#dddddd",
		                "description" => __( "The color of the curcular bar.", "js_composer" )
		            ),
		            array(
		                "type" => "colorpicker",
		                "heading" => __( "Track Color", "js_composer" ),
		                "param_name" => "track_color",
		                "value" => "#ececec",
		                "description" => __( "The color of the track for the bar.", "js_composer" )
		            ),
		            array(
		                "type" => "range",
		                "heading" => __( "Line Width", "js_composer" ),
		                "param_name" => "line_width",
		                "value" => "10",
		                "min" => "1",
		                "max" => "20",
		                "step" => "1",
		                "unit" => 'px',
		                "description" => __( "Width of the bar line.", "js_composer" )
		            ),
		            array(
		                "type" => "range",
		                "heading" => __( "Bar Size", "js_composer" ),
		                "param_name" => "bar_size",
		                "value" => "150",
		                "min" => "1",
		                "max" => "500",
		                "step" => "1",
		                "unit" => 'px',
		                "description" => __( "The Diameter of the bar.", "js_composer" )
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => __( "Content", "js_composer" ),
		                "param_name" => "content_type",
		                "width" => 200,
		                "value" => array(
		                    "Percent" => "percent",
		                    "Icon" => "icon",
		                    "Custom Text" => "custom_text",
		                ),
		                "description" => __( "The content inside the bar. If you choose icon, you should select your icon from below list. if you have selected custom text, then you should fill out the 'custom text' option below.", "js_composer" )
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => __( "Custom Text", "js_composer" ),
		                "param_name" => "custom_text",
		                "value" => "",
		                "description" => __( "Description will appear below each chart.", "js_composer" ),
						'dependency' => array(
							'element' => 'content_type', 
							'value' => array('custom_text'),
						),
		            ),
		            array(
		                "type" => "im_icon",
		                "heading" => __( "Choose Icon", "js_composer" ),
		                "param_name" => "icon",
		                "value" => array_flip( miss_get_all_font_icons() ),
		                "encoding" => "false",
		                "description" => __( "Selset icon for this chart", "js_composer" ),
						'dependency' => array(
							'element' => 'content_type', 
							'value' => array('icon'),
						),
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => __( "Description", "js_composer" ),
		                "param_name" => "desc",
		                "value" => "",
		                "description" => __( "Description will appear below each chart.", "js_composer" )
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", "js_composer" ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" )
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => __( "Extra class name", "js_composer" ),
		                "param_name" => "el_class",
		                "value" => "",
		                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
		            )
		        )
		    );
		}
		$shortcode_id = self::_shortcode_id();
		if ( $shortcode_id == 1 ) {
	        wp_enqueue_style( MISS_PREFIX . '-jsc-skill-meter-chart', IRISHFRAMEWORK_JS_COMPOSER_URI .'/css/im_charts.css' );
	        wp_enqueue_script( MISS_PREFIX . '-jsc-easychart', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/jquery.easychart.js', array('jquery'), THEME_VERSION, false );
	        wp_enqueue_script( MISS_PREFIX . '-jsc-charts', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_charts.js', array('jquery'), THEME_VERSION, true );
	    }

        extract( shortcode_atts( array(
                    'desc' => '',
                    'percent' => '',
                    'bar_color' => '',
                    'track_color' => '',
                    'line_width' => '',
                    'bar_size' => '',
                    'content' => '',
                    'content_type' => '',
                    'icon' => '',
                    'custom_text' => '',
                    'el_class' => '',
                    'width'=> '1/1',
                    'animation' => '',
                    'el_position' => '',
                ), $atts ) );

        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = $animation_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $animation_css = '';
        if($animation != '') {
            $animation_css = ' im-animate-element ' . $animation . ' ';
        } 

        $output = '<div class="'.$width.' '.$animation_css.$el_position_css.'">';
        $output .= '<div class="im-chart" style="width:'.$bar_size.'px;height:'.$bar_size.'px;line-height:'.$bar_size.'px" data-percent="'.$percent.'" data-barColor="'.$bar_color.'" data-trackColor="'.$track_color.'" data-lineWidth="'.$line_width.'" data-barSize="'.$bar_size.'">';
        if ( $content_type == 'icon' ) {
            $icon_size = floor( $bar_size/3 );
            $output .= '<i style="line-height:'.$bar_size.'px; font-size:'.$icon_size.'px" class="'.$icon.'"></i>';
        } elseif ( $content_type == 'custom_text' ) {
            $output .= '<span class="chart-custom-text">'.$custom_text.'</span>';
        } else {
            $output .= '<div class="chart-percent"><span>'.$percent.'</span>%</div>';
        }
        $output .= '</div>';
        $output .= '<div class="im-chart-desc">'.$desc.'</div>';
        $output .= '</div>';
        return $output;
    }

	public static function _options( $method ) {
		return self::$method('generator');
	}

}

endif;
?>