<?php
/**
 * Deny hack attempt
 */
if ( !defined( 'ABSPATH' ) ) {
	header('HTTP/1.1 403 Forbidden');
	exit;
}

$css = '';

/**
 * Google Web Fonts Integration
 */
$gwf = miss_get_gwf();
if ( is_array( $gwf ) && count( $gwf ) > 0 ) {
  $gwf_query = '';
  foreach( $gwf as $font ) {
    $font = stripcslashes($font);
    $gwf_query .= str_replace( array(" ",'"','\''), array("+","",""), $font ) . "|";
  }
  $gwf_query = substr( $gwf_query , 0, -1 );
  $css .= "/* Begin Google Web Fonts */\n";
  $css .= '@import url(http://fonts.googleapis.com/css?family=' . $gwf_query . ');';
  $css .= "\n/* End Google Web Fonts */\n\n";
}

$header_height = miss_get_setting("header_height");
$menu_height = miss_get_setting("menu_height");
$css .= "/* Begin Theme Settings */\n";
$css .= '.site_info > .container > .row-fluid > * 
{
  height: ' . $header_height . 'px;
  line-height: ' . $header_height . 'px;
}

.navbar .btn-navbar 
{
  margin-top: ' . floor( str_replace('px', '', $menu_height) / 2 ) . 'px
}

header 
{
  height: ' . $menu_height . 'px;
  min-height: ' . $menu_height . 'px;
}

.navbar .nav > li > a,
.nav .nav-search-box
{
  height: ' . $menu_height . 'px;
  line-height: ' . $menu_height . 'px;
}

.navbar .nav > li > a.with_teaser > .half
{
  height: ' . floor( str_replace('px', '', $menu_height) / 2 ) . 'px;
}

header .navbar .nav > li > a > i 
{
  font-size: ' . floor( str_replace('px', '', miss_get_css('main_menu_font_size') ) * 1.35 ) . 'px;
  line-height: ' . $menu_height . 'px;
  height: ' . $menu_height . 'px;
}

.navbar .nav > li > a.with_teaser > i,
.navbar .nav > li > a.menu_item_without_text > i
{
  font-size: ' . floor( str_replace('px', '', miss_get_css('main_menu_font_size') ) * 0.75 + str_replace('px', '', miss_get_css('main_menu_font_size') ) ) . 'px;
}

.navbar .nav > li > a.with_teaser > .half > span
{
  padding-top: ' . floor( str_replace('px', '', $menu_height) / 2 - str_replace('px', '', miss_get_css('main_menu_font_size') ) - 2 ) . 'px;
}

.navbar .nav > li > a.with_teaser > .teaser
{
  font-size: ' . floor( str_replace('px', '', miss_get_css('main_menu_font_size') ) * 0.75 ) . 'px;
}

header .navbar .nav .nav-search-box .search-form
{
  top: 0; /*-' . floor( str_replace('px', '', $menu_height) / 2 - str_replace('px', '', miss_get_css('main_menu_font_size') ) - 2 ) . 'px; */
}
';
$css .= "\n/* End Theme Settings */\n\n";

/**
 * Get theme Custom CSS from database
 */
if( miss_get_setting( 'custom_css' ) ) {
  $css .= "/* Begin Custom CSS */\n";
  $css .= stripslashes( miss_get_setting( 'custom_css' ) ) . "\n";
  $css .= "\n/* End Custom CSS */\n\n";
}
echo $css;
?>