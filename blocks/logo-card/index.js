( function ( blocks, blockEditor, element, components, i18n ) {
	var el = element.createElement;
	var InspectorControls = blockEditor.InspectorControls;
	var MediaUpload = blockEditor.MediaUpload;
	var MediaUploadCheck = blockEditor.MediaUploadCheck;
	var PanelBody = components.PanelBody;
	var Button = components.Button;
	var TextControl = components.TextControl;

	blocks.registerBlockType( 'kndsb/logo-card', {
		edit: function ( props ) {
			var a = props.attributes;
			function selectImage( media ) {
				props.setAttributes( { imageId: media.id, imageUrl: media.url, imageAlt: media.alt || a.name || '' } );
			}
			return el( element.Fragment, {},
				el( InspectorControls, {},
					el( PanelBody, { title: i18n.__( 'Logokaart', 'kndsb' ) },
						el( TextControl, { label: i18n.__( 'Naam', 'kndsb' ), value: a.name, onChange: function ( value ) { props.setAttributes( { name: value } ); } } ),
						el( TextControl, { label: i18n.__( 'Link (optioneel)', 'kndsb' ), value: a.url, type: 'url', onChange: function ( value ) { props.setAttributes( { url: value } ); } } ),
						el( TextControl, { label: i18n.__( 'Alt-tekst', 'kndsb' ), value: a.imageAlt, onChange: function ( value ) { props.setAttributes( { imageAlt: value } ); } } )
					)
				),
				el( 'article', blockEditor.useBlockProps( { className: 'kndsb-logo-card' } ),
					el( 'div', { className: 'kndsb-logo-card__link' },
						a.imageUrl ? el( 'img', { className: 'kndsb-logo-card__image', src: a.imageUrl, alt: '' } ) : el( 'div', { className: 'kndsb-logo-card__placeholder' }, i18n.__( 'Kies een logo', 'kndsb' ) )
					),
					el( MediaUploadCheck, {}, el( MediaUpload, { onSelect: selectImage, allowedTypes: [ 'image' ], value: a.imageId, render: function ( media ) { return el( Button, { className: 'kndsb-logo-card__media-button', onClick: media.open, variant: 'secondary' }, a.imageUrl ? i18n.__( 'Logo wijzigen', 'kndsb' ) : i18n.__( 'Logo kiezen', 'kndsb' ) ); } } ) )
				)
			);
		},
		save: function ( props ) {
			var a = props.attributes;
			var image = a.imageUrl ? el( 'img', { className: 'kndsb-logo-card__image', src: a.imageUrl, alt: a.imageAlt || a.name || '', loading: 'lazy' } ) : null;
			var content = a.url ? el( 'a', { className: 'kndsb-logo-card__link', href: a.url, target: '_blank', rel: 'noopener noreferrer' }, image ) : el( 'div', { className: 'kndsb-logo-card__link' }, image );
			return el( 'article', blockEditor.useBlockProps.save( { className: 'kndsb-logo-card' } ), content );
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.i18n );
