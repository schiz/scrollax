<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImSlider {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_slider( $atts = null, $content = null ) {

		$multiplier_cycle_number = 10;
		$multiple_params = array(
			array(
				'heading' => __( 'Slide Content {{1}}', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Enter the Embedded code here (Shortcodes and HTML suported).', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'slide_{{1}}',
				'type' => 'textarea',
			),
		);

		if( $atts == 'generator' ) {
			$params = array(
					array(
						'heading' => __( 'Controls Style', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select Controls Style.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'controls_type',
						'value' => Array(
							__( 'Both Pagination', MISS_ADMIN_TEXTDOMAIN ) => 'circles',
							__( 'Arrow buttons on sides', MISS_ADMIN_TEXTDOMAIN ) => 'arrows',
							__( 'Arrow buttons in top right corner', MISS_ADMIN_TEXTDOMAIN ) => 'arrows_top',
							__( 'Arrows Buttons and Pagination', MISS_ADMIN_TEXTDOMAIN ) => 'all',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Number of Slides', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select the number of slides you wish to display. Slides are the selectable areas which change the content.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'multiplier',
						'value' => range(1, $multiplier_cycle_number),
						'type' => 'dropdown',
					),
				);

			$params = array_merge( $params, miss_vc_multiple_params( $multiplier_cycle_number, $multiple_params ) );
			return array(
				'name' => __( 'Flex Slider', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_slider',
				'icon' => 'im-icon-transmission-2',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => $params

			);
		}
			
		extract(shortcode_atts(array(
			'controls_type'	=> 'arrows',
			'multiplier' => '',
	    ), $atts));

		$i=1;
		foreach ($multiple_params as $key => $value) {
			$value['param_name'] = str_replace( '{{1}}', $i, $value['param_name'] );
			$atts[$value['param_name']] = ( !isset( $atts[$value['param_name']] ) || $atts[$value['param_name']] === false ) ? '' : $atts[$value['param_name']];
			$i++;
		}

		$out = '<div class="flexslider im-transform im-animate-element fade-in">';
		$out .= '<ul class="slides">';
		for($i = 1; $i <= $multiplier; $i++) {
			$out .= '<li cass="default">';
			$out .= do_shortcode( $atts['slide_' . $i] );
			$out .= '</li>';
		}
		$out .= '</ul>';
		$out .= '</div>';
		return '<div class="flex_slideshow_container ' . $controls_type . '">' . $out . '</div>';
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}

endif;
?>