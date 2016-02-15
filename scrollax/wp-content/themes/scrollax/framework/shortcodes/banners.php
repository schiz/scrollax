<?php
/**
 *
 */
class missBanners {
	/**
	 *
	 */
	public static function banner( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			$option = array( 
				'name' => __( 'Banner', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'banner',
				'options' => array(
/*
					array(
						'name' => __( 'Banner Image', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Banner image URL / Upload.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'image',
						'default' => '',
						'type' => 'upload',
					),
*/
					array(
						'name' => __( 'Banner Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter banner caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Banner Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter banner text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Link URL', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter banner address (URL).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'link',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Button text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will appear on your button.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'btn_text',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set to "Blank" to open link in new window/tab.', MISS_ADMIN_TEXTDOMAIN ),
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
						'options' => array( 'nofollow' => __('Discourage', MISS_ADMIN_TEXTDOMAIN )),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Custom Styles', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this for Enable all settings below.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'custom',
						'default' => 'true',
						'options' => array(
							'true' => __('Enable', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Primary Background Color', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose primary color to use as the background in this banner.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgcolor_first',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Secondary Background Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose your secondary color to use as the bottom gradient in this banner.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgcolor_second',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears in this banner.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Frame Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can set frame color for this banner.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'frame_color',
						'default' => '#fafafa',
						'type' => 'color',
					),
					array(
						'name' => __( 'Frame Size <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can set frame size for this banner.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'frame_width',
						'default' => '0',
						'type' => 'range',
						'min' => 1,
						'max' => 12,
						'unit' => 'px',
						'step' => 1
					),
					array(
						'name' => __( 'Inverse Colors', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this for swap BG ant Text colors', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'inverse',
						'default' => 'true',
						'options' => array(
							'true' => __('Enable', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'animation',
						'default' => '',
						'type' => 'select',
						'target'=> 'css_animation',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
				'shortcode_has_atts' => true,
				)
			);
		
			return $option;
		}
			
		extract(shortcode_atts(array(
			'image'   => '',
			'title' => '',
			'btn_text' => '',
			'link'      => 'not',
			'inverse' => 'false',
			'target'    => '',
			'rel'    => '',
			'custom'    => 'false',
			'frame_width' => 0,
			'frame_color' => 'rgba(0,0,0,0)',
			'bgcolor_first'    => '',
			'bgcolor_second'    => '',
			'textcolor'    => '',
			'animation' => '',
	    ), $atts));

		if ( !empty( $animation )) {
			$animation = ' im-animate-element ' . $animation;
		}

		if ( $custom != 'false' ) {
			if ( $inverse == 'true' ) {
				$message_text_style = 'color: ' . $textcolor . ';';

				$message_center_style = '
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
			$message_bottom_style = '
border-top-color: ' . $bgcolor_first . ';
			';
			$message_shadow_style = '
opacity: 0.2;
background-image: linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -o-linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -moz-linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -webkit-linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -ms-linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -webkit-gradient(
linear,
left top,
left bottom,
color-stop(0, ' . $bgcolor_first . '),
color-stop(0.5, rgba(255,255,255, 0))
);
				';
			} else {
				$message_text_style = 'color: ' . $bgcolor_first . ';';
				$message_center_style = '
background-image: linear-gradient(top, ' . $textcolor . ' 0%, ' . $textcolor . ' 100%);
background-image: -o-linear-gradient(top, ' . $textcolor . ' 0%, ' . $textcolor . ' 100%);
background-image: -moz-linear-gradient(top, ' . $textcolor . ' 0%, ' . $textcolor . ' 100%);
background-image: -webkit-linear-gradient(top, ' . $textcolor . ' 0%, ' . $textcolor . ' 100%);
background-image: -ms-linear-gradient(top, ' . $textcolor . ' 0%, ' . $textcolor . ' 100%);
background-image: -webkit-gradient(
linear,
left top,
left bottom,
color-stop(0, ' . $textcolor . '),
color-stop(1, ' . $textcolor . ')
);
			';
			$message_bottom_style = '
border-top-color: ' . $bgcolor_first . ';
			';
			$message_shadow_style = '
opacity: 0.2;
background-image: linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -o-linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -moz-linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -webkit-linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -ms-linear-gradient(top, ' . $bgcolor_first . ' 0%, rgba(255,255,255, 0) 50%);
background-image: -webkit-gradient(
linear,
left top,
left bottom,
color-stop(0, ' . $bgcolor_first . '),
color-stop(0.5, rgba(255,255,255, 0))
);
				';
			}
		}
		else {
			$message_text_style = '';
			$message_center_style = '';
			$message_bottom_style = '';
			$message_shadow_style = '';
		}
		$message_center_style .= 'border-width:' . $frame_width . 'px;';
		$message_center_style .= 'border-color:' . $frame_color . ';';
		$message_center_style .= 'border-style:solid;';
		$out = '';
		$out .= '<div class="message' . ( ( $inverse == "true" ) ? " inverse" : "" ) . $animation . '">';
		$out .= '<div class="row-fluid">';
		$out .= '<div class="span12">';
		$out .= '<div class="message_center" style="' . $message_center_style . '">';
/*
		if($image){
			$left_full = ' left_full';
			$out .= '<div class="img_wrap">';
			$out .= '<img src="' . $image . '" alt="' . $title . '"/>';
			$out .= '</div>';
		} else {
			$left_full = '';
		}
*/
			$left_full = '';
		if($link != 'not'){
			$out .= '<div class="btn_wrap">';
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
			if($btn_text){
				$btn_text_out = $btn_text;
			} else {
				$btn_text_out = 'Look';
			}
				$right_full = ' right_full';
				$out .= '<a class="btn1 large_button" href="' . $link . '" title="' . $btn_text_out . '"' . $target . $rel . '>';
				$out .=$btn_text_out;
				$out .= '</a>';
			$out .= '</div>';
		} else {
			$right_full = '';
		}
		if($title){
			$out .= '<div class="content_wrap' . $left_full . $right_full . '">';
			$out .= '<h4 style="' . $message_text_style . '">' . $title . '</h4>';
			$out .= '<p style="' . $message_text_style . '">' . $content . '</p>';
			$out .= '</div>';
		}
		$out .= '<div class="clearboth"></div>';
		$out .= '</div>';
/*		$out .= '<div class="message_bottom" style="' . $message_bottom_style . '"></div>';
		$out .= '<div class="message_shadow" style="' . $message_shadow_style . '"></div>';
*/
		$out .= '</div>';
		$out .= '</div>';
		$out .= '<div class="clearboth"></div>';
		$out .= '</div><!-- /.message-->';
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
			'name' => __( 'Banners', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'banner',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>
