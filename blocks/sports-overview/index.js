( function ( blocks, blockEditor, element, i18n ) {
	var el = element.createElement;
	var InnerBlocks = blockEditor.InnerBlocks;
	var useInnerBlocksProps = blockEditor.useInnerBlocksProps;
	var allowedBlocks = [ 'kndsb/sport-card' ];
	var sportsTemplate = [
		[ 'kndsb/sport-card', { title: 'Atletiek', url: '/sporttakken/atletiek/' } ],
		[ 'kndsb/sport-card', { title: 'Bowling', url: '/sporttakken/bowling/' } ],
		[ 'kndsb/sport-card', { title: 'Wielrennen / MTB', url: '/sporttakken/wielrennen-mtb/' } ],
		[ 'kndsb/sport-card', { title: 'Golf', url: '/sporttakken/golf/' } ],
		[ 'kndsb/sport-card', { title: 'Judo', url: '/sporttakken/judo/' } ],
		[ 'kndsb/sport-card', { title: 'Schaken', url: '/sporttakken/schaken/' } ],
		[ 'kndsb/sport-card', { title: 'Schieten', url: '/sporttakken/schieten/' } ],
		[ 'kndsb/sport-card', { title: 'Padel', url: '/sporttakken/padel/' } ],
		[ 'kndsb/sport-card', { title: 'Voetbal', url: '/sporttakken/voetbal/' } ],
		[ 'kndsb/sport-card', { title: 'Volleybal', url: '/sporttakken/volleybal/' } ],
		[ 'kndsb/sport-card', { title: 'Zwemmen', url: '/sporttakken/zwemmen/' } ]
	];

	blocks.registerBlockType( 'kndsb/sports-overview', {
		edit: function () {
			var innerBlocksProps = useInnerBlocksProps( {
				className: 'kndsb-sports-overview__grid',
				style: {
					display: 'grid',
					gap: '22px',
					gridTemplateColumns: 'repeat(4, minmax(0, 1fr))',
					width: '100%'
				}
			}, { allowedBlocks: allowedBlocks, template: sportsTemplate, templateLock: false, renderAppender: InnerBlocks.ButtonBlockAppender } );

			return el( 'section', blockEditor.useBlockProps( { className: 'kndsb-sports-overview' } ),
				el( 'div', { className: 'kndsb-sports-overview__toolbar' },
					el( 'strong', { className: 'kndsb-sports-overview__count' }, i18n.__( 'Resultaatenteller', 'kndsb' ) ),
					el( 'div', { className: 'kndsb-sports-overview__search' }, i18n.__( 'Zoekveld wordt op de website actief', 'kndsb' ) )
				),
				el( 'div', innerBlocksProps )
			);
		},
		save: function () {
			return el( 'section', blockEditor.useBlockProps.save( { className: 'kndsb-sports-overview' } ),
				el( 'div', { className: 'kndsb-sports-overview__toolbar' },
					el( 'div', { className: 'kndsb-sports-overview__count', 'aria-live': 'polite', 'data-kndsb-sports-count': true } ),
					el( 'label', { className: 'kndsb-sports-overview__search' },
						el( 'span', { className: 'screen-reader-text' }, i18n.__( 'Zoek naar een sport', 'kndsb' ) ),
						el( 'input', { className: 'kndsb-sports-overview__search-field', type: 'search', placeholder: i18n.__( 'Zoek naar een sport…', 'kndsb' ), 'data-kndsb-sports-search': true } ),
						el( 'span', { className: 'kndsb-sports-overview__search-icon', 'aria-hidden': 'true' } )
					)
				),
				el( 'div', { className: 'kndsb-sports-overview__grid', 'data-kndsb-sports-grid': true }, el( InnerBlocks.Content ) ),
				el( 'p', { className: 'kndsb-sports-overview__empty', hidden: true }, i18n.__( 'Geen sporttakken gevonden.', 'kndsb' ) )
			);
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.i18n );
