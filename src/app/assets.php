<?php
/**
 * This file contains all your assets information
 *
 * You have to require at least two of them - main.js and main.css, since they are defined in a theme core. However, you can rewrite file names here
 *
 * All working assets from resources compiled into public/
 * In order to bypass it include your CSS file into public/css folder and include it here
 *
 * @package WordPress
 * @subpackage Marusia
 * @since 1.0.0
 */

return [

	/**
	 * This is where all your inline styles are handled.
	 */
	'inline-css'  => [
		'marusia-main' => [
			'data'             => '', // Here where all your custom CSS will be loaded.
			'enqueue_callback' => '__return_false', // Just because we DON'T need we will set it to false.
		],
	],

	/**
	 * This is where all your inline scripts are handled.
	 */
	'inline-js'   => [
		'marusia-main' => [
			'data'             => '', // Here where all your custom CSS will be loaded.
			'position'         => 'after',
			'enqueue_callback' => '__return_false', // Just because we DON'T need we will set it to false.
		],
	],

	/**
	 * Localized script. You can pass data from PHP into JS by doing this
	 */
	'localize-js' => [
		'marusia-main' => [
			'name'             => 'options',
			'data'             => [
				'ajaxURL' => esc_url( admin_url( 'admin-ajax.php' ) ),
			],
			'enqueue_callback' => '',
		],
	],

	/**
	 * Deregister styles and scripts you don't want.
	 * Remember - handle is not id! So you should pass handle without '-css' or '-js
	 */
	'deregister'  => [
		'css' => [],
		'js'  => [],
	],
];
