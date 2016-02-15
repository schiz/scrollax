<?php
/**
 * The IrishMiss admin class.
 * The theme admin functions & classes are included & initialized from this file.
 *
 * @package IrishMiss
 * @subpackage Admin
 */

class missAdmin {
	
	/**
	 * Initializes the theme admin framework by loading
	 * required files and functions for the theme options,
	 * meta boxes, skin generator, etc...
	 *
	 * @since 1.0
	 */
	public static function init() {
		self::functions();
		self::classes();
		self::actions();
		self::filters();
		self::metaboxes();
		//self::metaboxes_global();
		self::activation();
		new missSkinGenerator();
		new missIconsGenerator();
	}
	
	/**
	 * Loads the theme admin functions.
	 *
	 * @since 1.0
	 */
	public static function functions() {
		require_once( THEME_ADMIN_FUNCTIONS . '/datastore.php' );
		require_once( THEME_ADMIN_FUNCTIONS . '/core.php' );
		require_once( THEME_ADMIN_FUNCTIONS . '/scripts.php' );
		require_once( THEME_ADMIN_FUNCTIONS . '/media-upload.php');
	}
	
	/**
	 * Loads the theme admin classes.
	 *
	 * @since 1.0
	 */
	public static function classes() {
		require_once( THEME_ADMIN_CLASSES . '/option-generator.php' );
		require_once( THEME_ADMIN_CLASSES . '/metaboxes-generator.php' );
		require_once( THEME_ADMIN_CLASSES . '/shortcode-generator.php' );
		require_once( THEME_ADMIN_CLASSES . '/skin-generator.php' );
		require_once( THEME_ADMIN_CLASSES . '/plugins.php' );
		require_once( THEME_ADMIN_CLASSES . '/icons.php' );
		require_once( THEME_PLUGINS . '/dynamic/init.php' );
	}
	
	/**
	 * Adds the theme admin actions.
	 *
	 * @since 1.0
	 */
	public static function actions() {
		add_action( 'admin_init', 'miss_options_init', 1 );
		add_action( 'admin_init', 'miss_tinymce_init_size' );
		add_action( 'admin_notices', array( 'missAdmin', 'warnings' ) );
		add_action( 'admin_menu', array( 'missAdmin', 'menus' ) );
		add_action( 'admin_enqueue_scripts', 'miss_admin_enqueue_scripts' );

		add_action( 'appearance_page_miss-options', 'miss_admin_print_scripts' );
		add_action( 'appearance_page_miss-options', 'miss_admin_tinymce' );

		add_action( 'wp_ajax_miss_skin_upload', array( 'missSkinGenerator', 'skin_upload' ) );
		add_action( 'save_post', 'miss_dependencies' );
		
		if ( isset( $_GET['miss_upload_button'] ) || isset( $_POST['miss_upload_button'] ) ) {
			add_action( 'admin_init', 'miss_image_upload_option' );
		}

		// Plugins TGMPA Action
		add_action( 'tgmpa_register', 'im_register_required_plugins' );

	}
	
	/**
	 * Adds the theme admin filters.
	 *
	 * @since 1.0
	 */
	public static function filters() {
		if( isset( $_GET['page'] ) && $_GET['page'] == 'miss-options' )
			add_filter( 'tiny_mce_before_init', 'miss_tiny_mce_before_init' );
	}
	
	/**
	 * Adds the theme options menu.
	 *
	 * @since 1.0
	 */
	public static function menus() {
		add_theme_page(
			THEME_NAME,
			__( 'Theme Options', MISS_ADMIN_TEXTDOMAIN ),
			'edit_theme_options',
			'miss-options',
			array( 'missAdmin', 'options' )

		);
		add_submenu_page(
			'edit.php?post_type=pricetable',
			__('Thanks for Installing Price Table', 'pricetable'),
			__('Welcome', 'pricetable'),
			'manage_options',
			'pricetable-welcome',
			'siteorigin_pricetable_render_welcome'
		);

	}
	
	/**
	 * Creates the theme options menu.
	 *
	 * @since 1.0
	 */
	public static function options() {
		$page = include( THEME_ADMIN_OPTIONS . '/' . $_GET['page'] . '.php' );
		
		if( $page['load'] ) {
			new missOptionGenerator( $page['options'] );
		}
	}
	
