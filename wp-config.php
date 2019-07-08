<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wordpress');
define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME']);
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'frankdb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~^A_^@Kvgh[Ot@#KqMft2aKiJY,Nb7=}Z}1hxH(()DoiTXR{BO-b]H$^{zC_&!dh');
define('SECURE_AUTH_KEY',  'WL&UA}t=)z6%d~dp)U|JbkQ!au}mOM+Mo]!]/RHwh<He-i5vDO7`;iSh+J#.8wM~');
define('LOGGED_IN_KEY',    'EyJ+-9mp<<u<t`1jjp2HUU[borjNTYfU|KHSWB=:>Bd[YT6Tq|SBIS|[I$)T)q5w');
define('NONCE_KEY',        'TICA<mD&6<I^ITTMoe@^tl}X(t4a^3<+3 UR&G*K]++.Eg@X5a&y+7K#Q|r19vOQ');
define('AUTH_SALT',        'RA|9@>9}Qb;3*{r{AZM|C0++{/8(UpKw55,uyHv2?vhq@J1[?5@%F/s7m)hqtoS`');
define('SECURE_AUTH_SALT', 'H<]G8hVC}TVhC<<5*#s#AGM@:8`iI`xV0CII6w@7^-S*1d|Fw20j{]1{c_s`DW%+');
define('LOGGED_IN_SALT',   ' -bd!n+/,tYzK,TM4B/FlLQFt9>F|;3o:Xr7AZlWb,iuHs1ZE-nvun-KCB)Ip*m;');
define('NONCE_SALT',       '43778|<FLO+S4Q,-45O1G =Yn:PC^) .eYEl{<:6rvw$G,g)izo#.tqt44+<pk9a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
