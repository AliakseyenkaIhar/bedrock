<?php
/**
 * Bootstrap application
 *
 * @package WordPress
 * @subpackage Marusia
 * @since 1.0.0
 */

/**
 * Make sure composer is installed
 */
$autoload = __DIR__ . './../../vendor/autoload.php';
if ( file_exists( $autoload ) ) {

    require_once $autoload;

    /**
     * Where your twig templates located
     *
     * Folder resources/views - resources folder contains your working files.
     * File base.twig compiles into index.twig file inside public directory so it should be included also
     * Index.twig - is an entry point for your whole project!
     */
    $dirname = apply_filters(
       'marusia_views_folder',
       [ 'public/views' ]
    );

    /**
     * By default Timber DOES not autoescape values
     *
     * So it's up to you decide do you need this behaviour or not
     */
    $autoescape = apply_filters(
        'marusia_autoescape',
        false
    );

    /**
     * Run application
     */
    Marusia\Marusia::set( $dirname, $autoescape )->run();
}
