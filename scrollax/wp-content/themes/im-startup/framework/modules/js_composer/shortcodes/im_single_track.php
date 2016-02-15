<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 *
 */
wp_enqueue_script( MISS_PREFIX . '-jsc-track', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_track.js', array('wpb_js_composer_js_custom_views'), THEME_VERSION, true );

class misscomposerImSingletrack {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_singletrack( $atts = null, $content = null ) {
		$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;

		$params = array(
			array(
				'heading' => __( 'Track title', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Please specify track title.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'title',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Artist title', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can specify custom artist title.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'artist',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Artist/Track Image URL', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can upload the custom artist / track image you wish to use here.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'image',
				'type' => 'attach_image',
			),
			array(
				'heading' => __( 'Audio File', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Please upload track (mp3).', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'track',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Audio OGG File', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Please upload track (ogg). Required for Safari and FireFox support.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'oga',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Download / Buy URL (optional)', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can specify buy URL.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'buy',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Price (optional)', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can specify price.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'price',
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Rating (optional)', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'You can specify price.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'rating',
				'type' => 'dropdown',
				'value' => array(
							'Without ratings' => '',
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
			return array(
				'name' => __( 'Audio Track', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_singletrack',
				'icon' => 'im-icon-music-3',
				"admin_enqueue_js" => IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_track.js',
				"allowed_container_element" => 'vc_row',
				"is_container" => false,
				"content_element" => false,
				'params' => $params,
				// 'js_view' => 'ImTrackTabView'
			);
		}
	
		
		extract(shortcode_atts(array(
			'track'  => 'http://s3560.cdn.gridbus.net/store/b3230f212f048d3087bf992923735b84/watermark.mp3',
			'oga' => 'http://s3560.cdn.gridbus.net/store/b3230f212f048d3087bf992923735b84/watermark.ogg',
			'title' => '',
			'artist' => '{{ default.artist }}',
			'buy' => '',
			'rating' => '',
			'price' => '{{ default.price }}',
			'image' => '{{ default.cover }}',
		), $atts));

        if ( is_numeric( $image ) ) {
            $image = wp_get_attachment_url( $image );
        }

		$out = "{";
			$out .= "mp3:'" . $track . "',";
			$out .= "oga:'" . $oga . "',";
			$out .= "title:'" . $title . "',";
			$out .= "artist:'" . $artist . "',";
			$out .= "rating:'" . $rating . "',";
			$out .= "buy:'" . $buy . "',";
			$out .= "price:'" . $price . "',";
			$out .= "duration:'',";
			$out .= "cover:'" . $image . "'";
		$out .= "},";
		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}




class WPBakeryShortCode_IM_singletrack extends WPBakeryShortCode_VC_Tab {
    protected  $predefined_atts = array(
        'el_class' => '',
        'width' => '',
        'title' => '',
        'track' => '',
        'image' => ''
    );
    public function contentAdmin($atts, $content = null) {
        $width = $el_class = $title = $image = $track = '';
        extract(shortcode_atts($this->predefined_atts, $atts));
        $output = '';

        $column_controls = $this->getColumnControls($this->settings('controls'));
        // $column_controls_bottom =  $this->getColumnControls('add', 'bottom-controls');

        if ( $width == 'column_14' || $width == '1/4' ) {
            $width = array('vc_span3');
        }
        else if ( $width == 'column_14-14-14-14' ) {
            $width = array('vc_span3', 'vc_span3', 'vc_span3', 'vc_span3');
        }

        else if ( $width == 'column_13' || $width == '1/3' ) {
            $width = array('vc_span4');
        }
        else if ( $width == 'column_13-23' ) {
            $width = array('vc_span4', 'vc_span8');
        }
        else if ( $width == 'column_13-13-13' ) {
            $width = array('vc_span4', 'vc_span4', 'vc_span4');
        }

        else if ( $width == 'column_12' || $width == '1/2' ) {
            $width = array('vc_span6');
        }
        else if ( $width == 'column_12-12' ) {
            $width = array('vc_span6', 'vc_span6');
        }

        else if ( $width == 'column_23' || $width == '2/3' ) {
            $width = array('vc_span8');
        }
        else if ( $width == 'column_34' || $width == '3/4' ) {
            $width = array('vc_span9');
        }
        else if ( $width == 'column_16' || $width == '1/6' ) {
            $width = array('vc_span2');
        }
        else {
            $width = array('');
        }

        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div class="group wpb_sortable">';
                // $output .= '<h3><span class="tab-label"><%= params.title %></span></h3>';
                $output .= '<div '.$this->mainHtmlBlockParams($width, $i).'>';
                    $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
                    $output .= '<div class="wpb_element_wrapper cursor-move ">';
	            		$output .= '<div class="ap_preview_image"><i class="im-icon-guitar"></i></div>';
			            $output .= '<div class="ap_details">';
			            $output .= '<p>' . __( 'Artist', MISS_ADMIN_TEXTDOMAIN ) . ':<%= params.artist %></p>';
			            $output .= '<p>' . __( 'Title', MISS_ADMIN_TEXTDOMAIN ) . ':<%= params.title %></p>';
			            $output .= '<p>' . __( 'Track URI', MISS_ADMIN_TEXTDOMAIN ) . ':<%= params.track %></p>';
			            $output .= '<p>' . __( 'Price', MISS_ADMIN_TEXTDOMAIN ) . ': <%= params.price %></p>';
			            $output .= '</div>';

                        if ( isset($this->settings['params']) ) {
                            $inner = '';
                            foreach ($this->settings['params'] as $param) {
                                $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
                                //var_dump($param_value);
                                if ( is_array($param_value)) {
                                    // Get first element from the array
                                    reset($param_value);
                                    $first_key = key($param_value);
                                    $param_value = $param_value[$first_key];
                                }

                                $inner .= $this->singleParamHtmlHolder($param, $param_value);
                            }
                            $output .= $inner;
                        }
                    $output .= '</div>';
                    $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
                $output .= '</div>';
            $output .= '</div>';
        }
        return $output;
    }

    public function mainHtmlBlockParams($width, $i) {
        return 'data-element_type="'.$this->settings["base"].'" class=" wpb_'.$this->settings['base'].' wpb_content_element"'.$this->customAdminBlockParams();
    }
    public function containerHtmlBlockParams($width, $i) {
        return 'class="wpb_column_container vc_container_for_children"';
    }

    public function contentAdmin_old($atts, $content = null) {
        $width = $el_class = $title = $track = $image = '';
        extract(shortcode_atts($this->predefined_atts, $atts));
        $output = '';
        $column_controls = $this->getColumnControls($this->settings('controls'));
        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div class="group wpb_sortable">';
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row-fluid wpb_row_container">';
            $output .= '<h3><a href="#">'.$title.'</a></h3>';
            $output .= '<div '.$this->customAdminBockParams().' data-element_type="'.$this->settings["base"].'" class=" wpb_'.$this->settings['base'].' wpb_sortable">';
            $output .= '<div style="">';
            	if ( !empty( $image ) ) {
			        if ( is_numeric( $image ) ) {
			            $image = wp_get_attachment_url( $image );
			        }

            		$output .= '<img src="' . $image . '" alt="Preview" />';
            	}
            $output .= '</div>';
            $output .= '<div style="">';
            $output .= $track;
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }

    protected function outputTitle($title) {
        return  '';
    }

    public function customAdminBlockParams() {
        return '';
    }
}
endif;
?>