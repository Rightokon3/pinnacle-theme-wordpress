(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    /* STEP TABS */
    var root = document.querySelector('[data-pbh-insurance-tabs]');

    if (root) {
      var tabs = Array.prototype.slice.call(root.querySelectorAll('[data-pbh-tab]'));
      var panels = Array.prototype.slice.call(root.querySelectorAll('[data-pbh-panel]'));

      function activate(number, focus) {
        tabs.forEach(function (tab) {
          var active = tab.getAttribute('data-pbh-tab') === number;
          tab.classList.toggle('pbh-insurance-tab--active', active);
          tab.setAttribute('aria-selected', active ? 'true' : 'false');
          tab.setAttribute('tabindex', active ? '0' : '-1');
        });

        panels.forEach(function (panel) {
          var active = panel.getAttribute('data-pbh-panel') === number;
          panel.hidden = !active;
          panel.classList.toggle('pbh-insurance-tab-panel--active', active);
        });

        if (focus) {
          var activeTab = root.querySelector('[data-pbh-tab="' + number + '"]');
          if (activeTab) activeTab.focus();
        }
      }

      tabs.forEach(function (tab, index) {
        tab.addEventListener('click', function () {
          activate(tab.getAttribute('data-pbh-tab'), false);
        });

        tab.addEventListener('keydown', function (event) {
          var next = null;

          if (event.key === 'ArrowRight' || event.key === 'ArrowDown') next = (index + 1) % tabs.length;
          if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') next = (index - 1 + tabs.length) % tabs.length;
          if (event.key === 'Home') next = 0;
          if (event.key === 'End') next = tabs.length - 1;

          if (next !== null) {
            event.preventDefault();
            activate(tabs[next].getAttribute('data-pbh-tab'), true);
          }
        });
      });
    }

    /* FORM VALIDATION */
    var form = document.querySelector('.pbh-insurance-form');
    if (!form) return;

    var required = ['full_name', 'dob', 'phone', 'carrier', 'member_id', 'reason'];

    function wrapper(name) {
      return form.querySelector('[data-field="' + name + '"]');
    }

    function invalid(name, state) {
      var el = wrapper(name);
      if (el) el.classList.toggle('pbh-insurance-invalid', state);
    }

    function validate() {
      var valid = true;

      required.forEach(function (name) {
        var field = form.elements[name];
        var bad = !field || !String(field.value || '').trim();
        invalid(name, bad);
        if (bad) valid = false;
      });

      var consent = form.elements.consent;
      var consentBad = !consent || !consent.checked;
      invalid('consent', consentBad);
      if (consentBad) valid = false;

      return valid;
    }

    form.addEventListener('input', function (event) {
      if (event.target.name) invalid(event.target.name, false);
    });

    form.addEventListener('change', function (event) {
      if (event.target.name) invalid(event.target.name, false);
    });

    form.addEventListener('submit', function (event) {
      if (!validate()) {
        event.preventDefault();
        var first = form.querySelector('.pbh-insurance-invalid input, .pbh-insurance-invalid select');
        if (first) first.focus();
        return;
      }

      var button = form.querySelector('.pbh-insurance-submit');
      if (button) {
        button.disabled = true;
        button.textContent = 'Sending…';
      }
    });
  });
}());
