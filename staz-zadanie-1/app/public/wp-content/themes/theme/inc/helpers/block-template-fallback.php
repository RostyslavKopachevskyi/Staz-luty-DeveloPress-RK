<?php
/**
 * Fallback for displaying blocks
 */

?>
<section>
	<hr>
	<h2>Block: <?php echo esc_html( $block['title'] ); ?></h2>
	<h3>Block: <?php echo esc_html( $block['name'] ); ?></h3>
	<pre>
		<?php
			print_r( get_fields( $block['id'] ) ); // phpcs:ignore
		?>
	</pre>
	<hr>
</section>
