<?php
/**
 *
 */
class missFontsocial{
	
	/**
	 *
	 */
	public static function fontsocial( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( '35 Social Media Icons', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'fontsocial',
				'options' => array(
					array(
						'name' => __( 'Icon', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select your icon.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon',
						'default' => 'wordpress',
						'type' => 'select',
						'target'=> 'fontsocial_variations'
					),
					array(
						'name' => __( 'Display Style <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select icon style.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'class',
						'type' => 'radio',
						'options' => array( 
							'claen' => 'Clean',
							'btn1' => 'Button Style 1',
							'btn2' => 'Button Style 2',
							'box' => 'Square Box',
						),

						'default' => 'claen',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Icon Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose any color to use with your icon. (Leave blank for standard color)', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'color',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Icon Box Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose any color to use with your icon box. (Leave blank for standard color)', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'box_color',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Icon Size (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select icon size', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'size',
						'default' => '',
						'type' => 'select',
						'options' => Array(
							'12' => '12',
							'16' => '16',
							'24' => '24',
							'32' => '32',
							'48' => '48',
							'56' => '56',
							'64' => '64',
							'72' => '62',
							'96' => '96',
						)
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
				'icon' 			=> '',
				'size'			=> '16',
				'class'         => '',
				'color' 		=> '',
				'box_color'		=> '',
		), $atts));
		
		global $wp_query, $irish_framework_params;

		$style = ' style="';
		if ( !empty( $color ) ) {
			$style .= 'color: ' . $color . '; ';
		}
		if ( $class == 'box' ) {
			if ( !empty( $box_color ) ) {
				$style .= 'background: ' . $box_color . '; ';
			}
			$padding = ( is_numeric( str_ireplace( 'x', '', $size ) ) ) ? str_ireplace( 'x', '', $size ) * 2 : '3';
			$style .= 'display:inline-block; text-align: center; padding: ' . $padding . 'px; border-radius: 4px;';
			$class = 'style-icon-box';
		}
		$style .= 'font-size:' . $size . 'px;';

		$style .= '"'; // End of Style
		$size = ( !empty( $size ) ) ? 'fs-icon-' . $size : '';
		$out = '<i class="fs-icon-' . $icon . ' ' . $class . '"' . $style . '></i>';

//		$out = '<i class="fontsocial-icon-' . str_replace( '.svg', '', $icon ) . ' ' . $class . '"' . $style . '><img src="' . THEME_ASSETS . '/images/icons/fontsocial/svg/' . $icon . '" width="'. $size .'" height="'. $size .'" /></i>';

		return $out;
	}
	
	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		$class_methods = get_class_methods( $class );
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		$options = array(
			'name' => __( '35 Social Media Icons', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'fontsocial',
			'options' => $shortcode
		);
		return $options;
	}
}
?>
