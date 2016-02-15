<?php
/**
 * Plugin Name: Shortcode Igniter
 * Version: 1.0.2
 * Author: Shortcode Igniter
 */
	//Plugin Path
	global $ShortcodeIgniterPath;
	$ShortcodeIgniterPath = dirname(__FILE__) . '/'; //THEME_PLUGINS_URI.'/shortcodes/shortcodeigniter/';
	//init hook
	add_action('init', 'igniterShortIncludeJs');
	
	//our include js function
	function igniterShortIncludeJs() {
		global $ShortcodeIgniterPath;
		if(!is_admin()) {
			
			//shortcodes.js
			wp_register_script('igniter_shortcodes', plugins_url('/shortcodeigniter/js/shortcodes.js', dirname(__FILE__) ) );
			//Enqueue our script
			wp_enqueue_script('jquery');
			wp_enqueue_script('igniter_shortcodes');
		}
		
	}

    /**
     * Register 'wp_print_styles' hooks
     */
    add_action('wp_print_styles', 'addshortcode_igniter_stylesheet');

    /*
     * Enqueue styles
     */
    function addshortcode_igniter_stylesheet() {
        $shortcodeIgniterStyleUrl =  plugins_url( '/css/shortcodes.css', dirname(__FILE__) );
        $shortcodeIgniterStyleFile = plugins_url( '/css/shortcodes.css', dirname(__FILE__) );
        if ( file_exists($shortcodeIgniterStyleFile) ) {
            wp_register_style('shortcodeIgniterStyleSheets', $shortcodeIgniterStyleUrl);
            wp_enqueue_style( 'shortcodeIgniterStyleSheets');
        }
    }
	
	//Let's now include our JS stuff
	add_action('wp_head', 'igniterShortIncludeJsActivators');
	//let's include the necessary code
	function igniterShortIncludeJsActivators() {
		$output = "
		<script type=\"text/javascript\">
			jQuery(document).ready(function() {
				jQuery('.ignitertooltip').each(function() {
					jQuery(this).IgniterTooltip();
				});
				jQuery('.igniter-notification').each(function() {
					jQuery(this).closeNotification();
				});
				jQuery('.igniterimage-slider').each(function() {
					jQuery(this).igniterImageSlider();
				});
				jQuery('.ignitertoggle-open, .ignitertoggle-closed').each(function() {
					jQuery(this).igniterToggle();
				});
				jQuery('.ignitertabbed').each(function() {
					jQuery(this).igniterTabbed();
				});
			});
		</script>";
		echo $output;
	}
	
	//ALLOW SHORTCODES IN WIDGETS
	add_filter('widget_text', 'do_shortcode');
	
	/*
	Plugin Name: Shortcode Empty Paragraph Fix
	Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
	Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
	Author URI: http://www.johannheyne.de
	Version: 0.1
	*/

	add_filter('the_content', 'shortcode_empty_paragraph_fix');
	function shortcode_empty_paragraph_fix($content) {
		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']'
		);

		$content = strtr($content, $array);

		return $content;
	}

    require('helpers_alpha.php');
    require_once('shortcodes_lib.php');
    // MCE BUTTON CLASS
    include('includes/tinyMCE-button_class.php');

    // CLEAR
    include('includes/miss_clear/functions.php');

    // Layout Builder User Interface
    include('includes/miss_layout_builder/functions.php');
	//let's trick tinymce into thnking its a new version to clean up the cache
	function my_refresh_mce($ver) {
	  $ver += 3;
	  return $ver;
	}
	//tinyMCE hooks
	add_filter( 'tiny_mce_version', 'my_refresh_mce');
	// Includes Shortcode Ninja Admin Page
	// include 'admin/shortcodeigniter-admin.php';
?>
