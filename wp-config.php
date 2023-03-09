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

define( 'DB_NAME', 'soluters_aodes' );



/** Database username */

define( 'DB_USER', 'soluters_aodes' );



/** Database password */

define( 'DB_PASSWORD', 'N@w8q%*$(%,3' );



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

define( 'AUTH_KEY',         'as=y}1 u52^D@+nTlUCK^f9kCa2y*V2JS B$r<.!]pe~-&Z8|*{k_V]*A~4{FcvS' );

define( 'SECURE_AUTH_KEY',  'xv(~No!%lNijf>p(lq^Jc3}wDx|<Q>.VS~26NM}@u1I`pazJULBA ;<nKeE;!$pJ' );

define( 'LOGGED_IN_KEY',    '=MpitYv)SFY>60P(T:V4JU7mhH,j$=M0DR64B8lh^?39_8zX*q (aJ(Kl>`feVxR' );

define( 'NONCE_KEY',        'wYb[=$4@wMAq?a(H 5%+*n)NFoUWHsXmsq*ZGS4FX7e-z]wp9LG3y**}xyyuk2BJ' );

define( 'AUTH_SALT',        'Hfl)Fo~@~UGC+cK;>D,n6XeA9fwJx.F|XwPr(F#ksFR^tyv5]QR70F#S<{`uRSf7' );

define( 'SECURE_AUTH_SALT', '%;o i#}rU#d&q?>rFF4KD&ZPRGe$$c+?X&QX*UNCScKd5V<6q?~}WddFT1C{|Rg%' );

define( 'LOGGED_IN_SALT',   '5iIXS0%O4:8iARX|p2p0K#vD~2qbc1^TP^yDSs2(^`x#y<5t+0-4Apj]<08efh)y' );

define( 'NONCE_SALT',       'v/5CvO0/6o9MT0Y^=`8#(1%?Al.gm2!^#8kqRi9OarLQ11GqXZ*LN^6:5Jl[B|#b' );



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

