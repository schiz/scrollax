<?php
/**
 *
 */
class missMaps {
	
	private static $map_id = 1;
	
	/**
	 *
	 */
	private static function _map_id() {
	    return self::$map_id++;
	}

	/**
	 *
	 */
	public static function map( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Maps', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'map',
				'options' => array(
					array(
						'name' => __( 'Width', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the width of your map.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Height', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the height of your map.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Zoom', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select an initial zoom value for your map.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'zoom',
						'options' => array(
							'1' => __('1', MISS_ADMIN_TEXTDOMAIN ),
							'2' => __('2', MISS_ADMIN_TEXTDOMAIN ),
							'3' => __('3', MISS_ADMIN_TEXTDOMAIN ),
							'4' => __('4', MISS_ADMIN_TEXTDOMAIN ),
							'5' => __('5', MISS_ADMIN_TEXTDOMAIN ),
							'6' => __('6', MISS_ADMIN_TEXTDOMAIN ),
							'7' => __('7', MISS_ADMIN_TEXTDOMAIN ),
							'8' => __('8', MISS_ADMIN_TEXTDOMAIN ),
							'9' => __('9', MISS_ADMIN_TEXTDOMAIN ),
							'10' => __('10', MISS_ADMIN_TEXTDOMAIN ),
							'11' => __('11', MISS_ADMIN_TEXTDOMAIN ),
							'12' => __('12', MISS_ADMIN_TEXTDOMAIN ),
							'13' => __('13', MISS_ADMIN_TEXTDOMAIN ),
							'14' => __('14', MISS_ADMIN_TEXTDOMAIN ),
							'15' => __('15', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Map Type', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select which type of map you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'type',
						'default' => '',
						'options' => array(
							'ROADMAP' => __('Roadmap', MISS_ADMIN_TEXTDOMAIN ),
							'SATELLITE' => __('Satellite', MISS_ADMIN_TEXTDOMAIN ),
							'HYBRID' => __('Hybrid', MISS_ADMIN_TEXTDOMAIN ),
							'TERRAIN' => __('Terrain', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of Markers', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many markers you wish to display on your map.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'options' => range(1,20),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
/*
					array(
						'name' => __( 'Lat', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter latitude.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'lat',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
*/
/*
					array(
						'name' => __( 'Long', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enter longitude.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'long',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
*/


					array(
						'name' => __( 'Address', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the address for your marker.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'address',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),

					array(
						'name' => __( 'Placemark', MISS_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can upload custom marker.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'placemark',
						'type' => 'upload',
						'shortcode_multiply' => true
					),

					array(
						'name' => __( 'Description', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the information you would like to display when your marker is clicked on.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'marker',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		global $wp_query, $irish_framework_params;
		
		extract(shortcode_atts(array(
			'width'			=> '400',
			'height'		=> '300',
			'zoom'			=> '4',
			'type'			=> 'ROADMAP',
		), $atts));
		
		$el_id = self::_map_id();
		$map_id = 'gmap_id_' . $el_id;
		$out = '';

		if ( $el_id == 1 ) {
			// Load google maps api 
			wp_enqueue_script( MISS_PREFIX . '-mapsapi', 'http://maps.googleapis.com/maps/api/js?v=3.0&sensor=false', array('jquery'), THEME_VERSION, true );

			//Old Way
			//$out .= '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3.0&sensor=false"></script>';
			//$out .= '<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markermanager/1.0/src/markermanager_packed.js"></script>';
			//  		$out .= '<script type="text/javascript">';
			//$out .= 'document.write(\'<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markermanager/1.0//src/markermanager\' + (document.location.search.indexOf(\'packed\') > -1 ? \'_packed\' : \'\') + \'.js"><\' + \'/script>\');';
			//$out .= '</script>';
		}


		// Output our map container
		$out .= '<div id="'.$map_id.'" class = "msmw_map" style = "width: '.$width.'px; height: '.$height.'px;"></div>';

		$out .= '<script type = "text/javascript">';
		$out .= 'jQuery(document).ready(function(){';
		$out .= '"use strict";';
		// Setup options
		$out .= 'var options'.$map_id.' = {';
		$out .= 'zoom: '.$zoom.',';
		$out .= 'scrollwheel: false,';
		$out .= 'panControl: false,';
		$out .= 'mapTypeControl: false,';
		$out .= 'zoomControl: true,';
		$out .= 'zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL, position: google.maps.ControlPosition.RIGHT_CENTER},';
		$out .= 'scaleControl: true,';
		$out .= 'mapTypeId: google.maps.MapTypeId.'.$type;
		$out .= '};';

		if ( !preg_match_all( '/(.?)\[(marker)\b(.*?)(?:(\/))?\](?:(.+?)\[\/marker\])?(.?)/s', $content, $matches ) ) {
	
			// No markers, do nothing

		} else {
		
			for ($i = 0; $i < count( $matches[0] ); $i++ ) {
			
				$elements = explode('"', $matches[0][$i]);
				$address = $elements[1];
				$placemark = explode('"', $matches[1][$i]);
				$placemark = ( isset( $elements[3] ) ) ? $elements[3] : '';
				$search_string = $matches[0][$i];
				$url_search = str_replace('[/marker]', '', $search_string);
				$info_content = substr($url_search, strpos($url_search, ']') + 1, strlen($url_search));
				$info_content = trim($info_content);

				if ( !empty( $placemark ) ) {
					$image_path = explode( $_SERVER['SERVER_NAME'], $placemark );
					if( !empty( $image_path[1] ) ) {
						$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
						$image_size = @getimagesize( $image_path );
					} else {
						$image_size = @getimagesize( $placemark );
					}
					$placemark_sizes = $image_size;
				}

				// Setup a new Geocode for the current marker address
				$out .= 'var address'.$i.' = "";';
				$out .= 'var g'.$i.' = new google.maps.Geocoder();';
  
				$out .= 'g'.$i.'.geocode({ "address" : "'.$address.'" }, function (results, status) {';
					$out .= 'if (status === google.maps.GeocoderStatus.OK) {';
						$out .= 'address'.$i.' = results[0].geometry.location;';
						
						// Center map on last marker added
						$out .= 'map'.$map_id.'.setCenter(results[0].geometry.location);';
						
						// Setup Marker
						$out .= 'var marker'.$i.' = new google.maps.Marker({';
						$out .= '  position: address'.$i.','; 
						if ( !empty( $placemark ) ) {
							$out .= 'icon: {';
							$out .= 'url: "' . $placemark . '",';
						    if ( isset( $placemark_sizes ) && is_array( $placemark_sizes ) ) {
							    $out .= 'size: new google.maps.Size(' . $placemark_sizes[0] . ', ' . $placemark_sizes[1] . '),';
							    $out .= 'origin: new google.maps.Point(0,0),';
							    $out .= 'anchor: new google.maps.Point(0, ' . $placemark_sizes[1] . ')';
							}
						  $out .= '},';

						  $out .= 'shape: {';
						  	$out .= 'scale: ['. $placemark_sizes[0] .'],';
						  	$out .= 'type: "circle"';
						  $out .= '},';

						  $out .= 'shadow: {';
						    if ( isset( $placemark_sizes ) && is_array( $placemark_sizes ) ) {
							    $out .= 'size: new google.maps.Size(' . $placemark_sizes[0] . ', ' . $placemark_sizes[1] . '),';
							    $out .= 'origin: new google.maps.Point(0,0),';
							    $out .= 'anchor: new google.maps.Point(0, ' . $placemark_sizes[1] . ')';
							}
						  $out .= '},';

						}

						$out .= 'map: map'.$map_id.',';
						$out .= 'clickable: true';
						$out .= '});'; 
						
						// Setup info window for marker
						$out .= 'var infowindow'.$i.' = new google.maps.InfoWindow({ content: "'.$info_content.'" });';
						$out .= 'google.maps.event.addListener(marker'.$i.', "click", function() {';
						$out .= 'infowindow'.$i.'.open(map'.$map_id.', marker'.$i.');';
						$out .= 'infowindow'.$i.'.setZoom(18);';
						$out .= '});';
						
					$out .= '}';
				$out .= '});';
				
			}
		}
		// Initialize map
		$out .= 'var map'.$map_id.' = new google.maps.Map(document.getElementById("'.$map_id.'"), options'.$map_id.');';

		// API 3.10
		// $out .= 'var mapTypes'.$map_id.' = map'.$map_id.'.mapTypes;';
		// Find max zoom level
		// $out .= 'var mapMaxZoom'.$map_id.' = 18;';
		// $out .= 'for (var sType in mapTypes'.$map_id.' ) {';
		// $out .= 'if (mapTypes'.$map_id.'.hasOwnProperty(sType) && typeof map'.$map_id.'.mapTypes'.$map_id.'.get(sType) === "object" && typeof map'.$map_id.'.mapTypes'.$map_id.'.get(sType).maxZoom === "number") {';
		//$out .= 'var mapTypeMaxZoom'.$map_id.' = map'.$map_id.'.mapTypes'.$map_id.'.get(sType).maxZoom;';
		//$out .= 'if (mapTypeMaxZoom > mapMaxZoom) {';
		//$out .= 'mapMaxZoom = mapTypeMaxZoom'.$map_id.';';
		//$out .= '}';
		// $out .= '}';
		// $out .= '}';


		$out .= '});';
		$out .= '</script>';
		
		return '<!--start_raw-->' . $out . '<!--end_raw-->';
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
			'name' => __( 'Maps', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'map',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>
