document.addEventListener("DOMContentLoaded", function () {
  var header = document.querySelector("[data-site-header]");
  var toggle = document.querySelector(".menu-toggle");
  var drawer = document.getElementById("mobile-nav-drawer");
  var overlay = document.getElementById("mobile-nav-overlay");
  var closeBtn = document.querySelector(".mobile-nav-drawer__close");
  var searchOverlay = document.querySelector("[data-search-overlay]");
  var searchToggles = document.querySelectorAll("[data-search-toggle]");
  var searchClose = document.querySelector("[data-search-close]");
  var searchInput = document.querySelector("[data-search-input]");

  // ---------------------------------------------------
  // Header shadow on scroll
  // ---------------------------------------------------
  if (header) {
    var handleScroll = function () {
      header.classList.toggle("is-scrolled", window.scrollY > 12);
    };
    window.addEventListener("scroll", handleScroll);
    handleScroll();
  }

  // ---------------------------------------------------
  // Mobile drawer
  // ---------------------------------------------------
  function openDrawer() {
    closeSearch();
    if (!drawer || !overlay) return;
    drawer.classList.add("is-open");
    overlay.hidden = false;
    requestAnimationFrame(function () {
      overlay.classList.add("is-visible");
    });
    if (toggle) {
      toggle.classList.add("is-active");
      toggle.setAttribute("aria-expanded", "true");
    }
    drawer.setAttribute("aria-hidden", "false");
    document.body.classList.add("mobile-nav-open");
  }

  function closeDrawer() {
    if (!drawer || !overlay) return;
    drawer.classList.remove("is-open");
    overlay.classList.remove("is-visible");
    if (toggle) {
      toggle.classList.remove("is-active");
      toggle.setAttribute("aria-expanded", "false");
    }
    drawer.setAttribute("aria-hidden", "true");
    document.body.classList.remove("mobile-nav-open");

    drawer.querySelectorAll(".menu-item-has-children.is-open").forEach(function (li) {
      li.classList.remove("is-open");
    });

    window.setTimeout(function () {
      if (!drawer.classList.contains("is-open")) overlay.hidden = true;
    }, 300);
  }

  if (toggle && drawer && overlay) {
    toggle.addEventListener("click", function () {
      var isOpen = drawer.classList.contains("is-open");
      if (isOpen) {
        closeDrawer();
      } else {
        openDrawer();
      }
    });

    if (closeBtn) closeBtn.addEventListener("click", closeDrawer);
    overlay.addEventListener("click", closeDrawer);

    var parentLinks = drawer.querySelectorAll(".menu-item-has-children > a");
    parentLinks.forEach(function (link) {
      link.addEventListener("click", function (e) {
        e.preventDefault();
        var li = link.parentElement;
        var isOpenItem = li.classList.contains("is-open");
        li.classList.toggle("is-open", !isOpenItem);
      });
    });

    window.addEventListener("resize", function () {
      if (window.innerWidth >= 1024 && drawer.classList.contains("is-open")) {
        closeDrawer();
      }
    });
  }

  // ---------------------------------------------------
  // Search overlay
  // ---------------------------------------------------
  function openSearch() {
    closeDrawer();
    if (!searchOverlay) return;
    searchOverlay.hidden = false;
    requestAnimationFrame(function () {
      searchOverlay.classList.add("is-open");
    });
    if (searchInput) searchInput.focus();
  }

  function closeSearch() {
    if (!searchOverlay) return;
    searchOverlay.classList.remove("is-open");
    window.setTimeout(function () {
      if (!searchOverlay.classList.contains("is-open")) searchOverlay.hidden = true;
    }, 250);
  }

  searchToggles.forEach(function (btn) {
    btn.addEventListener("click", function () {
      var isOpen = searchOverlay && searchOverlay.classList.contains("is-open");
      if (isOpen) {
        closeSearch();
      } else {
        openSearch();
      }
    });
  });

  if (searchClose) searchClose.addEventListener("click", closeSearch);

  document.addEventListener("keydown", function (e) {
    if (e.key !== "Escape") return;
    if (drawer && drawer.classList.contains("is-open")) closeDrawer();
    if (searchOverlay && searchOverlay.classList.contains("is-open")) closeSearch();
  });

  // desktop dropdown accordion state for keyboard/touch (hover handled in CSS)
  document.querySelectorAll(".primary-menu .menu-item-has-children > a").forEach(function (link) {
    link.addEventListener("click", function (e) {
      if (window.innerWidth < 1024) return;
      var href = link.getAttribute("href");
      if (!href || href === "#") e.preventDefault();
    });
  });
});