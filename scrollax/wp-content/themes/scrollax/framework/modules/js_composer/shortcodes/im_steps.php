<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImsteps {
	
	/**
	 *
	 */

	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}

	public static function im_steps ( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			return array(
		        "name"      => __( "Steps Builder", "js_composer" ),
		        "base"      => "im_steps",
		        "class"     => "im-steps-class",
				'icon'      => "im-icon-arrow-right-6",
				'category'  => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
		        "params"    => array(
		            array(
		                "type" => "textfield",
		                "heading" => __( "Title", "js_composer" ),
		                "param_name" => "title",
		                "value" => "",
		                "description" => __( "Type here caption for this scheme", "js_composer" ),
		            ),

		            array(
		                "type" => "range",
		                "heading" => __( "How Many Steps?", "js_composer" ),
		                "param_name" => "step",
		                "value" => "2",
		                "min" => "2",
		                "max" => "5",
		                "step" => "1",
		                "unit" => 'step',
		                "description" => __( "How many steps do you want to have?", "js_composer" ),
		            ),

		            array(
		                "type" => "colorpicker",
		                "heading" => __( "Container Hover Fill Color", "js_composer" ),
		                "param_name" => "hover_color",
		                "value" => "#202020",
		                "description" => __( "Select container color when mouse over", "js_composer" ),
		            ),


		            array(
		                "type" => "im_icon",
		                "heading" => __( "Step 1 : Icon", "js_composer" ),
		                "param_name" => "icon_1",
		                "width" => 200,
		                "value" => array_flip( miss_get_all_font_icons() ),
		                "encoding" => "false",
		                "description" => __( "Select icon for this step", "js_composer" ),
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => __( "Step 1 : Title", "js_composer" ),
		                "param_name" => "title_1",
		                "value" => "",
		                "description" => __( "Type here caption for this step", "js_composer" ),
		            ),
		            array(
		                "type" => "textarea",
		                "heading" => __( "Step 1 : Description", "js_composer" ),
		                "param_name" => "desc_1",
		                'margin_bottom' => 40,
		                "value" => "",
		                "description" => __( "Type here description for this step", "js_composer" ),
		            ),


		            array(
		                "type" => "im_icon",
		                "heading" => __( "Step 2 : Icon", "js_composer" ),
		                "param_name" => "icon_2",
		                "width" => 200,
		                "value" => array_flip( miss_get_all_font_icons() ),
		                "encoding" => "false",
		                "description" => __( "Select icon for this step", "js_composer" ),
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => __( "Step 2 : Title", "js_composer" ),
		                "param_name" => "title_2",
		                "value" => "",
		                "description" => __( "Type here caption for this step", "js_composer" ),
		            ),
		            array(
		                "type" => "textarea_html",
		                "heading" => __( "Step 2 : Description", "js_composer" ),
		                "param_name" => "desc_2",
		                'margin_bottom' => 40,
		                "value" => "",
		                "description" => __( "Type here description for this step", "js_composer" ),
		            ),


		            array(
		                "type" => "im_icon",
		                "heading" => __( "Step 3 : Icon", "js_composer" ),
		                "param_name" => "icon_3",
		                "width" => 200,
		                "value" => array_flip( miss_get_all_font_icons() ),
		                "encoding" => "false",
		                "description" => __( "Select icon for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => miss_array_int_to_sting( range(3, 5) ),
						),
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => __( "Step 3 : Title", "js_composer" ),
		                "param_name" => "title_3",
		                "value" => "",
		                "description" => __( "Type here caption for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => miss_array_int_to_sting( range(3, 5) ),
						),
		            ),
		            array(
		                "type" => "textarea_html",
		                "heading" => __( "Step 3 : Description", "js_composer" ),
		                "param_name" => "desc_3",
		                'margin_bottom' => 40,
		                "value" => "",
		                "description" => __( "Type here description for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => miss_array_int_to_sting( range(3, 5) ),
						),
		            ),

		            array(
		                "type" => "im_icon",
		                "heading" => __( "Step 4 : Icon", "js_composer" ),
		                "param_name" => "icon_4",
		                "width" => 200,
		                "value" => array_flip( miss_get_all_font_icons() ),
		                "encoding" => "false",
		                "description" => __( "Select icon for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => miss_array_int_to_sting( range(4, 5) ),
						),
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => __( "Step 4 : Title", "js_composer" ),
		                "param_name" => "title_4",
		                "value" => "",
		                "description" => __( "Type here caption for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => miss_array_int_to_sting( range(4, 5) ),
						),
		            ),
		            array(
		                "type" => "textarea_html",
		                "heading" => __( "Step 4 : Description", "js_composer" ),
		                "param_name" => "desc_4",
		                'margin_bottom' => 40,
		                "value" => "",
		                "description" => __( "Type here description for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => miss_array_int_to_sting( range(4, 5) ),
						),
		            ),


		            array(
		                "type" => "im_icon",
		                "heading" => __( "Step 5 : Icon", "js_composer" ),
		                "param_name" => "icon_5",
		                "width" => 200,
		                "value" => array_flip( miss_get_all_font_icons() ),
		                "encoding" => "false",
		                "description" => __( "Select icon for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => array( '5' ),
						),
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => __( "Step 5 : Title", "js_composer" ),
		                "param_name" => "title_5",
		                "value" => "",
		                "description" => __( "Type here caption for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => array( '5' ),
						),
		            ),
		            array(
		                "type" => "textarea_html",
		                "heading" => __( "Step 5 : Description", "js_composer" ),
		                "param_name" => "desc_5",
		                'margin_bottom' => 40,
		                "value" => "",
		                "description" => __( "Type here description for this step", "js_composer" ),
						'dependency' => array(
							'element' => 'step', 
							'value' => array( '5' ),
						),
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", "js_composer" ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" ),
		            ),

		            array(
		                "type" => "textfield",
		                "heading" => __( "Extra class name", "js_composer" ),
		                "param_name" => "el_class",
		                "value" => "",
		                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "js_composer" ),
		            )

		        )
		    );
		}
		$shortcode_id = self::_shortcode_id();
		if ( $shortcode_id == 1 ) {
	        wp_enqueue_style( MISS_PREFIX . '-jsc-steps', IRISHFRAMEWORK_JS_COMPOSER_URI .'/css/im_steps.css' );
	        // wp_enqueue_script( MISS_PREFIX . '-jsc-steps', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_steps.js', array('jquery'), THEME_VERSION, false );
	    }
        extract( shortcode_atts( array(
                    'title' => '',
                    'step' => 4,
                    'hover_color' => '#202020',
                    'icon_1' => '',
                    'title_1' => '',
                    'desc_1' => '',
                    'icon_2' => '',
                    'title_2' => '',
                    'desc_2' => '',
                    'icon_3' => '',
                    'title_3' => '',
                    'desc_3' => '',
                    'icon_4' => '',
                    'title_4' => '',
                    'desc_4' => '',
                    'icon_5' => '',
                    'title_5' => '',
                    'desc_5' => '',
                    'el_class' => '',
                    'width' => '1/1',
                    'animation' => '',
                    'el_position' => '',
                ), $atts ) );

        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = $animation_css = $output = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }
        // $id = mt_rand( 99, 999 );

        if($animation != '') {
            $animation_css = ' im-animate-element ' . $animation . ' ';
        } 
        $output .= '<div class="'.$width.' '.$el_position_css.'">';
        $output .= '<div id="im-process-'.$shortcode_id.'" class="im-process-steps im-shortcode process-steps-'.$step.' '.$el_class.'">';
        if ( !empty( $title ) ) {
            $output .= '<h3 class="im-shortcode im-fancy-title pattern-style im-shortcode-heading" style="text-align:left;"><span>'.$title.'</span></h3>';
        }
        $output .= '<ul>' . "\n";
       for($i=1; $i <= $step; $i++) {
        $output .= '<li>
                        <span class="im-process-icon'.$animation_css.'"><i class="'.${'icon_'.$i}.'"></i></span>
                        <div class="im-process-detail">
                        <h3>'.${'title_'.$i}.'</h3>
                        <p>'.${'desc_'.$i}.'</p>
                        </div>
                    </li>' . "\n";
       }

        $output .= '<div class="clearboth"></div></ul></div></div>' . "\n";
        $output .= '<style type="text/css">
                    #im-process-'.$shortcode_id.' ul li:hover .im-process-icon {background-color:'.$hover_color.';}
                  </style>';

        return $output;
    }

	public static function _options( $method ) {
		return self::$method('generator');
	}

}

endif;
?>