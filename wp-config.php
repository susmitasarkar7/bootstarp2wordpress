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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bootstrap2worspress' );

/** MySQL database username */
define( 'DB_USER', 'bootsman' );

/** MySQL database password */
define( 'DB_PASSWORD', 'kZ0d98kE4RoIta0N' );

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
define('AUTH_KEY',         'P)iw$yMQ[O5U$kY+Bj6r]#Rh=4GjM8~R&N;Bq@#)EBnyHcMlV5Sz~-II5+]*)_QH');
define('SECURE_AUTH_KEY',  'ZRDX8H5#+bw[S]>h*GP]?0BmJTMdP;T8N6f)oq+_V88t<#Es2ut>)FPLh~)CG)A5');
define('LOGGED_IN_KEY',    '>c$yuel>*|~,zZp7q)vk!7,nE@=oenLx<mY}.!Gpj?J|HrES?&CX6gD`S;E|_NS~');
define('NONCE_KEY',        '9$Zn+,]6vuI-jAAHUJ~-_&,yZUY|]^*CGB8`+b^&oGtGU jz1adh8v8G?+.n^w|L');
define('AUTH_SALT',        'n2MZu-`-.w)Ku{:?%}i?ta$u+sDoEf[XeA9AW!_Z`2r~Vw%skAC/VV3mgx$J,wgo');
define('SECURE_AUTH_SALT', 'xB5OVl>|E[sbt5?@_TfOybiL.-3rWp?a}++HAo@Y3Nkh*7sj=Ch|+4S[dM-y8(Fh');
define('LOGGED_IN_SALT',   '`&E:*/1a_WP!UY~_,lJ4@d$%cc8gv,AOYhM%/ ^Y$Odq(?#i>ylP1VrTL(@pqPY?');
define('NONCE_SALT',       'k?-cUH t3@7?]I@.KeLv,uDoH(t[Xm3yQkL-6$cOpD-{{J[|GoT QdP!,P/q)DyN');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dbbs_';

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
