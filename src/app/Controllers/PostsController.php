<?php
/**
 * Controller for all posts
 *
 * This class will handle actions with posts
 *
 * @package WordPress
 * @subpackage Marusia
 * @since 1.0.0
 */

namespace App\Controllers;

class PostsController
{

	/**
	 * Will handle AJAX request for load more posts.
	 *
	 * Remember! All AJAX functions should be ended with wp_die() to work properly!
	 */
	public static function load() {
		echo 'Posts are loaded';
		wp_die();
	}
}
