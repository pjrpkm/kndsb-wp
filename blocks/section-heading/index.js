( function ( blocks, blockEditor, element, components, i18n ) {
	var el = element.createElement;
	var RichText = blockEditor.RichText;
	var InspectorControls = blockEditor.InspectorControls;
	var URLInput = blockEditor.URLInput;
	var PanelBody = components.PanelBody;
	var TextControl = components.TextControl;

	blocks.registerBlockType( 'kndsb/section-heading', {
		edit: function ( props ) {
			var a = props.attributes;
			return el( element.Fragment, {},
				el( InspectorControls, {}, el( PanelBody, { title: i18n.__( 'Link', 'kndsb' ) },
					el( TextControl, { label: i18n.__( 'Linktekst', 'kndsb' ), value: a.linkText, onChange: function ( value ) { props.setAttributes( { linkText: value } ); } } ),
					el( URLInput, { value: a.linkUrl, onChange: function ( value ) { props.setAttributes( { linkUrl: value } ); } } )
				) ),
				el( 'div', blockEditor.useBlockProps( { className: 'kndsb-section-heading' } ),
					el( RichText, { tagName: 'h2', className: 'kndsb-section-heading__title', value: a.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); } } ),
					a.linkText ? el( 'span', { className: 'kndsb-section-heading__link' }, a.linkText ) : null
				)
			);
		},
		save: function ( props ) {
			var a = props.attributes;
			return el( 'div', blockEditor.useBlockProps.save( { className: 'kndsb-section-heading' } ),
				el( RichText.Content, { tagName: 'h2', className: 'kndsb-section-heading__title', value: a.title } ),
				a.linkText && a.linkUrl ? el( 'a', { className: 'kndsb-section-heading__link', href: a.linkUrl }, a.linkText ) : null
			);
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.i18n );
