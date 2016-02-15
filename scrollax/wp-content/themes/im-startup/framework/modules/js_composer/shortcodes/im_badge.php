<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 *
 */
class misscomposerImBadge {
	
	/**
	 *
	 */
	public static function im_badge( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Badge', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_badge',
				'icon' => 'im-icon-new',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
 					array(
						'heading' => __( 'Display Style <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose which type of badge you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Default', MISS_ADMIN_TEXTDOMAIN ) => '',
							__( 'Warning', MISS_ADMIN_TEXTDOMAIN ) => 'badge-warning',
							__( 'Error', MISS_ADMIN_TEXTDOMAIN ) => 'badge-error',
							__( 'Success', MISS_ADMIN_TEXTDOMAIN ) => 'badge-success',
							__( 'Info', MISS_ADMIN_TEXTDOMAIN ) => 'badge-info',
							__( 'Important', MISS_ADMIN_TEXTDOMAIN ) => 'badge-important',
							__( 'Inverse', MISS_ADMIN_TEXTDOMAIN ) => 'badge-inverse',
						),
					),
					array(
						'heading' => __( 'Badge Text', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the badge text here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'type' => 'textfield',
						'value' => '',
					),
				)
			);
		}

		extract(shortcode_atts(array(
			'class'	=> '',
	    ), $atts));
		$class = ( $class != '' ) ? ' ' . $class : '';

		$out = '<span class="badge ' . $class .'">' . $content . '</span>';
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