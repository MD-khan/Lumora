<?php
/**
 * Singleton Trait
 *
 * Provides a Singleton implementation to ensure a class has only one instance.
 *
 * @package Lumora
 */

namespace Lumora\Inc\Traits;

trait Singleton {

	/**
	 * Protected class constructor to prevent direct object creation.
	 *
	 * This is meant to be overridden in the classes which implement
	 * this trait. Ideal for initializing class properties, hooking into
	 * actions and filters, etc.
	 */
	protected function __construct() {
	}

	/**
	 * Prevent object cloning.
	 */
	final protected function __clone() {
	}

	/**
	 * Prevent unserializing of the instance.
	 */
	final public function __wakeup() {
		throw new \Exception( "Cannot unserialize singleton" );
	}

	/**
	 * Retrieves the Singleton instance of the class.
	 *
	 * This method is final and not meant to be overridden.
	 *
	 * @return object Singleton instance of the class.
	 */
	final public static function get_instance() {

		/**
		 * Collection of instances.
		 *
		 * @var array
		 */
		static $instances = [];

		/**
		 * Get the called class name.
		 *
		 * @var string
		 */
		$called_class = get_called_class();

		if ( ! isset( $instances[ $called_class ] ) ) {

			$instances[ $called_class ] = new $called_class();

			/**
			 * Action hook triggered after the Singleton instance is initialized.
			 *
			 * Dependent components can hook into this to execute code upon initialization.
			 *
			 * @hook lumora_theme_singleton_init_{$called_class}
			 */
			do_action( sprintf( 'lumora_theme_singleton_init_%s', $called_class ) ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

		}

		return $instances[ $called_class ];
	}

} // End trait Singleton
