<?php
/**
 * $title
 * $description
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

<section class="container-fluid sample scroll-animation">
	<div class="container sample__container">
		<div class="sample__text">
			<?php if ( ! empty( $title ) ) : ?>
				<h1 class="scroll-animation--left"><?= esc_html( $title ); ?></h1>
				<h2 class="scroll-animation--opacity"><?= esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $description ) ) : ?>
				<p class="scroll-animation--split-text">
					<?= wp_kses(
						$description,
						[
							'p'  => [],
							'br' => [],
						]
					);?></p>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $image ) ) : ?>
			<div class="sample__image-container">
				<div class="sample__image" data-speed="auto"
					style="background-image: url('<?= esc_url( $image['sizes']['large'] ); ?>')"></div>
			</div>
		<?php endif; ?>
	</div>
</section>
