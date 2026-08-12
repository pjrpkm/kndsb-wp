( function ( blocks, blockEditor, components, element, i18n ) {
	var el = element.createElement;
	var InnerBlocks = blockEditor.InnerBlocks;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody = components.PanelBody;
	var SelectControl = components.SelectControl;
	var TextControl = components.TextControl;

	function sectionSlug( value ) {
		return ( value || 'content' )
			.toLowerCase()
			.replace( /[^a-z0-9-]+/g, '-' )
			.replace( /^-+|-+$/g, '' ) || 'content';
	}

	function sectionClass( attributes ) {
		return 'section_' + sectionSlug( attributes.sectionName ) + ' kndsb-layout-section kndsb-layout-section--' + attributes.colorScheme;
	}

	function paddingClass( attributes ) {
		var className = 'padding-section-' + attributes.paddingSize;
		if ( attributes.paddingDirection === 'top' ) {
			className += ' padding-top-only';
		} else if ( attributes.paddingDirection === 'bottom' ) {
			className += ' padding-bottom-only';
		}
		if ( attributes.extraBottomSpace && attributes.extraBottomSpace !== 'none' ) {
			className += ' padding-bottom-extra-' + attributes.extraBottomSpace;
		}
		return className;
	}

	function sectionContent( attributes, innerContent ) {
		if ( attributes.containerSize === 'none' ) {
			return innerContent;
		}
		return el( 'div', { className: 'padding-global' },
			el( 'div', { className: 'container-' + attributes.containerSize },
				el( 'div', { className: paddingClass( attributes ) }, innerContent )
			)
		);
	}

	blocks.registerBlockType( 'kndsb/layout-section', {
		edit: function ( props ) {
			var attributes = props.attributes;
			return el( element.Fragment, {},
				el( InspectorControls, {},
					el( PanelBody, { title: i18n.__( 'Sectie-instellingen', 'kndsb' ), initialOpen: true },
						el( TextControl, {
							label: i18n.__( 'Unieke sectienaam', 'kndsb' ),
							help: i18n.__( 'Wordt section_[naam], bijvoorbeeld section_sport-programma.', 'kndsb' ),
							value: attributes.sectionName,
							onChange: function ( value ) { props.setAttributes( { sectionName: sectionSlug( value ) } ); }
						} ),
						el( SelectControl, {
							label: i18n.__( 'Achtergrond', 'kndsb' ),
							value: attributes.colorScheme,
							options: [
								{ label: 'Wit', value: 'white' },
								{ label: 'Gebroken blauw-wit', value: 'blue-white' },
								{ label: 'Blauw', value: 'blue' },
								{ label: 'Oranje', value: 'orange' },
								{ label: 'Rood', value: 'red' }
							],
							onChange: function ( value ) { props.setAttributes( { colorScheme: value } ); }
						} ),
						el( SelectControl, {
							label: i18n.__( 'Container', 'kndsb' ),
							value: attributes.containerSize,
							options: [
								{ label: 'Geen – volledige breedte', value: 'none' },
								{ label: 'Klein – leestekst', value: 'small' },
								{ label: 'Middel', value: 'medium' },
								{ label: 'Groot – standaard', value: 'large' },
								{ label: 'Breed', value: 'wide' }
							],
							onChange: function ( value ) { props.setAttributes( { containerSize: value } ); }
						} ),
						el( SelectControl, {
							label: i18n.__( 'Verticale ruimte', 'kndsb' ),
							value: attributes.paddingSize,
							options: [
								{ label: 'Geen', value: 'none' },
								{ label: 'Klein', value: 'small' },
								{ label: 'Middel – standaard', value: 'medium' },
								{ label: 'Groot', value: 'large' }
							],
							onChange: function ( value ) { props.setAttributes( { paddingSize: value } ); }
						} ),
						el( SelectControl, {
							label: i18n.__( 'Richting verticale ruimte', 'kndsb' ),
							value: attributes.paddingDirection,
							options: [
								{ label: 'Boven en onder', value: 'both' },
								{ label: 'Alleen boven', value: 'top' },
								{ label: 'Alleen onder', value: 'bottom' }
							],
							onChange: function ( value ) { props.setAttributes( { paddingDirection: value } ); }
						} ),
						el( SelectControl, {
							label: i18n.__( 'Extra ruimte onder', 'kndsb' ),
							value: attributes.extraBottomSpace || 'none',
							options: [
								{ label: 'Geen – standaard', value: 'none' },
								{ label: 'Klein', value: 'small' },
								{ label: 'Middel', value: 'medium' },
								{ label: 'Groot', value: 'large' },
								{ label: 'Extra groot', value: 'xlarge' }
							],
							onChange: function ( value ) { props.setAttributes( { extraBottomSpace: value } ); }
						} )
					)
				),
				el( 'section', blockEditor.useBlockProps( { className: sectionClass( attributes ) } ),
					sectionContent( attributes, el( InnerBlocks, { templateLock: false } ) )
				)
			);
		},
		save: function ( props ) {
			var attributes = props.attributes;
			return el( 'section', blockEditor.useBlockProps.save( { className: sectionClass( attributes ) } ),
				sectionContent( attributes, el( InnerBlocks.Content ) )
			);
		},
		deprecated: [ {
			attributes: {
				colorScheme: { type: 'string', default: 'white' },
				containerSize: { type: 'string', default: 'large' },
				paddingSize: { type: 'string', default: 'medium' }
			},
			save: function ( props ) {
				var attributes = props.attributes;
				return el( 'section', blockEditor.useBlockProps.save( { className: 'kndsb-layout-section kndsb-layout-section--' + attributes.colorScheme } ),
					el( 'div', { className: 'padding-global' },
						el( 'div', { className: 'container-' + attributes.containerSize },
							el( 'div', { className: 'padding-section-' + attributes.paddingSize }, el( InnerBlocks.Content ) )
						)
					)
				);
			},
			migrate: function ( attributes ) {
				return Object.assign( {}, attributes, { sectionName: 'content' } );
			}
		} ]
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.i18n );
