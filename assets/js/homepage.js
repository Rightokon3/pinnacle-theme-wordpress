document.addEventListener("DOMContentLoaded", function () {

    var newsSection = document.querySelector("#news");

    if (!newsSection) {
        return;
    }

    var viewport = newsSection.querySelector(".news__viewport");
    var track = newsSection.querySelector(".news__track");

    var cards = Array.prototype.slice.call(
        newsSection.querySelectorAll(".news__card")
    );

    var dotsWrap = newsSection.querySelector(".news__dots");

    var prevButton = newsSection.querySelector(
        ".news__arrow--prev"
    );

    var nextButton = newsSection.querySelector(
        ".news__arrow--next"
    );

    if (!viewport || !track || cards.length === 0) {
        return;
    }


    /* =====================================================
       SETTINGS
       ===================================================== */

    var mobileBreakpoint = 1023;

    var autoplayDelay = 5000;


    function getCardsPerView() {
        return window.innerWidth <= mobileBreakpoint
            ? 1
            : 2;
    }


    function getSlideCount() {

        var perView = getCardsPerView();

        return Math.max(
            1,
            Math.ceil(cards.length / perView)
        );
    }


    var currentIndex = 0;

    var autoplayTimer = null;

    var isDragging = false;

    var dragStartX = 0;

    var dragCurrentX = 0;

    var dragStartTranslate = 0;

    /*
     * Important:
     * We don't start dragging immediately on pointerdown.
     * This allows normal clicks and text selection.
     */
    var dragIntent = false;

    var dragThreshold = 8;


    /* =====================================================
       SLIDE WIDTH
       ===================================================== */

    function getSlideWidth() {

        if (!viewport) {
            return 0;
        }

        return viewport.clientWidth;
    }


    /* =====================================================
       TRANSLATE
       ===================================================== */

    function getTranslateForIndex(index) {

        var slideWidth = getSlideWidth();

        return -(index * slideWidth);
    }


    /* =====================================================
       MOVE TO SLIDE
       ===================================================== */

    function goToSlide(index, animate) {

        var slideCount = getSlideCount();

        if (slideCount <= 0) {
            return;
        }


        if (index < 0) {
            index = slideCount - 1;
        }

        if (index >= slideCount) {
            index = 0;
        }


        currentIndex = index;


        var translateX =
            getTranslateForIndex(currentIndex);


        if (animate === false) {

            track.style.transition = "none";

        } else {

            track.style.transition =
                "transform 0.55s ease";
        }


        track.style.transform =
            "translate3d(" +
            translateX +
            "px, 0, 0)";


        updateDots();
    }


    /* =====================================================
       CREATE DOTS
       ===================================================== */

    function createDots() {

        if (!dotsWrap) {
            return;
        }

        dotsWrap.innerHTML = "";

        var slideCount = getSlideCount();


        for (
            var index = 0;
            index < slideCount;
            index++
        ) {

            var dot =
                document.createElement("button");

            dot.type = "button";

            dot.className = "news__dot";

            dot.setAttribute(
                "aria-label",
                "Show news slide " + (index + 1)
            );


            (function (slideIndex) {

                dot.addEventListener(
                    "click",
                    function () {

                        stopAutoplay();

                        goToSlide(
                            slideIndex,
                            true
                        );

                        startAutoplay();
                    }
                );

            })(index);


            dotsWrap.appendChild(dot);
        }


        updateDots();
    }


    /* =====================================================
       UPDATE DOTS
       ===================================================== */

    function updateDots() {

        if (!dotsWrap) {
            return;
        }


        var dots =
            dotsWrap.querySelectorAll(
                ".news__dot"
            );


        for (
            var index = 0;
            index < dots.length;
            index++
        ) {

            dots[index].classList.toggle(
                "is-active",
                index === currentIndex
            );
        }
    }


    /* =====================================================
       AUTOPLAY
       ===================================================== */

    function startAutoplay() {

        stopAutoplay();


        if (cards.length <= 1) {
            return;
        }


        autoplayTimer =
            window.setInterval(
                function () {

                    if (isDragging) {
                        return;
                    }


                    var nextIndex =
                        currentIndex + 1;


                    if (
                        nextIndex >=
                        getSlideCount()
                    ) {

                        nextIndex = 0;
                    }


                    goToSlide(
                        nextIndex,
                        true
                    );

                },
                autoplayDelay
            );
    }


    /* =====================================================
       STOP AUTOPLAY
       ===================================================== */

    function stopAutoplay() {

        if (autoplayTimer) {

            window.clearInterval(
                autoplayTimer
            );

            autoplayTimer = null;
        }
    }


    /* =====================================================
       PREVIOUS
       ===================================================== */

    if (prevButton) {

        prevButton.addEventListener(
            "click",
            function () {

                stopAutoplay();

                goToSlide(
                    currentIndex - 1,
                    true
                );

                startAutoplay();
            }
        );
    }


    /* =====================================================
       NEXT
       ===================================================== */

    if (nextButton) {

        nextButton.addEventListener(
            "click",
            function () {

                stopAutoplay();

                goToSlide(
                    currentIndex + 1,
                    true
                );

                startAutoplay();
            }
        );
    }


    /* =====================================================
       POINTER DOWN
       ===================================================== */

    viewport.addEventListener(
        "pointerdown",
        function (event) {

            /*
             * VERY IMPORTANT:
             *
             * Do not start carousel dragging when the user
             * interacts with a link, button, form element,
             * or text-selection target.
             */

            var interactiveElement =
                event.target.closest(
                    "a, button, input, textarea, select, option, label"
                );


            if (interactiveElement) {
                return;
            }


            /*
             * Only mouse / touch / pen dragging should be
             * handled by the carousel.
             */

            if (
                event.pointerType !== "mouse" &&
                event.pointerType !== "touch" &&
                event.pointerType !== "pen"
            ) {
                return;
            }


            dragIntent = true;

            isDragging = false;

            dragStartX = event.clientX;

            dragCurrentX = event.clientX;


            var computedStyle =
                window.getComputedStyle(
                    track
                );


            var matrix;

            try {

                matrix =
                    new DOMMatrixReadOnly(
                        computedStyle.transform
                    );

            } catch (error) {

                matrix = {
                    m41: 0
                };
            }


            dragStartTranslate =
                matrix.m41;


            stopAutoplay();


            /*
             * Do NOT call setPointerCapture yet.
             *
             * We wait until the pointer has actually moved.
             */
        }
    );


    /* =====================================================
       POINTER MOVE
       ===================================================== */

    viewport.addEventListener(
        "pointermove",
        function (event) {

            if (!dragIntent) {
                return;
            }


            dragCurrentX =
                event.clientX;


            var difference =
                dragCurrentX -
                dragStartX;


            /*
             * Don't treat tiny pointer movement as dragging.
             *
             * This is what allows normal text selection/clicking.
             */

            if (!isDragging) {

                if (
                    Math.abs(difference) <
                    dragThreshold
                ) {
                    return;
                }


                isDragging = true;


                track.classList.add(
                    "is-dragging"
                );


                if (
                    viewport.setPointerCapture
                ) {

                    try {

                        viewport.setPointerCapture(
                            event.pointerId
                        );

                    } catch (error) {
                        // Ignore unsupported browsers.
                    }
                }
            }


            /*
             * Once movement is large enough,
             * actually move the carousel.
             */

            track.style.transition =
                "none";


            track.style.transform =
                "translate3d(" +
                (
                    dragStartTranslate +
                    difference
                ) +
                "px, 0, 0)";
        }
    );


    /* =====================================================
       FINISH DRAG
       ===================================================== */

    function finishDrag(event) {

        if (!dragIntent) {
            return;
        }


        dragIntent = false;


        /*
         * If the user didn't actually drag,
         * this was simply a click/text-selection action.
         */

        if (!isDragging) {

            isDragging = false;

            startAutoplay();

            return;
        }


        isDragging = false;


        track.classList.remove(
            "is-dragging"
        );


        var difference =
            dragCurrentX -
            dragStartX;


        var swipeThreshold = 50;


        /*
         * Swipe left
         */

        if (
            difference <
            -swipeThreshold
        ) {

            goToSlide(
                currentIndex + 1,
                true
            );

        }


        /*
         * Swipe right
         */

        else if (
            difference >
            swipeThreshold
        ) {

            goToSlide(
                currentIndex - 1,
                true
            );

        }


        /*
         * Not enough movement:
         * return to current slide.
         */

        else {

            goToSlide(
                currentIndex,
                true
            );
        }


        startAutoplay();
    }


    viewport.addEventListener(
        "pointerup",
        finishDrag
    );


    viewport.addEventListener(
        "pointercancel",
        finishDrag
    );


    viewport.addEventListener(
        "pointerleave",
        function (event) {

            /*
             * Only finish a real drag.
             */

            if (isDragging) {
                finishDrag(event);
            }

        }
    );


    /* =====================================================
       RESIZE
       ===================================================== */

    var resizeTimer = null;


    window.addEventListener(
        "resize",
        function () {

            window.clearTimeout(
                resizeTimer
            );


            resizeTimer =
                window.setTimeout(
                    function () {

                        createDots();


                        var slideCount =
                            getSlideCount();


                        if (
                            currentIndex >=
                            slideCount
                        ) {

                            currentIndex =
                                slideCount - 1;
                        }


                        goToSlide(
                            currentIndex,
                            false
                        );


                        startAutoplay();

                    },
                    150
                );
        }
    );


    /* =====================================================
       INITIALIZE
       ===================================================== */

    createDots();


    goToSlide(
        0,
        false
    );


    startAutoplay();

});