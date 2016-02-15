<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImBenefit {

	/**
	 *
	 */
	public static function im_benefit( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Benefit', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_benefit',
				'icon' => 'im-icon-trophy-star',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Display Style <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select display style (required for icon box).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Clean', MISS_ADMIN_TEXTDOMAIN ) => 'claen',
							__( 'Round Frame', MISS_ADMIN_TEXTDOMAIN ) => 'circle',
							__( 'Square Box', MISS_ADMIN_TEXTDOMAIN ) => 'box',
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
						'heading' => __( 'Benefit SubTitle', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter benefit sub title.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'subtitle',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Benefit Link', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter benefit link.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'link',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Benefit Icon', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select benefit icon.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'icon',
						'type' => 'im_icon',
						'value' => array_flip( miss_get_all_font_icons() ),
					),
					array(
						'heading' => __( 'Benefit Background', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select benefit background.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'background',
						'type' => 'colorpicker',
						'value' => '',
					),
					array(
						'heading' => __( 'Benefit Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter benefit content.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'type' => 'textarea_html',
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
			'icon'	=> 'fa-icon-ok',
			'class'	=> 'claen',
			'title'	=> '',
			'link'	=> '',
			'animation' => '',
			'background' => '',
            'subtitle' => ''
	    ), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$out = '';
		if ( $class == 'box' ) {
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
            */
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
		}
		//$out .= '<div class="post_excerpt">';
		//$out .= $content;
		//$out .= '</div>';

		return '<div class="benefits ' . $class . $animation . '">' . $out . '</div>';
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