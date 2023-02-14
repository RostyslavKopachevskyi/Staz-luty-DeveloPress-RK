<?php
/**
 * Declaration for Custom Post Type
 */

namespace dp\core;

/**
 * Class register custom post types.
 */
abstract class Custom_Post_Type {
	/**
	 * Get configuration for the CPT
	 *
	 * @return array
	 */
	abstract protected function get_configuration(): array;

	/**
	 * Get the name of the CPT
	 *
	 * @return string
	 */
	abstract protected function get_name(): string;

	/**
	 * Class construct function.
	 */
	function __construct() {
		add_action( 'init', [ $this, 'register_post_type' ], 0 );
	}

	/**
	 * Register post type helper
	 */
	public function register_post_type(): void {
		register_post_type(
			$this->get_name(),
			$this->get_configuration()
		);
	}
}
