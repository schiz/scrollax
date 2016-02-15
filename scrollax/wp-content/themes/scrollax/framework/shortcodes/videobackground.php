<?php
/**
 *
 */
class missVideobackground {
	private static $videobackground_id = 1;
	
	/**
	 *
	 */
	private static function _videobackground_id() {
	    return self::$videobackground_id++;
	}


	/**
	 *
	 */
	public static function videobackground( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			$option = array( 
				'name' => __( 'Video Background', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'videobackground',
				'options' => array(
					array(
						'name' => __( 'Overlay Colour', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify custom colour to dim video (optional).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'color',
						'default' => 'rgba(255,255,255,1)',
						'type' => 'color'
					),
					array(
						'name' => __( 'Dim on Scroll', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Dim video on scroll.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'scroll',
						'options' => array(
							'true' => __( 'Check this for diming video on scroll', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'checkbox',
						'shortcode_multiplier' => false
					),

					array(
						'name' => __( 'Overlay Opacity', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select overlay intensivity.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'opacity',
						'default' => '.8',
						'options' => array( 
							'0' => __( 'Invisible', MISS_ADMIN_TEXTDOMAIN ),
							'.1' => '10%',
							'.2' => '20%',
							'.3' => '30%',
							'.4' => '40%',
							'.5' => '50%',
							'.6' => '60%',
							'.7' => '70%',
							'.8' => '80%',
							'.9' => '90%',
						),
						'type' => 'select'
					),

					array(
						'name' => __( 'Poster Image', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can upload custom poster image. Please use hi-res image.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'image',
						'default' => '',
						'type' => 'upload'
					),
					array(
						'name' => __( 'Video Source (main)', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify URL for main video source. Recommended mp4 container.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'src1',
						'default' => '',
						'type' => 'upload'
					),
					array(
						'name' => __( 'Video Source (secondary)', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify URL for secondary video source. Recommended webm (webmedia) container.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'src2',
						'default' => '',
						'type' => 'upload'
					),
					array(
						'name' => __( 'Video Source (alt)', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify URL for alternative video source. Recommended ogv (ogg video) container.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'src3',
						'default' => '',
						'type' => 'upload'
					),

/*
					array(
						'name' => __( 'Overlay', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify custom overlay to dim video.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'overlay',
						'default' => 'default',
						'options' => array( 
							'default' => __( 'Original', MISS_ADMIN_TEXTDOMAIN ),
							'light' => __( 'Lighten', MISS_ADMIN_TEXTDOMAIN ),
							'darken' => __( 'Darken', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'radio'
					),
*/
					array(
						'name' => __( 'Loop', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Play clip infinite.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'loop',
						'options' => array(
							'true' => __( 'Check this for infinite playback', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'checkbox',
						'shortcode_multiplier' => false
					),
					array(
						'name' => __( 'Controls', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Add controls before video (pause, mute).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'controls',
						'options' => array(
							'true' => __( 'Check this to enable controls', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'checkbox',
						'shortcode_multiplier' => false
					),

					array(
						'name' => __( 'Resize', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Resize video clip.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'resize',
						'options' => array(
							'true' => __( 'Check this for video resize', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'checkbox',
						'shortcode_multiplier' => false
					),
				'shortcode_has_atts' => true,
				)
			);
		
			return $option;
		}
			
		extract(shortcode_atts(array(
			'image'   => '',
		//	'overlay' => '',
			'controls' => 'false',
			'opacity' => '',
			'color' => '',
			'src1' => '',
			'src2' => '',
			'src3' => '',
			'scroll' => 'false',
			'loop' => 'false',
			'resize' => 'false',
	    ), $atts));

		$src = array();
		if ( !empty( $src1 ) ) {
			$src['src1'] = $src1;
		}
		if ( !empty( $src2 ) ) {
			$src['src2'] = $src2;
		}

		if ( !empty( $src3 ) ) {
			$src['src3'] = $src3;
		}

		//$class = $style;
		$style = array();
		$videobackground_id = self::_videobackground_id();
		
		if ( isset( $height ) && $height != '' ) {
			$height = str_replace('%', 'px', $height );
			$height = ( stripos( $height, 'px' ) ) ? $height : $height . 'px';
		//	$style['min-height'] = $height;
		}
		if ( isset( $image ) && $image != '' ) {
			$style['background-image'] = $image;
		}
		
		if ( isset( $color ) && $color != '' ) {
		//	$style['background-color'] = $color;
		}
		$out = '';

		if ( $videobackground_id == '1' ) {
			// register styles
			wp_enqueue_style( MISS_PREFIX . '-css-videobackground', THEME_ASSETS .'/plugins/jquery-videobackground/jquery.videobackground.css', array(), false, 'screen');
			// register scripts
			$out .= '<script type="text/javascript" src="' . THEME_ASSETS . '/plugins/jquery-videobackground/jquery.videobackground.js"></script>';
		
		$i = 0;
		$out .= '<script type="text/javascript">';
		$out .= "(function(){
		\"use strict\";
		jQuery(document).ready(function(){
			var initialVideobg = 0,
			container = jQuery('<div />')
				.css({";
				$i = 0;
				foreach( $style as $property => $value ) {
					$out .= "'{$property}':'{$value}'";
					$i++;
					if ( $i < count( $style ) ) {
						$out .= ',';
					}
				}
			$out .= "}).addClass('video-background'),
			dim = jQuery('<div />').addClass('dim').css({'background-color': '{$color}'";
			if ( $scroll == "true" ) {
			    $out .= ", 'opacity':0";
			} else {
			    $out .= ", 'opacity':'{$opacity}'";
			}
			$out .= "}),";

			if ( $controls == "true" ) {
				$out .= "
					controlscontainer = jQuery('<div />')
						.addClass('container'),

					controls = jQuery('<div />')
						.attr('id', 'videobackground-ctl-{$videobackground_id}')
						.addClass('videobackground-ctl'),
					play = jQuery('<a />').
						addClass('im-icon-play-3')
						.attr('href', '#')
						.bind('click', function( event ) {
							event.preventDefault();
							jQuery('#videobackground-{$videobackground_id}').videobackground('play');
							return false;
						} ),
					mute = jQuery('<a />')
						.attr('href', '#')
						.addClass('im-icon-volume-mute-6')
						.bind('click', function( event ) {
							event.preventDefault();
							jQuery('#videobackground-{$videobackground_id}').videobackground('mute');
							return false;
						} ),
					";
			}

			$out .= "
			inner = jQuery('<div />')
				.attr('id', 'videobackground-{$videobackground_id}')
				.css({
				});
			";
			if ( $controls == "true" ) {
				$out .= "
				play.appendTo(controls);
				mute.appendTo(controls);
				controls.appendTo(controlscontainer);
				";
			}
			$out .= "
			dim.appendTo(container);
			inner.appendTo(container);";
			$out .= "
			jQuery('.page-body').prepend(container);
            ";
            if ( $controls == "true" ) {
                $out .= "jQuery('.page-inner').before(controlscontainer);";
            }
            $out .= "
			jQuery('#videobackground-{$videobackground_id}').videobackground({
				videoSource: [";
				$i = 0;
				foreach( $src as $source ) {
					$out .= "['{$source}']";
					$i++;
					if ( $i < count( $src ) ) {
						$out .= ',';
					}
				}
				$out .= "],";
				$out .= "//controlPosition: '#main',";
				if ( !empty( $image ) ) {
					$out .= "poster: '{$image}',";
				}
				$out .= "
				loop: {$loop},
				resize: {$resize},
//				controlPosition: '#videobackground-ctl-{$videobackground_id}',
				loadedCallback: function() {
					jQuery(this).videobackground('mute');
				}
			});
			setTimeout( function () {
				// jQuery('#videobackground-{$videobackground_id}').videobackground('play');
			}, 1000 );
			";
			if ( $scroll == "true" ) {
				$out .= "//dim.bind( 'scroll', function (e) {
				jQuery(window).on('scroll', function() {
					if( jQuery(window).scrollTop() > ( jQuery(window).height() / 10 ) ) {
						if ( initialVideobg === 0 ) {
							jQuery('.dim').stop().animate({ 'opacity': {$opacity} },500);
							initialVideobg = 1;
						}
					} else {
						jQuery('.dim').stop().animate({ 'opacity': 0 },500);
						initialVideobg = 0;
					}
				});
				";
			}

$out .= "});";
$out .= "})();";
		$out .= '</script>';
		}
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
			'name' => __( 'Video Background', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'videobackground',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>