( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement, InnerBlocks = blockEditor.InnerBlocks, InspectorControls = blockEditor.InspectorControls, RichText = blockEditor.RichText, PanelBody = components.PanelBody, SelectControl = components.SelectControl;
	var colors = [ { label: 'Wit', value: 'white' }, { label: 'Oranje', value: 'orange' }, { label: 'Blauw', value: 'blue' }, { label: 'Rood', value: 'red' }, { label: 'Gebroken blauw-wit', value: 'blue-white' } ];
	function variation( name, title, sectionTitle, type, color ) { blocks.registerBlockVariation( 'kndsb/sport-section', { name: name, title: title, attributes: { title: sectionTitle, sectionType: type, colorScheme: color || 'white' }, scope: [ 'inserter' ] } ); }
	blocks.registerBlockType( 'kndsb/sport-section', {
		edit: function ( props ) {
			var a = props.attributes, className = 'kndsb-sport-section kndsb-sport-section--' + a.colorScheme + ' kndsb-sport-section--' + a.sectionType;
			return el( element.Fragment, {}, el( InspectorControls, {}, el( PanelBody, { title: i18n.__( 'Sectie-instellingen', 'kndsb' ) }, el( SelectControl, { label: i18n.__( 'Kleur', 'kndsb' ), value: a.colorScheme, options: colors, onChange: function ( value ) { props.setAttributes( { colorScheme: value } ); } } ) ) ), el( 'section', blockEditor.useBlockProps( { className: className } ), el( 'div', { className: 'kndsb-sport-section__inner' }, el( RichText, { tagName: 'h2', className: 'kndsb-sport-section__title', value: a.title, allowedFormats: [], onChange: function ( value ) { props.setAttributes( { title: value } ); } } ), el( InnerBlocks, { template: [ [ 'core/paragraph', { placeholder: i18n.__( 'Voeg inhoud toe…', 'kndsb' ) } ] ], templateLock: false } ) ) ) );
		},
		save: function ( props ) { var a = props.attributes, className = 'kndsb-sport-section kndsb-sport-section--' + a.colorScheme + ' kndsb-sport-section--' + a.sectionType; return el( 'section', blockEditor.useBlockProps.save( { className: className } ), el( 'div', { className: 'kndsb-sport-section__inner' }, el( RichText.Content, { tagName: 'h2', className: 'kndsb-sport-section__title', value: a.title } ), el( InnerBlocks.Content ) ) ); }
	} );
	variation( 'about', 'KNDSB over sport', 'Over de sport', 'about', 'white' );
	variation( 'contact', 'KNDSB sport contact', 'Contact', 'contact', 'white' );
	variation( 'federation', 'KNDSB sportbond informatie', 'Sportbond en praktische informatie', 'federation', 'blue' );
	variation( 'sponsor', 'KNDSB sport hoofdsponsor', 'Trotse hoofdsponsor', 'sponsor', 'blue-white' );
	variation( 'partners', 'KNDSB sport partnerbalk', 'Partners', 'partners', 'red' );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
