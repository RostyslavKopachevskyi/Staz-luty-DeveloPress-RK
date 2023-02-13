<?php

namespace dp\config\theme;

/**
 * Theme general settings
 */
class General_Config {
	function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_support' ] );
	}

	/**
	 * Theme support
	 */
	function theme_support() {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'title-tag' );
		remove_theme_support( 'block-templates' );
	}
}
