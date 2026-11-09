<?php
/**
 * Plugin Name: Unstoppable Voting, Polls & Elections
 * Plugin URI: https://unstoppablesolutions.app/plugins/unstoppable-voting-polls-elections
 * Description: Run secure polls and formal elections in WordPress — board votes, officer elections, member surveys, tournament brackets, captain voting, and more. Five ballot templates, seven sort modes, and powerful duplicate-vote prevention. Built for organizations that take voting seriously.
 * Version: 2.2.2
 * Author: Unstoppable Solutions
 * Author URI: https://unstoppablesolutions.app
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: unstoppable-voting-polls-elections
 * Domain Path: /languages
 * Requires at least: 5.8
 * Tested up to: 7.1
 * Requires PHP: 7.4
 *
 * @package Unstoppable_Voting_Polls_Elections
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin constants.
define( 'UVPE_VERSION', '2.2.2' );
define( 'UVPE_PLUGIN_FILE', __FILE__ );
define( 'UVPE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'UVPE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'UVPE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'UVPE_PLUGIN_SLUG', 'unstoppable-voting-polls-elections' );
define( 'UVPE_TABLE_PREFIX', 'uvpe_' );

// Includes.
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-schema.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-activator.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-deactivator.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-poll.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-vote.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-templates.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-shortcode.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-admin.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-ajax.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-block.php';
require_once UVPE_PLUGIN_DIR . 'includes/class-uvpe-plugin.php';

// Activation / deactivation hooks.
register_activation_hook( __FILE__, array( 'UVPE_Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'UVPE_Deactivator', 'deactivate' ) );

/**
 * Bootstrap the plugin once WordPress is ready.
 */
function uvpe_init() {
	return UVPE_Plugin::get_instance();
}
add_action( 'plugins_loaded', 'uvpe_init' );
