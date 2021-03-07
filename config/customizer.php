<?php
/**
 * List of all sections, panels and options for Customizer
 *
 * @package WordPress
 * @subpackage Marusia
 * @since 1.0.0
 */

return [

	/**
	 * List of panels
	 * Same parameters as for Kirki::add_panel()
	 */
	'panels'   => [

		/**
		 * All contact data panel
		 */
		'marusia_contact_data' => [
			'title' => esc_html__( 'Contact data', 'marusia' ),
		],

		/**
		 * List of custom sections
		 */
		'marusia_sections'     => [
			'title' => esc_html__( 'Sections', 'marusia' ),
		],
	],

	/**
	 * List of sections
	 * Getting two parameters - list of arguments for section and its options
	 */
	'sections' => [

		/**
		 * General contact information like address, phone number, email, etc.
		 */
		'marusia_general_contacts' => [
			'args'    => [
				'title' => esc_html__( 'General contacts', 'marusia' ),
				'panel' => 'marusia_contact_data',
			],
			'options' => [
				[
					'type'     => 'text',
					'settings' => 'marusia_general_contacts_phone',
					'label'    => esc_html__( 'Phone number', 'marusia' ),
				],
				[
					'type'     => 'text',
					'settings' => 'marusia_general_contacts_email',
					'label'    => esc_html__( 'Email', 'marusia' ),
				],
				[
					'type'     => 'textarea',
					'settings' => 'marusia_general_contacts_address',
					'label'    => esc_html__( 'Address', 'marusia' ),
				],
				[
					'type'     => 'textarea',
					'settings' => 'marusia_general_contacts_map_src',
					'label'    => esc_html__( 'Map source', 'marusia' ),
				],
			],
		],

		/**
		 * Breadcrumbs
		 */
		'marusia_breadcrumbs' => [
			'args'    => [
				'title' => esc_html__( 'Breadcrumbs', 'marusia' ),
			],
			'options' => [
				[
					'type'     => 'checkbox',
					'label'    => esc_html_x( 'Show breadcrumbs?', 'Customizer option', 'marusia' ),
					'default'  => false,
					'settings' => 'marusia_breadcrumbs_show',
				],
				[
					'type'            => 'text',
					'label'           => esc_html_x( 'Home title', 'Customizer option', 'marusia' ),
					'default'         => esc_html_x( 'Home', 'Customizer option default', 'marusia' ),
					'settings'        => 'marusia_breadcrumbs_front_title',
					'active_callback' => [
						[
							'setting'  => 'marusia_breadcrumbs_show',
							'operator' => '==',
							'value'    => true,
						],
					],
				],
				[
					'type'            => 'text',
					'label'           => esc_html_x( 'Blog title', 'Customizer option', 'marusia' ),
					'default'         => esc_html_x( 'Blog', 'Customizer option default', 'marusia' ),
					'settings'        => 'marusia_breadcrumbs_blog_title',
					'active_callback' => [
						[
							'setting'  => 'marusia_breadcrumbs_show',
							'operator' => '==',
							'value'    => true,
						],
					],
				],
				[
					'type'            => 'text',
					'label'           => esc_html_x( '404 title', 'Customizer option', 'marusia' ),
					'default'         => esc_html_x( '404!', 'Customizer option default', 'marusia' ),
					'settings'        => 'marusia_breadcrumbs_404_title',
					'active_callback' => [
						[
							'setting'  => 'marusia_breadcrumbs_show',
							'operator' => '==',
							'value'    => true,
						],
					],
				]
			],
		],

		/**
		 * Footer information.
		 */
		'marusia_section_footer'   => [
			'args'    => [
				'title' => esc_html__( 'Footer settings', 'marusia' ),
				'panel' => 'marusia_sections',
			],
			'options' => [
				[
					'type'     => 'textarea',
					'settings' => 'marusia_section_footer_copyrights',
					'label'    => esc_html__( 'Copyrights', 'marusia' ),
				],
			],
		],
	],

	/**
	 * List of options
	 * This settings are required inly for predefined WordPress sections (like title_tagline for example)
	 * Note YOU HAVE TO specify section in this case
	 */
	'options'  => [

		/**
		 * Logo in footer
		 */
		'marusia_footer_logo' => [
			'type'    => 'image',
			'label'   => esc_html__( 'Logo footer', 'marusia' ),
			'section' => 'title_tagline',
			'choices' => [
				'save_as' => 'id',
			],
		],

		/**
		 * Unlink logo on homepage
		 */
		'marusia_unlink_logo_on_home' => [
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Unlink logo on homepage', 'marusia' ),
			'section' => 'title_tagline',
			'default' => true,
		],
	],
];
