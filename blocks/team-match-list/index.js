( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var RichText = blockEditor.RichText;
	var defaultMatch = [ [ 'kndsb/team-match' ] ];

	blocks.registerBlockType( 'kndsb/team-match-list', {
		variations: [
			{ name: 'program', title: 'KNDSB programma uitgebreid', description: 'Wedstrijdprogramma met tijd, locatie en ticketlink.', icon: 'calendar-alt', attributes: { title: 'Programma', mode: 'program' }, isDefault: true, scope: [ 'inserter' ] },
			{ name: 'results', title: 'KNDSB uitslagen uitgebreid', description: 'Uitslagen met eindstand en locatie.', icon: 'awards', attributes: { title: 'Uitslagen', mode: 'results' }, scope: [ 'inserter' ] }
		],
		edit: function ( props ) {
			var a = props.attributes;
			var className = 'kndsb-match-list kndsb-match-list--' + a.mode;
			return el( element.Fragment, {},
				el( blockEditor.InspectorControls, {}, el( components.PanelBody, { title: i18n.__( 'Wedstrijdlijst', 'kndsb' ) },
					el( components.SelectControl, { label: i18n.__( 'Type', 'kndsb' ), value: a.mode, options: [ { label: 'Programma', value: 'program' }, { label: 'Uitslagen', value: 'results' } ], onChange: function ( value ) { props.setAttributes( { mode: value, title: value === 'results' ? 'Uitslagen' : 'Programma' } ); } } )
				) ),
				el( 'section', blockEditor.useBlockProps( { className: className } ),
					el( RichText, { tagName: 'h2', className: 'kndsb-match-list__title', value: a.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); }, placeholder: 'Programma' } ),
					el( blockEditor.InnerBlocks, { allowedBlocks: [ 'kndsb/team-match' ], template: defaultMatch, templateLock: false, renderAppender: blockEditor.InnerBlocks.ButtonBlockAppender } )
				)
			);
		},
		save: function ( props ) {
			var a = props.attributes;
			return el( 'section', blockEditor.useBlockProps.save( { className: 'kndsb-match-list kndsb-match-list--' + a.mode } ),
				el( RichText.Content, { tagName: 'h2', className: 'kndsb-match-list__title', value: a.title } ),
				el( 'div', { className: 'kndsb-match-list__items' }, el( blockEditor.InnerBlocks.Content ) )
			);
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
