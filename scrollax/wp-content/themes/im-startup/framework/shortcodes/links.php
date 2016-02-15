<?php
/**
 *
 */
class missLinks {
	
	/**
	 *
	 */
	public static function styled_link( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Styled Link', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'styled_link',
				'options' => array(
					array(
						'name' => __( 'Link Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will display as your link.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Link Url', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste the URL that you wish to use for your link here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'link',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Icon Before <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the icon before link text.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon_before',
						'default' => 'im-icon-accessibility',
						'target' => 'all_icons',
						'type' => 'icons',
					),
					array(
						'name' => __( 'Icon After <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the icon after link text.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon_after',
						'default' => 'im-icon-accessibility',
						'target' => 'all_icons',
						'type' => 'icons',
					),
					array(
						'name' => __( 'Custom Link Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose your own color to use with your link.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'color',
						'type' => 'color',
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Setting the target to "Blank" will open your page in a new tab when the reader clicks on the button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'target',
						'default' => '',
						'options' => array( 'blank' => __( 'Blank', MISS_ADMIN_TEXTDOMAIN )),
						'type' => 'select',
					),
				'shortcode_has_atts' => true
				)
			);		
		
			return $option;
		}
			
		extract(shortcode_atts(array(
			'link'      => '#',
//	        'variation'	=> '',
			'icon_before'	=> '',
			'icon_after'	=> '',
			'color'	=> '',
			'target'	=> ''
	    ), $atts));

		$link = trim( $link );
//		$variation = ( ( $variation ) && ( empty( $textcolor ) ) ) ? " {$variation}_sprite {$variation}_text" : '';
		$color = ( $color ) ? ' style="color:' . $color . ';"' : '' ;
		$target = ( $target == 'blank' ) ? ' target_blank' : '';
		$before = ( $icon_before != '' ) ? '<i class="' . $icon_before . '"' . $color .'></i>' : '';
		$after = ( $icon_after != '' ) ? '<i class="' . $icon_after . '"' . $color .'></i>' : '';
		//$arrow = ' &#x2192;';
		
		$out = '<a href="' . esc_url( $link ) . '" class="styled_link' . $target . '"' . $color .'>' . $before . ' ' . miss_content_group( $content ) . ' ' . $after . '</a>';
		$out = apply_filters( 'miss_styled_link', $out, array( 'link' => $link, 'target' => $target, 'color' => $color, 'content' => $before . ' ' . $content . ' ' . $after ) );

	    return $out;
	}
	
	/**
	 *
	 */
/*	
	public static function download_link( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Download Link', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'download_link',
				'options' => array(
					array(
						'name' => __( 'Link Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will display as your link.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Link Url', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste the URL that you wish to use for your link here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'link',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your link.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select',
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Setting the target to "Blank" will open your page in a new tab when the reader clicks on the button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'target',
						'default' => '',
						'options' => array( 'blank' => __( 'Blank', MISS_ADMIN_TEXTDOMAIN )),
						'type' => 'select',
					),
				'shortcode_has_atts' => true
				)
			);		
		
			return $option;
		}
		
		extract(shortcode_atts(array(
			'link'      => '#',
		    'variation'	=> '',
			'target'	=> ''
	    ), $atts));
	
		$link = trim( $link );
		$variation = ( $variation ) ? " {$variation}_sprite {$variation}_text" : '';
		
		$target = ( $target == 'blank' ) ? ' target_blank' : '';
	
		$out = '<a href="' . esc_url( $link ) . '" class="download_link' . $variation . $target . '"><i class="' . $variation . ' fa-icon-download-alt"></i>' . miss_content_group( $content ) . '</a>';
	
		return $out;
		
	}
*/	
	/**
	 *
	 */
/*
	public static function email_link( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Email Link', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'email_link',
				'options' => array(
					array(
						'name' => __( 'Link Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will display as your link.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Email', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste the email that you wish to use here.<br /><br />When the reader clicks on this link an email client will open with your email ready.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'email',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your link.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select',
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Setting the target to "Blank" will open your page in a new tab when the reader clicks on the button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'target',
						'default' => '',
						'options' => array( 'blank' => __( 'Blank', MISS_ADMIN_TEXTDOMAIN )),
						'type' => 'select',
					),
				'shortcode_has_atts' => true
				)
			);		
		
			return $option;
		}
		
		extract(shortcode_atts(array(
			'email'		=> '#',
		    'variation'	=> '',
			'target'	=> ''
	    ), $atts));
	
		$email = trim( $email );
		$variation = ( $variation ) ? " {$variation}_sprite {$variation}_text" : '';
	
		$is_email = preg_match( '/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $email );
		
		if( $is_email ) {
			$nospam = ( $email ) ? ' rel="' . miss_nospam( $email ) . '"' : '';
			
			if( $email == trim( $content ) ) {
				$content = miss_nospam( $content );
				$class = ' email_link_replace';
			} else {
				$class = ' email_link_noreplace';
			}
			
			$out = '<a href="#"' . $nospam . ' class="email_link' . $class . $variation . '"><i class="' . $variation . ' fa-icon-envalope-alt"></i>' . miss_content_group( $content ) . '</a>';
		} else {
			$out = '<a href="' . $email . '" class="email_link' . $variation . '"><i class="' . $variation . ' fa-icon-envelope-alt"></i>' . miss_content_group( $content ) . '</a>';
		}
	
		return $out;
	}
*/	
	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __( 'Styled Links', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of link you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'styled_link',
			'options' => $shortcode,
		);
		
		return $options;
	}
	
}

?>
