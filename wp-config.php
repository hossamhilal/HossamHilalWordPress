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
define( 'DB_NAME', 'HossamTheme' );

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
define( 'AUTH_KEY',         'K+[#=R}<~as=F`g`W0I-_AAV~}2D{MM)!!H$g7s (lx#5[r.AX,?Q`P3N/~CCE1$' );
define( 'SECURE_AUTH_KEY',  '~i3PW+psH@*E,2BWg7YVs>8LF}35_UsvRT|{Oqs(lWCmI<U#=Q`ix}g7 SfnWMlI' );
define( 'LOGGED_IN_KEY',    'n&aCyw *dc4(%g`0Nm,]+4?VVX(>Kw]jV%#;Ka6co3r~jt9FdsY>nw~LgL&/lwh5' );
define( 'NONCE_KEY',        '6kGE@d6F-(Q^TUPQ&(TJ%kJ@t*iYF>Rz{^)_OXQW|:XOhF6e=$-T@1?xhh3AK~>^' );
define( 'AUTH_SALT',        'd.M/|v)&R=-G*$N~GDz5VpS{!bO*&]&Z!MCY.l/1_ rHC$+5(gH1]o1&H9{EMKP:' );
define( 'SECURE_AUTH_SALT', 'x2U$MZ34vXtlFZ<{TxVUZT9XPqeH[TqJ(-^Zo:+=60hB30mV6F A2`c)bCbk;7 (' );
define( 'LOGGED_IN_SALT',   '~c{|TVx}ka@6O3~3~+zsS@c(MFS)1sq2D%i?apLxX*WXj1mj$k`[RT|T<E+WYpP5' );
define( 'NONCE_SALT',       'U3;EX yel9Dw;-B{mtNU3,);V{3jx3y=(q`D9D,,`m!zR l:>nvGi)A2VnU:>i;}' );

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
