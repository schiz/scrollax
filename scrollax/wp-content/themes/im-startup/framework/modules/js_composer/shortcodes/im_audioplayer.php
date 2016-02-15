<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 *
 */
class misscomposerImAudioplayer {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_audioplayer( $atts = null, $content = null ) {

		$multiplier_cycle_number = 10;
		$multiple_params = array(
			array(
				'heading' => __( 'Track title {{1}}', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Please specify track title.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'title_{{1}}',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Artist title {{1}}', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can specify custom artist title.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'artist_{{1}}',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Artist/Track {{1}} Image URL', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can upload the custom artist / track image you wish to use here.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'image_{{1}}',
				'type' => 'attach_image',
			),
			array(
				'heading' => __( 'Audio File {{1}}', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Please upload track (mp3).', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'track_{{1}}',
				'type' => 'attach_image',
			),
			array(
				'heading' => __( 'Audio OGG File {{1}} (optional)', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Please upload track (ogg).', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'oga_{{1}}',
				'type' => 'attach_image',
			),
			array(
				'heading' => __( 'Buy URL {{1}} (optional)', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can specify buy URL.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'buy_{{1}}',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Price {{1}} (optional)', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can specify price.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'price_{{1}}',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Rating {{1}} (optional)', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can specify price.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'rating_{{1}}',
				'type' => 'dropdown',
				'value' => array(
							'No Display Rating' => '',
							'1' => '1',
							'1.5' => '1.5',
							'2' => '2',
							'2.5' => '2.5',
							'3' => '3',
							'3.5' => '3.5',
							'4' => '4',
							'4.5' => '4.5',
							'5' => '5',
						),
			),
		);

		if( $atts == 'generator' ) {
			$params = array(
					array(
						'heading' => __( 'Buy label (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can specify the buy label for this album', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'buy_label',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Description', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can add custom description.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'description',
						'value' => '',
						'type' => 'textarea',
					),
					array(
						'heading' => __( 'Currency symbol (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can specify custom currency symbol (eg. $, £)', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'currency',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Autoplay', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Check this for automatic playback', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'autoplay',
						'value' => array(
							__( 'Enable Autoplay', MISS_ADMIN_TEXTDOMAIN ) => 'true', 
						),
						'type' => 'checkbox',
					),
					array(
						'heading' => __( 'Number of tracks', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select how many tracks you wish to play.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'multiplier',
						'value' => range(1, $multiplier_cycle_number),
						'type' => 'dropdown',
					),

		            array(
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", "js_composer" ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" )
		            ),

					array(
						'heading' => __( 'Tracks to show', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select how many tracks you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'limit',
						'value' => range(1, $multiplier_cycle_number),
						'type' => 'dropdown',
					),
				);

			$params = array_merge( $params, miss_vc_multiple_params( $multiplier_cycle_number, $multiple_params ) );
			return array(
				'name' => __( 'Audio Player', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_audioplayer',
				'icon' => 'im-icon-music-3',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => $params

			);
		}
			
		global $wp_query, $irish_framework_params;
		
		extract(shortcode_atts(array(
			'cover'  => '',
			'buy_label' => '',
			'autoplay' => 'false',
			'currency' => '',
			'description' => '',
			'multiplier' => '',
			'animation' => '',
			'limit' => '1',
		), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$shortcode_id = self::_shortcode_id();
		
		$out = '';

		if ( $shortcode_id == '1' ) {
			// register styles

			wp_enqueue_style( MISS_PREFIX . '-css-ttw', THEME_ASSETS .'/plugins/ttw/css/style.css', array(), false, 'screen');
			// wp_enqueue_style( MISS_PREFIX . '-css-ttw-demo', THEME_ASSETS .'/plugins/ttw/css/demo.css', array(), false, 'screen');

			// register scripts
			wp_enqueue_script( MISS_PREFIX . '-jplayer', THEME_ASSETS .'/plugins/jquery-jplayer/jquery.jplayer.js', array('jquery'), THEME_VERSION );
			wp_enqueue_script( MISS_PREFIX . '-ttw', THEME_ASSETS .'/plugins/ttw/js/ttw-music-player.js', array('jquery'), THEME_VERSION );
		}
		
		$group = 'styled_img_group_'.rand(1,1000);
		$i = 0;
		$out .= '<script>';
		$tracks = '';
		for ($i = 1; $i <= $multiplier; $i++ ) {
			
			foreach ($multiple_params as $key => $value) {
				$value['param_name'] = str_replace( '{{1}}', $i, $value['param_name'] );
				$atts[$value['param_name']] = ( !isset( $atts[$value['param_name']] ) || $atts[$value['param_name']] === false ) ? '' : $atts[$value['param_name']];
			}

			if ( is_numeric( $atts['track_' . $i] ) ) {
				$atts['track_' . $i] = wp_get_attachment_url( $atts['track_' . $i] );
			}
			if ( is_numeric( $atts['oga_' . $i] ) ) {
				$atts['oga_' . $i] = wp_get_attachment_url( $atts['oga_' . $i] );
			}
			if ( is_numeric( $atts['image_' . $i] ) ) {
				$atts['image_' . $i] = wp_get_attachment_url( $atts['image_' . $i] );
			}

			$tracks .= "{
		        mp3:'" . $atts['track_' . $i] . "',
		        oga:'" . $atts['oga_' . $i] . "',
		        title:'" . $atts['title_' . $i] . "',
		        artist:'" . $atts['artist_' . $i] . "',
		        rating:'" . $atts['rating_' . $i] . "',
		        buy:'" . $atts['buy_' . $i] . "',
		        price:'" . $atts['price_' . $i] . "',
		        duration:'',
		        cover:'" . $atts['image_' . $i] . "'
			},";		
	
		}
		$out .= "
jQuery(document).ready(function(){
    var ap_description_{$shortcode_id} = '" . stripslashes( $description ) . "';
    var ap_playlist" . $shortcode_id . " =[ {$tracks} ];
    jQuery('#ap_{$shortcode_id}').ttwMusicPlayer(ap_playlist". $shortcode_id . ", {
        autoPlay:{$autoplay},
        autoplay:{$autoplay},
        currencySymbol:'{$currency}',
        buyText:'{$buy_label}',
        tracksToShow:'{$limit}',
        auto_advance:true,
        description: ap_description_{$shortcode_id}
    });
});
";

		$out .= '</script>';
		$out .= '<div class="row-fluid audioplayer' . $animation . '" id="audioplayer-' . $shortcode_id . '">';
		// $out .= '<div class="span12"><img src="' . $cover . '" /></div>';
		$out .= '<div class="span12">';
		$out .= '<div id="ap_' . $shortcode_id . '"></div>';
		$out .= '</div>';
		$out .= '</div><!-- /#audioplayer-' . $shortcode_id . ' -->';

		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}
endif;
?>