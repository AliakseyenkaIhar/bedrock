<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Marusia
 * @since Marusia 1.0.0
 */

use Marusia\Routes\View;

defined( 'ABSPATH' ) || exit;

/**
 * By calling this we define global context.
 * If you want add some extra use set_context() or with_context() methods.
 */
$view = new View();

/**
 * After context is set let's render the view. 
 * It is complex property which will handle both singular and archive files. Call index() or singular() methods, if you want specific one
 */
$view->load();
