( function ( blocks, blockEditor, element, i18n ) {
	var el = element.createElement;
	var RichText = blockEditor.RichText;
	blocks.registerBlockType( 'kndsb/board-intro', {
		edit: function ( props ) {
			var a = props.attributes;
			return el( 'header', blockEditor.useBlockProps( { className: 'kndsb-board-page__header' } ),
				el( RichText, { tagName: 'p', className: 'kndsb-board-page__eyebrow', value: a.eyebrow, onChange: function ( value ) { props.setAttributes( { eyebrow: value } ); }, placeholder: i18n.__( 'Label', 'kndsb' ) } ),
				el( RichText, { tagName: 'h1', className: 'kndsb-board-page__title', value: a.title, onChange: function ( value ) { props.setAttributes( { title: value } ); }, placeholder: i18n.__( 'Titel', 'kndsb' ) } ),
				el( RichText, { tagName: 'p', className: 'kndsb-board-page__intro', value: a.intro, onChange: function ( value ) { props.setAttributes( { intro: value } ); }, placeholder: i18n.__( 'Introductietekst', 'kndsb' ) } )
			);
		},
		save: function () { return null; }
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.i18n );
