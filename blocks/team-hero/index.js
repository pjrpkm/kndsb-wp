( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var RichText = blockEditor.RichText;
	var MediaUpload = blockEditor.MediaUpload;
	var MediaUploadCheck = blockEditor.MediaUploadCheck;

	blocks.registerBlockType( 'kndsb/team-hero', {
		edit: function ( props ) {
			var a = props.attributes;
			var className = 'kndsb-team-page__hero kndsb-team-hero kndsb-team-hero--' + a.contentPosition;
			var style = { '--kndsb-team-hero-overlay': a.overlayOpacity / 100, '--kndsb-team-hero-height': a.height + 'px' };
			return el( element.Fragment, {},
				el( blockEditor.InspectorControls, {},
					el( components.PanelBody, { title: i18n.__( 'Teamhero', 'kndsb' ), initialOpen: true },
						el( components.RangeControl, { label: i18n.__( 'Donkere overlay', 'kndsb' ), value: a.overlayOpacity, min: 0, max: 80, step: 5, onChange: function ( value ) { props.setAttributes( { overlayOpacity: value } ); } } ),
						el( components.RangeControl, { label: i18n.__( 'Hoogte', 'kndsb' ), value: a.height, min: 300, max: 720, step: 20, onChange: function ( value ) { props.setAttributes( { height: value } ); } } ),
						el( components.SelectControl, { label: i18n.__( 'Positie titel', 'kndsb' ), value: a.contentPosition, options: [ { label: 'Links midden', value: 'left' }, { label: 'Midden midden', value: 'center' } ], onChange: function ( value ) { props.setAttributes( { contentPosition: value } ); } } ),
						el( components.TextControl, { label: i18n.__( 'Alternatieve tekst foto', 'kndsb' ), value: a.imageAlt, onChange: function ( value ) { props.setAttributes( { imageAlt: value } ); } } )
					)
				),
				el( 'section', blockEditor.useBlockProps( { className: className, style: style } ),
					a.imageUrl ? el( 'img', { className: 'kndsb-team-hero__image', src: a.imageUrl, alt: a.imageAlt || '' } ) : el( 'div', { className: 'kndsb-team-hero__placeholder' }, i18n.__( 'Kies een teamfoto', 'kndsb' ) ),
					el( 'span', { className: 'kndsb-team-hero__overlay', 'aria-hidden': 'true' } ),
					el( 'div', { className: 'padding-global kndsb-team-hero__layout' },
						el( 'div', { className: 'container-large' },
							el( 'div', { className: 'kndsb-team-hero__inner' },
								el( RichText, { tagName: 'h1', className: 'kndsb-team-page__title kndsb-team-hero__title', value: a.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); }, placeholder: i18n.__( 'Teamnaam', 'kndsb' ) } ),
								el( MediaUploadCheck, {}, el( MediaUpload, {
							allowedTypes: [ 'image' ],
							value: a.imageId,
							onSelect: function ( media ) { props.setAttributes( { imageUrl: media.url, imageId: media.id, imageAlt: media.alt || a.imageAlt } ); },
							render: function ( mediaProps ) { return el( components.Button, { className: 'kndsb-team-hero__media-button', variant: 'secondary', onClick: mediaProps.open }, a.imageUrl ? i18n.__( 'Vervang teamfoto', 'kndsb' ) : i18n.__( 'Kies teamfoto', 'kndsb' ) ); }
								} ) )
							)
						)
					)
				)
			);
		},
		save: function () { return null; }
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
