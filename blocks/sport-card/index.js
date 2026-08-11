( function ( blocks, blockEditor, element, components, i18n ) {
	var el = element.createElement;
	var InspectorControls = blockEditor.InspectorControls;
	var MediaUpload = blockEditor.MediaUpload;
	var MediaUploadCheck = blockEditor.MediaUploadCheck;
	var RichText = blockEditor.RichText;
	var PanelBody = components.PanelBody;
	var Button = components.Button;
	var TextControl = components.TextControl;

	blocks.registerBlockType( 'kndsb/sport-card', {
		edit: function ( props ) {
			var a = props.attributes;
			var cardProps = blockEditor.useBlockProps( {
				className: 'kndsb-sport-card',
				style: { margin: 0, minWidth: 0, width: '100%' }
			} );
			function selectImage( media ) {
				props.setAttributes( { imageId: media.id, imageUrl: media.url, imageAlt: media.alt || a.title } );
			}

			return el( element.Fragment, {},
				el( InspectorControls, {},
					el( PanelBody, { title: i18n.__( 'Sportkaart', 'kndsb' ) },
						el( TextControl, { label: i18n.__( 'Link', 'kndsb' ), value: a.url, onChange: function ( value ) { props.setAttributes( { url: value } ); } } ),
						el( TextControl, { label: i18n.__( 'Alt-tekst afbeelding', 'kndsb' ), value: a.imageAlt, onChange: function ( value ) { props.setAttributes( { imageAlt: value } ); } } )
					),
					el( PanelBody, { title: i18n.__( 'Afbeelding', 'kndsb' ), initialOpen: true },
						a.imageUrl ? el( 'img', { src: a.imageUrl, alt: '', style: { display: 'block', height: 'auto', marginBottom: '12px', width: '100%' } } ) : null,
						el( MediaUploadCheck, {}, el( MediaUpload, { onSelect: selectImage, allowedTypes: [ 'image' ], value: a.imageId, render: function ( mediaProps ) { return el( Button, { onClick: mediaProps.open, variant: 'primary' }, a.imageUrl ? i18n.__( 'Foto vervangen', 'kndsb' ) : i18n.__( 'Foto kiezen', 'kndsb' ) ); } } ) ),
						a.imageUrl ? el( Button, { isDestructive: true, onClick: function () { props.setAttributes( { imageId: 0, imageUrl: '', imageAlt: '' } ); }, style: { marginLeft: '8px' } }, i18n.__( 'Foto verwijderen', 'kndsb' ) ) : null
					)
				),
				el( 'article', cardProps,
					el( 'div', { className: 'kndsb-sport-card__media', style: { aspectRatio: '1 / 1', background: '#f58220', minHeight: '180px', overflow: 'hidden', position: 'relative', width: '100%' } },
						a.imageUrl ? el( 'img', { className: 'kndsb-sport-card__image', src: a.imageUrl, alt: '' } ) : el( 'div', { className: 'kndsb-sport-card__placeholder' }, i18n.__( 'Kies een sportfoto', 'kndsb' ) ),
						el( MediaUploadCheck, {}, el( MediaUpload, { onSelect: selectImage, allowedTypes: [ 'image' ], value: a.imageId, render: function ( mediaProps ) { return el( Button, { className: 'kndsb-sport-card__media-button', onClick: mediaProps.open, variant: 'secondary' }, a.imageUrl ? i18n.__( 'Foto wijzigen', 'kndsb' ) : i18n.__( 'Foto kiezen', 'kndsb' ) ); } } ) )
					),
					el( RichText, { tagName: 'h3', className: 'kndsb-sport-card__title', value: a.title, allowedFormats: [], placeholder: i18n.__( 'Naam sporttak', 'kndsb' ), onChange: function ( value ) { props.setAttributes( { title: value } ); } } )
				)
			);
		},
		save: function ( props ) {
			var a = props.attributes;
			return el( 'article', Object.assign( {}, blockEditor.useBlockProps.save( { className: 'kndsb-sport-card' } ), { 'data-sport-name': a.title } ),
				el( 'a', { className: 'kndsb-sport-card__link', href: a.url || '#' },
					el( 'div', { className: 'kndsb-sport-card__media' },
						a.imageUrl ? el( 'img', { className: 'kndsb-sport-card__image', src: a.imageUrl, alt: a.imageAlt || a.title, loading: 'lazy' } ) : el( 'div', { className: 'kndsb-sport-card__placeholder', 'aria-hidden': 'true' } ),
						el( 'div', { className: 'kndsb-sport-card__label' },
							el( RichText.Content, { tagName: 'h3', className: 'kndsb-sport-card__title', value: a.title } ),
							el( 'span', { className: 'kndsb-sport-card__arrow', 'aria-hidden': 'true' }, '→' )
						)
					)
				)
			);
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.i18n );
