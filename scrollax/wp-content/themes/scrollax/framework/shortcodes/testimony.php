<?php
/**
 *
 */
class missTestimony {
	
	private static $testimony_id = 1;
	
	/**
	 *
	 */
	private static function _testimony_id() {
	    return self::$testimony_id++;
	}

	/**
	 *
	 */
	public static function testimonials( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Testimonials', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'testimonials',
				'options' => array(
					array(
						'name' => __( 'Limit', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Number of testimonials.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'limit',
						'default' => '1',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Autoplay', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Enable autoplay.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'autoplay',
						'type' => 'checkbox',
						'options' => array('true' => __( 'Check this option to enable testimonials autoplay.', MISS_ADMIN_TEXTDOMAIN ) ),
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
						'name' => __( 'Delay', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select timeout.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'delay',
						'type' => 'select',
						'options' => array(
							'1000'  => 1 .  ' ' . __( 'sec', MISS_ADMIN_TEXTDOMAIN ),
							'2000'  => 2 .  ' ' . __( 'sec', MISS_ADMIN_TEXTDOMAIN ),
							'3000'  => 3 .  ' ' . __( 'sec', MISS_ADMIN_TEXTDOMAIN ),
							'4000'  => 4 .  ' ' . __( 'sec', MISS_ADMIN_TEXTDOMAIN ),
							'5000'  => 5 .  ' ' . __( 'sec', MISS_ADMIN_TEXTDOMAIN ),
							'10000' => 10 . ' ' . __( 'sec', MISS_ADMIN_TEXTDOMAIN ),
							'15000' => 15 . ' ' . __( 'sec', MISS_ADMIN_TEXTDOMAIN ),
							'20000' => 20 . ' ' . __( 'sec', MISS_ADMIN_TEXTDOMAIN )
						),
						'shortcode_dont_multiply' => true
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		global $wp_query, $irish_framework_params;
		
		extract(shortcode_atts(array(
			'delay'			=> '0',
			'autoplay'		=> false,
			'limit'			=> '1',
			'animation'     => '',
		), $atts));
		
		$testimony_id = 'gmap_id_' . self::_testimony_id();

		if ( !empty( $animation )) {
			$animation = ' im-transform im-animate-element ' . $animation;
		}

		$tquery = new WP_Query();

		$tquery = $tquery->query( array(
			'post_type' => 'testimonials',
			'showposts' => $limit
		) );

		$out = '';
		foreach( $tquery as $testimony ) {
			$out .= '<div class="row-fluid">';
			$out .= '<div class="span3' . $animation . '" style="position:relative">';
			if ( get_post_thumbnail_id( $testimony->ID ) ) {

				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $testimony->ID ), 'large' );
				$thumb = miss_wp_image( $thumb[0], 400, 400 );
				$out .= '<div class="testimony_avatar"><img src="' . THEME_ASSETS . '/images/overlays/1x1.gif"  alt="" class="empty 1x1" /><img src="' . $thumb . '" class="realImage" /></div>';
			}
			$out .= '</div>';
			$out .= '<div class="span9 testimony-inner' . $animation . '">';
			if ( $testimony->post_title != '' ) {
				$out .= '<h3>';
				$out .= $testimony->post_title;
				$out .= '</h3>';
			}
			$out .= '' . do_shortcode('[blockquote]' . $testimony->post_content . '[/blockquote]') . '';
			$out .= '</div>';
			$out .= '</div>';
		}
		// Load google maps api 
		//$out = '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>';
		
		// $out .= '<script type = "text/javascript">';
		// $out .= 'jQuery(document).ready(function(){';
		// // Setup options
		// $out .= 'var options'.$map_id.' = {';
		// $out .= 'zoom: '.$zoom.',';
		// $out .= 'scrollwheel: false,';
		// $out .= 'panControl: false,';
		// $out .= 'mapTypeControl: false,';
		// $out .= 'zoomControl: true,';
		// $out .= 'zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL, position: google.maps.ControlPosition.RIGHT_CENTER},';
		// $out .= 'scaleControl: true,';
		// $out .= 'mapTypeId: google.maps.MapTypeId.'.$type;
		// $out .= '};';

		// Initialize map
		// $out .= 'var testimonials'.$map_id.' = new google.maps.Map(document.getElementById("'.$map_id.'"), options'.$map_id.');';
		
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
					$placemark_sizes = @getimagesize( $placemark );
				}

				// Setup a new Geocode for the current marker address
				// $out .= 'var address'.$i.' = "";';
				// $out .= 'var g'.$i.' = new google.maps.Geocoder();';
				// $out .= 'g'.$i.'.geocode({ "address" : "'.$address.'" }, function (results, status) {';
				// 	$out .= 'if (status == google.maps.GeocoderStatus.OK) {';
				// 		$out .= 'address'.$i.' = results[0].geometry.location;';
						
				// 		$out .= 'map'.$map_id.'.setCenter(results[0].geometry.location);';
						
				// 		$out .= 'var marker'.$i.' = new google.maps.Marker({';
				// 		$out .= 'position: address'.$i.','; 
				// 		if ( !empty( $placemark ) ) {
				// 			$out .= 'icon: {';
				// 			$out .= 'url: "' . $placemark . '",';
				// 		    $out .= 'size: new google.maps.Size(' . $placemark_sizes[0] . ', ' . $placemark_sizes[1] . '),';
				// 		    $out .= 'origin: new google.maps.Point(0,0),';
				// 		    $out .= 'anchor: new google.maps.Point(0, ' . $placemark_sizes[1] . ')';
				// 		  $out .= '},';
				// 		  $out .= 'shadow: {';
				// 		    $out .= 'size: new google.maps.Size(' . $placemark_sizes[0] . ', ' . $placemark_sizes[1] . '),';
				// 		    $out .= 'origin: new google.maps.Point(0,0),';
				// 		    $out .= 'anchor: new google.maps.Point(0, ' . $placemark_sizes[1] . ')';
				// 		  $out .= '},';

				// 		}
				// 		$out .= 'map: map'.$map_id.',';
				// 		$out .= 'clickable: true,';
				// 		$out .= '});'; 
						
				// 		// Setup info window for marker
				// 		$out .= 'var infowindow'.$i.' = new google.maps.InfoWindow({ content: "'.$info_content.'" });';
				// 		$out .= 'google.maps.event.addListener(marker'.$i.', "click", function() {';
				// 		$out .= 'infowindow'.$i.'.open(map'.$map_id.', marker'.$i.');';
				// 		$out .= '});';
						
				// 	$out .= '}';
				// $out .= '});';
				
			}
		}
		
		// $out .= '});';
		// $out .= '</script>';
		
		// Output our map container
		$out .= '<div id="'.$testimony_id.'" class="testimonials"></div>';
		
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
			'name' => __( 'Testimonials', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'testimonials',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>
