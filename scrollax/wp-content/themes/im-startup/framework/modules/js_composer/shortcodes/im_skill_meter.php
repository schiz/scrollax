<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImSkillmeter {
	
	/**
	 *
	 */
	public static function im_skill_meter ( $atts = null, $content = null ) {
		$classes = array(
			__( 'Fullwidth beginning', MISS_ADMIN_TEXTDOMAIN ) => 'full-width-beginning',
			__( 'Fullwidth ending', MISS_ADMIN_TEXTDOMAIN ) => 'full-width-endind',
			__( 'Limited width beginning', MISS_ADMIN_TEXTDOMAIN ) => 'limited-width-beginning',
		);
        
		if( $atts == 'generator' ) {
			return array(
		        "name"      => __( "Skill Meter", "js_composer" ),
		        "base"      => "im_skill_meter",
				'icon' => 'im-icon-paragraph-left-3',
		        "class"     => "im-skill-meter-class",
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
		        "params"    => array(

		            array(
		                "type" => "textfield",
		                "heading" => __( "Title", "js_composer" ),
		                "param_name" => "title",
		                "value" => "",
		                "description" => __( "What skill are you demonstrating?", "js_composer" )
		            ),
					array(
						'heading' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select animation type.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => $classes,
					),

		            array(
		                "type" => "range",
		                "heading" => __( "Percent", "js_composer" ),
		                "param_name" => "percent",
		                "value" => "50",
		                "min" => "0",
		                "max" => "100",
		                "step" => "1",
		                "unit" => '%',
		                "description" => __( "How many percent would you like to show from this skill?", "js_composer" )
		            ),
		            array(
		                "type" => "colorpicker",
		                "heading" => __( "Progress Bar Background Color", "js_composer" ),
		                "param_name" => "color",
		                "value" => '#dddddd',
		                "description" => __( "Select here color for progress bar background.", "js_composer" )
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
        extract( shortcode_atts( array(
                    'title' => '',
                    'color' => '#dddddd',
                    'width' => '1/1',
                    'el_position' => '',
                    'percent' => 50,
                    'el_class' => '',
                    'class' => ''
                ), $atts ) );

        $width = wpb_translateColumnWidthToSpan( $width );
        $el_position_css = '';
        if ( $el_position != '' ) {
            $el_position_css = $el_position.'-column';
        }

        if ( !is_admin() ) {
	        wp_enqueue_style( MISS_PREFIX . '-jsc-skill-meter', IRISHFRAMEWORK_JS_COMPOSER_URI .'/css/im_skill_meter.css' );
	        wp_enqueue_script( MISS_PREFIX . '-jsc-skill-meter', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_skill_meter.js', array('jquery'), THEME_VERSION, true );
	    }
        
        $out = '<section class="row skill-meter '.$el_class.'">
            <div class="span12">
              <h4 class="header">'.$title.'</h4>
              <div class="meter" data-width="" data-effect="'.$class.'">
                <div class="limiter" style="width: '.$percent.'%;">
                  <div class="progress-line" style="background-color:'.$color.';">
                    <div class="internal counter">0</div>
                    <div class="external counter">0</div>
                  </div>
                </div>
              </div>
            </div>
          </section>';

        /*$out = '<div class="im-skill-meter im-shortcode '.$el_class.'">
                    <div class="im-skill-meter-title">'.$title.'</div>
                    <div class="im-progress-bar">
                        <span class="progress-outer" data-width="'.$percent.'" style="background-color:'.$color.';">
                            <span class="progress-inner"></span>
                        </span>
                    </div>
                    <div class="clearboth"></div>
                    </div>';*/
        return $out;

	}
	public static function _options( $method ) {
		return self::$method('generator');
	}

}

endif;
?>