<?php
/**
 * $slides['image']
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

<?php if ( ! empty( $slides ) ) : ?>
	<?php foreach ( $slides as $slide ) : ?>
		<?php if ( ! empty( $slide['image'] ) ) : ?>
			<img src="<?= esc_url( $slide['image']['sizes']['full_hd'] ); ?>">
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
