<?php
/**
 * Autoloader file for the Lumora theme.
 *
 * @package Lumora
 */

namespace Lumora\Inc\Helpers;

/**
 * Autoloader function.
 *
 * Automatically loads PHP classes from the Lumora theme based on their namespaces and class names.
 *
 * @param string $resource Fully qualified class name.
 *
 * @return void
 */
function autoloader( $resource = '' ) {
	$resource_path  = false;
	$namespace_root = 'Lumora\\';
	$resource       = trim( $resource, '\\' );

	if ( empty( $resource ) || strpos( $resource, '\\' ) === false || strpos( $resource, $namespace_root ) !== 0 ) {
		// Not our namespace, bail out.
		return;
	}

	// Remove our root namespace.
	$resource = str_replace( $namespace_root, '', $resource );

	$path = explode(
		'\\',
		str_replace( '_', '-', strtolower( $resource ) )
	);

	/**
	 * Determine the type of resource path to deduce the correct file path.
	 */
	if ( empty( $path[0] ) || empty( $path[1] ) ) {
		return;
	}
 
    
	$directory = '';
	$file_name = '';

	if ( 'inc' === $path[0] ) {

		switch ( $path[1] ) {
			case 'traits':
				if ( isset( $path[2] ) ) {
					$directory = 'traits';
					$file_name = sprintf( 'trait-%s', trim( strtolower( $path[2] ) ) );
				}
				break;

			case 'widgets':
			case 'blocks': // phpcs:ignore PSR2.ControlStructures.SwitchDeclaration.TerminatingComment
				/**
				 * If a class name is provided for a specific directory, load that.
				 * Otherwise, find it in the inc/ directory.
				 */
				if ( isset( $path[2] ) && ! empty( $path[2] ) ) {
					$directory = sprintf( 'classes/%s', $path[1] );
					$file_name = sprintf( 'class-%s', trim( strtolower( $path[2] ) ) );
					break;
				}
				// Fall through to default if no specific class name is provided.

			default:
				$directory = 'classes';
				$file_name = sprintf( 'class-%s', trim( strtolower( $path[1] ) ) );
				break;
		}

		$resource_path = sprintf( '%s/inc/%s/%s.php', untrailingslashit( LUMORA_DIR_PATH ), $directory, $file_name );

		// Log the attempted file path.
		error_log( 'Autoloader attempting to load: ' . $resource_path );
	}

	/**
	 * Validate the file path.
	 * $is_valid_file is 0 for valid paths or 2 if the file path contains a Windows drive path.
	 */
	$is_valid_file = validate_file( $resource_path );

	if ( ! empty( $resource_path ) && file_exists( $resource_path ) && ( 0 === $is_valid_file || 2 === $is_valid_file ) ) {
		// File exists and is valid, include it.
		require_once( $resource_path ); // phpcs:ignore
		error_log( 'Autoloader successfully loaded: ' . $resource_path );
	} else {
		// Log failure to load.
		error_log( 'Autoloader failed to load: ' . $resource_path );
	}
}

spl_autoload_register( '\\Lumora\\Inc\\Helpers\\autoloader' );
