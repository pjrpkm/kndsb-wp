( function () {
	function icon( direction ) {
		var path = direction === 'previous' ? 'm12.5 4.5-5.5 5.5 5.5 5.5' : 'm7.5 4.5 5.5 5.5-5.5 5.5';
		return '<svg viewBox="0 0 20 20" aria-hidden="true" focusable="false"><path d="' + path + '" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"/></svg>';
	}

	function setupSlider( section, track ) {
		if ( ! track || section.querySelector( '.kndsb-team-page__slider-controls' ) ) return;
		track.classList.add( 'kndsb-team-page__slider-track' );
		var controls = document.createElement( 'div' );
		controls.className = 'kndsb-team-page__slider-controls';
		[ 'previous', 'next' ].forEach( function ( direction ) {
			var button = document.createElement( 'button' );
			button.type = 'button';
			button.className = 'kndsb-team-page__slider-button kndsb-team-page__slider-button--' + direction;
			button.setAttribute( 'aria-label', direction === 'previous' ? 'Vorige items' : 'Volgende items' );
			button.innerHTML = icon( direction );
			button.addEventListener( 'click', function () {
				track.scrollBy( { left: ( direction === 'previous' ? -1 : 1 ) * track.clientWidth * .85, behavior: 'smooth' } );
			} );
			controls.appendChild( button );
		} );
		section.appendChild( controls );
	}

	document.querySelectorAll( '.kndsb-team-page__results' ).forEach( function ( section ) {
		var track = section.querySelector( '.kndsb-team-page__result-grid' );
		if ( track && track.children.length > 3 ) setupSlider( section, track );
	} );
} )();
