/**
 * Existing Patients page — request-type card selector, per-type
 * field toggling, submit handling, and FAQ accordion. Logic matches
 * the reference "Existing Patient Intake Page" file.
 */
(function () {
  document.addEventListener('DOMContentLoaded', function () {
    var fieldsMap = {
      appointment: 'Schedule an Appointment',
      refill: 'Prescription Refill',
      question: 'Ask a Clinical Question',
      update: 'Update My Information',
      callback: 'Request a Callback'
    };

    var cards = document.querySelectorAll('.req-card');
    var selectedTag = document.getElementById('selectedTag');
    var selectedTagText = document.getElementById('selectedTagText');
    var formHint = document.getElementById('formHint');
    var submitBtn = document.getElementById('submitBtn');
    var intakeForm = document.getElementById('intakeForm');

    if (!cards.length) {
      return;
    }

    cards.forEach(function (card) {
      card.addEventListener('click', function () {
        var type = card.getAttribute('data-type');
        cards.forEach(function (c) {
          c.classList.remove('selected');
        });
        card.classList.add('selected');

        document.querySelectorAll('.type-fields').forEach(function (tf) {
          if (tf.getAttribute('data-fields') === type) {
            tf.classList.add('active');
          } else {
            tf.classList.remove('active');
          }
        });

        if (selectedTag) {
          selectedTag.style.display = 'inline-flex';
        }
        if (selectedTagText) {
          selectedTagText.textContent = fieldsMap[type] || '';
        }
        if (formHint) {
          formHint.textContent = "Fill in the details below and submit — your care team will take it from here.";
        }
        if (submitBtn) {
          submitBtn.disabled = false;
        }

        if (intakeForm) {
          intakeForm.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
      });
    });

    if (intakeForm) {
      intakeForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var panel = this;
        panel.innerHTML =
          '<div style="text-align:center; padding:24px 0;">' +
          '<div style="width:56px; height:56px; border-radius:50%; background:var(--pine-tint); display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">' +
          '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>' +
          '</div>' +
          '<h3 style="font-size:22px;">Request received</h3>' +
          '<p style="color:var(--muted); margin-top:10px; font-size:14.5px; max-width:420px; margin-left:auto; margin-right:auto;">Thank you — your care team has been notified and will follow up within one business day.</p>' +
          '</div>';
      });
    }

    document.querySelectorAll('.faq-q').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var item = btn.parentElement;
        var wasOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(function (i) {
          i.classList.remove('open');
        });
        if (!wasOpen) {
          item.classList.add('open');
        }
      });
    });
  });
})();

document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const requestType = params.get('request');

    if (requestType !== 'callback') {
        return;
    }

    const callbackCard = document.querySelector(
        '.req-card[data-type="callback"]'
    );

    if (!callbackCard) {
        return;
    }

    /*
     * Click the existing callback card.
     * This allows the page's existing JavaScript
     * to handle the active state and show the
     * callback-specific fields.
     */
    callbackCard.click();

    /*
     * Scroll to the request area after the page
     * has finished loading.
     */
    setTimeout(function () {
        const requestGrid = document.getElementById('reqGrid');

        if (requestGrid) {
            requestGrid.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }, 250);
});