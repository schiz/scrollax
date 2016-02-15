<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImMysteps {

	/**
	 *
	 */
	public static function im_mysteps( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'My Steps', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_mysteps',
				'icon' => 'im-icon-trophy-star',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter caption.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'caption',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Number 1', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter number 1.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'step_number1',
						'type' => 'number',
						'value' => '',
					),
					array(
						'heading' => __( 'Step word 1', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter step word 1.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'step_word1',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Number 2', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter number 2.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'step_number2',
						'type' => 'number',
						'value' => '',
					),
					array(
						'heading' => __( 'Step word 2', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter step word 2.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'step_word2',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Number 3', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter number 3.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'step_number3',
						'type' => 'number',
						'value' => '',
					),
					array(
						'heading' => __( 'Step word 3', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter step word 3.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'step_word3',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Number 4', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter number 4.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'step_number4',
						'type' => 'number',
						'value' => '',
					),
					array(
						'heading' => __( 'Step word 4', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter step word 4.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'step_word4',
						'type' => 'textfield',
						'value' => '',
					),
		            array(
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", "js_composer" ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" )
		            ),
			    )
			);
		}

		extract(shortcode_atts(array(
            'caption' => '',
			'step_number1' => '',
			'step_number2' => '',
			'step_number3' => '',
			'step_number4' => '',
			'step_word1' => '',
			'step_word2' => '',
			'step_word3' => '',
			'step_word4' => '',
			'animation' => '',
	    ), $atts));
        
        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        }
        
        
		$out = '<div class="section-steps '.$animation.'">
          <div class="container">
            <div class="row">
              <!--header class="span12 spacial-header">
                <h2 class="caption alig-left size60">'.$caption.'</h2>
              </header-->
              <div class="steps span12">
                <div class="wrapper">
                  <div class="inner-wrapper">
                    <div class="step first">
                      <div class="triangle prev"></div>
                      <div class="triangle next"></div>
                      <div class="step-caption">
                        <span class="count">'.$step_number1.'</span>
                        <span class="desc">'.$step_word1.'</span>
                      </div>
                    </div>

                    <div class="step second">
                      <div class="triangle prev"></div>
                      <div class="triangle next"></div>
                      <div class="step-caption">
                        <span class="count">'.$step_number2.'</span>
                        <span class="desc">'.$step_word2.'</span>
                      </div>
                    </div>

                    <div class="step third">
                      <div class="triangle prev"></div>
                      <div class="triangle next"></div>
                      <div class="step-caption">
                        <span class="count">'.$step_number3.'</span>
                        <span class="desc">'.$step_word3.'</span>
                      </div>
                    </div>

                    <div class="step fourth">
                      <div class="triangle prev"></div>
                      <div class="triangle next"></div>
                      <div class="step-caption">
                        <span class="count">'.$step_number4.'</span>
                        <span class="desc">'.$step_word4.'</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--footer class="span12 spacial-header">
                <h2 class="caption alig-right size60">'.$caption.'</h2>
              </footer-->
            </div>
          </div>
        </div>';
        
		return $out;
	}

	/**
	 *
	 */
	public static function _options( $method ) {
		return self::$method('generator');
	}

}
endif;
?>