<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImPartners {

	/**
	 *
	 */
	public static function im_partners( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Partners', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_partners',
				'icon' => 'im-icon-trophy-star',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
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

		extract(shortcode_atts(array(
			'animation' => '',
	    ), $atts));
        
        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        }
        

		$out = '';
                $empty_cell = "";
	if ( ( miss_get_setting('disable_partners_section') == 'display_all' ) || ( miss_get_setting('disable_partners_section') == 'only_front_page' && is_front_page() ) ) {
		$out .= '	<section class="row our-partners">';
			if( miss_partners_shortcuts() != false ){
                $out .= '               <header class="section-header span12">
                                            <h1 class="header">
                                                <span>'.miss_get_setting('partners_caption').'</span>
                                            </h1>
                                        </header>';
                $out .= '               <div class="inner-wrapp span12">';
                
        $partners = miss_get_setting( 'partners' );
        if( ($partners['keys'] != '#') and ($partners != '') ) {
            $partners_keys = explode( ',', $partners['keys'] );

			if ( array_key_exists('#', $partners) ) {
				unset($partners['#']);
				unset($partners['keys']);
			};
			$spans_in_row = miss_get_setting( 'partners_on_one_slide' ) ? miss_get_setting( 'partners_on_one_slide' ) : 6;
			$span_walk = 0;
			$row_walk = 1;
			$flag = false;
			$span_width = 100 / $spans_in_row;

			$counter_item = count( $partners );
			$counter_row = $counter_item / $spans_in_row;
			if ( !is_int($counter_row) ){
				$counter_row = ceil( $counter_row );
				$counter_residue = $counter_item - (($counter_row-1) * $spans_in_row);
				$counter_empty_cell = floor( ($spans_in_row - $counter_residue) / 2 );
			} else {
				$counter_residue = $counter_item - (($counter_row) * $spans_in_row);
				$counter_empty_cell = 0;
			}
			$counter_total_cell = $counter_item+$counter_empty_cell;
			foreach ($partners as $key => $value) {
				if (isset($partners[$key]['custom'])){
					$out .= '<div class="content-item '.$animation.'">';
					$out .= '<a href="' . esc_url( $partners[$key]['link'] ) . '"><img src="' . esc_url( $partners[$key]['custom'] ) . '" alt="' . esc_url( $partners[$key]['link'] ) . '" /></a>';
					$out .= '</div>';
				}
			}
    }
                
                $out .= '               </div>';
                
			};
		$out .= '	</section><!-- /.region partners-->';
	}
        
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
