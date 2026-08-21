document.addEventListener('DOMContentLoaded', function () {

    var bookingSection = document.querySelector(
        '.provider-booking-section'
    );

    var providerField = document.querySelector(
        '#provider-id'
    );

    if (!bookingSection || !providerField) {
        return;
    }

    var providerId =
        bookingSection.getAttribute(
            'data-provider-id'
        );

    if (providerId) {
        providerField.value = providerId;
    }

});