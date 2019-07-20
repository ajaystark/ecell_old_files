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
define('DB_NAME', 'ecell_iiitdwp');

/** MySQL database username */
define('DB_USER', 'ecell_iiitdwp');

/** MySQL database password */
define('DB_PASSWORD', 'ib2V5t3f');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')r+ )of&AZ4wgclw#qO(^UT<N-sY#mbvK>ldlxQvWZhggs/A$CjsFYDK-&%J=`gL');
define('SECURE_AUTH_KEY',  'oHZj0@u]pt[+%e>:CVk34Q(s>y9<~.Dhp]dg3Kj:60eCxoqu8@Rw)1eX&N43Am`T');
define('LOGGED_IN_KEY',    'L6FXkZHETmdJi|NK8>=_6)/za>[DgOdZa-~uX:m[4$X1>>cf<NJG$mja:4+mD=X6');
define('NONCE_KEY',        'C+-d8-$p?r]6J/>7=4/q8$/$;?U!!ACI@5P?~nAFrm$:P>5<2I=O_wVbq5X@<; >');
define('AUTH_SALT',        '}BIGN1,<t`opyPB7;^ENIGBmENS)V(%tpo]2HD9o) 7lA^xAiCu fg4;u]0-l;)%');
define('SECURE_AUTH_SALT', 'C}r1VGyU|@!Wt!pEc[JEJ*>dCjf8LmHaa3#$ZQ:efgmdY(Gl.*6+EDr:@Re&3,b?');
define('LOGGED_IN_SALT',   '(7m5BHtjtZ@dS<h}Q#0Z_X[R&dsu(Qmg-x[IvwO_3R=tVm98Uqi|iLVTg):VE&AS');
define('NONCE_SALT',       '4}Ov->G9<hmglR7bjnGPVW<f!nu@l<A1+d!tHcuGQ h(#G}`L&a:;zY9`/4wKea.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
