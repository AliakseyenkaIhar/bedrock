<?php
/**
 * Configuration file for our application
 *
 * ! DO NOT CHANGE VARIABLE'S NAME!
 *
 * @package WordPress
 * @subpackage Marusia
 * @since 1.0.0
 */

/**
 * Theme path - base path for all other
 */
$mt_path = trailingslashit( get_template_directory() );
$mt_uri  = trailingslashit( get_template_directory_uri() );

return [

	/**
	 * Theme constants
	 *
	 * To use constant inside twig-files simply write like this:
	 * {{ constant('MT_IMG_PATH') }} - this will return absolute path to img folder inside resources
	 */
	'definitions' => apply_filters(
		'marusia_theme_definitions',
		[
			'MT_THEME_URI'   => $mt_uri,
			'MT_PUBLIC_URI'  => $mt_uri . 'public/',
			'MT_PUBLIC_PATH' => $mt_path . 'public/',
			'MT_CSS_URI'     => $mt_uri . 'public/css/',
			'MT_JS_URI'      => $mt_uri . 'public/js/',
			'MT_ASSETS_URI'  => $mt_uri . 'resources/',
			'MT_IMG_URI'     => $mt_uri . 'resources/img/',
			'MT_APP_PATH'    => ROOT_DIR . '/src/app/',
		]
	),

	/**
	 * Logo
	 *
	 * This setting will define logo sizes
	 */
	'logo' => apply_filters(
		'marusia_logo_sizes',
		[
			'width'  => 100,
			'height' => 100,
		],
	),

	/**
	 * Background image settings.
	 *
	 * This image is used to display body's background image
	 */
	'background_image' => apply_filters(
		'marusia_background_image',
		[
			'default-color' => '',
			'default-image' => '',
		],
	),

	/**
	 * Header image settings.
	 *
	 * This image is used to display header offer background image (or video)
	 */
	'header_image' => apply_filters(
		'marusia_header_image',
		[
			'width'       => 1920,
			'height'      => 1080,
			'flex-height' => false,
			'flex-width'  => true,
			'header-text' => true, // show tagline or not.
		],
	),

	/**
	 * Image sizes.
	 * Custom image size. Params are the same as for add_image_size
	 */
	'image_sizes' => apply_filters(
		'marusia_image_sizes',
		[
			[ 'marusia-preview', 1170, 400, false ], // this will add new size 1170*400.
		],
	),

	/**
	 * Theme menus
	 *
	 * By default Marusia provides 2 menus - primary (in a header navigation panel) and social (for social links)
	 * Sometimes there is a need for a footer menu but we decided to not include it - it may be handled by widgets
	 * Anyway if there are some needs in a new menu - feel free to add it here or remove
	 * Same parameters as for register_nav_menus()
	 *
	 * It will be automatically added to a global context
	 * For ex, Primary will be available as primary_menu in a global context - {{ primary_menu }}
	 */
	'menus' => apply_filters(
		'marusia_theme_menus',
		[
			'primary' => esc_html__( 'Primary menu', 'marusia' ),
			'social'  => esc_html__( 'Social menu', 'marusia' ),
		]
	),

	/**
	 * Custom templates for pages.
	 * No need to create empty template.php file - just pass information wright here
	 *
	 * Template file should be listed in templates/template.YOUR_SLUG.twig file.
	 * YOUR_SLUG must be the same as slug in array of arguments.
	 */
	'templates' => apply_filters(
		'marusia_custom_templates',
		[
			[
				'slug'  => 'about',
				'label' => esc_html_x( 'About', 'template label', 'marusia' ),
			],
			[
				'slug'  => 'contacts',
				'label' => esc_html_x( 'Contacts', 'template label', 'marusia' ),
			],
		],
	),
];
