( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var InnerBlocks = blockEditor.InnerBlocks;
	var InspectorControls = blockEditor.InspectorControls;
	var RichText = blockEditor.RichText;
	var useInnerBlocksProps = blockEditor.useInnerBlocksProps;
	var PanelBody = components.PanelBody;
	var SelectControl = components.SelectControl;
	var template = [
		[ 'kndsb/team-card', { title: 'Oranje Doven Futsal Mannen', url: '/sporttakken/futsal/mannen/' } ],
		[ 'kndsb/team-card', { title: 'Oranje Doven Futsal Vrouwen', url: '/sporttakken/futsal/vrouwen/' } ],
		[ 'kndsb/team-card', { title: 'Oranje Doven Futsal O18', url: '/sporttakken/futsal/o18/' } ]
	];

	function sectionClass( scheme ) {
		return 'alignfull section_sport-teams kndsb-team-overview-section kndsb-team-overview-section--' + scheme;
	}

	function content( props, isSave ) {
		var title = isSave
			? el( RichText.Content, { tagName: 'h2', className: 'kndsb-team-overview__title', value: props.attributes.title } )
			: el( RichText, { tagName: 'h2', className: 'kndsb-team-overview__title', value: props.attributes.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); }, placeholder: i18n.__( 'Titel teamoverzicht', 'kndsb' ) } );
		var grid = isSave
			? el( 'div', { className: 'kndsb-team-overview__grid' }, el( InnerBlocks.Content ) )
			: el( 'div', useInnerBlocksProps( { className: 'kndsb-team-overview__grid' }, { allowedBlocks: [ 'kndsb/team-card' ], template: template, templateLock: false, renderAppender: InnerBlocks.ButtonBlockAppender } ) );

		return el( 'div', { className: 'padding-global' },
			el( 'div', { className: 'container-large' },
				el( 'div', { className: 'padding-section-medium' },
					el( 'div', { className: 'kndsb-team-overview' }, title, grid )
				)
			)
		);
	}

	blocks.registerBlockType( 'kndsb/team-overview', {
		edit: function ( props ) {
			var scheme = props.attributes.colorScheme || 'orange';
			return el( element.Fragment, {},
				el( InspectorControls, {}, el( PanelBody, { title: i18n.__( 'Kleur teamoverzicht', 'kndsb' ) },
					el( SelectControl, {
						label: i18n.__( 'Achtergrondkleur', 'kndsb' ),
						value: scheme,
						options: [
							{ label: i18n.__( 'Oranje', 'kndsb' ), value: 'orange' },
							{ label: i18n.__( 'Blauw', 'kndsb' ), value: 'blue' },
							{ label: i18n.__( 'Rood', 'kndsb' ), value: 'red' },
							{ label: i18n.__( 'Gebroken blauw-wit', 'kndsb' ), value: 'blue-white' }
						],
						onChange: function ( value ) { props.setAttributes( { colorScheme: value } ); }
					} )
				) ),
				el( 'section', blockEditor.useBlockProps( { className: sectionClass( scheme ) } ), content( props, false ) )
			);
		},
		save: function ( props ) {
			var scheme = props.attributes.colorScheme || 'orange';
			return el( 'section', blockEditor.useBlockProps.save( { className: sectionClass( scheme ) } ), content( props, true ) );
		},
		deprecated: [ {
			attributes: {
				title: { type: 'string', default: 'Oranje Doven Futsal' },
				colorScheme: { type: 'string', default: 'orange' }
			},
			save: function ( props ) {
				var scheme = props.attributes.colorScheme || 'orange';
				var className = 'kndsb-team-overview' + ( scheme === 'orange' ? '' : ' kndsb-team-overview--' + scheme );
				return el( 'section', blockEditor.useBlockProps.save( { className: className } ),
					el( RichText.Content, { tagName: 'h2', className: 'kndsb-team-overview__title', value: props.attributes.title } ),
					el( 'div', { className: 'kndsb-team-overview__grid' }, el( InnerBlocks.Content ) )
				);
			}
		} ]
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
