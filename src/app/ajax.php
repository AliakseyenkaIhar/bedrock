<?php
/**
 * Handle all your AJAX calls here
 *
 * Don't forget: all actions should be passed in Javascript handlers as 'action' parameter.
 *
 * @package WordPress
 * @subpackage Marusia
 * @since 1.0.0
 */

return [

	/**
	 * Name of the passed action and it's callback.
	 * Callback function inside PHP class should be called statically ('\\App\\Controllers\\PostsController::load')
	 *
	 * If not, just pass a string ('load')
	 *
	 * In this case we will handle Load more posts action
	 *
	 * ! Key value must be passed as an 'action' inside Javascript send request
	 */
	'marusia_load_posts_action' => '\\App\\Controllers\\PostsController::load',

];
