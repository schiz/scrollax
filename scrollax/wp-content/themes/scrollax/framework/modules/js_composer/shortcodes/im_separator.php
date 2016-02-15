<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImSeparator {

	/**
	 *
	 */
	public static function im_separator( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Separator', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_separator',
				'icon' => 'im-icon-minus',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
 					array(
						'heading' => __( 'Banner Image', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select which Miscellaneous shortcode you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'type' => 'dropdown',
						'value' => array( 
							__( 'Divider', MISS_ADMIN_TEXTDOMAIN ) => 'divider',
							__( 'Darken Divider', MISS_ADMIN_TEXTDOMAIN ) => 'divider2',
							__( 'Triangle Divider', MISS_ADMIN_TEXTDOMAIN ) => 'divider3',
							__( 'Triangle Divider (lite)', MISS_ADMIN_TEXTDOMAIN ) => 'divider4',
							__( 'Dotted Divider', MISS_ADMIN_TEXTDOMAIN ) => 'divider5',
							__( 'Dashed Divider', MISS_ADMIN_TEXTDOMAIN ) => 'divider6',
							__( 'Divider Top', MISS_ADMIN_TEXTDOMAIN ) => 'divider top',
							__( 'Styled Amp', MISS_ADMIN_TEXTDOMAIN ) => 'styled_amp',
							__( 'Clearboth', MISS_ADMIN_TEXTDOMAIN ) => 'clearboth',
							__( 'Div', MISS_ADMIN_TEXTDOMAIN ) => 'div',
							__( 'Hidden Div', MISS_ADMIN_TEXTDOMAIN ) => 'hidden',
							__( 'Clearboth', MISS_ADMIN_TEXTDOMAIN ) => 'clearboth',
							__( 'Margin10', MISS_ADMIN_TEXTDOMAIN ) => 'margin10',
							__( 'Margin20', MISS_ADMIN_TEXTDOMAIN ) => 'margin20',
							__( 'Margin30', MISS_ADMIN_TEXTDOMAIN ) => 'margin30',
							__( 'Margin40', MISS_ADMIN_TEXTDOMAIN ) => 'margin40',
							__( 'Margin50', MISS_ADMIN_TEXTDOMAIN ) => 'margin50',
							__( 'Margin60', MISS_ADMIN_TEXTDOMAIN ) => 'margin60',
							__( 'Margin70', MISS_ADMIN_TEXTDOMAIN ) => 'margin70',
							__( 'Margin80', MISS_ADMIN_TEXTDOMAIN ) => 'margin80',
							__( 'Margin90', MISS_ADMIN_TEXTDOMAIN ) => 'margin90',
						),
					),
					array(
						'heading' => __( 'Content (only for "Div", "Hidden Div")', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter content here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'type' => 'textfield',
						'value' => '',
					),
				)
			);
		}

		extract(shortcode_atts(array(
			'class' => 'divider',
	    ), $atts));

		switch ( $class ) {
			case 'styled_amp':
				$content = '&amp;';
				break;
			case 'divider top':
				$content = '<a href="#">' . __( 'Top', MISS_TEXTDOMAIN ) . '</a>';
				break;
			case 'div':
				$content = $content;
				break;
			case 'hidden':
				$content = $content;
				break;
			default:
				$content = '';
				break;
		}

		
		return '<div class="' . $class . '">' . $content . '</div>';
	}

	public static function _options( $method ) {
		return self::$method('generator');
	}

}
endif;
?>