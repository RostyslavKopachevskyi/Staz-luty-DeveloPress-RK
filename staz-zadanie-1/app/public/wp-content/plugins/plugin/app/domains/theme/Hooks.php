<?php

namespace dp\app\domains\theme;

/**
 * Filters and actions definitions
 */
class Hooks {
	public function __construct() {
		add_action( 'excerpt_more', [ $this, 'set_excerpt_content' ] );
		add_action( 'reading_time', [ $this, 'get_reading_time' ] );
	}

	/**
	 * Remove [...] from the excerpt
	 */
	public function set_excerpt_content(): string {
		return '';
	}

	/**
	 * Get average time for reading the post
	 *
	 * @param array $args post parameters.
	 *
	 * @return string
	 */
	function get_reading_time( array $args = [] ): string {
		if ( empty( $args['post_id'] ) ) {
			$post_id = get_the_ID();
		} else {
			$post_id = $args['post_id'];
		}

		$content      = get_post_field( 'post_content', $post_id );
		$word_count   = str_word_count( wp_strip_all_tags( $content ) );
		$reading_time = ceil( $word_count / 200 );
		if ( 1 == $reading_time ) {
			$timer = ' minute';
		} else {
			$timer = ' minutes';
		}

		return __( 'Reading time: ', 'dp' ) . $reading_time . $timer;
	}
}
