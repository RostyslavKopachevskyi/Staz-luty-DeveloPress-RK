<?php
/**
 * Helper for block patterns definition
 */

/**
 * Fundamentals things for the block pattern
 */
class Block_Pattern {
	/**
	 * General config for the block
	 *
	 * @var array
	 */
	private array $common_config;

	/**
	 * Individual config for each block that we want to create.
	 *
	 * @var array
	 */
	private array $individual_configuration;

	/**
	 * Set up the block
	 *
	 * @param array $common_config Common config for the block.
	 * @param array $individual_configuration Individual configuration.
	 */
	public function __construct( array $common_config, array $individual_configuration ) {
		$this->common_config            = $common_config;
		$this->individual_configuration = $individual_configuration;
		add_action( 'acf/init', [ $this, 'register_acf_block' ] );
	}

	/**
	 * Core configuration
	 */
	function get_core_configuration(): array {
		return [
			'render_callback' => [ $this, 'render_block' ],
			'enqueue_assets'  => [ $this, 'enqueue_assets' ],
			'mode'            => 'edit',
		];
	}

	/**
	 * Register Gutenberg blocks
	 */
	function register_acf_block() {
		// keywords configuration.
		if (
			! isset( $this->individual_configuration['keywords'] )
			&& isset( $this->common_config['keywords'] )
		) {
			array_push(
				$this->common_config['keywords'],
				$this->individual_configuration['name'],
				$this->individual_configuration['title']
			);
		}

		$config = array_merge(
			$this->get_core_configuration(),
			$this->common_config,
			$this->individual_configuration,
		);

		if ( function_exists( 'acf_register_block' ) ) {
			acf_register_block( $config );
		}
	}

	/**
	 * Check if indicated file exist
	 *
	 * @param string $slug block's name.
	 * @param string $extension file's extension.
	 *
	 * @return bool
	 */
	function file_exist( string $slug, string $extension ): bool {
		return file_exists( get_theme_file_path( "/inc/patterns/{$slug}/{$slug}.{$extension}" ) );
	}

	/**
	 * Render block if theme exist or display data in fallback
	 *
	 * @param array $block Block to render.
	 */
	function render_block( array $block ) {
		$slug = str_replace( 'acf/', '', $block['name'] );

		if ( $this->file_exist( $slug, 'php' ) ) {
			include( get_theme_file_path( "/inc/patterns/{$slug}/{$slug}.php" ) );
		} else {
			include( get_theme_file_path( '/inc/helpers/block-template-fallback.php' ) );
		}
	}

	/**
	 * Include assets if exists
	 *
	 * @param array $block assets for the block.
	 */
	function enqueue_assets( array $block ) {
		$slug = str_replace( 'acf/', '', $block['name'] );

		if ( $this->file_exist( $slug, 'css' ) ) {
			wp_enqueue_style(
				"block_{$slug}",
				get_template_directory_uri() . "/inc/patterns/{$slug}/{$slug}.css",
				[
					'common_css',
				],
				wp_get_theme()->get( 'Version' )
			);
		}

		if ( $this->file_exist( $slug, 'min.js' ) ) {
			wp_enqueue_script(
				"block_{$slug}",
				get_template_directory_uri() . "/inc/patterns/{$slug}/{$slug}.min.js",
				[
					'common_js',
				],
				wp_get_theme()->get( 'Version' ),
				true
			);
		}
	}
}
