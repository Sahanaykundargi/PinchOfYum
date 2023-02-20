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
define( 'DB_NAME', 'sahana' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'lCme<Scrbd&GP1{YA2M<9zZ22cs1L0*.Y0N+sS7YN3.5;Faj2R[Zqvl?OmT#rkYI' );
define( 'SECURE_AUTH_KEY',  'T[63^11rG[bPP$VJ(:(bM/,OnRBgq+QZ1e EQb]iaupG_Ox+HG{|>s?`oC#OTnU)' );
define( 'LOGGED_IN_KEY',    'uO3BNVjGYz7nNKd)x5j~5D:6|:t)A{HSIN%VI T;%An@]n-;MH.,T+Q8]e!|(^(T' );
define( 'NONCE_KEY',        '@ds1(<~GGAS((Ha $mZTqs_X<V?(8I!4Q:^DDTdO-RW^avE5w+$a<]W,[y9}WI1$' );
define( 'AUTH_SALT',        'Cd53=!s@zMt.73P1e.,*rk7$?e8moim[{dFx0)<Xu3Sm,vf3f;vZ$lG^r*I9pGma' );
define( 'SECURE_AUTH_SALT', ',C*gt|9eQpgg%34|`:{!/ Swl83c+Y+]PTc*ti,&TAx+owyUXUD38(nvWE4w#g|F' );
define( 'LOGGED_IN_SALT',   'EW^0]BGJ-4(Ab/+zLZ AlBn=sTkj9#o36^B2)}[3F5gSF:A^s&sJFFFI/-QRd5S<' );
define( 'NONCE_SALT',       '$pd(f}DbrY >{0sQlQVk:C?5VfuFNR+$8{ /[)!E%Z3=0xWd+6]5c0X0Z&%.]B)g' );

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
