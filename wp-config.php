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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'furniture_demo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '0Yk[Bc=m1i,Yr*WDZ@8D/ZDbZA+;&{@qwGiO+0qR:_.-y{rVgWNv(Bcy@HJ1})PP' );
define( 'SECURE_AUTH_KEY',  '4Gk^ayY&b:4~mS&,^;/UTXe3u|+Jd*t;8,50B+942H=bPMzQ=(AzpEu&us$yvV>x' );
define( 'LOGGED_IN_KEY',    'Y+o/.^QRmR7ja1ZSK5uk7NV3^hV{+69p5R09.c|OzEfpUHu>9Oh~Y.4919h/fR,R' );
define( 'NONCE_KEY',        'FP^;BCEJ(P_3bv;4<J3lBj,,`=PJA{YLOs#^HN|]u,9.|{R=HJI0;w%< 1t!4|p-' );
define( 'AUTH_SALT',        '<EZ5g1pI;2ZWHw*wC4YLVo8=f[< e^%0o|NYWD&K^,KwZ#2vo5y>QSL{ ?;T~b1;' );
define( 'SECURE_AUTH_SALT', ']Ey>?+31H%~w=4;`wy-45F y+MR^bB:pIl^+:sU137zb(_)x9Xrg]rx/{B8e8qCM' );
define( 'LOGGED_IN_SALT',   'Q^Avu3>Q?&gNSX}!x)w7h=tzwu|knLktNB*PQ95bAH@w&Vm:tc+63R;}y};]@U>w' );
define( 'NONCE_SALT',       'K1QznXElpJl/lTuelqk*Q^D3s:-rwmr@1_06h17DmzSQqAIvM`?H]fh3,71:p:Ly' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
