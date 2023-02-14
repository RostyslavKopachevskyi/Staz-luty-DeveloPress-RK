<?php
/**
 * Register all block patterns for the theme - something that we used to call block / module in the past
 */

/**
 * Registers block patterns
 */

require_once __DIR__ . '/helpers/Blocks_Patterns_Factory.php';

/**
 * Definition of all blocks that we want to register
 */
$blocks_to_register = [
	[
		'name'  => 'slider',
		'title' => __( 'Slider block', 'dp' ),
	],
	[
		'name'  => 'image',
		'title' => __( 'Image block', 'dp' ),
	],
	[
		'name'  => 'title-image-description',
		'title' => __( 'Title, image, description block', 'dp' ),
	],
	[
		'name'  => 'gallery',
		'title' => __( 'Gallery block', 'dp' ),
	],
	[
		'name'  => 'text-divided-into-columns',
		'title' => __( 'Text divided into columns block', 'dp' ),
	],
	[
		'name'  => 'simple-text',
		'title' => __( 'Simple text block', 'dp' ),
	],
	[
		'name'  => 'text-image-link',
		'title' => __( 'Text, image, link block', 'dp' ),
	],
	[
		'name'  => 'quote',
		'title' => __( 'Quote block', 'dp' ),
	],
	[
		'name'  => 'video',
		'title' => __( 'Video block', 'dp' ),
	],
	[
		'name'  => 'instagram',
		'title' => __( 'Instagram/social media integration block', 'dp' ),
	],
	[
		'name'  => 'background-image-title-description',
		'title' => __( 'Background image, title, description block', 'dp' ),
	],
	[
		'name'  => 'faq',
		'title' => __( 'FAQ / Dropdowns block', 'dp' ),
	],
	[
		'name'  => 'text-multiple-images',
		'title' => __( 'Text, multiple images block', 'dp' ),
	],
];

new Blocks_Patterns_Factory( $blocks_to_register );
