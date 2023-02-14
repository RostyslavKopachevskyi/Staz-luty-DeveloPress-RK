<?php
/**
 * $image
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

<?php if ( ! empty( $image ) ) : ?>
	<img src="<?= esc_url( $image['sizes']['full_hd'] ); ?>">
<?php endif; ?>
