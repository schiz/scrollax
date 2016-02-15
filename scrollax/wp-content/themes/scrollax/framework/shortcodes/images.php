<?php
/**
 *
 */
class missImages {
	
	public static function styled_images( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Styled Images', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'styled_images',
				'options' => array(
					array(
						'name' => __( 'Width', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Set the width for your image.  Leave this blank if you do not want your image to be resized.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Height', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Set the width for your image.  Leave this blank if you do not want your image to be resized.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of images', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many images you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'options' => range(1,20),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Image 1 URL', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can upload the image you wish to use here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'upload',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Title Attribute <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Type out the title text you wish to use with your image.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Alt Attribute <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Type out the alt text you wish to use with your image.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'alt',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Custom Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'By default when a reader clicks on your image it will open in a lightbox.<br /><br />You can paste a URL here to use instead.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'link_to',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'image',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		global $irish_framework_params;
		
		extract(shortcode_atts(array(
			'width'  => '',
			'height' => '',
			'class' => 'true'
		), $atts));
		
		$out = '';
		
		$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : $irish_framework_params->layout['images']['three_column_portfolio'][0];
		$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : $irish_framework_params->layout['images']['three_column_portfolio'][1];
		
		if ( !preg_match_all( '/(.?)\[(image)\b(.*?)(?:(\/))?\](?:(.+?)\[\/image\])?(.?)/s', $content, $matches ) ) {
			
			if( preg_match_all( '!http://.+\.(?:jpe?g|png|gif)!Ui', $content, $matches ) ){
				
				$group = 'styled_img_group_'.rand(1,1000);
				
				$out .= '<div class="styled_images">';
				
				foreach ( $matches[0] as $img ) {
					$out .= '<div class="styled_image im-transform im-animate-element scale-up">';
					
					$out .= miss_display_image( array(
									'src' => $img, 
									'alt' => '',
									'title' => '',
									'height' => $height,
									'width' => $width,
									'class' => ( $class == 'true' ? 'hover_fade_js' : '' ),
									'link_to' => $img,
									'link_class' => 'styled_image_load',
									'prettyphoto' => true,
									'group' => $group,
									'preload' => true
								) );
					
					$out .= '</div>';
				}
				$out .= '</div>';
			}
			
		} else {
			
			for( $i = 0; $i < count( $matches[0] ); $i++ ) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			
			$group = 'styled_img_group_'.rand(1,1000);
			
			$out .= '<div class="styled_images">';

			for( $i = 0; $i < count($matches[0] ); $i++ ) {
				
				$img = $matches[5][$i];
				$alt = ( isset( $matches[3][$i]['alt'] ) ) ? $matches[3][$i]['alt'] : '';
				$title = ( isset( $matches[3][$i]['alt'] ) ) ? $matches[3][$i]['title'] : '';
				
				$link_to = ( !empty( $matches[3][$i]['link_to'] ) ) ? $matches[3][$i]['link_to'] : $img;
				$prettyphoto = ( ( !empty( $matches[3][$i]['link_to'] ) ) && ( strpos( $matches[3][$i]['link_to'], 'iframe' ) === false ) ) ? false : true;
				
				$out .= '<div class="styled_image">';
				$out .= miss_display_image( array(
								'src' => $img, 
								'alt' => $alt,
								'title' => $title,
								'height' => $height,
								'width' => $width,
								'class' => ( $class == 'true' ? 'hover_fade_js' : '' ),
								'link_to' => $link_to,
								'link_class' => 'styled_image_load',
								'prettyphoto' => $prettyphoto,
								'group' => $group,
								'preload' => true
							) );
							
				$out .= '</div>';
			}
			$out .= '</div>';
		}
		
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
			'name' => __( 'Styled Images', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'styled_images',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>
