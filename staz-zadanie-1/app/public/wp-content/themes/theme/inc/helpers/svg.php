<?php
/**
 * DISPLAY SVG (located in a theme)
 *
 * @param string $name Svg file name.
 * @param string $css_class Class to add.
 * @param bool   $inline Display svg inline? False - as img.
 */
function the_svg( $name, $css_class = '', $inline = true ) {
	// @codingStandardsIgnoreStart
	echo get_svg( $name, $css_class, $inline );
	// @codingStandardsIgnoreEnd
}

/**
 * GET SVG (located in a theme)
 *
 * @param string $name Svg file name.
 * @param string $css_class Class to add.
 * @param bool   $inline Display svg inline? False - as img.
 *
 * @return string
 */
function get_svg( string $name, string $css_class = '', bool $inline = true ): string {
	$path = str_replace( '.svg', '', $name );

	if ( $inline ) {
		$file    = get_template_directory() . '/assets/img/' . $path . '.svg';
		$content = file_get_contents( $file, true ); // phpcs:ignore

		if ( ! empty( $css_class ) ) {
			if ( str_contains( $content, ' class="' ) ) {
				$content = str_replace( 'class="', 'class="' . $css_class . ' ', $content );
			} else {
				$content = str_replace( '<svg ', '<svg class="' . $css_class . '"', $content );
			}
		}

		return $content;
	}

	$file = get_template_directory_uri() . '/assets/img/' . $path . '.svg';

	return '<img src="' . $file . '" />';
}
