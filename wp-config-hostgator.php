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
define( 'WPCACHEHOME', '/home2/radiofq1/public_html/map/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'radiofq1_wrdp1');


/** MySQL database username */
define('DB_USER', 'radiofq1_wrdp1');


/** MySQL database password */
define('DB_PASSWORD', 'wuUQWuhVLbyhBVmZ');


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
define('AUTH_KEY',         '>8)@:1508JvCbOF|FHfuqU0*OD?V~T?vge@FRNYfgrMV4$WGVSJwQc_w7h~8GXDDC\`=:7!XJBEX9CQ:');
define('SECURE_AUTH_KEY',  'Y1i^uypj5#WgzU)H<QINnjsl!0EBRS)zjRAv9rBeD60|!hdX8#hptS7O~W');
define('LOGGED_IN_KEY',    '8aN:n/Zi!JY:)@HQjR0bbuurn6-0Ahm3-<WcnumE<tBIwr*GPC$f~):nX*RQy~@D7g5#R($:');
define('NONCE_KEY',        'P:HXr-Oh0~z=J!X8fsRr5Wx/FcJ4>Tk7c?ZxNMeI^BRCicsMhPo\`ZCAI5tRJmt8*v');
define('AUTH_SALT',        'pYVxI/v\`=0x1oOv3c~wDteA:?>|5EEWDNzvq^=t>~y(Q1#JXwz~^rbccD<Bxw2)6EOUSPW*w');
define('SECURE_AUTH_SALT', 'wt*/fjO3CTii$LHWa*!:-JTt_ysN)rT-7Li>hYx#X=Clt_RabpTGL:dJpyavMAnvZN|lb!3hdw~4');
define('LOGGED_IN_SALT',   'S$@h6ta*j8?H;ZhrW#Z_U\`^C^ZaAKR_@bPcjPsDINZ^-T6YhhJ@s-snodu1y;KM6EFAP~');
define('NONCE_SALT',       'k$uz/xUigHCn2EmQgHo$q=)zzm8NBD4inF=0Wk#ux7!MB2_HD(m\`jvam$aFd15*s9:l>o?2mLnu<*~moS@a');

/**#@-*/
define('AUTOSAVE_INTERVAL', 600 );
define('WP_POST_REVISIONS', 1);
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
define( 'WP_AUTO_UPDATE_CORE', true );
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ver_';


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
//add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );
