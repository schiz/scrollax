<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImHighlight {

	/**
	 *
	 */
	public static function im_highlight( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Highlight', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_highlight',
				'icon' => 'im-icon-text-color',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Display Style <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select display style (required for icon box).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Clean', MISS_ADMIN_TEXTDOMAIN ) => 'claen',
							__( 'Square Box', MISS_ADMIN_TEXTDOMAIN ) => 'box',
						),
					),
					array(
						'heading' => __( 'Drop Cap Text', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the letter you wish to display as your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'text',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Drop Cap Font Size', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select font size for your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'font_size',
						'value' => '20',
						'min' => 6,
						'max' => 72,
						'step' => 1,
						'unit' => __( 'pt', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
					array(
						'heading' => __( 'Custom Text Color (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can change the color of the text that appears on your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'textcolor',
						'type' => 'colorpicker',
					),
					array(
						'heading' => __( 'Custom BG Color (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Or you can also choose your own color to use as the background for your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bgcolor',
						'type' => 'colorpicker',
						'dependency' => array(
							'element' => 'class', 
							'value' => array('box')
						),
					),
					array(
						'heading' => __( 'Rounded Borders (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select corners rounding level.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'border_radius',
						'value' => array(
									'Do not round the corners' => '0',
									'10%' => '0.1',
									'30%' => '0.3',
									'50%' => '0.5',
									'80%' => '0.8',
									'100%' => '1',
						),
						'type' => 'dropdown',
						'dependency' => array(
							'element' => 'class', 
							'value' => array('box')
						),
					),
			    )
			);
		}

		extract(shortcode_atts(array(
			'class' => 'claen',
			'text' => '&nbsp;',
			'font_size'	=> '20',
			'border_radius'	=> '0',
			'bgcolor'	=> '',
			'textcolor'	=> '',
	    ), $atts));

		$font_size = str_replace('px', '', strtolower( $font_size ) ); 
		$padding = $font_size / 2; 
		$border_radius = ( $font_size * 2 ) * $border_radius; 

		$style = 'line-height:100%;';
		$style .= ( !empty( $font_size ) ) ? ' font-size:' . $font_size . 'px;' : '';
		$style .= ( !empty( $padding ) ) ? ' padding:' . $padding . 'px;' : '';
		$style .= ( !empty( $textcolor ) ) ? ' color:' . $textcolor . ';' : '';
		if ( $class == 'box' ) {
			$style .= ( !empty( $border_radius ) ) ? ' border-radius:' . $border_radius . 'px;' : '';
			$style .= ( !empty( $bgcolor ) ) ? ' background-color:' . $bgcolor . ';' : '';
		}
		
		return '<span class="drop_cap" style="' . $style . '">' . $text . '</span>';
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