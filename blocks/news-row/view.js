( function () {
	function decodeTitle( html ) {
		var element = document.createElement( 'textarea' );
		element.innerHTML = html || '';
		return element.value;
	}

	function getImageUrl( post ) {
		var media = post._embedded && post._embedded['wp:featuredmedia'] ? post._embedded['wp:featuredmedia'][0] : null;
		var sizes = media && media.media_details ? media.media_details.sizes : null;
		if ( sizes && sizes.medium_large ) return sizes.medium_large.source_url;
		if ( sizes && sizes.medium ) return sizes.medium.source_url;
		return media ? media.source_url : '';
	}

	function createCard( post ) {
		var article = document.createElement( 'article' );
		var mediaLink = document.createElement( 'a' );
		var body = document.createElement( 'div' );
		var heading = document.createElement( 'h3' );
		var titleLink = document.createElement( 'a' );
		var imageUrl = getImageUrl( post );

		article.className = 'kndsb-post-card';
		mediaLink.className = 'kndsb-post-card__media';
		mediaLink.href = post.link;
		mediaLink.setAttribute( 'aria-hidden', 'true' );
		mediaLink.tabIndex = -1;

		if ( imageUrl ) {
			var image = document.createElement( 'img' );
			image.className = 'kndsb-post-card__image';
			image.src = imageUrl;
			image.alt = '';
			image.loading = 'eager';
			mediaLink.appendChild( image );
		} else {
			var placeholder = document.createElement( 'span' );
			placeholder.className = 'kndsb-post-card__placeholder';
			mediaLink.appendChild( placeholder );
		}

		body.className = 'kndsb-post-card__body';
		heading.className = 'kndsb-post-card__title';
		titleLink.className = 'kndsb-post-card__link';
		titleLink.href = post.link;
		titleLink.textContent = decodeTitle( post.title && post.title.rendered );
		heading.appendChild( titleLink );
		body.appendChild( heading );
		article.appendChild( mediaLink );
		article.appendChild( body );
		return article;
	}

	document.querySelectorAll( '.kndsb-news-row' ).forEach( function ( section ) {
		var button = section.querySelector( '.kndsb-news-row__load-more' );
		var grid = section.querySelector( '[data-posts-grid]' );
		if ( ! button || ! grid ) return;

		button.addEventListener( 'click', function () {
			var page = Number( section.dataset.postsPage ) + 1;
			var url = new URL( section.dataset.endpoint );
			url.searchParams.set( 'categories', section.dataset.categoryId );
			url.searchParams.set( 'page', page );
			url.searchParams.set( 'per_page', section.dataset.postsCount );
			url.searchParams.set( '_embed', 'wp:featuredmedia' );
			button.disabled = true;
			button.textContent = 'Laden…';

			fetch( url.toString() )
				.then( function ( response ) {
					if ( ! response.ok ) throw new Error();
					var totalPages = Number( response.headers.get( 'X-WP-TotalPages' ) || page );
					return response.json().then( function ( posts ) { return { posts: posts, totalPages: totalPages }; } );
				} )
				.then( function ( result ) {
					result.posts.forEach( function ( post ) { grid.appendChild( createCard( post ) ); } );
					section.dataset.postsPage = page;
					button.disabled = false;
					button.innerHTML = 'Laad meer <span aria-hidden="true">⌄</span>';
					if ( page >= result.totalPages ) button.hidden = true;
				} )
				.catch( function () {
					button.disabled = false;
					button.textContent = 'Probeer opnieuw';
				} );
		} );
	} );
} )();
