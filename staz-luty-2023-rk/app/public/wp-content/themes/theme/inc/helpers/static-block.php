<?php
/**
 * Displaying static blocks
 */

if ( ! function_exists( 'get_static_acf_block' ) ) {
	/**
	 * Return content for an ACF block with a static data
	 * It may be used in most cases like a get_template_part() but for blocks
	 *
	 * @param string $block_name block name which should be rendered.
	 * @param array  $args arguments to use during rendering process.
	 *
	 * @return string
	 */
	function get_static_acf_block( string $block_name, array $args ): string {
		$final_args = [
			'blockName' => 'acf/' . $block_name,
			'attrs'     => [
				'name' => 'acf/' . $block_name,
				'data' => $args,
			],
		];

		return render_block( $final_args );
	}
}

if ( ! function_exists( 'the_static_acf_block' ) ) {
	/**
	 * Print content for an ACF block with a static data
	 * It may be used in most cases like a get_template_part() but for blocks
	 *
	 * @param string $block_name The block name should be prefixed with "acf/" slug. For instance "acf/my-block-name".
	 * @param array  $args arguments to use during rendering process.
	 */
	function the_static_acf_block( string $block_name, array $args ): void {
		// @codingStandardsIgnoreStart
		echo get_static_acf_block( $block_name, $args );
		// @codingStandardsIgnoreEnd
	}
}
