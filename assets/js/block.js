/**
 * Gutenberg block for the Unstoppable Voting shortcode.
 *
 * Added in 2.2.0. Wraps [uvpe_poll id="N"] with a picker so authors don't
 * have to copy-paste shortcodes. Rendering is server-side via WP.ServerSideRender
 * in the editor and do_shortcode() in production — the shortcode handler
 * stays the single source of truth for poll markup.
 */

( function ( wp ) {
	'use strict';

	var blocks           = wp.blocks;
	var element          = wp.element;
	var blockEditor      = wp.blockEditor || wp.editor;
	var components       = wp.components;
	var i18n             = wp.i18n;
	// ServerSideRender moved out of wp.components into its own package at WP 5.3.
	var ServerSideRender = wp.serverSideRender ||
		( components && components.ServerSideRender );

	if ( ! blocks || ! element || ! components || ! ServerSideRender ) {
		return;
	}

	var el                = element.createElement;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody         = components.PanelBody;
	var SelectControl     = components.SelectControl;
	var Placeholder       = components.Placeholder;
	var Button            = components.Button;
	var __                = i18n.__;

	var data   = window.uvpeBlockData || { polls: [], i18n: {} };
	var labels = data.i18n || {};

	blocks.registerBlockType( 'unstoppable-solutions/uvpe-poll', {
		apiVersion: 2,
		title: __( 'Poll (Unstoppable Voting)', 'unstoppable-voting-polls-elections' ),
		description: __(
			'Insert one of your polls. Visitors see the same vote form they would with the [uvpe_poll] shortcode.',
			'unstoppable-voting-polls-elections'
		),
		icon: 'chart-bar',
		category: 'widgets',
		keywords: [
			__( 'poll', 'unstoppable-voting-polls-elections' ),
			__( 'vote', 'unstoppable-voting-polls-elections' ),
			__( 'election', 'unstoppable-voting-polls-elections' ),
			__( 'survey', 'unstoppable-voting-polls-elections' )
		],
		supports: {
			html: false,
			align: [ 'wide', 'full' ]
		},
		attributes: {
			pollId: {
				type: 'number',
				'default': 0
			}
		},

		edit: function ( props ) {
			var pollId = props.attributes.pollId || 0;
			var polls  = data.polls || [];

			// Build the SelectControl options — a prompt row plus every poll.
			var options = [
				{ value: 0, label: labels.selectPrompt || 'Select a poll…' }
			];
			polls.forEach( function ( p ) {
				options.push( {
					value: parseInt( p.value, 10 ),
					label: p.label
				} );
			} );

			var picker = el( SelectControl, {
				label: __( 'Poll', 'unstoppable-voting-polls-elections' ),
				value: pollId,
				options: options,
				onChange: function ( next ) {
					props.setAttributes( { pollId: parseInt( next, 10 ) || 0 } );
				}
			} );

			var sidebar = el(
				InspectorControls,
				{},
				el(
					PanelBody,
					{
						title: __( 'Poll Settings', 'unstoppable-voting-polls-elections' ),
						initialOpen: true
					},
					picker,
					data.adminUrl
						? el(
							Button,
							{
								variant: 'link',
								href: data.adminUrl,
								target: '_blank'
							},
							labels.openAdmin || 'Open Polls admin'
						)
						: null
				)
			);

			var body;
			if ( pollId > 0 ) {
				body = el( ServerSideRender, {
					block: 'unstoppable-solutions/uvpe-poll',
					attributes: { pollId: pollId }
				} );
			} else {
				body = el(
					Placeholder,
					{
						icon: 'chart-bar',
						label: labels.blockLabel || 'Unstoppable Voting Poll',
						instructions: polls.length > 0
							? ( labels.chooseLabel || 'Choose a poll to insert.' )
							: ( labels.noPollsLabel || 'No polls exist yet.' )
					},
					picker
				);
			}

			var blockProps = typeof blockEditor.useBlockProps === 'function'
				? blockEditor.useBlockProps()
				: { className: props.className };

			return el( 'div', blockProps, sidebar, body );
		},

		// Server-rendered — nothing to save on the client.
		save: function () {
			return null;
		},

		transforms: {
			from: [
				{
					type: 'shortcode',
					tag: 'uvpe_poll',
					attributes: {
						pollId: {
							type: 'number',
							shortcode: function ( attrs ) {
								return parseInt( attrs.named.id, 10 ) || 0;
							}
						}
					}
				}
			]
		}
	} );
} )( window.wp );
