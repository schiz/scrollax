<?php
/**
 *
 */
class missButtons {
	
	/**
	 *
	 */
	public static function button( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			$option = array( 
				'name' => __( 'Button', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'button',
				'options' => array(
				
					array(
						'name' => __( 'Button Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will appear on your button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Link Url', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste a URL here to use as a link for your button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'link',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Button Style', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select display style.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'display_style',
						'default' => '1',
						'options' => array(
							'1' => __('style 1', MISS_ADMIN_TEXTDOMAIN ),
							'2' => __('style 2', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your button here.<br /><br />Your button will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'center' => __( 'center', MISS_ADMIN_TEXTDOMAIN ),
							'left' => __( 'left', MISS_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( "Setting the target to 'Blank' will open your page in a new tab when the reader clicks on the button.", MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'target',
						'default' => '',
						'options' => array( '_blank' => __('Blank', MISS_ADMIN_TEXTDOMAIN )),
						'type' => 'select',
					),
					array(
						'name' => __( 'Discourage search engines from indexing this link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This option adding ref="nofollow" to your link.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'rel',
						'default' => '',
						'options' => array( 'nofollow' => __( 'Enable rel="nofollow" attribute.', MISS_ADMIN_TEXTDOMAIN ) ),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Custom Styles', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this for enable all settings below.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'custom',
						'default' => 'true',
						'options' => array(
							'true' => __('Enable', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Icon Before Text<small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the icon before text inside button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon_before',
						'default' => 'im-icon-accessibility',
						'target' => 'all_icons',
						'type' => 'icons'
					),
					array(
						'name' => __( 'Icon After Text<small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the icon after text inside button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon_after',
						'default' => 'im-icon-accessibility',
						'target' => 'all_icons',
						'type' => 'icons'
					),
					array(
						'name' => __( 'Size <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can choose between three sizes for your button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'size',
						'default' => '',
						'options' => array(
							'small' => __('small', MISS_ADMIN_TEXTDOMAIN ),
							'medium' => __('medium', MISS_ADMIN_TEXTDOMAIN ),
							'large' => __('large', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Custom First BG Color', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose your own color to use as the background for your button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgcolor_first',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Custom Second BG Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose your second color to use as the bottom gradient for your button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgcolor_second',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'default' => '',
						'type' => 'color',
					),
				'shortcode_has_atts' => true,
				)
			);
		
			return $option;
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
	
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Buttons', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'button',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>
