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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('WP_ALLOW_REPAIR', true);
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'D|.Lq9Jfrz]Z~!*>^t}$. QAPu_IzJfqU[/?is{*I7fP;J6Tv7PVo]KJg9<PD=<4' );
define( 'SECURE_AUTH_KEY',  'l8xc&#b`mWjFT,6Uu2e!jLq[s6_iL5Fvyj:8~f6S5wL{y./;{GWF|luf.[SxhTF1' );
define( 'LOGGED_IN_KEY',    '|C<bX4>]R]R,0C_LKp[`Wk[]a?yS2{g~jr22 P}Wbp[bsFWfHLNE]anS5~Zy$q/U' );
define( 'NONCE_KEY',        'srZ=!%T>Rbmo<O~AQkP#b>8R!i>{E% iEyM_(:IXNg?(613]rZb$*!=ad5g8^R@f' );
define( 'AUTH_SALT',        '~,Z%RaG)9Yq(UDi/Pcg7lh1WJA02n,eEmwJ>|j`qMeu nY$3J}hj+Y4+zKpNU[`X' );
define( 'SECURE_AUTH_SALT', '$y9O=q#4E6L]QD(kE/[8r<I,]#^6/e>A)7G%Kc#ZF|F]Eo:NQ=1T25>S)lcrBbi>' );
define( 'LOGGED_IN_SALT',   'Fae~5%|ms>dkeA]WD{+G%XCMs`0OfRejY&&Z|8^u|7OXcQZ,+avI(?VOE&MwCC~+' );
define( 'NONCE_SALT',       ':6}J_p[62cb<h.z0T:)QlaOnsK[8~w<~?lR_{v8f~rq~;@<5y{s]nHuD!kL^I~Ac' );

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
