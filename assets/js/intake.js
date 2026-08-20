(function () {
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

  if (!intakeForm) return; // Only run on the existing-patients page.

  cards.forEach(function (card) {
    card.addEventListener('click', function () {
      var type = card.getAttribute('data-type');
      cards.forEach(function (c) { c.classList.remove('selected'); });
      card.classList.add('selected');

      document.querySelectorAll('.type-fields').forEach(function (tf) {
        tf.classList.toggle('active', tf.getAttribute('data-fields') === type);
      });

      selectedTag.style.display = 'inline-flex';
      selectedTagText.textContent = fieldsMap[type];
      formHint.textContent = 'Fill in the details below and submit — your care team will take it from here.';
      submitBtn.disabled = false;

      intakeForm.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
  });

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
})();
