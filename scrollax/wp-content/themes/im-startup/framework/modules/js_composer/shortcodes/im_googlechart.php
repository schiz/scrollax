<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):
/**
 *
 */
class misscomposerImGooglechart {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_googlechart( $atts = null, $content = null ) {

		$multiplier_cycle_number = 20;
		$multiple_params = array(
			array(
				'heading' => __( '{{1}} Item Title (optional)', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Enter item title that will be displayed as legend', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'indicator_name_{{1}}',
				'type' => 'textfield',
			),
			array(
				'heading' => __( '{{1}} Item Values', MISS_ADMIN_TEXTDOMAIN ),
				"description" => __( 'Enter item values separated by coma. Example : 10, 12.5, 15, 13' , MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'indicator_values_{{1}}',
				'type' => 'textarea',
			),
		);

		if( $atts == 'generator' ) {
			$params = array(
					array(
						'heading' => __( 'Chart Type', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select chart type', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'type',
						'value' => array( 
							__('Line Chart', MISS_ADMIN_TEXTDOMAIN ) => 'LineChart',
							__('Smooth Line Chart', MISS_ADMIN_TEXTDOMAIN ) => 'LineChartFunction',
							__('Scatter Chart', MISS_ADMIN_TEXTDOMAIN ) => 'PointsChart',
							__('Area Chart', MISS_ADMIN_TEXTDOMAIN ) => 'AreaChart',
							__('Stepped Area Chart', MISS_ADMIN_TEXTDOMAIN ) => 'SteppedAreaChart',
							__('Pie Chart', MISS_ADMIN_TEXTDOMAIN ) => 'PieChart',
							__('Pie Chart 3D', MISS_ADMIN_TEXTDOMAIN ) => 'PieChart3D',
							__('Column Chart', MISS_ADMIN_TEXTDOMAIN ) => 'ColumnChart',
							__('Bar Chart', MISS_ADMIN_TEXTDOMAIN ) => 'BarChart',
							__('Candlestick', MISS_ADMIN_TEXTDOMAIN ) => 'CandlestickChart'
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
					array(
						'heading' => __( 'Chart Title (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Displayed caption above the chart or leave blank to hide.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Horisontal (x) Axis Title (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter title for X axis or leave blank to hide.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'h_axis_title',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Vertical (y) Axis Title (optional)', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter title for Y axis or leave blank to hide.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'v_axis_title',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Chart Height', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter height of the chart box in pixels.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'chart_h',
						'value' => '400',
						'min' => 100,
						'max' => 800,
						'step' => 10,
						'unit' => __( 'px', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
					array(
						'heading' => __( 'Disable Legend', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Disable chart legend.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'disable_legend',
						'type' => 'checkbox',
						'value' => Array(
							__( 'Check this option to disable chart legend', MISS_ADMIN_TEXTDOMAIN ) => 'true',
						),
					),
					array(
						'heading' => __( 'Elements for x-axis', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Enter list of the elements elements for x-axis separated by commas. Example 1: 2010, 2011, 2012, 2013 <br />Example 2: September, October, November, December', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'h_axis_marks',
						'type' => 'textarea',
					),
					array(
						'heading' => __( 'Number of Items', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select how many items you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'multiplier',
						// 'value' => range( 1, $multiplier_cycle_number ),
						'value' => 1,
						'min' => 1,
						'max' => $multiplier_cycle_number,
						'step' => 1,
						'unit' => __( 'charts', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
				);

			$params = array_merge( $params, miss_vc_multiple_params( $multiplier_cycle_number, $multiple_params ) );
			return array(
				'name' => __( 'Google Chart', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_googlechart',
				'icon' => 'im-icon-stats-up',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => $params

			);
		}
			
		$out = '';
		$variables = '';
		extract(shortcode_atts(array(
			'type'	=> 'LineChart',
			'title'	=> '',
			'v_axis_title'	=> '',
			'h_axis_title'	=> '',
			'h_axis_marks'	=> '',
			'disable_legend'	=> false,
			'indicator_name'	=> '',
			'chart_w'	=> '',
			'chart_h'	=> '400',
			'multiplier' => '',
			'animation' => '',
		), $atts));

        if($animation != '') {
            $animation = ' im-animate-element ' . $animation . ' ';
        } 

		$additional_params = '';
		if ( $type == 'LineChartFunction' ) {
			$type = 'LineChart';
			$additional_params .= "curveType: \"function\",\n";
		} elseif ( $type == 'PointsChart' ) {
			$type = 'LineChart';
			$additional_params .= 'lineWidth: 0, ';
		} elseif ( $type == 'PieChart3D' ) {
			$type = 'PieChart';
			$additional_params .= "is3D: true,\n";
		}
		$additional_params .= ( $disable_legend == false ) ? '' : 'legend: "none",';					

		$i=1;
		foreach ($multiple_params as $key => $value) {
			$value['param_name'] = str_replace( '{{1}}', $i, $value['param_name'] );
			$atts[$value['param_name']] = ( !isset( $atts[$value['param_name']] ) || $atts[$value['param_name']] === false ) ? '' : $atts[$value['param_name']];
			$i++;
		}

		$variables .= 'var data = google.visualization.arrayToDataTable([';

		//Adding Title
		$variables .= '["' . $h_axis_title . '"';	
		for ($j = 1; $j <= $multiplier; $j++ ) {
			// Define Static Keys
			if ( !isset( $atts['indicator_name_' . $j] ) ) {
				$atts['indicator_name_' . $j] = "";
			}
			if ( isset( $atts['indicator_values_' . $j] )  ) {
				$variables .= ', "' . $atts['indicator_name_' . $j] . '"';
				$atts['indicator_values_' . $j] = ( explode(',', $atts['indicator_values_' . $j] ) ) ? explode(',', $atts['indicator_values_' . $j] ) : array();
			}
		}
		$variables .= ']';	

		// Generating Data

		$h_axis_marks = ( explode(',', $h_axis_marks) ) ? explode(',', $h_axis_marks) : array();
		$chart_point_value = 0;
		foreach ($h_axis_marks as $h_axis_mark) {
			$variables .= ',[';	
			$variables .= '"' . trim( $h_axis_mark ) . '"';	
			for ($i = 1; $i <= $multiplier; $i++ ) {
				$variables .= ( isset( $atts['indicator_values_' . $i][$chart_point_value] ) && $atts['indicator_values_' . $i][$chart_point_value] != '' ) ? ', ' . $atts['indicator_values_' . $i][$chart_point_value] : ', ' . 0;
			}
			$variables .= ']';
			$chart_point_value++;
		}
		$variables .= ']);';

	    $variables .= '
	        var options = {
	          title: "' . $title . '",
	          vAxis: {title: "' . $v_axis_title . '"},
	          hAxis: {title: "' . $h_axis_title . '"},
	          backgroundColor: "transparent",
	          pointSize: 4,
	          ' . $additional_params . '
	        };
	    ';		
		$shortcode_id = self::_shortcode_id();
		$chart_h = ( $chart_h != '' ) ? ( substr_count( strtolower( $chart_h ), 'px') ? $chart_h : $chart_h . 'px' ) : '400px';

		$out = '';
		if ( $shortcode_id == '1' ) {
			// register styles
			$out .= '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		}
		$shortcode_id = 'chart_' . $shortcode_id;

	    $out .= '
			<div id="' . $shortcode_id . '" class="g_chart' . $animation . '" style="width: ' . $chart_w . '; height: ' . $chart_h . ';"></div>
			<script type="text/javascript">
			      jQuery(document).ready( function () {
			      	var ' . $shortcode_id . '_width = jQuery("#' . $shortcode_id . '").parent().width();
			      	jQuery("#' . $shortcode_id . '").css("width", ' . $shortcode_id . '_width + "px" );
			      });
			      google.load("visualization", "1", {packages:["corechart"]});
			      google.setOnLoadCallback(drawChart);
			      function drawChart() {
					' . $variables . '
			        var chart = new google.visualization.' . $type . '(document.getElementById("' . $shortcode_id . '"));
			        chart.draw(data, options);
			      }
			</script>
	    ';
		
		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}




class WPBakeryShortCode_IM_googlechart extends WPBakeryShortCode_VC_Tab {
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
                // $output .= '<h3><span class="tab-label"><%= params.title %></span></h3>';
                $output .= '<div '.$this->mainHtmlBlockParams($width, $i).'>';
                    $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
                    $output .= '<div class="wpb_element_wrapper cursor-move charts_preview <%= params.type %>">';
			            $output .= '<h4 class="wpb_element_title google_charts">' . __( 'Google Charts', MISS_ADMIN_TEXTDOMAIN ) . '</h4>';
			            $output .= '<p class="wpb_element_title google_charts_type">Type: <%= params.type %></p>';
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