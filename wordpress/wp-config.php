<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'navona' );

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
define( 'AUTH_KEY',         'jP[U(g/PVq#o:Qr}72xNie;y=Phe5>-HV+ 9dU=>r=6n7L~~jBRGK~7k{QS}=_-m' );
define( 'SECURE_AUTH_KEY',  '0u.*h1kY<!R-:V>^#N(p[|kUt.oC) U-H[bQVKE#S@ur$h}b%GdD~/u:ko7f$a+D' );
define( 'LOGGED_IN_KEY',    'b3Ea^],btm.A]T?t8:yUL@4$=VwKtNd6>FxM,L-.cUk3Sc*4GU59aChFrI24^eJ0' );
define( 'NONCE_KEY',        'c<(XnW+G:J9?g!Q7^S?6C|Nr7S}GO:`z3fM72,MeI~srim8whGJk0=!{>sHx4a0%' );
define( 'AUTH_SALT',        'C4Nd>Y`xH*f5$N4RZlQdQo8bxuj!qTsP/~#+SVF^52cXdajpFjU8Wvn;A#zASt[,' );
define( 'SECURE_AUTH_SALT', '}R0_:J09z08S.e^]c [3II%Fom/|Go gdbeB|5!_dA[`B]855Q1[WtH;4]QGh$Oe' );
define( 'LOGGED_IN_SALT',   'Ed{5zMBddw9,^<Fe98|8B,%j9o@W#<+BE}a87{]+XY)(-$e@)$`8}uf/qY:ru.%8' );
define( 'NONCE_SALT',       'CMx(dQ6.of1/g8vDsHUd^q;BFNYQoii4oFPh1?r9&C&pY{4nD=4DsmXgYwC4~zfp' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
