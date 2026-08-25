<?php
/**
 * Single Spravato
 *
 * Pinnacle Behavioral Healthcare
 *
 * This template is used automatically for the
 * "spravato" Custom Post Type.
 *
 * Editable through:
 * - WordPress title/editor
 * - ACF Free fields
 *
 * Supports:
 * - Hero image
 * - Hero title
 * - Intro/content
 * - Video iframe/embed URL
 * - Content image
 * - Sidebar contact card
 * - Services navigation
 * - Consultation CTA
 * - Existing Contact section
 */

get_header();


/* =========================================================
 * PAGE DATA
 * ========================================================= */

/*
 * Hero image
 */
$hero_image = get_field(
    'spravato_hero_image'
);

$hero_image_url =
    (
        is_array( $hero_image )
        && ! empty( $hero_image['url'] )
    )
        ? $hero_image['url']
        : get_template_directory_uri()
            . '/assets/images/back.webp';

$hero_image_alt =
    (
        is_array( $hero_image )
        && ! empty( $hero_image['alt'] )
    )
        ? $hero_image['alt']
        : get_the_title();


/*
 * Hero title
 */
$hero_title = get_field(
    'spravato_hero_title'
);

if ( ! $hero_title ) {
    $hero_title = get_the_title();
}


/*
 * Eyebrow
 */
$eyebrow = get_field(
    'spravato_eyebrow'
);


/*
 * Main ACF introduction
 */
$intro_content = get_field(
    'spravato_intro'
);


/*
 * Normal WordPress editor content
 */
$editor_content = get_the_content();


/*
 * Video
 */
$video_url = get_field(
    'spravato_video_url'
);

$video_title = get_field(
    'spravato_video_title'
);

if ( ! $video_title ) {
    $video_title = 'Learn More About Spravato';
}

$video_description = get_field(
    'spravato_video_description'
);


/*
 * Content image
 */
$content_image = get_field(
    'spravato_content_image'
);

$content_image_alt = get_field(
    'spravato_content_image_alt'
);


/*
 * Sidebar CTA
 */
$sidebar_cta_text = get_field(
    'spravato_sidebar_cta_text'
);

if ( ! $sidebar_cta_text ) {
    $sidebar_cta_text = 'Schedule Consultation';
}

$sidebar_cta_link = get_field(
    'spravato_sidebar_cta_link'
);

if ( ! $sidebar_cta_link ) {
    $sidebar_cta_link = home_url(
        '/contact/'
    );
}


/*
 * Bottom CTA
 */
$bottom_cta_heading = get_field(
    'spravato_bottom_cta_heading'
);

if ( ! $bottom_cta_heading ) {
    $bottom_cta_heading = 'Book a Consultation';
}

$bottom_cta_text = get_field(
    'spravato_bottom_cta_text'
);

if ( ! $bottom_cta_text ) {
    $bottom_cta_text = 'Schedule Consultation';
}

$bottom_cta_link = get_field(
    'spravato_bottom_cta_link'
);

if ( ! $bottom_cta_link ) {
    $bottom_cta_link = home_url(
        '/contact/'
    );
}


/* =========================================================
 * YOUTUBE ID HELPER
 * ========================================================= */

if (
    ! function_exists(
        'pinnacle_extract_youtube_id'
    )
) {

    function pinnacle_extract_youtube_id(
        $url
    ) {

        if ( ! $url ) {
            return '';
        }

        $patterns = array(

            '~youtu\.be/([A-Za-z0-9_-]{11})~i',

            '~youtube\.com/watch\?[^#]*v=([A-Za-z0-9_-]{11})~i',

            '~youtube\.com/embed/([A-Za-z0-9_-]{11})~i',

            '~youtube\.com/shorts/([A-Za-z0-9_-]{11})~i',

        );

        foreach (
            $patterns as $pattern
        ) {

            if (
                preg_match(
                    $pattern,
                    $url,
                    $matches
                )
            ) {

                return $matches[1];

            }
        }

        return '';
    }
}


/* =========================================================
 * VIDEO HELPERS
 * ========================================================= */

$youtube_id =
    pinnacle_extract_youtube_id(
        $video_url
    );


/* =========================================================
 * SERVICES NAVIGATION
 * ========================================================= */

