(function () {
  // Animated waveform bars in hero device
  var row = document.getElementById('waveRow');
  if (row) {
    var heights = [8, 14, 20, 12, 24, 10, 18, 9, 15];
    heights.forEach(function (h, i) {
      var bar = document.createElement('div');
      bar.className = 'wave-bar';
      bar.style.height = h + 'px';
      bar.style.animation = 'wavePulse 1.' + ((i % 4) + 2) + 's ease-in-out ' + (i * 0.08) + 's infinite';
      row.appendChild(bar);
    });
  }

  // FAQ accordion
  document.querySelectorAll('.faq-q').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item = btn.parentElement;
      var wasOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(function (i) { i.classList.remove('open'); });
      if (!wasOpen) item.classList.add('open');
    });
  });

  // Scroll reveal (progressive enhancement — content is visible by default;
  // JS opts elements into the fade-in effect, so a JS failure never hides content)
  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!prefersReducedMotion && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.classList.remove('pending');
          e.target.classList.add('in');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });
    document.querySelectorAll('section').forEach(function (el) {
      el.classList.add('reveal-el', 'pending');
      io.observe(el);
    });
  }
})();
