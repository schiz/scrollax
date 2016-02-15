<?php
/**
 *
 */
class missCharts {
	

	private static $chart_id = 1;
	
	/**
	 *
	 */
	private static function _chart_id() {
	    return self::$chart_id++;
	}

	/**
	 *
	 */
	public static function chart( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Charts', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'chart',
				'options' => array(
					array(
						'name' => __( 'Chart Type', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select chart type', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'type',
						'default' => 'LineChart',
						'options' => array(
							'LineChart' => __('Line Chart', MISS_ADMIN_TEXTDOMAIN ),
							'LineChartFunction' => __('Line Chart (curves type - function)', MISS_ADMIN_TEXTDOMAIN ),
							'AreaChart' => __('Area Chart', MISS_ADMIN_TEXTDOMAIN ),
							'SteppedAreaChart' => __('Stepped Area Chart', MISS_ADMIN_TEXTDOMAIN ),
							'PieChart' => __('Pie Chart', MISS_ADMIN_TEXTDOMAIN ),
							'ColumnChart' => __('Column Chart', MISS_ADMIN_TEXTDOMAIN ),
							'BarChart' => __('Bar Chart', MISS_ADMIN_TEXTDOMAIN ),
							// 'ComboChart' => __('Combo Chart', MISS_ADMIN_TEXTDOMAIN ),
							// 'ScatterChart' => __('Scatter Chart', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Animation', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Turn on CSS3 transitions. You may specify animation effect.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'animation',
						'default' => '',
						'type' => 'select',
						'target'=> 'css_animation',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => false
					),
					array(
						'name' => __( 'Chart Title <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Displayed caption above the chart or leave blank to hide.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Horisontal (x) Axis Title <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter title for X axis or leave blank to hide.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'h_axis_title',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Vertical (y) Axis Title <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter title for Y axis or leave blank to hide.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'v_axis_title',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Chart Height', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter height of the chart box in pixels.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'chart_h',
						'default' => '400px',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Disable Legend', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Disable chart legend.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'disable_legend',
						'type' => 'checkbox',
						'options' => Array(
							'true' => __( 'Check this option to disable chart legend', MISS_ADMIN_TEXTDOMAIN )
						),
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Elements for x-axis', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Enter list of the elements elements for x-axis separated by commas. Example 1: 2010, 2011, 2012, 2013 <br />Example 2: September, October, November, December', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'h_axis_marks',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number Of Items', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many items you wish to display.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'options' => range(1,30),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( '1 Item Title <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter item title that will be displayed as legend', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'indicator_name',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( '1 Item Values', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Enter item values separated by coma. Example : 10, 12.5, 15, 13' , MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'point',
						'nested' => true
					),

				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		$out = '';
	    $variables = '';
		extract(
			shortcode_atts(
				array(
					'type'	=> 'LineChart',
					'title'	=> '',
					'v_axis_title'	=> '',
					'h_axis_title'	=> '',
					'animation' => '',
					'h_axis_marks'	=> '',
					'disable_legend'	=> false,
					'indicator_name'	=> '',
					'chart_w'	=> '',
					'chart_h'	=> '400',
	    		), 
	    		$atts
	    	)
		);

		if ( !empty( $animation )) {
			$animation = ' im-transform im-animate-element ' . $animation;
		}

		if ( $type == 'LineChartFunction' ) {
			$type = 'LineChart';
			$curvetype = 'curveType: "function", ';
		} else {
			$curvetype = '';
		}

		if ( !preg_match_all( '/(.?)\[(point)\b(.*?)(?:(\/))?\](?:(.+?)\[\/point\])?(.?)/s', $content, $matches ) ) {
			// No items, do nothing
		} else {
			$variables .= 'var data = google.visualization.arrayToDataTable([';
			$variables .= '["' . $h_axis_title . '"';	
			foreach ($matches[3] as $indicator_name) {
				$indicator_name = str_replace('"', '', strstr( $indicator_name, '"' ) );
				$variables .= ', "' . $indicator_name . '"';
			}
			$variables .= ']';	
			foreach ($matches[5] as $key => $chart_values) {
				$matches[5][$key] = ( explode(',', $chart_values) ) ? explode(',', $chart_values) : array();
			}
			$h_axis_marks = ( explode(',', $h_axis_marks) ) ? explode(',', $h_axis_marks) : array();
			$chart_point_value = 0;
			foreach ($h_axis_marks as $h_axis_mark) {
				$variables .= ',[';	
				$variables .= '"' . trim( $h_axis_mark ) . '"';	
				foreach ($matches[5] as $key => $chart_values) {
					$variables .= ( isset($matches[5][$key][$chart_point_value]) ) ? ', ' . $matches[5][$key][$chart_point_value] : ', ' . 0;
				}
				$variables .= ']';
				$chart_point_value++;
			}
			$variables .= ']);';
		}

		$legend = ( $disable_legend == false ) ? '' : 'legend: "none",';					
	    $variables .= '
	        var options = {
	          title: "' . $title . '",
	          vAxis: {title: "' . $v_axis_title . '"},
	          hAxis: {title: "' . $h_axis_title . '"},
	          is3D: true,
	          backgroundColor: "transparent",
	          pointSize: 4,
	          ' . $curvetype . '
	          ' . $legend . '
	        };
	    ';		
		$chart_id = self::_chart_id();
		$chart_h = ( $chart_h != '' ) ? ( substr_count( strtolower( $chart_h ), 'px') ? $chart_h : $chart_h . 'px' ) : '400px';

		$out = '';
		if ( $chart_id == '1' ) {
			// register styles
			$out .= '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		}
		$chart_id='chart_' . $chart_id;

	    $out .= '
			<div id="' . $chart_id . '" class="g_chart' . $animation . '" style="width: ' . $chart_w . '; height: ' . $chart_h . ';"></div>
			<script type="text/javascript">
			      jQuery(document).ready( function () {
			      	var ' . $chart_id . '_width = jQuery("#' . $chart_id . '").parent().width();
			      	jQuery("#' . $chart_id . '").css("width", ' . $chart_id . '_width + "px" );
			      });
			      google.load("visualization", "1", {packages:["corechart"]});
			      google.setOnLoadCallback(drawChart);
			      function drawChart() {
					' . $variables . '
			        var chart = new google.visualization.' . $type . '(document.getElementById("' . $chart_id . '"));
			        chart.draw(data, options);
			      }
			</script>
	    ';
		
		return $out;
	}
			
	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Charts', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of chart you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'chart',
			'options' => $shortcode,
			//'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
