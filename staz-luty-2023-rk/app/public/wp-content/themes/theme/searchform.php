<form action="<?php echo esc_url( site_url( '/' ) ); ?>" type="GET">
	<input type="text" id="searchField" name="s" placeholder="Search">
	<input type="submit" value="<?php _e( 'Search', 'dp' ); ?>" id="searchButton">
	<div id="searchResults">
	</div>
</form>
