( function ( blocks, blockEditor, components, data, element, i18n, serverSideRender ) {
	var el = element.createElement, InspectorControls = blockEditor.InspectorControls, PanelBody = components.PanelBody, SelectControl = components.SelectControl;
	blocks.registerBlockType( 'kndsb/team-featured', { edit: function ( props ) {
		var categories = data.useSelect( function ( select ) { return select( 'core' ).getEntityRecords( 'taxonomy', 'category', { per_page: 100 } ); }, [] );
		var options = [ { label: i18n.__( 'Kies een teamcategorie', 'kndsb' ), value: 0 } ];
		( categories || [] ).forEach( function ( category ) { options.push( { label: category.name, value: category.id } ); } );
		return el( element.Fragment, {}, el( InspectorControls, {}, el( PanelBody, { title: i18n.__( 'Teamnieuws', 'kndsb' ) }, el( SelectControl, { label: i18n.__( 'Categorie', 'kndsb' ), value: props.attributes.categoryId, options: options, onChange: function ( value ) { props.setAttributes( { categoryId: Number( value ) } ); } } ) ) ), el( 'div', blockEditor.useBlockProps( { className: 'kndsb-team-featured__editor' } ), el( serverSideRender, { block: 'kndsb/team-featured', attributes: props.attributes } ) ) );
	}, save: function () { return null; } } );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.data, window.wp.element, window.wp.i18n, window.wp.serverSideRender );
