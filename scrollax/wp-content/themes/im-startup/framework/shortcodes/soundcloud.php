<?php
/**
 *
 */
class missSoundcloud {
	
	/**
	 *
	 */
	public static function soundcloud( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Sound Cloud', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'soundcloud',
				'options' => array(
					array(
						'name' => __( 'Sound Cloud URL', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can define sound cloud url here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Width <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the width for your soundcloud box here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'default' => '100%',
						'type' => 'text',
					),
					array(
						'name' => __( 'Height <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the height in pixels for your SoundCloud box here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '81px',
						'type' => 'text',
					),
					array(
						'name' => __( 'Autoplay <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this option to play automaticaly content from SoundCloud.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'auto_play',
						'default' => '',
						'options' => Array (
							'true' =>  __( 'Enable autoplay', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Show Comments <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this option to show SoundCloud comments.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'comments',
						'default' => '',
						'options' => Array (
							'true' =>  __( 'Display comments', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Define custom colour set.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'colorSimplified',
						'default' => '#808080',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'url'		  => '',
			'color'		  => '',
			'auto_play'	  => 'true',
			'height'	  => '',
			'width'		  => '',
			'comments' 	  => 'true',
		), $atts));
		
		global $wp_query, $irish_framework_params;
	
		$out = '';
		
		//$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : '';
		//$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : '';
		
		//if( preg_match( '!http://.+\.(?:jpe?g|png|gif)!Ui', $content, $matches ) ) {
			
			$atts = Array(
				'url' 			=> $content,
				'color'			=> $color,
				'auto_play' 		=> $auto_play,
				'height' 		=> $height,
				'comments' 		=> $comments,
				'width'			=> $width
			);
			$out = '<object height="' . $atts['height'] . '" width="' . $atts['width'] . '"><param name="movie" value="http://player.soundcloud.com/player.swf?url=' . urlencode($atts['url']) . '&amp;show_comments=' . $atts['comments'] . '&amp;auto_play=' . $atts['auto_play'] . '&amp;color=' . $atts['color'] . '"></param><param name="allowscriptaccess" value="always"></param><embed allowscriptaccess="always" height="' . $atts['height'] . '" src="http://player.soundcloud.com/player.swf?url=' . urlencode($atts['url']) . '&amp;show_comments=' . $atts['comments'] . '&amp;auto_play=' . $atts['auto_play'] . '&amp;color=' . $atts['color'] . '" type="application/x-shockwave-flash" width="' . $atts['width'] . '"></embed></object>';
		//}
		
		//return '[raw]' . $out . '[/raw]';
		return $out;
	}
	
	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();

		$class_methods = get_class_methods( $class );

		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}

		$options = array(
			'name' => __( 'Sound Cloud', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'soundcloud',
			'options' => $shortcode
		);

		return $options;
	}

}

?>
