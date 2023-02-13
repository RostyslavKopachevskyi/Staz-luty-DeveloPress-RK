<?php

namespace dp\config\theme;

/**
 * Assets management (CSS, JS, Global Variables)
 */
class Assets {
	public function __construct() {
		add_action( 'wp_head', [ $this, 'preload_fonts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'jquery_from_header_to_footer' ] );
		add_filter( 'script_loader_tag', [ $this, 'defer_js_parsing' ], 10 );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_js' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'localize_scripts' ] );
		add_action( 'wp_default_scripts', [ $this, 'delete_jquery_migrate' ] );
		add_action( 'wp_head', [ $this, 'add_code_to_header' ], 1 );
		add_action( 'wp_footer', [ $this, 'add_code_to_footer' ], 0 );
		$this->delete_not_required_stuff();
	}

	/**
	 * Force web browser to pre-fetch required fonts
	 *
	 * @return void
	 */
	function preload_fonts() {
		// todo: configure fonts to preload.
		echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( '/assets/fonts/Brown/Brown-Light.woff2' ) ) . '" as="font" type="font/woff2" crossorigin>';
		echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( '/assets/fonts/Brown/Brown-Regular.woff2' ) ) . '" as="font" type="font/woff2" crossorigin>';
		echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( '/assets/fonts/Brown/Brown-LightItalic.woff2' ) ) . '" as="font" type="font/woff2" crossorigin>';
		echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( '/assets/fonts/Sang-Bleu-Kingdom/SangBleuKingdom-Italic.woff2' ) ) . '" as="font" type="font/woff2" crossorigin>';
		echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( '/assets/fonts/Sang-Bleu-Kingdom/SangBleuKingdom-Light.woff2' ) ) . '" as="font" type="font/woff2" crossorigin>';
		echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( '/assets/fonts/Sang-Bleu-Kingdom/SangBleuKingdom-LightItalic.woff2' ) ) . '" as="font" type="font/woff2" crossorigin>';
		echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( '/assets/fonts/Sang-Bleu-Kingdom/SangBleuKingdom-Regular.woff2' ) ) . '" as="font" type="font/woff2" crossorigin>';
	}

	/**
	 * Defer parsing JS
	 *
	 * @param string $url Link to resource.
	 *
	 * @return array|string|string[]
	 */
	function defer_js_parsing( string $url ) {
		if ( is_user_logged_in() ) {
			return $url;
		} //don't break WP Admin

		if ( false === strpos( $url, '.js' ) ) {
			return $url;
		}
		if ( strpos( $url, 'jquery.js' ) ) {
			return $url;
		}

		return str_replace( ' src', ' defer src', $url );
	}

	/**
	 * Move jQuery from header to footer
	 */
	public function jquery_from_header_to_footer() {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, null, true );
		wp_enqueue_script( 'jquery' );
	}

	/**
	 * Delete annoying message about jquery migrate
	 *
	 * @param object $scripts List of scripts.
	 */
	public function delete_jquery_migrate( object $scripts ) {
		if ( ! empty( $scripts->registered['jquery'] ) ) {
			$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, [ 'jquery-migrate' ] );
		}
	}

	/**
	 * Delete stuff which is mostly not used on websites
	 */
	public function delete_not_required_stuff() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		remove_action( 'wp_head', 'wp_generator' );

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}

	/**
	 * JS printed in the source code of the website - for sharing with loaded JS
	 */
	function localize_scripts(): void {
		global $wp_query;

		// name of this localize script have to be the same as in the wp_enqueue_script handle name.
		wp_localize_script(
			'common_js',
			'developress',
			[
				'rootUrl'     => get_site_url(),
				'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
				'nonce'       => wp_create_nonce( 'wp_ajax' ),
				'queryVars'   => wp_json_encode( $wp_query->query_vars ),
				'currentPage' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
				'max_page'    => $wp_query->max_num_pages,
				'env'         => wp_get_environment_type(),
			]
		);
	}

	/**
	 * Load external css files
	 */
	function add_styles(): void {
		wp_enqueue_style( 'normalize_css', get_parent_theme_file_uri( '/assets/normalize.css' ), [], wp_get_theme()->get( 'Version' ) );
		wp_enqueue_style( 'common_css', get_parent_theme_file_uri( '/assets/common.css' ), [ 'normalize_css' ], wp_get_theme()->get( 'Version' ) );
	}

	/**
	 * Load external JS files
	 */
	function add_js(): void {
		wp_enqueue_script(
			'common_js',
			get_parent_theme_file_uri( '/assets/common.js' ),
			[
				'jquery',
			],
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	/**
	 * Load JS scripts from options page to header
	 */
	public function add_code_to_header() {
		if ( function_exists( 'get_field' ) ) {
			$scripts = get_field( 'scripts', 'options' ) ?? false;
			// @codingStandardsIgnoreStart
			echo ! empty( $scripts && $scripts['header_scripts'] ) ? $scripts['header_scripts'] : '';
			// @codingStandardsIgnoreEnd
		}
	}

	/**
	 * Load JS scripts from options page to footer
	 */
	public function add_code_to_footer() {
		if ( function_exists( 'get_field' ) ) {
			$scripts = get_field( 'scripts', 'options' ) ?? false;
			// @codingStandardsIgnoreStart
			echo ! empty( $scripts && $scripts['footer_scripts'] ) ? $scripts['footer_scripts'] : '';
			// @codingStandardsIgnoreEnd
		}
	}
}
