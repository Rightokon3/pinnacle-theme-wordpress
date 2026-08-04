document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("[data-testimonials-carousel]").forEach(function (carousel) {
    var track = carousel.querySelector("[data-testimonials-track]");
    var dotsWrap = carousel.querySelector("[data-testimonials-dots]");
    var slides = track ? Array.prototype.slice.call(track.children) : [];

    if (!track || !dotsWrap || slides.length === 0) return;

    var autoplayDelay = 6000;
    var timer = null;
    var activeIndex = 0;

    // build one dot per slide
    slides.forEach(function (_, i) {
      var dot = document.createElement("button");
      dot.type = "button";
      dot.className = "testimonials__dot";
      dot.setAttribute("aria-label", "Go to testimonial " + (i + 1));
      dot.addEventListener("click", function () {
        stopAutoplay();
        goTo(i);
      });
      dotsWrap.appendChild(dot);
    });

    var dots = Array.prototype.slice.call(dotsWrap.children);

    function setActiveDot(i) {
      dots.forEach(function (dot, idx) {
        dot.classList.toggle("is-active", idx === i);
      });
    }

    function goTo(i) {
      activeIndex = (i + slides.length) % slides.length;
      slides[activeIndex].scrollIntoView({ behavior: "smooth", inline: "start", block: "nearest" });
      setActiveDot(activeIndex);
    }

    function startAutoplay() {
      timer = window.setInterval(function () {
        goTo(activeIndex + 1);
      }, autoplayDelay);
    }

    function stopAutoplay() {
      if (timer) {
        window.clearInterval(timer);
        timer = null;
      }
    }

    // keep the dots synced if the person scrolls/swipes manually
    var scrollTimeout = null;
    track.addEventListener("scroll", function () {
      stopAutoplay();
      window.clearTimeout(scrollTimeout);
      scrollTimeout = window.setTimeout(function () {
        var trackRect = track.getBoundingClientRect();
        var closest = 0;
        var closestDistance = Infinity;
        slides.forEach(function (slide, i) {
          var distance = Math.abs(slide.getBoundingClientRect().left - trackRect.left);
          if (distance < closestDistance) {
            closestDistance = distance;
            closest = i;
          }
        });
        activeIndex = closest;
        setActiveDot(activeIndex);
      }, 120);
    });

    setActiveDot(0);
    startAutoplay();
  });
});