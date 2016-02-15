<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImIcon {
	
	/**
	 *
	 */
	public static function im_icon( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Icons', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_icon',
				'icon' => 'im-icon-diamond-2',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Icon', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select your icon.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'icon',
						'type' => 'im_icon',
						'value'=> array_flip( miss_get_all_font_icons() ),
					),
					array(
						'heading' => __( 'Icon Size (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select icon size', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'size',
						'value' => 16,
						'min' => 6,
						'max' => 200,
						'step' => 1,
						'unit' => __( 'px', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
					array(
						'heading' => __( 'Float <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select icon align type.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'float',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Default (inline)', MISS_ADMIN_TEXTDOMAIN ) => '',
							__( 'Float Left', MISS_ADMIN_TEXTDOMAIN ) => 'left',
							__( 'Float Right', MISS_ADMIN_TEXTDOMAIN ) => 'right',
						),
					),
					array(
						'heading' => __( 'Display Style <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select icon style.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Clean', MISS_ADMIN_TEXTDOMAIN ) => 'claen',
							__( 'Square Box', MISS_ADMIN_TEXTDOMAIN ) => 'box',
							__( 'Button Style 1', MISS_ADMIN_TEXTDOMAIN ) => 'btn1',
							__( 'Button Style 2', MISS_ADMIN_TEXTDOMAIN ) => 'btn2',
						),
					),
					array(
						'heading' => __( 'Icon Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose any color to use with your icon. (Leave blank for standard color)', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'color',
						'value' => '',
						'type' => 'colorpicker',
					),
					array(
						'heading' => __( 'Icon Box First BG Color', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose any color to use with your icon box. (Leave blank for standard color)', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bgcolor_first',
						'value' => '',
						'type' => 'colorpicker',
						'dependency' => array(
							'element' => 'class', 
							'value' => array('box')
						),
					),
					array(
						'heading' => __( 'Icon Box Second BG Gradient Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose any color to use with your icon box. (Leave blank for standard color).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bgcolor_second',
						'value' => '',
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
				'icon' => '',
				'size' => '16',
				'float' => '',
				'class' => '',
				'color' => '',
				'bgcolor_first' => '',
				'bgcolor_second' => '',
				'border_radius' => '',
		), $atts));
		
		global $wp_query, $irish_framework_params;

		preg_match('/\d+/', $size, $matches);
		$size = $matches[0];
		
		$style = ' style="';
		if ( !empty( $color ) ) {
			$style .= 'color: ' . $color . '; ';
		}
		if ( $class == 'box' ) {
			if ( isset( $bgcolor_first ) && $bgcolor_first != '' ) {
				$style .= 'background-color:' . $bgcolor_first . ';';
			}
			if ( isset( $bgcolor_first ) && $bgcolor_first != '' && isset( $bgcolor_second ) && $bgcolor_second != '' ) {
				$style .= '
background-image: linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
background-image: -o-linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
background-image: -moz-linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
background-image: -webkit-linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
background-image: -ms-linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
background-image: -webkit-gradient(
linear,
left top,
left bottom,
color-stop(0, ' . $bgcolor_first . '),
color-stop(1, ' . $bgcolor_second . ')
);
				';
			}
			$padding = floor( $size / 6 );
			$style .= 'display: inline-block; text-align: center; padding: ' . $padding . 'px;';
			$style .= 'border-radius:' . ( ( $padding + ( $size / 2 ) ) * $border_radius ) . 'px;';
			$class = 'style-icon-box';
		}
		$style .= ' font-size:' . $size . 'px; line-height:' . $size . 'px;';
		if ( !empty( $float ) ) {
			$style .= ' display:inline-block;';
			$style .= ' float:' . $float . ';';
		}

		$style .= '"';
		$size = ( !empty( $size ) ) ? 'fa-icon-' . $size : '';
		$out = '<i class="' . $icon . ' ' . $size . ' ' . $class . '"' . $style . '></i>';
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