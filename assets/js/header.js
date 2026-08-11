( function () {
	var header = document.querySelector( '[data-kndsb-header]' );
	if ( ! header ) return;

	var menuButton = header.querySelector( '.kndsb-header__menu-toggle' );
	var mobilePanel = header.querySelector( '.kndsb-header__mobile-panel' );
	var searchButton = header.querySelector( '.kndsb-header__search-toggle' );
	var searchPanel = header.querySelector( '.kndsb-header__search' );
	var megaNav = header.querySelector( '[data-kndsb-mega-nav]' );
	var megaTriggers = Array.prototype.slice.call( header.querySelectorAll( '[data-kndsb-mega-trigger]' ) );
	var megaPanels = Array.prototype.slice.call( header.querySelectorAll( '[data-kndsb-mega-panel]' ) );
	var activeMegaIndex = -1;
	var closeTimer;

	function updateStickyState() {
		header.classList.toggle( 'kndsb-header--stuck', window.scrollY > 120 );
	}

	if ( menuButton && mobilePanel ) {
		menuButton.addEventListener( 'click', function () {
			var open = menuButton.getAttribute( 'aria-expanded' ) === 'true';
			menuButton.setAttribute( 'aria-expanded', String( ! open ) );
			mobilePanel.hidden = open;
		} );
	}

	if ( searchButton && searchPanel ) {
		searchButton.addEventListener( 'click', function () {
			var open = searchButton.getAttribute( 'aria-expanded' ) === 'true';
			searchButton.setAttribute( 'aria-expanded', String( ! open ) );
			searchPanel.hidden = open;
			if ( ! open && searchPanel.querySelector( 'input' ) ) {
				searchPanel.querySelector( 'input' ).focus();
			}
		} );
	}

	function openMegaNav( trigger ) {
		if ( ! megaNav || window.matchMedia( '(max-width: 960px)' ).matches ) return;

		var index = Number( trigger.getAttribute( 'data-kndsb-mega-trigger' ) );
		var direction = activeMegaIndex < 0 || index >= activeMegaIndex ? 'next' : 'previous';
		clearTimeout( closeTimer );

		megaTriggers.forEach( function ( item ) {
			var active = item === trigger;
			item.setAttribute( 'aria-expanded', String( active ) );
			item.parentNode.classList.toggle( 'kndsb-header__menu-item--active', active );
		} );

		megaPanels.forEach( function ( panel ) {
			var active = Number( panel.getAttribute( 'data-kndsb-mega-panel' ) ) === index;
			panel.hidden = ! active;
			if ( active ) {
				panel.setAttribute( 'data-direction', direction );
			}
		} );

		megaNav.hidden = false;
		activeMegaIndex = index;
	}

	function closeMegaNav() {
		if ( ! megaNav ) return;
		megaNav.hidden = true;
		activeMegaIndex = -1;
		megaTriggers.forEach( function ( item ) {
			item.setAttribute( 'aria-expanded', 'false' );
			item.parentNode.classList.remove( 'kndsb-header__menu-item--active' );
		} );
	}

	function scheduleMegaClose() {
		clearTimeout( closeTimer );
		closeTimer = setTimeout( closeMegaNav, 140 );
	}

	megaTriggers.forEach( function ( trigger ) {
		trigger.addEventListener( 'mouseenter', function () { openMegaNav( trigger ); } );
		trigger.addEventListener( 'focus', function () { openMegaNav( trigger ); } );
	} );

	header.querySelectorAll( '.kndsb-header__menu-link:not([data-kndsb-mega-trigger])' ).forEach( function ( link ) {
		link.addEventListener( 'mouseenter', closeMegaNav );
		link.addEventListener( 'focus', closeMegaNav );
	} );

	if ( megaNav ) {
		megaNav.addEventListener( 'mouseenter', function () { clearTimeout( closeTimer ); } );
		megaNav.addEventListener( 'mouseleave', scheduleMegaClose );
	}

	var primaryMenu = header.querySelector( '.kndsb-header__primary' );
	if ( primaryMenu ) primaryMenu.addEventListener( 'mouseleave', scheduleMegaClose );

	document.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'Escape' ) closeMegaNav();
	} );

	document.addEventListener( 'click', function ( event ) {
		if ( megaNav && ! header.contains( event.target ) ) closeMegaNav();
	} );

	window.addEventListener( 'scroll', updateStickyState, { passive: true } );
	updateStickyState();
} )();