$related_services = get_field(
    'services_list',
    'option'
);


/*
 * Fallback services
 */
if ( empty( $related_services ) ) {

    $related_services = array(

        array(
            'title' => 'ADHD Testing',
            'link' => array(
                'url' => home_url(
                    '/adhd-testing/'
                ),
            ),
        ),

        array(
            'title' => 'Individual Psychotherapy',
            'link' => array(
                'url' => home_url(
                    '/individual-psychotherapy-in-minneapolis/'
                ),
            ),
        ),

        array(
            'title' => 'NeuroStar Advanced TMS Therapy',
            'link' => array(
                'url' => home_url(
                    '/neurostar-advanced-tms-therapy-in-minneapolis/'
                ),
            ),
        ),

        array(
            'title' => 'Spravato',
            'link' => array(
                'url' => home_url(
                    '/spravato/'
                ),
            ),
        ),

        array(
            'title' => 'Medication Management',
            'link' => array(
                'url' => home_url(
                    '/medication-management/'
                ),
            ),
        ),

        array(
            'title' => 'Telehealth Psychiatric Medication Management',
            'link' => array(
                'url' => home_url(
                    '/telehealth-psychiatric-medication-management/'
                ),
            ),
        ),

    );
}

?>

<main class="service-detail-page">


    <!-- =====================================================
         HERO
    ====================================================== -->

    <section
        class="providers-banner"
        style="
            background-image:
            url('<?php echo esc_url(
                $hero_image_url
            ); ?>');
        "
    >

        <div class="providers-banner__overlay">

            <div class="providers-banner__inner">

                <h1 class="providers-banner__title">
                    <?php
                    echo esc_html(
                        $hero_title
                    );
                    ?>
                </h1>

            </div>

        </div>

    </section>


    <!-- =====================================================
         BREADCRUMB
    ====================================================== -->

    <div class="providers-breadcrumb-container">

        <p class="providers-banner__breadcrumb">

            <a
                href="<?php echo esc_url(
                    home_url('/')
                ); ?>"
            >
                Home
            </a>

            <span aria-hidden="true">
                &raquo;
            </span>

            <span>
                <?php
                echo esc_html(
                    $hero_title
                );
                ?>
            </span>

        </p>

    </div>


    <!-- =====================================================
         SHARE
    ====================================================== -->

    <section class="share-section">

        <h2 class="share-section__title">
            Share and Enjoy !
        </h2>


        <div class="share-section__buttons">

            <span class="share-section__label">
                SHARES
            </span>


            <!-- FACEBOOK -->

            <a
                class="share-btn share-btn--facebook"
                href="https://www.facebook.com/share.php?u=<?php echo rawurlencode(
                    get_permalink()
                ); ?>"
                aria-label="Share on Facebook"
                target="_blank"
                rel="noopener noreferrer"
            >

                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    aria-hidden="true"
                >

                    <path
                        d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"
                    />

                </svg>

            </a>


            <!-- PINTEREST -->

            <a
                class="share-btn share-btn--pinterest"
                href="https://www.pinterest.com/pin/create/button/?url=<?php echo rawurlencode(
                    get_permalink()
                ); ?>"
                aria-label="Share on Pinterest"
                target="_blank"
                rel="noopener noreferrer"
            >

                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    aria-hidden="true"
                >

                    <path
                        d="M12 2C6.5 2 2 6.5 2 12c0 4.2 2.6 7.8 6.3 9.3-.1-.8-.2-2 0-2.9l1.4-6s-.4-.7-.4-1.8c0-1.7 1-2.9 2.2-2.9 1 0 1.5.8 1.5 1.7 0 1-.7 2.6-1 4-.3 1.2.6 2.2 1.8 2.2 2.1 0 3.7-2.3 3.7-5.5 0-2.9-2.1-4.9-5-4.9-3.4 0-5.5 2.6-5.5 5.2 0 1 .4 2.1.9 2.7.1.1.1.2.1.3-.1.4-.3 1.2-.3 1.4-.1.2-.2.3-.4.2-1.5-.7-2.4-2.9-2.4-4.6 0-3.8 2.7-7.2 7.9-7.2 4.1 0 7.4 3 7.4 6.9 0 4.1-2.6 7.4-6.2 7.4-1.2 0-2.4-.6-2.7-1.4l-.8 2.9c-.3 1-1 2.3-1.5 3.1 1.1.3 2.3.5 3.5.5 5.5 0 10-4.5 10-10S17.5 2 12 2z"
                    />

                </svg>

            </a>


            <!-- PDF -->

            <button
                type="button"
                class="share-btn share-btn--pdf"
                onclick="window.print();"
                aria-label="Print / Save as PDF"
            >

                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path
                        d="M6 9V2h9l5 5v2"
                    />

                    <path
                        d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"
                    />

                    <rect
                        x="6"
                        y="14"
                        width="12"
                        height="8"
                    />

                </svg>

            </button>


            <!-- COPY -->

            <button
                type="button"
                class="share-btn share-btn--copy"
                data-copy-link="<?php echo esc_attr(
                    get_permalink()
                ); ?>"
                aria-label="Copy link"
            >

                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <rect
                        x="9"
                        y="9"
                        width="13"
                        height="13"
                        rx="2"
                    />

                    <path
                        d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"
                    />

                </svg>

            </button>


            <!-- MORE -->

            <button
                type="button"
                class="share-btn share-btn--more"
                aria-label="More sharing options"
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
            >

                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <line
                        x1="12"
                        y1="5"
                        x2="12"
                        y2="19"
                    />

                    <line
                        x1="5"
                        y1="12"
                        x2="19"
                        y2="12"
                    />

                </svg>

            </button>

        </div>

    </section>


    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

    <section class="service-detail">

        <div class="service-detail__grid">


            <!-- =================================================
                 LEFT CONTENT
            ================================================== -->

            <article class="service-detail__main">


                <!-- EYEBROW -->

                <?php if ( $eyebrow ) : ?>

                    <p class="service-detail__eyebrow">

                        <?php
                        echo esc_html(
                            $eyebrow
                        );
                        ?>

                    </p>

                <?php endif; ?>


                <!-- ACF INTRO -->

                <?php if (
                    $intro_content
                ) : ?>

                    <div class="service-detail__content">

                        <?php
                        echo wp_kses_post(
                            $intro_content
                        );
                        ?>

                    </div>

                <?php endif; ?>


                <!-- NORMAL WORDPRESS EDITOR -->

                <?php if (
                    trim(
                        wp_strip_all_tags(
                            $editor_content
                        )
                    )
                ) : ?>

                    <div class="service-detail__content">

                        <?php
                        echo apply_filters(
                            'the_content',
                            $editor_content
                        );
                        ?>

                    </div>

                <?php endif; ?>


                <!-- CONTENT IMAGE -->

                <?php if (
                    is_array(
                        $content_image
                    )
                    && ! empty(
                        $content_image['url']
                    )
                ) : ?>

                    <figure
                        class="service-detail__image"
                    >

                        <img
                            src="<?php echo esc_url(
                                $content_image['url']
                            ); ?>"
                            alt="<?php echo esc_attr(
                                $content_image_alt
                                ?: (
                                    ! empty(
                                        $content_image['alt']
                                    )
                                        ? $content_image['alt']
                                        : get_the_title()
                                )
                            ); ?>"
                            loading="lazy"
                        >

                    </figure>

                <?php endif; ?>


                <!-- VIDEO -->

                <?php if (
                    $video_url
                ) : ?>

                    <section
                        class="service-detail__video"
                    >

                        <h2>
                            <?php
                            echo esc_html(
                                $video_title
                            );
                            ?>
                        </h2>


                        <div class="pillar-video">

                            <div class="pillar-video__frame">

                                <?php if (
                                    $youtube_id
                                ) : ?>

                                    <iframe
                                        src="https://www.youtube.com/embed/<?php echo esc_attr(
                                            $youtube_id
                                        ); ?>"
                                        title="<?php echo esc_attr(
                                            $video_title
                                        ); ?>"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                        loading="lazy"
                                    ></iframe>

                                <?php else : ?>

                                    <iframe
                                        src="<?php echo esc_url(
                                            $video_url
                                        ); ?>"
                                        title="<?php echo esc_attr(
                                            $video_title
                                        ); ?>"
                                        allow="autoplay; fullscreen; encrypted-media; picture-in-picture"
                                        allowfullscreen
                                        loading="lazy"
                                    ></iframe>

                                <?php endif; ?>

                            </div>

                        </div>


                        <?php if (
                            $video_description
                        ) : ?>

                            <p class="service-detail__video-description">

                                <?php
                                echo esc_html(
                                    $video_description
                                );
                                ?>

                            </p>

                        <?php endif; ?>

                    </section>

                <?php endif; ?>


            </article>


            <!-- =================================================
                 RIGHT SIDEBAR
            ================================================== -->

            <aside class="service-detail__sidebar">


                <!-- CONTACT CARD -->

                <div
                    class="pillar-sidebar__inner service-contact-card"
                >

                    <h3
                        class="pillar-sidebar__title"
                    >
                        Contact Us
                    </h3>


                    <?php
                    /*
                     * Reuse the site's existing contact form
                     * template when available.
                     */
                    get_template_part(
                        'template-parts/contact/contact-form'
                    );
                    ?>

                </div>


                <!-- =================================================
                     SERVICES NAVIGATION
                ================================================== -->

                <div
                    class="pillar-sidebar__inner service-nav-card"
                >

                    <h3
                        class="pillar-sidebar__title"
                    >
                        Home
                    </h3>


                    <ul
                        class="pillar-sidebar__list"
                    >

                        <?php
                        foreach (
                            $related_services
                            as $related
                        ) :
                        ?>

                            <?php

                            $related_title =
                                isset(
                                    $related['title']
                                )
                                    ? $related['title']
                                    : '';

                            $related_link =
                                isset(
                                    $related['link']['url']
                                )
                                    ? $related['link']['url']
                                    : '#';

                            $is_current =
                                strtolower(
                                    trim(
                                        $related_title
                                    )
                                )
                                ===
                                strtolower(
                                    trim(
                                        get_the_title()
                                    )
                                );

                            ?>

                            <li>

                                <a
                                    href="<?php echo esc_url(
                                        $related_link
                                    ); ?>"
                                    class="<?php echo $is_current
                                        ? 'is-current'
                                        : ''; ?>"
                                >

                                    <span>

                                        <?php
                                        echo esc_html(
                                            $related_title
                                        );
                                        ?>

                                    </span>

                                    <svg
                                        width="16"
                                        height="16"
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

                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>


                <!-- SIDEBAR CTA -->

                <a
                    href="<?php echo esc_url(
                        $sidebar_cta_link
                    ); ?>"
                    class="service-detail__sidebar-cta"
                >

                    <?php
                    echo esc_html(
                        $sidebar_cta_text
                    );
                    ?>

                    <span>
                        →
                    </span>

                </a>


            </aside>

        </div>


        <!-- =================================================
             BOTTOM CTA
        ================================================== -->

        <section class="service-detail__cta">

            <div class="service-detail__cta-inner">

                <h2>
                    <?php
                    echo esc_html(
                        $bottom_cta_heading
                    );
                    ?>
                </h2>


                <a
                    href="<?php echo esc_url(
                        $bottom_cta_link
                    ); ?>"
                    class="service-detail__cta-button"
                >

                    <?php
                    echo esc_html(
                        $bottom_cta_text
                    );
                    ?>

                    <span>
                        →
                    </span>

                </a>

            </div>

        </section>


        <!-- =================================================
             EXISTING CONTACT SECTION
        ================================================== -->

        <?php

        get_template_part(
            'template-parts/contact/contact'
        );

        ?>

    </section>

</main>


<!-- =====================================================
     COPY LINK
====================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const buttons =
            document.querySelectorAll(
                '[data-copy-link]'
            );

        buttons.forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const url =
                            button.getAttribute(
                                'data-copy-link'
                            );

                        if (
                            ! url
                        ) {
                            return;
                        }

                        if (
                            navigator.clipboard
                        ) {

                            navigator.clipboard
                                .writeText(
                                    url
                                )
                                .then(
                                    function () {

                                        const original =
                                            button.innerHTML;

                                        button.innerHTML =
                                            '✓';

                                        setTimeout(
                                            function () {

                                                button.innerHTML =
                                                    original;

                                            },
                                            1200
                                        );

                                    }
                                );

                        }

                    }
                );

            }
        );

    }
);

</script>


<?php
get_footer();
?>