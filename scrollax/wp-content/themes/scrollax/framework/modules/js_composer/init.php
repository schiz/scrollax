<?php
/**
 * Visual Composer Widgets
 *
 * @package startup
 */
define( 'IRISHFRAMEWORK_JS_COMPOSER_PATH', THEME_MODULES . '/' . 'js_composer' );
define( 'IRISHFRAMEWORK_JS_COMPOSER_URI',  THEME_MODULES_URI . '/' . 'js_composer' );

if ( is_admin() ) {
	wp_enqueue_script( MISS_PREFIX . '-jsc-global', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/global.js', array('wpb_js_composer_js_custom_views'), THEME_VERSION, true );
    // wp_enqueue_script( MISS_PREFIX . '-jsc-icons', IRISHFRAMEWORK_JS_COMPOSER_URI .'/js/icons.js', array('jquery'), THEME_VERSION, true );
}

//require_once( "classes.php" );
require_once( "params.php" );
require_once( "functions.php" );
require_once( "actions.php" );
