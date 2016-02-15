<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImMessagebox {
	/**
	 *
	 */
	public static function im_messagebox( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			return array( 
				'name' => __( 'Message Box', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_messagebox',
				'icon' => 'im-icon-box',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(

					array(
						'heading' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter box caption.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Content', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter banner content (shortcode supported).', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'container',
						'value' => '',
						'type' => 'textarea_html',
					),
					array(
						'heading' => __( 'Frame Colour', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Specify frame colour.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'frame_color',
						'value' => 'rgba(128,128,128,.2)',
						'type' => 'colorpicker',
					),

					array(
						'heading' => __( 'Frame Size', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select custom font size.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'frame_width',
						'value' => 4,
						'min' => 1,
						'max' => 20,
						'step' => 1,
						'unit' => 'px',
						'type' => 'range',
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
			'title' => '',
			'container'   => '',
			'bgcolor_first' => 'rgba(255,255,255,.2)',
			'frame_color' => 'rgba(128,128,128,.2)',
			'frame_width'   => '4',
			'animation' => ''
	    ), $atts));

		/* Building Output */
		$out = do_shortcode('[banner animation="' . $animation . '" frame_color="' . $frame_color . '" frame_width="' . $frame_width . '" custom="true" title="' . $title . '"]' . $container . '[/banner]');
		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
	
}


class WPBakeryShortCode_IM_messagebox extends WPBakeryShortCode_VC_Tab {
    protected  $predefined_atts = array(
        'el_class' => '',
        'width' => '',
        'title' => '',
		'container'   => '',
		'bgcolor_first' => 'rgba(255,255,255,.2)',
		'frame_color' => 'rgba(128,128,128,.2)',
		'frame_width'   => '4',
    );
    public function contentAdmin($atts, $content = null) {
        $width = $el_class = $title = $image = $track = $content = '';
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
                // $output .= '<h3><span class="tab-label"><%= params.title %></span></h3>';
                $output .= '<div '.$this->mainHtmlBlockParams($width, $i).'>';
                    $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
                    $output .= '<div class="wpb_element_wrapper cursor-move" style="border: <%= params.frame_width %>px <%= params.frame_color %> solid">';
			            $output .= '<h4 class="wpb_element_title message_box">' . __( 'Message Box', MISS_ADMIN_TEXTDOMAIN ) . ': <%= params.title %></h4>';
			            $output .= '<p class="wpb_element_title"><%= params.container %></p>';
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
        }
        return $output;
    }

    public function mainHtmlBlockParams($width, $i) {
        return 'data-element_type="'.$this->settings["base"].'" class=" wpb_'.$this->settings['base'].' wpb_content_element wpb_sortable"'.$this->customAdminBlockParams();
    }
    public function containerHtmlBlockParams($width, $i) {
        return 'class="wpb_column_container"';
    }

    public function contentAdmin_old($atts, $content = null) {
        $width = $el_class = $title = $track = $image = '';
        extract(shortcode_atts($this->predefined_atts, $atts));
        $output = '';
        $column_controls = $this->getColumnControls($this->settings('controls'));
        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row-fluid wpb_row_container">';
            $output .= '<h3><a href="#">'.$title.'</a></h3>';
            $output .= '<div '.$this->customAdminBockParams().' data-element_type="'.$this->settings["base"].'" class=" wpb_'.$this->settings['base'].' wpb_vc_column_text wpb_content_element wpb_sortable">';
            $output .= '<div style="">';
            	if ( !empty( $image ) ) {
			        if ( is_numeric( $image ) ) {
			            $image = wp_get_attachment_url( $image );
			        }

            		$output .= '<img src="' . $image . '" alt="Preview" />';
            	}
            	//$output .= '<div style="width: 32px; height: 32px; background-color: #101010;">';
            $output .= '</div>';
            $output .= '<div style="">';
            $output .= $track;
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