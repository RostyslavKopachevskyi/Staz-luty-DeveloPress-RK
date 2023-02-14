<?php
/**
 * Register "Projects" custom post type and taxonomies for that
 */

namespace dp\app\domains\projects;

use dp\core\Content_Module;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Projects content module definition
 */
class Projects extends Content_Module {
	/**
	 * Register CPT
	 */
	function register_custom_post_types(): void {
		new Custom_Post_Type();
	}

	/**
	 * Register taxonomy
	 */
	public function register_taxonomies(): void {
		new Taxonomy();
	}
}
