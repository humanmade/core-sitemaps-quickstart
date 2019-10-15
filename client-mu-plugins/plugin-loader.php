<?php
/**
 * Load plugins.
 */

$mu_plugins = [
	'hm-autoloader.php',
];

define( 'CLIENT_MU_PLUGIN_DIR', __DIR__ );

$autoload = CLIENT_MU_PLUGIN_DIR . '/vendor/autoload.php';
if ( ! file_exists( $autoload ) ) {
	die( 'Composer dependencies have not been installed.' );
}

require_once $autoload;

// client-mu-plugins/
foreach ( $mu_plugins as $filename ) {
	require_once CLIENT_MU_PLUGIN_DIR . '/' . $filename;
}
