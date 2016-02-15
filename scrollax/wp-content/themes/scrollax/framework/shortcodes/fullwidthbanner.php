<?php
/**
 *
 */
class missFullwidthbanner {
	/**
	 *
	 */
	public static function fullwidthbanner( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			$option = array( 
				'name' => __( 'Hero Banner (Full Width)', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'fullwidthbanner',
				'options' => array(
					array(
						'name' => __( 'Background Colour', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please specify background colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'color',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can upload custom background image. Please use hi-res image.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'image',
						'default' => '',
						'type' => 'upload',
					),
					array(
						'name' => __( 'Banner Style', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select banner style.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'class',
						'default' => 'default',
						'options' => array( 
							'default' => __( 'Default colour schema', MISS_ADMIN_TEXTDOMAIN ),
							'inverse' => __( 'Inversed schema', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'radio',
					),
					array(
						'name' => __( 'Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select banner attachment style.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'attachment',
						'default' => 'scroll',
						'options' => array( 
							'scroll' => __( 'Scroll', MISS_ADMIN_TEXTDOMAIN ),
							'fixed' => __( 'Fixed', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'radio',
					),
					array(
						'name' => __( 'Background Position', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select background position.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'position',
						'default' => 'center',
						'options' => array( 
							'center' => __( 'Center', MISS_ADMIN_TEXTDOMAIN ),
							'center top' => __( 'Center Top', MISS_ADMIN_TEXTDOMAIN ),
							'center bottom' => __( 'Center Bottom', MISS_ADMIN_TEXTDOMAIN ),
							'left center' => __( 'Left/Center', MISS_ADMIN_TEXTDOMAIN ),
							'left top' => __( 'Left Top', MISS_ADMIN_TEXTDOMAIN ),
							'left bottom' => __( 'Left Bottom', MISS_ADMIN_TEXTDOMAIN ),
							'right center' => __( 'Right/Center', MISS_ADMIN_TEXTDOMAIN ),
							'right top' => __( 'Right Top', MISS_ADMIN_TEXTDOMAIN ),
							'right bottom' => __( 'Right Bottom', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select background repeat style.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'repeat',
						'default' => 'no-repeat',
						'options' => array( 
							'repeat' => __( 'Repeat', MISS_ADMIN_TEXTDOMAIN ),
							'repeat-x' => __( 'Repeat ONLY horizontaly', MISS_ADMIN_TEXTDOMAIN ),
							'repeat-y' => __( 'Repeat ONLY verticaly', MISS_ADMIN_TEXTDOMAIN ),
							'no-repeat' => __( 'No repeat', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Banner Height', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Please specify banner height (in pixels). Example: 200px', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '200px',
						'type' => 'text',
					),
					array(
						'name' => __( 'Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter banner content (shortcode supported).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
				'shortcode_has_atts' => true,
				)
			);
		
			return $option;
		}
			
		extract(shortcode_atts(array(
			'image'   => '',
			'color' => '',
			'attachment' => 'scroll',
			'repeat' => 'no-repeat',
			'position' => 'center',
			'class'   => 'default',
			'height' => '200',
	    ), $atts));
		$id = rand( 0, 300 );
		$padding = 20;
		$style = '';

		if ( isset( $height ) && $height != '' ) {
			$height = str_replace( array( '%', 'px' ), array( '', '' ), $height );
		}

		if ( isset( $image ) && $image != '' ) {
			if ( is_numeric( $image ) ) {
				$image = wp_get_attachment_url( $image );
			}
			$style .= 'background-image:url(' . $image . ');';
		}
		$style .= 'background-repeat:' . $repeat . ';';
		$style .= 'background-attachment:' . $attachment . ';';
		$style .= 'background-position:' . $position . ';';
		
		if ( isset( $color ) && $color != '' ) {
		 $style .= 'background-color:' . $color . ';';
		}

		$out = '';
		$out .= '<div class="fullwidthbanner" style="height:' . $height . 'px; padding-bottom:' . $padding * 2 . 'px;">';
		$out .= '	<div class="banner ' . $class . '" style="' . $style . ' height:' . $height . 'px; padding-bottom:' . $padding . 'px; padding-top:' . $padding . 'px; z-index: 1000;">';
		$out .= '		<div style="clear:both;"></div>';
		$out .= '		<div class="container">';
		$out .= '				' . do_shortcode( $content );
		$out .= '		</div><!-- .container -->';
		$out .= '		<div style="clear:both;"></div>';
		$out .= '	</div><!-- absolute .banner -->';
		$out .= '	<div class="clearboth"></div>';
		$out .= '</div><!-- static .fullwidthbanner-->';

		return $out;
	}
	
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Full Width Banner', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'fullwidthbanner',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>