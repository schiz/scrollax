<?php
/**
 *
 */
class missHighlights {
	
	/**
	 *
	 */
	public static function highlight1( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Highlight 1', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'highlight1',
				'options' => array(
					array(
						'name' => __( 'Highlight Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your highlight.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your highlight.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your highlight.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'bgcolor'	=> '',
			'textcolor'	=> ''
	    ), $atts));

		$style = ( !empty( $bgcolor ) ) ? 'background-color:' . $bgcolor . ';': 'background-color:#205685;' ;
		$style .= ( !empty( $textcolor ) ) ? ' color:' . $textcolor . ';': ' color:#ffffff;' ;
			
		return '<span class="highlight" style="' . $style . '">' . miss_content_group( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	public static function highlight2( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Highlight 2', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'highlight2',
				'options' => array(
					array(
						'name' => __( 'Highlight Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your highlight.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Custom Line Bolow Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your highlight.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'textcolor'	=> ''
	    ), $atts));
	
		$style = ( !empty( $textcolor ) ) ? ' color:' . $textcolor . ';': ' color:#205685;' ;
			
		return '<span class="highlight2" style="' . $style . '">' . miss_content_group( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Highlights', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of highlight you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'highlights',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
