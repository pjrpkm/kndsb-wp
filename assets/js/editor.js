( function () {
	function hideLegacyImageFilter() {
		document.querySelectorAll( '.media-modal .compat-field, .media-modal .setting' ).forEach( function ( field ) {
			if ( /image filter/i.test( field.textContent || '' ) ) {
				field.hidden = true;
			}
		} );
	}

	var observer = new MutationObserver( hideLegacyImageFilter );
	observer.observe( document.body, { childList: true, subtree: true } );
	hideLegacyImageFilter();
} )();
