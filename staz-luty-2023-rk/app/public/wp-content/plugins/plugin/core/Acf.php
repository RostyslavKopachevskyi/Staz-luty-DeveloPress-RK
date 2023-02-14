<?php
/**
 * Plugin extension and configuration for ACF plugin
 */

namespace dp\core;

/**
 * Class for ACF configuration and extension
 */
class Acf {
	/**
	 * Run specific filters
	 */
	public function __construct() {
		add_action( 'acf/init', [ $this, 'acf_init' ] );

		add_filter( 'acf/settings/save_json', [ $this, 'path_to_save_json' ] );
		add_filter( 'acf/settings/load_json', [ $this, 'path_to_load_json' ] );
	}

	/**
	 * Show ACF in admin menu only if WordPress is in local mode: WP_ENVIRONMENT_TYPE === 'local'.
	 *
	 * In other words, please set in `wp-config.php` constant `define( 'WP_ENVIRONMENT_TYPE', 'local' );`
	 * if you want to edit ACF
	 */
	function acf_init(): void {
		if ( wp_get_environment_type() !== 'local' ) {
			acf_update_setting( 'show_admin', false );
		}
	}

	/**
	 * Save ACF configuration locally in JSON file.
	 *
	 * @param string $path The place to locate acf-json files.
	 *
	 * @return  string   The place to locate acf-json files
	 */
	function path_to_save_json( string $path ): string {
		if ( wp_get_environment_type() === 'local' ) {
			return plugin_dir_path( __FILE__ ) . '../app/assets/acf-json';
		}

		return $path;
	}

	/**
	 * Save ACF configuration locally in JSON file.
	 *
	 * @param array $paths The place to locate acf-json files.
	 *
	 * @return array The place to locate acf-json files
	 */
	function path_to_load_json( array $paths ): array {
		unset( $paths[0] );
		$paths[] = plugin_dir_path( __FILE__ ) . '../app/assets/acf-json';

		return $paths;
	}
}


