/**
 * Inicjalizacja jQuery UI Accordion dla sekcji FAQ (strona FAQ i Dystrybutor).
 * Ładowany w stopce z zależnością od jquery-ui-accordion, więc działa po załadowaniu DOM i UI.
 */
(function() {
	'use strict';
	if (typeof jQuery === 'undefined' || !jQuery.ui || !jQuery.ui.accordion) {
		return;
	}
	jQuery(function($) {
		var opts = {
			header: '.faq-accordion-header',
			heightStyle: 'content',
			collapsible: true,
			active: false
		};
		if ($('#accordion-faq-6').length) {
			$('#accordion-faq-6').accordion(opts);
		}
		if ($('#accordion-faq-dystrybutor').length) {
			$('#accordion-faq-dystrybutor').accordion(opts);
		}
	});
})();
