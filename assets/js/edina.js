/**
 * Edina Location Page
 * Pinnacle Behavioral Healthcare
 *
 * Handles:
 * 1. FAQ accordion
 * 2. Scroll reveal animations
 */

document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       FAQ ACCORDION
       ========================================================= */

    const faqButtons = document.querySelectorAll(
        '.edina-location-page .faq-q'
    );

    faqButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const item = button.closest('.faq-item');

            if (!item) {
                return;
            }

            const wasOpen = item.classList.contains('open');

            /* Close all FAQ items */
            document
                .querySelectorAll('.edina-location-page .faq-item')
                .forEach(function (faqItem) {
                    faqItem.classList.remove('open');
                });

            /* Re-open the clicked item if it was previously closed */
            if (!wasOpen) {
                item.classList.add('open');
            }

        });

    });


    /* =========================================================
       SCROLL REVEAL
       ========================================================= */

    const prefersReducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    /*
     * If the user prefers reduced motion, leave everything visible.
     */
    if (prefersReducedMotion) {
        return;
    }


    /*
     * Make only Edina page sections participate in the animation.
     */
    const revealSections = document.querySelectorAll(
        '.edina-location-page section'
    );


    /*
     * If IntersectionObserver is not available,
     * simply show all sections.
     */
    if (!('IntersectionObserver' in window)) {

        revealSections.forEach(function (section) {
            section.classList.remove('pending');
            section.classList.add('in');
        });

        return;
    }


    /*
     * Create the observer.
     */
    const observer = new IntersectionObserver(
        function (entries) {

            entries.forEach(function (entry) {

                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.remove('pending');
                entry.target.classList.add('in');

                /*
                 * Once revealed, stop observing the section.
                 */
                observer.unobserve(entry.target);

            });

        },
        {
            threshold: 0.12
        }
    );


    /*
     * Prepare sections for reveal animation.
     */
    revealSections.forEach(function (section) {

        section.classList.add(
            'reveal-el',
            'pending'
        );

        observer.observe(section);

    });

});