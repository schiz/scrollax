<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 *
 */

wp_enqueue_script( MISS_PREFIX . '-jsc-hero', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_hero.js', array('wpb_js_composer_js_custom_views'), THEME_VERSION, true );

class misscomposerImHero {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_hero( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			return array(
				'name' => __( 'Banner Hero (draggable)', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_hero',
				'is_container' => true,
				'content_element' => true,
				'admin_enqueue_js' => IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/im_hero.js',
				'icon' => 'im-icon-crown',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => array(
					array(
						'heading' => __( 'Display Type', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Please specify background colour.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'display_type',
						'value' => array( 
							__( 'Boxed', MISS_ADMIN_TEXTDOMAIN ) => 'default',
							__( 'Fullwidth (to the edge of the screen)', MISS_ADMIN_TEXTDOMAIN ) => 'fullwidth',
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
		                "type" => "dropdown",
		                "heading" => __( "Viewport Animation", "js_composer" ),
		                "param_name" => "animation",
		                "value" => miss_js_composer_css_animation(),
		                "description" => __( "Viewport animation will be triggered when this element is being viewed when you scroll page down. you only need to choose the animation style from this option. please note that this only works in moderns. We have disabled this feature in touch devices to increase browsing speed.", "js_composer" )
		            ),
				),
				'js_view' => 'VcImHero'
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

		$padding = 20;
		$style = '';

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

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
			$out .= '<div class="fullwidthbanner ' . $margins . ' id-' . $shortcode_id . $animation . '" style="height:' . $height . 'px; padding-bottom:' . $padding * 2 . 'px;">';
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
			$out .= '<div class="message ' . $margins . ' id-' . $shortcode_id . $animation . '">';
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
                         jQuery(".fullwidthbanner.id-' . $shortcode_id . ' .banner, .message.id-' . $shortcode_id . ' .message_center").parallax( ' . $bg_parallax_h_speed . ', ' . $bg_parallax_v_speed . ');
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

class WPBakeryShortCode_IM_Hero extends WPBakeryShortCode_VC_Tab {
    protected  $predefined_atts = array(
        'el_class' => '',
        'width' => '',
        'title' => ''
    );
    public function contentAdmin($atts, $content = null) {
        $width = $el_class = $title = '';
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




                $output .= '<div>';
                $output .= '<div '.$this->mainHtmlBlockParams($width, $i).'>';
                    $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
                    $output .= '<div class="wpb_element_wrapper">';
						$output .= '<h4 class="wpb_element_title">' . __( "Banner Hero", "js_composer" ) . '</h4>';
						// $output .= '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">';
                        $output .= '<div '.$this->containerHtmlBlockParams($width, $i).'>';
                            $output .= do_shortcode( shortcode_unautop($content) );
                            $output .= WPBakeryVisualComposer::getInstance()->getLayout()->getContainerHelper();
                        $output .= '</div>';
                        if ( isset($this->settings['params']) ) {
                            $inner = '';
                            foreach ($this->settings['params'] as $param) {
                                $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
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
                $output .= '</div>';
            $output .= '</div>';
        }
        return $output;
    }

    public function mainHtmlBlockParams($width, $i) {
        return 'data-element_type="'.$this->settings["base"].'" class="wpb_content_element wpb_content_holder wpb_sortable wpb_'.$this->settings['base'].'"'.$this->customAdminBlockParams();
    }
    public function containerHtmlBlockParams($width, $i) {
        return 'class="wpb_column_container vc_container_for_children"';
    }

    public function contentAdmin_old($atts, $content = null) {
        $width = $el_class = $title = '';
        extract(shortcode_atts($this->predefined_atts, $atts));
        $output = '';
        $column_controls = $this->getColumnControls($this->settings('controls'));
        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div '.$this->customAdminBockParams().' data-element_type="'.$this->settings["base"].'" class="wpb_content_element wpb_content_holder wpb_'.$this->settings['base'].' wpb_sortable">';
            $output .= '<div class="wpb_element_wrapper">';
        	$output .= '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children ui-sortable ui-accordion ui-widget ui-helper-reset">';
            $output .= '<div class="group wpb_sortable">';
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row-fluid wpb_row_container">';
            $output .= '<h3><a href="#">'.$title.'</a></h3>';
            $output .= '<div class="vc_row-fluid wpb_row_container">';
            $output .= do_shortcode( shortcode_unautop($content) );
            $output .= '</div>';
            if ( isset($this->settings['params']) ) {
                $inner = '';
                foreach ($this->settings['params'] as $param) {
                    $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
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