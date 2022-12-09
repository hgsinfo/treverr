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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dbwyx85g5mfyh9' );

/** Database username */
define( 'DB_USER', 'uqbbrgubyf08f' );

/** Database password */
define( 'DB_PASSWORD', 'pkghjd8rhgwk' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'cR?v0YhR1x2[![<LUgRIMA$``REmr%ROJ}~4a~b-l3KSK3F~sg&JHH`2h57r~h<f' );
define( 'SECURE_AUTH_KEY',   'H(t8+?2Hg{i-VZ$zW7UxJXa.`QLOM7{k<O)%ZN^z20>ZD/WEg1{:$l7NvCg(tfWR' );
define( 'LOGGED_IN_KEY',     'GSa0>?y8RfW+mA1a<&&Q%<iK:`yeb2]PPg>{}7sDG&b(Cut(Pk0g%c+9Ume #lQ.' );
define( 'NONCE_KEY',         'X*laU6DqH()|4%E5[9lxTM2W91cthmf*P-gJ?c_ZG6z/u5:}azvHHye>):VJ@#1p' );
define( 'AUTH_SALT',         '+ya!#/dpZSsc(? C(h]`gaEP__daW,A(&j<`oHC+->1d j1gb{wOpv>G&,t[-&nq' );
define( 'SECURE_AUTH_SALT',  'A]$:67mn1jC-6uj(=QPOR(dbqb-5Eh4mS@_R|.{RHC*l$HhvxGg>?:b-j>z#M2qo' );
define( 'LOGGED_IN_SALT',    'h!R:@u,W@^i~3$0m8Qj9rWWj}bf:o0r=Dxwt~rw;X7`J$02K9iA7#e_RopB@GPS|' );
define( 'NONCE_SALT',        '<.srjb84&ax_OKu[QfVStp;,@xICjXt,ZXd_|]x{Ld-mdu(h>#t>omPjy}s|Qw0r' );
define( 'WP_CACHE_KEY_SALT', 'o+@yso,zPfIJCbL0yer-__:=Y 8?/2@^G#!|uJ/t,zI8!^XCf%{z~.PC[y(3tm*#' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'qlr_';

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
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
