<?php
/**
 * Gutenberg Block: Poll picker.
 *
 * Registers a block that wraps the existing [uvpe_poll id="N"] shortcode so
 * authors can pick a poll from a dropdown in the editor instead of pasting
 * shortcodes. Rendering is server-side via do_shortcode(), so the block
 * always stays in sync with whatever the shortcode does on the frontend.
 *
 * @package Unstoppable_Voting_Polls_Elections
 * @since   2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block registration + render callback.
 */
class UVPE_Block {

	/**
	 * Hook into WordPress.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_block' ) );
	}

	/**
	 * Register the block type on init.
	 *
	 * Guarded so the plugin stays usable on older WP where block registration
	 * doesn't exist (even though our minimum is 5.8, the guard is cheap
	 * insurance against hosts running wildly old cores).
	 */
	public function register_block() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		wp_register_script(
			'uvpe-block',
			UVPE_PLUGIN_URL . 'assets/js/block.js',
			array( 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-components', 'wp-block-editor', 'wp-server-side-render' ),
			UVPE_VERSION,
			true
		);

		wp_register_style(
			'uvpe-block-editor',
			UVPE_PLUGIN_URL . 'assets/css/block-editor.css',
			array(),
			UVPE_VERSION
		);

		// Pass the list of polls to the editor so the Poll dropdown can render
		// without a round-trip. Cheap: one query, run per editor load.
		$polls = UVPE_Poll::get_all();
		$poll_options = array();
		if ( is_array( $polls ) ) {
			foreach ( $polls as $poll ) {
				if ( empty( $poll->id ) ) {
					continue;
				}
				$poll_options[] = array(
					'value' => (int) $poll->id,
					'label' => isset( $poll->name ) ? (string) $poll->name : '',
				);
			}
		}

		wp_localize_script(
			'uvpe-block',
			'uvpeBlockData',
			array(
				'polls'   => $poll_options,
				'adminUrl' => esc_url_raw( admin_url( 'admin.php?page=uvpe-polls' ) ),
				'i18n'    => array(
					'selectPrompt' => __( 'Select a poll…', 'unstoppable-voting-polls-elections' ),
					'noPollsLabel' => __( 'No polls exist yet. Create one from the Polls admin screen first.', 'unstoppable-voting-polls-elections' ),
					'chooseLabel'  => __( 'Choose a poll from the sidebar to insert it here.', 'unstoppable-voting-polls-elections' ),
					'blockLabel'   => __( 'Unstoppable Voting Poll', 'unstoppable-voting-polls-elections' ),
					'openAdmin'    => __( 'Open Polls admin', 'unstoppable-voting-polls-elections' ),
				),
			)
		);

		register_block_type(
			'unstoppable-solutions/uvpe-poll',
			array(
				'api_version'     => 2,
				'editor_script'   => 'uvpe-block',
				'editor_style'    => 'uvpe-block-editor',
				'render_callback' => array( $this, 'render_block' ),
				'attributes'      => array(
					'pollId' => array(
						'type'    => 'number',
						'default' => 0,
					),
				),
			)
		);
	}

	/**
	 * Server-side render: delegate to the existing shortcode.
	 *
	 * Keeps rendering in one place (UVPE_Shortcode). Any future change to
	 * [uvpe_poll] automatically appears in the block too.
	 *
	 * @param array $attributes Block attributes.
	 * @return string
	 */
	public function render_block( $attributes ) {
		$poll_id = isset( $attributes['pollId'] ) ? absint( $attributes['pollId'] ) : 0;
		if ( $poll_id <= 0 ) {
			return '';
		}

		return do_shortcode( '[uvpe_poll id="' . $poll_id . '"]' );
	}
}
