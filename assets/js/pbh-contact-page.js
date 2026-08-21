(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('.pbh-contact-form');

        if (!form) {
            return;
        }

        form.addEventListener('submit', function () {
            var button = form.querySelector('.pbh-contact-submit');

            if (!button) {
                return;
            }

            button.disabled = true;
            button.setAttribute('aria-busy', 'true');
            button.dataset.originalText = button.textContent.trim();
            button.firstChild.textContent = 'Sending… ';
        });
    });
}());
