import './styles.editor.scss';
import {registerBlockType} from '@wordpress/blocks';
import {__} from '@wordpress/i18n';
import Edit from './edit';

// import {RichText} from '@wordpress/block-editor';

registerBlockType( 'dp/second', {
	title: __( 'Second Amazing Block', 'dp' ),
	description: __( 'My second Block', 'dp' ),
	icon: <svg
		xmlns="http://www.w3.org/2000/svg"
		height="24px"
		viewBox="0 0 24 24"
		width="24px"
		fill="#000000"
	>
		<path d="M0 0h24v24H0V0z" fill="none"/>
		<path
			d="M21 7.28V5c0-1.1-.9-2-2-2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-2.28c.59-.35 1-.98 1-1.72V9c0-.74-.41-1.37-1-1.72zM20 9v6h-7V9h7zM5 19V5h14v2h-6c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h6v2H5z"/>
		<circle cx="16" cy="12" r="1.5"/>
	</svg>,
	category: 'mytheme_category',
	attributes: {
		content: {
			type: 'string',
			source: 'html',
			selector: 'p',
		},
		aligment: {
			type: 'string',
		},
		backgroundColor: {
			type: 'string',
		}
	},

	// it adds set of styles in a very simple way
	styles: [
		{
			name: 'rounded',
			label: __( 'Rounded box', 'dp' ),
			isDefault: true,
		},
		{
			name: 'squared',
			label: __( 'Squared box', 'dp' ),
		},
	],
	edit: Edit,
	save: function({attributes}) {
		const {content, aligment, backgroundColor} = attributes;
		return <RichText.Content
			tagName="p"
			value={content}
			style={{textAlign: aligment, backgroundColor}}
		/>;
	},
});
