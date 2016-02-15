<?php
/**
 *
 */
class missPerson {
	
	/**
	 *
	 */
	public static function person( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option  = array(
				'name' => __( 'Person', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'person',
				'options' => array(
					// array(
					// 	'name' => __( 'Number of Persons', MISS_ADMIN_TEXTDOMAIN ),
					// 	'desc' => __( 'Select the number of slides you wish to display. Slides are the selectable areas which change the content.', MISS_ADMIN_TEXTDOMAIN ),
					// 	'id' => 'multiply',
					// 	'default' => '1',
					// 	'min' => 1,
					// 	'max' => 4,
					// 	'unit' => 'persons',
					// 	'type' => 'range',
					// 	'shortcode_multiplier' => true

					// ),
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
						'name' => __( 'Full Name', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter person full name.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'name',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter person title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),

					array(
						'name' => __( 'Portrait URL', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can upload the image for this person.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'picture',
						'type' => 'upload',
						'shortcode_dont_multiply' => true
					),

					array(
						'name' => __( 'Details', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter person details.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					// array(
						// 'value' => 'office_unit',
						// 'nested' => true
					// ),
				'shortcode_has_atts' => true,
				)
			);
			return $option;
		}


		extract(shortcode_atts(array(
			'name'  => '',
			'title' => '',
			'picture' => '',
			'animation' => ''
		), $atts));
		if ( !empty( $animation )) {
			$animation = ' im-transform im-animate-element ' . $animation;
		}

		$out = '';
	// if ( !preg_match_all( '/(.?)\[(marker)\b(.*?)(?:(\/))?\](?:(.+?)\[\/marker\])?(.?)/s', $content, $matches ) ) {
		$out .= '<h3 class="person name">' . $name;
		if ( !empty( $title ) ) {
			$out .= '<span class="person title" style="font-size: 70%"> / ' . $title . '</span>';
		}
		$out .= '</h3>';
		$out .= '<div class="person image"><img src="' . $picture . '" style="image-resize w" /></div>';
		$out .= '<p class="person details" style="font-style: italic; font-size: 16px; padding: 10px; background-color: rgba(128,128,128,0.05)">' . $content . '</p>';
		// for($i = 0; $i < count($matches[0]); $i++) {
		// 	$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
		// }
		
		return '<div class="office_unit_sc' . $animation . '">' . $out . '</div>';
//		}
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
			'name' => __( 'Person', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'person',
			'options' => $shortcode,
//			'shortcode_has_types' => true,
		);
		
		return $options;
	}
	
}

?>
