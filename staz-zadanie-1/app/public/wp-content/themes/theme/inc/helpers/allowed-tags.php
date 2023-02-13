<?php
/**
 * Displaying text with allowed tags
 */

if ( ! function_exists( 'get_wp_kses' ) ) {
	/**
	 * Implementation of the function wp_kses with allowed tags
	 *
	 * @param string $text text to display.
	 *
	 * @return string result with allowed text
	 */
	function get_wp_kses( string $text ): string {
		$allowed_tags = [
			'a'          => [
				'href'   => [],
				'target' => [],
				'title'  => [],
			],
			'br'         => [],
			'p'          => [ 'style' => [] ],
			'em'         => [],
			'h1'         => [],
			'h2'         => [],
			'h3'         => [],
			'h4'         => [],
			'h5'         => [],
			'h6'         => [],
			'strong'     => [],
			'ul'         => [],
			'li'         => [],
			'ol'         => [],
			'blockquote' => [],
			'hr'         => [],
			'del'        => [],
			'span'       => [ 'style' => [] ],
		];

		return wp_kses( $text, $allowed_tags );
	}
}

if ( ! function_exists( 'the_wp_kses' ) ) {
	/**
	 * Print content with allowed tags
	 *
	 * @param string $text text to display.
	 */
	function the_wp_kses( string $text ): void {
		echo get_wp_kses( $text ); // phpcs:ignore
	}
}
