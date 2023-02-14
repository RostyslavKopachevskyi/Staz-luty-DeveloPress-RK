<?php
get_header();
?>
	<h1><?= esc_html( __( 'Home page for block', 'dp' ) ); ?></h1>
	<div>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<div>
				<h3>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<p>
					<?php the_excerpt(); ?>
				</p>
				<hr>
			</div>
			<?php
		endwhile;

		echo esc_html( get_template_part( 'template-parts/pagination', 'infinite-scroll' ) );
		?>
	</div>
<?php
get_footer();
