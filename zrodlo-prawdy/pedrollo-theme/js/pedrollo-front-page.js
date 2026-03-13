/**
 * Strona główna: inicjalizacja Flickity (testimonials, zestawy, porównanie) + jQuery UI Accordion (FAQ).
 * Używamy jQuery zamiast $ (WordPress noConflict).
 */
(function() {
  'use strict';

  function init() {
    var main = document.querySelector('.pedrollou95polskau95mainu953') || document.querySelector('.screen');
    if (!main) return;

    // ------ Testimonials Flickity (działa też na podstronach: O nas, Kontakt, Dystrybutor) ------
    var el = main.querySelector('.testimonials-flickity');
    if (el && typeof Flickity !== 'undefined') {
      var flkty = new Flickity(el, {
        cellSelector: '.testimonials-cell',
        cellAlign: 'center',
        contain: true,
        pageDots: false,
        prevNextButtons: true,
        wrapAround: true,
        setGallerySize: true,
        arrowShape: 'M 65,15 L 20,50 L 65,85 Z',
        initialIndex: 0
      });
      function syncSelected() {
        var cells = el.querySelectorAll('.testimonials-cell');
        var idx = flkty.selectedIndex;
        cells.forEach(function(cell, i) {
          cell.classList.toggle('is-selected', i === idx);
        });
      }
      flkty.on('change', syncSelected);
      flkty.on('select', syncSelected);
      requestAnimationFrame(function() { syncSelected(); flkty.resize(); });
      setTimeout(function() { syncSelected(); flkty.resize(); }, 100);
    }

    // ------ Slider zestawów ------
    var zestawyEl = main.querySelector('.zestawy-flickity');
    if (zestawyEl && typeof Flickity !== 'undefined') {
      var zestawyFlkty = new Flickity(zestawyEl, {
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        prevNextButtons: false,
        wrapAround: false,
        setGallerySize: true,
        percentPosition: true,
        initialIndex: 0
      });
      var zestawyArrows = document.querySelector('.zestawy-arrows');
      if (zestawyArrows) {
        var prevBtn = zestawyArrows.querySelector('.zestawy-arrow-prev');
        var nextBtn = zestawyArrows.querySelector('.zestawy-arrow-next');
        if (prevBtn) prevBtn.addEventListener('click', function() { zestawyFlkty.previous(); });
        if (nextBtn) nextBtn.addEventListener('click', function() { zestawyFlkty.next(); });
        function updateZestawyArrows() {
          var idx = zestawyFlkty.selectedIndex;
          var n = zestawyFlkty.slides.length;
          var prevImg = prevBtn && prevBtn.querySelector('img');
          var nextImg = nextBtn && nextBtn.querySelector('img');
          if (prevImg) {
            var atStart = idx <= 0;
            prevImg.src = atStart ? prevImg.getAttribute('data-src-edge') : prevImg.getAttribute('data-src-active');
            prevBtn.disabled = atStart;
            prevBtn.classList.toggle('zestawy-arrow-at-edge', atStart);
            prevBtn.classList.toggle('zestawy-arrow-active', !atStart);
          }
          if (nextImg) {
            var atEnd = n <= 0 || idx >= n - 1;
            nextImg.src = atEnd ? nextImg.getAttribute('data-src-edge') : nextImg.getAttribute('data-src-active');
            nextBtn.disabled = atEnd;
            nextBtn.classList.toggle('zestawy-arrow-at-edge', atEnd);
            nextBtn.classList.toggle('zestawy-arrow-active', !atEnd);
          }
        }
        zestawyFlkty.on('change', updateZestawyArrows);
        updateZestawyArrows();
      }
    }

    // ------ Slider porównanie ------
    var porownanieEl = main.querySelector('.porownanie-flickity');
    if (porownanieEl && typeof Flickity !== 'undefined') {
      var porownanieFlkty = new Flickity(porownanieEl, {
        cellSelector: '.porownanie-slide',
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        prevNextButtons: false,
        wrapAround: false,
        setGallerySize: true,
        percentPosition: true,
        initialIndex: 0
      });
      var porownaniePrev = document.querySelector('.porownanie-arrow-prev');
      var porownanieNext = document.querySelector('.porownanie-arrow-next');
      var porownanieDots = document.querySelectorAll('.porownanie-dot');
      if (porownaniePrev) porownaniePrev.addEventListener('click', function() { porownanieFlkty.previous(); });
      if (porownanieNext) porownanieNext.addEventListener('click', function() { porownanieFlkty.next(); });
      porownanieDots.forEach(function(dot, i) {
        dot.addEventListener('click', function() { porownanieFlkty.select(i); });
      });
      function updatePorownanieUI() {
        var idx = porownanieFlkty.selectedIndex;
        var n = porownanieFlkty.slides.length;
        var atStart = idx <= 0;
        var atEnd = n <= 0 || idx >= n - 1;
        if (porownaniePrev) {
          porownaniePrev.disabled = atStart;
          porownaniePrev.classList.toggle('at-edge', atStart);
          var prevImg = porownaniePrev.querySelector('img');
          if (prevImg) {
            prevImg.src = atStart ? (prevImg.getAttribute('data-src-edge') || prevImg.src) : (prevImg.getAttribute('data-src-active') || prevImg.src);
            prevImg.classList.toggle('porownanie-arrow-rotated', !atStart);
          }
        }
        if (porownanieNext) {
          porownanieNext.disabled = atEnd;
          porownanieNext.classList.toggle('at-edge', atEnd);
          var nextImg = porownanieNext.querySelector('img');
          if (nextImg) {
            nextImg.src = atEnd ? (nextImg.getAttribute('data-src-edge') || nextImg.src) : (nextImg.getAttribute('data-src-active') || nextImg.src);
            nextImg.classList.toggle('porownanie-arrow-rotated', atEnd);
          }
        }
        porownanieDots.forEach(function(dot, i) {
          dot.classList.toggle('is-active', i === idx);
          dot.setAttribute('aria-selected', i === idx ? 'true' : 'false');
        });
      }
      porownanieFlkty.on('change', updatePorownanieUI);
      updatePorownanieUI();
      requestAnimationFrame(function() {
        porownanieFlkty.reloadCells();
        porownanieFlkty.resize();
        updatePorownanieUI();
      });
      setTimeout(function() {
        porownanieFlkty.reloadCells();
        porownanieFlkty.resize();
        updatePorownanieUI();
      }, 100);
    }

    // ------ Sekcja „Niezawodność płynie z jakości” – play / kroki / strzałki ------
    (function() {
      var TOTAL_STEPS = 7;
      var slider = document.querySelector('.niezawodnosc-slider');
      var intro = document.getElementById('niezawodnosc-intro');
      var plansze = document.getElementById('niezawodnosc-plansze');
      var playBtn = document.getElementById('niezawodnosc-play');
      var skipBtn = document.getElementById('niezawodnosc-skip');
      var btmPrev = document.getElementById('niezawodnosc-btm-prev');
      var btmNext = document.getElementById('niezawodnosc-btm-next');
      var navPrev = document.querySelector('.niezawodnosc-nav-prev');
      var navNext = document.querySelector('.niezawodnosc-nav-next');
      var currentEl = document.getElementById('niezawodnosc-current');
      var ring = document.getElementById('niezawodnosc-ring');
      var imgBase = (typeof pedrolloFrontPage !== 'undefined' && pedrolloFrontPage.themeUri) ? pedrolloFrontPage.themeUri + '/img/' : 'img/';
      if (!slider || !intro || !plansze) return;

      function getStep() {
        return parseInt(slider.getAttribute('data-step') || '1', 10);
      }
      function positionRing(step) {
        if (!ring) return;
        var container = plansze.querySelector('.group-61-3');
        if (!container) return;
        var activePlus = plansze.querySelector('.niezawodnosc-plus[data-niezawodnosc-step="' + step + '"]');
        if (!activePlus) return;
        ring.classList.add('niezawodnosc-ring--visible');
        requestAnimationFrame(function() {
          var cr = container.getBoundingClientRect();
          var pr = activePlus.getBoundingClientRect();
          var cx = pr.left - cr.left + pr.width / 2;
          var cy = pr.top - cr.top + pr.height / 2;
          ring.style.left = (cx - ring.offsetWidth / 2) + 'px';
          ring.style.top = (cy - ring.offsetHeight / 2) + 'px';
        });
      }
      function setStep(step) {
        step = Math.max(1, Math.min(TOTAL_STEPS, step));
        slider.setAttribute('data-step', String(step));
        slider.classList.add('niezawodnosc-slider--active');
        plansze.removeAttribute('hidden');
        plansze.setAttribute('aria-hidden', 'false');
        var pluses = plansze.querySelectorAll('.niezawodnosc-plus');
        pluses.forEach(function(p) {
          var s = parseInt(p.getAttribute('data-niezawodnosc-step'), 10);
          p.classList.toggle('niezawodnosc-plus--active', s === step);
        });
        var contents = plansze.querySelectorAll('.niezawodnosc-step-content');
        contents.forEach(function(c) {
          var s = String(c.getAttribute('data-niezawodnosc-content'));
          c.hidden = s !== String(step);
        });
        positionRing(step);
        if (currentEl) currentEl.textContent = step;
        if (btmPrev) btmPrev.disabled = step <= 1;
        if (navPrev) navPrev.disabled = step <= 1;
        if (navNext) navNext.disabled = step >= TOTAL_STEPS;
        if (btmNext) btmNext.disabled = step >= TOTAL_STEPS;
        updateArrowIcons(step);
      }
      function updateArrowIcons(step) {
        var activeSrc = imgBase + 'arrow-blue-6.svg';
        var inactiveSrc = imgBase + 'arrow-blue-5.svg';
        if (navPrev && navPrev.querySelector('img')) navPrev.querySelector('img').src = step > 1 ? activeSrc : inactiveSrc;
        if (navNext && navNext.querySelector('img')) navNext.querySelector('img').src = step < TOTAL_STEPS ? activeSrc : inactiveSrc;
        if (btmPrev && btmPrev.querySelector('img')) btmPrev.querySelector('img').src = step > 1 ? activeSrc : inactiveSrc;
        if (btmNext && btmNext.querySelector('img')) btmNext.querySelector('img').src = step < TOTAL_STEPS ? activeSrc : inactiveSrc;
      }
      function showIntro() {
        slider.classList.remove('niezawodnosc-slider--active');
        plansze.setAttribute('hidden', '');
        plansze.setAttribute('aria-hidden', 'true');
        if (ring) ring.classList.remove('niezawodnosc-ring--visible');
        if (btmPrev) btmPrev.disabled = true;
        if (btmNext) btmNext.disabled = false;
      }
      function goNext() {
        if (slider.classList.contains('niezawodnosc-slider--active')) {
          var step = getStep();
          if (step < TOTAL_STEPS) setStep(step + 1);
        } else {
          setStep(1);
        }
      }
      function goPrev() {
        if (!slider.classList.contains('niezawodnosc-slider--active')) return;
        var step = getStep();
        if (step > 1) setStep(step - 1);
        else showIntro();
      }
      if (playBtn) playBtn.addEventListener('click', goNext);
      if (skipBtn) skipBtn.addEventListener('click', showIntro);
      if (btmNext) btmNext.addEventListener('click', goNext);
      if (btmPrev) btmPrev.addEventListener('click', goPrev);
      if (navNext) navNext.addEventListener('click', function() {
        var step = getStep();
        if (step < TOTAL_STEPS) setStep(step + 1);
      });
      if (navPrev) navPrev.addEventListener('click', function() {
        var step = getStep();
        if (step > 1) setStep(step - 1);
      });
      updateArrowIcons(slider.classList.contains('niezawodnosc-slider--active') ? getStep() : 1);
      if (!slider.classList.contains('niezawodnosc-slider--active')) {
        if (btmPrev) btmPrev.disabled = true;
        if (btmNext) btmNext.disabled = false;
      }
    })();

    // ------ Konfigurator – suwaki (range): wartość w uchwycie i pozycja thumb ------
    (function() {
      var form = document.getElementById('form-konfigurator');
      if (!form) return;
      form.querySelectorAll('.konfigurator-range').forEach(function(range) {
        var wrap = range.closest('.konfigurator-slider-wrap');
        var thumb = wrap && wrap.querySelector('.konfigurator-slider-thumb');
        var valueSpan = thumb && thumb.querySelector('.konfigurator-slider-value');
        function update() {
          var v = parseInt(range.value, 10);
          var max = parseInt(range.getAttribute('max'), 10) || 10;
          var pct = max > 0 ? (v / max * 100) : 0;
          if (valueSpan) valueSpan.textContent = v;
          if (thumb) thumb.style.setProperty('--range-percent', pct + '%');
          range.style.setProperty('--range-percent', pct + '%');
        }
        range.addEventListener('input', update);
        range.addEventListener('change', update);
        update();
      });
    })();

    // ------ Przełączanie kart „Wybierz zestaw” (Dom mieszkalny z ogrodem) ------
    (function() {
      var tablist = main.querySelector('.wybierz-zestaw-tabs');
      var cardsContainer = main.querySelector('.wybierz-zestaw-cards');
      if (!tablist || !cardsContainer) return;
      var tabs = tablist.querySelectorAll('.wybierz-zestaw-tab');
      var cards = cardsContainer.querySelectorAll('.wybierz-zestaw-card');
      function showCard(idx) {
        var id = String(idx);
        tabs.forEach(function(t) {
          var active = String(t.getAttribute('data-wybierz-tab') || '') === id;
          t.classList.toggle('wybierz-zestaw-tab--active', active);
          t.setAttribute('aria-selected', active ? 'true' : 'false');
          t.classList.remove('frame-36752-3', 'frame-3675-3');
          t.classList.add(active ? 'frame-36752-3' : 'frame-3675-3');
        });
        cards.forEach(function(card) {
          var hide = String(card.getAttribute('data-wybierz-card') || '') !== id;
          card.classList.toggle('wybierz-zestaw-card--hidden', hide);
          card.setAttribute('aria-hidden', hide ? 'true' : 'false');
        });
      }
      tablist.addEventListener('click', function(e) {
        var t = e.target.closest('.wybierz-zestaw-tab');
        if (t && t.getAttribute('data-wybierz-tab') != null) {
          e.preventDefault();
          showCard(t.getAttribute('data-wybierz-tab'));
        }
      });
      showCard('0');
    })();

    // ------ FAQ accordion (WordPress: jQuery, nie $) ------
    if (typeof jQuery !== 'undefined' && jQuery.ui && jQuery.ui.accordion) {
      var $ = jQuery;
      if ($('#accordion-faq-6').length) {
        $('#accordion-faq-6').accordion({
          header: '.faq-accordion-header',
          heightStyle: 'content',
          collapsible: true,
          active: false
        });
      }
      if ($('#accordion-faq-mobile').length) {
        $('#accordion-faq-mobile').accordion({
          header: '.faq-accordion-header',
          heightStyle: 'content',
          collapsible: true,
          active: false
        });
      }
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
