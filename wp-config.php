<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'my_portfolio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '(Nh[kigIM#H!_a^Gh<Od<:J&c&o2,gf(}8uSuaVtF#^jONjSmCZqh]9I1oc/&52_' );
define( 'SECURE_AUTH_KEY',  ']Q]Z7o5JrEBST|]>5ORs8|VY~sq}P#?0??#[Y]Bh>I:5ZL5ScRx;oBB8Frl_ F}+' );
define( 'LOGGED_IN_KEY',    '(2<e+?K/tpnBCWw37A]z~(FS=#2&110`JsQ+Z1q>ArtP)mw!:p+z7u?6abb:V(`z' );
define( 'NONCE_KEY',        'P9fs?rH~W#a~B1)aTvzua]0K xU&ObNd8C/Y*4)J,x)Ygq~]G1X2lx -=SUCZ9|,' );
define( 'AUTH_SALT',        'rh!XM>#gx3KhJFleGQr1s6ffJ6):8uMT-@qk-vwp[mv+vI]brGFdupElJ?BMcE1F' );
define( 'SECURE_AUTH_SALT', 'ot^g,iaVZbb$2f*|{w7.- W3D=taXzT8:l`LxQu-Z>aA05:P:}){WK^0GQTS~-#v' );
define( 'LOGGED_IN_SALT',   'O,ceDeGD.aULwm,6}3S/=d[@%G$5L6 n.*t@^-K%{>fr7t0[RMP$)$0K[SmYA-@C' );
define( 'NONCE_SALT',       'X@T#M,HqSYcf<d{ATM-D9:|TjV<ut5dt54q$`VI89Luq/Ol*6g/!J8Yv6i%fXHUH' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
