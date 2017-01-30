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
define('DB_NAME', 'DCT02');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '6cnS?Fn+OO(:UX_$lRefc&t+BL*z2a]a#^[VlJ _7DsqgUiqL9h&)A#o2jQNm<AT');
define('SECURE_AUTH_KEY',  '&REZjb5Cio,$#}Ht@^`?&4~E3[R?w./=&&AO-Gk4UhpUhxE.th`CinL>8XxriU J');
define('LOGGED_IN_KEY',    'X@P-fE(d6Ivesbjy{)4((zP)7~3lIQ4%~3OfouhJK7(S%p;eyDvDT5/u#s1X[])G');
define('NONCE_KEY',        '5CKXF1C@n}dvh#n:2Y(+@W% +,:}w^<~Zc.%&8VA<UvX]vmUP8Q,^;sn@M+[<d|;');
define('AUTH_SALT',        'H+lWN`FyJdszi,WB9B&T,MScK&_O0V8Suj^3!8l[9M[>BCk[NrT0xf0e(`qmLhv5');
define('SECURE_AUTH_SALT', 'ybdU#)%q nig|>7lRD;D%mHnu)~cG1]TuaW.^/7vtwKomYY=$-Ziq!c@i$|G)NwL');
define('LOGGED_IN_SALT',   'X>#vp4_YJgc]o%9}6g^a# ^)3 >c@U+D,T;| m&$V|#,`_ z9Myuc4v.4G r8;:h');
define('NONCE_SALT',       'k$[`iYDUK GYQ9|/Ft~F{3BuFOTqgk$_d$Ofc48%g[<_mfXaU5}>;Pc.|kw;SC_M');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'SERVMASK_PREFIX_';

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
define('WP_DEBUG', true);

// Site URL
define('WP_HOME','http://localhost:8888');
define('WP_SITEURL','http://localhost:8888');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
