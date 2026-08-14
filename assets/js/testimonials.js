document.addEventListener("DOMContentLoaded", function () {

    document
        .querySelectorAll("[data-testimonials-carousel]")
        .forEach(function (carousel) {

            var track = carousel.querySelector(
                "[data-testimonials-track]"
            );

            var dotsWrap = carousel.querySelector(
                "[data-testimonials-dots]"
            );

            var prevButton = carousel.querySelector(
                ".testimonials__arrow--prev"
            );

            var nextButton = carousel.querySelector(
                ".testimonials__arrow--next"
            );

            var slides = track
                ? Array.prototype.slice.call(track.children)
                : [];

            if (
                !track ||
                !dotsWrap ||
                slides.length === 0
            ) {
                return;
            }


            /* =====================================================
               SETTINGS
               ===================================================== */

            var autoplayDelay = 6000;

            var timer = null;

            var activeIndex = 0;

            var scrollTimeout = null;


            /* =====================================================
               BUILD DOTS
               ===================================================== */

            slides.forEach(function (_, i) {

                var dot = document.createElement("button");

                dot.type = "button";

                dot.className = "testimonials__dot";

                dot.setAttribute(
                    "aria-label",
                    "Go to testimonial " + (i + 1)
                );

                dot.addEventListener(
                    "click",
                    function () {

                        goTo(i);

                        restartAutoplay();

                    }
                );

                dotsWrap.appendChild(dot);

            });


            var dots = Array.prototype.slice.call(
                dotsWrap.children
            );


            /* =====================================================
               ACTIVE DOT
               ===================================================== */

            function setActiveDot(index) {

                dots.forEach(function (dot, i) {

                    var isActive =
                        i === index;

                    dot.classList.toggle(
                        "is-active",
                        isActive
                    );

                    dot.setAttribute(
                        "aria-current",
                        isActive
                            ? "true"
                            : "false"
                    );

                });

            }


            /* =====================================================
               GO TO SLIDE
               ===================================================== */

            function goTo(index) {

                activeIndex =
                    (index + slides.length) %
                    slides.length;


                var targetSlide =
                    slides[activeIndex];


                if (!targetSlide) {
                    return;
                }


                targetSlide.scrollIntoView({
                    behavior: "smooth",
                    inline: "start",
                    block: "nearest"
                });


                setActiveDot(
                    activeIndex
                );

            }


            /* =====================================================
               NEXT
               ===================================================== */

            function nextSlide() {

                goTo(
                    activeIndex + 1
                );

            }


            /* =====================================================
               PREVIOUS
               ===================================================== */

            function previousSlide() {

                goTo(
                    activeIndex - 1
                );

            }


            /* =====================================================
               AUTOPLAY
               ===================================================== */

            function startAutoplay() {

                stopAutoplay();


                if (slides.length <= 1) {
                    return;
                }


                timer = window.setInterval(
                    function () {

                        nextSlide();

                    },
                    autoplayDelay
                );

            }


            function stopAutoplay() {

                if (timer) {

                    window.clearInterval(
                        timer
                    );

                    timer = null;

                }

            }


            function restartAutoplay() {

                stopAutoplay();

                startAutoplay();

            }


            /* =====================================================
               ARROW BUTTONS
               ===================================================== */

            if (prevButton) {

                prevButton.addEventListener(
                    "click",
                    function () {

                        previousSlide();

                        restartAutoplay();

                    }
                );

            }


            if (nextButton) {

                nextButton.addEventListener(
                    "click",
                    function () {

                        nextSlide();

                        restartAutoplay();

                    }
                );

            }


            /* =====================================================
               MANUAL SCROLL / TOUCH SWIPE
               ===================================================== */

            track.addEventListener(
                "scroll",
                function () {

                    /*
                     * Stop the timer while the user is
                     * physically swiping/scrolling.
                     */
                    stopAutoplay();


                    window.clearTimeout(
                        scrollTimeout
                    );


                    scrollTimeout =
                        window.setTimeout(
                            function () {

                                var trackRect =
                                    track.getBoundingClientRect();


                                var closest =
                                    0;

                                var closestDistance =
                                    Infinity;


                                slides.forEach(
                                    function (
                                        slide,
                                        i
                                    ) {

                                        var slideRect =
                                            slide.getBoundingClientRect();


                                        var distance =
                                            Math.abs(
                                                slideRect.left -
                                                trackRect.left
                                            );


                                        if (
                                            distance <
                                            closestDistance
                                        ) {

                                            closestDistance =
                                                distance;

                                            closest =
                                                i;

                                        }

                                    }
                                );


                                activeIndex =
                                    closest;


                                setActiveDot(
                                    activeIndex
                                );


                                /*
                                 * Start autoplay again after
                                 * the manual interaction finishes.
                                 */
                                startAutoplay();

                            },
                            180
                        );

                },
                {
                    passive: true
                }
            );


            /* =====================================================
               PAUSE WHILE MOUSE IS OVER CAROUSEL
               ===================================================== */

            carousel.addEventListener(
                "mouseenter",
                function () {

                    stopAutoplay();

                }
            );


            carousel.addEventListener(
                "mouseleave",
                function () {

                    startAutoplay();

                }
            );


            /* =====================================================
               KEYBOARD SUPPORT
               ===================================================== */

            track.addEventListener(
                "keydown",
                function (event) {

                    if (
                        event.key === "ArrowRight"
                    ) {

                        event.preventDefault();

                        nextSlide();

                        restartAutoplay();

                    }


                    if (
                        event.key === "ArrowLeft"
                    ) {

                        event.preventDefault();

                        previousSlide();

                        restartAutoplay();

                    }

                }
            );


            /* =====================================================
               INITIAL STATE
               ===================================================== */

            setActiveDot(0);

            startAutoplay();

        });

});