	/**
	 * Adds the theme global post/page metaboxes.
	 *
	 * @since 1.5
	 */
/*	public static function metaboxes_global() {

	}
*/
	/**
	 * Adds the theme post/page metaboxes.
	 *
	 * @since 1.0
	 */
	public static function metaboxes() {
		// Loading libraries
		$defaults = include( THEME_ADMIN_META . '/meta-defaults.php' );
		$vacancy = include( THEME_ADMIN_META . '/meta-vacancy.php' );
		$portfolio = include( THEME_ADMIN_META . '/meta-portfolio.php' );
		$slideshow = include( THEME_ADMIN_META . '/meta-post-slideshow.php' );
		$service = include( THEME_ADMIN_META . '/meta-service.php' );
		$page = include( THEME_ADMIN_META . '/meta-page.php' );
		$post = include( THEME_ADMIN_META . '/meta-post.php' );
		$review = include ( THEME_ADMIN_META . '/meta-review.php');
		$pricetable = include ( THEME_ADMIN_META . '/meta-pricetable.php');
		$staff = include( THEME_ADMIN_META . '/meta-staff.php' );
		$gallery = include ( THEME_ADMIN_META . '/meta-gallery.php');
		$gallery = include ( THEME_ADMIN_META . '/meta-testimonials.php');
		//$layout = include( THEME_ADMIN_META . '/meta-layout.php' );

		//new missMetaBox( $layout['options'] );

		// Adding shortcode generator
		new missShortcodeMetaBox( $pages = ( miss_get_setting('shortcode_generator_type') ) ? miss_get_setting('shortcode_generator_type') : array( 'page', 'post', 'portfolio', 'service', 'staff' ) );
		
		// Adding meta-fields to staff
		if( $staff['load'] ) {
			new missMetaBox( $staff['options'] );
		}
		
		// Adding defaul meta-fields
		if( $defaults['load'] ) {
			new missMetaBox( $defaults['options'] );
		}

		// Adding portfolio meta-fields
		if( $portfolio['load'] ) {
			new missMetaBox( $portfolio['options'] );
		}

		// Adding vacancy meta-fields
		if( $vacancy['load'] ) {
			new missMetaBox( $vacancy['options'] );
		}

		// Adding services meta-fields
		if( $service['load'] ) {
			new missMetaBox( $service['options'] );
		}
		
		// Adding page meta-fields
		if( $page['load'] ) {
			new missMetaBox( $page['options'] );
		}
			
		// Adding post meta-fields
		if( $post['load'] ) {
			new missMetaBox( $post['options'] );
			new missMetaBox( $review['options']);
		}
			
		// Adding slideshow meta-fields
		if( $slideshow['load'] ) {
			new missMetaBox( $slideshow['options'] );
		}

		// Adding pricetable meta-fields
		if( $pricetable['load'] ) {
			new missMetaBox( $pricetable['options'] );
		}

		// Adding gallery meta-fields
		if( $gallery['load'] ) {
			new missMetaBox( $gallery['options'] );
		}

	}
	
	/**
	 * Checks & functions to run on theme activation.
	 *
	 * @since 1.0
	 */
	public static function activation() {
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

			# Check php version
			if( version_compare( PHP_VERSION, '5', '<' ) ) {
				switch_theme( 'twentyten', 'twentyten' );
				$error_msg = 'Your PHP version is too old, please upgrade to a newer version. Your version is %s, %s requires %s<br /><a href="%s">Return to theme activation &raquo</a>';
				wp_die(sprintf( __( 'Your PHP version is too old, please upgrade to a newer version. Your version is %s, %s requires %s<br /><a href="%s">Return to theme activation &raquo</a>', MISS_ADMIN_TEXTDOMAIN ), phpversion(), THEME_NAME, '5.0', admin_url( 'themes.php' ) ) );
			}
			
			# Add defualt widgets && show_on_front 'posts'
			if( get_option( MISS_SETTINGS ) == false ) {
				//miss_default_options( 'widgets' );
				//update_option( 'show_on_front', 'posts' ); 
			}
				
			# Call miss_post_types() & flush rewrite rules
			# miss_post_types();
			$wp_rewrite->flush_rules();

			# Redirect to admin panel
			wp_redirect(admin_url( "admin.php?page=miss-options&activated=true" ));
		}
	}

	/**
	 * Check current environment is supported for the theme.
	 * 
	 * @since 1.0
	 */
	public static function warnings(){
		global $wp_version;
		$errors = array();
		if( !miss_check_wp_version() )
			$errors[]='WordPress version('.$wp_version.') is too low. Please upgrade to 3.1';
		
		if( !empty( $errors ) ) {
			$str = '<ul>';
			foreach($errors as $error){
				$str .= '<li>'.$error.'</li>';
			}
			$str .= '</ul>';
			echo '<div class="error fade"><p><strong>' . sprintf( __( '%1$s Error Messages', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ) . '</strong><br />' . $str . '</p></div>';
		}
	}
	
}



?>
