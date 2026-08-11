( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement, RichText = blockEditor.RichText;
	var template = [ [ 'kndsb/team-program-item' ], [ 'kndsb/team-program-item', { date: '30 SEP', homeTeam: 'Nederland O18', awayTeam: 'Oostenrijk O18' } ], [ 'kndsb/team-program-item', { date: '3 OKT', homeTeam: 'Denemarken O18', awayTeam: 'Nederland O18' } ] ];
	function oldSave( props ) { return el( 'section', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__fixtures' } ), el( RichText.Content, { tagName: 'h2', value: props.attributes.title } ), el( 'div', { className: 'kndsb-team-page__fixtures-list' }, el( blockEditor.InnerBlocks.Content ) ) ); }
	function buttonSave( props ) { var a = props.attributes; return el( 'section', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__fixtures' } ), el( RichText.Content, { tagName: 'h2', value: a.title } ), el( 'div', { className: 'kndsb-team-page__fixtures-list' }, el( blockEditor.InnerBlocks.Content ) ), el( 'a', { className: 'kndsb-team-page__fixtures-footer', href: a.buttonUrl || '/agenda/' }, el( RichText.Content, { tagName: 'span', value: a.buttonText } ), el( 'span', { className: 'kndsb-team-page__fixtures-chevron', 'aria-hidden': 'true' }, '›' ) ) ); }
	blocks.registerBlockType( 'kndsb/team-program', {
		edit: function ( props ) { var a = props.attributes; return el( 'section', blockEditor.useBlockProps( { className: 'kndsb-team-page__fixtures' } ), el( RichText, { tagName: 'h2', value: a.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); } } ), el( blockEditor.InnerBlocks, { allowedBlocks: [ 'kndsb/team-program-item' ], template: template, templateLock: false, renderAppender: blockEditor.InnerBlocks.ButtonBlockAppender } ) ); },
		save: oldSave,
		deprecated: [
			{ attributes: { title: { type: 'string', default: 'Programma' }, buttonText: { type: 'string', default: 'Programma & Tickets' }, buttonUrl: { type: 'string', default: '/agenda/' } }, save: buttonSave },
			{ attributes: { title: { type: 'string', default: 'Programma' } }, save: oldSave }
		]
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
