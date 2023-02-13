<?php

namespace dp\config\theme;

use WP_Query;

/**
 * Additional functionality working with AJAX
 */
class Ajax {
	public function __construct() {
		add_action( 'wp_ajax_load_more_posts', [ $this, 'load_more' ] );
		add_action( 'wp_ajax_nopriv_load_more_posts', [ $this, 'load_more' ] );
	}

	/**
	 * Load more posts in archive - infinite scroll
	 */
	function load_more(): void {
		if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( $_GET['nonce'] ), 'wp_ajax' ) ) {
			wp_send_json_error( __( 'You passed incorrect data...', 'dp' ) );
		}

		$next_page           = isset( $_GET['current_page'] ) ? intval( $_GET['current_page'] ) + 1 : 1;
		$args                = isset( $_GET['query_vars'] )
			? json_decode( stripslashes( sanitize_text_field( $_GET['query_vars'] ) ), true )
			: [];
		$args['post_status'] = 'publish';
		$args['paged']       = $next_page;

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			ob_start();
			$posts_args = [];

			while ( $query->have_posts() ) {
				$query->the_post();

				$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' )
					? get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' )
					: get_template_directory_uri() . '/assets/img/placeholder.jpg';

				array_push(
					$posts_args,
					[
						'id'        => get_the_ID(),
						'title'     => get_the_title(),
						'thumbnail' => $thumbnail_url,
						'excerpt'   => get_the_excerpt(),
						'permalink' => get_permalink(),
					]
				);
			}
			get_template_part( 'template-parts/archive', 'content-rows', $posts_args );

			wp_send_json_success( ob_get_clean() );
		} else {
			wp_send_json_error( __( 'No more data', 'dp' ) );
		}
	}
}
