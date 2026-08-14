/**
 * Pinnacle Behavioral Healthcare
 *
 * Why Choose Pinnacle image carousel.
 *
 * Features:
 * - Automatic rotation
 * - Seven-image support
 * - Dot navigation
 * - Keyboard navigation
 * - Pause on hover
 * - Pause while focused
 * - Respects prefers-reduced-motion
 */

document.addEventListener('DOMContentLoaded', function () {

    const carousels = document.querySelectorAll(
        '[data-why-choose-carousel]'
    );

    if (!carousels.length) {
        return;
    }


    carousels.forEach(function (carousel) {

        const slides = carousel.querySelectorAll(
            '[data-carousel-slide]'
        );

        const dots = carousel.querySelectorAll(
            '[data-carousel-dot]'
        );

        if (!slides.length) {
            return;
        }


        let currentIndex = 0;

        let autoplayTimer = null;

        let isPaused = false;


        /*
         * --------------------------------------------------
         * Reduced motion
         * --------------------------------------------------
         */

        const prefersReducedMotion = window.matchMedia(
            '(prefers-reduced-motion: reduce)'
        );


        /*
         * --------------------------------------------------
         * Show slide
         * --------------------------------------------------
         */

        function showSlide(index) {

            if (index < 0) {
                index = slides.length - 1;
            }

            if (index >= slides.length) {
                index = 0;
            }


            currentIndex = index;


            /*
             * Slides
             */

            slides.forEach(function (slide, slideIndex) {

                const isActive = slideIndex === currentIndex;

                slide.classList.toggle(
                    'is-active',
                    isActive
                );

                slide.setAttribute(
                    'aria-hidden',
                    isActive ? 'false' : 'true'
                );

            });


            /*
             * Dots
             */

            dots.forEach(function (dot, dotIndex) {

                const isActive = dotIndex === currentIndex;

                dot.classList.toggle(
                    'is-active',
                    isActive
                );

                dot.setAttribute(
                    'aria-selected',
                    isActive ? 'true' : 'false'
                );

            });

        }


        /*
         * --------------------------------------------------
         * Next slide
         * --------------------------------------------------
         */

        function nextSlide() {

            showSlide(currentIndex + 1);

        }


        /*
         * --------------------------------------------------
         * Previous slide
         * --------------------------------------------------
         */

        function previousSlide() {

            showSlide(currentIndex - 1);

        }


        /*
         * --------------------------------------------------
         * Stop autoplay
         * --------------------------------------------------
         */

        function stopAutoplay() {

            if (autoplayTimer) {

                window.clearInterval(
                    autoplayTimer
                );

                autoplayTimer = null;

            }

        }


        /*
         * --------------------------------------------------
         * Start autoplay
         * --------------------------------------------------
         */

        function startAutoplay() {

            stopAutoplay();


            /*
             * Don't autoplay if the visitor prefers
             * reduced motion.
             */

            if (prefersReducedMotion.matches) {
                return;
            }


            /*
             * Don't autoplay if paused.
             */

            if (isPaused) {
                return;
            }


            /*
             * Change image every 5 seconds.
             */

            autoplayTimer = window.setInterval(
                function () {

                    nextSlide();

                },
                5000
            );

        }


        /*
         * --------------------------------------------------
         * Pause
         * --------------------------------------------------
         */

        function pauseCarousel() {

            isPaused = true;

            stopAutoplay();

        }


        /*
         * --------------------------------------------------
         * Resume
         * --------------------------------------------------
         */

        function resumeCarousel() {

            isPaused = false;

            startAutoplay();

        }


        /*
         * --------------------------------------------------
         * Dot navigation
         * --------------------------------------------------
         */

        dots.forEach(function (dot, index) {

            dot.addEventListener(
                'click',
                function () {

                    showSlide(index);

                    /*
                     * Restart the timer after manual
                     * navigation.
                     */

                    startAutoplay();

                }
            );

        });


        /*
         * --------------------------------------------------
         * Keyboard navigation
         * --------------------------------------------------
         */

        carousel.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'ArrowRight') {

                    event.preventDefault();

                    nextSlide();

                    startAutoplay();

                }


                if (event.key === 'ArrowLeft') {

                    event.preventDefault();

                    previousSlide();

                    startAutoplay();

                }

            }
        );


        /*
         * --------------------------------------------------
         * Pause when mouse is over carousel
         * --------------------------------------------------
         */

        carousel.addEventListener(
            'mouseenter',
            pauseCarousel
        );


        carousel.addEventListener(
            'mouseleave',
            resumeCarousel
        );


        /*
         * --------------------------------------------------
         * Pause when keyboard focus enters carousel
         * --------------------------------------------------
         */

        carousel.addEventListener(
            'focusin',
            pauseCarousel
        );


        carousel.addEventListener(
            'focusout',
            function () {

                /*
                 * Wait a moment so focus can move between
                 * the dots without restarting the carousel.
                 */

                window.setTimeout(
                    function () {

                        if (!carousel.contains(
                            document.activeElement
                        )) {

                            resumeCarousel();

                        }

                    },
                    50
                );

            }
        );


        /*
         * --------------------------------------------------
         * Respect reduced-motion changes
         * --------------------------------------------------
         */

        if (
            typeof prefersReducedMotion.addEventListener ===
            'function'
        ) {

            prefersReducedMotion.addEventListener(
                'change',
                function () {

                    startAutoplay();

                }
            );

        }


        /*
         * --------------------------------------------------
         * Initial state
         * --------------------------------------------------
         */

        showSlide(0);

        startAutoplay();

    });

});