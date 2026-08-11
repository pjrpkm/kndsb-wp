( function ( blocks, blockEditor, element, components, i18n ) {
	var el = element.createElement;
	var InspectorControls = blockEditor.InspectorControls;
	var MediaUpload = blockEditor.MediaUpload;
	var MediaUploadCheck = blockEditor.MediaUploadCheck;
	var RichText = blockEditor.RichText;
	var PanelBody = components.PanelBody;
	var Button = components.Button;
	var TextControl = components.TextControl;

	function chevron() {
		return el( 'svg', { viewBox: '0 0 20 20', focusable: 'false', 'aria-hidden': 'true' }, el( 'path', { d: 'm7.5 4.5 5.5 5.5-5.5 5.5', fill: 'none', stroke: 'currentColor', strokeLinecap: 'round', strokeLinejoin: 'round', strokeWidth: '1.75' } ) );
	}

	blocks.registerBlockType( 'kndsb/team-card', {
		edit: function ( props ) {
			var a = props.attributes;
			function selectImage( media ) { props.setAttributes( { imageId: media.id, imageUrl: media.url, imageAlt: media.alt || a.title } ); }
			return el( element.Fragment, {},
				el( InspectorControls, {},
					el( PanelBody, { title: i18n.__( 'Teamkaart', 'kndsb' ) },
						el( TextControl, { label: i18n.__( 'Link naar teamsite', 'kndsb' ), value: a.url, onChange: function ( value ) { props.setAttributes( { url: value } ); } } ),
						el( TextControl, { label: i18n.__( 'Alt-tekst', 'kndsb' ), value: a.imageAlt, onChange: function ( value ) { props.setAttributes( { imageAlt: value } ); } } )
					)
				),
				el( 'article', blockEditor.useBlockProps( { className: 'kndsb-team-card' } ),
					el( 'div', { className: 'kndsb-team-card__media' },
						a.imageUrl ? el( 'img', { className: 'kndsb-team-card__image', src: a.imageUrl, alt: '' } ) : el( 'div', { className: 'kndsb-team-card__placeholder' }, i18n.__( 'Kies een teamfoto', 'kndsb' ) ),
						el( MediaUploadCheck, {}, el( MediaUpload, { onSelect: selectImage, allowedTypes: [ 'image' ], value: a.imageId, render: function ( media ) { return el( Button, { className: 'kndsb-team-card__media-button', onClick: media.open, variant: 'secondary' }, a.imageUrl ? i18n.__( 'Foto wijzigen', 'kndsb' ) : i18n.__( 'Foto kiezen', 'kndsb' ) ); } } ) )
					),
					el( RichText, { tagName: 'h3', className: 'kndsb-team-card__title', value: a.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); } } )
				)
			);
		},
		save: function ( props ) {
			var a = props.attributes;
			return el( 'article', blockEditor.useBlockProps.save( { className: 'kndsb-team-card' } ),
				el( 'a', { className: 'kndsb-team-card__link', href: a.url || '#' },
					el( 'div', { className: 'kndsb-team-card__media' }, a.imageUrl ? el( 'img', { className: 'kndsb-team-card__image', src: a.imageUrl, alt: a.imageAlt || a.title, loading: 'lazy' } ) : el( 'div', { className: 'kndsb-team-card__placeholder', 'aria-hidden': 'true' } ) ),
					el( 'div', { className: 'kndsb-team-card__footer' }, el( RichText.Content, { tagName: 'h3', className: 'kndsb-team-card__title', value: a.title } ), el( 'span', { className: 'kndsb-team-card__arrow' }, chevron() ) )
				)
			);
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.i18n );
