<?php
/**
 *
 */
class missLabel {
	
	/**
	 *
	 */
	public static function label1( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Grey', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'label1',
				'options' => array(
					array(
						'name' => __( 'Label', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the label text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="label">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function label2( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Success', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'label2',
				'options' => array(
					array(
						'name' => __( 'Label Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the label text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="label label-success">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function label3( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Warning', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'label3',
				'options' => array(
					array(
						'name' => __( 'Label Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the label text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="label label-warning">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function label4( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Important', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'label4',
				'options' => array(
					array(
						'name' => __( 'Label Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the label text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="label label-important">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function label5( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Info', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'label5',
				'options' => array(
					array(
						'name' => __( 'Label Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the label text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="label label-info">' . $content . '</span>';
		return $out;
	}
	
	/**
	 *
	 */
	public static function label6( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Black', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'label6',
				'options' => array(
					array(
						'name' => __( 'Label Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the label text here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '<span class="label label-inverse">' . $content . '</span>';
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
			'name' => __( 'Label', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of label you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'label',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
