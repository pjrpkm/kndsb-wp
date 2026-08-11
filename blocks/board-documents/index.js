( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var InspectorControls = blockEditor.InspectorControls;
	var RichText = blockEditor.RichText;
	var PanelBody = components.PanelBody;
	var TextControl = components.TextControl;
	blocks.registerBlockType( 'kndsb/board-documents', {
		edit: function ( props ) {
			var a = props.attributes;
			return el( element.Fragment, {},
				el( InspectorControls, {}, el( PanelBody, { title: i18n.__( 'Documentlinks', 'kndsb' ), initialOpen: true },
					el( TextControl, { label: i18n.__( 'URL nevenfuncties', 'kndsb' ), value: a.firstUrl, onChange: function ( value ) { props.setAttributes( { firstUrl: value } ); } } ),
					el( TextControl, { label: i18n.__( 'URL rooster van aftreden', 'kndsb' ), value: a.secondUrl, onChange: function ( value ) { props.setAttributes( { secondUrl: value } ); } } )
				) ),
				el( 'nav', blockEditor.useBlockProps( { className: 'kndsb-board-documents', 'aria-label': i18n.__( 'Bestuursdocumenten', 'kndsb' ) } ),
					el( RichText, { tagName: 'span', className: 'kndsb-board-documents__button', value: a.firstLabel, onChange: function ( value ) { props.setAttributes( { firstLabel: value } ); }, placeholder: i18n.__( 'Eerste knop', 'kndsb' ) } ),
					el( RichText, { tagName: 'span', className: 'kndsb-board-documents__button', value: a.secondLabel, onChange: function ( value ) { props.setAttributes( { secondLabel: value } ); }, placeholder: i18n.__( 'Tweede knop', 'kndsb' ) } )
				)
			);
		},
		save: function () { return null; }
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
