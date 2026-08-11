( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var MediaUpload = blockEditor.MediaUpload;
	var MediaUploadCheck = blockEditor.MediaUploadCheck;
	var RichText = blockEditor.RichText;
	var Button = components.Button;

	blocks.registerBlockType( 'kndsb/board-member', {
		edit: function ( props ) {
			var a = props.attributes;
			return el( 'article', blockEditor.useBlockProps( { className: 'kndsb-board-card' } ),
				el( 'div', { className: 'kndsb-board-card__media' },
					a.imageUrl ? el( 'img', { className: 'kndsb-board-card__image', src: a.imageUrl, alt: '' } ) : el( 'span', { className: 'kndsb-board-card__placeholder' }, i18n.__( 'Kies een foto', 'kndsb' ) ),
					el( MediaUploadCheck, {}, el( MediaUpload, {
						onSelect: function ( media ) { props.setAttributes( { imageUrl: media.url, imageId: media.id } ); },
						allowedTypes: [ 'image' ], value: a.imageId,
						render: function ( upload ) { return el( Button, { className: 'kndsb-board-card__image-button', onClick: upload.open, variant: 'secondary' }, a.imageUrl ? i18n.__( 'Vervang foto', 'kndsb' ) : i18n.__( 'Kies foto', 'kndsb' ) ); }
					} ) )
				),
				el( 'div', { className: 'kndsb-board-card__body' },
					el( RichText, { tagName: 'p', className: 'kndsb-board-card__role', value: a.role, onChange: function ( value ) { props.setAttributes( { role: value } ); }, placeholder: i18n.__( 'Functie', 'kndsb' ) } ),
					el( RichText, { tagName: 'h3', className: 'kndsb-board-card__name', value: a.name, onChange: function ( value ) { props.setAttributes( { name: value } ); }, placeholder: i18n.__( 'Naam', 'kndsb' ) } )
				)
			);
		},
		save: function () { return null; }
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
