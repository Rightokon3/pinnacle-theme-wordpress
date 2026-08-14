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

    /*
     * Change this number if you want the carousel
     * faster or slower.
     *
     * 5000 = 5 seconds
     */
    var autoplayDelay = 5000;


    /*
     * Desktop shows 2 cards.
     * Mobile shows 1 card.
     */
    function getCardsPerView() {

        return window.innerWidth <= mobileBreakpoint
            ? 1
            : 2;
    }


    /*
     * Number of actual slides/pages.
     *
     * Example:
     *
     * 6 articles
     *
     * Desktop:
     * 2 + 2 + 2 = 3 pages
     *
     * Mobile:
     * 1 + 1 + 1 + 1 + 1 + 1 = 6 pages
     */
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


    /* =====================================================
       CALCULATE SLIDE WIDTH
       ===================================================== */

    function getSlideWidth() {

        if (!viewport) {
            return 0;
        }

        return viewport.clientWidth;
    }


    /* =====================================================
       GET TRANSLATE POSITION
       ===================================================== */

    function getTranslateForIndex(index) {

        var perView = getCardsPerView();

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

        /*
         * Infinite wrap.
         */
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
                "Show news slide " +
                (index + 1)
            );


            /*
             * Important:
             * use let-like closure by creating
             * a separate function scope.
             */
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


        /*
         * IMPORTANT:
         *
         * There is NO mobile check here.
         *
         * Therefore autoplay works on:
         *
         * Desktop
         * Tablet
         * Mobile
         */
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
       PREVIOUS BUTTON
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
       NEXT BUTTON
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
       POINTER DRAG
       =====================================================
       
       Works with:
       
       - Finger
       - Mouse
       - Trackpad
       
       So the user can physically drag the
       carousel instead of only clicking dots.
    */

    viewport.addEventListener(
        "pointerdown",
        function (event) {

            if (event.pointerType === "mouse") {

                /*
                 * Allow mouse dragging on desktop.
                 */
            }


            stopAutoplay();


            isDragging = true;


            dragStartX =
                event.clientX;

            dragCurrentX =
                event.clientX;


            /*
             * Get current transform position.
             */
            var computedStyle =
                window.getComputedStyle(
                    track
                );


            var matrix =
                new DOMMatrixReadOnly(
                    computedStyle.transform
                );


            dragStartTranslate =
                matrix.m41;


            track.classList.add(
                "is-dragging"
            );


            /*
             * Keep receiving pointer movement.
             */
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
    );


    viewport.addEventListener(
        "pointermove",
        function (event) {

            if (!isDragging) {
                return;
            }


            dragCurrentX =
                event.clientX;


            var difference =
                dragCurrentX -
                dragStartX;


            /*
             * Move the track with the finger/mouse.
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


    function finishDrag() {

        if (!isDragging) {
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
         * snap back.
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
        function () {

            /*
             * Only finish if the pointer is
             * actually being dragged.
             */
            if (isDragging) {
                finishDrag();
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

                        /*
                         * Recreate dots because the
                         * number of pages changes:
                         *
                         * Desktop = 3 pages for 6 cards
                         * Mobile  = 6 pages for 6 cards
                         */
                        createDots();


                        /*
                         * Make sure current index
                         * still exists.
                         */
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


                        /*
                         * Restart autoplay.
                         */
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


    /*
     * Autoplay starts on BOTH
     * desktop and mobile.
     */
    startAutoplay();

});