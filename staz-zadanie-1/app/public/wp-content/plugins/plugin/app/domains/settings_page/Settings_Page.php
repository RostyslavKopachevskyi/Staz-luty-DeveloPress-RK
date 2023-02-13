<?php
/**
 * Settings page with the most common settings
 */

namespace dp\app\domains\settings_page;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add settings pages
 */
class Settings_Page {
	/**
	 * Options page from ACF
	 */
	public function __construct() {
		$this->acf_options_page();
	}

	/**
	 * ACF - register new page options
	 */
	function acf_options_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				[
					'page_title' => __( 'Global config', 'dp' ),
					'menu_title' => __( 'Global config', 'dp' ),
					'menu_slug'  => 'global-config',
					'capability' => 'edit_posts',
					'redirect'   => false,
				]
			);
		};
	}
}
