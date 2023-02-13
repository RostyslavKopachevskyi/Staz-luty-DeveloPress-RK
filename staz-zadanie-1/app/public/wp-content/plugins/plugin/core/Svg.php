<?php
/**
 * SVG support - uploading svg file types
 */

namespace dp\core;

/**
 * SVG support for WordPress
 */
class Svg {
	/**
	 * Add dedicated filtes
	 */
	public function __construct() {
		add_action( 'upload_mimes', [ $this, 'add_file_types_to_uploads' ] ); // phpcs:ignore
		add_filter( 'wp_check_filetype_and_ext', [ $this, 'correct_file_types' ], 10, 5 );
		add_filter( 'image_downsize', [ $this, 'fix_svg_size_attributes' ], 10, 2 );
		add_filter( 'remove_svg_fill_attr', [ $this, 'remove_svg_fill_attr' ] );
	}

	/**
	 * Add SVG Support
	 *
	 * @param array $file_types list of file types.
	 *
	 * @return array
	 */
	function add_file_types_to_uploads( array $file_types ): array {
		$new_filetypes        = [];
		$new_filetypes['svg'] = 'image/svg+xml';

		return array_merge( $file_types, $new_filetypes );
	}

	/**
	 * Correct file types
	 *
	 * @param mixed $data file type.
	 * @param mixed $file fie.
	 * @param mixed $filename file name.
	 * @param mixed $mimes mime types.
	 * @param mixed $real_mime real mime.
	 *
	 * @return mixed
	 */
	function correct_file_types( $data, $file, $filename, $mimes, $real_mime ) {

		if ( ! empty( $data['ext'] ) && ! empty( $data['type'] ) ) {
			return $data;
		}

		$wp_file_type = wp_check_filetype( $filename, $mimes );

		if ( 'svg' === $wp_file_type['ext'] ) {
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}

		return $data;
	}

	/**
	 * Remove SVG size
	 *
	 * @param mixed $out out.
	 * @param mixed $id id.
	 *
	 * @return array|false
	 */
	function fix_svg_size_attributes( $out, $id ) {
		$image_url = wp_get_attachment_url( $id );
		$file_ext  = pathinfo( $image_url, PATHINFO_EXTENSION );

		if ( is_admin() || 'svg' !== $file_ext ) {
			return false;
		}

		return [ $image_url, null, null, false ];
	}

	/**
	 * Sanitize SVG file - remove fill
	 *
	 * @param string $path_to_file file localization.
	 *
	 * @return string
	 */
	function remove_svg_fill_attr( string $path_to_file ): string {
		$svg = file_get_contents( $path_to_file ); // phpcs:ignore

		return preg_replace(
			'/fill="#.*"/',
			'',
			$svg
		);
	}
}
