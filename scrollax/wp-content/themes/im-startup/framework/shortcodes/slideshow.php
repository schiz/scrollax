<?php
/**
 *
 */
class missSlideshow {
	
	/**
	 *
	 */
	public static function slider( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);
			$option = array( 
				'name' => __( 'Flex Slideshow', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'slider',
				'options' => array(
					array(
						'name' => __( 'Controls Style', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select Controls Style.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'controls_type',
						'default' => 'circles',
						'options' => Array(
							'arrows' => __( 'Arrow buttons on sides', MISS_ADMIN_TEXTDOMAIN ),
							'arrows_top' => __( 'Arrow buttons in top right corner', MISS_ADMIN_TEXTDOMAIN ),
							'circles' => __( 'Both Pagination', MISS_ADMIN_TEXTDOMAIN ),
							'all' => __( 'Arrows Buttons and Pagination', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of Slides', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of slides you wish to display. Slides are the selectable areas which change the content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Slide Type 1', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select slide type.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'slide_type',
						'default' => '',
						'type' => 'select',
						'options' => Array(
							'image' => 'Image URL',
							'embedded' => 'Embedded or Custom Code: HTML/Vimeo/Youtube/etc',
						),
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Slide Content 1', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter the image URL or Embedded code here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Link 1', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter slide link URL.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'url',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'slide',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			return $option;
		}
		extract(shortcode_atts(array(
			'controls_type'	=> 'arrows',
	    ), $atts));
		if (!preg_match_all("/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s", $content, $matches)) {
			return $content;
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			$out = '<div class="flexslider">';
			$out .= '<ul class="slides">';
			for($i = 0; $i < count($matches[0]); $i++) {
				$slide_type = ( isset( $matches[3][$i]['slide_type'] ) ) ? $matches[3][$i]['slide_type'] : 'default';
				$url = isset($matches[3][$i]['url']) ? $matches[3][$i]['url'] : "#";
				$out .= '<li class="' . $slide_type . '">';
				if ($slide_type == "image") {
					//$image = mb_str_replace( "×", "x", $matches[5][$i] );
					//$image = str_replace('×', 'x', $image);
					//$image = preg_replace('/[^(\xC3\x97)]*/','', $matches[5][$i]);
					//$image = mb_ereg_replace('/[^\xC3\x97]*/','x', $matches[5][$i]);
					$image = esc_url( $matches[5][$i] );
					//$image = str_replace('×', "\x78", $image);
					$image = str_replace('%C3%97', "\x78", $image);
					
					if (!empty($url)) {
						$out .= '<a href="' . $url . '">';
					}
					$out .= '<img src="' . $image . '" alt="" />';
					if (!empty($url)) {
						$out .= '</a>';
					}
				} else {
					$out .= do_shortcode( miss_content_group( $matches[5][$i] ) );
				}
				$out .= '</li>';
			}
			$out .= '</ul>';
			$out .= '</div>';
			return '<div class="flex_slideshow_container ' . $controls_type . ' im-transform im-animate-element fade-in">' . $out . '</div>';
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
			'name' => __( 'Slideshow', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of slider you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'slider',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
