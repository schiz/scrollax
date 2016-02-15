<?php
/**
 *
 */
class missCaptions {
	/**
	 *
	 */
	public static function captions( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			$option = array( 
				'name' => __( 'Custom Captions', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'captions',
				'options' => array(

					array(
						'name' => __( 'Font Size', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select custom font size.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'size',
						'default' => '36',
						'unit' => 'px',
						'min' => 0,
						'max' => 76,
						'step' => 1,
						'type' => 'range',
					),

					array(
						'name' => __( 'Margin Top', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select top margin.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'margin_top',
						'default' => '5',
						'unit' => 'px',
						'min' => 0,
						'max' => 76,
						'step' => 1,
						'type' => 'range',
					),

					array(
						'name' => __( 'Margin Bottom', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select bottom margin.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'margin_bottom',
						'default' => '20',
						'unit' => 'px',
						'min' => 0,
						'max' => 76,
						'step' => 1,
						'type' => 'range',
					),

					array(
						'name' => __( 'Caption Tag', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify custom tag.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'tag',
						'default' => 'h2',
						'options' => array(
							'h1' => 'H1',
							'h2' => 'H2',
							'h3' => 'H3',
							'h4' => 'H4',
							'h5' => 'H5',
							'h6' => 'H6',
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Weight', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify font weight.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'weight',
						'default' => '600',
						'options' => array(
							'100' => '100',
							'300' => '300',
							'400' => '400',
							'600' => '600',
							'900' => '900',
						),
						'type' => 'select',
					),

					array(
						'name' => __( 'Align', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify text aligh.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => 'left',
						'options' => array(
							'left' => 'left',
							'center' => 'center',
							'right' => 'right',
						),
						'type' => 'select',
					),

					array(
						'name' => __( 'Colour', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify custom colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'color',
						'default' => 'rgba(50,50,50,1)',
						'alpha' => true,
						'type' => 'color',
					),

					array(
						'name' => __( 'Uppercase', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Use uppercase option.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'uppercase',
						'options' => array( 'true' => __('Enable uppercase for text', MISS_ADMIN_TEXTDOMAIN )),
						'type' => 'checkbox',
					),

					array(
						'name' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Insert here your custom title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => __( 'Custom Caption', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);
		
			return $option;
		}
			
		extract(shortcode_atts(array(
			'tag'   => 'h2',
			'weight' => '900',
			'align' => 'left',
			'color'   => 'rgba(50,50,50,1)',
			'size' => '36',
			'margin_top' => '5',
			'margin_bottom' => '20',
			'uppercase' => false,
	    ), $atts));

	    /* Creating custom style */
		$style = '';
		$style .= 'text-align: ' . $align . ';';
		$style .= 'line-height: ' . ( $size - 2 ) . 'px;';
		$style .= 'text-align: ' . $align . ';';
		$style .= 'margin-top: ' . $margin_top . 'px;';
		$style .= 'margin-bottom: ' . $margin_bottom . 'px;';
		$style .= 'line-height: ' . ( $size - 2 ) . 'px;';
		$style .= 'color: ' . $color . ';';
		$style .= 'font-size: ' . $size . 'px;';
		$style .= 'font-weight: ' . $weight . ';';
		if ( $uppercase ) {
			$style .= ' text-transform: uppercase;';
		}

		/* Building Output */
		$out = '<' . $tag . ' style="' . $style . '">' . $content . '</' . $tag . '>';
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
			'name' => __( 'Custom Captions', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'captions',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>
