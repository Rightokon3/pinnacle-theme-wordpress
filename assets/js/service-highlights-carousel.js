document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("[data-service-highlights]").forEach(function (carousel) {
    var tabsWrap = carousel.querySelector("[data-service-highlights-tabs]");
    var panelsWrap = carousel.querySelector("[data-service-highlights-panels]");

    if (!tabsWrap || !panelsWrap) return;

    var tabs = Array.prototype.slice.call(
      tabsWrap.querySelectorAll("[data-service-highlights-tab]")
    );
    var panels = Array.prototype.slice.call(
      panelsWrap.querySelectorAll("[data-service-highlights-panel]")
    );

    if (tabs.length === 0 || panels.length === 0) return;

    var autoplayDelay = parseInt(carousel.getAttribute("data-autoplay-delay"), 10) || 4500;
    var timer = null;
    var activeIndex = 0;
    var isPaused = false;

    function setActive(index) {
      activeIndex = (index + tabs.length) % tabs.length;

      tabs.forEach(function (tab, i) {
        var isActive = i === activeIndex;
        tab.classList.toggle("is-active", isActive);
        tab.setAttribute("aria-selected", isActive ? "true" : "false");
      });

      panels.forEach(function (panel, i) {
        panel.classList.toggle("is-active", i === activeIndex);
      });
    }

    function startAutoplay() {
      stopAutoplay();
      timer = window.setInterval(function () {
        if (!isPaused) setActive(activeIndex + 1);
      }, autoplayDelay);
    }

    function stopAutoplay() {
      if (timer) {
        window.clearInterval(timer);
        timer = null;
      }
    }

    tabs.forEach(function (tab, i) {
      tab.addEventListener("click", function () {
        isPaused = true;
        setActive(i);
      });
    });

    setActive(0);
    startAutoplay();
  });
});