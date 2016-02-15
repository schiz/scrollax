<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImMediaelement {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_mediaelement( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$params = array(
					array(
						'heading' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Please specify audio file title', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Description', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Additional description.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'description',
						'value' => '',
						'type' => 'textarea',
					),
					array(
						'heading' => __( 'Element type', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select type of this element', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'type',
						'value' => array(
							__( 'Video File', MISS_ADMIN_TEXTDOMAIN ) => 'video', 
							__( 'Audio File', MISS_ADMIN_TEXTDOMAIN ) => 'audio', 
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'File Location', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Please upload file and paste URI here. Supported formats: mp3, mp4', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'src',
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
				);

			return array(
				'name' => __( 'Local Video or Audio File Player', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_mediaelement',
				'icon' => 'im-icon-movie-3',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => $params,

			);
		}
			
		extract(shortcode_atts(array(
			'title'  => '',
			'description' => '',
			'type' => 'audio',
			'src' => '',
			'animation' => '',
		), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		if ( is_numeric( $src ) ) {
			$src = wp_get_attachment_url( $src );
		}

		$shortcode_id = self::_shortcode_id();
		
		$out = '';

		if ( $shortcode_id == '1' ) {
			wp_enqueue_style('wp-mediaelement');
			wp_enqueue_script('wp-mediaelement');

			// load styles
			// wp_enqueue_style( MISS_PREFIX . '-me-css', THEME_ASSETS .'/plugins/mediaelementjs/src/css/mediaelementplayer.css', array(), false, 'screen');

			// load scripts
			// wp_enqueue_script( MISS_PREFIX . '-me-namespace', THEME_ASSETS .'/plugins/mediaelementjs/src/me-namespace.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-me-utility', THEME_ASSETS .'/plugins/mediaelementjs/src/me-utility.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-me-i18n', THEME_ASSETS .'/plugins/mediaelementjs/src/me-i18n.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-me-plugindetector', THEME_ASSETS .'/plugins/mediaelementjs/src/me-plugindetector.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-me-featuredetection', THEME_ASSETS .'/plugins/mediaelementjs/src/me-featuredetection.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-me-mediaelements', THEME_ASSETS .'/plugins/mediaelementjs/src/me-mediaelements.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-me-shim', THEME_ASSETS .'/plugins/mediaelementjs/src/me-shim.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-library', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-library.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-player', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-player.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-feature-playpause', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-feature-playpause.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-feature-progress', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-feature-progress.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-feature-time', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-feature-time.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-feature-tracks', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-feature-tracks.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-frature-volume', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-frature-volume.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-frature-stop', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-frature-stop.js', array('jquery'), THEME_VERSION );
			// wp_enqueue_script( MISS_PREFIX . '-mep-feature-fullscreen', THEME_ASSETS .'/plugins/mediaelementjs/src/mep-feature-fullscreen.js', array('jquery'), THEME_VERSION );

			$out .= '<script>';
			$tracks = do_shortcode( $src );
			$out .= "jQuery(document).ready(function(){jQuery('video,audio').mediaelementplayer();});";

			$out .= '</script>';
		}
		
		if ( isset( $title ) && !empty( $title ) ) {
			$out .= '<h3>' . $title . '</h3>';
		}
		if ( $type == 'video' ) {
			$out .= '<video class="audio' . $animation . '" src="'. $src . '" controls="controls"></video>';
		} else {
			$out .= '<audio class="audio' . $animation . '" src="'. $src . '" controls="controls"></audio>';
		}
		if ( isset( $description ) && !empty( $description ) ) {
			$out .= '<p>' . $description . '</p>';
		}

		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}
endif;
?>