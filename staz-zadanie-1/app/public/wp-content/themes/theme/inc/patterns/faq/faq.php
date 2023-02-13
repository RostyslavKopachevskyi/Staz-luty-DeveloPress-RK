<?php
/**
 * $faqs[ 'title', 'description' ]
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

<?php if ( ! empty( $faqs ) ) : ?>
	<?php foreach ( $faqs as $faq ) : ?>
		<?php if ( ! empty( $faq['title'] && $faq['description'] ) ) : ?>
			<?= esc_html( $faq['title'] ) ?>
			<?php
			the_wp_kses( $faq['description'] );
			?>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php
endif;
