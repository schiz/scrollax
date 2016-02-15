<?php
/**
 * The IrishMiss framework. Defines the necessary constants 
 * and includes the necessary files for theme's operation.
 *
 * @package IrishMiss
 * @subpackage businessmaked
 */

/**
 * Deny hack attempt
 */
if ( !defined( 'ABSPATH' ) ) {
	header('HTTP/1.1 403 Forbidden');
	exit;
}



class IrishMiss {
	function __construct() {
	}
	public static function init( $options ) {
		self::constants( $options );
		self::functions();
		self::plugins();
		self::classes();
		self::buddypress();
		self::variables();
		self::actions();
		self::filters();
		self::supports();
		self::locale();
		self::admin();
		self::themecheck();
	}
	/**
	 * Define theme constants.
	 *
	 * @since 1.0
	 */
	public static function constants( $options ) {
		$_wp_upload_dir = wp_upload_dir();
		define( 'THEME_NAME', $options['theme_name'] );
		define( 'THEME_SLUG', get_template() );
		define( 'THEME_ELLIPSIS', '...' );
		define( 'THEME_VERSION', $options['theme_version'] );
		
		define( 'BP_DTHEME_DISABLE_CUSTOM_HEADER', true );
		define( 'BP_DISABLE_ADMIN_BAR', true );

		define( 'FRAMEWORK_VERSION', '1.8' );
		define( 'FRAMEWORK_DIRECTORY', 'framework' );
		define( 'DOCUMENTATION_URL', 'http://cdn.irishmiss.com/d/startup/' );
		define( 'SUPPORT_URL', 'http://helpdesk.irishmiss.com' );
		
		define( 'MISS_PREFIX', 'miss' );
		define( 'MISS_TEXTDOMAIN', THEME_SLUG );
		define( 'MISS_ADMIN_TEXTDOMAIN', THEME_SLUG . '_admin' );
		define( 'MISS_SETTINGS', 'miss_' . THEME_SLUG . '_options' );
		define( 'MISS_INTERNAL_SETTINGS', 'miss_' . THEME_SLUG . '_internal_options' );
		define( 'MISS_SIDEBARS', 'miss_' . THEME_SLUG . '_sidebars' );
		define( 'MISS_SKINS', 'miss_' . THEME_SLUG . '_skins' );
		define( 'MISS_ACTIVE_SKIN', 'miss_' . THEME_SLUG . '_active_skin' );
		define( 'MISS_SKIN_NT_WRITABLE', 'miss_' . THEME_SLUG . '_skins_nt_writable' );
		define( 'MISS_SCW_CACHE', 'miss_' . THEME_SLUG . '_scw_cache' );
		define( 'MISS_SCW_TIME', 'miss_' . THEME_SLUG . '_scw_time' );
		define( 'MISS_URL_TW_REPLY', 'http://twitter.com/%27+reply.substring%281%29+%27' );
		define( 'MISS_URL_GAVATAR', 'http://gravatar.com' );
		define( 'MISS_URL_IDGETTR', 'http://idgettr.com/' );
		define( 'MISS_URL_SITE', 'http://irishmiss.com' );
		define( 'MISS_KIT', '-misskit-' );

		define( 'MISS_REWRITE_BLOG', 'blog' );
		define( 'MISS_REWRITE_GALLERY', 'gallery' );
		define( 'MISS_REWRITE_NEWS', 'news' );
		define( 'MISS_REWRITE_PORTFOLIO', 'portfolio' );
		define( 'MISS_REWRITE_TESTIMONIALS', 'testimonials' );
		define( 'MISS_REWRITE_VACANCIES', 'vacancy' );

		define( 'THEME_URI', get_template_directory_uri() );
		define( 'THEME_DIR', get_template_directory() );
		define( 'THEME_ASSETS_DIR', THEME_DIR . '/assets' );
		define( 'THEME_ASSETS', THEME_URI . '/assets' );
		define( 'THEME_JS', THEME_ASSETS . '/scripts/static' );
		define( 'THEME_LIBRARY', THEME_DIR . '/framework' );
		define( 'THEME_LIBRARY_URI', THEME_URI . '/framework' );
		define( 'THEME_ADMIN', THEME_LIBRARY . '/admin' );
		define( 'THEME_FUNCTIONS', THEME_LIBRARY . '/functions' );
		define( 'THEME_CLASSES', THEME_LIBRARY . '/classes' );
		define( 'THEME_WIDGETS', THEME_LIBRARY . '/widgets' );
		define( 'THEME_AUTOBOOT', THEME_LIBRARY . '/boot' );
		define( 'THEME_PLUGINS_URI', THEME_LIBRARY_URI . '/plugins' );
		define( 'THEME_PLUGINS', THEME_LIBRARY . '/plugins' );
		define( 'THEME_SHORTCODES', THEME_LIBRARY . '/shortcodes' );

		/* Caching */
		if ( !$_wp_upload_dir['error'] && !file_exists( $_wp_upload_dir['basedir'] . '/cache') ) {
			if ( @mkdir( $_wp_upload_dir['basedir'] . '/cache') ) {
				@touch( $_wp_upload_dir['basedir'] . '/cache/index.html');
			}
		}
		if ( $_wp_upload_dir['error'] || !file_exists( $_wp_upload_dir['basedir'] . '/cache') ) {
			define( 'THEME_CACHE', THEME_DIR . '/cache' );
			define( 'THEME_CACHE_URI', THEME_URI . '/cache' );
		} else {
			define( 'THEME_CACHE', $_wp_upload_dir['basedir'] . '/cache' );
			define( 'THEME_CACHE_URI', $_wp_upload_dir['baseurl'] . '/cache' );
		}

		/* Skin Caching */
		define( 'THEME_SKIN_CACHE', THEME_CACHE . '/skin.min.css' );
		define( 'THEME_SKIN_CACHE_URI', THEME_CACHE_URI . '/skin.min.css' );
		define( 'THEME_ENABLE_SKIN_CACHE', true );
		define( 'THEME_ENABLE_SKIN_DB', true );

		/* Assets & Styles */
		define( 'DEFAULT_SKIN', 'light.aqua' );

		define( 'THEME_STYLES_DIR', THEME_ASSETS_DIR . '/styles' );
		define( 'THEME_PATTERNS_DIR', THEME_STYLES_DIR . '/_patterns' );
		define( 'THEME_SPRITES_DIR', THEME_STYLES_DIR . '/_sprites' );
		define( 'THEME_IMAGES_DIR', THEME_ASSETS_DIR . '/images' );
		define( 'THEME_PATTERNS', '_patterns' );
		define( 'THEME_IMAGES', THEME_ASSETS . '/images' );
		define( 'THEME_IMAGES_ASSETS', THEME_IMAGES . '' );
		define( 'THEME_JS_INIT', THEME_URI . '/framework/scripts' );
		define( 'THEME_STYLES', THEME_ASSETS . '/styles' );
		define( 'THEME_SPRITES', THEME_ASSETS . '/_sprites' );

		/* Modules */
		define( 'THEME_MODULES_URI', THEME_LIBRARY_URI . '/modules' );
		define( 'THEME_MODULES', THEME_LIBRARY . '/modules' );
		define( 'THEME_SKINS', THEME_MODULES . '/css/models' );

		define( 'THEME_CSS_PREFIX', '_miss_css-' );
		define( 'THEME_CSS_MODEL', THEME_MODULES . '/css/models' );
		define( 'THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions' );
		define( 'THEME_ADMIN_CLASSES', THEME_ADMIN . '/classes');
		define( 'THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options');
		define( 'THEME_ADMIN_META', THEME_ADMIN . '/meta');
		define( 'THEME_ADMIN_ASSETS_URI', THEME_URI . '/framework/admin/assets' );
		define( 'RWMB_URL', THEME_LIBRARY_URI . '/functions/meta-box' );
		define( 'RWMB_DIR', THEME_LIBRARY . '/functions/meta-box' );

	}

