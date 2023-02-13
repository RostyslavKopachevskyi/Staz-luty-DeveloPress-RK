<?php
/**
 * Helper for Taxonomy definitions
 */

namespace dp\core;

/**
 * Class register taxonomy.
 */
abstract class Taxonomy {
	/**
	 * Register taxonomy on init
	 */
	function __construct() {
		add_action( 'init', [ $this, 'register_taxonomy' ], 0 );
	}

	/**
	 * Get taxonomy configuration
	 *
	 * @return array
	 */
	abstract protected function get_configuration(): array;


	/**
	 * Get taxonomy name
	 *
	 * @return string
	 */
	abstract protected function get_name(): string;

	/**
	 * Get all post types
	 *
	 * @return array
	 */
	abstract protected function get_post_types(): array;

	/**
	 * Register taxonomy helper
	 */
	public function register_taxonomy(): void {
		register_taxonomy(
			$this->get_name(),
			$this->get_post_types(),
			$this->get_configuration()
		);

		$this->register_terms();
	}

	/**
	 * Add terms to taxonomy
	 */
	public function register_terms(): void {
	}
}
