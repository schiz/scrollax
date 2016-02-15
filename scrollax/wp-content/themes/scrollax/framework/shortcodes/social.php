<?php
/**
 *
 */
class missSocial {

	/**
	 *  ReTweet button
	 */
	public static function tweet( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Twitter", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "tweet",
				"options" => array(
					array(
						"name" => __( "Twitter Username", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "username",
						"desc" => __( 'Type out your twitter username here.  You can find your twitter username by logging into your twitter account.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Tweet Position", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose whether you want your tweets to display vertically, horizontally, or none at all.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"vertical" => __( "Vertical", MISS_ADMIN_TEXTDOMAIN ),
							"horizontal" => __( "Horizontal", MISS_ADMIN_TEXTDOMAIN ),
							"none" => __( "None", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom Text", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "text",
						"desc" => __( 'This is the text that people will include in their Tweet when they share from your website.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Custom URL", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'By default the URL from your page will be used but you can input a custom URL here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Related Users", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "related",
						"desc" => __( 'You can input another twitter username for recommendation.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Language", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "lang",
						"desc" => __( 'Select which language you would like to display the button in.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"fr" => __( "French", MISS_ADMIN_TEXTDOMAIN ),
							"de" => __( "German", MISS_ADMIN_TEXTDOMAIN ),
							"it" => __( "Italian", MISS_ADMIN_TEXTDOMAIN ),
							"ja" => __( "Japanese", MISS_ADMIN_TEXTDOMAIN ),
							"ko" => __( "Korean", MISS_ADMIN_TEXTDOMAIN ),
							"ru" => __( "Russian", MISS_ADMIN_TEXTDOMAIN ),
							"es" => __( "Spanish", MISS_ADMIN_TEXTDOMAIN ),
							"tr" => __( "Turkish", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					"shortcode_has_atts" => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
			'layout'        => 'vertical',
			'username'		  => '',
			'text' 			  => '',
			'url'			  => '',
			'related'		  => '',
			'lang'			  => '',
	    	), $atts));
	    	
	    if ($text != '') { $text = "data-text='".$text."'"; }
	    if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($related != '') { $related = "data-related='".$related."'"; }
	    if ($lang != '') { $lang = "data-lang='".$lang."'"; }
		
		$out = '<div class = "miss_sociable"><a href="http://twitter.com/share" class="twitter-share-button" '.$url.' '.$lang.' '.$text.' '.$related.' data-count="'.$layout.'" data-via="'.$username.'">Tweet</a>';
		$out .= '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';
		
		return $out;
	}
	
	/**
	 *  Facebook Like button
	 */
	public static function fblike( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Facebook Like", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "fblike",
				"options" => array(
					array(
						"name" => __( "Layout", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose the layout you would like to use with your facebook button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"standard" => __( "Standard", MISS_ADMIN_TEXTDOMAIN ),
							"box_count" => __( "Box Count", MISS_ADMIN_TEXTDOMAIN ),
							"button_count" => __( "Button Count", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Show Faces", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "show_faces",
						"desc" => __( 'Choose whether to display faces or not.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"true" => __( "Yes", MISS_ADMIN_TEXTDOMAIN ),
							"false" => __( "No", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Action", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "action",
						"desc" => __( 'This is the text that gets displayed on the button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"like" => __( "Like", MISS_ADMIN_TEXTDOMAIN ),
							"recommend" => __( "Recommend", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Font", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "font",
						"desc" => __( 'Select which font you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"lucida+grande" => __( "Lucida Grande", MISS_ADMIN_TEXTDOMAIN ),
							"arial" => __( "Arial", MISS_ADMIN_TEXTDOMAIN ),
							"segoe+ui" => __( "Segoe Ui", MISS_ADMIN_TEXTDOMAIN ),
							"tahoma" => __( "Tahoma", MISS_ADMIN_TEXTDOMAIN ),
							"trebuchet+ms" => __( "Trebuchet MS", MISS_ADMIN_TEXTDOMAIN ),
							"verdana" => __( "Verdana", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Color Scheme", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "colorscheme",
						"desc" => __( 'Select the color scheme you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"light" => __( "Light", MISS_ADMIN_TEXTDOMAIN ),
							"dark" => __( "Dark", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					"shortcode_has_atts" => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
				'layout'		=> 'box_count',
				'width'			=> '',
				'height'		=> '',
				'show_faces'	=> 'false',
				'action'		=> 'like',
				'font'			=> 'lucida+grande',
				'colorscheme'	=> 'light',
	    	), $atts));
		
	    global $wpdb;
	    
	    if ($layout == 'standard') { $width = '450'; $height = '35';  if ($show_faces == 'true') { $height = '80'; } }
	    if ($layout == 'box_count') { $width = '55'; $height = '65'; }
	    if ($layout == 'button_count') { $width = '90'; $height = '20'; }
	    	
		$out = '<div class = "miss_sociable"><iframe src="http://www.facebook.com/plugins/like.php?href='.get_permalink();
		$out .= '&layout='.$layout.'&show_faces=false&width='.$width.'&action='.$action.'&font='.$font.'&colorscheme='.$colorscheme.'"';
		$out .= 'allowtransparency="true" style="border: medium none; overflow: hidden; width: '.$width.'px; height: '.$height.'px;"';
		$out .= 'frameborder="0" scrolling="no"></iframe></div>';
		
		return $out;
	}
	
	/**
	 *  Google Buzz button
	 */
	public static function googlebuzz( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Google Buzz", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "googlebuzz",
				"options" => array(
					array(
						"name" => __( "Layout", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the google buzz button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"normal-count" => __( "Count", MISS_ADMIN_TEXTDOMAIN ),
							"normal-button" => __( "Button", MISS_ADMIN_TEXTDOMAIN ),
							"link" => __( "Link", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'In case you wish to use a different URL you can input it here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
					array(
						"name" => __( "Custom Image", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "imageurl",
						"desc" => __( 'In case you wish to use a different image you can paste the URL here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Language", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "lang",
						"desc" => __( 'Select which language you would like to display the button in.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"ar" => __( "Arabic", MISS_ADMIN_TEXTDOMAIN ),
							"bn" => __( "Bengali", MISS_ADMIN_TEXTDOMAIN ),
							"bg" => __( "Bulgarian", MISS_ADMIN_TEXTDOMAIN ),
							"ca" => __( "Catalan", MISS_ADMIN_TEXTDOMAIN ),
							"zh" => __( "Chinese", MISS_ADMIN_TEXTDOMAIN ),
							"zh_CN" => __( "Chinese (China)", MISS_ADMIN_TEXTDOMAIN ),
							"zh_HK" => __( "Chinese (Hong Kong)", MISS_ADMIN_TEXTDOMAIN ),
							"zh_TW" => __( "Chinese (Taiwan)", MISS_ADMIN_TEXTDOMAIN ),
							"hr" => __( "Croation", MISS_ADMIN_TEXTDOMAIN ),
							"cs" => __( "Czech", MISS_ADMIN_TEXTDOMAIN ),
							"da" => __( "Danish", MISS_ADMIN_TEXTDOMAIN ),
							"nl" => __( "Dutch", MISS_ADMIN_TEXTDOMAIN ),
							"en_IN" => __( "English (India)", MISS_ADMIN_TEXTDOMAIN ),
							"en_IE" => __( "English (Ireland)", MISS_ADMIN_TEXTDOMAIN ),
							"en_SG" => __( "English (Singapore)", MISS_ADMIN_TEXTDOMAIN ),
							"en_ZA" => __( "English (South Africa)", MISS_ADMIN_TEXTDOMAIN ),
							"en_GB" => __( "English (United Kingdom)", MISS_ADMIN_TEXTDOMAIN ),
							"fil" => __( "Filipino", MISS_ADMIN_TEXTDOMAIN ),
							"fi" => __( "Finnish", MISS_ADMIN_TEXTDOMAIN ),
							"fr" => __( "French", MISS_ADMIN_TEXTDOMAIN ),
							"de" => __( "German", MISS_ADMIN_TEXTDOMAIN ),
							"de_CH" => __( "German (Switzerland)", MISS_ADMIN_TEXTDOMAIN ),
							"el" => __( "Greek", MISS_ADMIN_TEXTDOMAIN ),
							"gu" => __( "Gujarati", MISS_ADMIN_TEXTDOMAIN ),
							"iw" => __( "Hebrew", MISS_ADMIN_TEXTDOMAIN ),
							"hi" => __( "Hindi", MISS_ADMIN_TEXTDOMAIN ),
							"hu" => __( "Hungarian", MISS_ADMIN_TEXTDOMAIN ),
							"in" => __( "Indonesian", MISS_ADMIN_TEXTDOMAIN ),
							"it" => __( "Italian", MISS_ADMIN_TEXTDOMAIN ),
							"ja" => __( "Japanese", MISS_ADMIN_TEXTDOMAIN ),
							"kn" => __( "Kannada", MISS_ADMIN_TEXTDOMAIN ),
							"ko" => __( "Korean", MISS_ADMIN_TEXTDOMAIN ),
							"lv" => __( "Latvian", MISS_ADMIN_TEXTDOMAIN ),
							"ln" => __( "Lingala", MISS_ADMIN_TEXTDOMAIN ),
							"lt" => __( "Lithuanian", MISS_ADMIN_TEXTDOMAIN ),
							"ms" => __( "Malay", MISS_ADMIN_TEXTDOMAIN ),
							"ml" => __( "Malayalam", MISS_ADMIN_TEXTDOMAIN ),
							"mr" => __( "Marathi", MISS_ADMIN_TEXTDOMAIN ),
							"no" => __( "Norwegian", MISS_ADMIN_TEXTDOMAIN ),
							"or" => __( "Oriya", MISS_ADMIN_TEXTDOMAIN ),
							"fa" => __( "Persian", MISS_ADMIN_TEXTDOMAIN ),
							"pl" => __( "Polish", MISS_ADMIN_TEXTDOMAIN ),
							"pt_BR" => __( "Portugese (Brazil)", MISS_ADMIN_TEXTDOMAIN ),
							"pt_PT" => __( "Portugese (Portugal)", MISS_ADMIN_TEXTDOMAIN ),
							"ro" => __( "Romanian", MISS_ADMIN_TEXTDOMAIN ),
							"ru" => __( "Russian", MISS_ADMIN_TEXTDOMAIN ),
							"sr" => __( "Serbian", MISS_ADMIN_TEXTDOMAIN ),
							"sk" => __( "Slovak", MISS_ADMIN_TEXTDOMAIN ),
							"sl" => __( "Slovenian", MISS_ADMIN_TEXTDOMAIN ),
							"es" => __( "Spanish", MISS_ADMIN_TEXTDOMAIN ),
							"sv" => __( "Swedish", MISS_ADMIN_TEXTDOMAIN ),
							"gsw" => __( "Swiss German", MISS_ADMIN_TEXTDOMAIN ),
							"ta" => __( "Tamil", MISS_ADMIN_TEXTDOMAIN ),
							"te" => __( "Telugu", MISS_ADMIN_TEXTDOMAIN ),
							"th" => __( "Thai", MISS_ADMIN_TEXTDOMAIN ),
							"tr" => __( "Turkish", MISS_ADMIN_TEXTDOMAIN ),
							"uk" => __( "Ukranian", MISS_ADMIN_TEXTDOMAIN ),
							"vi" => __( "Vietnamese", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					"shortcode_has_atts" => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
				'layout'		=> 'normal-count',
				'url'			=> '',
				'lang'			=> '',
				'imageurl'		=> '',
	    ), $atts));
		
	    if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($imageurl != '') { $url = "data-imageurl='".$imageurl."'"; }
	    if ($lang != '') { $lang = "data-locale='".$lang."'"; }
	    
	    $out = '<div class = "miss_sociable"><a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" '.$lang.' '.$imageurl.' '.$url.' data-button-style="'.$layout.'"></a>';
	    $out .= '<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script></div>';
	    		
		return $out;
	}
	
	/**
	 *  Google +1
	 */
	public static function googleplusone( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Google +1", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "googleplusone",
				"options" => array(
					array(
						"name" => __( "Size", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "size",
						"desc" => __( 'Choose how you would like to display the google plus button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"small" => __( "Small", MISS_ADMIN_TEXTDOMAIN ),
							"standard" => __( "Standard", MISS_ADMIN_TEXTDOMAIN ),
							"medium" => __( "Medium", MISS_ADMIN_TEXTDOMAIN ),
							"tall" => __( "Tall", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Language", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "lang",
						"desc" => __( 'Select which language you would like to display the button in.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"ar" => __( "Arabic", MISS_ADMIN_TEXTDOMAIN ),
							"bn" => __( "Bengali", MISS_ADMIN_TEXTDOMAIN ),
							"bg" => __( "Bulgarian", MISS_ADMIN_TEXTDOMAIN ),
							"ca" => __( "Catalan", MISS_ADMIN_TEXTDOMAIN ),
							"zh" => __( "Chinese", MISS_ADMIN_TEXTDOMAIN ),
							"zh_CN" => __( "Chinese (China)", MISS_ADMIN_TEXTDOMAIN ),
							"zh_HK" => __( "Chinese (Hong Kong)", MISS_ADMIN_TEXTDOMAIN ),
							"zh_TW" => __( "Chinese (Taiwan)", MISS_ADMIN_TEXTDOMAIN ),
							"hr" => __( "Croation", MISS_ADMIN_TEXTDOMAIN ),
							"cs" => __( "Czech", MISS_ADMIN_TEXTDOMAIN ),
							"da" => __( "Danish", MISS_ADMIN_TEXTDOMAIN ),
							"nl" => __( "Dutch", MISS_ADMIN_TEXTDOMAIN ),
							"en_IN" => __( "English (India)", MISS_ADMIN_TEXTDOMAIN ),
							"en_IE" => __( "English (Ireland)", MISS_ADMIN_TEXTDOMAIN ),
							"en_SG" => __( "English (Singapore)", MISS_ADMIN_TEXTDOMAIN ),
							"en_ZA" => __( "English (South Africa)", MISS_ADMIN_TEXTDOMAIN ),
							"en_GB" => __( "English (United Kingdom)", MISS_ADMIN_TEXTDOMAIN ),
							"fil" => __( "Filipino", MISS_ADMIN_TEXTDOMAIN ),
							"fi" => __( "Finnish", MISS_ADMIN_TEXTDOMAIN ),
							"fr" => __( "French", MISS_ADMIN_TEXTDOMAIN ),
							"de" => __( "German", MISS_ADMIN_TEXTDOMAIN ),
							"de_CH" => __( "German (Switzerland)", MISS_ADMIN_TEXTDOMAIN ),
							"el" => __( "Greek", MISS_ADMIN_TEXTDOMAIN ),
							"gu" => __( "Gujarati", MISS_ADMIN_TEXTDOMAIN ),
							"iw" => __( "Hebrew", MISS_ADMIN_TEXTDOMAIN ),
							"hi" => __( "Hindi", MISS_ADMIN_TEXTDOMAIN ),
							"hu" => __( "Hungarian", MISS_ADMIN_TEXTDOMAIN ),
							"in" => __( "Indonesian", MISS_ADMIN_TEXTDOMAIN ),
							"it" => __( "Italian", MISS_ADMIN_TEXTDOMAIN ),
							"ja" => __( "Japanese", MISS_ADMIN_TEXTDOMAIN ),
							"kn" => __( "Kannada", MISS_ADMIN_TEXTDOMAIN ),
							"ko" => __( "Korean", MISS_ADMIN_TEXTDOMAIN ),
							"lv" => __( "Latvian", MISS_ADMIN_TEXTDOMAIN ),
							"ln" => __( "Lingala", MISS_ADMIN_TEXTDOMAIN ),
							"lt" => __( "Lithuanian", MISS_ADMIN_TEXTDOMAIN ),
							"ms" => __( "Malay", MISS_ADMIN_TEXTDOMAIN ),
							"ml" => __( "Malayalam", MISS_ADMIN_TEXTDOMAIN ),
							"mr" => __( "Marathi", MISS_ADMIN_TEXTDOMAIN ),
							"no" => __( "Norwegian", MISS_ADMIN_TEXTDOMAIN ),
							"or" => __( "Oriya", MISS_ADMIN_TEXTDOMAIN ),
							"fa" => __( "Persian", MISS_ADMIN_TEXTDOMAIN ),
							"pl" => __( "Polish", MISS_ADMIN_TEXTDOMAIN ),
							"pt_BR" => __( "Portugese (Brazil)", MISS_ADMIN_TEXTDOMAIN ),
							"pt_PT" => __( "Portugese (Portugal)", MISS_ADMIN_TEXTDOMAIN ),
							"ro" => __( "Romanian", MISS_ADMIN_TEXTDOMAIN ),
							"ru" => __( "Russian", MISS_ADMIN_TEXTDOMAIN ),
							"sr" => __( "Serbian", MISS_ADMIN_TEXTDOMAIN ),
							"sk" => __( "Slovak", MISS_ADMIN_TEXTDOMAIN ),
							"sl" => __( "Slovenian", MISS_ADMIN_TEXTDOMAIN ),
							"es" => __( "Spanish", MISS_ADMIN_TEXTDOMAIN ),
							"sv" => __( "Swedish", MISS_ADMIN_TEXTDOMAIN ),
							"gsw" => __( "Swiss German", MISS_ADMIN_TEXTDOMAIN ),
							"ta" => __( "Tamil", MISS_ADMIN_TEXTDOMAIN ),
							"te" => __( "Telugu", MISS_ADMIN_TEXTDOMAIN ),
							"th" => __( "Thai", MISS_ADMIN_TEXTDOMAIN ),
							"tr" => __( "Turkish", MISS_ADMIN_TEXTDOMAIN ),
							"uk" => __( "Ukranian", MISS_ADMIN_TEXTDOMAIN ),
							"vi" => __( "Vietnamese", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					"shortcode_has_atts" => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
				'size'			=> '',
				'lang'			=> '',
	    ), $atts));
		
	    if ($size != '') { $size = "size='".$size."'"; }
	    if ($lang != '') { $lang = "{lang: '".$lang."'}"; }
	    
		$out = '<div class = "miss_sociable"><script type="text/javascript" src="https://apis.google.com/js/plusone.js">'.$lang.'</script>';
		$out .= '<g:plusone '.$size.'></g:plusone></div>';
	    		
		return $out;
	}
	
	/**
	 *  Digg button
	 */
	public static function digg( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Digg", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "digg",
				"options" => array(
					array(
						"name" => __( "Layout", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the digg button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"DiggWide" => __( "Wide", MISS_ADMIN_TEXTDOMAIN ),
							"DiggMedium" => __( "Medium", MISS_ADMIN_TEXTDOMAIN ),
							"DiggCompact" => __( "Compact", MISS_ADMIN_TEXTDOMAIN ),
							"DiggIcon" => __( "Icon", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'In case you wish to use a different URL you can input it here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Custom Title", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "title",
						"desc" => __( 'In case you wish to use a different title you can input it here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Article Type", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "type",
						"desc" => __( 'You can set the article type here for digg.<br /><br />For example if you wanted to set it in the gaming or entertainment topics then you would type this, "gaming, entertainment".', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Custom Description", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "description",
						"desc" => __( 'You can set a custom description to be displayed within digg here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Related Stories", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "related",
						"desc" => __( 'This option allows you to specify whether links to related stories should be present in the pop up window that may appear when users click the button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"true" => __( "Disable related stories?", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "checkbox"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		global $wpdb;
		
		extract(shortcode_atts(array(
			'layout'        => 'DiggMedium',
			'url'			=> get_permalink(),
			'title'			=> '',
			'type'			=> '',
			'description'	=> '',
			'related'		=> '',
	    	), $atts));
	    
	    if ($title != '') { $title = "&title='".$title."'"; }
	    if ($type != '') { $type = "rev='".$type."'"; }
	    if ($description != '') { $description = "<span style = 'display: none;'>".$description."</span>"; }
	    if ($related != '') { $related = "&related=no"; }
	    	
		$out = '<div class = "miss_sociable"><a class="DiggThisButton '.$layout.'" href="http://digg.com/submit?url='.$url.$title.$related.'"'.$type.'>'.$description.'</a>';
		$out .= '<script type = "text/javascript" src = "http://widgets.digg.com/buttons.js"></script></div>';
		
		return $out;
	}
	
	/**
	 *  Stumbleupon button
	 */
	public static function stumbleupon( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Stumbleupon", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "stumbleupon",
				"options" => array(
					array(
						"name" => __( "Layout", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the stumbleupon button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"1" => __( "Style 1", MISS_ADMIN_TEXTDOMAIN ),
							"2" => __( "Style 2", MISS_ADMIN_TEXTDOMAIN ),
							"3" => __( "Style 3", MISS_ADMIN_TEXTDOMAIN ),
							"4" => __( "Style 4", MISS_ADMIN_TEXTDOMAIN ),
							"5" => __( "Style 5", MISS_ADMIN_TEXTDOMAIN ),
							"6" => __( "Style 6", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'You can set a custom URL to be displayed within stumbleupon here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		global $wpdb;
		
		extract(shortcode_atts(array(
			'layout'        => '5',
			'url'			=> '',
	    	), $atts));
	    	
	    if ($url != '') { $url = "&r=".$url; }
	    	
		return '<div class = "miss_sociable"><script src="http://www.stumbleupon.com/hostedbadge.php?s='.$layout.$url.'"></script></div>';
	}
	
	/**
	 *  Reddit button
	 */
	public static function reddit( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Reddit", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "reddit",
				"options" => array(
					array(
						"name" => __( "Layout", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the reddit button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"1" => __( "Style 1", MISS_ADMIN_TEXTDOMAIN ),
							"2" => __( "Style 2", MISS_ADMIN_TEXTDOMAIN ),
							"3" => __( "Style 3", MISS_ADMIN_TEXTDOMAIN ),
							"4" => __( "Style 4", MISS_ADMIN_TEXTDOMAIN ),
							"5" => __( "Style 5", MISS_ADMIN_TEXTDOMAIN ),
							"6" => __( "Style 6", MISS_ADMIN_TEXTDOMAIN ),
							"7" => __( "Interactive 1", MISS_ADMIN_TEXTDOMAIN ),
							"8" => __( "Interactive 2", MISS_ADMIN_TEXTDOMAIN ),
							"9" => __( "Interactive 3", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'You can set a custom URL to be displayed with your button instead of the current page.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Custom Title", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "title",
						"desc" => __( 'If using the interactive buttons you can specify a custom title to use here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Styling", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "disablestyle",
						"desc" => __( 'Checking this will disable the reddit styling used for the button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"true" => __( "Disable reddit styling?", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "checkbox"
					),
					array(
						"name" => __( "Target", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "target",
						"desc" => __( 'Select the target for this button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"true" => __( "Display in new window?", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "checkbox"
					),
					array(
						"name" => __( "Community", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "community",
						"desc" => __( 'If using the interactive buttons you can specify a community to target here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		global $wpdb;
		
		extract(shortcode_atts(array(
			'layout'        => '8',
			'url'			=> '',
			'disablestyle'	=> '',
			'target'		=> '',
			'community'		=> '',
			'title'			=> '',
	    	), $atts));
	    	
	    if ($disablestyle != '') { $disablestyle = "&styled=off"; }
	    if ($target != '') { $target = "&newwindow=1"; }
	    if ($layout == '7' || $layout == '8' || $layout == '9') { $url = "reddit_url='".$url."';"; } else { if ($url != '') { $url = "&url='".$url."'"; } }
	    if ($title != '') { $title = "reddit_title='".$title."';"; }
	    if ($community != '') { $community = "reddit_target='".$community."';"; }
	    if ($layout == '7' || $layout == '8' || $layout == '9') { $target = "reddit_newwindow='1';"; }
	    	
		switch ($layout)
		{
			case 1: return '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=0'.$disablestyle.$url.$target.'"></script></div>'; break;
			case 2: return '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=1'.$disablestyle.$url.$target.'"></script></div>'; break;		
			case 3: return '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=2'.$disablestyle.$url.$target.'"></script></div>'; break;		
			case 4: return '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=3'.$disablestyle.$url.$target.'"></script></div>'; break;		
			case 5: return '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=4'.$disablestyle.$url.$target.'"></script></div>'; break;		
			case 6: return '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=5'.$disablestyle.$url.$target.'"></script></div>'; break;	
			case 7: $out = '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/static/button/button1.js"></script>'; 
					$out .= '<script type = "text/javascript">'.$url.$title.$community.$target.'</script></div>';
					return $out; break;
			case 8: $out = '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/static/button/button2.js"></script>';
					$out .= '<script type = "text/javascript">'.$url.$title.$community.$target.'</script></div>';
					return $out; break;
			case 9: $out = '<div class = "miss_sociable"><script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"></script>'; 
					$out .= '<script type = "text/javascript">'.$url.$title.$community.$target.'</script></div>';
					return $out; break;	
		}
	}
	
	/**
	 *  LinkedIn button
	 */
	public static function linkedin( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "LinkedIn", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "linkedin",
				"options" => array(
					array(
						"name" => __( "Layout", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the linkedin button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"1" => __( "Style 1", MISS_ADMIN_TEXTDOMAIN ),
							"2" => __( "Style 2", MISS_ADMIN_TEXTDOMAIN ),
							"3" => __( "Style 3", MISS_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'You can set a custom URL to be displayed within linkedin here.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		global $wpdb;
		
		extract(shortcode_atts(array(
			'layout'        => '3',
			'url'			=> '',
	    	), $atts));
	    	
	    if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($layout == '2') { $layout = 'right'; }
		if ($layout == '3') { $layout = 'top'; }
	    	
		return '<div class = "miss_sociable"><script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-counter = "'.$layout.'" '.$url.'></script></div>';
	}
	
	/**
	 *  Delicious button
	 */
	public static function delicious( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Delicious", MISS_ADMIN_TEXTDOMAIN ),
				"value" => "delicious",
				"options" => array(
					array(
						"name" => __( "Custom Text", MISS_ADMIN_TEXTDOMAIN ),
						"id" => "text",
						"desc" => __( 'You can set some text to display alongside your delicious button.', MISS_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		global $wpdb;
		
		extract(shortcode_atts(array(
			'text'			=> '',
	    	), $atts));
	    	
		return '<div class = "miss_sociable"><img src="http://l.yimg.com/hr/img/delicious.small.gif" height="10" width="10" alt="Delicious" />&nbsp;<a href="http://www.delicious.com/save" onclick="window.open(&#39;http://www.delicious.com/save?v=5&noui&jump=close&url=&#39;+encodeURIComponent(location.href)+&#39;&title=&#39;+encodeURIComponent(document.title), &#39;delicious&#39;,&#39;toolbar=no,width=550,height=550&#39;); return false;">'.$text.'</a></div>';
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
			"name" => __( 'Social', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of social button you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			"value" => "social",
			"options" => $shortcode,
			"shortcode_has_types" => true
		);
		
		return $options;
	}
}

?>
