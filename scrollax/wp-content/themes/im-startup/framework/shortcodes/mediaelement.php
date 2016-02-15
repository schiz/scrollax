<?php
/**
 *
 */
class missMediaelement {

	private static $mediaelement_id = 1;
	
	/**
	 *
	 */
	private static function _mediaelement_id() {
	    return self::$mediaelement_id++;
	}

	public static function mediaelement( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Audio Player', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'mediaelement',
				'options' => array(
					array(
						'name' => __( 'Description', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can add custom description.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'description',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),

					array(
						'name' => __( 'Track Title', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Please specify track title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					/*
					array(
						'name' => __( 'Artist Title', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can specify custom artist title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'artist',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					*/
					/*
					array(
						'name' => __( 'Artist/Track Image 1 URL', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can upload the custom artist / track image you wish to use here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'image',
						'type' => 'upload',
						'shortcode_dont_multiply' => true
					),
					*/
					array(
						'name' => __( 'Audio File', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Please upload track (mp3).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'upload',
						'shortcode_dont_multiply' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		global $wp_query, $irish_framework_params;
		
		extract(shortcode_atts(array(
			'cover'  => '',
			'title'  => '',
			'autoplay' => 'false',
			'description' => '',
		), $atts));

		$mediaelement_id = self::_mediaelement_id();
		
		$out = '';

		if ( $mediaelement_id == '1' ) {
			// load styles
			// wp_enqueue_style( MISS_PREFIX . '-me-css', THEME_ASSETS .'/plugins/mediaelementjs/src/css/mediaelementplayer.css', array(), false, 'screen');

			// load scripts
			
			wp_enqueue_style('wp-mediaelement');
			wp_enqueue_script('wp-mediaelement');

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
			if ( !preg_match_all( '/(.?)\[(marker)\b(.*?)(?:(\/))?\](?:(.+?)\[\/marker\])?(.?)/s', $content, $matches ) ) {
				$tracks = substr( do_shortcode( $content ), 0, -2);
				$out .= "jQuery(document).ready(function(){jQuery('video,audio').mediaelementplayer();});";

			}
			$out .= '</script>';
		}
		
				$group = 'styled_img_group_'.rand(1,1000);
				$i = 0;
				if ( isset( $title ) && !empty( $title ) ) {
					$out .= '<h3>' . $title . '</h3>';
				}
				$out .= '<audio class="audio" src="'. $content . '" controls="controls"></audio>';
				if ( isset( $description ) && !empty( $description ) ) {
					$out .= '<p>' . $description . '</p>';
				}
				// $out .= '<div class="row-fluid mediaelement" id="mediaelement-' . $mediaelement_id . '">';
				// // $out .= '<div class="span12"><img src="' . $cover . '" /></div>';
				// $out .= '<div class="span12">';
				// $out .= '<div id="ap_' . $mediaelement_id . '"></div>';
				// $out .= '</div>';
				// $out .= '</div><!-- /#mediaelement-' . $mediaelement_id . ' -->';

		return $out;
	}
	
	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
	
		$options = array(
			'name' => __( 'Media Element', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'mediaelement',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
