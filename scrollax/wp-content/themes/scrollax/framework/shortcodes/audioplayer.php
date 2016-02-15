<?php
/**
 *
 */
class missAudioplayer {

	private static $audioplayer_id = 1;
	
	/**
	 *
	 */
	private static function _audioplayer_id() {
	    return self::$audioplayer_id++;
	}

	public static function audioplayer( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Audio Player', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'audioplayer',
				'options' => array(

					array(
						'name' => __( 'Buy label (optional)', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can specify the buy label for this album', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'buy_label',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),

					array(
						'name' => __( 'Currency symbol (optional)', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can specify custom currency symbol (eg. $, £)', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'currency',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),

					array(
						'name' => __( 'Tracks to show', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many tracks you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'limit',
						'options' => range(1,20),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),

					array(
						'name' => __( 'Autoplay', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Check this for automatic playback', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'autoplay',
						'options' => array(
							'true' => __( 'Enable Autoplay', MISS_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
						'shortcode_multiplier' => true
					),

					array(
						'name' => __( 'Number of tracks', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many tracks you wish to play.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'options' => range(1,20),
						'type' => 'select',
						'shortcode_multiplier' => true
					),

					array(
						'name' => __( 'Description', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can add custom description.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'description',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),

					array(
						'name' => __( 'Track title', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Please specify track title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Artist Title', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can specify custom artist title.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'artist',
						'type' => 'text',
						'shortcode_multiply' => true
					),

					array(
						'name' => __( 'Artist/Track Image 1 URL', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can upload the custom artist / track image you wish to use here.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'image',
						'type' => 'upload',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Audio File', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Please upload track (mp3).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'upload',
						'shortcode_multiply' => true
					),

					array(
						'name' => __( 'Audio OGG File (optional)', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Please upload track (ogg).', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'oga',
						'type' => 'upload',
						'shortcode_multiply' => true
					),

					array(
						'name' => __( 'Buy URL (optional)', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can specify buy URL.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'buy',
						'type' => 'text',
						'shortcode_multiply' => true
					),

					array(
						'name' => __( 'Price (optional)', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can specify price.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'price',
						'type' => 'text',
						'shortcode_multiply' => true
					),


					array(
						'name' => __( 'Score (optional)', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select track score.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'score',
						'options' => array(
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
						'type' => 'select',
						'shortcode_multiply' => true
					),

					array(
						'value' => 'track',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		global $wp_query, $irish_framework_params;
		
		extract(shortcode_atts(array(
			'cover'  => '',
			'buy_label' => '',
			'autoplay' => 'false',
			'currency' => '',
			'description' => '',
			'limit' => '1'
		), $atts));

		$audioplayer_id = self::_audioplayer_id();
		
		$out = '';

		if ( $audioplayer_id == '1' ) {
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
				if ( !preg_match_all( '/(.?)\[(marker)\b(.*?)(?:(\/))?\](?:(.+?)\[\/marker\])?(.?)/s', $content, $matches ) ) {
					$tracks = substr( do_shortcode( $content ), 0, -2);
					$out .= "
        jQuery(document).ready(function(){
            var ap_description_{$audioplayer_id} = '" . stripslashes( $description ) . "';
            var ap_playlist" . $audioplayer_id . " =[ {$tracks} ];
            jQuery('#ap_{$audioplayer_id}').ttwMusicPlayer(ap_playlist". $audioplayer_id . ", {
                autoPlay:{$autoplay},
                autoplay:{$autoplay},
                currencySymbol:'{$currency}',
                buyText:'{$buy_label}',
                tracksToShow:'{$limit}',
                auto_advance:true,
                description: ap_description_{$audioplayer_id}
            });
        });
        ";

				}
				$out .= '</script>';
				$out .= '<div class="row-fluid audioplayer" id="audioplayer-' . $audioplayer_id . '">';
				// $out .= '<div class="span12"><img src="' . $cover . '" /></div>';
				$out .= '<div class="span12">';
				$out .= '<div id="ap_' . $audioplayer_id . '"></div>';
				$out .= '</div>';
				$out .= '</div><!-- /#audioplayer-' . $audioplayer_id . ' -->';

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
			'name' => __( 'Audio Player', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'audioplayer',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>
