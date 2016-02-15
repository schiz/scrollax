<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImImageframe {
	
	/**
	 *
	 */
	public static function im_imageframe( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Framed Image', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_imageframe',
				'icon' => 'im-icon-image-4',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Type', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Choose which type of frame you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'style',
						'value' => array(
							__( 'Default', MISS_ADMIN_TEXTDOMAIN ) => '',
							__( 'Transparent Border', MISS_ADMIN_TEXTDOMAIN ) => 'border',
							__( 'Reflection', MISS_ADMIN_TEXTDOMAIN ) => 'reflect',
							__( 'Shadow', MISS_ADMIN_TEXTDOMAIN ) => 'shadow',
							__( 'Reflection + Shadow', MISS_ADMIN_TEXTDOMAIN ) => 'reflect_shadow',
							__( 'Framed + Shadow', MISS_ADMIN_TEXTDOMAIN ) => 'framed_shadow',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Image URL', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can upload your image that you wish to use here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'image',
						'type' => 'attach_image',
						'value' => '',
					),
					array(
						'heading' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Set the alignment for your image here.<br /><br />Your image will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'align',
						'value' => array(
							__( 'left', MISS_ADMIN_TEXTDOMAIN ) => 'left',
							__( 'right', MISS_ADMIN_TEXTDOMAIN ) => 'right',
							__( 'center', MISS_ADMIN_TEXTDOMAIN ) => 'center'
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Alt Attribute <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type the alt text that you would like to display with your image here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'alt',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Title Attribute <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type the title text that you would like to display with your image here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Image Height <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can set the image height here.  Leave this blank if you do not want to resize your image.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'height',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Image Width <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can set the image width here.  Leave this blank if you do not want to resize your image.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'width',
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

				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'image'		  => '',
	        'style'		  => '',
			'align'		  => '',
			'alt'		  => '',
			'title'		  => '',
			'height'	  => '',
			'width'		  => '',
			'animation'	  => '',
			'effect'	  => '',
			'link_to' 	  => 'true',
			'prettyphoto' => 'true'
		), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		global $wp_query, $irish_framework_params;
	
		$out = '';
		
		if ( isset( $image ) && $image != '' ) {
			$effect = trim( $style );
			$effect = ( !empty( $effect ) ) ? $effect : 'framed';
			$align = ( $align == 'left' ? ' alignleft' : ( $align == 'right' ? ' alignright' : ( $align == 'center' ? ' aligncenter' : ' alignleft' ) ) );
			$class = ( $effect == 'reflect' ? "reflect{$align}" : ( $effect == 'reflect_shadow' ? 'reflect' : ( $effect == 'framed' ? "framed{$align}" : ( $effect == 'framed_shadow' ? 'framed' : '' ) ) ) );
			$class .= $animation;
			$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : '';
			$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : '';

			if ( is_numeric( $image ) ) {
				$image = wp_get_attachment_url( $image );
			}
				
			$out .= miss_display_image(array(
				'src' 			=> $image,
				'alt' 			=> $alt,
				'title' 		=> $title,
				'class' 		=> $class,
				'height' 		=> $height,
				'width'			=> $width,
				'align'			=> $align,
				'effect' 		=> $effect,
			));
		}		
		//return '[raw]' . $out . '[/raw]';
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