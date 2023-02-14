import {Component} from '@wordpress/element';
import {__} from '@wordpress/i18n';
// eslint-disable-next-line no-unused-vars
import {RichText, BlockControls, AlignmentToolbar, InspectorControls} from '@wordpress/block-editor';
// eslint-disable-next-line no-unused-vars
import {Toolbar, DropdownMenu, PanelBody, ToggleControl, ColorPicker} from '@wordpress/components';

class Edit extends Component {
	updateContent = content => this.props.setAttributes({content});

	changeAligment = aligment => this.props.setAttributes({aligment});

	changeBackgroundColor = backgroundColor => {
		this.props.setAttributes({backgroundColor});
	}

	render() {
		const {className, attributes} = this.props;
		const {content, aligment, backgroundColor} = attributes;

		return <>
			<InspectorControls>
				<PanelBody
					title={__( 'Awesome title', 'dp' )}
				>
					Panel content
					<br/>
					<ToggleControl
						label={__( 'Toggle label', 'dp' )}
						onChange={val => {
							// eslint-disable-next-line no-console
							console.log( val );
						}}
					/>
					<br/>
					<br/>
					Background color
					<br/>
					<ColorPicker
						color="#f0f"
						onChangeComplete={color => this.changeBackgroundColor( color.hex )}
					/>
				</PanelBody>
			</InspectorControls>
			<BlockControls
				controls={[ {
					icon: 'wordpress',
					title: __( 'My button', 'dp' ),
					onClick: () => {
						// eslint-disable-next-line no-console
						console.log( 'toolbar' );
					},
					isActive: false,
				} ]}
			>
				{( content && 0 < content.length ) &&
					<Toolbar>
						<DropdownMenu
							icon="editor-table"
							Label={__( 'My label', 'dp' )}
							controls={[ {
								icon: 'wordpress',
								title: __( 'My button', 'dp' ),
								onClick: () => {
									// eslint-disable-next-line no-console
									console.log( 'toolbar' );
								},
								isActive: false,
							}, {
								icon: 'wordpress',
								title: __( 'My button', 'dp' ),
								onClick: () => {
									// eslint-disable-next-line no-console
									console.log( 'toolbar' );
								},
								isActive: false,
							}, {
								icon: 'wordpress',
								title: __( 'My button', 'dp' ),
								onClick: () => {
									// eslint-disable-next-line no-console
									console.log( 'toolbar' );
								},
								isActive: false,
							} ]}
						/>
					</Toolbar>
				}
				<Toolbar
					isCollapsed
					controls={[ {
						icon: 'wordpress',
						title: __( 'My button', 'dp' ),
						onClick: () => {
							// eslint-disable-next-line no-console
							console.log( 'toolbar' );
						},
						isActive: false,
					}, {
						icon: 'wordpress',
						title: __( 'My button', 'dp' ),
						onClick: () => {
							// eslint-disable-next-line no-console
							console.log( 'toolbar' );
						},
						isActive: false,
					}, {
						icon: 'wordpress',
						title: __( 'My button', 'dp' ),
						onClick: () => {
							// eslint-disable-next-line no-console
							console.log( 'toolbar' );
						},
						isActive: false,
					} ]}
				/>
				<Toolbar
					controls={[ {
						icon: 'wordpress',
						title: __( 'Align right', 'dp' ),
						onClick: () => this.changeAligment( 'right' ),
						isActive: false,
					} ]}
				/>
				<AlignmentToolbar
					value={aligment}
					onChange={val => this.changeAligment( val.hex )}
				/>
			</BlockControls>
			<RichText
				tagName="p"
				className={className}
				onChange={this.updateContent}
				value={content}
				style={{textAlign: aligment, backgroundColor}}
			/>
		</>;
	}
}

export default Edit;
