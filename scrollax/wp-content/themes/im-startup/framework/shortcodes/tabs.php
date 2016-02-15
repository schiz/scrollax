<?php
/**
 *
 */
class missTabs {
	
	/**
	 *
	 */
/*
	public static function tabs( $atts = null, $content = null, $code = null ) {

		if( $atts == 'generator' ) {

			$numbers = range(1,10);

			$option = array( 
				'name' => __( 'Tabs', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'tabs',
				'options' => array(
					array(
						'name' => __( 'Number of tabs', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of tabs you wish to display.  The tabs are the selectable areas which change the content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Tab 1 Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title for your tab.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your tab.  Shortcodes are accepted.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'tab',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;

		}
			
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {

			return miss_content_group( $content );

		} else {

			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}

			$out = '<ul class="tabs">';
			
			for($i = 0; $i < count($matches[0]); $i++) {

				$out .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';

			}

			$out .= '</ul>';
			
			for($i = 0; $i < count($matches[0]); $i++) {

				$out .= '<div class="tabs_content">' . do_shortcode( miss_content_group( $matches[5][$i] ) ) . '</div>';

			}
			
			return '<div class="tabs_container">' . $out . '</div>';
		}
	}
*/	
	/**
	 *
	 */
	public static function tabs_framed( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);

			$option = array( 
				'name' => __( 'Framed Tabs', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'tabs_framed',
				'options' => array(
					array(
						'name' => __( 'Number of tabs', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of tabs you wish to display.  The tabs are the selectable areas which change the content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Tab 1 Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title for your tab.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your tab.  Shortcodes are accepted.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'tab',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return miss_content_group( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			$out = '<ul class="tabs framed">';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<li' . ( $i==0 ? ' class="current"' : '' ) . '><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
			}
			$out .= '<div class="clearboth"></div>';
			$out .= '</ul>';

			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div class="tabs_content framed">';
				$out .= '<div class="wrap">';
				$out .= do_shortcode( miss_content_group( $matches[5][$i] ) );
				$out .= '</div>';
				$out .= '</div>';
			}
			
			return '<div class="tabs_container framed">' . $out . '</div>';
		}
	}
	
	/**
	 *
	 */
	public static function tabs_button( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);

			$option = array( 
				'name' => __( 'Button Tabs', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'tabs_button',
				'options' => array(
					array(
						'name' => __( 'Number of tabs', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of tabs you wish to display.  The tabs are the selectable areas which change the content.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Tab 1 Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title for your tab.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your tab.  Shortcodes are accepted.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'tab',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return miss_content_group( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			$out = '<ul class="tabs button">';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
			}
			$out .= '<div class="clearboth"></div>';
			$out .= '</ul>';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div class="tabs_content button">' . do_shortcode( miss_content_group( $matches[5][$i] ) ) . '</div>';
			}
			
			return '<div class="tabs_container button">' . $out . '</div>';
		}
	}
	
	/**
	 *
	 */
	public static function tabs_vertical( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);

			$option = array( 
				'name' => __( 'Vertical Tabs', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'tabs_vertical',
				'options' => array(
					array(
						'name' => __( 'Number of tabs', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of tabs you wish to display.  The tabs are the selectable areas which change the content.  Vertical tabs will display on the left hand side.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Tab 1 Title', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title for your tab.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 icon', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Icon will be displayed for this tab in the list of tabs.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'icon',
						'default' => 'im-icon-accessibility',
						'target' => 'all_icons',
						'type' => 'icons',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your tab.  Shortcodes are accepted.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'tab',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
			
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return miss_content_group( $content );
		} else {
			$i = 0;
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			$out = '';
//			$out = '<div class="tabs_frame vertical">';
			$out .= '<ul class="tabs vertical">';

			$el_count = 0;
			for($i = 0; $i < count($matches[0]); $i++) {
				$el_count++;
				$out .= '<li' . ( $i==0 ? ' class="current"' : '' ) . '><a href="#"' . ( $i==0 ? ' class="current"' : '' ) . '>';
				if ( isset( $matches[3][$i]['icon'] ) && !empty( $matches[3][$i]['icon'] ) ) {
					$out .= '<i class="'. $matches[3][$i]['icon'] .'"></i>';
				} else {
					$out .= '';
				}
				$out .= $matches[3][$i]['title'] . '</a></li>';
			}
			$out .= '</ul>';
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div class="tabs_content vertical"><div class="tabs_wrap">' . do_shortcode( miss_content_group( $matches[5][$i] ) ) . '</div></div>';
			}
			$out .= '<div class="clearboth"></div>';
			
			return '<div class="tabs_container vertical">' . $out . '</div>';
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
			'name' => __( 'Tabs', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of tabs you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'tabs',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
