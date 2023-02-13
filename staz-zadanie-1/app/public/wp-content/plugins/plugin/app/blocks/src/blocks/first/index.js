const registerBlock = wp.blocks.registerBlockType;
const __ = wp.i18n.__;
const el = wp.element.createElement;
registerBlock( 'dp/first', {
	title: __( 'First Amazing Block', 'dp' ),
	description: __( 'My first Block', 'dp' ),
	icon: 'admin-network',
	category: 'text',
	edit: function() {
		return el( 'p', null, 'Editor' );
	},
	save: function() {
		return el( 'p', null, 'Frontend' );
	},
});
