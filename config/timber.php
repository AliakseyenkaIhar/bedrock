<?php
return [
	/**
	 * Context
	 *
	 * Global context - it will be available anywhere in your theme except for some moments like widgets
	 */
	'ctx' => apply_filters(
		'marusia_global_context',
		[
			'queried'             => get_queried_object(),
			'display_header_text' => display_header_text(),
			'is_front'            => is_front_page(),
			'is_singular'         => is_singular(),
			'nonce'               => wp_create_nonce( 'aliha_nonce_action' ),
			'referer'             => Timber\URLHelper::get_current_url(),
		]
	),

	/**
	 * Local context
	 *
	 * It is useful when you want to create context that exists ONLY on certain page - for example (and mostly), only on front page
	 *
	 * callback must be an array - it is called via call_user_func, so to pass parameters it should be [ 'is_singular', 'post' ] which will be called as is_singular( 'post' )
	 */
	'local_ctx' => apply_filters(
		'marusia_local_context',
		[
			'front_sections' => [
				'value'    => [ 'offer' ],
				'callback' => [ 'is_front_page' ],
			],
		],
	),

	/**
	 * Twig functions
	 *
	 * @example svg('icon', 'classes')
	 */
	'twig_functions' => apply_filters(
		'marusia_twig_functions',
		[
			'svg' => 'mt_svg', // load SVG icon.
			'src' => 'mt_src', // get image path.
			'mod' => 'get_theme_mod',
			'breadcrumbs' => 'mt_breadcrumbs',
		]
	),

	/**
	 * Twig filters
	 *
	 * @example post|wp_trim_words(15)
	 */
	'twig_filters' => apply_filters(
		'marusia_twig_filters',
		[
			'antispambot'   => 'antispambot',
			'wp_trim_words' => 'wp_trim_words',
		]
	),

	/**
	 * View namespace
	 */
	'twig_namespaces' => apply_filters(
		'marusia_twig_namespaces',
		[
			'global'   => __DIR__ . './../resources/views/partials/global',
			'elements' => __DIR__ . './../resources/views/partials/elements', // @elements
		]
	),
];
