( function () {
	function normalise( value ) {
		return value.toLocaleLowerCase( 'nl' ).normalize( 'NFD' ).replace( /[\u0300-\u036f]/g, '' ).trim();
	}

	document.querySelectorAll( '.kndsb-sports-overview' ).forEach( function ( overview ) {
		var input = overview.querySelector( '[data-kndsb-sports-search]' );
		var counter = overview.querySelector( '[data-kndsb-sports-count]' );
		var empty = overview.querySelector( '.kndsb-sports-overview__empty' );
		var cards = Array.prototype.slice.call( overview.querySelectorAll( '.kndsb-sport-card' ) );

		if ( ! input || ! counter ) return;

		function filterSports() {
			var query = normalise( input.value );
			var visible = 0;

			cards.forEach( function ( card ) {
				var matches = ! query || normalise( card.getAttribute( 'data-sport-name' ) || '' ).indexOf( query ) !== -1;
				card.hidden = ! matches;
				if ( matches ) visible += 1;
			} );

			counter.textContent = visible + ( visible === 1 ? ' sport gevonden' : ' sporten gevonden' );
			if ( empty ) empty.hidden = visible !== 0;
		}

		input.addEventListener( 'input', filterSports );
		filterSports();
	} );
} )();
