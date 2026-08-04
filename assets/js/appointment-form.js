document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("[data-appointment-form]").forEach(function (card) {
    var form = card.querySelector("[data-appointment-form-fields]");
    var success = card.querySelector("[data-appointment-form-success]");

    if (!form || !success) return;

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      // TODO: wire this up to the real booking endpoint. For now this just
      // mirrors the confirmation state from the original design.
      form.hidden = true;
      success.hidden = false;
    });
  });
});