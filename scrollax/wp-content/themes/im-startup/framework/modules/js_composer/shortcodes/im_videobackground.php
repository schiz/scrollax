<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImVideobackground {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_videobackground( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			return array(
				'name' => __( 'Video Background', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_videobackground',
				'icon' => 'im-icon-film-4',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Overlay Colour', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify custom colour to dim video (optional).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'color',
						'value' => 'rgba(255,255,255,1)',
						'type' => 'colorpicker',
					),
					array(
						'heading' => __( 'Dim on Scroll', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Dim video on scroll.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'scroll',
						'value' => array(
							__( 'Check this for diming video on scroll', MISS_ADMIN_TEXTDOMAIN ) => 'true', 
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Overlay Opacity', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select overlay intensivity.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'opacity',
						'value' => array( 
							__( 'Invisible', MISS_ADMIN_TEXTDOMAIN ) => '0',
							'10%' => '.1',
							'20%' => '.2',
							'30%' => '.3',
							'40%' => '.4',
							'50%' => '.5',
							'60%' => '.6',
							'70%' => '.7',
							'80%' => '.8',
							'90%' => '.9',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Poster Image', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can upload custom poster image. Please use hi-res image.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'image',
						'value' => '',
						'type' => 'attach_image',
					),
					array(
						'heading' => __( 'Video Source (main)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify URL for main video source. Recommended mp4 container.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'src1',
						'value' => '',
						'type' => 'attach_image',
					),
					array(
						'heading' => __( 'Video Source (secondary)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify URL for secondary video source. Recommended webm (webmedia) container.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'src2',
						'value' => '',
						'type' => 'attach_image',
					),
					array(
						'heading' => __( 'Video Source (alt)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select banner attachment style.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'src3',
						'value' => '',
						'type' => 'attach_image',
					),
					array(
						'heading' => __( 'Loop', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Play clip infinite.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'loop',
						'value' => array(
							__( 'Check this for infinite playback', MISS_ADMIN_TEXTDOMAIN ) => 'true', 
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Controls', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Add controls before video (pause, mute).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'controls',
						'value' => array(
							__( 'Check this to enable controls', MISS_ADMIN_TEXTDOMAIN ) => 'true', 
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Resize', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Check this for video resize', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'resize',
						'value' => array(
							__( 'Check this for infinite playback', MISS_ADMIN_TEXTDOMAIN ) => 'true', 
						),
						'type' => 'checkbox',
					),
				)
			);
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
		$shortcode_id = self::_shortcode_id();
		
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

		if ( $shortcode_id == '1' ) {
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
						.attr('id', 'videobackground-ctl-{$shortcode_id}')
						.addClass('videobackground-ctl'),
					play = jQuery('<a />').
						addClass('im-icon-play-3')
						.attr('href', '#')
						.bind('click', function( event ) {
							event.preventDefault();
							jQuery('#videobackground-{$shortcode_id}').videobackground('play');
							return false;
						} ),
					mute = jQuery('<a />')
						.attr('href', '#')
						.addClass('im-icon-volume-mute-6')
						.bind('click', function( event ) {
							event.preventDefault();
							jQuery('#videobackground-{$shortcode_id}').videobackground('mute');
							return false;
						} ),
					";
			}

			$out .= "
			inner = jQuery('<div />')
				.attr('id', 'videobackground-{$shortcode_id}')
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
                $out .= "jQuery('.page-inner').defore(controlscontainer);";
            }
            $out .= "
			jQuery('#videobackground-{$shortcode_id}').videobackground({
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
				loadedCallback: function() {
					jQuery(this).videobackground('mute');
				}
			});
			setTimeout( function () {
				// jQuery('#videobackground-{$shortcode_id}').videobackground('play');
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
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}

endif;
?>