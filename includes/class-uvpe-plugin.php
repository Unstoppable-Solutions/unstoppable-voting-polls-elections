<?php
/**
 * Main Plugin Class.
 *
 * @package Unstoppable_Voting_Polls_Elections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The plugin bootstrap — wires up subsystems.
 */
class UVPE_Plugin {

	/**
	 * Singleton instance.
	 *
	 * @var UVPE_Plugin|null
	 */
	private static $instance = null;

	/**
	 * Get the singleton instance.
	 *
	 * @return UVPE_Plugin
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Wire up the subsystems.
	 */
	private function __construct() {
		// Run any pending schema migrations on load. Cheap: skips when up to date.
		add_action( 'plugins_loaded', array( 'UVPE_Schema', 'maybe_upgrade' ), 5 );

		new UVPE_Shortcode();
		new UVPE_Ajax();
		new UVPE_Block();

		if ( is_admin() ) {
			new UVPE_Admin();
		}

		/**
		 * Fires after the plugin's core subsystems are wired up.
		 *
		 * Add-ons (such as the Pro plugin) should hook here to register their
		 * own classes, taxonomies, REST routes, or admin pages.
		 *
		 * @since 2.1.0
		 */
		do_action( 'uvpe_loaded' );
	}

	/**
	 * Don't allow cloning.
	 */
	private function __clone() {}

	/**
	 * Don't allow unserialising.
	 */
	public function __wakeup() {}
}
