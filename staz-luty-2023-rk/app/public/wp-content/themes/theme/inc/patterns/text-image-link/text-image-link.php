<?php
/**
 * $image
 * $title
 * $description
 * $link
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

if ( ! empty( $link ) ) {
	$link_url    = $link['url'];
	$link_title  = $link['title'];
	$link_target = $link['target'] ?? '_self';
}
?>

<?php if ( ! empty( $image ) ) : ?>
	<img src="<?= esc_url( $image['sizes']['full_hd'] ); ?>">
<?php endif; ?>

<?php if ( ! empty( $title ) ) : ?>
	<?= esc_html( $title ); ?>
<?php endif; ?>

<?php if ( ! empty( $description ) ) : ?>
	<?php
	the_wp_kses( $description );
	?>
<?php endif; ?>

<?php if ( ! empty( $link ) ) : ?>
	<a href="<?= esc_url( $link_url ); ?>" target="<?= esc_attr( $link_target ); ?>">
		<?= esc_html( $link_title ); ?>
	</a>
<?php endif; ?>
