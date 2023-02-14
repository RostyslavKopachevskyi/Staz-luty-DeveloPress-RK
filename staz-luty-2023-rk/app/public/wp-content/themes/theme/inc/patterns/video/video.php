<?php
/**
 * $video
 */

if ( function_exists( 'get_fields' ) && ! empty( $block ) ) {
	if ( ! empty( $block['id'] ) ) {
		$block_data = get_fields( $block['id'] );

		if ( ! empty( $block_data ) ) {
			extract( $block_data );
		}
	} elseif ( ! empty( $block['data'] ) ) {
		extract( $block['data'] );
	}
}
?>

<?php if ( ! empty( $video ) ) : ?>
	<video autoplay loop muted playsinline>
		<source src="<?= esc_url( $video['url'] ) ?> ">
	</video>
<?php endif; ?>
