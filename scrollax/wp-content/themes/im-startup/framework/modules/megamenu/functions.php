<?php
	/**
	 * irishmenu
	 */
class irishMegaMenu {
	private $settings;

	private $pluginURL;

	private $tour;

	private $stylePresets;
	
	private $menuItemOptions;

	private $optionDefaults;

	function __construct(){
		if( is_admin() ){
			add_action( 'admin_menu' , array( $this , 'init' ) );
		}
		$constant = $this->constant();
		$this->settings = $this->optionsMenu();
	}

	/*
	 * Add the Activate Mega Menu Locations Meta Box to the Appearance > Menus Control Panel
	 */
	function constant() {
		define( "MISS_MEGAMENU_STORE", "miss_megamenu");
		define('IRISHMISS_VERSION', 	'1.0.0' );
		define('IRISHMISS_NAV_LOCS', 	'wp-mega-menu-nav-loc');
		define('IRISHMISS_SETTINGS', 	'wp-mega-menu-settings' );
		define('IRISHMISS_STYLES', 		'wp-mega-menu-styles');
		define('IRISHMISS_PLUGIN_URL', 	plugins_url().'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));	//WP_PLUGIN_URL
		define('IRISHMISS_TT', 			IRISHMISS_PLUGIN_URL.'timthumb/tt.php');
		define('IRISHMISS_ADMIN_PATH', 	trim( plugins_url().'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)), '/'));
		define('IRISHMISS_LESS',			dirname(__FILE__).'/stylegenerator/skin.less' );
		define('IRISHMISS_GEN_SKIN',		dirname(__FILE__).'/stylegenerator/skin.css' );
	}

	function init() {
		//add_action( 'admin_head', array( $this , 'addMetabox' ) );
	}

	function addMetabox(){
		if ( wp_get_nav_menus() ) {
			add_meta_box( 'nav-menu-theme-megamenus', __( 'Assign Mega Menu', MISS_ADMIN_TEXTDOMAIN ), array( $this , 'metaboxRaw' ) , 'nav-menus', 'side', 'high' );
		}
	}
	
	/*
	 * Generates the Activate Mega Menu Locations Meta Box
	 */
	function metaboxRaw(){
	
		/* This is just in case JS is not working.  It'll only save the last checked box */
		if( isset( $_POST['megaMenu-locations'] ) && $_POST['megaMenu-locations'] == 'Save'){
			$data = $_POST['wp-mega-menu-nav-loc'];
			$data = explode(',', $data);		
			update_option( MISS_MEGAMENU_STORE, $data );
			echo 'Saved Changes';
		}
		
		$active = get_option( MISS_MEGAMENU_STORE, array());
		
		echo '<div class="megaMenu-metaBox">';	
		echo '<p class="howto">' . __( 'Select the Menu Locations for Mega Menu. Menu must be activated for any Mega Menu Options to affect that Menu Location.', MISS_ADMIN_TEXTDOMAIN ) . '</p>';
		
		echo '<form>';
		
		$locs = get_registered_nav_menus();
		
		foreach($locs as $slug => $desc){		
			echo '<div>' . 
			'<input class="menu-item-checkbox" type="checkbox" value="'.$slug.'" id="megaMenuThemeLoc-'.$slug.'" name="wp-mega-menu-nav-loc" '.
			checked( in_array( $slug, $active ), true, false).'/>' .
			'<label class="menu-item-title" for="megaMenuThemeLoc-'.$slug.'">'.$desc.'</label>'.
			'</div>';
		}
		
		echo '<p class="button-controls">'.
				'<img class="waiting" src="'.esc_url( admin_url( 'images/wpspin_light.gif' ) ).'" alt="" style="display:none;"/>'.
				'<input id="wp-mega-menu-navlocs-submit" type="submit" class="button-primary" name="megaMenu-locations" value="Save" />'.
				'</p>';
		
		echo '</form>';
		
		/*
		if( !$this->settings->op( 'wpmega-strict' ) ){
			echo '<p class="howto">If more than 1 menu is being megafied in your theme, turn on Strict Mode in Appearance > IrishMiss > '.
					'Theme Integration.</p>';
		}
		*/

		echo '<p>' . __( 'Note you can ONLY have 1 IrishMiss menu per page.', MISS_ADMIN_TEXTDOMAIN ) . '</p>';

		echo '</div>';
	}
	function optionsMenu(){

	}
}





?>