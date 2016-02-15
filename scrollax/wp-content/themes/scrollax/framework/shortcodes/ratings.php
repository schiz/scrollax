<?php
/**
 *
 */
class missRatings {
	
	/**
	 *
	 */
	public static function ratings( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);
			$scores  = Array(
				'0.5' => '0.5',
				'1'   => '1',
				'1.5' => '1.5',
				'2'   => '2',
				'2.5' => '2.5',
				'3'   => '3',
				'3.5' => '3.5',
				'4'   => '4',
				'4.5' => '4.5',
				'5'   => '5',
			);
			$option  = array( 
				'name' => __( 'Stars', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'ratings',
				'options' => array(
					array(
						'name' => __( 'Number of Bars', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of slides you wish to display. Slides are the selectable areas which change the content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Show Total', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this option to display total score.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'show_overall',
						'default' => '',
						'type' => 'checkbox',
						'options' => Array(
							'true' => __( 'Enable Total Score', MISS_ADMIN_TEXTDOMAIN )
						),
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
					array(
						'name' => __( 'Icon', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please select score icon type.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon',
						'default' => 'im-icon-accessibility',
						'type' => 'icons',
						'target'=> 'all_icons',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),

					array(
						'name' => __( 'Active Colour', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please select active icon colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'style_color',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
					array(
						'name' => __( 'Inactive Colour', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please select inactive icon colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'style_color2',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),

					array(
						'name' => __( 'Icon size', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Change icon size.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'size',
						'default' => '18',
						'type' => 'numeral',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),

					array(
						'name' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Turn on CSS3 transitions. You may specify animation effect.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'animation',
						'default' => 'im-icon-android',
						'type' => 'select',
						'target'=> 'css_animation',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),

					array(
						'name' => __( 'Criteria 1 Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter criteria title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Criteria 1 Value', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Define score value from 0.5 to 5.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'score',
						'default' => '',
						'type' => 'select',
						'options' => $scores,
						'shortcode_multiply' => true
					),
					array(
						'value' => 'score',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			return $option;
		}
		if (!preg_match_all("/(.?)\[(score)\b(.*?)(?:(\/))?\](?:(.+?)\[\/score\])?(.?)/s", $content, $matches)) {
			return miss_content_group( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			extract(shortcode_atts(array(
				'size' => '18', 
				'animation'   => '',
				'icon' => 'im-icon-star',
		    ), $atts));


			$out = '';

			$out .= ( !empty( $atts['caption'] )) ? '<h4><span>' . $atts['caption'] . '</span></h4>' : '';

			$atts['animation'] = ( !empty( $atts['animation'] )) ? ' im-transform im-animate-element ' . $atts['animation'] : '';
			$atts['size'] = ( !empty( $atts['size'] )) ? $atts['size'] : '18';
			$atts['style_color'] = ( !empty( $atts['style_color'] )) ? $atts['style_color'] : '';
			$atts['style_color2'] = ( !empty( $atts['style_color2'] )) ? $atts['style_color2'] : '';

			$out .= '<ul class="rates">';
			$overall = 0;
			$counter = 0;
			for($i = 0; $i < count($matches[0]); $i++) {
				$counter++;
				$rating = $matches[3][$i]['score'];
				if (!isset( $atts['icon'] ) ) {  $atts['icon'] = 'im-icon-star-6'; }
				$out .= '<li class="rating_row' . $atts['animation'] . '">';
				$out .= $matches[5][$i];
				$out .= '<div class="rating_right">';
				$out .= score_output($rating, $atts['size'], $atts['style_color'], $atts['style_color2'], $atts['icon']);
				$out .= '</div>';
				$out .= '</li>';
				$overall += $rating;
			}
			$out .= '</ul>';
			if ( isset($atts['show_overall']) && $atts['show_overall'] == "true" ) {
				if ($counter > 1 ) {
					$out .= '<div class="overall_rating' . $atts['animation'] . '">';
					$overall = $overall / $counter;
					$overget = $overall - floor($overall);
					if ($overget >= 0.5) {
						$overall = floor($overall) + .5;
					} else {
						$overall = floor($overall);
					}
					$out .= "<h4><span class='uppercase transform-uppercase'>". __("Total", MISS_TEXTDOMAIN) . "</span></h4><div class='total-inner'><span class='score total'>".$overall."</span><span class='right'>".score_output($overall, '40', $atts['style_color'], $atts['style_color2'], $atts['icon'])."</span></div>";
					$out .= '</div>';
				}
			}
			return '<div class="rating_box shortcode">' . $out . '</div>';
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
			'name' => __( 'Ratings', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of ratings you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'ratings',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
