( function () {
	'use strict';

	function activateProgramRows() {
		var chevron = '<svg class="kndsb-sport-page__chevron" viewBox="0 0 20 20" aria-hidden="true" focusable="false"><path d="m7.5 4.5 5.5 5.5-5.5 5.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"></path></svg>';

		document.querySelectorAll( '.kndsb-sport-page__program-row' ).forEach( function ( row ) {
			var link = row.querySelector( 'a[href]' );
			var url = link ? link.href : '/agenda/';

			row.classList.add( 'kndsb-sport-page__program-row--clickable' );
			row.setAttribute( 'role', 'link' );
			row.setAttribute( 'tabindex', '0' );

			var arrow = row.querySelector( '.kndsb-sport-page__program-arrow' );
			if ( arrow ) {
				arrow.innerHTML = chevron;
			}

			function openProgram( event ) {
				if ( event.type === 'keydown' && event.key !== 'Enter' && event.key !== ' ' ) {
					return;
				}
				if ( event.target.closest( 'a' ) ) {
					return;
				}
				event.preventDefault();
				window.location.href = url;
			}

			row.addEventListener( 'click', openProgram );
			row.addEventListener( 'keydown', openProgram );
		} );

		document.querySelectorAll( '.kndsb-sport-page__button .wp-block-button__link' ).forEach( function ( button ) {
			if ( ! button.hasAttribute( 'href' ) ) {
				button.setAttribute( 'href', '/agenda/' );
			}
			if ( ! button.querySelector( 'svg' ) ) {
				button.textContent = button.textContent.replace( /\s*[›>]\s*$/, '' ).trim();
				button.insertAdjacentHTML( 'beforeend', chevron );
			}
		} );

		document.querySelectorAll( '.kndsb-sport-page__contact-card h3' ).forEach( function ( heading ) {
			if ( heading.textContent.trim().toLowerCase() === 'coördinator' || heading.textContent.trim().toLowerCase() === 'coordinator' ) {
				heading.textContent = 'Contact';
			}
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', activateProgramRows );
	} else {
		activateProgramRows();
	}
}() );
