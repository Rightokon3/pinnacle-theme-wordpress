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

    function setActive(index) {
      index = Math.max(0, Math.min(index, tabs.length - 1));

      tabs.forEach(function (tab, i) {
        var isActive = i === index;

        tab.classList.toggle("is-active", isActive);
        tab.setAttribute("aria-selected", isActive ? "true" : "false");
      });

      panels.forEach(function (panel, i) {
        panel.classList.toggle("is-active", i === index);
      });
    }

    /*
     * DESKTOP:
     * Change the image/content when the user hovers
     * over a service item.
     */
    tabs.forEach(function (tab, i) {

      tab.addEventListener("mouseenter", function () {
        setActive(i);
      });

      /*
       * Keyboard accessibility.
       * When the user tabs onto a service, activate it.
       */
      tab.addEventListener("focus", function () {
        setActive(i);
      });

      /*
       * Keep click functionality too.
       * Useful for touch devices and accessibility.
       */
      tab.addEventListener("click", function () {
        setActive(i);
      });
    });

    /*
     * Start with the first service active.
     *
     * IMPORTANT:
     * There is NO autoplay timer here.
     * Nothing moves by itself.
     */
    setActive(0);
  });
});