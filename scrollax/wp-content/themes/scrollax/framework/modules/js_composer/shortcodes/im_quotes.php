<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImQuotes {
	
	/**
	 *
	 */
	public static function im_quotes ( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Quotes', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_quotes',
				'icon' => 'im-icon-quotes-left',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Pullquote Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the text that you wish to display with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Pullquote', MISS_ADMIN_TEXTDOMAIN ) => 'pullquote',
							__( 'Blockquote', MISS_ADMIN_TEXTDOMAIN ) => 'blockquote',
						),
					),
					array(
						'heading' => __( 'Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the text that you wish to display with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'type' => 'textarea_html',
						'value' => '',
					),
					array(
						'heading' => __( 'Cite Name <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'This is the name of the author.  It will display at the end of the quote.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'cite',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Cite Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'citeLink',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'align',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Left', MISS_ADMIN_TEXTDOMAIN ) => 'left',
							__( 'Right', MISS_ADMIN_TEXTDOMAIN ) => 'right',
							__( 'Center', MISS_ADMIN_TEXTDOMAIN ) => 'center',
						),
					),
					array(
						'heading' => __( 'Width <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Set width for you quote.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'width',
						'value' => '100',
						'min' => 50,
						'max' => 100,
						'step' => 1,
						'unit' => __( '%', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
					array(
						'heading' => __( 'Quotes Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify custom quote colour.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'color',
						'type' => 'colorpicker',
					),
					array(
						'heading' => __( 'Text Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify custom text colour.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'textColor',
						'type' => 'colorpicker',
					),
					array(
						'heading' => __( 'Background Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify custom background colour.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bgColor',
						'type' => 'colorpicker',
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
			'class'	=> 'pullquote',
			'align'		=> '',
			'color'	=> '',
			'textcolor'	=> '',
			'bgcolor'	=> '',
			'cite'		=> '',
			'width' => '100',
			'citelink'	=> '',
			'animation'	=> '',
	    ), $atts));
	
        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 
		
		if ( $class == 'pullquote' ) {
			$class = array();
			if( preg_match( '/left|right|center/', trim( $align ) ) ) {
				$class[] = ' align' . $align;
			}
			$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
			$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
			$color = ( $color ) ? 'color:' . $color . ';' : '';
			$bgcolor = ( $bgcolor ) ? 'background-color:' . $bgcolor . ';' : '';	
			$style_qute = ( $color || $bgcolor ) ? ' style="' . $color . $bgcolor . '"' : '';
			$style_text = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			$class = join( '', array_unique( $class ) );
			return '<span class="pullquote ' . $class . '"' . $style_qute . '><span class="text quotes"' . $style_text . '>' . $content . $cite . '</span></span>';
		} else {
			$color = ( $color ) ? 'color:' . $color . ';' : '';
			$bgcolor = ( $bgcolor ) ? 'background-color:' . $bgcolor . ';' : '';	
			$style_qute = ( $color ) ? ' style="' . $color . '"' : '';
			$bgcolor = ( $bgcolor  ) ? ' style="' . $bgcolor . '"' : '';
			$width = ( $width ) ? 'width:' . $width . '%;' : '';	
			$style_bg = ' style="' . $bgcolor . $width . '"';
			$style_text = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
			$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
	 		return '<blockquote' . $style_bg . ' class="im-quote' . $animation . '"><i class="fa-icon-quote-left"' . $style_qute . '></i><span class="text"' . $style_text . '>' . $content . '</span>' . $cite . '</blockquote>';
		}
	}

	public static function _options( $method ) {
		return self::$method('generator');
	}

}

endif;
?>