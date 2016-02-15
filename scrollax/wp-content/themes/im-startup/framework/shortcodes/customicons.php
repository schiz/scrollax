<?php
/**
 *
 */
class missCustomicons {
	
	/**
	 *
	 */
	public static function fontawesome( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Font Awesome', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'fontawesome',
				'options' => array(
					array(
						'name' => __( 'Icon', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select your icon.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon',
						'default' => 'im-icon-accessibility',
						'type' => 'icons',
						'target'=> 'all_icons'
					),
					array(
						'name' => __( 'Float <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select icon align type.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'float',
						'type' => 'select',
						'default' => '',
						'options' => array( 
							'' => 'Default (inline)',
							'left' => __( 'Float Left', MISS_ADMIN_TEXTDOMAIN ),
							'right' => __( 'Float Right', MISS_ADMIN_TEXTDOMAIN ),
						),
						'default' => 'claen',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Display Style <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select icon style.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'display_style',
						'type' => 'radio',
						'options' => array( 
							'claen' => 'Clean',
							'box' => 'Square Box',
							'btn1' => 'Button Style 1',
							'btn2' => 'Button Style 2',
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
				'float'			=> '',
				'display_style' => '',
				'color' 		=> '',
				'box_color'		=> '',
		), $atts));
		
		global $wp_query, $irish_framework_params;

		preg_match('/\d+/', $size, $matches);
		$size = $matches[0];

		$style = ' style="';
		if ( !empty( $color ) ) {
			$style .= 'color: ' . $color . '; ';
		}
		if ( $display_style == 'box' ) {
			if ( !empty( $box_color ) ) {
				$style .= 'background: ' . $box_color . '; ';
			}
			$padding = floor( $size / 6 );
			$style .= 'display: inline-block; text-align: center; padding: ' . $padding . 'px; border-radius: 4px;';
			$class = 'style-icon-box';
		}
		$style .= ' font-size:' . $size . 'px; line-height:' . $size . 'px;';
		if ( !empty( $float ) ) {
			$style .= ' display:inline-block;';
			$style .= ' float:' . $float . ';';
		}

		$style .= '"';
		$size = ( !empty( $size ) ) ? 'fa-icon-' . $size : '';
		$out = '<i class="' . $icon . ' ' . $size . ' ' . $display_style . '"' . $style . '></i>';
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
			'name' => __( 'Custom Icons (FontAwesome)', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'fontawesome',
			'options' => $shortcode
		);
		return $options;
	}
}
?>
