( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var InspectorControls = blockEditor.InspectorControls;
	var RichText = blockEditor.RichText;
	var PanelBody = components.PanelBody;
	var TextControl = components.TextControl;
	var Button = components.Button;
	var MediaUpload = blockEditor.MediaUpload;
	var MediaUploadCheck = blockEditor.MediaUploadCheck;
	blocks.registerBlockType( 'kndsb/board-vacancy', {
		edit: function ( props ) {
			var a = props.attributes;
			return el( element.Fragment, {},
				el( InspectorControls, {}, el( PanelBody, { title: i18n.__( 'Vacaturelink', 'kndsb' ), initialOpen: true },
					el( TextControl, { label: i18n.__( 'URL', 'kndsb' ), value: a.linkUrl, onChange: function ( value ) { props.setAttributes( { linkUrl: value } ); } } )
				) ),
				el( 'article', blockEditor.useBlockProps( { className: 'kndsb-board-vacancy' } ),
					el( 'div', { className: 'kndsb-board-vacancy__media' },
						a.imageUrl ? el( 'img', { className: 'kndsb-board-vacancy__image', src: a.imageUrl, alt: '' } ) : el( 'div', { className: 'kndsb-board-vacancy__icon', 'aria-hidden': true }, '+' ),
						el( 'div', { className: 'kndsb-board-vacancy__media-controls' },
							el( MediaUploadCheck, {}, el( MediaUpload, {
								onSelect: function ( media ) { props.setAttributes( { imageUrl: media.url, imageId: media.id } ); },
								allowedTypes: [ 'image' ], value: a.imageId,
								render: function ( upload ) { return el( Button, { onClick: upload.open, variant: 'secondary' }, a.imageUrl ? i18n.__( 'Media vervangen', 'kndsb' ) : i18n.__( 'Media bijvoegen', 'kndsb' ) ); }
							} ) ),
							a.imageUrl ? el( Button, { isDestructive: true, onClick: function () { props.setAttributes( { imageUrl: '', imageId: 0 } ); } }, i18n.__( 'Verwijderen', 'kndsb' ) ) : null
						)
					),
					el( 'div', { className: 'kndsb-board-vacancy__body' },
						el( RichText, { tagName: 'p', className: 'kndsb-board-vacancy__role', value: a.role, onChange: function ( value ) { props.setAttributes( { role: value } ); } } ),
						el( RichText, { tagName: 'h3', className: 'kndsb-board-vacancy__title', value: a.title, onChange: function ( value ) { props.setAttributes( { title: value } ); } } ),
						el( RichText, { tagName: 'p', className: 'kndsb-board-vacancy__description', value: a.description, onChange: function ( value ) { props.setAttributes( { description: value } ); } } ),
						el( RichText, { tagName: 'span', className: 'kndsb-board-vacancy__link', value: a.linkLabel, onChange: function ( value ) { props.setAttributes( { linkLabel: value } ); } } )
					)
				)
			);
		},
		save: function () { return null; }
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
