<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImPricetable {
	/**
	 *
	 */
	public static function im_pricetable( $atts, $content = null, $code = null ) {
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
			return array(
				'name' => __( 'Pricing Table', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_pricetable',
				'icon' => 'im-icon-archive',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Enter title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter title "Pricing Table" to use.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Enter sub title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter sub title "Pricing Table" to use.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'subtitle',
						'type' => 'textfield',
						'value' => '',
					),
					array(
						'heading' => __( 'Select Table', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose "Pricing Table" to use.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'id',
						'type' => 'dropdown',
						'value' => array_flip( $prices_list ),
					),
		            array(
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", "js_composer" ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" )
		            ),
				)
			);
		}

		extract(
			shortcode_atts(
				array(
					'id'	=> '',
					'animation' => '',
					'title' => '',
					'subtitle' => '',
	    		), 
	    		$atts
	    	)
		);

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

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
		$out = '<div class="pricing_table_sc' . $animation . '">' . do_shortcode( $out ) . '</div>';
        $out = '<section class="row pricing-tables">
            <hgroup class="section-header span12">
              <h1 class="header">
                <span>'.$title.'</span>
              </h1>
              <h3 class="header">'.$subtitle.'</h3>
            </hgroup>

            <div class="inner-wrapp span12">
                '.$out.'
            </div>
          </section>';
		return $out;
	}

	/**
	 *
	 */
	public static function _options( $method ) {
		return self::$method('generator');
	}
	
}

endif;
?>