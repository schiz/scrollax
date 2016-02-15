<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImButton {
	
	/**
	 *
	 */
	public static function im_button( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			return array(
				'name' => __( 'Styled Link/Button', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_button',
				'icon' => 'im-icon-link-3',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Display Style', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select display style (Link / Button).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'value' => array(
							__('Link', MISS_ADMIN_TEXTDOMAIN ) => 'styled_link',
							__('Button Style 1', MISS_ADMIN_TEXTDOMAIN ) => 'btn1',
							__('Button Style 2', MISS_ADMIN_TEXTDOMAIN ) => 'btn2',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Text', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'This is the text that will appear on your button.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'URL', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Paste a URL here to use as a link for your button.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'link',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Target <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Setting the target to "Blank" will open your page in a new tab when the reader clicks on this element.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'target',
						'value' => array( 
							__('Blank', MISS_ADMIN_TEXTDOMAIN ) => '_blank',
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Discourage search engines from indexing this link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'This option adding ref="nofollow" to your link.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'rel',
						'value' => array( 
							__('Enable rel="nofollow" attribute.', MISS_ADMIN_TEXTDOMAIN ) => 'nofollow', 
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Icon Before Text <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select the icon before.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'icon_before',
						'value' => array_flip( miss_get_all_font_icons() ),
						'type' => 'im_icon',
					),
					array(
						'heading' => __( 'Icon After Text <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select the icon after.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'icon_after',
						'value' => array_flip( miss_get_all_font_icons() ),
						'type' => 'im_icon',
					),
					array(
						'heading' => __( 'Size <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can choose between three sizes for your button.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'size',
						'value' => array(
							__('small', MISS_ADMIN_TEXTDOMAIN ) => 'small',
							__('medium', MISS_ADMIN_TEXTDOMAIN ) => 'medium',
							__('large', MISS_ADMIN_TEXTDOMAIN ) => 'large',
						),
						'type' => 'dropdown',
						'dependency' => array(
							'element' => 'class', 
							'value' => array('btn1', 'btn2')
						),
					),
					array(
						'heading' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Set the alignment for your button here. Your button will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'align',
						'value' => array(
							__( 'No align', MISS_ADMIN_TEXTDOMAIN ) => 'none',
							__( 'Center', MISS_ADMIN_TEXTDOMAIN ) => 'center',
							__( 'Left', MISS_ADMIN_TEXTDOMAIN ) => 'left',
							__( 'Right', MISS_ADMIN_TEXTDOMAIN ) => 'right',
						),
						'type' => 'dropdown',
						'dependency' => array(
							'element' => 'class', 
							'value' => array('btn1', 'btn2')
						),
					),
					array(
						'heading' => __( 'Custom Styles', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Check this for enable all settings below.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'custom',
						'value' => array(
							__('Enable', MISS_ADMIN_TEXTDOMAIN ) => 'true',
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can change the color of the text.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'textcolor',
						'value' => '',
						'type' => 'colorpicker',
					),
					array(
						'heading' => __( 'Custom First BG Color', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose your own color to use as the background for your button.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bgcolor_first',
						'value' => '',
						'type' => 'colorpicker',
						'dependency' => array(
							'element' => 'class', 
							'value' => array('btn1', 'btn2')
						),
					),
					array(
						'heading' => __( 'Custom Second BG Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose your second color to use as the bottom gradient for your button.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bgcolor_second',
						'value' => '',
						'type' => 'colorpicker',
						'dependency' => array(
							'element' => 'class', 
							'value' => array('btn1', 'btn2')
						),
					),
				)
			);
		}
			
		extract(shortcode_atts(array(
			'icon_before'	=> '',
			'icon_after'	=> '',
			'display_style'	=> '1',
			'custom'	=> 'false',
			'size'      => '',
			'align'	    => '',
			'link'      => '#',
			'overlay'   => '',
			'corners'   => '',
			'target'    => '',
			'rel'    => '',
			'bgcolor_first'   => '', 
			'bgcolor_second'   => '', 
			'textcolor' => ''
	    ), $atts));


		if( isset($target) && !empty( $target ) ) {
			$target  = ' target="' . $target . '"';
		} else {
			$target= '';
		}
		if( isset($rel) && !empty( $rel ) ) {
			$rel  = ' rel="' . $rel . '"';
		} else {
			$rel= '';
		}

		$size = ( $size == 'large' ) ? ' large_button' : $size;
		$size = ( $size == 'medium' ) ? ' medium_button' : $size;
		$size = ( $size == 'small' ) ? ' small_button' : $size;
		if ( $custom == 'false' ) {
			$out = '<div style="text-align:' . $align . '"><a href="' . esc_url( $link ) . '" class="btn' . $display_style . $size . '"' . $target . $rel . '><span>' . miss_content_group( $content ) . '</span></a></div>';
		} else {
			$before = ( $icon_before != '' ) ? '<i class="' . $icon_before . '" style="color:' . $textcolor . ';"></i>' : '';
			$after = ( $icon_after != '' ) ? '<i class="' . $icon_after . '" style="color:' . $textcolor . ';"></i>' : '';
			$corners = ( $corners == 'r1' ) ? ' r1' : $corners;
			$corners = ( $corners == 'r2' ) ? ' r2' : $corners;
			$corners = ( $corners == 'r3' ) ? ' r3' : $corners;
			
			$overlay = ( $overlay == 'glance' ) ? ' glance' : $overlay;
			
			$align = ( $align ) ? $align : '';
					
			$styles = array();
			$style = '';
			$style .= 'background-color:' . $bgcolor_first . '; ';
			if( isset ( $bgcolor_second ) && $bgcolor_second != '' ) {
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
		); 	';
			}
			if( isset ( $textcolor ) ) {
				$style .= 'color:' . $textcolor . ';';
			}
					
			$style = !empty( $style ) ? ' style="' . $style . '"': '' ;

			$out = '<div style="text-align:' . $align . '"><a href="' . esc_url( $link ) . '" class="btn' . $display_style . $size . $corners . '"' . $target . $rel . $style . '><span>' . $before . ' ' . miss_content_group( $content ) . ' ' . $after . '</span></a></div>';
		}


		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
	
}

endif;
?>