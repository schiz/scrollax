<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImCaption {
	/**
	 *
	 */
	public static function im_caption( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			return array( 
				'name' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_caption',
				'icon' => 'im-icon-text-height',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(

					array(
						'heading' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type Title here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Tagline <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type Tagline here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'tagline',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Font Size', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select custom font size.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'size',
						'value' => range(6,76),
						'min' => 6,
						'max' => 400,
						'step' => 1,
						'unit' => 'pt',
						'type' => 'range',
					),
					array(
						'heading' => __( 'Caption Tag', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify custom tag.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'tag',
						'value' => array(
							__( 'H1', MISS_ADMIN_TEXTDOMAIN ) => 'h1',
							__( 'H2', MISS_ADMIN_TEXTDOMAIN ) => 'h2',
							__( 'H3', MISS_ADMIN_TEXTDOMAIN ) => 'h3',
							__( 'H4', MISS_ADMIN_TEXTDOMAIN ) => 'h4',
							__( 'H5', MISS_ADMIN_TEXTDOMAIN ) => 'h5',
							__( 'H6', MISS_ADMIN_TEXTDOMAIN ) => 'h6',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Weight', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify font weight.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'weight',
						'min' => 100,
						'max' => 900,
						'step' => 100,
						'unit' => '',
						'type' => 'range',
					),

					array(
						'heading' => __( 'Align', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify text aligh.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'align',
						'value' => array(
							'left' => 'left',
							'center' => 'center',
							'right' => 'right',
						),
						'type' => 'dropdown',
					),

					array(
						'heading' => __( 'Colour', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify custom colour.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'color',
						'type' => 'colorpicker',
					),

					array(
						'heading' => __( 'Text Transform', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Use uppercase option.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'text_transform',
						'value' => array(
							__( 'Default', MISS_ADMIN_TEXTDOMAIN ) => 'none',
							__( 'Capitalize', MISS_ADMIN_TEXTDOMAIN ) => 'capitalize',
							__( 'Uppercase', MISS_ADMIN_TEXTDOMAIN ) => 'uppercase',
							__( 'Lowercase', MISS_ADMIN_TEXTDOMAIN ) => 'lowercase',
						),
						'type' => 'dropdown',
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
			'tagline' => '',
			'tag'   => 'h2',
			'weight' => '400',
			'align' => 'left',
			'color'   => '',
			'size' => '30',
			'animation' => '',
			'text_transform' => 'none',
	    ), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

	    /* Creating custom style */
		$style = '';
		$style .= 'text-align: ' . $align . ';';
		$style .= 'line-height: ' . ( $size ) . 'px;';
		$style .= 'color: ' . $color . ';';
		$style .= 'font-size: ' . $size . 'px;';
		$style .= 'font-weight: ' . $weight . ';';
		$style .= 'text-transform: '. $text_transform . ';';

		/* Building Output */
		$out = '<' . $tag . ' style="' . $style . '" class="caption' . $animation . '">' . $content . '</' . $tag . '>';
		if ( $tagline != '' ) {
			$out = '<div class="blog_header">' . $out . '<h6 class="tagline">' . $tagline . '</h6><div class="clearboth"></div></div>';
		}
		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
	
}

endif;
?>