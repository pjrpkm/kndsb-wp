( function ( blocks, blockEditor, element, i18n ) {
	var el = element.createElement;
	var InnerBlocks = blockEditor.InnerBlocks;
	var RichText = blockEditor.RichText;
	var template = [
		[ 'kndsb/board-member', { name: 'Ko ter Linden', role: 'Voorzitter', imageUrl: '/wp-content/uploads/koterlinden-1-2-scaled.jpg' } ],
		[ 'kndsb/board-member', { name: 'Wietse Sijm', role: 'Bestuurslid sportzaken', imageUrl: '/wp-content/uploads/1764336903669.jpeg' } ],
		[ 'kndsb/board-member', { name: 'Johan Hessing', role: 'Penningmeester bij volmacht', imageUrl: '/wp-content/uploads/Johan-Hessing-2-e1774818337924.jpg' } ]
	];

	blocks.registerBlockType( 'kndsb/board-members', {
		edit: function ( props ) {
			return el( 'div', blockEditor.useBlockProps( { className: 'kndsb-board-members' } ),
				el( RichText, {
					tagName: 'h2', className: 'kndsb-board-page__section-title',
					value: props.attributes.title,
					onChange: function ( value ) { props.setAttributes( { title: value } ); },
					placeholder: i18n.__( 'Sectietitel', 'kndsb' )
				} ),
				el( 'div', { className: 'kndsb-board-page__grid' },
					el( InnerBlocks, { allowedBlocks: [ 'kndsb/board-member', 'kndsb/board-vacancy' ], template: template, orientation: 'horizontal', renderAppender: InnerBlocks.ButtonBlockAppender } )
				)
			);
		},
		save: function ( props ) {
			return el( 'div', blockEditor.useBlockProps.save( { className: 'kndsb-board-members' } ),
				el( RichText.Content, { tagName: 'h2', className: 'kndsb-board-page__section-title', value: props.attributes.title } ),
				el( 'div', { className: 'kndsb-board-page__grid' }, el( InnerBlocks.Content ) )
			);
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.i18n );
