<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImTexthead {

	/**
	 *
	 */
	public static function im_texthead( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Textblock with head', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_texthead',
				'icon' => 'im-icon-trophy-star',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter block title.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Subtitle', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter Subtitle.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'subtitle',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter content.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'texthead_content',
						'type' => 'textarea',
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
			'title'	=> '',
			'subtitle'	=> '',
			'texthead_content'	=> '',
			'animation' => '',
	    ), $atts));
        
        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        }
        
        if ( isset( $image ) && $image != '' ) {
			if ( is_numeric( $image ) ) {
				$image = wp_get_attachment_url( $image );
			}
		}

		$out = '<div class="row text-columns"><section class="span4 article">
                  <hgroup class="article-header">
                    <h3>'.$title.'</h3>
                    <h4>'.$subtitle.'</h4>
                  </hgroup>
                  <article>
                    <p>'.$texthead_content.'</p>
                  </article>
                </section></div>';
            /*$out .= '<div class="content-item span4 display-image small-display ' . $class . $animation . '">
                      <div class="inner-wrapper">
                        <div class="display">
                            <img src="'.$image.'">
                        </div>
                        <div class="discription">
                          <div class="sticker bottom-left" style="background-color: '.$background.'; color: '.$color.';"><span>'.$title_label.'</span></div>
                          <div class="content">
                            <header>
                              <h4>'.$title.'</h4>
                            </header>
                            <article>
                              <p>'.$benefit_content.'</p>
                            </article>
                          </div>
                        </div>
                      </div>
                    </div>';*/
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