	/**
	 * Registering theme images.
	 *
	 * @since 1.1
	 */
	public static function images() {
	}

	/**
	 * Loads theme functions.
	 *
	 * @since 1.0
	 */
	public static function functions() {
		require_once( THEME_FUNCTIONS . '/scripts.php' );
		require_once( THEME_FUNCTIONS . '/image.php' );
		require_once( THEME_FUNCTIONS . '/image_cache.php' );
		require_once( THEME_FUNCTIONS . '/hooks-actions.php' );
		require_once( THEME_FUNCTIONS . '/context.php' );
		require_once( THEME_FUNCTIONS . '/core.php' );
		require_once( THEME_FUNCTIONS . '/atomic.php' );
		require_once( THEME_FUNCTIONS . '/theme.php' );
		require_once( THEME_FUNCTIONS . '/widgets.php' );
		require_once( THEME_FUNCTIONS . '/sidebars.php' );
		require_once( THEME_FUNCTIONS . '/sliders.php' );
		require_once( THEME_FUNCTIONS . '/twitter.php' );
		require_once( THEME_FUNCTIONS . '/bookmarks.php' );
		require_once( THEME_FUNCTIONS . '/hooks-actions.php' );
		require_once( THEME_FUNCTIONS . '/feedreader.php' );
		require_once( THEME_FUNCTIONS . '/buddypress.php' );
		require_once( THEME_FUNCTIONS . '/isotope.php' );
		require_once( THEME_FUNCTIONS . '/breadcrumbs.php' );
	}
	/**
	 * Loads theme plugins.
	 *
	 * @since 1.0
	 */
	public static function plugins() {
		// Place custom plugins here
	}


	/**
	 * Loads theme classes.
	 *
	 * @since 1.0
	 */
	public static function classes() {
		require_once( THEME_CLASSES . '/layout.php' );
		require_once( THEME_CLASSES . '/contact.php' );
		require_once( THEME_CLASSES . '/menu-walker.php' );
		require_once( THEME_CLASSES . '/isotope.php' );
		require_once( THEME_CLASSES . '/twitter_timeline.php' );
	}

