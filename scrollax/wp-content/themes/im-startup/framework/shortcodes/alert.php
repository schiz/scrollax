<?php
/**
 *
 */
class missAlert {
	
	/**
	 *
	 */
	public static function alertbox1( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Warning Box', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'alertbox1',
				'options' => array(
					array(
						'name' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alert box caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Box Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alert box text content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
                    array(
                        'name' => __( 'Close Button <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
                        'desc' => __( 'Check this option to add close button to this alert box.', MISS_ADMIN_TEXTDOMAIN ),
                        'id' => 'close',
                        'default' => '',
                        'options' => Array (
                                'true' =>  __( 'Add close button', MISS_ADMIN_TEXTDOMAIN ),
                        ),
                        'type' => 'checkbox',
		            ),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'close'	=> '',
			'caption' => ''
		), $atts));
		$caption = ( $caption ) ? '<h4>' . $caption . '</h4>' : '';
		$close = ( $close ) ? '<div class="closeBtn closeParent close" data-dismiss="alert">×</div>' : '';
		
		$out = '<div class="alert alert-block im-transform im-animate-element scale-up">' . $close . $caption . miss_content_group( $content ) . '</div>';
		$out = do_shortcode( $out );
		return $out;
	}
	
	/**
	 *
	 */
	public static function alertbox2( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Error Box', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'alertbox2',
				'options' => array(
					array(
						'name' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alert box caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Box Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alert box text content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
                    array(
                            'name' => __( 'Close Button <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
                            'desc' => __( 'Check this option to add close button to this alert box.', MISS_ADMIN_TEXTDOMAIN ),
                            'id' => 'close',
                            'default' => '',
                            'options' => Array (
                                    'true' =>  __( 'Add close button', MISS_ADMIN_TEXTDOMAIN ),
                            ),
                            'type' => 'checkbox',
                    ),				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'close'	=> '',
			'caption' => ''
		), $atts));
		$caption = ( $caption ) ? '<h4>' . $caption . '</h4>' : '';
		$close = ( $close ) ? '<div class="closeBtn closeParent close" data-dismiss="alert">×</div>' : '';
		$out = '<div class="alert alert-error im-transform im-animate-element scale-up">' . $close . $caption . miss_content_group( $content ) . '</div>';
		$out = do_shortcode( $out );
		return $out;
	}
	
	/**
	 *
	 */
	public static function alertbox3( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Success Box', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'alertbox3',
				'options' => array(
					array(
						'name' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alert box caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Box Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alert box text content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
                    array(
                            'name' => __( 'Close Button <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
                            'desc' => __( 'Check this option to add close button to this alert box.', MISS_ADMIN_TEXTDOMAIN ),
                            'id' => 'close',
                            'default' => '',
                            'options' => Array (
                                    'true' =>  __( 'Add close button', MISS_ADMIN_TEXTDOMAIN ),
                            ),
                            'type' => 'checkbox',
                    ),				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'close'	=> '',
			'caption' => ''
		), $atts));
		$caption = ( $caption ) ? '<h4>' . $caption . '</h4>' : '';
		$close = ( $close ) ? '<div class="closeBtn closeParent close" data-dismiss="alert">×</div>' : '';
		
		$out = '<div class="alert alert-success im-transform im-animate-element scale-up">' . $close . $caption . miss_content_group( $content ) . '</div>';
		$out = do_shortcode( $out );
		return $out;
	}
	
	/**
	 *
	 */
	public static function alertbox4( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Info Box', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'alertbox4',
				'options' => array(
					array(
						'name' => __( 'Caption', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alert box caption.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Box Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alert box text content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
                    array(
                            'name' => __( 'Close Button <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
                            'desc' => __( 'Check this option to add close button to this alert box.', MISS_ADMIN_TEXTDOMAIN ),
                            'id' => 'close',
                            'default' => '',
                            'options' => Array (
                                    'true' =>  __( 'Add close button', MISS_ADMIN_TEXTDOMAIN ),
                            ),
                            'type' => 'checkbox',
                    ),				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'close'	=> '',
			'caption' => ''
		), $atts));
		$caption = ( $caption ) ? '<h4>' . $caption . '</h4>' : '';
		$close = ( $close ) ? '<div class="closeBtn closeParent close" data-dismiss="alert">×</div>' : '';
		
		$out = '<div class="alert alert-info im-transform im-animate-element scale-up">' . $close . $caption . miss_content_group( $content ) . '</div>';
		$out = do_shortcode( $out );
		return $out;
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
			'name' => __( 'Alert Box', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of alertbox you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'alertbox',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
