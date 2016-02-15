<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 *
 */
class misscomposerImAlertbox {
	
	/**
	 *
	 */
	public static function im_alertbox( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			return array( 
				'name' => __( 'Alert Box', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_alertbox',
				'icon' => 'im-icon-checkbox-unchecked-3',
				'category' => __( 'Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Alert Box Type', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose which type of alertbox you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Warning Box', MISS_ADMIN_TEXTDOMAIN ) => 'block',
							__( 'Error Box', MISS_ADMIN_TEXTDOMAIN ) => 'error',
							__( 'Success Box', MISS_ADMIN_TEXTDOMAIN ) => 'success',
							__( 'Info Box', MISS_ADMIN_TEXTDOMAIN ) => 'info',
						),
					),
					array(
						'heading' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the alert box caption.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'caption',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Box Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the alert box text content.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'value' => '',
						'type' => 'textfield',
					),
                    array(
                        'heading' => __( 'Close Button <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
                        'description' => __( 'Check this option to add close button to this alert box.', MISS_ADMIN_TEXTDOMAIN ),
                        'param_name' => 'close_button',
						'type' => 'dropdown',
						'value' => array( 
							__( 'With Close button', MISS_ADMIN_TEXTDOMAIN ) => 'true',
							__( 'Without Close button', MISS_ADMIN_TEXTDOMAIN ) => 'false',
						),
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
			'class'	=> 'block',
			'caption'	=> '',
			'close_button'	=> 'true',
			'animation' => '',
		), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$caption = ( $caption ) ? '<h4>' . $caption . '</h4>' : '';

		$close_button = ( $close_button == 'true' ) ? '<div class="closeBtn closeParent close" data-dismiss="alert">×</div>' : '';
		
		$out = '<div class="alert alert-' . $class . $animation . '">' . $close_button . $caption . miss_content_group( $content ) . '</div>';

		return do_shortcode( $out );
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