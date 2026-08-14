<?php
/**
 * Single Medical Professional
 * Pinnacle Behavioral Healthcare
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        /*
         * =====================================================
         * ACF FIELDS
         * =====================================================
         */

        $provider_image    = get_field( 'provider_photo' );
        $credentials       = get_field( 'provider_credentials' );
        $provider_title    = get_field( 'provider_title' );
        $bio               = get_field( 'provider_bio' );
        $philosophy        = get_field( 'provider_treatment_philosophy' );
        $modalities        = get_field( 'provider_therapy_modalities' );
        $areas_of_focus    = get_field( 'provider_areas_of_focus' );
        $experience        = get_field( 'provider_professional_experience' );
        $community         = get_field( 'provider_community_involvement' );

        /*
         * Optional Psychology Today profile.
         */
        $psychology_today_url = get_field(
            'provider_psychology_today_url'
        );

        /*
         * Optional testimonials.
         */

  $testimonials_heading = get_field(
    'provider_testimonials_heading'
   );

   if ( ! $testimonials_heading ) {
    $testimonials_heading = '';
   }
        $show_testimonials = get_field(
            'provider_show_testimonials'
        );

$testimonials = get_post_meta(
    get_the_ID(),
    '_pinnacle_provider_testimonials',
    true
);

if ( ! is_array( $testimonials ) ) {
    $testimonials = array();
}


        /*
         * =====================================================
         * FALLBACKS
         * =====================================================
         */

        if ( ! $credentials ) {
            $credentials = get_the_title();
        }

        if ( ! $provider_title ) {
            $provider_title = 'Medical Professional';
        }


        /*
         * =====================================================
         * PROVIDER IMAGE FALLBACK
         * =====================================================
         */

        if ( ! $provider_image && has_post_thumbnail() ) {

            $provider_image = array(
                'url' => get_the_post_thumbnail_url(
                    get_the_ID(),
                    'large'
                ),
                'alt' => get_the_title(),
            );

        }


        /*
         * =====================================================
         * BANNER IMAGE
         * =====================================================
         */

        $banner_image_url =
            get_template_directory_uri()
            . '/assets/images/back.webp';


        $provider_banner =
            get_field(
                'provider_banner_image'
            );


        if (
            is_array( $provider_banner )
            && ! empty( $provider_banner['url'] )
        ) {

            $banner_image_url =
                $provider_banner['url'];

        }

        ?>

        <main class="provider-profile">

            <!-- =================================================
                 PROVIDERS BANNER
            ================================================== -->

            <section
                class="provider-profile__banner"
                style="background-image:url('<?php echo esc_url( $banner_image_url ); ?>');"
            >

                <div class="provider-profile__banner-overlay">

                    <div class="provider-profile__container">

                        <h1 class="provider-profile__banner-title">
                            Providers
                        </h1>

                    </div>

                </div>

            </section>


            <!-- =================================================
                 MAIN PROVIDER CONTENT
            ================================================== -->

            <section class="provider-profile__content">

                <div class="provider-profile__container">

                    <div class="provider-profile__grid">


                        <!-- =====================================
                             PROVIDER IMAGE
                        ====================================== -->

                        <div class="provider-profile__media">

                            <?php if (
                                $provider_image
                                && ! empty(
                                    $provider_image['url']
                                )
                            ) : ?>

                                <img
                                    class="provider-profile__image"
                                    src="<?php echo esc_url(
                                        $provider_image['url']
                                    ); ?>"
                                    alt="<?php echo esc_attr(
                                        ! empty(
                                            $provider_image['alt']
                                        )
                                            ? $provider_image['alt']
                                            : $credentials
                                    ); ?>"
                                >

                            <?php endif; ?>

                        </div>


                        <!-- =====================================
                             PROVIDER INFORMATION
                        ====================================== -->

                        <div class="provider-profile__main">


                            <!-- =================================
                                 NAME
                            ================================== -->

                            <h2 class="provider-profile__name">

                                <?php
                                echo esc_html(
                                    $credentials
                                );
                                ?>

                            </h2>


                            <!-- =================================
                                 ROLE
                            ================================== -->

                            <p class="provider-profile__role">

                                <?php
                                echo esc_html(
                                    $provider_title
                                );
                                ?>

                            </p>


                            <!-- =================================
                                 SHARE
                            ================================== -->

                            <section
                                class="provider-profile__share"
                            >

                                <h3
                                    class="provider-profile__share-title"
                                >
                                    Share and Enjoy !
                                </h3>


                                <div
                                    class="provider-profile__share-buttons"
                                >

                                    <span
                                        class="provider-profile__share-label"
                                    >

                                        <span
                                            class="provider-profile__share-icon"
                                            aria-hidden="true"
                                        >
                                            ↗
                                        </span>

                                        <small>
                                            SHARES
                                        </small>

                                    </span>


                                    <!-- Facebook -->

                                    <a
                                        class="provider-profile__share-btn provider-profile__share-btn--facebook"
                                        href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="Share on Facebook"
                                    >
                                        f
                                    </a>


                                    <!-- Pinterest -->

                                    <a
                                        class="provider-profile__share-btn provider-profile__share-btn--pinterest"
                                        href="https://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink() ); ?>&description=<?php echo rawurlencode( $credentials ); ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="Share on Pinterest"
                                    >
                                        p
                                    </a>


                                    <!-- PDF -->

                                    <button
                                        type="button"
                                        class="provider-profile__share-btn provider-profile__share-btn--pdf"
                                        onclick="window.print();"
                                        aria-label="Print provider profile"
                                    >
                                        PDF
                                    </button>


                                    <!-- Copy -->

                                    <button
                                        type="button"
                                        class="provider-profile__share-btn provider-profile__share-btn--copy"
                                        onclick="
                                            if (navigator.clipboard) {
                                                navigator.clipboard.writeText(
                                                    window.location.href
                                                );
                                            }
                                        "
                                        aria-label="Copy link"
                                    >
                                        🔗
                                    </button>


                                    <!-- More -->

                                    <button
                                        type="button"
                                        class="provider-profile__share-btn provider-profile__share-btn--more"
                                        onclick="
                                            if (navigator.share) {
                                                navigator.share({
                                                    title: document.title,
                                                    url: window.location.href
                                                });
                                            } else if (navigator.clipboard) {
                                                navigator.clipboard.writeText(
                                                    window.location.href
                                                );
                                            }
                                        "
                                        aria-label="More sharing options"
                                    >
                                        +
                                    </button>

                                </div>

                            </section>


                            <!-- =================================
                                 BIOGRAPHY
                            ================================== -->

                            <?php if ( $bio ) : ?>

                                <div class="provider-profile__rich-text">

                                    <?php
                                    echo wp_kses_post(
                                        $bio
                                    );
                                    ?>

                                </div>

                            <?php endif; ?>


                            <!-- =================================
                                 TREATMENT PHILOSOPHY
                            ================================== -->

                            <?php if ( $philosophy ) : ?>

                                <section
                                    class="provider-profile__section"
                                >

                                    <h3>
                                        Treatment Philosophy
                                    </h3>

                                    <div
                                        class="provider-profile__rich-text"
                                    >

                                        <?php
                                        echo wp_kses_post(
                                            $philosophy
                                        );
                                        ?>

                                    </div>

                                </section>

                            <?php endif; ?>


                            <!-- =================================
                                 THERAPY MODALITIES
                            ================================== -->

                            <?php if ( $modalities ) : ?>

                                <section
                                    class="provider-profile__section"
                                >

                                    <h3>
                                        Therapy Modalities
                                    </h3>

                                    <div
                                        class="provider-profile__rich-text"
                                    >

                                        <?php
                                        echo wp_kses_post(
                                            $modalities
                                        );
                                        ?>

                                    </div>

                                </section>

                            <?php endif; ?>


                            <!-- =================================
                                 AREAS OF FOCUS
                            ================================== -->

                            <?php if ( $areas_of_focus ) : ?>

                                <section
                                    class="provider-profile__section"
                                >

                                    <h3>
                                        Areas of Focus
                                    </h3>

                                    <div
                                        class="provider-profile__rich-text"
                                    >

                                        <?php
                                        echo wp_kses_post(
                                            $areas_of_focus
                                        );
                                        ?>

                                    </div>

                                </section>

                            <?php endif; ?>


                            <!-- =================================
                                 PROFESSIONAL EXPERIENCE
                            ================================== -->

                            <?php if ( $experience ) : ?>

                                <section
                                    class="provider-profile__section"
                                >

                                    <h3>
                                        Professional Experience
                                    </h3>

                                    <div
                                        class="provider-profile__rich-text"
                                    >

                                        <?php
                                        echo wp_kses_post(
                                            $experience
                                        );
                                        ?>

                                    </div>

                                </section>

                            <?php endif; ?>


                            <!-- =================================
                                 COMMUNITY INVOLVEMENT
                            ================================== -->

                            <?php if ( $community ) : ?>

                                <section
                                    class="provider-profile__section"
                                >

                                    <h3>
                                        Community Involvement
                                    </h3>

                                    <div
                                        class="provider-profile__rich-text"
                                    >

                                        <?php
                                        echo wp_kses_post(
                                            $community
                                        );
                                        ?>

                                    </div>

                                </section>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </section>


            <!-- =================================================
                 PSYCHOLOGY TODAY BUTTON
                 OPTIONAL
            ================================================== -->

            <?php if ( $psychology_today_url ) : ?>

                <section
                    class="provider-profile__external-profile"
                >

                    <div class="provider-profile__container">

                        <a
                            href="<?php echo esc_url(
                                $psychology_today_url
                            ); ?>"
                            class="provider-profile__external-button"
                            target="_blank"
                            rel="noopener noreferrer"
                        >

                            <span>
                                VIEW PSYCHOLOGY TODAY PROFILE
                            </span>

                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <line
                                    x1="5"
                                    y1="12"
                                    x2="19"
                                    y2="12"
                                />

                                <polyline
                                    points="12 5 19 12 12 19"
                                />

                            </svg>

                        </a>

                    </div>

                </section>

            <?php endif; ?>


            <!-- =================================================
                 TESTIMONIALS
                 OPTIONAL PER PROVIDER
            ================================================== -->

            <?php if (
                $show_testimonials
                && ! empty( $testimonials )
            ) : ?>

                <section
                    class="provider-testimonials"
                    data-testimonials-count="<?php echo esc_attr( count( $testimonials ) ); ?>"
                >

                    <div
                        class="provider-testimonials__container"
                    >

         <h2 class="provider-testimonials__title">
             <?php echo esc_html( $testimonials_heading ); ?>
            </h2>


                        <div
                            class="provider-testimonials__slider"
                        >


                            <!-- PREVIOUS -->

                            <button
                                type="button"
                                class="provider-testimonials__arrow provider-testimonials__arrow--prev"
                                aria-label="Previous testimonials"
                            >

                                <svg
                                    width="18"
                                    height="18"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <polyline
                                        points="15 18 9 12 15 6"
                                    />
                                </svg>

                            </button>


                            <!-- VIEWPORT -->

                            <div
                                class="provider-testimonials__viewport"
                            >

                                <div
                                    class="provider-testimonials__track"
                                >

                                    <?php foreach (
                                        $testimonials
                                        as $testimonial
                                    ) : ?>

                                        <?php

                                        $initial =
                                            ! empty(
                                                $testimonial['initial']
                                            )
                                                ? $testimonial['initial']
                                                : '';

                                        $name =
                                            ! empty(
                                                $testimonial['name']
                                            )
                                                ? $testimonial['name']
                                                : '';

                                        $role =
                                            ! empty(
                                                $testimonial['role']
                                            )
                                                ? $testimonial['role']
                                                : '';

                                        $text =
                                            ! empty(
                                                $testimonial['text']
                                            )
                                                ? $testimonial['text']
                                                : '';

                                        ?>

                                        <article
                                            class="provider-testimonial"
                                        >


                                            <!-- HEADER -->

                                            <div
                                                class="provider-testimonial__header"
                                            >

                                                <div
                                                    class="provider-testimonial__avatar"
                                                >
                                                    <?php
                                                    echo esc_html(
                                                        strtoupper(
                                                            substr(
                                                                $initial,
                                                                0,
                                                                1
                                                            )
                                                        )
                                                    );
                                                    ?>
                                                </div>


                                                <div
                                                    class="provider-testimonial__identity"
                                                >

                                                    <h3>

                                                        <?php
                                                        echo esc_html(
                                                            $name
                                                        );
                                                        ?>

                                                    </h3>


                                                    <?php if ( $role ) : ?>

                                                        <span>

                                                            <?php
                                                            echo esc_html(
                                                                $role
                                                            );
                                                            ?>

                                                        </span>

                                                    <?php endif; ?>

                                                </div>

                                            </div>


                                            <!-- TESTIMONIAL TEXT -->

                                            <div
                                                class="provider-testimonial__text"
                                            >

                                                <?php
                                                echo esc_html(
                                                    $text
                                                );
                                                ?>

                                            </div>

                                        </article>

                                    <?php endforeach; ?>

                                </div>

                            </div>


                            <!-- NEXT -->

                            <button
                                type="button"
                                class="provider-testimonials__arrow provider-testimonials__arrow--next"
                                aria-label="Next testimonials"
                            >

                                <svg
                                    width="18"
                                    height="18"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <polyline
                                        points="9 18 15 12 9 6"
                                    />
                                </svg>

                            </button>

                        </div>


                        <!-- DOTS -->

                        <div
                            class="provider-testimonials__dots"
                            aria-label="Testimonials navigation"
                        ></div>

                    </div>

                </section>

            <?php endif; ?>


            <!-- =================================================
                 BOOK CONSULTATION
            ================================================== -->

        


            <!-- =================================================
                 EXISTING CONTACT SECTION
            ================================================== -->

            <?php

            get_template_part(
                'template-parts/contact/contact'
            );

            ?>

        </main>


        <!-- =====================================================
             TESTIMONIAL SLIDER SCRIPT
        ====================================================== -->

        <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const slider =
                    document.querySelector(
                        '.provider-testimonials'
                    );

                if ( ! slider ) {
                    return;
                }


                const track =
                    slider.querySelector(
                        '.provider-testimonials__track'
                    );

                const cards =
                    slider.querySelectorAll(
                        '.provider-testimonial'
                    );

                const previous =
                    slider.querySelector(
                        '.provider-testimonials__arrow--prev'
                    );

                const next =
                    slider.querySelector(
                        '.provider-testimonials__arrow--next'
                    );

                const dotsContainer =
                    slider.querySelector(
                        '.provider-testimonials__dots'
                    );


                if (
                    ! track ||
                    ! cards.length
                ) {
                    return;
                }


                let currentPage = 0;

                let perPage = 2;

                let pageCount = 1;


                function getPerPage() {

                    if (
                        window.innerWidth <= 767
                    ) {
                        return 1;
                    }

                    if (
                        window.innerWidth <= 1000
                    ) {
                        return 1;
                    }

                    return 2;

                }


                function createDots() {

                    dotsContainer.innerHTML = '';


                    for (
                        let i = 0;
                        i < pageCount;
                        i++
                    ) {

                        const dot =
                            document.createElement(
                                'button'
                            );


                        dot.type = 'button';

                        dot.className =
                            'provider-testimonials__dot';


                        dot.setAttribute(
                            'aria-label',
                            'Show testimonial group ' +
                            ( i + 1 )
                        );


                        dot.addEventListener(
                            'click',
                            function () {

                                currentPage = i;

                                updateSlider();

                            }
                        );


                        dotsContainer.appendChild(
                            dot
                        );

                    }

                }


                function updateSlider() {

                    perPage =
                        getPerPage();


                    pageCount =
                        Math.max(
                            1,
                            Math.ceil(
                                cards.length /
                                perPage
                            )
                        );


                    if (
                        currentPage >=
                        pageCount
                    ) {

                        currentPage =
                            pageCount - 1;

                    }


                    createDots();


                    const firstCard =
                        cards[0];


                    if ( ! firstCard ) {
                        return;
                    }


                    const cardWidth =
                        firstCard.getBoundingClientRect()
                            .width;


                    const trackStyles =
                        window.getComputedStyle(
                            track
                        );


                    const gap =
                        parseFloat(
                            trackStyles.gap
                        ) || 0;


                    const moveBy =
                        (
                            cardWidth + gap
                        ) * perPage;


                    const offset =
                        currentPage *
                        moveBy;


                    track.style.transform =
                        'translateX(-' +
                        offset +
                        'px)';


                    const dots =
                        dotsContainer.querySelectorAll(
                            '.provider-testimonials__dot'
                        );


                    dots.forEach(
                        function (
                            dot,
                            index
                        ) {

                            dot.classList.toggle(
                                'is-active',
                                index ===
                                currentPage
                            );

                        }
                    );


                    previous.disabled =
                        currentPage === 0;


                    next.disabled =
                        currentPage >=
                        pageCount - 1;


                    previous.style.opacity =
                        previous.disabled
                            ? '0.35'
                            : '1';


                    next.style.opacity =
                        next.disabled
                            ? '0.35'
                            : '1';

                }


                previous.addEventListener(
                    'click',
                    function () {

                        if (
                            currentPage > 0
                        ) {

                            currentPage--;

                            updateSlider();

                        }

                    }
                );


                next.addEventListener(
                    'click',
                    function () {

                        if (
                            currentPage <
                            pageCount - 1
                        ) {

                            currentPage++;

                            updateSlider();

                        }

                    }
                );


                let resizeTimer;


                window.addEventListener(
                    'resize',
                    function () {

                        clearTimeout(
                            resizeTimer
                        );


                        resizeTimer =
                            setTimeout(
                                updateSlider,
                                150
                            );

                    }
                );


                updateSlider();

            }
        );

        </script>


        <?php

    endwhile;

endif;


get_footer();