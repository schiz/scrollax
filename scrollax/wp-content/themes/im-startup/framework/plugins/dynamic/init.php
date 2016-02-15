<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage	   MISS FRAMEWORK
 * @version	   2.3.6
 * @modified	   irishmiss
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright	   Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link	   https://github.com/thomasgriffin/TGM-Plugin-Activation
 * @link	   http://irishmiss.com/
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

//add_action( 'tgmpa_register', 'im_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function im_register_required_plugins() {
        $plugins = array(

          // array(
          //       'name'                                  => 'Breadcrumbs Eight', // The plugin name
          //       'slug'                                  => 'breadcrumbs-eight', // The plugin slug (typically the folder name)
          //       'source'                                => THEME_PLUGINS . '/dynamic/store/breadcrumbs-eight.zip',
          //       'required'                              => true, // If false, the plugin is only 'recommended' instead of required
          //       'version'                               => '0.3',
          //       'force_activation'                      => true,
          //       'force_deactivation'                    => true,
          //       'external_url'                          => '',
          // ),

          array(
                'name'                                  => 'Visual Shortcodes', // The plugin name
                'slug'                                  => 'visual-shortcodes', // The plugin slug (typically the folder name)
                'source'                                => THEME_PLUGINS . '/dynamic/store/visual-shortcodes.zip',
                'required'                              => true, // If false, the plugin is only 'recommended' instead of required
                'version'                               => '0.1',
                'force_activation'                      => true,
                'force_deactivation'                    => true,
                'external_url'                          => '',
          ),

          array(
                'name'                                  => 'Shortcode Igniter', // The plugin name
                'slug'                                  => 'shortcodeigniter', // The plugin slug (typically the folder name)
                'source'                                => THEME_PLUGINS . '/dynamic/store/shortcodeigniter.zip',
                'required'                              => true, // If false, the plugin is only 'recommended' instead of required
                'version'                               => '0.1',
                'force_activation'                      => true,
                'force_deactivation'                    => true,
                'external_url'                          => '',
          ),
        );

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = MISS_ADMIN_TEXTDOMAIN;

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
			'domain'					=> $theme_text_domain,	 	// Text domain - likely want to be the same as your theme.
			'default_path'					=> '',				// Default absolute path to pre-packaged plugins
			'parent_menu_slug'				=> 'themes.php',		// Default parent menu slug
			'parent_url_slug'				=> 'themes.php',		// Default parent URL slug
			'menu'						=> 'install-required-plugins',	// Menu slug
			'has_notices'					=> true,			// Show admin notices or not
			'is_automatic'					=> false,			// Automatically activate plugins after installation or not
			'message'					=> '',				// Message to output right before the plugins table
			'strings'					=> array(
			'page_title'					=> __( 'Install Required Plugins', MISS_ADMIN_TEXTDOMAIN ),
			'menu_title'					=> __( 'Install Plugins', MISS_ADMIN_TEXTDOMAIN ),
			'installing'					=> __( 'Installing Plugin: %s', MISS_ADMIN_TEXTDOMAIN ), // %1$s = plugin name
			'oops'						=> __( 'Something went wrong with the plugin API.', MISS_ADMIN_TEXTDOMAIN ),
			'notice_can_install_required'			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'		=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'				=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'		=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate'			=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update'				=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update'				=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link'					=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'					=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'					=> __( 'Return to Required Plugins Installer', MISS_ADMIN_TEXTDOMAIN ),
			'plugin_activated'				=> __( 'Plugin activated successfully.', MISS_ADMIN_TEXTDOMAIN ),
			'complete'					=> __( 'All plugins installed and activated successfully. %s', MISS_ADMIN_TEXTDOMAIN ), // %1$s = dashboard link
			'nag_type'					=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);
	tgmpa( $plugins, $config );
}