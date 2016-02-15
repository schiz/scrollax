<?php
/**
 *
 */
class missMiscellaneous {

	/**
	 *
	 */
	public static function styled_amp( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Styled Amp', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'styled_amp'
			);

			return $option;
		}
		
		return '<span class="styled_amp">&amp;</span>';
	}

	/**
	 *
	 */
	public static function divider( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Divider', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'divider'
			);

			return $option;
		}
			
		return '<div class="divider"></div>';
	}
	
	/**
	 *
	 */
	public static function divider_top( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Divider Top', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'divider_top'
			);

			return $option;
		}
			
		return '<div class="divider top"><a href="#">' . __( 'Top', MISS_TEXTDOMAIN ) . '</a></div>';
	}
	
	/**
	 *
	 */
	public static function divider2( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Darken Divider', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'divider2'
			);

			return $option;
		}
			
		return '<div class="divider2 im-transform im-animate-element fade-in"></div>';
	}
	
	/**
	 *
	 */
	public static function divider3( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Triangle Divider', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'divider3'
			);

			return $option;
		}
			
		return '<div class="divider3 im-transform im-animate-element fade-in"></div>';
	}
	
	/**
	 *
	 */
	public static function divider4( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Triangle Divider (lite)', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'divider4'
			);

			return $option;
		}
			
		return '<div class="divider4 im-transform im-animate-element fade-in"></div>';
	}
	
	/**
	 *
	 */
	public static function divider5( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Dotted Divider', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'divider5'
			);

			return $option;
		}
			
		return '<div class="divider5 im-transform im-animate-element fade-in"></div>';
	}
	
	/**
	 *
	 */
	public static function divider6( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Dashed Divider', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'divider6'
			);

			return $option;
		}
			
		return '<div class="divider6 im-transform im-animate-element fade-in"></div>';
	}
	
	/**
	 *
	 */
	public static function clearboth( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Clearboth', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'clearboth'
			);

			return $option;
		}
			
		return '<div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	public static function div( $atts = null, $content = null, $code = null ) {
		$option = array( 
			'name' => __( 'Div', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'div',
			'options' => array(
				array(
					'name' => __( 'Class', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type in the name of the class you wish to assign to this div.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'class',
					'default' => '',
					'type' => 'text',
				),
				array(
					'name' => __( 'Style', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'You can set a custom style here for your div.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'style',
					'default' => '',
					'type' => 'text',
				),
				array(
					'name' => __( 'Content', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type in the content that you wish to display inside this div.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea',
				),
			'shortcode_has_atts' => true,
			)
		);
		
		if( $atts == 'generator' )
			return $option;
			
		extract(shortcode_atts(array(
			'style'      => '',
			'class'      => '',
	    	), $atts));

	   return '<div class="' . $class . ' im-transform im-animate-element fade-in" style="' . $style . '">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function span( $atts = null, $content = null, $code = null ) {
		$option = array( 
			'name' => __( 'Span', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'span'
		);
		
		if( $atts == 'generator' )
			return $option;
			
		extract(shortcode_atts(array(
			'style'      => '',
			'class'      => '',
	    	), $atts));

	   return '<span class="' . $class . '" style="' . $style . '">' . miss_content_group( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	public static function teaser( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Teaser', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'teaser'
			);

			return $option;
		}

		return '<p class="teaser"><span>' . miss_content_group( $content ) . '</span></p>';
	}
	
	/**
	 *
	 */
	public static function hidden( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Hidden', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'hidden'
			);

			return $option;
		}

		return '<div class="hidden">' . miss_content_group( $content ) . '</div>';
	}

	/**
	 *
	 */
	public static function margin10( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin10', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin10'
			);

			return $option;
		}
			
		return '<div class="margin10">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function margin20( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin20', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin20'
			);

			return $option;
		}
			
		return '<div class="margin20">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function margin30( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin30', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin30'
			);

			return $option;
		}
			
		return '<div class="margin30">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function margin40( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin40', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin40'
			);

			return $option;
		}
			
		return '<div class="margin40">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function margin50( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin50', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin50'
			);

			return $option;
		}
		
		return '<div class="margin50">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function margin60( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin60', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin60'
			);

			return $option;
		}
			
		return '<div class="margin60">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function margin70( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin70', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin70'
			);

			return $option;
		}
			
		return '<div class="margin70">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function margin80( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin80', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin80'
			);

			return $option;
		}
			
		return '<div class="margin80">' . miss_content_group( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	public static function margin90( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin90', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'margin90'
			);

			return $option;
		}
		
		return '<div class="margin90">' . miss_content_group( $content ) . '</div>';
	}

	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __( 'Miscellaneous', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select which Miscellaneous shortcode you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'miscellaneous',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
}
?>
