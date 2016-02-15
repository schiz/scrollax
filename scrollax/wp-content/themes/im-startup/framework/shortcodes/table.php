<?php
/**
 *
 */
class missTable {
	
	/**
	 *
	 */
	public static function default_table( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Default Table', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'default_table',
				'options' => array(
					'name' => __( 'Table Html', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content of your table.  You need to use the HTML table tags when typing out your content.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea',
				),
				'shortcode_carriage_return' => true
			);
			
			return $option;
		}
		
		return str_replace( '<table>', '<table class="default_table">', miss_content_group( $content ) );
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
			'name' => __( 'Tables', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose the style of table you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'table',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
