<?php

/**
 *
 */

function miss_local_assets($lib) {
	/*
	 * Libs
	 */
	if ( file_exists( THEME_FUNCTIONS . '/scripts.inc.php' ) ) {
		$assets = include( THEME_FUNCTIONS . '/scripts.inc.php' );
	}

	$atomic_scripts = Array();
	$atomic_styles = Array();

	if ($lib == 'styles') {
		return $styles;
	} else if ($lib == 'scripts') {
		return $scripts;
	} else {
		return $assets;
	}

}
/* 
 * Unloading Modules
 * @since 1.5
 */
function miss_unload_assets($data = Array(), $library = false, $property = false, $asset = false) {
	if (isset($data) && is_array($data) && is_array($property)) {
		if ($asset != false) {
			$property = '#'.$property;
			unset($data[$library][$property][$asset]);
		} else {
			// do nothing
		}
	} elseif ( isset($data) && $library != false ) {
		unset($data[$library]);
	}
	return $data;
}

function miss_collect_assets($in = array(), $property = "styles", $action = "register") {
	foreach($in as $directory => $options) {
		if ($options['#active'] == true) {
			/* Register */
			if ($action == "enqueue") {
				$wp_enqueue_script = Array();
				if ($property == "scripts") {
					if (isset($options['#scripts']) && is_array($options['#scripts']) ) {
						foreach($options['#scripts'] as $js_id => $script) {
							if (isset($options['#reg']) && $options['#reg'] == $script) {
								$options['#hash'] = $options['#library'][0];
							} else {
								$options['#hash'] = md5($directory . MISS_PREFIX . $script);
							}
							$wp_enqueue_script[] = $options['#hash'];
							wp_enqueue_script(
								$options['#hash']
							);
						}
					}
				} else {
					/* Rendering Style */
					if (isset($options['#styles']) && is_array($options['#styles'])) {
						foreach($options['#styles'] as $css_id => $style) {
							$options['#hash'] = md5($directory . MISS_PREFIX . $style);
							wp_enqueue_style(
								$options['#hash']
							);
						}
					}
				}
			} else {
				if ($property == "scripts") {
					if (isset($options['#scripts']) && is_array($options['#scripts']) ) {
						foreach($options['#scripts'] as $js_id => $script) {
							$options['#hash'] = md5($directory . MISS_PREFIX . $script);
							if (isset($options['#reg']) && $options['#reg'] != $script || !isset($options['#reg'])) {
								wp_register_script(
									$options['#hash'],							// ID
									esc_url( THEME_ASSETS . '/scripts/static/' . $directory . '/' . $script ),	// Location
									$options['#library'],						// Library
									THEME_VERSION,								// Version
									$options['#footer']							// Library
								);
							} else {
								wp_register_script(
									$options['#library'][0],					// ID
									esc_url( THEME_ASSETS . '/scripts/static/' . $directory . '/' . $script ),	// Location
									'',											// Library
									THEME_VERSION,								// Version
									$options['#footer']							// Library
								);
							}
						}
					}
				} else {
					if (isset($options['#styles']) && is_array($options['#styles'])) {
						foreach($options['#styles'] as $css_id => $style) {
							$options['#hash'] = md5($directory . MISS_PREFIX . $style);
							wp_register_style(
								$options['#hash'],								// ID
								esc_url( THEME_ASSETS . '/css/' . $directory . '/' . $style ),	// Location
								false,											// Load after
								THEME_VERSION									// Version
							);
						}
					}
				}
			}
		}
	}
}
function miss_register_style() {
	$skin_nt_writable = get_option( MISS_SKIN_NT_WRITABLE );
	$active_skin = apply_filters( 'miss_active_skin', get_option( MISS_ACTIVE_SKIN ) );
	$fonts_in_use = apply_filters( 'miss_active_skin', get_option( MISS_ACTIVE_SKIN ) );
	$google_fonts = array();
	//var_dump($fonts_in_use);
	$font_subject = '([^"]+)';
	if (isset($fonts_in_use['fonts'])) {
		foreach( $fonts_in_use['fonts'] as $declaration => $font ) { 
			if (preg_match('/"([^"]+)"/', $font, $m)) {
					$google_fonts[] = $m[1];
			} else {
				 //preg_match returns the number of matches found, 
				 //so if here didn't match pattern
			}
		}
	}

	//Registering user styles style.css
	//wp_register_style( MISS_PREFIX . 'user_custom_css', $url = home_url('/') . '?cssgenerator=custom', false, THEME_VERSION, 'screen' );

	//User Styles UX model
	/*if ( file_exists( THEME_SKIN_CACHE ) && filesize( THEME_SKIN_CACHE ) > 16  && THEME_ENABLE_SKIN_CACHE == true ) {
		wp_register_style( MISS_PREFIX . 'user_experience', $url = THEME_SKIN_CACHE_URI, false, THEME_VERSION, 'screen' );
	} else {
		wp_register_style( MISS_PREFIX . 'user_experience', $url = home_url('/') . '?cssgenerator=ux', false, THEME_VERSION, 'screen' );
	}*/

	//Registering default style.css
	wp_register_style( MISS_PREFIX . 'general', get_bloginfo( 'stylesheet_url' ), false, THEME_VERSION, 'screen' );

	//Registering local assets
	miss_collect_assets(miss_local_assets('assets'), $property = 'styles', $action = 'register');

	//Loading Google Fonts
	foreach ($google_fonts as $gfont) {
		wp_register_style( MISS_PREFIX . md5($gfont), esc_url( 'http://fonts.googleapis.com/css?family='.$gfont ), false, THEME_VERSION, 'screen' );
	}
	wp_register_style( MISS_PREFIX . 'font1', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,900,400italic', false, THEME_VERSION, 'screen' );

	//Loading shortcodes and widgets
	wp_register_style( MISS_PREFIX . 'shortcodes', esc_url( THEME_ASSETS . '/styles/css/shortcodes.css' ), false, THEME_VERSION, 'screen' );
	wp_register_style( MISS_PREFIX . 'widgets', esc_url( THEME_ASSETS . '/styles/css/widgets.css'), false, THEME_VERSION, 'screen' );

	if (miss_get_setting('review') == 'enable') {
		wp_register_style( MISS_PREFIX . 'score', esc_url( THEME_ASSETS . '/styles/css/score.css' ), false, THEME_VERSION, 'screen' );
	}
	if( is_array( $skin_nt_writable ) && in_array( str_replace( '.css', '', $active_skin['style_variations'] ), $skin_nt_writable ) ) {

	} elseif ( !empty( $active_skin['wpmu'] ) ) {
		global $blog_id;
	} else {
	}
}

/**
 *
 */
function miss_register_script() {
	if( is_admin() ) return;
	
	//Registering local assets
	miss_collect_assets(miss_local_assets('assets'), $property = 'scripts', $action = 'register');

}

/**
 *
 */
function miss_enqueue_style() {
	global $wp_query;
	$skin_nt_writable = get_option( MISS_SKIN_NT_WRITABLE );
	$active_skin = apply_filters( 'miss_active_skin', get_option( MISS_ACTIVE_SKIN ) );
	$fonts_in_use = apply_filters( 'miss_active_skin', get_option( MISS_ACTIVE_SKIN ) );

	$google_fonts = array();
	//var_dump($fonts_in_use);
	$font_subject = '([^"]+)';
	if (isset($fonts_in_use['fonts'])) {
		foreach( $fonts_in_use['fonts'] as $declaration => $font ) { 
			if (preg_match('/"([^"]+)"/', $font, $m)) {
					$google_fonts[] = $m[1];
			} else {
				 //preg_match returns the number of matches found, 
				 //so if here didn't match pattern
			}
		}
	}

	//enqueue styles
	miss_collect_assets(miss_local_assets('assets'), $property = 'styles', $action = 'enqueue');

	//output Google Fonts if used
	foreach ($google_fonts as $gfont) {
		wp_enqueue_style(MISS_PREFIX . md5($gfont));
	}
	// Loading Default style.css - required for child themes
	wp_enqueue_style(MISS_PREFIX . 'general');

	// Built-in Google Web Gonts
	wp_enqueue_style(MISS_PREFIX . 'font1');
	wp_enqueue_style(MISS_PREFIX . 'font2');

	// User custom CSS and skin
	wp_enqueue_style(MISS_PREFIX . 'user_experience');
	wp_enqueue_style(MISS_PREFIX . 'user_custom_css');

	// Load expose slider for gallery post type
	if ( get_post_type() == "miss_gallery" ) {
		wp_register_script('gallery_expose', ''. THEME_JS .'/expose/single.gallery.js', false, null, true);
		wp_enqueue_script('gallery_expose');
	}
}

/**
 *
 */
function miss_enqueue_script() {
	global $wp_query;

	# Styles array
	$miss_styles = array(
		'prettyphoto' =>	MISS_PREFIX . '_prettyphoto',
	);
	

	# Scripts array
	$miss_script = array(
		'comments' => 'comment-reply',
		'tabs' => MISS_PREFIX . '_jquery_tools_tabs',
		'flexslider' => MISS_PREFIX . '_flexslider',
		'form' => MISS_PREFIX . '_jquery_form',
		'prettyphoto' => MISS_PREFIX . '_prettyphoto',
		'froogaloop2' => MISS_PREFIX . '_froogaloop2',
		'custom' => MISS_PREFIX . '_custom',
	);
		
	$options = get_option( MISS_SETTINGS );
	$slider_type = apply_filters( 'miss_slider_type', miss_get_setting( 'homepage_slider' ) );
	$post_obj = $wp_query->get_queried_object();


	# Front page 
	if( is_front_page() ) {
			
		# check widgets for shortcodes
		if( is_active_sidebar( 'home' ) ) {
			$widget_sc = miss_sc_widget_text();

			if( in_array( 'flexslider', $widget_sc ) )
				$flex_unset = false;

			if( in_array( 'tabs', $widget_sc ) )
				$tabs_unset = false;

			# contact form widget is active	
			if ( is_active_widget( false, false, 'contact_form', true ) )
				$contactform_unset = false;
		}
	}
	
	
	# Singular post/page
	if( is_singular() ) {
		$dependencies = get_post_meta( $post_obj->ID, '_' . THEME_SLUG .'_dependencies', true );
		
		# check post meta for scripts
		if( strpos( $dependencies, 'miss_scripts' ) === false && ( $options['blog_page'] != $post_obj->ID || empty( $options['display_full'] ) ) ) {

			if( strpos( $dependencies, 'flexslider' ) === false )
				$flex_unset = true;

			if( strpos( $dependencies, 'tabs' ) === false )
				$tabs_unset = true;

			if( strpos( $dependencies, 'contactform' ) === false )
				$contactform_unset = true;
		
		}
			
		# post comment styles set to tab
		if( apply_atomic( 'post_comment_styles', $options['post_comment_styles'] ) == 'tab' && is_single() )
			$tabs_unset = false;
			
		# popular/related post set to tab
		if( apply_atomic( 'post_like_module', $options['post_like_module'] ) == 'tab' && is_single() )
			$tabs_unset = false;

	}
	
	
	# if search, archive or 404 page
	if( is_archive() || is_search() || is_404() ) { 
		$flex_unset = true;
		$tabs_unset = true;
		$contactform_unset = true;
	}
	
	
	# check text widgets for shortcodes
	if( !is_front_page() ) {
		$widget_sc = miss_sc_widget_text();
		
	
		if( in_array( 'flexslider', $widget_sc ) )
			$flex_unset = false;
			
		if( in_array( 'tabs', $widget_sc ) )
			$tabs_unset = false;

			
		# contact form widget is active
		if ( is_active_widget( false, false, 'contact_form', true ) )
			$contactform_unset = false;
	}

	# If slider on every page option enabled
	if( apply_filters( 'miss_slider_page', miss_get_setting( 'slider_page' ) ) ) {
		if( $slider_type == 'flexslider' )
			$flex_unset = false;
		
	}

	# unset tabs/fading slider
	if( !empty( $tabs_unset ) )
		//unset( $miss_script['tabs'] );
		
	# unset flex
	if( !empty( $flex_unset ) )
		unset( $miss_script['flexslider'] );
	
		
	# unset form
	if( !empty( $contactform_unset ) )
		unset( $miss_script['form'] );
		

	# unset WP comment-reply
	if ( !is_singular() || !comments_open() || ( get_option( 'thread_comments' ) != 1 ) )
		unset( $miss_script['comments'] );
		
	# unset buddypress if not exists
	if ( !function_exists ( 'bp_is_active' ) ) {
		/* unset bp styles */
		unset( $miss_styles['bp_defaults'] );
		unset( $miss_styles['bp_admin_bar'] );
		/* unset bp scripts */
		unset( $miss_script["bp"]);
	}		
	# Styles filter	
	$enqueue_styles = apply_atomic( 'styles', $miss_styles );
	if( !empty( $enqueue_styles ) ) {
		foreach( $enqueue_styles as $style ) {
			wp_enqueue_style( $style );
		}
	}
	# Scripts filter	
	$enqueue_script = apply_atomic( 'scripts', $miss_script );


	if( !empty( $enqueue_script ) ) {
		foreach( $enqueue_script as $script ) {
			wp_enqueue_script( $script );
		}
	}
	//enqueue scripts
	$data = miss_local_assets('assets');

	if( !miss_is_template( 'templates/template-works.php' ) ) {
			$data = miss_unload_assets( $data, 'isotope' );
	}

	if (miss_get_setting('responsive') == 'disabled') {
		$data = miss_unload_assets($data, 'responsive');
	}

	if( get_post_type() == 'miss_gallery' ) {
		wp_register_script('miss_gallery', ''. THEME_JS .'/gallery/init.js', false, null, true);
		wp_register_script('qs', ''. THEME_JS .'/jquery/jquery.quicksand.js', false, null, true);
		wp_register_script('nicescroll', ''. THEME_JS .'/jquery/jquery.nicescroll.js', false, null, true);

		wp_enqueue_script('nicescroll');
		wp_enqueue_script('qs');
	}

	miss_collect_assets($data, $property = 'scripts', $action = 'enqueue');
	
}

/**
 * Add custom editor-style for WYSIWYG Editor TinyMCE
 *
 * @since 1.7
 */
if ( ! function_exists( 'miss_addestyle' ) ):
function miss_addestyle() {
	add_editor_style('assets/styles/css/editor.css');
}
endif;


/**
 * Telling DOM where is plugins
 */
function miss_print_js_plugins_path() {
	$out = '<script type="text/javascript">var pluginPath = "' . THEME_PLUGINS_URI . '";</script>';
	return $out;
}


/**
 *
 */
function miss_sc_widget_text() {
	$text_widgets = get_option( 'widget_text' );
	
	$widget_sc = array();
	if ( is_array( $text_widgets ) ) {
		foreach ( $text_widgets as $widget ) {
			
			if( !empty( $widget['text'] ) ) {


				if( strpos( $widget['text'], '[flexslider' ) !== false )
					$widget_sc['flexslider'] = 'flexslider';

				if( strpos( $widget['text'], '[tab' ) !== false )
					$widget_sc['tabs'] = 'tabs';

			}
		}
	}
	return $widget_sc;
}

?>