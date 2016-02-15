<?php
if ( !function_exists( 'miss_widgets' ) ) :
/**
 *
 */
function miss_widgets() {
	# Load each widget file.
	require_once( THEME_WIDGETS . '/widget-ad.php' );
	require_once( THEME_WIDGETS . '/widget-footer-logo.php' );
	require_once( THEME_WIDGETS . '/widget-sociable.php' );
	require_once( THEME_WIDGETS . '/widget-feedburner.php' );
	require_once( THEME_WIDGETS . '/widget-flickr.php' );
	require_once( THEME_WIDGETS . '/widget-facebook-like.php' );
	require_once( THEME_WIDGETS . '/widget-subnav.php' );
	require_once( THEME_WIDGETS . '/widget-map.php' );
	require_once( THEME_WIDGETS . '/widget-twitter.php' );
	require_once( THEME_WIDGETS . '/widget-video.php' );
	require_once( THEME_WIDGETS . '/widget-popular.php' );
	require_once( THEME_WIDGETS . '/widget-recent.php' );
	require_once( THEME_WIDGETS . '/widget-currency-rates-graph.php' );
	require_once( THEME_WIDGETS . '/widget-contact.php' );
	require_once( THEME_WIDGETS . '/widget-contacts.php' );
	require_once( THEME_WIDGETS . '/widget-workhours.php' );
	require_once( THEME_WIDGETS . '/widget-contact-form.php' );
	require_once( THEME_WIDGETS . '/social-counter-widget.php');
	require_once( THEME_WIDGETS . '/extended-tagcloud.php'); 
	require_once( THEME_WIDGETS . '/widget-hot-updates.php'); 
	require_once( THEME_WIDGETS . '/widget-in-focus.php'); 
	require_once( THEME_WIDGETS . '/widget-recent-news.php'); 
	require_once( THEME_WIDGETS . '/widget-text.php'); 
	require_once( THEME_WIDGETS . '/widget-igrid.php'); 
	require_once( THEME_WIDGETS . '/widget-testimonials.php'); 
	require_once( THEME_WIDGETS . '/widget-accordion.php'); 

	# Register each widget.
	register_widget( 'IrishMissW_Ad_Widget' );
	register_widget( 'IrishMissW_Footer_Logo_Widget' );
	register_widget( 'IrishMissW_Social_Icons_Widget' );
	register_widget( 'IrishMissW_Flickr_Widget' );
	register_widget( 'Facebook_Like_Widget' );
	register_widget( 'IrishMissW_SubNav_Widget' );
	register_widget( 'IrishMissW_Gmap_Widget' );
	register_widget( 'IrishMissW_Twitter_Widget' );
	register_widget( 'IrishMissW_Embedded_Video_Widget' );
	register_widget( 'IrishMissW_PopularPost_Widget' );
	register_widget( 'IrishMissW_RecentPost_Widget' );
	register_widget( 'IrishMissW_CurrencyRatesGraph_Widget' );
	register_widget( 'IrishMissW_Feedburner_Link_Widget' );
	register_widget( 'IrishMissW_Contact_Widget' );
	register_widget( 'IrishMissW_Contacts_Widget' );
	register_widget( 'IrishMissW_Contact_Form_Widget' );
	register_widget( 'IrishMissW_WorkHours_Widget' );
	register_widget( 'IrishMissW_SC_widget' );
	register_widget( 'IrishMissW_HotUpdates_Widget' );
	register_widget( 'IrishMissW_InFocus_Widget' );
	register_widget( 'IrishMissW_RecentNews_Widget' );
	register_widget( 'IrishMissW_Text' );
	register_widget( 'IrishMissW_Igrid_Widget' );
	register_widget( 'IrishMissW_Testimonials_Widget' );
	register_widget( 'IrishMissW_Accordion_Widget' );
}
endif;
?>