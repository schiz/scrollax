<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 * shrortcode from About Us block
 */

class misscomposerImTestimonials {

	/**
	 *
	 */
	public static function im_testimonials( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Testimonials', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_testimonials',
				'icon' => 'im-icon-trophy-star',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Limit', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select number of testimonials to show.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'limit',
						'type' => 'number',
						'max' => 20,
						'min' => 1,
						'step' => 1,
						'unit' => __( 'testimonials', MISS_ADMIN_TEXTDOMAIN ),
						'value' => '1',
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

		extract(shortcode_atts(array(
			'class'	=> 'claen',
			'title'	=> '',
			'limit'	=> '',
			'animation' => ''
	    ), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$tquery = new WP_Query();

		$tquery = $tquery->query( array(
			'post_type' => 'testimonials',
			'showposts' => $limit
		) );

		$out = '';
		foreach( $tquery as $testimony ) {
			$out .= '<div class="row-fluid">';
			$out .= '<div class="span3' . $animation . '" style="position:relative">';
			if ( get_post_thumbnail_id( $testimony->ID ) ) {

				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $testimony->ID ), 'large' );
				$thumb = miss_wp_image( $thumb[0], 400, 400 );
				$out .= '<div class="testimony_avatar"><img src="' . THEME_ASSETS . '/images/overlays/1x1.gif"  alt="" class="empty 1x1" /><img src="' . $thumb . '" /></div>';
			}
			$out .= '</div>';
			$out .= '<div class="span9 testimony-inner' . $animation . '">';
			if ( $testimony->post_title != '' ) {
				$out .= '<h3>';
				$out .= $testimony->post_title;
				$out .= '</h3>';
			}
			$out .= '' . do_shortcode('[blockquote]' . $testimony->post_content . '[/blockquote]') . '';
			$out .= '</div>';
			$out .= '</div>';
		}


		if ( count($tquery) > 1 ) {
			$out = '
			<div class="flex_slideshow_container arrows_top">
			<div class="flexslider">
			<ul class="slides">
			' . $out . '
			</ul>
			</div>
			</div>
			';
		}

		return '<div class="testimonials ' . $class . $animation . '">' . $out . '</div>';
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