<?php
/**
 *
 */
class missPricetable {
	/**
	 *
	 */
	public static function pricetable( $atts, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			global $wpdb;
			$prices_list = array();
			$pricetables = $wpdb->get_results('SELECT ID, post_title FROM ' . $wpdb->posts . ' WHERE post_type = "pricetable"');
			if ( is_array( $pricetables ) ) {
				foreach( $pricetables as $key => $value ) {
					$prices_list[ $value->ID ] = $pricetables[ $key ]->post_title;
				}
			} else {
				$price_list[0] = __( 'Please install Price Table plugin...', MISS_ADMIN_TEXTDOMAIN );
			}
			$option = array(
				'name' => __( 'Blog Grid Layout', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'pricetable',
				'options' => array(
					array(
						'name' => __( 'Select Table', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose "Pricing Table" to use.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'id',
						'type' => 'select',
						'options' => $prices_list,
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}

		
		extract(
			shortcode_atts(
				array(
					'id'	=> '',
	    		), 
	    		$atts
	    	)
		);
			
		$pricetable = new WP_Query();
		$pricetable->query(
			array(
				'post_type' => 'pricetable',
				'post_id' => $id,
			)
		);
		while( $pricetable->have_posts() ) {
			$pricetable->the_post();
			$prices_list[get_the_ID()] = get_the_title();
			$out = '[price_table id="' . $id . '"]';
		}


		return do_shortcode( $out );
	}

	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		$atts = "";
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __('Pricing Table', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of blog you wish to use.<br /><br />The grid will display posts in a column layout while the list will display your posts from top to bottom.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'pricetable',
			'options' => $shortcode,
//			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
