import $ from 'jquery';

class Navigation {
	constructor() {
		this.body = $( 'body' );
		this.navContainer = $( '#navContainer' );

		$( '#navOpenMenu' ).on( 'click', this.toggleMenu );
		$( '#navCloseMenu' ).on( 'click', this.toggleMenu );
	}

	toggleMenu = () => {
		if ( 'none' === this.navContainer.css( 'display' ) ) {
			this.navContainer.css( 'display', 'flex' );
			setTimeout( () => {
				this.toggleMenuCommon();
			}, 100 );
		} else {
			this.toggleMenuCommon();
			setTimeout( () => {
				this.navContainer.css( 'display', 'none' );
			}, 500 );
		}

	};

	toggleMenuCommon = () => {
		this.navContainer.toggleClass( 'nav--active' );
		this.body.toggleClass( 'overflow-hidden' );
		$( '.nav__button' ).toggleClass( 'nav__button--active' );
	};
}

new Navigation();
