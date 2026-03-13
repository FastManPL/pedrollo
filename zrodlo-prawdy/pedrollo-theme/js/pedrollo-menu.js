/**
 * Pedrollo – menu mobilne (otwórz/zamknij) + submenu (desktop: hover, mobile: klik).
 * Wyciągnięte z index.html, działa na wszystkich stronach.
 */
(function() {
  'use strict';

  // ------ Mobile: przycisk otwórz/zamknij + klasa is-scrolled po scrollu ------
  var openBtn = document.getElementById('mobile-menu-open');
  var closeBtn = document.getElementById('mobile-menu-close');
  var mobileHeader = document.querySelector('.mobile-header');
  var scrollThreshold = 100;

  function updateHeaderScroll() {
    if (mobileHeader && window.innerWidth <= 767) {
      mobileHeader.classList.toggle('is-scrolled', window.scrollY > scrollThreshold);
    }
  }
  window.addEventListener('scroll', function() { updateHeaderScroll(); }, { passive: true });
  window.addEventListener('resize', updateHeaderScroll);
  updateHeaderScroll();

  if (openBtn) {
    function openMenu() {
      document.body.classList.add('mobile-menu-open');
      document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
      document.body.classList.remove('mobile-menu-open');
      document.body.style.overflow = '';
    }
    openBtn.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
  }

  // ------ Submenu: desktop hover, mobile klik (menu_2-3 jest w headerze na każdej stronie) ------
  var menu = document.querySelector('.menu_2-3');
  if (!menu) return;

  var triggers = menu.querySelectorAll('.menu-hover-1[data-submenu]');
  function getPanels() { return menu.querySelectorAll('.submenu-panel'); }

  function onScroll() {
    menu.classList.toggle('is-scrolled', window.scrollY > scrollThreshold);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  var hideTimeout = null;
  function showPanel(id) {
    if (hideTimeout) { clearTimeout(hideTimeout); hideTimeout = null; }
    getPanels().forEach(function(panel) {
      var visible = panel.id === id;
      panel.classList.toggle('is-visible', visible);
      panel.setAttribute('aria-hidden', visible ? 'false' : 'true');
    });
    triggers.forEach(function(tr) {
      var expanded = tr.getAttribute('data-submenu') === id && window.innerWidth <= 767;
      tr.classList.toggle('is-expanded', expanded);
      tr.setAttribute('aria-expanded', expanded);
    });
  }
  function hideAll() {
    getPanels().forEach(function(panel) {
      panel.classList.remove('is-visible');
      panel.setAttribute('aria-hidden', 'true');
    });
    var backWrap = document.getElementById('submenu-back-wrap');
    if (backWrap) backWrap.setAttribute('aria-hidden', 'true');
    triggers.forEach(function(tr) {
      tr.classList.remove('is-expanded');
      tr.setAttribute('aria-expanded', 'false');
    });
  }

  var submenuBackBtn = document.getElementById('submenu-back');
  if (submenuBackBtn) submenuBackBtn.addEventListener('click', hideAll);
  menu.querySelectorAll('.mobile-submenu-inner').forEach(function(el) { el.remove(); });

  function scheduleHide() {
    if (hideTimeout) clearTimeout(hideTimeout);
    hideTimeout = setTimeout(function() { hideTimeout = null; hideAll(); }, 200);
  }
  function cancelHide() {
    if (hideTimeout) { clearTimeout(hideTimeout); hideTimeout = null; }
  }

  triggers.forEach(function(trigger) {
    trigger.addEventListener('mouseenter', function() {
      if (window.innerWidth > 767) showPanel(trigger.getAttribute('data-submenu'));
    });
    trigger.addEventListener('click', function(e) {
      if (window.innerWidth <= 767) {
        e.preventDefault();
        var id = trigger.getAttribute('data-submenu');
        var panel = id ? document.getElementById(id) : null;
        var alreadyVisible = panel && panel.classList.contains('is-visible');
        if (alreadyVisible) hideAll();
        else showPanel(id);
      }
    });
  });
  menu.addEventListener('mouseleave', function() {
    if (window.innerWidth > 767) scheduleHide();
  });
  menu.addEventListener('mouseenter', function() {
    if (window.innerWidth > 767) cancelHide();
  });
})();
