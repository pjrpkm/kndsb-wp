( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement, RichText = blockEditor.RichText, MediaUpload = blockEditor.MediaUpload, MediaUploadCheck = blockEditor.MediaUploadCheck, Button = components.Button;
	blocks.registerBlockType( 'kndsb/sport-hero', {
		edit: function ( props ) {
			var a = props.attributes;
			function select( media ) { props.setAttributes( { imageId: media.id, imageUrl: media.url, imageAlt: media.alt || a.title } ); }
			return el( 'section', blockEditor.useBlockProps( { className: 'kndsb-sport-page__hero kndsb-sport-hero', style: a.imageUrl ? { backgroundImage: 'linear-gradient(90deg,rgba(0,0,0,.58),rgba(0,0,0,.05)),url(' + a.imageUrl + ')' } : {} } ),
				el( 'div', { className: 'kndsb-sport-hero__inner' },
					el( RichText, { tagName: 'h1', className: 'kndsb-sport-page__title', value: a.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); } } ),
					el( MediaUploadCheck, {}, el( MediaUpload, { onSelect: select, allowedTypes: [ 'image' ], value: a.imageId, render: function ( media ) { return el( Button, { onClick: media.open, variant: 'secondary' }, a.imageUrl ? i18n.__( 'Foto vervangen', 'kndsb' ) : i18n.__( 'Foto kiezen', 'kndsb' ) ); } } ) )
				)
			);
		},
		save: function ( props ) {
			var a = props.attributes;
			return el( 'section', blockEditor.useBlockProps.save( { className: 'kndsb-sport-page__hero kndsb-sport-hero', style: a.imageUrl ? { backgroundImage: 'linear-gradient(90deg,rgba(0,0,0,.58),rgba(0,0,0,.05)),url(' + a.imageUrl + ')' } : {} } ), el( 'div', { className: 'kndsb-sport-hero__inner' }, el( RichText.Content, { tagName: 'h1', className: 'kndsb-sport-page__title', value: a.title } ) ) );
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
