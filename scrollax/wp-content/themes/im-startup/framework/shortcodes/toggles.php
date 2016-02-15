<?php
/**
 *
 */
class missToggles {
	
	/**
	 *
	 */
	public static function toggles_group( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range( 1,10 );
			$option  = array(
				'name' => __( 'Toggles', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'toggles_group',
				'options' => array(
					array(
						'name' => __( 'Caption <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter overall block caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Tagline <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter overall block alternative caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'tagline',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Toggle Title Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please specify caption colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'toggles_title_color',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Framed Toggles <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Use framed style for this toggle.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'framed',
						'options' => array( 'true' => __('Put toggle title in a frame', MISS_ADMIN_TEXTDOMAIN )),
						'type' => 'checkbox',
						'shortcode_dont_multiply' => true,
					),
					array(
						'name' => __( 'Toggle Frame Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please specify toggle frame colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'toggles_frame_color',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Accordion <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'When using an accordian only one toggle can be opened at a time.<br /><br />When clicking on another toggle the previous one will close before opening the next.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'accordion_group',
						'options' => array( 'true' => __('Group toggles into an accordion set', MISS_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
						'shortcode_dont_multiply' => true,
//						'shortcode_optional_wrap' => true
					),
					array(
						'name' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Turn on CSS3 transitions. You may specify animation effect.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'animation',
						'default' => '',
						'type' => 'select',
						'target'=> 'css_animation',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
					array(
						'name' => __( 'Total Number of Additional Toggles <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select more toggles to display in the group.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Toggle 1 Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title that will display with your toggle.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Toggle 1 Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your toggle.  Shortcodes are accepted.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'toggle',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			return $option;
		}

		$out = '';
		extract(
			shortcode_atts(
				array(
					'caption'	=> '',
					'tagline'	=> '',
					'accordion_group' => '',
					'animation' => '',
					'toggles_title_color'	=> '',
					'toggles_frame_color'	=> '',
					'framed' => '',
	    		), 
	    		$atts
	    	)
		);

		if ( !empty( $animation )) {
			$animation = ' im-transform im-animate-element ' . $animation;
		}


		$togle_class = ( $accordion_group == 'true' ) ? 'toggle_accordion' : 'toggle';
		$framed = ( $framed == 'true' ) ? ' framed' : '';
		$color = ( $toggles_title_color != '' ) ? $toggles_title_color : ''/*'rgba(32,86,133, 1)'*/;
		$bg_color = ( $toggles_frame_color != '' ) ? $toggles_frame_color : ''/*'rgba(237,246,248, 1)'*/;
		$bg_color = ( $framed != '' ) ? $bg_color : '';
		$plus_minus_bg_color = ( $framed != '' ) ? 'background-color:' . $color . ';' : '';


		if($caption != ''){
			$out .= '					<div class="blog_header">';
			$out .= '						<h4 class="pull-left caption">';
			$out .= '							' . $caption;
			$out .= '						</h4>';
			$out .= '						<h6 class="pull-left tagline">';
			$out .= '							' . $tagline;
			$out .= '						</h6>';
			$out .= '						<div class="clearboth">';
			$out .= '						</div>';
			$out .= '					</div><!-- /.blog_header-->';
		}

		if ( !preg_match_all( '/(.?)\[(toggle)\b(.*?)(?:(\/))?\](?:(.+?)\[\/toggle\])?(.?)/s', $content, $matches ) ) {
			return miss_content_group( $content );
			// No items, do nothing
		} else {

			$out .= '<div>';
			for ($i = 0; $i < count( $matches[0] ); $i++ ) {
				$matches[3][$i] = strstr( $matches[3][$i], '"' ); 
				$out .= '<div class="' . $togle_class . ' toggle_header' . $animation . '" style="background-color:' . $bg_color .'; color:' . $color . ';"><span class="plus_minus" style="color:' . $color . ';"><span class="plus_minus_alt" style="background-color:' . $color .'; color:' . $bg_color . ';"></span></span><a href="#" style="color:' . $color . ';">' . str_replace('"', '', $matches[3][$i]) . '</a></div>';
				$out .= '<div class="toggle_content" style="display: none;">';
				$out .= '<div class="block">';
				$out .= miss_content_group( $matches[5][$i] );
				$out .= '</div>';
				$out .= '</div>';
			}
			$out .= '</div>';
			return '<div class="toggle_frame_set' . $framed .'">' . $out . '</div>';
		}
	}

	/**
	 *
	 */
	public static function toggle_framed( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range( 1,10 );
			$option  = array(
				'name' => __( 'Framed Toggles', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'toggle_framed',
				'options' => array(
					array(
						'name' => __( 'Caption <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter overall block caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Tagline <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter overall block alternative caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'tagline',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Toggle Title Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please specify caption colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'toggles_title_color',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Framed Toggles <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Use framed style for this toggle.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'framed',
						'options' => array( 'true' => __('Put toggle title in a frame', MISS_ADMIN_TEXTDOMAIN )),
						'type' => 'checkbox',
						'shortcode_dont_multiply' => true,
					),
					array(
						'name' => __( 'Toggle Frame Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please specify toggle frame colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'toggles_frame_color',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Accordion <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'When using an accordian only one toggle can be opened at a time.<br /><br />When clicking on another toggle the previous one will close before opening the next.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'accordion_group',
						'options' => array( 'true' => __('Group toggles into an accordion set', MISS_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
						'shortcode_dont_multiply' => true,
//						'shortcode_optional_wrap' => true
					),
					array(
						'name' => __( 'Total Number of Additional Toggles <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select more toggles to display in the group.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Toggle 1 Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title that will display with your toggle.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Toggle 1 Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your toggle.  Shortcodes are accepted.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'toggle',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			return $option;
		}

		$out = '';
		extract(
			shortcode_atts(
				array(
					'caption'	=> '',
					'tagline'	=> '',
					'accordion_group' => '',
					'toggles_title_color'	=> '',
					'toggles_frame_color'	=> '',
					'framed' => '',
	    		), 
	    		$atts
	    	)
		);
		$togle_class = ( $accordion_group == 'true' ) ? 'toggle_accordion' : 'toggle';
		$framed = ( $framed == 'true' ) ? ' framed' : '';
		$color = ( $toggles_title_color != '' ) ? $toggles_title_color : ''/*'rgba(32,86,133, 1)'*/;
		$bg_color = ( $toggles_frame_color != '' ) ? $toggles_frame_color : ''/*'rgba(237,246,248, 1)'*/;
		$bg_color = ( $framed != '' ) ? $bg_color : '';
		$plus_minus_bg_color = ( $framed != '' ) ? 'background-color:' . $color . ';' : '';


		if($caption != ''){
			$out .= '					<div class="blog_header">';
			$out .= '						<h4 class="pull-left caption">';
			$out .= '							' . $caption;
			$out .= '						</h4>';
			$out .= '						<h6 class="pull-left tagline">';
			$out .= '							' . $tagline;
			$out .= '						</h6>';
			$out .= '						<div class="clearboth">';
			$out .= '						</div>';
			$out .= '					</div><!-- /.blog_header-->';
		}

		if ( !preg_match_all( '/(.?)\[(toggle)\b(.*?)(?:(\/))?\](?:(.+?)\[\/toggle\])?(.?)/s', $content, $matches ) ) {
			return miss_content_group( $content );
			// No items, do nothing
		} else {

			$out .= '<div class="emerging_group">';
			for ($i = 0; $i < count( $matches[0] ); $i++ ) {
				$matches[3][$i] = strstr( $matches[3][$i], '"' ); 
				$out .= '<div class="' . $togle_class . ' toggle_header" style="background-color:' . $bg_color .'; color:' . $color . ';"><span class="plus_minus" style="color:' . $color . ';"><span class="plus_minus_alt" style="background-color:' . $color .'; color:' . $bg_color . ';"></span></span><a href="#" style="color:' . $color . ';">' . str_replace('"', '', $matches[3][$i]) . '</a></div>';
				$out .= '<div class="toggle_content" style="display: none;">';
				$out .= '<div class="block">';
				$out .= miss_content_group( $matches[5][$i] );
				$out .= '</div>';
				$out .= '</div>';
			}
			$out .= '</div>';
			return '<div class="toggle_frame_set' . $framed .'">' . $out . '</div>';
		}
	}

	/**
	 *
	 */
	public static function _options($class) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __( 'Toggles', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Toggles and Accordions', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'toggles_group',
			'options' => $shortcode,
			'shortcode_has_types' => true,
		);
		
		return $options;
	}
	
}

?>
