<?php
/**
 *
 */
class missDropcap {
	
	/**
	 *
	 */
	public static function dropcap1( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Drop Cap 1', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'dropcap1',
				'options' => array(
					array(
						'name' => __( 'Drop Cap Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the letter you wish to display as your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'bgcolor'	=> ''
	    ), $atts));
	
		$style = ( !empty( $bgcolor ) ) ? 'background-color:' . $bgcolor . ';': 'background-color:#205685;' ;
		$style .= ( !empty( $textcolor ) ) ? ' color:' . $textcolor . ';': ' color:#ffffff;' ;
		
		return '<span class="dropcap" style="' . $style . '">' . miss_content_group( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	public static function dropcap2( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Drop Cap 2', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'dropcap2',
				'options' => array(
					array(
						'name' => __( 'Drop Cap Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the letter you wish to display as your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
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
		
	    $style = '';
		$style .= ( !empty( $textcolor ) ) ? ' color:' . $textcolor . ';': 'color:#205685;' ;
		
		return '<span class="dropcap2" style="' . $style . '">' . miss_content_group( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	public static function dropcap3( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Drop Cap 3', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'dropcap3',
				'options' => array(
					array(
						'name' => __( 'Drop Cap Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the letter you wish to display as your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'bgcolor'	=> ''
	    ), $atts));
					
		$style = ( !empty( $bgcolor ) ) ? 'background-color:' . $bgcolor . ';': 'background-color:#205685;' ;
		$style .= ( !empty( $textcolor ) ) ? ' color:' . $textcolor . ';': ' color:#ffffff;' ;
		
		return '<span class="dropcap3" style="' . $style . '">' . miss_content_group( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	public static function dropcap4( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Drop Cap 4', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'dropcap4',
				'options' => array(
					array(
						'name' => __( 'Drop Cap Text', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the letter you wish to display as your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your dropcap.', MISS_ADMIN_TEXTDOMAIN ),
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
		
		return '<span class="dropcap4" style="' . $style . '">' . miss_content_group( $content ) . '</span>';
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
			'name' => __( 'Dropcaps', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of dropcap you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'dropcaps',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
