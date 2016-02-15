<?php
/**
 *
 */
class missLists {
	
	/**
	 *
	 */
	public static function styled_list( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Styled Unlimited Icon List', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'styled_list',
				'options' => array(
					array(
						'name' => __( 'Icon', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose the icon of list that you wish to use. Each one has a different icon.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon',
						'default' => 'im-icon-accessibility',
						'type' => 'icons',
						'target'=> 'all_icons'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your list.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'color',
						'default' => '#205685',
						'type' => 'color',
					),
					array(
						'name' => __( 'List Html', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content of your list.  You need to use the &#60;ul&#62; and &#60;li&#62; elements when typing out your list content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'return' => true
					),
				'shortcode_has_atts' => true,
				'shortcode_carriage_return' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'icon'     => '',
			'color'	=> '',
	    ), $atts));
	
		$icon = ( $icon ) ? trim( $icon ) : 'arrow_list';
	
		$color = ( $color ) ? '' . trim( $color ) : '';

		$content = str_replace( '<ul>', '<ul class="unlimited_list">', $content );
		$content = str_replace( '<li>', '<li><i class="' . $icon . '" style="color:' . $color . ';"></i> ', $content );
	
		return miss_content_group( $content );
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
			'name' => __( 'List', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'styled_list',
			'options' => $shortcode,
		);
		
		return $options;
	}
	
}

?>
