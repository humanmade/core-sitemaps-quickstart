<?php
/**
 * Plugin Name: PHP Autoloader
 * Description: Internal helper.
 * Author: Human Made Limited
 * Author URI: https://humanmade.com
 */

namespace HM\Autoloader;

/**
 * Class autoloader.
 */
class Autoloader {
	const NS_SEPARATOR = '\\';

	/**
	 * Internal property.
	 *
	 * @var string
	 */
	protected $prefix;
	/**
	 * Internal property.
	 *
	 * @var int
	 */
	protected $prefix_length;
	/**
	 * Internal property.
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * Instantiate a new autoloader.
	 *
	 * @param string $prefix The prefix, usually a namespace.
	 * @param string $path   The corresponding base file path.
	 */
	public function __construct( $prefix, $path ) {
		$this->prefix        = $prefix;
		$this->prefix_length = strlen( $prefix );
		$this->path          = trailingslashit( $path );
	}

	/**
	 * Autoload the given class.
	 *
	 * @param string $class The fully-qualified class name.
	 */
	public function load( $class ) {
		if ( strpos( $class, $this->prefix . self::NS_SEPARATOR ) !== 0 ) {
			return;
		}

		// Strip prefix from the start (ala PSR-4).
		$class = substr( $class, $this->prefix_length + 1 );
		$class = strtolower( $class );
		$file = '';
		$last_ns_pos = strripos( $class, self::NS_SEPARATOR );

		if ( false !== $last_ns_pos ) {
			$namespace = substr( $class, 0, $last_ns_pos );
			$class     = substr( $class, $last_ns_pos + 1 );
			$file      = str_replace( self::NS_SEPARATOR, DIRECTORY_SEPARATOR, $namespace ) . DIRECTORY_SEPARATOR;
		}
		$file .= 'class-' . str_replace( '_', '-', $class ) . '.php';

		$path = $this->path . $file;

		if ( file_exists( $path ) ) {
			require_once $path;
		}
	}
}

/**
 * Registers the base path to classes with the given prefix, usually a namespace.
 *
 * @param string $prefix The prefix, usually a namespace.
 * @param string $path   The corresponding base file path.
 */
function register_class_path( $prefix, $path ) {
	$loader = new Autoloader( $prefix, $path );
	spl_autoload_register( [ $loader, 'load' ] );
}
