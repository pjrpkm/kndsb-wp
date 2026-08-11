( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var template = [
		[ 'kndsb/match-result' ],
		[ 'kndsb/match-result', { date: '26 juni 2026', homeTeam: 'Tegenstander', homeScore: '1', awayTeam: 'Nederland', awayScore: '4' } ],
		[ 'kndsb/match-result', { date: '20 juni 2026', homeScore: '5' } ]
	];

	function sectionClass( scheme ) {
		return 'alignfull section_team-results kndsb-layout-section kndsb-layout-section--' + scheme;
	}

	function componentClass( scheme ) {
		return 'kndsb-team-page__section kndsb-team-page__results kndsb-team-page__results--' + scheme;
	}

	blocks.registerBlockType( 'kndsb/match-results', {
		edit: function ( props ) {
			var a = props.attributes;
			return el( element.Fragment, {},
				el( blockEditor.InspectorControls, {},
					el( components.PanelBody, { title: i18n.__( 'Uitslagen', 'kndsb' ) },
						el( components.SelectControl, {
							label: i18n.__( 'Achtergrondkleur', 'kndsb' ),
							value: a.colorScheme,
							options: [
								{ label: 'Oranje', value: 'orange' },
								{ label: 'Blauw', value: 'blue' },
								{ label: 'Rood', value: 'red' },
								{ label: 'Gebroken blauw-wit', value: 'blue-white' }
							],
							onChange: function ( value ) { props.setAttributes( { colorScheme: value } ); }
						} )
					)
				),
				el( 'section', blockEditor.useBlockProps( { className: sectionClass( a.colorScheme ) } ),
					el( 'div', { className: 'padding-global' },
						el( 'div', { className: 'container-large' },
							el( 'div', { className: 'padding-section-medium' },
								el( 'section', { className: componentClass( a.colorScheme ) },
									el( blockEditor.RichText, { tagName: 'h2', className: 'kndsb-team-page__section-title', value: a.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); } } ),
									el( blockEditor.InnerBlocks, { allowedBlocks: [ 'kndsb/match-result' ], template: template, templateLock: false, renderAppender: blockEditor.InnerBlocks.ButtonBlockAppender } )
								)
							)
						)
					)
				)
			);
		},
		save: function ( props ) {
			var a = props.attributes;
			return el( 'section', blockEditor.useBlockProps.save( { className: sectionClass( a.colorScheme ) } ),
				el( 'div', { className: 'padding-global' },
					el( 'div', { className: 'container-large' },
						el( 'div', { className: 'padding-section-medium' },
							el( 'section', { className: componentClass( a.colorScheme ) },
								el( blockEditor.RichText.Content, { tagName: 'h2', className: 'kndsb-team-page__section-title', value: a.title } ),
								el( 'div', { className: 'kndsb-team-page__result-grid' }, el( blockEditor.InnerBlocks.Content ) )
							)
						)
					)
				)
			);
		},
		deprecated: [ {
			attributes: {
				title: { type: 'string', default: 'Uitslagen' },
				colorScheme: { type: 'string', default: 'orange' }
			},
			save: function ( props ) {
				var a = props.attributes;
				return el( 'section', blockEditor.useBlockProps.save( { className: componentClass( a.colorScheme ) } ),
					el( blockEditor.RichText.Content, { tagName: 'h2', className: 'kndsb-team-page__section-title', value: a.title } ),
					el( 'div', { className: 'kndsb-team-page__result-grid' }, el( blockEditor.InnerBlocks.Content ) )
				);
			}
		} ]
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
