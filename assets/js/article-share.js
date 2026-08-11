(function () {
  'use strict';
  document.addEventListener('click', function (event) {
    var button = event.target.closest('[data-kndsb-copy-link]');
    if (!button) return;
    var url = button.getAttribute('data-url') || window.location.href;
    var label = button.querySelector('[data-kndsb-copy-label]');
    var status = button.closest('.kndsb-article-share').querySelector('[data-kndsb-copy-status]');
    var success = function () {
      if (label) label.textContent = 'Gekopieerd';
      if (status) status.textContent = 'Link gekopieerd naar het klembord.';
      window.setTimeout(function () { if (label) label.textContent = 'Kopieer link'; }, 2000);
    };
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(url).then(success).catch(function () {});
      return;
    }
    var input = document.createElement('textarea');
    input.value = url;
    input.setAttribute('readonly', '');
    input.style.position = 'fixed';
    input.style.opacity = '0';
    document.body.appendChild(input);
    input.select();
    try { if (document.execCommand('copy')) success(); } catch (e) {}
    document.body.removeChild(input);
  });
}());
