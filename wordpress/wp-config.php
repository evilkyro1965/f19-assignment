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
define('DB_NAME', 'f19');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '12345');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'N !zR*NtwvqIsa?WCKb_DW]_DQrxuA{.QLYXJ)2+yqx6|[:s`?9jRT7^Py,}WlvD');
define('SECURE_AUTH_KEY',  'U7>#Gdm[2 9]_*Z{0<gJx[((ZHuG?o :(F&_ocII|A.^.(/1iL:$u1a|ZrOnyFDK');
define('LOGGED_IN_KEY',    '{#}(5I<_ AW{wT>Yr#DFFj$,7x%.HmVy0K_`_LyJ5Sqcv,D+x7]4T/vM@.Uz})W{');
define('NONCE_KEY',        '$MAw4w2fqc1,O,(EO71!~1l%Y7 +d!DX{A6|U<PVo`;TF%ZJ/?,6t:RmB|^;h1X3');
define('AUTH_SALT',        'nZ$7] g*O7CWk99sm_ck$;Pe07pvkRf,LXma2BZ}ECw77%|k!gH{%@dY%{0tb{z=');
define('SECURE_AUTH_SALT', '3M1 Sznqu&Srf#=RKN;4luzO>FL.=DxQ_wSRFk!wp?+]j4L_Q*VQ,xgi<-LR7C$R');
define('LOGGED_IN_SALT',   'ND>V.UGl)J]3g)eZ[TqF2}~%GJ :rNz+xDX` Oyp#B)9Q{3CYKWH;68P*{_t6mX.');
define('NONCE_SALT',       '6:k{?l1T8*dP *)<7a)KOg`/{k,p[hRL:hnxNz^3HDzCDWN`sR^>Q p*_Py?`M|h');

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
