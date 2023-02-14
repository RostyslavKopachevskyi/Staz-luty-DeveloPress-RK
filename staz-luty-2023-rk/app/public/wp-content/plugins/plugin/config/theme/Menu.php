<?php

namespace dp\config\theme;

/**
 * Place to declare menu
 */
class Menu {
	public function __construct() {
		add_action( 'init', [ $this, 'init_menus' ] );
	}

	/**
	 * Register menus for the website
	 */
	function init_menus(): void {
		register_nav_menu( 'primary-menu', __( 'Main menu', 'dp' ) );
		register_nav_menu( 'footer-menu', __( 'Footer menu', 'dp' ) );
	}
}
