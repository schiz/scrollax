<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 *
 */
class misscomposerImMybanner {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_mybanner( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			return array(
				'name' => __( 'Banner My', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_mybanner',
				'icon' => 'im-icon-crown',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Image', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Upload custom image. Please use hi-res image.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'image',
						'value' => '',
						'type' => 'attach_image',
					),
					array(
						'heading' => __( 'Image position', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select image position type.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'img_pos',
						'value' => array( 
							__( 'Right', MISS_ADMIN_TEXTDOMAIN ) => 'right',
							__( 'Left', MISS_ADMIN_TEXTDOMAIN ) => 'left',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter banner title.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter banner content.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'banner_content',
						'value' => '',
						'type' => 'textarea',
					),
					array(
						'heading' => __( 'Link', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter banner link.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'link',
						'value' => '',
						'type' => 'textfield',
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
			'image'   => '',
			'img_pos'   => '',
			'title'   => '',
			'banner_content'   => '',
			'link'   => '',
			'animation' => '',
	    ), $atts));
        
        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 
        

		$shortcode_id = self::_shortcode_id();


		if ( isset( $image ) && $image != '' ) {
			if ( is_numeric( $image ) ) {
				$image = wp_get_attachment_url( $image );
			}
		}
		$out = '<section class="row my-banner '.$animation.'">';
        if($img_pos == 'left')$out .= '<div class="span6 img"><img src="'.$image.'" alt="" /></div>';
        $out .= '<div class="span6 descr">
                    <h1>'.$title.'</h1>
                    <div class="text">'.$banner_content .'</div>
                    <a class="ribbon-style ribbon-light-style readmore" href="'.$link.'">Read More</a>
                 </div>';
        if($img_pos == 'right')$out .= '<div class="span6 img"><img src="'.$image.'" alt="" /></div>';
        $out .= '</section>';
        
		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}
endif;
?>