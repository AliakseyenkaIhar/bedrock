<?php
/**
 * Message post type model
 *
 * @package WordPress
 * @subpackage Marusia
 * @since 1.0.0
 */

namespace App\Models;

use Carbon_Fields\Field;
use Carbon_Fields\Container;
use Core\Models\PostType as Model;

class Message extends Model
{
	/**
	 * Post type name
	 *
	 * @var string
	 */
	protected $name = 'message';

	/**
	 * Set arguments for post type
	 *
	 * @return array | arguments.
	 */
	protected function set_args() {
		return [
			'labels'              => [
				'name'          => esc_html__( 'Messages', 'marusia' ),
				'singular_name' => esc_html__( 'Message', 'marusia' ),
				'menu_name'     => esc_html__( 'Messages', 'marusia' ),
			],
			'menu_icon'           => 'dashicons-email-alt',
			'has_archive'         => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'supports'            => [ 'title' ],
		];
	}

	/**
	 * Create post type metaboxes.
	 */
	public function create_meta() {
		$this->set_meta_container( 'marusia_message_container', esc_html__( 'Message fields', 'aliha' ) )
			->add_fields(
				[
					Field::make( 'text', 'marusia_message_name', esc_html_x( 'Name', 'Meta field title', 'aliha' ) )
						->set_width( 33 ),
					Field::make( 'text', 'marusia_message_email', esc_html_x( 'Email', 'Meta field title', 'aliha' ) )
						->set_width( 33 ),
					Field::make( 'text', 'marusia_message_phone', esc_html_x( 'Phone number', 'Meta field title', 'aliha' ) )
						->set_width( 33 ),
					Field::make( 'textarea', 'marusia_message_body', esc_html_x( 'Message body', 'Meta field title', 'aliha' ) ),
				]
			);
	}
}
