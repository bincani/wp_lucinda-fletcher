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

/** make it so wordpress lives in the wordpress subfolder */
define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['SERVER_NAME']);
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content');

/** see wp-content/themes */
define('WP_DEFAULT_THEME', 'rhythm');

/**
 * environment related settings e.g. dev OR prod
 * used if you want to directly include an environment config (e.g. while in dev)
 * otherwise this file is never changed only the wp-config-ENV.php files
 * while wp-config-env.php is linked to the actual config via capistrano
 */
# define('WP_DEFAULT_ENV', 'dev');
if ( defined('WP_DEFAULT_ENV') )
	require_once(dirname(dirname(__FILE__)) . '/wp-config-' . WP_DEFAULT_ENV . '.php');
else
	require_once(dirname(dirname(__FILE__)) . '/wp-config-env.php');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eFwgYHZldpg1aHXlYPwiQxfNhJFxsBr82SCRZ5gzTAWfOCHOnKsCqvYyNQ6fRemT');
define('SECURE_AUTH_KEY',  'WT7P1aIk5l9A9pfLPnN5OpGxxQujYdGW0OrXTLbapoW0eDQf89YZa7onQlF0L6u8');
define('LOGGED_IN_KEY',    'IEXm4XllRrmp9CdjwBsLFz4WqwYFX6I4Y6jDniOYyUxxGyL5u07NfVzKvbTgQNK0');
define('NONCE_KEY',        'iMkPD1xfFQTep7BON5oV8FTolKUSNAuP1vpE7MLJJxlJVGtVIRWxVAnb3BMWri6N');
define('AUTH_SALT',        'w1btMc4EdnwCGBXH2pWQbiWtsWCyA590uT0KzGG2yb72ndYrWVIJj6iC4dbZ1ym9');
define('SECURE_AUTH_SALT', 'vf7hCFqHhz6ELdI2yg8CQB7jhVWJ5xQ66mx1nlGl25uKsaSkJE7HGgVlq1kwQZUB');
define('LOGGED_IN_SALT',   'bChzSvJc6cGvG7spPEr8yKlQVPymaWlmwxNeWCBaGQny8NQbAbzEaUnx2Dzf6UOv');
define('NONCE_SALT',       'OAJGA5CfC89o3wxqfXOpYjCDHUREOYDeRn1io0os4za1samHNZMyGAEZLI6dlDFM');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/** WordPress Localized Language, defaults to English. */
define('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
