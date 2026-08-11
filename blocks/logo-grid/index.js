( function ( blocks, blockEditor, element, i18n ) {
	var el = element.createElement;
	var InnerBlocks = blockEditor.InnerBlocks;
	var ALLOWED = [ 'kndsb/logo-card' ];
	var TEMPLATE = [ [ 'kndsb/logo-card' ], [ 'kndsb/logo-card' ], [ 'kndsb/logo-card' ] ];

	blocks.registerBlockType( 'kndsb/logo-grid', {
		edit: function () {
			return el( 'div', blockEditor.useBlockProps( { className: 'kndsb-logo-grid' } ),
				el( InnerBlocks, { allowedBlocks: ALLOWED, template: TEMPLATE, templateLock: false, renderAppender: InnerBlocks.ButtonBlockAppender } )
			);
		},
		save: function () {
			return el( 'div', blockEditor.useBlockProps.save( { className: 'kndsb-logo-grid' } ), el( InnerBlocks.Content ) );
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.i18n );
