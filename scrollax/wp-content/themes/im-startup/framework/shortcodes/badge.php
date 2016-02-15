<?php
/**
 *
 */
class missBadge {
	
	/**
	 *
	 */
	public static function badge1( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Grey', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'badge1',
				'options' => array(
					array(
						'name' => __( 'Badge', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the badge text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="badge">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function badge2( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Success', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'badge2',
				'options' => array(
					array(
						'name' => __( 'Badge Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the badge text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="badge badge-success">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function badge3( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Warning', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'badge3',
				'options' => array(
					array(
						'name' => __( 'Badge Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the badge text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="badge badge-warning">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function badge4( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Important', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'badge4',
				'options' => array(
					array(
						'name' => __( 'Badge Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the badge text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="badge badge-important">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function badge5( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Info', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'badge5',
				'options' => array(
					array(
						'name' => __( 'Badge Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the badge text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="badge badge-info">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function badge6( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Black', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'badge6',
				'options' => array(
					array(
						'name' => __( 'Badge Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the badge text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="badge badge-inverse">' . $content . '</span>';
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
			'name' => __( 'Badge', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of badge you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'badge',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
