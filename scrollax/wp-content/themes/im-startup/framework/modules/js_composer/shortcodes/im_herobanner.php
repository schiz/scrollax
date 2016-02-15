<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 *
 */
class misscomposerImHerobanner {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_herobanner( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			return array(
				'name' => __( 'Banner Hero RAW', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_herobanner',
				'icon' => 'im-icon-crown',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Display Type', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Please specify background colour.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'display_type',
						'value' => array( 
							__( 'Boxed', MISS_ADMIN_TEXTDOMAIN ) => 'default',
							__( 'Fullwidth', MISS_ADMIN_TEXTDOMAIN ) => 'fullwidth',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Banner Height', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify banner height (in pixels). Example: 200px', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'height',
						'value' => '200',
						'min' => 50,
						'max' => 1200,
						'step' => 10,
						'unit' => __( 'px', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
					array(
						'heading' => __( 'Primary Background Color', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Selecr primary background.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bgcolor_first',
						'value' => '',
						'type' => 'colorpicker',
					),
					array(
						'heading' => __( 'Secondary Backgrond Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select secondary background colour (for gradient).<br />Note: keep clean if you are using custom image.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bgcolor_second',
						'value' => '',
						'type' => 'colorpicker',
					),
					array(
						'heading' => __( 'Background Image', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Upload custom background image. Please use hi-res image.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'image',
						'value' => '',
						'type' => 'attach_image',
					),

					array(
						'heading' => __( 'Margins', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select margins type.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'margins',
						'value' => array( 
							__( 'Default margins', MISS_ADMIN_TEXTDOMAIN ) => '',
							__( 'No margins', MISS_ADMIN_TEXTDOMAIN ) => 'nomargins',
						),
						'type' => 'dropdown',
					),

					array(
						'heading' => __( 'Background Size', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify banner background size.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bg_size',
						'value' => array( 
							__( 'Keep original', MISS_ADMIN_TEXTDOMAIN ) => '',
							__( 'Stretch to fill width', MISS_ADMIN_TEXTDOMAIN ) => '100% auto',
							__( 'Stretch to fill height', MISS_ADMIN_TEXTDOMAIN ) => 'auto 100%',
							__( 'Stretched to container', MISS_ADMIN_TEXTDOMAIN ) => '100% 100%',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Background Attachment', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select banner attachment style.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bg_attachment',
						'value' => array( 
							__( 'Scroll', MISS_ADMIN_TEXTDOMAIN ) => 'scroll',
							__( 'Fixed', MISS_ADMIN_TEXTDOMAIN ) => 'fixed',
							__( 'Parallax Effect', MISS_ADMIN_TEXTDOMAIN ) => 'parallax',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Vertical Speed', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select parallax vertical speed.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bg_parallax_v_speed',
						'min' => '-5',
						'max' => '5',
						'step' => '1',
						'unit' => 'px',
						'value' => '0',
						'dependency' => array(
							'element' => 'bg_attachment', 
							'value' => array('parallax')
						),
						'type' => 'range',
					),
					array(
						'heading' => __( 'Horisontal Speed', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select parallax horisontal speed.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bg_parallax_h_speed',
						'min' => '-5',
						'max' => '5',
						'step' => '1',
						'unit' => 'px',
						'value' => '0',
						'dependency' => array(
							'element' => 'bg_attachment', 
							'value' => array('parallax')
						),
						'type' => 'range',
					),
					array(
						'heading' => __( 'Background Position', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select background position.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bg_position',
						'value' => array(
							__( 'Center', MISS_ADMIN_TEXTDOMAIN ) => 'center',
							__( 'Center Top', MISS_ADMIN_TEXTDOMAIN ) => 'center top',
							__( 'Center Bottom', MISS_ADMIN_TEXTDOMAIN ) => 'center bottom',
							__( 'Left/Center', MISS_ADMIN_TEXTDOMAIN ) => 'left center',
							__( 'Left Top', MISS_ADMIN_TEXTDOMAIN ) => 'left top',
							__( 'Left Bottom', MISS_ADMIN_TEXTDOMAIN ) => 'left bottom',
							__( 'Right/Center', MISS_ADMIN_TEXTDOMAIN ) => 'right center',
							__( 'Right Top', MISS_ADMIN_TEXTDOMAIN ) => 'right top',
							__( 'Right Bottom', MISS_ADMIN_TEXTDOMAIN ) => 'right bottom',
						),
						'dependency' => array(
							'element' => 'bg_attachment',
							'value' => array('scroll','fixed')
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Background Repeat', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select background repeat style.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'bg_repeat',
						'value' => array( 
							__( 'Repeat', MISS_ADMIN_TEXTDOMAIN ) => 'repeat',
							__( 'Repeat ONLY horizontaly', MISS_ADMIN_TEXTDOMAIN ) => 'repeat-x',
							__( 'Repeat ONLY verticaly', MISS_ADMIN_TEXTDOMAIN ) => 'repeat-y',
							__( 'No repeat', MISS_ADMIN_TEXTDOMAIN ) => 'no-repeat',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Banner Style', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify style banner colour schema.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'class',
						'value' => array( 
							__( 'Default colour schema', MISS_ADMIN_TEXTDOMAIN ) => 'default',
							__( 'Inversed schema', MISS_ADMIN_TEXTDOMAIN ) => 'inverse',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter banner content (shortcode supported).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'content',
						'value' => '',
						'type' => 'textarea',
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
			'display_type' => 'default', 
			'image'   => '',
			'margins'   => '',
			'bgcolor_first' => '',
			'bgcolor_second' => '',
			'bg_size' => '',
			'bg_attachment' => 'scroll',
			'bg_repeat' => 'repeat',
			'bg_position' => 'center',
			'bg_parallax_h_speed' => '0',
			'bg_parallax_v_speed' => '-1',
			'class'   => 'default',
			'height' => '200',
			'animation' => '',
	    ), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$padding = 20;
		$style = '';

		if ( isset( $height ) && $height != '' ) {
			$height = str_replace( array( '%', 'px' ), array( '', '' ), $height );
			$style .= 'height:' . $height . 'px; ';
		}
		if ( isset( $bgcolor_first ) && $bgcolor_first != '' ) {
			$style .= 'background-color:' . $bgcolor_first . ';';
		}
		if ( isset( $bgcolor_first ) && $bgcolor_first != '' && isset( $bgcolor_second ) && $bgcolor_second != '' && ( $image == '' || !isset( $image ) ) ) {
			$style .= '
			background-image: linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
			background-image: -o-linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
			background-image: -moz-linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
			background-image: -webkit-linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
			background-image: -ms-linear-gradient(top, ' . $bgcolor_first . ' 0%, ' . $bgcolor_second . ' 100%);
			background-image: -webkit-gradient(
			linear,
			left top,
			left bottom,
			color-stop(0, ' . $bgcolor_first . '),
			color-stop(1, ' . $bgcolor_second . ')
			);
			';
		}
		$shortcode_id = self::_shortcode_id();


		if ( isset( $image ) && $image != '' ) {
			if ( is_numeric( $image ) ) {
				$image = wp_get_attachment_url( $image );
			}
			$style_bg_attachment = ( $bg_attachment == 'scroll' ) ? $bg_attachment : 'fixed';
			$style .= 'background-image:url(' . $image . ');';
			$style .= 'background-size:' . $bg_size . ';';
			$style .= 'background-repeat:' . $bg_repeat . ';';
			$style .= 'background-attachment:' . $style_bg_attachment . ';';
			$style .= 'background-position:' . $bg_position . ';';
		}
		$out = '';
		if ( $display_type == 'fullwidth' ) {
			$out .= '<div class="fullwidthbanner ' . $margins . ' id-raw-' . $shortcode_id . $animation . '" style="height:' . $height . 'px; padding-bottom:' . $padding * 2 . 'px;">';
			$out .= '	<div class="banner ' . $class . '" style="' . $style . ' padding-bottom:' . $padding . 'px; padding-top:' . $padding . 'px; z-index: 1000;">';
			$out .= '		<div style="clear:both;"></div>';
			$out .= '		<div class="container">';
			$out .= '				' . do_shortcode( $content );
			$out .= '		</div><!-- .container -->';
			$out .= '		<div style="clear:both;"></div>';
			$out .= '	</div><!-- absolute .banner -->';
			$out .= '	<div class="clearboth"></div>';
			$out .= '</div><!-- static .fullwidthbanner-->';
		} else {
			$out .= '<div class="message ' . $margins . ' id-raw-' . $shortcode_id . $animation . '">';
			$out .= '<div class="message_center ' . $class . '" style="' . $style . '">';
			$out .= '				' . do_shortcode( $content );
			$out .= '<div class="clearboth"></div>';
			$out .= '</div><!-- /.message_center -->';
			$out .= '<div class="clearboth"></div>';
			$out .= '</div><!-- /.message-->';

		}
		if ( $bg_attachment == 'parallax' ) {
			$out .= '
				<script type="text/javascript">
                    jQuery(document).ready(function() {
                         jQuery(".fullwidthbanner.id-raw-' . $shortcode_id . ' .banner, .message.id-raw-' . $shortcode_id . ' .message_center").parallax( ' . $bg_parallax_h_speed . ', ' . $bg_parallax_v_speed . ');
                    });
                 </script>
			';
		}
		if ( $shortcode_id == '1' ) {
			// register scripts
			wp_enqueue_script( MISS_PREFIX . '-parallax', THEME_ASSETS .'/plugins/jquery-parallax/jquery-parallax.js', array('jquery'), THEME_VERSION );
		}
		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}
endif;
?>