( function ( blocks, blockEditor, element, components, data, serverSideRender, i18n ) {
	var el = element.createElement;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody = components.PanelBody;
	var RangeControl = components.RangeControl;
	var SelectControl = components.SelectControl;
	var ToggleControl = components.ToggleControl;

	blocks.registerBlockType( 'kndsb/posts-grid', {
		edit: function ( props ) {
			var a = props.attributes;
			var categories = data.useSelect( function ( select ) { return select( 'core' ).getEntityRecords( 'taxonomy', 'category', { per_page: 100 } ); }, [] );
			var options = [ { label: i18n.__( 'Alle categorieën', 'kndsb' ), value: 0 } ];
			( categories || [] ).forEach( function ( category ) { options.push( { label: category.name, value: category.id } ); } );
			return el( element.Fragment, {},
				el( InspectorControls, {}, el( PanelBody, { title: i18n.__( 'Weergave', 'kndsb' ) },
					el( RangeControl, { label: i18n.__( 'Aantal berichten', 'kndsb' ), min: 1, max: 12, value: a.postsToShow, onChange: function ( value ) { props.setAttributes( { postsToShow: value } ); } } ),
					el( RangeControl, { label: i18n.__( 'Kolommen', 'kndsb' ), min: 1, max: 4, value: a.columns, onChange: function ( value ) { props.setAttributes( { columns: value } ); } } ),
					el( SelectControl, { label: i18n.__( 'Categorie', 'kndsb' ), value: a.categoryId, options: options, onChange: function ( value ) { props.setAttributes( { categoryId: Number( value ) } ); } } ),
					el( ToggleControl, { label: i18n.__( 'Datum tonen', 'kndsb' ), checked: a.showDate, onChange: function ( value ) { props.setAttributes( { showDate: value } ); } } ),
					el( ToggleControl, { label: i18n.__( 'Samenvatting tonen', 'kndsb' ), checked: a.showExcerpt, onChange: function ( value ) { props.setAttributes( { showExcerpt: value } ); } } )
				) ),
				el( 'div', blockEditor.useBlockProps(), el( serverSideRender, { block: 'kndsb/posts-grid', attributes: a } ) )
			);
		},
		save: function () { return null; }
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.data, window.wp.serverSideRender, window.wp.i18n );
