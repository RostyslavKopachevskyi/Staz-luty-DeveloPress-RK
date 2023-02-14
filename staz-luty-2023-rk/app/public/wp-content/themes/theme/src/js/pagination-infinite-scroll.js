import $ from 'jquery';

class PaginationInfiniteScroll {
	constructor() {
		this.isLoading = false;
		this.loadMoreDOM = $( '#loadMorePostsTrigger' );

		this.checkStatus();

		if ( 0 < this.loadMoreDOM.length ) {

			// event triggered when user is close to the pagination section
			$( window ).scroll( this.checkScrollPosition );
		}
	}

	checkScrollPosition = () => {
		if (
			$( window ).scrollTop() + $( window ).height() >
			this.loadMoreDOM.offset().top - 800
		) {
			if (
				! this.isLoading &&
				parseInt( developress.max_page ) >
					parseInt( developress.currentPage )
			) {
				this.isLoading = true;
				this.loadMore();
			}
		}
	};

	checkStatus = () => {
		if (
			parseInt( developress.max_page ) ===
			parseInt( developress.currentPage )
		) {
			this.loadMoreDOM.remove();
		}

		this.isLoading = false;
	};

	loadMore = () =>
		$.ajax({
			url: developress.ajaxUrl,
			method: 'GET',
			accepts: {
				'Content-Type': 'application/json'
			},
			data: {
				action: 'load_more_posts',
				nonce: developress.nonce,
				currentPage: developress.currentPage,
				queryVars: developress.queryVars
			},
			success: ( res ) => {
				if ( res.success ) {
					this.loadMoreDOM.before( res.data );

					developress.currentPage =
						parseInt( developress.currentPage ) + 1;
				}
			},
			complete: this.checkStatus
		});
}

new PaginationInfiniteScroll();
