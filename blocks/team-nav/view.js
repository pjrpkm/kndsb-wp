/* KNDSB 1.10.2 — normal WordPress navigation with viewport preservation. */
(function () {
	var key = 'kndsbTeamViewportY';

	document.addEventListener('click', function (event) {
		var link = event.target.closest('.wp-block-kndsb-team-nav a');
		if (!link || event.defaultPrevented || event.button !== 0 ||
			event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;

		try {
			var url = new URL(link.href, window.location.href);
			if (url.origin !== window.location.origin) return;
			sessionStorage.setItem(key, String(window.scrollY));
		} catch (e) {}
	}, true);

	var stored = sessionStorage.getItem(key);
	if (stored !== null) {
		sessionStorage.removeItem(key);
		var y = parseInt(stored, 10);
		if (!Number.isNaN(y)) {
			if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
			var restore = function () { window.scrollTo(0, y); };
			requestAnimationFrame(function () {
				requestAnimationFrame(restore);
			});
			window.addEventListener('load', restore, { once: true });
		}
	}
})();
