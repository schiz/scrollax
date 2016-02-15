<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImSoundcloud {
	
	/**
	 *
	 */
	public static function im_soundcloud( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			return array(
				'name' => __( 'Sound Cloud', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_soundcloud',
				'icon' => 'im-icon-volume-high',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Sound Cloud URL', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can define sound cloud url here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Width <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Set the width for your soundcloud box here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'width',
						'value' => '100%',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Height <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Set the height in pixels for your SoundCloud box here.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'height',
						'value' => '81px',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Autoplay <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Check this option to play automaticaly content from SoundCloud.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'auto_play',
						'value' => Array (
							__( 'Enable autoplay', MISS_ADMIN_TEXTDOMAIN ) => 'true',
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Show Comments <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Check this option to show SoundCloud comments.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'comments',
						'value' => Array (
							__( 'Display comments', MISS_ADMIN_TEXTDOMAIN ) => 'true',
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Define custom colour set.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'colorsimplified',
						'value' => '',
						'type' => 'colorpicker',
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
			'url'		  => '',
			'color'		  => '',
			'auto_play'	  => 'false',
			'height'	  => '80',
			'width'		  => '',
			'comments' 	  => 'true',
			'animation'   => '',
		), $atts));

		$out = '';
		$atts = Array(
			'url' 			=> $content,
			'color'			=> $color,
			'auto_play' 	=> $auto_play,
			'height' 		=> $height,
			'comments' 		=> $comments,
			'width'			=> $width,
			'animation'		=> $animation,
		);

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$out = '<div class="soundcloud_element' . $animation . '"><object height="' . $atts['height'] . '" width="' . $atts['width'] . '"><param name="movie" value="http://player.soundcloud.com/player.swf?url=' . urlencode($atts['url']) . '&amp;show_comments=' . $atts['comments'] . '&amp;auto_play=' . $atts['auto_play'] . '&amp;color=' . $atts['color'] . '"></param><param name="allowscriptaccess" value="always"></param><embed allowscriptaccess="always" height="' . $atts['height'] . '" src="http://player.soundcloud.com/player.swf?url=' . urlencode($atts['url']) . '&amp;show_comments=' . $atts['comments'] . '&amp;auto_play=' . $atts['auto_play'] . '&amp;color=' . $atts['color'] . '" type="application/x-shockwave-flash" width="' . $atts['width'] . '"></embed></object></div>';

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