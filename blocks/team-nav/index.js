( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var items = [
		{ key: 'overview', label: 'Overzicht', slug: 'overzicht/', toggle: 'showOverview' },
		{ key: 'program', label: 'Programma', slug: 'programma/', toggle: 'showProgram' },
		{ key: 'results', label: 'Uitslagen', slug: 'uitslagen/', toggle: 'showResults' },
		{ key: 'squad', label: 'Spelers & staf', slug: 'spelers-staf/', toggle: 'showSquad' },
		{ key: 'info', label: 'Info', slug: 'info/', toggle: 'showInfo' }
	];

	function normaliseBaseUrl( value ) {
		var url = value || '/';
		return url.slice( -1 ) === '/' ? url : url + '/';
	}

	function navigation( attributes, editable ) {
		var baseUrl = normaliseBaseUrl( attributes.baseUrl );
		return el( 'nav', {},
			el( 'ul', { className: 'kndsb-team-page__nav-list' }, items.filter( function ( item ) {
				return attributes[ item.toggle ] !== false;
			} ).map( function ( item ) {
				var active = attributes.activeItem === item.key;
				return el( 'li', { className: active ? 'is-active' : '', key: item.key },
					el( 'a', {
						href: baseUrl + item.slug,
						'aria-current': active ? 'page' : undefined,
						onClick: editable ? function ( event ) { event.preventDefault(); } : undefined
					}, item.label )
				);
			} ) )
		);
	}

	blocks.registerBlockType( 'kndsb/team-nav', {
		edit: function ( props ) {
			var attributes = props.attributes;
			return el( element.Fragment, {},
				el( blockEditor.InspectorControls, {},
					el( components.PanelBody, { title: i18n.__( 'Teamnavigatie', 'kndsb' ), initialOpen: true },
						el( components.TextControl, {
							label: i18n.__( 'Basis-URL', 'kndsb' ),
							help: i18n.__( 'Bijvoorbeeld /sporttakken/futsal/o18/', 'kndsb' ),
							value: attributes.baseUrl,
							onChange: function ( value ) { props.setAttributes( { baseUrl: value } ); }
						} ),
						el( components.SelectControl, {
							label: i18n.__( 'Actieve pagina', 'kndsb' ),
							value: attributes.activeItem,
							options: items.map( function ( item ) { return { label: item.label, value: item.key }; } ),
							onChange: function ( value ) { props.setAttributes( { activeItem: value } ); }
						} ),
						items.map( function ( item ) {
							return el( components.ToggleControl, {
								label: item.label + ' tonen',
								checked: attributes[ item.toggle ] !== false,
								key: item.toggle,
								onChange: function ( value ) { var update = {}; update[ item.toggle ] = value; props.setAttributes( update ); }
							} );
						} )
					)
				),
				el( 'div', blockEditor.useBlockProps( { className: 'kndsb-team-page__nav' } ), navigation( attributes, true ) )
			);
		},
		save: function ( props ) {
			return el( 'div', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__nav' } ), navigation( props.attributes, false ) );
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
