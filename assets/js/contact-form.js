document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("[data-contact-form]").forEach(function (card) {
    var form = card.querySelector("[data-contact-form-fields]");
    var success = card.querySelector("[data-contact-form-success]");

    if (!form || !success) return;

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      // TODO: wire this up to the real contact-form endpoint. For now this
      // just mirrors the confirmation state from the original design.
      form.hidden = true;
      success.hidden = false;
    });
  });
});