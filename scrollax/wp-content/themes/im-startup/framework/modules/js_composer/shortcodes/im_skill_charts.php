<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImSkillcharts {
	
	/**
	 *
	 */

	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}

	public static function im_skill_meter_chart ( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			return array(
		        "name"      => __( "Diagram Bar", "js_composer" ),
		        "base"      => "im_skill_meter_chart",
				'icon'      => "im-icon-pie-3",
		        "class"     => "im-skill-meter-chart-class",
				'category'  => __( 'Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
		        "params"    => array(

		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Heading Title", "js_composer" ),
		                "param_name" => "title",
		                "value" => "",
		                "margin_bottom" => 40,
		                "description" => __( "Type here Caption for this chart", "js_composer" )
		            ),
		            array(
		                "type" => "range",
		                "heading" => __( "Skill 1 : Percent", "js_composer" ),
		                "param_name" => "percent_1",
		                "value" => "0",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "Please evaluate your skill in percent", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Skill 1 : Arch Color", "js_composer" ),
		                "param_name" => "color_1",
		                "value" => "#e74c3c",
		                "format" => "rgba",
		                "description" => __( "Select color for this skill", "js_composer" )
		            ),
		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Skill 1 : Name", "js_composer" ),
		                "param_name" => "name_1",
		                "value" => "",
		                "margin_bottom" => 40,
		                "description" => __( "Which skill are you demonstrating. eg : HTML, Design, CSS,...", "js_composer" )
		            ),




		            array(
		                "type" => "range",
		                "heading" => __( "Skill 2 : Percent", "js_composer" ),
		                "param_name" => "percent_2",
		                "value" => "0",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "Please evaluate your skill in percent", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Skill 2 : Arch Color", "js_composer" ),
		                "param_name" => "color_2",
		                "value" => "#8c6645",
		                "format" => "rgba",
		                "description" => __( "Select color for this skill", "js_composer" )
		            ),
		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Skill 2 : Name", "js_composer" ),
		                "param_name" => "name_2",
		                "value" => "",
		                "margin_bottom" => 40,
		                "description" => __( "Which skill are you demonstrating. eg : HTML, Design, CSS,...", "js_composer" )
		            ),





		            array(
		                "type" => "range",
		                "heading" => __( "Skill 3 : Percent", "js_composer" ),
		                "param_name" => "percent_3",
		                "value" => "0",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "Please evaluate your skill in percent", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Skill 3 : Arch Color", "js_composer" ),
		                "param_name" => "color_3",
		                "value" => "#265573",
		                "format" => "rgba",
		                "description" => __( "Select color for this skill", "js_composer" )
		            ),
		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Skill 3 : Name", "js_composer" ),
		                "param_name" => "name_3",
		                "value" => "",
		                "margin_bottom" => 40,
		                "description" => __( "Which skill are you demonstrating. eg : HTML, Design, CSS,...", "js_composer" )
		            ),





		            array(
		                "type" => "range",
		                "heading" => __( "Skill 4 : Percent", "js_composer" ),
		                "param_name" => "percent_4",
		                "value" => "0",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "Please evaluate your skill in percent", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Skill 4 : Arch Color", "js_composer" ),
		                "param_name" => "color_4",
		                "value" => "#008b83",
		                "format" => "rgba",
		                "description" => __( "Select color for this skill", "js_composer" )
		            ),
		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Skill 4 : Name", "js_composer" ),
		                "param_name" => "name_4",
		                "value" => "",
		                "margin_bottom" => 40,
		                "description" => __( "Which skill are you demonstrating. eg : HTML, Design, CSS,...", "js_composer" )
		            ),






		            array(
		                "type" => "range",
		                "heading" => __( "Skill 5 : Percent", "js_composer" ),
		                "param_name" => "percent_5",
		                "value" => "0",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "Please evaluate your skill in percent", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Skill 5 : Arch Color", "js_composer" ),
		                "param_name" => "color_5",
		                "value" => "#d96b52",
		                "format" => "rgba",
		                "description" => __( "Select color for this skill", "js_composer" )
		            ),
		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Skill 5 : Name", "js_composer" ),
		                "param_name" => "name_5",
		                "value" => "",
		                "margin_bottom" => 40,
		                "description" => __( "Which skill are you demonstrating. eg : HTML, Design, CSS,...", "js_composer" )
		            ),





		            array(
		                "type" => "range",
		                "heading" => __( "Skill 6 : Percent", "js_composer" ),
		                "param_name" => "percent_6",
		                "value" => "0",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "Please evaluate your skill in percent", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Skill 6 : Arch Color", "js_composer" ),
		                "param_name" => "color_6",
		                "value" => "#82bf56",
		                "format" => "rgba",
		                "description" => __( "Select color for this skill", "js_composer" )
		            ),
		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Skill 6 : Name", "js_composer" ),
		                "param_name" => "name_6",
		                "value" => "",
		                "margin_bottom" => 40,
		                "description" => __( "Which skill are you demonstrating. eg : HTML, Design, CSS,...", "js_composer" )
		            ),

		            array(
		                "type" => "range",
		                "heading" => __( "Skill 7 : Percent", "js_composer" ),
		                "param_name" => "percent_7",
		                "value" => "0",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "Please evaluate your skill in percent", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Skill 7 : Arch Color", "js_composer" ),
		                "param_name" => "color_7",
		                "value" => "#4ecdc4",
		                "format" => "rgba",
		                "description" => __( "Select color for this skill", "js_composer" )
		            ),
		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Skill 7 : Name", "js_composer" ),
		                "param_name" => "name_7",
		                "value" => "",
		                "margin_bottom" => 40,
		                "description" => __( "Which skill are you demonstrating. eg : HTML, Design, CSS,...", "js_composer" )
		            ),

		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Default Text", "js_composer" ),
		                "param_name" => "default_text",
		                "value" => "Skill",
		                "description" => __( "Type here text that will be displayed when not one skill not be selected.", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Center Circle Background Color", "js_composer" ),
		                "param_name" => "center_color",
		                "value" => "#1e3641",
		                "format" => "rgba",
		                "description" => __( "Select color for center circle background", "js_composer" )
		            ),
		            array(
		                "type" => "im_color",
		                "heading" => __( "Default Text Color", "js_composer" ),
		                "param_name" => "default_text_color",
		                "value" => "#fff",
		                "format" => "rgba",
		                "description" => __( "Select color for text", "js_composer" )
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", "js_composer" ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" )
		            ),

		            array(
		                "type" => "im_textfield",
		                "heading" => __( "Extra class name", "js_composer" ),
		                "param_name" => "el_class",
		                "value" => "",
		                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" )
		            )

		        )
		    );
		}
        extract( shortcode_atts( array(
                    'title' => '',
                    'percent_1' => false,
                    'name_1' => false,
                    'color_1' => false,
                    'percent_2' => false,
                    'name_2' => false,
                    'color_2' => false,
                    'percent_3' => false,
                    'name_3' => false,
                    'color_3' => false,
                    'percent_4' => false,
                    'name_4' => false,
                    'color_4' => false,
                    'percent_5' => false,
                    'color_5' => false,
                    'name_5' => false,
                    'percent_6' => false,
                    'name_6' => false,
                    'color_6' => false,
                    'percent_7' => false,
                    'name_7' => false,
                    'color_7' => false,
                    'center_color' => '',
                    'default_text' => '',
                    'default_text_color' => '#fff',
                    'width' => '1/1',
                    'el_position' => '',
                    'animation' => '',                 
                    'el_class' => '',
                ), $atts ) );

        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = $output = $animation_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        $id = mt_rand(99,999);

		$shortcode_id = self::_shortcode_id();
		if ( $shortcode_id == 1 ) {
	        wp_enqueue_script( 'jquery-raphael');
	        wp_enqueue_style( MISS_PREFIX . '-jsc-skill-meter-chart', IRISHFRAMEWORK_JS_COMPOSER_URI .'/css/im_charts.css' );
	        wp_enqueue_script( MISS_PREFIX . '-jsc-raphael', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/jquery.raphael.min.js', array('jquery'), THEME_VERSION, true );
	        wp_enqueue_script( MISS_PREFIX . '-jsc-raphael-init', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/jquery.raphael.init.js', array('jquery'), THEME_VERSION, true );
	        // wp_enqueue_script( MISS_PREFIX . '-jsc-charts', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_charts.js', array('jquery'), THEME_VERSION, true );
	    }
        if($animation != '') {
            $animation_css = ' im-animate-element ' . $animation . ' ';
        } 


        $output .= '<div class="raphael-chart ' . $el_position_css . '"><div class="im-skill-chart im-shortcode '.$animation_css.$el_class.'">';
        $f = 0;
        for($i = 1; $i <= 7; $i++) {
            if(!empty(${'name_'.$i}) && ${'percent_'.$i} != 0) {
                $f++;
               $output .= '<div class="im-meter-arch">
                               <input type="hidden" class="name" value="'.${'name_'.$i}.'" />
                               <input type="hidden" class="percent" value="'.${'percent_'.$i}.'" />
                               <input type="hidden" class="color" value="'.${'color_'.$i}.'" />
                           </div>';

            }
        }
        $diag_dimension = ($f * 56) + 190;
        $output .= '<div id="im_skill_diagram" class="im_skill_diagram im_skill_diagram_' . $shortcode_id . '" data-dimension="'.$diag_dimension.'" data-circle-color="'.$center_color.'" data-default-text-color="'.$default_text_color.'" data-default-text="'.$default_text.'"></div></div></div>



        ';
        return $output;
    }

	public static function _options( $method ) {
		return self::$method('generator');
	}

}

endif;
?>