<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImMap {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_map( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			$params = array(

					array(
						'heading' => __( 'Title', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'title of your map.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'title',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Width', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the width of your map.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'width',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Height', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the height of your map.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'height',
						'value' => '',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Zoom', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select an initial zoom value for your map.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'zoom',
						'value' => range(1,18),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Map Type', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select which type of map you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'type',
						'value' => array(
							__('Roadmap', MISS_ADMIN_TEXTDOMAIN ) => 'ROADMAP',
							__('Satellite', MISS_ADMIN_TEXTDOMAIN ) => 'SATELLITE',
							__('Hybrid', MISS_ADMIN_TEXTDOMAIN ) => 'HYBRID',
							__('Terrain', MISS_ADMIN_TEXTDOMAIN ) => 'TERRAIN',
						),
						'type' => 'dropdown',
					),
					array(
						'heading' => __( 'Number of Markers', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Select how many markers you wish to display on your map.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'multiplier',
						'min' => 1,
						'max' => 5,
						'step' => 1,
						'unit' => __( 'markers', MISS_ADMIN_TEXTDOMAIN ),
						'type' => 'range',
					),
				);

				$multiple_params = array(
					array(
						'heading' => __( 'Address {{1}}', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the address for your marker.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'address_{{1}}',
						'type' => 'textfield',
					),
					array(
						'heading' => __( 'Placemark {{1}}', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'You can upload custom marker.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'placemark_{{1}}',
						'type' => 'attach_image',
					),
					array(
						'heading' => __( 'Description {{1}}', MISS_ADMIN_TEXTDOMAIN ),
						'description' => __( 'Type out the information you would like to display when your marker is clicked on.', MISS_ADMIN_TEXTDOMAIN ),
						'param_name' => 'descr_{{1}}',
						'type' => 'textfield',
					),
				);

			$params = array_merge( $params, miss_vc_multiple_params(5, $multiple_params ) );
			return array(
				'name' => __( 'Google Map', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_map',
				'icon' => 'im-icon-location',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => $params

			);
		}
			
		global $wp_query, $irish_framework_params;
		
		extract(shortcode_atts(array(
			'title'			=> '',
			'width'			=> '400',
			'height'		=> '300',
			'zoom'			=> '4',
			'type'			=> 'ROADMAP',
			'multiplier' 	=> '1',
		), $atts));
		
		$shortcode_id = self::_shortcode_id();
		$map_id = 'vc_gmap_id_' . $shortcode_id;
		$out = '';

		if ( $shortcode_id == 1 ) {
			// Load google maps api 
			wp_enqueue_script( MISS_PREFIX . '-mapsapi', 'http://maps.googleapis.com/maps/api/js?v=3.0&sensor=false', array('jquery'), THEME_VERSION, true );
		}

		$width = ( substr_count( $width, '%' ) ) ? $width : str_replace( 'px', '', strtolower( $width ) ) . 'px';
		$height = str_replace( array( 'px', '%' ), array( '', '' ), strtolower( $height ) ) . 'px';
		// Output our map container
		$out .= '<div id="'.$map_id.'" class = "msmw_map" style = "width: '.$width.'; height: '.$height.';"></div>';

		$out .= '<script type = "text/javascript">';
		$out .= 'jQuery(document).ready(function(){';
		$out .= '"use strict";';

		// Setup options
		// Manual: https://developers.google.com/maps/documentation/javascript/
		// Controls: https://developers.google.com/maps/documentation/javascript/controls
		$out .= 'var options'.$map_id.' = {';
		$out .= 'zoom: '.$zoom.',';
		$out .= 'scrollwheel: false,';
		$out .= 'panControl: false,';
		$out .= 'mapTypeControl: false,';
		$out .= 'zoomControl: true,';
		$out .= 'zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL, position: google.maps.ControlPosition.RIGHT_CENTER},';
		$out .= 'scaleControl: false,';
		$out .= 'mapTypeId: google.maps.MapTypeId.'.$type;
		$out .= '};';

		
			for ($i = 1; $i <= $multiplier; $i++ ) {
			
				$address = $atts['address_' . $i];
				$placemark = wp_get_attachment_url( $atts['placemark_' . $i] );
				$info_content = $atts['descr_' . $i];

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
						    $out .= 'size: new google.maps.Size(' . $placemark_sizes[0] . ', ' . $placemark_sizes[1] . '),';
						    $out .= 'origin: new google.maps.Point(0,0),';
						    $out .= 'anchor: new google.maps.Point(0, ' . $placemark_sizes[1] . ')';
						  $out .= '},';

						  $out .= 'shape: {';
						  	$out .= 'scale: ['. $placemark_sizes[0] .'],';
						  	$out .= 'type: "circle"';
						  $out .= '},';

						  $out .= 'shadow: {';
						    $out .= 'size: new google.maps.Size(' . $placemark_sizes[0] . ', ' . $placemark_sizes[1] . '),';
						    $out .= 'origin: new google.maps.Point(0,0),';
						    $out .= 'anchor: new google.maps.Point(0, ' . $placemark_sizes[1] . ')';
						  $out .= '},';

						}

						$out .= 'map: map'.$map_id.',';
						$out .= 'clickable: true';
						$out .= '});'; 
						
						// Setup info window for marker
						$out .= 'var boxText'.$i.' = document.createElement("div");';
						$out .= 'boxText'.$i.'.style.cssText = "border: none";';
						$out .= 'boxText'.$i.'.innerHTML = "' . $info_content . '";';
						$out .= 'var infowindow'.$i.' = new google.maps.InfoWindow({ content: boxText'.$i.' });';
						// $out .= 'var infowindow'.$i.' = new google.maps.InfoWindow({ content: "'.$info_content.'" });';
						$out .= 'google.maps.event.addListener(marker'.$i.', "click", function() {';
						$out .= 'infowindow'.$i.'.open(map'.$map_id.', marker'.$i.');';
						$out .= 'infowindow'.$i.'.setZoom(18);';
						$out .= '});';
						
					$out .= '}';
				$out .= '});';
				
			}

		// Initialize map
		$out .= 'var map'.$map_id.' = new google.maps.Map(document.getElementById("'.$map_id.'"), options'.$map_id.');';

		$out .= '});';
		$out .= '</script>';
		
        $head = '<div class="absolute">
                    <div class="container">
                      <section class="row">
                        <header class="section-header span12">
                          <h1 class="header">
                            <span>'.$title.'</span>
                          </h1>
                        </header>
                      </section>
                    </div>
                  </div>';
        
        $out = '<!--start_raw-->' . $head . $out . '<!--end_raw-->';
        
		return $out;
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}
endif;
?>