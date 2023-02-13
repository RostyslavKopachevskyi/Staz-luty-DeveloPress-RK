<?php
/**
 * Register all block patterns for the theme - something that we used to call block / module in the past
 */

/**
 * Registers block patterns
 */

require_once __DIR__ . '/Block_Pattern.php';

/**
 * List of blocks definition
 */
class Blocks_Patterns_Factory {
	/**
	 *  Set up configuration and register blocks
	 *
	 * @param array $blocks_to_register List of block that developers want to register.
	 */
	public function __construct( array $blocks_to_register ) {
		$this->register_blocks( $blocks_to_register );
	}

	/**
	 * Register all required block patterns
	 *
	 * @param array $blocks_to_register List of block that developers want to register.
	 */
	public function register_blocks( array $blocks_to_register ): void {
		$common_config = $this->get_common_config();

		foreach ( $blocks_to_register as $block_to_register ) {
			new Block_Pattern( $common_config, $block_to_register );
		}
	}

	/**
	 * Common configuration for all ACF block on the website
	 *
	 * May be overwritten with individual configuration in specific block
	 */
	function get_common_config(): array {
		$icon_path = __DIR__ . '/../../../../plugins/plugin/app/assets/img/block-logo.svg';

		return [
			'category' => 'theme',
			'icon'     => file_get_contents( $icon_path ),
			'keywords' => [],
		];
	}
}

