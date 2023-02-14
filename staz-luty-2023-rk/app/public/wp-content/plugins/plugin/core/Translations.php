<?php
/**
 * Define how to deal with translations in the project
 */

namespace dp\core;

/**
 * Class for translate
 */
class Translations {
	/**
	 * Init plugin and theme translations
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'translate_plugin' ] );
		add_action( 'after_setup_theme', [ $this, 'load_theme_translation' ] );
	}

	/**
	 * Translate plugin
	 */
	function translate_plugin(): void {
		load_plugin_textdomain( 'dp', false, dirname( plugin_basename( __FILE__ ) ) . '/../app/assets/i18n' );
	}

	/**
	 * Load translations for the theme
	 */
	function load_theme_translation() {
		load_theme_textdomain( 'dp', dirname( plugin_basename( __FILE__ ) ) . '/../app/assets/i18n' );
	}
}
