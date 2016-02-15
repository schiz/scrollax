<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImBenefittext {

	/**
	 *
	 */
	public static function im_benefittext( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Benefit with text', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_benefittext',
				'icon' => 'im-icon-trophy-star',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Display Style <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select display style (required for icon box).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Small', MISS_ADMIN_TEXTDOMAIN ) => 'small',
							__( 'Large', MISS_ADMIN_TEXTDOMAIN ) => 'large',
						),
					),
					array(
						'heading' => __( 'Benefit Title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter benefit title.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Benefit Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter benefit content.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'benefit_content',
						'type' => 'textarea',
						'value' => '',
					),
                    array(
						'heading' => __( 'Image', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Upload custom image. Please use hi-res image.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'image',
						'value' => '',
						'type' => 'attach_image',
					),
					array(
						'heading' => __( 'Benefit Title label', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter benefit title label.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title_label',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Benefit Background label', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select benefit background label.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'background',
						'type' => 'colorpicker',
						'value' => '',
					),
					array(
						'heading' => __( 'Benefit Color label', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select benefit color label.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'color',
						'type' => 'colorpicker',
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
			'image'	=> '',
			'class'	=> '',
			'title'	=> '',
			'benefit_content'	=> '',
			'animation' => '',
			'title_label' => '',
            'background' => '',
            'color' => ''
	    ), $atts));
        
        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        }
        
        if ( isset( $image ) && $image != '' ) {
			if ( is_numeric( $image ) ) {
				$image = wp_get_attachment_url( $image );
			}
		}

		$out = '';
        if($class == 'small')
        {
            $out .= '<div class="content-item span4 display-image small-display ' . $class . $animation . '">
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
                    </div>';
        }
        elseif($class == 'large')
        {
            $out .= '<div class="content-item span12 display-image large-display ' . $class . $animation . '">
                      <div class="inner-wrapper">
                        <div class="display">
                            <img src="'.$image.'">
                        </div>
                        <div class="discription">
                          <div class="sticker" style="background-color: '.$background.'; color: '.$color.';"><span>'.$title_label.'</span></div>
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
                    </div>';
        }
		/*if ( $class == 'box' ) {
			$out .= '<h5 class="header">';
			$out .= ( $link != '' ) ? '<a href="' . $link . '" title="' . $title . '">' : '';
			$out .= $title;
			$out .= ( $link != '' ) ? '</a>' : '';
			$out .= '</h5>';
			$out .= '<i class="'. $icon .'"></i>';
		} else {
			/*$out .= '<i class="'. $icon .'"></i>';
			$out .= '<h5 class="header">';
			$out .= ( $link != '' ) ? '<a href="' . $link . '" title="' . $title . '">' : '';
			$out .= $title;
			$out .= ( $link != '' ) ? '</a>' : '';
			$out .= '</h5>';
            
            $out .= '<div class="content-item">
                <div class="icon" style="background: '.$background.';">
                  <i class="'. $icon .'"></i>
                </div>

                <h3>'.$title.'</h3>
                <h4>'.$subtitle.'</h4>

                <div class="post-excerpt">
                  <p>'.$content.'</p>
                </div>
              </div>';
		}*/
		//$out .= '<div class="post_excerpt">';
		//$out .= $content;
		//$out .= '</div>';

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