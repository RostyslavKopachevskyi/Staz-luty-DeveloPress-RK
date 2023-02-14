<?php
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Add individual category for the blocks.
 *
 * @param array $categories List of current categories.
 *
 * @return array
 */
function my_theme_block_category( array $categories ): array {
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'mytheme_category',
				'title' => __( 'My title', 'dp' ),
				'icon'  => 'wordpress',
			],
		]
	);
}

add_filter( 'block_categories_all', 'my_theme_block_category', 10, 2 );

function dp_register_block_type( $block_name, $attr = [] ) {
	register_block_type(
		'dp/' . $block_name,
		array_merge(
			[
				'editor_script' => 'dp-editor-script',
				'script'        => 'dp-script',
				'editor_style'  => 'dp-editor-style',
				'style'         => 'dp-style',
			],
			$attr
		)
	);
}

function register_dp_block() {
	wp_register_script(
		'dp-editor-script',
		plugins_url( 'dist/editor.js', __FILE__ ),
		[ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ]
	);

	wp_register_script(
		'dp-script',
		plugins_url( 'dist/script.js', __FILE__ ),
		[ 'jquery' ]
	);

	wp_register_style(
		'dp-editor-style',
		plugins_url( 'dist/editor.css', __FILE__ ),
		[ 'wp-edit-blocks' ]
	);

	wp_register_style(
		'dp-style',
		plugins_url( 'dist/style.css', __FILE__ ),
		[]
	);

	dp_register_block_type( 'first' );
	dp_register_block_type( 'second' );
}

add_action( 'init', 'register_dp_block' );
