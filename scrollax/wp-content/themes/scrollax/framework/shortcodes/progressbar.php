<?php
/**
 *
 */
class missProgressbar {
	
	/**
	 *
	 */
	public static function progress( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);
			$scores  = range(1,100);
			$option  = array(
				'name' => __( 'Progress Bar', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'progress',
				'options' => array(
					array(
						'name' => __( 'Type', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select bar type.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'type',
						'default' => 'think',
						'options' => Array(
							'think' => __( 'Think Progress Bar', MISS_ADMIN_TEXTDOMAIN ),
							'heavy' => __( 'Heavy Progress Bar', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
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
						'name' => __( 'Customise Colours', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this option to enable custom colours and backgrounds below.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'custom',
						'default' => '',
						'type' => 'checkbox',
						'options' => Array(
							'true' => __( 'Enable Customisation', MISS_ADMIN_TEXTDOMAIN )
						),
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
					array(
						'name' => __( 'Animate Loading', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this option to enable progress bar animation load.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'animation',
						'default' => '',
						'type' => 'checkbox',
						'options' => Array(
							'true' => __( 'Enable Animation Load', MISS_ADMIN_TEXTDOMAIN )
						),
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
					array(
						'name' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this option to enable progress bar animation background.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'animate',
						'default' => '',
						'type' => 'checkbox',
						'options' => Array(
							'true' => __( 'Enable Animation Background', MISS_ADMIN_TEXTDOMAIN )
						),
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your progress bar.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true,
					),
					array(
						'name' => __( 'Custom Primary Gradient top Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change background of the text that appears on your progress bar.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'gradient_1',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true,
					),
					array(
						'name' => __( 'Custom Primary Gradient bottom Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change background of the text that appears on your progress bar.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'gradient_2',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true,
					),
					array(
						'name' => __( 'Custom Secondary Background <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change secondary background of the text that appears on your progress bar.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bg2Color',
						'default' => '',
						'type' => 'color',
						'shortcode_dont_multiply' => true,
					),
					array(
						'name' => __( 'Corners <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the corner type for bars here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'corners',
						'default' => '',
						'options' => array(
							'r1' => __( 'Soft', MISS_ADMIN_TEXTDOMAIN ),
							'r2' => __( 'Medium', MISS_ADMIN_TEXTDOMAIN ),
							'r3' => __( 'Very Soft', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true,
					),
					array(
						'name' => __( 'Caption 1', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter progressbar caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Score 1', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Define score value from 1 to 100.', MISS_ADMIN_TEXTDOMAIN ),
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
			$out = '';
			$atts['type'] = ( isset( $atts['type'] ) ) ? $atts['type'] : 'think';
			$atts['textcolor'] = ( isset( $atts['textcolor'] ) ) ? $atts['textcolor'] :'';
			$atts['bg2color'] = ( isset( $atts['bg2color'] ) ) ? $atts['bg2color'] :'';
			$atts['gradient_1'] = ( isset( $atts['gradient_1'] ) ) ? $atts['gradient_1'] :'';
			$atts['gradient_2'] = ( isset( $atts['gradient_2'] ) ) ? $atts['gradient_2'] :'';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$score = $matches[3][$i]['score'];
				$class = 'scorebar-inner';
				$class0 = ( !empty( $atts['corners'] ) ) ? ' ' . $atts['corners'] : '' ;
				$size = '';
				$style = '';
				$style0 = '';
				$style2= '';
/*
				$style .= ( !empty( $atts['bg2color'] ) ) ? ' background-color:' . $atts['gradient_1'] . ';': '' ;
				if (!isset($atts['custom']) or $atts['custom'] != "true") {
					$atts['textcolor'] = '#205685';
					$atts['bg2color'] = '#dce0e2';
					$atts['gradient_1'] = '#85c1e6';
				}
*/
				if (!isset($atts['custom']) or $atts['custom'] != "true") {
					$atts['textcolor'] = '';
					$atts['bg2color'] = '';
					$atts['gradient_1'] = '';
					$atts['gradient_2'] = '';
				}
				if (isset($atts['animate']) && $atts['animate'] == "true") {
					$class .= " progress_animation";
					$style .= '
background-image: linear-gradient(right bottom, ' . $atts['gradient_1'] . ' 25%, ' . $atts['gradient_2'] . ' 25%, ' . $atts['gradient_2'] . ' 50%, ' . $atts['gradient_1'] . ' 50%, ' . $atts['gradient_1'] . ' 75%, ' . $atts['gradient_2'] . ' 75%);
background-image: -o-linear-gradient(right bottom, ' . $atts['gradient_1'] . ' 25%, ' . $atts['gradient_2'] . ' 25%, ' . $atts['gradient_2'] . ' 50%, ' . $atts['gradient_1'] . ' 50%, ' . $atts['gradient_1'] . ' 75%, ' . $atts['gradient_2'] . ' 75%);
background-image: -moz-linear-gradient(right bottom, ' . $atts['gradient_1'] . ' 25%, ' . $atts['gradient_2'] . ' 25%, ' . $atts['gradient_2'] . ' 50%, ' . $atts['gradient_1'] . ' 50%, ' . $atts['gradient_1'] . ' 75%, ' . $atts['gradient_2'] . ' 75%);
background-image: -webkit-linear-gradient(right bottom, ' . $atts['gradient_1'] . ' 25%, ' . $atts['gradient_2'] . ' 25%, ' . $atts['gradient_2'] . ' 50%, ' . $atts['gradient_1'] . ' 50%, ' . $atts['gradient_1'] . ' 75%, ' . $atts['gradient_2'] . ' 75%);
background-image: -ms-linear-gradient(right bottom, ' . $atts['gradient_1'] . ' 25%, ' . $atts['gradient_2'] . ' 25%, ' . $atts['gradient_2'] . ' 50%, ' . $atts['gradient_1'] . ' 50%, ' . $atts['gradient_1'] . ' 75%, ' . $atts['gradient_2'] . ' 75%);

background-image: -webkit-gradient(
	linear,
	right bottom,
	left top,
	color-stop(0.25, ' . $atts['gradient_1'] . '),
	color-stop(0.25, ' . $atts['gradient_2'] . '),
	color-stop(0.5, ' . $atts['gradient_2'] . '),
	color-stop(0.5, ' . $atts['gradient_1'] . '),
	color-stop(0.75, ' . $atts['gradient_1'] . '),
	color-stop(0.75, ' . $atts['gradient_2'] . ')
);
';
				} else {
					$style .= '
background-image: linear-gradient(top, ' . $atts['gradient_1'] . ' 0%, ' . $atts['gradient_2'] . ' 100%);
background-image: -o-linear-gradient(top, ' . $atts['gradient_1'] . ' 0%, ' . $atts['gradient_2'] . ' 100%);
background-image: -moz-linear-gradient(top, ' . $atts['gradient_1'] . ' 0%, ' . $atts['gradient_2'] . ' 100%);
background-image: -webkit-linear-gradient(top, ' . $atts['gradient_1'] . ' 0%, ' . $atts['gradient_2'] . ' 100%);
background-image: -ms-linear-gradient(top, ' . $atts['gradient_1'] . ' 0%, ' . $atts['gradient_2'] . ' 100%);
background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, ' . $atts['gradient_1'] . '),color-stop(1, ' . $atts['gradient_2'] . '));';
				}
				$style0 .= ( !empty( $atts['gradient_1'] ) ) ? 'background-color:' . $atts['bg2color'] . ';': '' ;
				$style2 .= ( !empty( $atts['textcolor'] ) ) ? ' color:' . $atts['textcolor'] . ';': '' ;
				
				if (isset($atts['animation']) && $atts['animation'] == "true") {
					$class .= " has_animation";
					$size = 'data-score="'.$score.'"';
				} else {
					$style .= 'width: ' . $score . '%; ';
				}
				
				if ( !empty( $style ) ) {
					$style = ' style="' . $style .'"';
				}
				
				if ( !empty( $style0 ) ) {
					$style0 = ' style="' . $style0 .'"';
				}
				if ( !empty( $style2 ) ) {
					$style2 = ' style="' . $style2 .'"';
				}
				if ( $atts['type'] == 'heavy' ) {
					$out .= '<div class="scorebar' . $class0 . '"' . $style0 . '><div class="' . $class . $class0 . '" ' . $size . $style . '>';
					$out .= '<div class="caption"' . $style2 . '>' . $matches[5][$i] .'</div></div></div>';
				} else {
					$out .= '<div class="caption"' . $style2 . '>' . $matches[5][$i] .'<span class="score">' . $score . '%</span></div>';
					$out .= '<div class="scorebar' . $class0 . '"' . $style0 . '><div class="' . $class . $class0 . '" ' . $size . $style . '></div></div>';
				}
			}
			return '<div class="progress-bars ' . $atts['type'] . '">' . $out . '</div>';
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
			'name' => __( 'Progress Bar', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of slider you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'progress',
			'options' => $shortcode,
//			'shortcode_has_types' => true,
		);
		
		return $options;
	}
	
}

?>
