<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 * shrortcode from About Us block
 */

wp_enqueue_script( MISS_PREFIX . '-jsc-track', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_track.js', array('wpb_js_composer_js_custom_views'), THEME_VERSION, true );

class misscomposerImTrack {

    private static $shortcode_id = 1;
    
    private static function _shortcode_id() {
        return self::$shortcode_id++;
    }

	/**
	 *
	 */
	public static function im_track( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
            $tab_id_1 = time().'-1-'.rand(0, 100);
            $tab_id_2 = time().'-2-'.rand(0, 100);
			return array(
				"name"  => __("Audio Player", "js_composer"),
				"base" => "im_track",
				"show_settings_on_create" => true,
				"admin_enqueue_js" => IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_track.js',
				"is_container" => true,
                "content_element" => true,
				"icon" => "im-icon-music-2",
				"category" => __('Content', 'js_composer'),
				"params" => array(
					array(
						'heading' => __( 'Download / Buy label (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can specify the buy label for this album', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'buy_label',
						'value' => '',
						'type' => 'textfield',
					),
                    array(
                        'heading' => __( 'Default Cover Image (recommended)', MISS_ADMIN_TEXTDOMAIN ),
                        'description' => __( 'You can upload default playlist cover.', MISS_ADMIN_TEXTDOMAIN ),
                        'param_name' => 'cover',
                        'type' => 'attach_image',
                    ),
                    array(
                        'heading' => __( 'Default Artist (optional)', MISS_ADMIN_TEXTDOMAIN ),
                        'description' => __( 'You can specify default artist title for all items.', MISS_ADMIN_TEXTDOMAIN ),
                        'param_name' => 'artist',
                        'type' => 'textfield',
                    ),
                    array(
                        'heading' => __( 'Price (optional)', MISS_ADMIN_TEXTDOMAIN ),
                        'description' => __( 'You can specify default price.', MISS_ADMIN_TEXTDOMAIN ),
                        'param_name' => 'price',
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
						'heading' => __( 'Tracks to show', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select how many tracks you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'limit',
                        "type" => "range",
                        "value" => "3",
                        "min" => "0",
                        "max" => "100",
                        "step" => "1",
                        "unit" => ' ' . __( 'Tracks', MISS_ADMIN_TEXTDOMAIN ),
                        "description" => __( "Select the number of tracks you want to display", "js_composer" ),

					),
                    array(
                        "type" => "dropdown",
                        "heading" => __( "Viewport Animation", "js_composer" ),
                        "param_name" => "animation",
                        "value" => miss_js_composer_css_animation(),
                        "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" )
                    ),
			  ),
			  "custom_markup" => '
              <h4 class="wpb_element_title audio">' . __( 'Audio Player', MISS_ADMIN_TEXTDOMAIN ) . '</h4>
			  <div class="wpb_track_holder wpb_holder clearfix vc_container_for_children">
			  %content%
			  </div>
			  <div class="tab_controls">
			  <button class="add_tab" title="'.__("Add Track", "js_composer").'">'.__("Add Track", "js_composer").'</button>
			  </div>
			  ',
			  'default_content' => '
			  [im_singletrack title="'.__('Track 1', "js_composer").'" artist="'.__('Example Artist 1', "js_composer").'"][/im_singletrack]
			  [im_singletrack title="'.__('Track 2', "js_composer").'" artist="'.__('Example Artist 1', "js_composer").'"][/im_singletrack]
			  ',
			  'js_view' => 'ImTrackView'
			);
		}
        /**
         * Buyilding native output
         */
        extract(shortcode_atts(array(
            'cover'  => '',
            'buy_label' => '',
            'autoplay' => 'false',
            'price' => '',
            'artist' => '',
            'currency' => '',
            'description' => '',
            'multiplier' => '',
            'limit' => '1',
            'animation' => ''
        ), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

        $shortcode_id = self::_shortcode_id();
        
        $out = '';

        if ( $shortcode_id == '1' ) {
            // register styles
            wp_enqueue_style( MISS_PREFIX . '-css-ttw', THEME_ASSETS .'/plugins/ttw/css/style.css', array(), false, 'screen');

            // register scripts
            wp_enqueue_script( MISS_PREFIX . '-jplayer', THEME_ASSETS .'/plugins/jquery-jplayer/jquery.jplayer.js', array('jquery'), THEME_VERSION );
            wp_enqueue_script( MISS_PREFIX . '-ttw', THEME_ASSETS .'/plugins/ttw/js/ttw-music-player.js', array('jquery'), THEME_VERSION );
        }
        
        $i = 0;
        $out .= '<script>';
 
        if ( is_numeric( $cover ) ) {
            $cover = wp_get_attachment_url( $cover );
        }

        $tracks = str_replace(
            array(
                '{{ default.cover }}',
                '{{ default.artist }}',
                '{{ default.price }}',
            ),
            array(
                $cover,
                $artist,
                $price
            ),
            do_shortcode( $content )
        );
        $tracks = substr($tracks, 0, -2);

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
        $out .= '<div class="span12">';
        $out .= '<div id="ap_' . $shortcode_id . '"></div>';
        $out .= '</div>';
        $out .= '</div><!-- /#audioplayer-' . $shortcode_id . ' -->';

        return $out;

	}

	/**
	 *
	 */
	public static function _options( $method ) {
		return self::$method('generator');
	}

}

class WPBakeryShortCode_IM_Track extends WPBakeryShortCode {

    public function __construct($settings) {
        parent::__construct($settings);
    }

    public function contentAdmin( $atts, $content ) {
        $width = $custom_markup = '';
        $shortcode_attributes = array('width' => '1/1');
        foreach ( $this->settings['params'] as $param ) {
            if ( $param['param_name'] != 'content' ) {
                if (isset($param['value']) && is_string($param['value']) ) {
                    $shortcode_attributes[$param['param_name']] = __($param['value'], "js_composer");
                } elseif(isset($param['value'])) {
                    $shortcode_attributes[$param['param_name']] = $param['value'];
                }
            } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                $content = __($param['value'], "js_composer");
            }
        }
        extract(shortcode_atts(
            $shortcode_attributes
            , $atts));

        $output = '';

        $elem = $this->getElementHolder($width);

        $inner = '';
        foreach ($this->settings['params'] as $param) {
            $param_value = '';
            $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
            if ( is_array($param_value)) {
                // Get first element from the array
                reset($param_value);
                $first_key = key($param_value);
                $param_value = $param_value[$first_key];
            }
            $inner .= $this->singleParamHtmlHolder($param, $param_value);
        }
        $tmp = '';

        if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
            if ( $content != '' ) {
                $custom_markup = str_ireplace("%content%", $tmp.$content, $this->settings["custom_markup"]);
            } else if ( $content == '' && isset($this->settings["default_content_in_template"]) && $this->settings["default_content_in_template"] != '' ) {
                $custom_markup = str_ireplace("%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"]);
            } else {
                $custom_markup =  str_ireplace("%content%", '', $this->settings["custom_markup"]);
            }
            $inner .= do_shortcode($custom_markup);
        }
        $elem = str_ireplace('%wpb_element_content%', $inner, $elem);
        $output = $elem;

        return $output;
    }
}
endif;
?>