<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImSocials {

	/**
	 *
	 */
	public static function im_socials( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Socials', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_socials',
				'icon' => 'im-icon-trophy-star',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
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
			'animation' => '',
	    ), $atts));
        
        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        }
        

		$out = do_shortcode('[sociable_icons]');
        
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
