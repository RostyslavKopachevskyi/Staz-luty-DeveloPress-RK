<div>
	<?php
	echo esc_html(
		sprintf(
			/* translators: %1$s - author links, %2$s - time, %3$s - list of categories */
			__( 'Posted by %1$s on %2$s in %3$s', 'dp' ),
			get_the_author_posts_link(),
			get_the_time( 'd-m-Y' ),
			get_the_category_list( ', ' )
		)
	);
	?>
</div>