	/**
	 * Loads theme actions.
	 *
	 * @since 1.0
	 */
	public static function actions() {
		global $irish_framework_params;

		// Default Actions
		add_action( 'init', 'miss_load_modules' );
		add_action( 'init', 'miss_shortcodes_init' );
		add_action( 'init', 'miss_menus' );
		add_action( 'init', 'miss_register_script' );
		add_action( 'init', 'miss_register_style' );
		add_action( 'template_redirect', 'miss_enqueue_script' );
		add_action( 'template_redirect', 'miss_enqueue_style' );
		add_action( 'init', array( 'missForm', 'init'), 11 );
		add_action( 'widgets_init', 'miss_sidebars' );
		add_action( 'widgets_init', 'miss_widgets' );
		add_action( 'wp_head', 'miss_analytics' );
		add_action( 'get_header', 'miss_custom_post_layout' );
		add_action( 'comment_form_defaults', 'miss_comment_form_args' );

		if( is_admin() ) {
			// Custom Login Logo 
			add_action( 'login_head', 'miss_custom_login_logo' );
		}

		add_action( 'admin_bar_menu', 'miss_options_toolbar', 999);
		add_action( 'miss_head', 'miss_header_scripts' );
		add_action( 'miss_header', 'miss_add_header' );
		add_action( 'miss_after_header', 'miss_add_after_header' );
		add_action( 'miss_before_page_content', 'miss_home_content' );
		add_action( 'miss_before_page_content', 'miss_page_content' );
		add_action( 'miss_before_page_content', 'miss_query_posts' );
		add_action( 'miss_after_post', 'miss_page_navi' );
		add_action( 'miss_post_image_begin', 'miss_post_img_shadow_before' );
		add_action( 'miss_post_image_end', 'miss_post_img_shadow_after' );
		add_action( 'miss_portfolio_image_begin', 'miss_post_img_shadow_before');
		add_action( 'miss_portfolio_image_end', 'miss_post_img_shadow_after' );
		add_action( 'miss_before_portfolio_image', 'miss_post_img_shadow_before' );
		add_action( 'miss_after_portfolio_image', 'miss_post_img_shadow_after' );
		add_action( 'miss_singular-post_after_entry', 'miss_post_nav' );
		add_action( 'miss_singular-post_after_entry', 'miss_post_meta_bottom' );
		add_action( 'miss_singular-post_after_post', 'miss_about_author' );
		add_action( 'miss_singular-post_after_post', 'miss_post_sociables' );
		add_action( 'miss_singular-post_after_post', 'miss_like_module' );
		add_action( 'miss_singular-post_after_post', 'comments_template', 10, array( '', true ) );

		/* woocomerce actions */
		add_action( 'woocommerce_after_shop_loop', 'miss_page_navi' );

		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10  );
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20  );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10  );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30  );
		// disable meta
		if ( miss_get_setting( 'store_enable_categories' ) == true ) {
		} else {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40  );
		}

		add_action( 'woocommerce_before_single_product_summary', 'miss_woocommerce_before_single_product_summary', 1 );
		add_action( 'miss_woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		add_action( 'miss_woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		add_action( 'woocommerce_single_product_summary', 'miss_woocommerce_price_and_cart_holder', 25 );
		//add_action( 'miss_woocommerce_price_and_cart_holder', 'woocommerce_template_single_price', 10 );
		add_action( 'miss_woocommerce_price_and_cart_holder', 'woocommerce_template_single_add_to_cart', 20 );
		add_action( 'woocommerce_after_single_product_summary', 'miss_woocommerce_after_single_product_summary', 1 );

		// Working with sidebars
		if (isset($_layout) && $_layout == "left_sidebar") {
			add_action( 'miss_before_main', 'miss_get_sidebar' );
		} else {
			add_action( 'miss_after_main', 'miss_get_sidebar' );
		}
		add_action( 'miss_footer', 'miss_main_footer' );
		add_action( 'miss_after_footer', 'miss_sub_footer' );
	}
	/**
	 * Loads theme filters.
	 *
	 * @since 1.0
	 */
	public static function filters() { 
		// Irish Filters
		add_filter( 'miss_read_more', 'miss_read_more' );
		add_filter( 'miss_read_more_link', 'miss_read_more_link' );
		add_filter( 'miss_blog_sc_meta', array( &$this, 'post_meta' ) );
		add_filter( 'miss_widget_meta', 'miss_widget_meta' );

		// WordPress Filters
		add_filter( 'the_content', 'miss_texturize_shortcode_before' );
		add_filter( 'excerpt_length', 'miss_excerpt_length_long', 999 );
		add_filter( 'excerpt_more', 'miss_excerpt_more' );
		add_filter( 'posts_where', 'miss_multi_tax_terms' );
		add_filter( 'pre_get_posts', 'miss_exclude_category_feed' );
		add_filter( 'widget_categories_args', 'miss_exclude_category_widget' );
		add_filter( 'query_vars', 'miss_queryvars' );
		add_filter( 'rewrite_rules_array', 'miss_rewrite_rules',10,2 );
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'wp_page_menu_args', 'miss_page_menu_args' );
		add_filter( 'the_password_form', 'miss_password_form' );
		//add_filter( 'wp_nav_menu_items', 'miss_nav_search_box', 10, 2);

		// Irish SEO Filters
		add_filter( 'style_loader_src', 'miss_remove_script_version', 15, 1 );
		add_filter( 'script_loader_src', 'miss_remove_script_version', 15, 1 );
	}
	
	/**
	 * Loads theme supports.
	 *
	 * @since 1.0
	 */
	public static function supports() {
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );

		/* Add theme support for buddypress plugins */
		add_theme_support( 'bbpress' );
		add_theme_support( 'buddypress' );
		add_theme_support( 'woocommerce' );

		if ( ! isset( $content_width ) ) $content_width = 720;
	}

	/**
	 * Handles the locale functions file and translations.
	 *
	 * @since 1.0
	 */
	public static function locale() {
		// Get the user's locale.
		$locale = get_locale();
		
		if( is_admin() ) {
			// Load admin theme textdomain.
			load_theme_textdomain( MISS_ADMIN_TEXTDOMAIN, THEME_ADMIN . '/languages' );
			$locale_file = THEME_ADMIN . "/languages/$locale.php";
			
		} else {
			// Load theme textdomain.
			load_theme_textdomain( MISS_TEXTDOMAIN, THEME_DIR . '/languages' );
			$locale_file = THEME_DIR . "/languages/$locale.php";
		}
		
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
	}

	
	/**
	 * Loads admin files.
	 *
	 * @since 1.0
	 */

	private static function admin() {

		if( !is_admin() ) return;
		require_once( THEME_ADMIN . '/admin.php' );
		missAdmin::init();
	}
	public static function themecheck() {
	  /* Adding */

	  /* Removing */

	}


	/**
	 * BuddyPress Support
	 *
	 * @since 1.3
	 */

	public static function buddypress() {
		if ( function_exists( 'bp_is_page' ) && bp_current_component() ) {
		}
		if ( miss_is_bp() ) {
			add_filter( 'wp_enqueue_scripts', 'miss_enqueue_script' );
			add_filter( 'wp_enqueue_scripts', 'miss_enqueue_style' );

			/* bp custom forum search */
			function miss_bp_directory_forums_search_form () {
				if ( isset($_GET) && isset( $_GET['s'] ) ) {
					$search = 'value="To search type and hit enter"';
				} else {
					$search = 'value="To search type and hit enter"';
					$search .= ' onfocus="if(this.value==\'To search type and hit enter\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'To search type and hit enter\';"';
				}
				$out = '<div id="search-forum">
				<form id="forum-searchform" method="get" action="">
				      <input type="text" name="s" id="forum-s" '.$search.'>
				      <input type="submit" value="Search" id="forums_search_submit">
				</form></div>';
				return $out;
			}

			/* bp custom forum search */
			function miss_bp_directory_groups_search_form () {
				if ($_GET['s']) {
					$search = 'value="To search type and hit enter"';
				} else {
					$search = 'value="To search type and hit enter"';
					$search .= ' onfocus="if(this.value==\'To search type and hit enter\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'To search type and hit enter\';"';
				}
				$out = '<div id="search-forum"><form action="" method="post" id="groups-directory-form" class="dir-form"><div id="group-dir-search" class="dir-search"><label><input type="text" name="s" id="groups_search" value="'.$_GET['s'].'" placeholder="' . __( 'Type and hit enter...', MISS_TEXTDOMAIN ) . '"></label></div></form></div>';
				return $out;
			}
			
		}

	}   


   /**
    * Define theme variables.
    *
    * @since 1.0
    */

   public static function variables() {
		global $irish_framework_params;

		# Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
		@ini_set('pcre.backtrack_limit', 9000000);

		# Large posts should require a higher execution time limit, see http://core.trac.wordpress.org/ticket/16799
		@ini_set('max_execution_time',180);

		# Pingpack should use allow_url_fopen http://core.trac.wordpress.org/ticket/1166
		//@ini_set('allow_url_fopen',1);

		$img_set = get_option( MISS_SETTINGS );
		$img_set = ( !empty( $img_set ) && !isset( $_POST[MISS_SETTINGS]['reset'] ) ) ? $img_set : array();
		$blog_layout = apply_filters( 'miss_blog_layout', miss_get_setting( 'blog_layout' ) );

		/* Image Dimensions */
		$images = array(
			/* Primary Menu Images */
		    'menu_static_span12' => array( 
		        ( 1170 ),
		        ( 360 )
		    ),
		    'menu_static_span6' => array( 
		        ( 558 ),
		        ( 558 )
		    ),
			/* Portfolio Images */
		    'span12' => array( 
		        ( !empty( $img_set['one_column_portfolio_big']['w'] ) ? $img_set['one_column_portfolio_big']['w'] : 1170 ),
		        ( !empty( $img_set['one_column_portfolio_big']['h'] ) ? $img_set['one_column_portfolio_big']['h'] : 520 )),
		    'span6' => array( 
		        ( !empty( $img_set['two_column_portfolio_big']['w'] ) ? $img_set['two_column_portfolio_big']['w'] : 570 ),
		        ( !empty( $img_set['two_column_portfolio_big']['h'] ) ? $img_set['two_column_portfolio_big']['h'] : 376 )),
		    'span4' => array( 
		        ( !empty( $img_set['three_column_portfolio_big']['w'] ) ? $img_set['three_column_portfolio_big']['w'] : 370 ),
		        ( !empty( $img_set['three_column_portfolio_big']['h'] ) ? $img_set['three_column_portfolio_big']['h'] : 250 )),
		    'span3' => array( 
		        ( !empty( $img_set['four_column_portfolio_big']['w'] ) ? $img_set['four_column_portfolio_big']['w'] : 270 ),
		        ( !empty( $img_set['four_column_portfolio_big']['h'] ) ? $img_set['four_column_portfolio_big']['h'] : 216 )),

		    /* Blog Images */
		    'blog_layout1' => array( 
		        ( !empty( $img_set['blog_layout1_full']['w'] ) ? $img_set['blog_layout1_full']['w'] : 1090 ),
		        ( !empty( $img_set['blog_layout1_full']['h'] ) ? $img_set['blog_layout1_full']['h'] : 430 )),
		    'blog_layout2' => array( 
		        ( !empty( $img_set['blog_layout2_full']['w'] ) ? $img_set['blog_layout2_full']['w'] : 320 ),
		        ( !empty( $img_set['blog_layout2_full']['h'] ) ? $img_set['blog_layout2_full']['h'] : 230 )),
		    'blog_layout3' => array( 
		        ( !empty( $img_set['blog_layout3_full']['w'] ) ? $img_set['blog_layout3_full']['w'] : 485 ),
		        ( !empty( $img_set['blog_layout3_full']['h'] ) ? $img_set['blog_layout3_full']['h'] : 275 )),
		    'blog_layout4' => array( 
		        ( !empty( $img_set['blog_layout4_full']['w'] ) ? $img_set['blog_layout4_full']['w'] : 285 ),
		        ( !empty( $img_set['blog_layout4_full']['h'] ) ? $img_set['blog_layout4_full']['h'] : 200 )),
		    'blog_layout5' => array( 
		        ( !empty( $img_set['blog_layout5_full']['w'] ) ? $img_set['blog_layout5_full']['w'] : 270 ),
		        ( !empty( $img_set['blog_layout5_full']['h'] ) ? $img_set['blog_layout5_full']['h'] : 270 )),

		    'blog_grid_one_col' => array( 
		        ( !empty( $img_set['blog_grid_two_col_full']['w'] ) ? $img_set['blog_grid_two_col_full']['w'] : 570 ),
		        ( !empty( $img_set['blog_grid_two_col_full']['h'] ) ? $img_set['blog_grid_two_col_full']['h'] : 290 )),
		    'blog_grid_two_col' => array( 
		        ( !empty( $img_set['blog_grid_two_col_full']['w'] ) ? $img_set['blog_grid_two_col_full']['w'] : 570 ),
		        ( !empty( $img_set['blog_grid_two_col_full']['h'] ) ? $img_set['blog_grid_two_col_full']['h'] : 290 )),
		    'blog_grid_three_col' => array( 
		        ( !empty( $img_set['blog_grid_three_col_full']['w'] ) ? $img_set['blog_grid_three_col_full']['w'] : 370 ),
		        ( !empty( $img_set['blog_grid_three_col_full']['h'] ) ? $img_set['blog_grid_three_col_full']['h'] : 370 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_full']['w'] ) ? $img_set['small_post_list_full']['w'] : 50 ),
		        ( !empty( $img_set['small_post_list_full']['h'] ) ? $img_set['small_post_list_full']['h'] : 50 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_full']['w'] ) ? $img_set['medium_post_list_full']['w'] : 100 ),
		        ( !empty( $img_set['medium_post_list_full']['h'] ) ? $img_set['medium_post_list_full']['h'] : 100 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_full']['w'] ) ? $img_set['large_post_list_full']['w'] : 200 ),
		        ( !empty( $img_set['large_post_list_full']['h'] ) ? $img_set['large_post_list_full']['h'] : 200 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_big']['w'] ) ? $img_set['portfolio_single_full_big']['w'] : 1170 ),
		        ( !empty( $img_set['portfolio_single_full_big']['h'] ) ? $img_set['portfolio_single_full_big']['h'] : 776 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_big']['w'] ) ? $img_set['additional_posts_grid_big']['w'] : 216 ),
		        ( !empty( $img_set['additional_posts_grid_big']['h'] ) ? $img_set['additional_posts_grid_big']['h'] : 138 )),
		);

		$big_sidebar_images = array( 
		    'span12' => array( 
		        ( !empty( $img_set['one_column_portfolio_big']['w'] ) ? $img_set['one_column_portfolio_big']['w'] : 870 ),
		        ( !empty( $img_set['one_column_portfolio_big']['h'] ) ? $img_set['one_column_portfolio_big']['h'] : 436 )),
		    'span6' => array( 
		        ( !empty( $img_set['two_column_portfolio_big']['w'] ) ? $img_set['two_column_portfolio_big']['w'] : 424 ),
		        ( !empty( $img_set['two_column_portfolio_big']['h'] ) ? $img_set['two_column_portfolio_big']['h'] : 282 )),
		    'span4' => array( 
		        ( !empty( $img_set['three_column_portfolio_big']['w'] ) ? $img_set['three_column_portfolio_big']['w'] : 275 ),
		        ( !empty( $img_set['three_column_portfolio_big']['h'] ) ? $img_set['three_column_portfolio_big']['h'] : 216 )),
		    'span3' => array( 
		        ( !empty( $img_set['four_column_portfolio_big']['w'] ) ? $img_set['four_column_portfolio_big']['w'] : 201 ),
		        ( !empty( $img_set['four_column_portfolio_big']['h'] ) ? $img_set['four_column_portfolio_big']['h'] : 190 )),

		    'blog_layout1' => array( 
		        ( !empty( $img_set['blog_layout1_big']['w'] ) ? $img_set['blog_layout1_big']['w'] : 790 ),
		        ( !empty( $img_set['blog_layout1_big']['h'] ) ? $img_set['blog_layout1_big']['h'] : 330 )),
		    'blog_layout2' => array( 
		        ( !empty( $img_set['blog_layout2_big']['w'] ) ? $img_set['blog_layout2_big']['w'] : 320 ),
		        ( !empty( $img_set['blog_layout2_big']['h'] ) ? $img_set['blog_layout2_big']['h'] : 230 )),
		    'blog_layout3' => array( 
		        ( !empty( $img_set['blog_layout3_big']['w'] ) ? $img_set['blog_layout3_big']['w'] : 424 ),
		        ( !empty( $img_set['blog_layout3_big']['h'] ) ? $img_set['blog_layout3_big']['h'] : 220 )),
		    'blog_layout4' => array( 
		        ( !empty( $img_set['blog_layout4_big']['w'] ) ? $img_set['blog_layout4_big']['w'] : 275 ),
		        ( !empty( $img_set['blog_layout4_big']['h'] ) ? $img_set['blog_layout4_big']['h'] : 183 )),
		    'blog_layout5' => array( 
		        ( !empty( $img_set['blog_layout5_big']['w'] ) ? $img_set['blog_layout5_big']['w'] : 201 ),
		        ( !empty( $img_set['blog_layout5_big']['h'] ) ? $img_set['blog_layout5_big']['h'] : 201 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_big']['w'] ) ? $img_set['small_post_list_big']['w'] : 80 ),
		        ( !empty( $img_set['small_post_list_big']['h'] ) ? $img_set['small_post_list_big']['h'] : 80 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_big']['w'] ) ? $img_set['medium_post_list_big']['w'] : 200 ),
		        ( !empty( $img_set['medium_post_list_big']['h'] ) ? $img_set['medium_post_list_big']['h'] : 200 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_big']['w'] ) ? $img_set['large_post_list_big']['w'] : 395 ),
		        ( !empty( $img_set['large_post_list_big']['h'] ) ? $img_set['large_post_list_big']['h'] : 285 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_big']['w'] ) ? $img_set['portfolio_single_full_big']['w'] : 870 ),
		        ( !empty( $img_set['portfolio_single_full_big']['h'] ) ? $img_set['portfolio_single_full_big']['h'] : 576 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_big']['w'] ) ? $img_set['additional_posts_grid_big']['w'] : 216 ),
		        ( !empty( $img_set['additional_posts_grid_big']['h'] ) ? $img_set['additional_posts_grid_big']['h'] : 138 )),

		);

		$small_sidebar_images = array(
		    'span12' => array( 
		        ( !empty( $img_set['one_column_portfolio_big']['w'] ) ? $img_set['one_column_portfolio_big']['w'] : 870 ),
		        ( !empty( $img_set['one_column_portfolio_big']['h'] ) ? $img_set['one_column_portfolio_big']['h'] : 436 )),
		    'span6' => array( 
		        ( !empty( $img_set['two_column_portfolio_big']['w'] ) ? $img_set['two_column_portfolio_big']['w'] : 424 ),
		        ( !empty( $img_set['two_column_portfolio_big']['h'] ) ? $img_set['two_column_portfolio_big']['h'] : 282 )),
		    'span4' => array( 
		        ( !empty( $img_set['three_column_portfolio_big']['w'] ) ? $img_set['three_column_portfolio_big']['w'] : 275 ),
		        ( !empty( $img_set['three_column_portfolio_big']['h'] ) ? $img_set['three_column_portfolio_big']['h'] : 216 )),
		    'span3' => array( 
		        ( !empty( $img_set['four_column_portfolio_big']['w'] ) ? $img_set['four_column_portfolio_big']['w'] : 201 ),
		        ( !empty( $img_set['four_column_portfolio_big']['h'] ) ? $img_set['four_column_portfolio_big']['h'] : 190 )),

		    'blog_layout1' => array( 
		        ( !empty( $img_set['blog_layout1_big']['w'] ) ? $img_set['blog_layout1_big']['w'] : 790 ),
		        ( !empty( $img_set['blog_layout1_big']['h'] ) ? $img_set['blog_layout1_big']['h'] : 330 )),
		    'blog_layout2' => array( 
		        ( !empty( $img_set['blog_layout2_big']['w'] ) ? $img_set['blog_layout2_big']['w'] : 320 ),
		        ( !empty( $img_set['blog_layout2_big']['h'] ) ? $img_set['blog_layout2_big']['h'] : 230 )),
		    'blog_layout3' => array( 
		        ( !empty( $img_set['blog_layout3_big']['w'] ) ? $img_set['blog_layout3_big']['w'] : 424 ),
		        ( !empty( $img_set['blog_layout3_big']['h'] ) ? $img_set['blog_layout3_big']['h'] : 220 )),
		    'blog_layout4' => array( 
		        ( !empty( $img_set['blog_layout4_big']['w'] ) ? $img_set['blog_layout4_big']['w'] : 275 ),
		        ( !empty( $img_set['blog_layout4_big']['h'] ) ? $img_set['blog_layout4_big']['h'] : 183 )),
		    'blog_layout5' => array( 
		        ( !empty( $img_set['blog_layout5_big']['w'] ) ? $img_set['blog_layout5_big']['w'] : 201 ),
		        ( !empty( $img_set['blog_layout5_big']['h'] ) ? $img_set['blog_layout5_big']['h'] : 201 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_big']['w'] ) ? $img_set['small_post_list_big']['w'] : 80 ),
		        ( !empty( $img_set['small_post_list_big']['h'] ) ? $img_set['small_post_list_big']['h'] : 80 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_big']['w'] ) ? $img_set['medium_post_list_big']['w'] : 200 ),
		        ( !empty( $img_set['medium_post_list_big']['h'] ) ? $img_set['medium_post_list_big']['h'] : 200 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_big']['w'] ) ? $img_set['large_post_list_big']['w'] : 395 ),
		        ( !empty( $img_set['large_post_list_big']['h'] ) ? $img_set['large_post_list_big']['h'] : 285 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_big']['w'] ) ? $img_set['portfolio_single_full_big']['w'] : 870 ),
		        ( !empty( $img_set['portfolio_single_full_big']['h'] ) ? $img_set['portfolio_single_full_big']['h'] : 576 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_big']['w'] ) ? $img_set['additional_posts_grid_big']['w'] : 216 ),
		        ( !empty( $img_set['additional_posts_grid_big']['h'] ) ? $img_set['additional_posts_grid_big']['h'] : 138 )),
		);


		// Rest Images
		foreach( $images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$images[$key] = $new_size;
			if ( function_exists( 'add_image_size' ) ) {
				add_image_size($new_size['0'] . 'x' . $new_size['1'], $new_size[0],$new_size[1],true);
			}
		}
		foreach( $big_sidebar_images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$big_sidebar_images[$key] = $new_size;
			if ( function_exists( 'add_image_size' ) ) {
				add_image_size($new_size['0'] . 'x' . $new_size['1'], $new_size[0],$new_size[1],true);
			}
		}
		foreach( $small_sidebar_images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$small_sidebar_images[$key] = $new_size;
			if ( function_exists( 'add_image_size' ) ) {
				add_image_size($new_size['0'] . 'x' . $new_size['1'], $new_size[0],$new_size[1],true);
			}
		}
		// Blog layouts
		switch( $blog_layout ) {
			case "blog_layout1":
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout1',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'featured' => '',
					'img_class' => 'post_grid_image has_preview'
				);
				break;
			case "blog_layout2":
				$columns_num = 1;
				$featured = ( is_archive() || is_search() ) ? false : false;
				$columns = 'span12';
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout2',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'img_class' => 'post_grid_image has_preview',
					'columns_num' => ( !empty( $columns_num ) ? $columns_num : '' ),
					'featured' => ( !empty( $featured ) ? $featured : '' ),
					'columns' => ( !empty( $columns ) ? $columns : '' )
				);
				break;
			case "blog_layout3":
				$columns_num = 2;
				$featured = ( is_archive() || is_search() ) ? false : false;
				$columns = 'span6';
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout3',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'img_class' => 'post_grid_image has_preview',
					'columns_num' => ( !empty( $columns_num ) ? $columns_num : '' ),
					'featured' => ( !empty( $featured ) ? $featured : '' ),
					'columns' => ( !empty( $columns ) ? $columns : '' )
				);
				break;
			case "blog_layout4":
				$columns_num = 3;
				$columns = 'span4';
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout4',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'img_class' => 'post_grid_image has_preview',
					'columns_num' => ( !empty( $columns_num ) ? $columns_num : '' ),
					'columns' => ( !empty( $columns ) ? $columns : '' )
				);
				break;
			case "blog_layout5":
				$columns_num = 4;
				$columns = 'span3';
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout5',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'img_class' => 'post_grid_image has_preview',
					'columns_num' => ( !empty( $columns_num ) ? $columns_num : '' ),
					//'featured' => ( !empty( $featured ) ? $featured : '' ),
					'columns' => ( !empty( $columns ) ? $columns : '' )
				);
				break;
		}
	
		if (isset($layout)) { $irish_framework_params->layout['blog'] = $layout; }
		$irish_framework_params->layout['images'] = array_merge( $images, array( 'image_padding' => 2 ) );
		$irish_framework_params->layout['big_sidebar_images'] = $big_sidebar_images;
		$irish_framework_params->layout['small_sidebar_images'] = $small_sidebar_images;
		$irish_framework_params->layout['images_slider'] = isset( $images_slider ) ? $images_slider : '';
		/* Getting variables */
		if (!function_exists('getImages')) {
			function getImages () {
				return $this->images;
			}
        }
	}
}

/**
 * Functions & Pluggable functions specific to theme.
 *
 * @package IrishMiss
 * @subpackage RadioStation
 */

if ( !function_exists( 'miss_read_more' ) ) :
/**
 *
 */
function miss_read_more( $url ) {
	$out = '<div class="read_more_block"><a class="post_more_link" href="' . $url . '">' . __( 'Read More', MISS_TEXTDOMAIN ) . '</a></div>';
	return $out;
}
function miss_read_more_link( $url ) {
	$out = '<div class="read_more_link"><a class="post_more_link" href="' . $url . '">' . __( 'Read More', MISS_TEXTDOMAIN ) . ' <i class="fa-icon-angle-right"></i></a></div>';
	return $out;
}
endif;

if ( !function_exists( 'miss_post_img_shadow_before' ) ) :
/**
 *
 */
function miss_post_img_shadow_before() {

}
endif;

if ( !function_exists( 'miss_post_img_shadow_after' ) ) :
/**
 *
 */
function miss_post_img_shadow_after() {

}
endif;


if ( !function_exists( 'miss_page_layout' ) ) :
/**
 *
 */
function miss_page_layout() {
    global $wp_query;
    $post_obj = $wp_query->get_queried_object();
	if ( !empty( $post_obj->ID ) ) {
		$page_layout = get_post_meta( $post_obj->ID, '_layout', true ) ? get_post_meta ( $post_obj->ID, '_layout', true ) : 'full_width';
	}
	if ( is_404() ) {
		$page_layout = miss_get_setting( 'homepage_layout' ) ? miss_get_setting( 'homepage_layout' ) : 'full_width';
	} elseif ( empty ( $page_layout ) ) {
		$page_layout = miss_get_setting( 'blog_layout' ) ? miss_get_setting( 'blog_layout' ) : 'full_width';
	}
	return $page_layout;
}
endif;

if ( !function_exists( 'miss_is_bp' ) ) :
/**
 *
 */
function miss_is_bp() {

		if ( function_exists ( 'bp_is_group' ) && (
			bp_is_blog_page() ||
			bp_is_my_profile() ||
			bp_is_my_profile() ||
			is_front_page() ||
			bp_is_component_front_page( 'activity' ) ||
			bp_is_directory() ||
			bp_is_profile_component() ||
			bp_is_activity_component() ||
			bp_is_blogs_component() ||
			bp_is_messages_component() ||
			bp_is_friends_component() ||
			bp_is_groups_component() ||
			bp_is_settings_component() ||
			bp_is_user_activity() ||
			bp_is_user_friends_activity() ||
			bp_is_activity_permalink() ||
			bp_is_user_profile() ||
			bp_is_profile_edit() ||
			bp_is_change_avatar() ||
			bp_is_user_groups() ||
			bp_is_group() ||
			bp_is_group_home() ||
			bp_is_group_create() ||
			bp_is_group_admin_page() ||
			bp_is_group_forum() ||
			bp_is_group_activity() ||
			bp_is_group_forum_topic() ||
			bp_is_group_forum_topic_edit() ||
			bp_is_group_members() ||
			bp_is_group_invites() ||
			bp_is_group_membership_request() ||
			bp_is_group_leave() ||
			bp_is_group_single() ||
			bp_is_user_blogs() ||
			bp_is_user_recent_posts() ||
			bp_is_user_recent_commments() ||
			bp_is_create_blog() ||
			bp_is_user_friends() ||
			bp_is_friend_requests() ||
			bp_is_user_messages() ||
			bp_is_messages_inbox() ||
			bp_is_messages_sentbox() ||
			bp_is_notices() ||
			bp_is_messages_compose_screen() ||
			bp_is_activation_page() ||
			bp_is_register_page()
		) ) {
			return true;
		}
		return false;
}
endif;


if ( !function_exists( 'miss_page_layout' ) ) :
/**
 *
 */

function miss_buddypress_layout() {
	return miss_get_setting( 'homepage_layout' ) ? miss_get_setting( 'homepage_layout' ) : 'full_width';
}
endif;

if ( !function_exists( 'miss_store_layout' ) ) :
/**
 *
 */
function miss_store_layout() {
	$store_layout = miss_get_setting( 'store_layout' ) ? miss_get_setting( 'store_layout' ) : 'full_width';
	return $store_layout;
}
endif;

if ( !function_exists( 'miss_custom_post_layout' ) ) :
/**
 *
 */
function miss_custom_post_layout() {
	global $wp_query, $irish_framework_params;
	$post_obj = $wp_query->get_queried_object();
	$_layout = ( is_object ( $post_obj ) && isset( $post_obj->ID ) ) ? get_post_meta( $post_obj->ID, '_layout', true ) : 'full_width';

	if( is_singular( 'portfolio' ) ) {
		add_action( 'miss_before_post', 'miss_post_title', 1 );
		add_action( 'miss_before_post', 'miss_post_nav', 2 );
		add_action( 'miss_before_post', 'miss_post_image' );
	} elseif ( miss_is_template('templates/template-works.php') ) {
		add_action( 'miss_before_post', 'miss_post_image' );
	}

	if ( ( is_singular('post') || is_singular('news') || is_singular('testimonials') || is_singular('vacancy') ) && !is_singular( 'portfolio' ) ) {
		add_action( 'miss_before_post', 'miss_post_date_box' );
		add_action( 'miss_before_post', 'post_feature_display_type' );
		add_action( 'miss_before_post', 'miss_post_title' );
	} elseif( miss_is_blog() || is_archive() || ( get_option('show_on_front') == 'posts' || get_option('page_on_front') == 0 ) ) {
		if( $irish_framework_params->layout['blog']['blog_layout'] == 'blog_layout1' ) {
			add_action( 'miss_before_post', 'miss_post_date_box' );
			add_action( 'miss_before_post', 'post_feature_display_type' );
			add_action( 'miss_before_post', 'miss_post_title' );
			add_action( 'miss_before_post', 'miss_post_meta_edit_author_comments' );
			add_action( 'miss_post_meta_row', 'miss_post_meta_taxonomy_tags' );
		} elseif( $irish_framework_params->layout['blog']['blog_layout'] == 'blog_layout2' ) {
			add_action( 'miss_before_post', 'miss_post_date_box' );
			add_action( 'miss_before_post', 'post_feature_display_type' );
			add_action( 'miss_before_post', 'miss_post_title' );
			add_action( 'miss_before_post', 'miss_post_meta_edit_author_comments' );
			add_action( 'miss_post_meta_row', 'miss_post_meta_taxonomy_tags' );
		} elseif( $irish_framework_params->layout['blog']['blog_layout'] == 'blog_layout3' ) {
			add_action( 'miss_before_post', 'miss_post_date_box' );
			add_action( 'miss_before_post', 'post_feature_display_type' );
			add_action( 'miss_before_post', 'miss_post_title' );
			add_action( 'miss_before_post', 'miss_post_meta_edit_author_comments' );
			add_action( 'miss_post_meta_row', 'miss_post_meta_taxonomy_tags' );
		} elseif( $irish_framework_params->layout['blog']['blog_layout'] == 'blog_layout4' ) {
			add_action( 'miss_before_post', 'post_feature_display_type' );
			add_action( 'miss_before_post', 'miss_post_date_box' );
			add_action( 'miss_before_post', 'miss_post_title' );
			add_action( 'miss_post_meta_row', 'miss_post_meta_long' );
		} elseif( $irish_framework_params->layout['blog']['blog_layout'] == 'blog_layout5' ) {
			add_action( 'miss_before_post', 'post_feature_display_type' );
			add_action( 'miss_before_post', 'miss_post_title' );
			add_action( 'miss_before_post', 'miss_post_meta_diferent' );
		} else {
			add_action( 'miss_before_post', 'miss_post_date_box' );
			add_action( 'miss_before_post', 'post_feature_display_type' );
			add_action( 'miss_before_post', 'miss_post_title' );
			add_action( 'miss_post_meta_row', 'miss_post_meta_long' );
		}
	}
}
endif;


if ( !function_exists( 'miss_post_meta_bottom' ) ) :
/**
 *
 */
function miss_post_meta_bottom( $args = array() ) {
	if( is_page() ) return;
	
	$out = '';
	$meta_options = miss_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';

	if( !empty( $meta_output ) )
		$out .='<p class="post_meta_bottom">' . $meta_output . '</p>';
	
	echo apply_atomic_shortcode( 'post_meta_bottom', $out );
}
endif;

if ( !function_exists( 'miss_widget_meta' ) ) :
/**
 *
 */
function miss_widget_meta() {
	return do_shortcode( '[post_date text="" format="M j, Y"]' );
}
endif;

if ( !function_exists( 'miss_before_entry_sc' ) ) :
/**
 *
 */
function miss_before_entry_sc( $filter_args ) {
	$out = '';
	if( $filter_args['type'] == 'blog_list' ) {
		
		if( strpos( $filter_args['disable'], 'title' ) === false )
			$out .= miss_post_title( $filter_args );
		if( strpos( $filter_args['disable'], 'meta' ) === false )
			$out .= miss_post_meta( $filter_args );
	}
	return $out;
}
endif;

if ( !function_exists( 'miss_comments_callback' ) ) :
/**
 *
 */
function miss_comments_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$comment_type = get_comment_type( $comment->comment_ID );
	$author = esc_html( get_comment_author( $comment->comment_ID ) );
	$url = esc_url( get_comment_author_url( $comment->comment_ID ) );
	$default_avatar = ( 'pingback' == $comment_type || 'trackback' == $comment_type )
	? THEME_IMAGES_ASSETS . "/gravatar_{$comment_type}.png"
	: THEME_IMAGES_ASSETS . '/avatars/default-avatar_80.png';
	?><li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<div id="div-comment-<?php comment_ID() ?>"><?php
		/* Display gravatar */
		$avatar = get_avatar( get_comment_author_email( $comment->comment_ID ), apply_filters( "miss_avatar_size", '80' ), $default_avatar, $author );
		if ( $url )
			$avatar = '<a href="' . $url . '" rel="external nofollow" title="' . $author . '">' . $avatar . '</a>';
		?><div class="comment-author vcard"><?php
			echo $avatar;
			/* Display link and cite if URL is set. */
			if ( $url )
				echo '<cite class="fn" title="' . $url . '"><a href="' . $url . '" title="' . $author . '" class="url" rel="external nofollow">' . $author . '</a></cite>';
			else
				echo '<cite class="fn">' . $author . '</cite>';
			/* Display comment date */
			?><span class="date"><?php printf( __('%1$s', MISS_TEXTDOMAIN ), get_comment_date( __( apply_filters( "miss_comment_date_format", 'm-d-Y' ) ) ) ); ?></span>
		</div>
		<div class="comment-text"><?php
			if ( $comment->comment_approved == '0' ) : ?>
				<p class="alert moderation"><?php _e( 'Your comment is awaiting moderation.', MISS_TEXTDOMAIN ); ?></p>
				<?php endif; ?>
				<?php comment_text() ?>
				<div class="comment-meta commentmetadata"><?php
					comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
					edit_comment_link( __( 'Edit', MISS_TEXTDOMAIN ), ' ' );
				?></div>
		</div><!-- .comment-text -->
		</div><!-- #div-comment-## -->
<?php } ?>
<?php endif; ?>
