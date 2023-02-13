<?php
/**
 * Register custom post type
 */

namespace dp\app\domains\projects;

use dp\core\Custom_Post_Type as Core_Custom_Post_Type;

/**
 * Projects custom post type definition
 */
class Custom_Post_Type extends Core_Custom_Post_Type {
	/**
	 * Configuration for the custom post types
	 *
	 * @return array
	 */
	protected function get_configuration(): array {
		return [
			'label'               => Constants::CUSTOM_POST_NAME,
			'rewrite'             => [
				'slug' => Constants::CUSTOM_POST_NAME,
			],
			'description'         => __( 'Projects', 'dp' ),
			'labels'              => [
				'name'         => _x( 'Projects', 'Post Type General Name', 'dp' ),
				'menu_name'    => __( 'Projects', 'dp' ),
				'add_new_item' => __( 'Add new project', 'dp' ),
			],

			'taxonomies'          => [ 'post_tag' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-performance',
			'can_export'          => false,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'show_in_rest'        => true,
			'publicly_queryable'  => false,
		];
	}

	/**
	 * Return name from the constants
	 *
	 * @return string
	 */
	protected function get_name(): string {
		return Constants::CUSTOM_POST_NAME;
	}
}
