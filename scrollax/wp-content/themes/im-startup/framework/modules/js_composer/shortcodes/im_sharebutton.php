<?php
if( class_exists( 'WPBakeryShortCode_VC_Tab' ) ):

/**
 *
 */
class misscomposerImSharebutton {
	private static $shortcode_id = 1;
	
	private static function _shortcode_id() {
	    return self::$shortcode_id++;
	}
	/**
	 *
	 */
	public static function im_sharebutton( $atts = null, $content = null ) {

		$params = array(
			array(
				'heading' => __( 'Social', MISS_ADMIN_TEXTDOMAIN ),
				'description' => __( 'Choose which type of social button you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'social',
				'type' => 'dropdown',
				'value' => array(
					__( 'Twitter', MISS_ADMIN_TEXTDOMAIN ) => 'twitter',
					__( 'Facebook Like', MISS_ADMIN_TEXTDOMAIN ) => 'fblike',
					__( 'Google +1', MISS_ADMIN_TEXTDOMAIN ) => 'googleplusone',
					__( 'Digg', MISS_ADMIN_TEXTDOMAIN ) => 'digg',
					__( 'Stumbleupon', MISS_ADMIN_TEXTDOMAIN ) => 'stumbleupon',
					__( 'Reddit', MISS_ADMIN_TEXTDOMAIN ) => 'reddit',
					__( 'LinkedIn', MISS_ADMIN_TEXTDOMAIN ) => 'linkedin',
					__( 'Delicious', MISS_ADMIN_TEXTDOMAIN ) => 'delicious',
					__( 'Stumbleupon', MISS_ADMIN_TEXTDOMAIN ) => 'stumbleupon',
				),
			),
/* Twitter */
			array(
				'heading' => __( 'Twitter Username', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'twitter_username',
				'description' => __( 'Type out your twitter username here.  You can find your twitter username by logging into your twitter account.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('twitter'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Tweet Position', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'twitter_layout',
				'description' => __( 'Choose whether you want your tweets to display vertically, horizontally, or none at all.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Vertical', MISS_ADMIN_TEXTDOMAIN ) => 'vertical',
					__( 'Horizontal', MISS_ADMIN_TEXTDOMAIN ) => 'horizontal',
					__( 'None', MISS_ADMIN_TEXTDOMAIN ) => 'none',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('twitter'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Custom Text', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'twitter_text',
				'description' => __( 'This is the text that people will include in their Tweet when they share from your website.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('twitter'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Custom URL', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'twitter_url',
				'description' => __( 'By default the URL from your page will be used but you can input a custom URL here.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('twitter'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Related Users', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'twitter_related',
				'description' => __( 'You can input another twitter username for recommendation.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('twitter'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Language', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'twitter_lang',
				'description' => __( 'Select which language you would like to display the button in.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'English', MISS_ADMIN_TEXTDOMAIN ) => 'en',
					__( 'French', MISS_ADMIN_TEXTDOMAIN ) => 'fr',
					__( 'German', MISS_ADMIN_TEXTDOMAIN ) => 'de',
					__( 'Italian', MISS_ADMIN_TEXTDOMAIN ) => 'it',
					__( 'Japanese', MISS_ADMIN_TEXTDOMAIN ) => 'ja',
					__( 'Korean', MISS_ADMIN_TEXTDOMAIN ) => 'ko',
					__( 'Russian', MISS_ADMIN_TEXTDOMAIN ) => 'ru',
					__( 'Spanish', MISS_ADMIN_TEXTDOMAIN ) => 'es',
					__( 'Turkish', MISS_ADMIN_TEXTDOMAIN ) => 'tr',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('twitter'),
				),
				'type' => 'dropdown',
			),
/* Facebook */
			array(
				'heading' => __( 'Layout', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'fblike_layout',
				'description' => __( 'Choose the layout you would like to use with your facebook button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Standard', MISS_ADMIN_TEXTDOMAIN ) => 'standard',
					__( 'Box Count', MISS_ADMIN_TEXTDOMAIN ) => 'box_count',
					__( 'Button Count', MISS_ADMIN_TEXTDOMAIN ) => 'button_count',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('fblike'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Show Faces', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'fblike_show_faces',
				'description' => __( 'Choose whether to display faces or not.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Yes', MISS_ADMIN_TEXTDOMAIN ) => 'true',
					__( 'No', MISS_ADMIN_TEXTDOMAIN ) => 'false',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('fblike'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Action', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'fblike_action',
				'description' => __( 'This is the text that gets displayed on the button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Like', MISS_ADMIN_TEXTDOMAIN ) => 'like',
					__( 'Recommend', MISS_ADMIN_TEXTDOMAIN ) => 'recommend',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('fblike'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Font', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'fblike_font',
				'description' => __( 'Select which font you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Lucida Grande', MISS_ADMIN_TEXTDOMAIN ) => 'lucida+grande',
					__( 'Arial', MISS_ADMIN_TEXTDOMAIN ) => 'arial',
					__( 'Segoe Ui', MISS_ADMIN_TEXTDOMAIN ) => 'segoe+ui',
					__( 'Tahoma', MISS_ADMIN_TEXTDOMAIN ) => 'tahoma',
					__( 'Trebuchet MS', MISS_ADMIN_TEXTDOMAIN ) => 'trebuchet+ms',
					__( 'Verdana', MISS_ADMIN_TEXTDOMAIN ) => 'verdana',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('fblike'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Color Scheme', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'fblike_colorscheme',
				'description' => __( 'Select the color scheme you would like to use.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Light', MISS_ADMIN_TEXTDOMAIN ) => 'light',
					__( 'Dark', MISS_ADMIN_TEXTDOMAIN ) => 'dark',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('fblike'),
				),
				'type' => 'dropdown',
			),
/* googleplusone */
			array(
				'heading' => __( 'Size', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'googleplusone_size',
				'description' => __( 'Choose how you would like to display the google plus button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Small', MISS_ADMIN_TEXTDOMAIN ) => 'small',
					__( 'Standard', MISS_ADMIN_TEXTDOMAIN ) => 'standard',
					__( 'Medium', MISS_ADMIN_TEXTDOMAIN ) => 'medium',
					__( 'Tall', MISS_ADMIN_TEXTDOMAIN ) => 'tall',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('googleplusone'),
				),
				'type' => 'dropdown',
			),
/* digg */
			array(
				'heading' => __( 'Layout', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'digg_layout',
				'description' => __( 'Choose how you would like to display the digg button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Wide', MISS_ADMIN_TEXTDOMAIN ) => 'DiggWide',
					__( 'Medium', MISS_ADMIN_TEXTDOMAIN ) => 'DiggMedium',
					__( 'Compact', MISS_ADMIN_TEXTDOMAIN ) => 'DiggCompact',
					__( 'Icon', MISS_ADMIN_TEXTDOMAIN ) => 'DiggIcon',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('digg'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Custom URL', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'digg_url',
				'description' => __( 'In case you wish to use a different URL you can input it here.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('digg'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Custom Title', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'digg_title',
				'description' => __( 'In case you wish to use a different title you can input it here.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('digg'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Article Type', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'digg_type',
				'description' => __( 'You can set the article type here for digg.<br /><br />For example if you wanted to set it in the gaming or entertainment topics then you would type this, &quot;gaming, entertainment&quot;.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('digg'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Custom Description', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'digg_description',
				'description' => __( 'You can set a custom description to be displayed within digg here.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('digg'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Related Stories', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'digg_related',
				'description' => __( 'This option allows you to specify whether links to related stories should be present in the pop up window that may appear when users click the button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Disable related stories?', MISS_ADMIN_TEXTDOMAIN ) => 'true',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('digg'),
				),
				'type' => 'checkbox',
			),
/* stumbleupon */
			array(
				'heading' => __( 'Layout', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'stumbleupon_layout',
				'description' => __( 'Choose how you would like to display the stumbleupon button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Style 1', MISS_ADMIN_TEXTDOMAIN ) => '1',
					__( 'Style 2', MISS_ADMIN_TEXTDOMAIN ) => '2',
					__( 'Style 3', MISS_ADMIN_TEXTDOMAIN ) => '3',
					__( 'Style 4', MISS_ADMIN_TEXTDOMAIN ) => '4',
					__( 'Style 5', MISS_ADMIN_TEXTDOMAIN ) => '5',
					__( 'Style 6', MISS_ADMIN_TEXTDOMAIN ) => '6',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('stumbleupon'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Custom URL', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'stumbleupon_url',
				'description' => __( 'You can set a custom URL to be displayed within stumbleupon here.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('stumbleupon'),
				),
				'type' => 'textfield',
			),
/* reddit */
			array(
				'heading' => __( 'Layout', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'reddit_layout',
				'description' => __( 'Choose how you would like to display the reddit button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Style 1', MISS_ADMIN_TEXTDOMAIN ) => '1',
					__( 'Style 2', MISS_ADMIN_TEXTDOMAIN ) => '2',
					__( 'Style 3', MISS_ADMIN_TEXTDOMAIN ) => '3',
					__( 'Style 4', MISS_ADMIN_TEXTDOMAIN ) => '4',
					__( 'Style 5', MISS_ADMIN_TEXTDOMAIN ) => '5',
					__( 'Style 6', MISS_ADMIN_TEXTDOMAIN ) => '6',
					__( 'Interactive 1', MISS_ADMIN_TEXTDOMAIN ) => '7',
					__( 'Interactive 2', MISS_ADMIN_TEXTDOMAIN ) => '8',
					__( 'Interactive 3', MISS_ADMIN_TEXTDOMAIN ) => '9',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('reddit'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Custom URL', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'reddit_url',
				'description' => __( 'You can set a custom URL to be displayed with your button instead of the current page.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('reddit'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Custom Title', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'reddit_title',
				'description' => __( 'If using the interactive buttons you can specify a custom title to use here.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('reddit'),
				),
				'type' => 'textfield',
			),
			array(
				'heading' => __( 'Styling', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'reddit_disablestyle',
				'description' => __( 'Checking this will disable the reddit styling used for the button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Disable reddit styling?', MISS_ADMIN_TEXTDOMAIN ) => 'true',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('reddit'),
				),
				'type' => 'checkbox',
			),
			array(
				'heading' => __( 'Target', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'reddit_target',
				'description' => __( 'Select the target for this button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Display in new window?', MISS_ADMIN_TEXTDOMAIN ) => 'true',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('reddit'),
				),
				'type' => 'checkbox',
			),
			array(
				'heading' => __( 'Community', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'reddit_community',
				'description' => __( 'If using the interactive buttons you can specify a community to target here.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('reddit'),
				),
				'type' => 'textfield',
			),
/* linkedin */
			array(
				'heading' => __( 'Layout', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'linkedin_layout',
				'description' => __( 'Choose how you would like to display the linkedin button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Style 1', MISS_ADMIN_TEXTDOMAIN ) => '1',
					__( 'Style 2', MISS_ADMIN_TEXTDOMAIN ) => '2',
					__( 'Style 3', MISS_ADMIN_TEXTDOMAIN ) => '3',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array('linkedin'),
				),
				'type' => 'dropdown',
			),
			array(
				'heading' => __( 'Custom URL', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'linkedin_url',
				'description' => __( 'You can set a custom URL to be displayed within linkedin here.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('linkedin'),
				),
				'type' => 'textfield',
			),
/* delicious */
			array(
				'heading' => __( 'Custom Text', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'delicious_text',
				'description' => __( 'You can set some text to display alongside your delicious button.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => '',
				'dependency' => array(
					'element' => 'social', 
					'value' => array('delicious'),
				),
				'type' => 'textfield',
			),


/* Landuage for google */
			array(
				'heading' => __( 'Language', MISS_ADMIN_TEXTDOMAIN ),
				'param_name' => 'lang',
				'description' => __( 'Select which language you would like to display the button in.', MISS_ADMIN_TEXTDOMAIN ),
				'value' => array(
					__( 'Arabic', MISS_ADMIN_TEXTDOMAIN ) => 'ar',
					__( 'Bengali', MISS_ADMIN_TEXTDOMAIN ) => 'bn',
					__( 'Bulgarian', MISS_ADMIN_TEXTDOMAIN ) => 'bg',
					__( 'Catalan', MISS_ADMIN_TEXTDOMAIN ) => 'ca',
					__( 'Chinese', MISS_ADMIN_TEXTDOMAIN ) => 'zh',
					__( 'Chinese (China)', MISS_ADMIN_TEXTDOMAIN ) => 'zh_CN',
					__( 'Chinese (Hong Kong)', MISS_ADMIN_TEXTDOMAIN ) => 'zh_HK',
					__( 'Chinese (Taiwan)', MISS_ADMIN_TEXTDOMAIN ) => 'zh_TW',
					__( 'Croation', MISS_ADMIN_TEXTDOMAIN ) => 'hr',
					__( 'Czech', MISS_ADMIN_TEXTDOMAIN ) => 'cs',
					__( 'Danish', MISS_ADMIN_TEXTDOMAIN ) => 'da',
					__( 'Dutch', MISS_ADMIN_TEXTDOMAIN ) => 'nl',
					__( 'English (India)', MISS_ADMIN_TEXTDOMAIN ) => 'en_IN',
					__( 'English (Ireland)', MISS_ADMIN_TEXTDOMAIN ) => 'en_IE',
					__( 'English (Singapore)', MISS_ADMIN_TEXTDOMAIN ) => 'en_SG',
					__( 'English (South Africa)', MISS_ADMIN_TEXTDOMAIN ) => 'en_ZA',
					__( 'English (United Kingdom)', MISS_ADMIN_TEXTDOMAIN ) => 'en_GB',
					__( 'Filipino', MISS_ADMIN_TEXTDOMAIN ) => 'fil',
					__( 'Finnish', MISS_ADMIN_TEXTDOMAIN ) => 'fi',
					__( 'French', MISS_ADMIN_TEXTDOMAIN ) => 'fr',
					__( 'German', MISS_ADMIN_TEXTDOMAIN ) => 'de',
					__( 'German (Switzerland)', MISS_ADMIN_TEXTDOMAIN ) => 'de_CH',
					__( 'Greek', MISS_ADMIN_TEXTDOMAIN ) => 'el',
					__( 'Gujarati', MISS_ADMIN_TEXTDOMAIN ) => 'gu',
					__( 'Hebrew', MISS_ADMIN_TEXTDOMAIN ) => 'iw',
					__( 'Hindi', MISS_ADMIN_TEXTDOMAIN ) => 'hi',
					__( 'Hungarian', MISS_ADMIN_TEXTDOMAIN ) => 'hu',
					__( 'Indonesian', MISS_ADMIN_TEXTDOMAIN ) => 'in',
					__( 'Italian', MISS_ADMIN_TEXTDOMAIN ) => 'it',
					__( 'Japanese', MISS_ADMIN_TEXTDOMAIN ) => 'ja',
					__( 'Kannada', MISS_ADMIN_TEXTDOMAIN ) => 'kn',
					__( 'Korean', MISS_ADMIN_TEXTDOMAIN ) => 'ko',
					__( 'Latvian', MISS_ADMIN_TEXTDOMAIN ) => 'lv',
					__( 'Lingala', MISS_ADMIN_TEXTDOMAIN ) => 'ln',
					__( 'Lithuanian', MISS_ADMIN_TEXTDOMAIN ) => 'lt',
					__( 'Malay', MISS_ADMIN_TEXTDOMAIN ) => 'ms',
					__( 'Malayalam', MISS_ADMIN_TEXTDOMAIN ) => 'ml',
					__( 'Marathi', MISS_ADMIN_TEXTDOMAIN ) => 'mr',
					__( 'Norwegian', MISS_ADMIN_TEXTDOMAIN ) => 'no',
					__( 'Oriya', MISS_ADMIN_TEXTDOMAIN ) => 'or',
					__( 'Persian', MISS_ADMIN_TEXTDOMAIN ) => 'fa',
					__( 'Polish', MISS_ADMIN_TEXTDOMAIN ) => 'pl',
					__( 'Portugese (Brazil)', MISS_ADMIN_TEXTDOMAIN ) => 'pt_BR',
					__( 'Portugese (Portugal)', MISS_ADMIN_TEXTDOMAIN ) => 'pt_PT',
					__( 'Romanian', MISS_ADMIN_TEXTDOMAIN ) => 'ro',
					__( 'Russian', MISS_ADMIN_TEXTDOMAIN ) => 'ru',
					__( 'Serbian', MISS_ADMIN_TEXTDOMAIN ) => 'sr',
					__( 'Slovak', MISS_ADMIN_TEXTDOMAIN ) => 'sk',
					__( 'Slovenian', MISS_ADMIN_TEXTDOMAIN ) => 'sl',
					__( 'Spanish', MISS_ADMIN_TEXTDOMAIN ) => 'es',
					__( 'Swedish', MISS_ADMIN_TEXTDOMAIN ) => 'sv',
					__( 'Swiss German', MISS_ADMIN_TEXTDOMAIN ) => 'gsw',
					__( 'Tamil', MISS_ADMIN_TEXTDOMAIN ) => 'ta',
					__( 'Telugu', MISS_ADMIN_TEXTDOMAIN ) => 'te',
					__( 'Thai', MISS_ADMIN_TEXTDOMAIN ) => 'th',
					__( 'Turkish', MISS_ADMIN_TEXTDOMAIN ) => 'tr',
					__( 'Ukranian', MISS_ADMIN_TEXTDOMAIN ) => 'uk',
					__( 'Vietnamese', MISS_ADMIN_TEXTDOMAIN ) => 'vi',
				),
				'dependency' => array(
					'element' => 'social', 
					'value' => array( 'googleplusone' ),
				),
				'type' => 'dropdown',
			),

		);

		if( $atts == 'generator' ) {

			return array(
				'name' => __( 'Share Button (any Social)', MISS_ADMIN_TEXTDOMAIN ),
				'base' => 'im_sharebutton',
				'icon' => 'im-icon-share-2',
				'category' => __('Theme Short-Codes', MISS_ADMIN_TEXTDOMAIN ),
				'params' => $params,

			);
		}
		
		$out = '';
		extract(shortcode_atts(array(
			'social'  => '',
		), $atts));
		foreach ( $params as $key => $value ) {
			$atts[$value['param_name']] = ( !isset( $atts[$value['param_name']] ) || $atts[$value['param_name']] === false ) ? '' : $atts[$value['param_name']];
		}
		global $wpdb;

		switch ( $social ) {
			case 'twitter':
				if ($atts['twitter_text'] != '') { $atts['twitter_text'] = "data-text='".$atts['twitter_text']."'"; }
				if ($atts['twitter_url'] != '') { $atts['twitter_url'] = "data-url='".$atts['twitter_url']."'"; }
				if ($atts['twitter_related'] != '') { $atts['twitter_related'] = "data-related='".$atts['twitter_related']."'"; }
				if ($atts['twitter_lang'] != '') { $atts['twitter_lang'] = "data-lang='".$atts['twitter_lang']."'"; }
				$out .= '<a href="http://twitter.com/share" class="twitter-share-button" '.$atts['twitter_url'].' '.$atts['twitter_lang'].' '.$atts['twitter_text'].' '.$atts['twitter_related'].' data-count="'.$atts['twitter_layout'].'" data-via="'.$atts['twitter_username'].'">Tweet</a>';
				$out .= '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
				break;
			
			case 'fblike':
				if ($atts['fblike_layout'] == 'standard') { $atts['fblike_width'] = '450'; $atts['fblike_height'] = '35';  if ($atts['fblike_show_faces'] == 'true') { $atts['fblike_height'] = '80'; } }
				if ($atts['fblike_layout'] == 'box_count') { $atts['fblike_width'] = '55'; $atts['fblike_height'] = '65'; }
				if ($atts['fblike_layout'] == 'button_count') { $atts['fblike_width'] = '90'; $atts['fblike_height'] = '20'; }			
				$out .= '<iframe src="http://www.facebook.com/plugins/like.php?href='.get_permalink();
				$out .= '&layout='.$atts['fblike_layout'].'&show_faces=false&width='.$atts['fblike_width'].'&action='.$atts['fblike_action'].'&font='.$atts['fblike_font'].'&colorscheme='.$atts['fblike_colorscheme'].'"';
				$out .= 'allowtransparency="true" style="border: medium none; overflow: hidden; width: '.$atts['fblike_width'].'px; height: '.$atts['fblike_height'].'px;"';
				$out .= 'frameborder="0" scrolling="no"></iframe>';
				break;

			case 'googleplusone':
				if ($atts['googleplusone_size'] != '') { $atts['googleplusone_size'] = "size='".$atts['googleplusone_size']."'"; }
				if ($atts['lang'] != '') { $atts['lang'] = "{lang: '".$atts['lang']."'}"; }
				$out .= '<script type="text/javascript" src="https://apis.google.com/js/plusone.js">'.$atts['lang'].'</script>';
				$out .= '<g:plusone '.$atts['googleplusone_size'].'></g:plusone>';
				break;
			
			case 'digg':
				if ($atts['digg_title'] != '') { $atts['digg_title'] = "&title='".$atts['digg_title']."'"; }
				if ($atts['digg_type'] != '') { $atts['digg_type'] = "rev='".$atts['digg_type']."'"; }
				if ($atts['digg_description'] != '') { $atts['digg_description'] = "<span style = 'display: none;'>".$atts['digg_description']."</span>"; }
				if ($atts['digg_related'] != '') { $atts['digg_related'] = "&related=no"; }	
				$out .= '<a class="DiggThisButton '.$atts['digg_layout'].'" href="http://digg.com/submit?url='.$atts['digg_url'].$atts['digg_title'].$atts['digg_related'].'"'.$atts['digg_type'].'>'.$atts['digg_description'].'</a>';
				$out .= '<script type = "text/javascript" src="http://widgets.digg.com/buttons.js"></script>';
				break;
			
			case 'stumbleupon':
				if ($atts['stumbleupon_url'] != '') { $atts['stumbleupon_url'] = "&r=".$atts['stumbleupon_url']; }
				$out .= '<script src="http://www.stumbleupon.com/hostedbadge.php?s='.$atts['stumbleupon_layout'].$atts['stumbleupon_url'].'"></script>';
				break;
			
			case 'reddit':
				if ($atts['reddit_disablestyle'] != '') { $atts['reddit_disablestyle'] = "&styled=off"; }
				if ($atts['reddit_target'] != '') { $atts['reddit_target'] = "&newwindow=1"; }
				if ($atts['reddit_layout'] == '7' || $atts['reddit_layout'] == '8' || $atts['reddit_layout'] == '9') { $atts['reddit_url'] = "reddit_url='".$atts['reddit_url']."';"; } else { if ($atts['reddit_url'] != '') { $atts['reddit_url'] = "&url='".$atts['reddit_url']."'"; } }
				if ($atts['reddit_title'] != '') { $atts['reddit_title'] = "reddit_title='".$atts['reddit_title']."';"; }
				if ($atts['reddit_community'] != '') { $atts['reddit_community'] = "reddit_target='".$atts['reddit_community']."';"; }
				if ($atts['reddit_layout'] == '7' || $atts['reddit_layout'] == '8' || $atts['reddit_layout'] == '9') { $atts['reddit_target'] = "reddit_newwindow='1';"; }
				switch ($atts['reddit_layout'])
				{
					case 1: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=0'.$atts['reddit_disablestyle'].$atts['reddit_url'].$atts['reddit_target'].'"></script>'; break;
					case 2: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=1'.$atts['reddit_disablestyle'].$atts['reddit_url'].$atts['reddit_target'].'"></script>'; break;		
					case 3: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=2'.$atts['reddit_disablestyle'].$atts['reddit_url'].$atts['reddit_target'].'"></script>'; break;		
					case 4: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=3'.$atts['reddit_disablestyle'].$atts['reddit_url'].$atts['reddit_target'].'"></script>'; break;		
					case 5: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=4'.$atts['reddit_disablestyle'].$atts['reddit_url'].$atts['reddit_target'].'"></script>'; break;		
					case 6: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=5'.$atts['reddit_disablestyle'].$atts['reddit_url'].$atts['reddit_target'].'"></script>'; break;	
					case 7: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/static/button/button1.js"></script>'; 
						$out .= '<script type = "text/javascript">'.$atts['reddit_url'].$atts['reddit_title'].$atts['reddit_community'].$atts['reddit_target'].'</script>';
					case 8: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/static/button/button2.js"></script>';
						$out .= '<script type = "text/javascript">'.$atts['reddit_url'].$atts['reddit_title'].$atts['reddit_community'].$atts['reddit_target'].'</script>';
					case 9: 
						$out .= '<script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"></script>'; 
						$out .= '<script type = "text/javascript">'.$atts['reddit_url'].$atts['reddit_title'].$atts['reddit_community'].$atts['reddit_target'].'</script>';
				}
				break;
			
			case 'linkedin':
				if ($atts['linkedin_url'] != '') { $atts['linkedin_url'] = "data-url='".$atts['linkedin_url']."'"; }
				if ($atts['linkedin_layout'] == '2') { $atts['linkedin_layout'] = 'right'; }
				if ($atts['linkedin_layout'] == '3') { $atts['linkedin_layout'] = 'top'; }
				$out .= '<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-counter = "'.$atts['linkedin_layout'].'" '.$atts['linkedin_url'].'></script>';
				break;
			
			case 'delicious':
				$out .= '<img src="http://delicious.com/img/logo.png" height="12" width="12" alt="Delicious" style="display:inline-block; vertical-align:middle;" />&nbsp;<a href="http://www.delicious.com/save" onclick="window.open(&#39;http://www.delicious.com/save?v=5&noui&jump=close&url=&#39;+encodeURIComponent(location.href)+&#39;&title=&#39;+encodeURIComponent(document.title), &#39;delicious&#39;,&#39;toolbar=no,width=550,height=550&#39;); return false;">'.$atts['delicious_text'].'</a>';
				break;
			
			default:
				$out = 'You set incorrect settings for "Social Shortcode"';
				break;
		}

		return '<div class="miss_sociable ' . $social . '">' . $out . '</div>';
	}
	
	public static function _options( $method ) {
		return self::$method('generator');
	}
}

endif;
?>