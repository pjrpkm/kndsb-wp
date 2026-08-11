( function ( blocks, blockEditor, element, components, data, serverSideRender, i18n ) {
	var el = element.createElement, InspectorControls = blockEditor.InspectorControls, PanelBody = components.PanelBody, RangeControl = components.RangeControl, SelectControl = components.SelectControl;
	blocks.registerBlockType( 'kndsb/featured-grid', { edit: function ( props ) {
		var a = props.attributes, categories = data.useSelect( function ( select ) { return select( 'core' ).getEntityRecords( 'taxonomy', 'category', { per_page: 100 } ); }, [] );
		var options = [ { label: i18n.__( 'Alle categorieën', 'kndsb' ), value: 0 } ];
		( categories || [] ).forEach( function ( category ) { options.push( { label: category.name, value: category.id } ); } );
		return el( element.Fragment, {}, el( InspectorControls, {}, el( PanelBody, { title: i18n.__( 'Berichten', 'kndsb' ) },
			el( RangeControl, { label: i18n.__( 'Aantal', 'kndsb' ), min: 1, max: 8, value: a.postsToShow, onChange: function ( value ) { props.setAttributes( { postsToShow: value } ); } } ),
			el( SelectControl, { label: i18n.__( 'Categorie', 'kndsb' ), value: a.categoryId, options: options, onChange: function ( value ) { props.setAttributes( { categoryId: Number( value ) } ); } } ) ) ),
			el( 'div', blockEditor.useBlockProps(), el( serverSideRender, { block: 'kndsb/featured-grid', attributes: a } ) ) );
	}, save: function () { return null; } } );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.data, window.wp.serverSideRender, window.wp.i18n );
