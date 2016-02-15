<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('WP_HOME','http://scrollax.mnb-t.com/scrollax/');
define('WP_SITEURL','http://scrollax.mnb-t.com/scrollax/');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mnbtcom_scrollax2');

/** MySQL database username */
define('DB_USER', 'mnbtcom_scrolax2');

/** MySQL database password */
define('DB_PASSWORD', 'u~V~@n{@F7~s');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'l:GyA2HnWgk>7eUG*R6|Y`|GiylA>-Q2ebOH},2t@zOJ$r_]-.X!6e!wMocr>r:)');
define('SECURE_AUTH_KEY',  'r?yXQ:>|IO5C+sa%gObGa8X|hFNCg?h%QQPd|OfeOJY-YHe%gUzS^mO^egcYc&ca');
define('LOGGED_IN_KEY',    '9D+5-+=FtA2k/ Sk_{j-HCZ(_jK9E]!K^14ftw8_]l6*#Z)J0Pbx7p7~S6jI3`PP');
define('NONCE_KEY',        '{zE:h[Kg=k,gX669vUh-JX|,Wti%07$}eK@S-UCV[N=*C.:~Qo0=@cY_h^W=Nk{.');
define('AUTH_SALT',        'qH=f=0j`|T#Hv!T[%D^0i13SF<*?z,~u|E=ROWucg^WWXK  2_rX_MOye~zO;*im');
define('SECURE_AUTH_SALT', '?/)||67I[,1(5>6z|s,a0{]nJ_2|sxsL0vrO%vSw]VJs-`}.6TTy0h)Z[lh1F*J4');
define('LOGGED_IN_SALT',   '~F-(l %+OO8.`b+gjYeB6)B(GI^m(#]{OYjEAr,*9._)T^#7!a+/z{Y.V`]ZcwVM');
define('NONCE_SALT',       'urd v cYSE(H~:+3&p;pi6F_CC&&(T+r>*E9D=0C-%l-9$+0)y]Yjf()jrUnIp)+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
//define('WPLANG', 'ru_RU');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
