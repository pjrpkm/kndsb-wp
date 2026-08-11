( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement, RichText = blockEditor.RichText;

	function logoButton( props, side ) {
		var a = props.attributes, isHome = side === 'home', url = isHome ? a.homeLogoUrl : a.awayLogoUrl, id = isHome ? a.homeLogoId : a.awayLogoId;
		return el( blockEditor.MediaUploadCheck, {}, el( blockEditor.MediaUpload, {
			allowedTypes: [ 'image' ],
			value: id,
			onSelect: function ( media ) {
				var update = {};
				update[ side + 'LogoId' ] = media.id;
				update[ side + 'LogoUrl' ] = media.url;
				update[ side + 'LogoAlt' ] = media.alt || '';
				props.setAttributes( update );
			},
			render: function ( obj ) {
				return el( 'button', { type: 'button', className: 'kndsb-team-page__fixture-logo-button', onClick: obj.open },
					url ? el( 'img', { src: url, alt: '' } ) : el( 'span', {}, i18n.__( 'Logo', 'kndsb' ) )
				);
			}
		} ) );
	}

	function teamEditor( props, side ) {
		var key = side + 'Team';
		return el( 'div', { className: 'kndsb-team-page__fixture-team kndsb-team-page__fixture-team--' + side },
			logoButton( props, side ),
			el( RichText, { tagName: 'p', value: props.attributes[key], allowedFormats: [], onChange: function ( value ) { var update = {}; update[key] = value; props.setAttributes( update ); } } )
		);
	}

	function teamSaved( a, side ) {
		var url = a[ side + 'LogoUrl' ], alt = a[ side + 'LogoAlt' ], team = a[ side + 'Team' ];
		return el( 'div', { className: 'kndsb-team-page__fixture-team kndsb-team-page__fixture-team--' + side },
			url ? el( 'img', { className: 'kndsb-team-page__fixture-logo', src: url, alt: alt || '' } ) : null,
			el( RichText.Content, { tagName: 'p', value: team } )
		);
	}

	function oldSaveWithLogos( props ) {
		var a = props.attributes, content = [ teamSaved( a, 'home' ), el( RichText.Content, { tagName: 'strong', value: a.date } ), teamSaved( a, 'away' ) ];
		return a.url ? el( 'a', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__fixture kndsb-team-page__fixture--linked', href: a.url } ), content ) : el( 'div', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__fixture' } ), content );
	}

	function oldSave( props ) {
		var a = props.attributes, content = [ el( RichText.Content, { tagName: 'p', value: a.homeTeam } ), el( RichText.Content, { tagName: 'strong', value: a.date } ), el( RichText.Content, { tagName: 'p', value: a.awayTeam } ) ];
		return a.url ? el( 'a', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__fixture kndsb-team-page__fixture--linked', href: a.url } ), content ) : el( 'div', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__fixture' } ), content );
	}

	blocks.registerBlockType( 'kndsb/team-program-item', {
		edit: function ( props ) {
			var a = props.attributes;
			return el( element.Fragment, {},
				el( blockEditor.InspectorControls, {},
					el( components.PanelBody, { title: i18n.__( 'Wedstrijd', 'kndsb' ) },
						el( components.TextControl, { label: i18n.__( 'Tijd', 'kndsb' ), value: a.time, onChange: function ( value ) { props.setAttributes( { time: value } ); } } ),
						el( components.TextControl, { label: i18n.__( 'URL (optioneel)', 'kndsb' ), value: a.url, onChange: function ( value ) { props.setAttributes( { url: value } ); } } )
					)
				),
				el( 'div', blockEditor.useBlockProps( { className: 'kndsb-team-page__fixture' } ),
					teamEditor( props, 'home' ),
					el( 'div', { className: 'kndsb-team-page__fixture-meta' },
						el( RichText, { tagName: 'strong', className: 'kndsb-team-page__fixture-date', value: a.date, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { date: value } ); } } ),
						el( RichText, { tagName: 'span', className: 'kndsb-team-page__fixture-time', value: a.time, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { time: value } ); }, placeholder: '18:00' } )
					),
					teamEditor( props, 'away' )
				)
			);
		},
		save: function ( props ) {
			var a = props.attributes;
			var content = [
				teamSaved( a, 'home' ),
				el( 'div', { className: 'kndsb-team-page__fixture-meta' },
					el( RichText.Content, { tagName: 'strong', className: 'kndsb-team-page__fixture-date', value: a.date } ),
					el( RichText.Content, { tagName: 'span', className: 'kndsb-team-page__fixture-time', value: a.time } )
				),
				teamSaved( a, 'away' )
			];
			return a.url ? el( 'a', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__fixture kndsb-team-page__fixture--linked', href: a.url } ), content ) : el( 'div', blockEditor.useBlockProps.save( { className: 'kndsb-team-page__fixture' } ), content );
		},
		deprecated: [
			{
				attributes: {
					homeTeam: { type: 'string', default: 'Nederland O18' }, date: { type: 'string', default: '24 SEP' }, awayTeam: { type: 'string', default: 'België O18' }, url: { type: 'string', default: '' },
					homeLogoId: { type: 'number', default: 0 }, homeLogoUrl: { type: 'string', default: '' }, homeLogoAlt: { type: 'string', default: '' },
					awayLogoId: { type: 'number', default: 0 }, awayLogoUrl: { type: 'string', default: '' }, awayLogoAlt: { type: 'string', default: '' }
				},
				save: oldSaveWithLogos
			},
			{ attributes: { homeTeam: { type: 'string', default: 'Nederland O18' }, date: { type: 'string', default: '24 SEP' }, awayTeam: { type: 'string', default: 'België O18' }, url: { type: 'string', default: '' } }, save: oldSave }
		]
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
