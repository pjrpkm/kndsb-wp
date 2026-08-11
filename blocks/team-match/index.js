( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var RichText = blockEditor.RichText;
	var MediaUpload = blockEditor.MediaUpload;
	var MediaUploadCheck = blockEditor.MediaUploadCheck;

	function logoPicker( side, attributes, setAttributes ) {
		var urlKey = side + 'LogoUrl';
		var idKey = side + 'LogoId';
		return el( MediaUploadCheck, {}, el( MediaUpload, {
			allowedTypes: [ 'image' ],
			value: attributes[ idKey ],
			onSelect: function ( media ) { var update = {}; update[ urlKey ] = media.url; update[ idKey ] = media.id; setAttributes( update ); },
			render: function ( mediaProps ) { return el( components.Button, { className: 'kndsb-team-match__logo-button', onClick: mediaProps.open }, attributes[ urlKey ] ? el( 'img', { src: attributes[ urlKey ], alt: '' } ) : i18n.__( 'Kies logo', 'kndsb' ) ); }
		} ) );
	}

	function team( side, attributes, setAttributes, editable ) {
		var teamKey = side + 'Team';
		return el( 'div', { className: 'kndsb-team-match__team' },
			editable ? logoPicker( side, attributes, setAttributes ) : ( attributes[ side + 'LogoUrl' ] ? el( 'img', { className: 'kndsb-team-match__logo', src: attributes[ side + 'LogoUrl' ], alt: '' } ) : null ),
			editable ? el( RichText, { tagName: 'p', value: attributes[ teamKey ], allowedFormats: [], onChange: function ( value ) { var update = {}; update[ teamKey ] = value; setAttributes( update ); } } ) : el( RichText.Content, { tagName: 'p', value: attributes[ teamKey ] } )
		);
	}

	function matchMarkup( attributes, setAttributes, editable, mode ) {
		return el( 'article', editable ? blockEditor.useBlockProps( { className: 'kndsb-team-match' } ) : blockEditor.useBlockProps.save( { className: 'kndsb-team-match' } ),
			editable ? el( RichText, { tagName: 'div', className: 'kndsb-team-match__competition', value: attributes.competition, allowedFormats: [], onChange: function ( value ) { setAttributes( { competition: value } ); } } ) : el( RichText.Content, { tagName: 'div', className: 'kndsb-team-match__competition', value: attributes.competition } ),
			el( 'div', { className: 'kndsb-team-match__main' },
				team( 'home', attributes, setAttributes, editable ),
				el( 'div', { className: 'kndsb-team-match__center' },
					editable ? el( RichText, { tagName: 'p', className: 'kndsb-team-match__date', value: attributes.date, allowedFormats: [], onChange: function ( value ) { setAttributes( { date: value } ); } } ) : el( RichText.Content, { tagName: 'p', className: 'kndsb-team-match__date', value: attributes.date } ),
					editable && mode === 'results' ? el( RichText, { tagName: 'p', className: 'kndsb-team-match__value', value: attributes.score, allowedFormats: [], onChange: function ( value ) { setAttributes( { score: value } ); } } ) : null,
					editable && mode !== 'results' ? el( RichText, { tagName: 'p', className: 'kndsb-team-match__value', value: attributes.time, allowedFormats: [], onChange: function ( value ) { setAttributes( { time: value } ); } } ) : null,
					! editable ? el( RichText.Content, { tagName: 'p', className: 'kndsb-team-match__value kndsb-team-match__value--time', value: attributes.time } ) : null,
					! editable ? el( RichText.Content, { tagName: 'p', className: 'kndsb-team-match__value kndsb-team-match__value--score', value: attributes.score } ) : null
				),
				team( 'away', attributes, setAttributes, editable )
			),
			el( 'footer', { className: 'kndsb-team-match__footer' },
				el( 'span', { className: 'kndsb-team-match__pin', 'aria-hidden': 'true' }, '●' ),
				editable ? el( RichText, { tagName: 'p', value: attributes.venue, allowedFormats: [], onChange: function ( value ) { setAttributes( { venue: value } ); } } ) : el( RichText.Content, { tagName: 'p', value: attributes.venue } ),
				! editable && attributes.buttonText ? el( 'a', { className: 'kndsb-team-match__button', href: attributes.buttonUrl || '#' }, attributes.buttonText ) : null,
				editable && attributes.buttonText ? el( 'span', { className: 'kndsb-team-match__button' }, attributes.buttonText ) : null
			)
		);
	}

	blocks.registerBlockType( 'kndsb/team-match', {
		edit: function ( props ) {
			var a = props.attributes;
			return el( element.Fragment, {},
				el( blockEditor.InspectorControls, {}, el( components.PanelBody, { title: i18n.__( 'Wedstrijdlink', 'kndsb' ) },
					el( components.TextControl, { label: i18n.__( 'Knoptekst (optioneel)', 'kndsb' ), value: a.buttonText, onChange: function ( value ) { props.setAttributes( { buttonText: value } ); } } ),
					el( components.TextControl, { label: i18n.__( 'Knoplink', 'kndsb' ), value: a.buttonUrl, onChange: function ( value ) { props.setAttributes( { buttonUrl: value } ); } } )
				) ),
				matchMarkup( a, props.setAttributes, true, props.context[ 'kndsb/matchMode' ] || 'program' )
			);
		},
		save: function ( props ) { return matchMarkup( props.attributes, null, false, 'program' ); }
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
