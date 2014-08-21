<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */



define('WP_HOME',    'http://celulares.local/wordpress/');
define('WP_SITEURL', 'http://celulares.local/wordpress/');
define('DB_NAME', 'hayemple_celu');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '-|0uuYO6vM:_tHFQirvA#d&+vzxVP;Bm^7vdMZ@h(xK4+:!dk1hAC**+7Jzw+3T;');
define('SECURE_AUTH_KEY',  '6lW?6lF0+#DF&Rv)SLEw}_AuYTqv`h!b8<q|X}}J8#^<+{5&aF|U/-++oUUX]bTm');
define('LOGGED_IN_KEY',    '2Hu+OWNfier`6X`11S]E0)JGg: -[%qDm2L$JS!Vy<J]uK75VGiCfM? /OMt|S$h');
define('NONCE_KEY',        'F@.e9+m]/wGpJ.`IP|JSX$#m7|ME|4/DqeHE&8[jcG;8Gv~qEU2w?eY!qQgZS-*B');
define('AUTH_SALT',        '}n*N8h2Go+7V:Mb(0pGnWNrOI]xYOB5uaB.Q%wM%]tEx+.-$tWt3u3P<R>|m}Z1V');
define('SECURE_AUTH_SALT', '&#N9DH<j(E:HLhF~J~-2VXkDK3u$+20[`2Mgy*1W |E- Z6b9/WPYTe +=nYAEs~');
define('LOGGED_IN_SALT',   '+3vDgFWLm6_l$g^}lia{br1/N,vOn}yro>>2+;2D=e(AkfL7Q<Iftm+P$D1lfeQ?');
define('NONCE_SALT',       'DY;:GL  Psi5|dKfB;Gl*%8d?|n4%51o/PpgSdY<uv#<-)C:%z~Z*Cn|1t(I5&8Z');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
