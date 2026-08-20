(function () {
  'use strict';

  var modal = document.getElementById('consultModal');
  if (!modal) return;

  var triggers = document.querySelectorAll('[data-consult-trigger]');
  var closeEls = modal.querySelectorAll('[data-consult-close]');
  var panel = modal.querySelector('.consult-modal__panel');
  var lastFocused = null;

  function openModal() {
    lastFocused = document.activeElement;

    modal.hidden = false;
    // next frame so the transition actually runs
    requestAnimationFrame(function () {
      modal.classList.add('is-open');
    });

    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';

    var closeBtn = modal.querySelector('.consult-modal__close');
    if (closeBtn) closeBtn.focus();

    document.addEventListener('keydown', onKeydown);
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';

    document.removeEventListener('keydown', onKeydown);

    // wait for the CSS transition before hiding
    var onEnd = function () {
      modal.hidden = true;
      panel.removeEventListener('transitionend', onEnd);
    };
    panel.addEventListener('transitionend', onEnd);

    if (lastFocused) lastFocused.focus();
  }

  function onKeydown(e) {
    if (e.key === 'Escape') {
      closeModal();
    }
  }

  triggers.forEach(function (trigger) {
    trigger.addEventListener('click', function (e) {
      e.preventDefault();
      openModal();
    });
  });

  closeEls.forEach(function (el) {
    el.addEventListener('click', closeModal);
  });
})();