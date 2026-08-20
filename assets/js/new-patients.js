document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('pnpIntakeForm');

  if (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }

      form.innerHTML = `
        <div class="pnp-success" style="text-align:center;padding:24px 0;">
          <div style="width:56px;height:56px;border-radius:50%;background:var(--pnp-pine-tint);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 6L9 17l-5-5"/>
            </svg>
          </div>
          <h3 style="font-size:22px;">Welcome to Pinnacle</h3>
          <p style="color:var(--pnp-muted);margin-top:10px;font-size:14.5px;max-width:440px;margin-left:auto;margin-right:auto;">
            Your intake form has been received. A member of our care team will reach out within one business day to match you with a provider and get your first visit scheduled.
          </p>
        </div>
      `;
    });
  }

  document.querySelectorAll('.pnp-faq-q').forEach(function (button) {
    button.addEventListener('click', function () {
      const item = button.parentElement;
      const wasOpen = item.classList.contains('open');

      document.querySelectorAll('.pnp-faq-item').forEach(function (faqItem) {
        faqItem.classList.remove('open');
      });

      if (!wasOpen) {
        item.classList.add('open');
      }
    });
  });
});
