<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImStyledlist {
	
	/**
	 *
	 */
	public static function im_styledlist( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Styled Unlimited Icon List', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_styledlist',
				'icon' => 'im-icon-list-2',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Icon', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose the icon of list that you wish to use. Each one has a different icon.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'icon',
						'type' => 'im_icon',
						'value' => array_flip( miss_get_all_font_icons() ),
					),
					array(
						'heading' => __( 'Color Variation <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose one of our predefined color skins to use with your list.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'color',
						'type' => 'colorpicker',
						'value' => '',
					),
					array(
						'heading' => __( 'List Html', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the content of your list.  You need to use the &#60;ul&#62; and &#60;li&#62; elements when typing out your list content.', MISS_ADMIN_TEXTDOMAIN ),
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
			'icon'     => '',
			'color'	=> '',
			'animation' => ''
	    ), $atts));
	
        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$icon = ( $icon ) ? trim( $icon ) : 'arrow_list';
	
		$color = ( $color ) ? '' . trim( $color ) : '';

		$content = str_replace( '<ul>', '<ul class="unlimited_list' . $animation . '">', $content );
		$content = str_replace( '<li>', '<li><i class="' . $icon . '" style="color:' . $color . ';"></i> ', $content );
	
		return miss_content_group( $content );
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