<?php
/**
 * Register content - Custom Post Types and Taxonomies
 */

namespace dp\core;

/**
 * Class for the content module
 */
abstract class Content_Module {
	/**
	 * Register CPT and Taxonomies
	 */
	function __construct() {
		$this->register_custom_post_types();
		$this->register_taxonomies();
	}

	/**
	 * Register Custom Post Types
	 */
	public function register_custom_post_types(): void {
	}

	/**
	 * Register taxonomy
	 */
	public function register_taxonomies(): void {
	}
}
