<?php
/**
 * Register taxonomies
 */

namespace dp\app\domains\projects;

use dp\core\Taxonomy as Core_Taxonomy;

/**
 * Taxonomies definition
 */
class Taxonomy extends Core_Taxonomy {
	/**
	 * Trigger parent constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get the name of the current taxonomy
	 *
	 * @return string
	 */
	protected function get_name(): string {
		return Constants::TAXONOMY_NAME;
	}

	/**
	 * Get post types where this taxonomy should be used
	 *
	 * @return array
	 */
	protected function get_post_types(): array {
		return [ Constants::CUSTOM_POST_NAME ];
	}

	/**
	 * Configuration for the taxonomy
	 *
	 * @return array
	 */
	protected function get_configuration(): array {
		return [
			'label'                 => __( 'Companies', 'dp' ),
			'labels'                => [
				'name' => __( 'Companies', 'dp' ),
			],
			'public'                => false,
			'publicly_queryable'    => false,
			'hierarchical'          => false,
			'show_ui'               => false,
			'show_in_menu'          => false,
			'show_in_nav_menus'     => false,
			'query_var'             => false,
			'rewrite'               => [
				'slug'       => $this->get_name(),
				'with_front' => true,
			],
			'show_admin_column'     => false,
			'show_in_rest'          => false,
			'rest_base'             => $this->get_name(),
			'rest_controller_class' => 'WP_REST_Terms_Controller',
			'show_in_quick_edit'    => true,
		];
	}
}

