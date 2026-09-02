<?php
/**
 * Template Name: ADHD Testing
 *
 * Pinnacle Behavioral Healthcare
 *
 * ACF Free compatible.
 *
 * Layout:
 * 1. Hero
 * 2. Breadcrumb
 * 3. Share buttons
 * 4. Intro
 * 5. Two top images
 * 6. QbTest text
 * 7. Qbtech logo
 * 8. Second text + image section
 * 9. Video
 * 10. What to Expect
 * 11. Sidebar contact card
 * 12. Related services
 * 13. Consultation CTA
 * 14. Existing contact section
 */

get_header();


/* =========================================================
 * PAGE DATA
 * ========================================================= */

/*
 * HERO
 */
$hero_image = get_field('adhd_testing_hero_image');

$hero_image_url =
    (
        is_array($hero_image)
        && !empty($hero_image['url'])
    )
        ? $hero_image['url']
        : get_template_directory_uri() . '/assets/images/back.webp';

$hero_image_alt =
    (
        is_array($hero_image)
        && !empty($hero_image['alt'])
    )
        ? $hero_image['alt']
        : get_the_title();


/*
 * TITLE
 */
$page_title = get_field('adhd_testing_title');

if (!$page_title) {
    $page_title = get_the_title();
}


/*
 * EYEBROW
 */
$eyebrow = get_field('adhd_testing_eyebrow');


/*
 * INTRO
 */
$intro = get_field('adhd_testing_intro');


/*
 * TOP IMAGE 1
 */
$top_image_1 = get_field('adhd_testing_top_image_1');


/*
 * TOP IMAGE 2
 */
$top_image_2 = get_field('adhd_testing_top_image_2');


/*
 * QBTEST TEXT
 */
$qbtest_text = get_field('adhd_testing_qbtest_text');


/*
 * QBTECH LOGO
 */
$qbtech_logo = get_field('adhd_testing_qbtech_logo');


/*
 * SECOND SECTION TEXT
 */
$second_text = get_field('adhd_testing_second_section_text');


/*
 * SECOND SECTION IMAGE
 */
$second_image = get_field('adhd_testing_second_section_image');


/*
 * VIDEO
 */
$video_title = get_field('adhd_testing_video_title');

if (!$video_title) {
    $video_title = 'Learn More About ADHD Testing';
}

$video_url = get_field('adhd_testing_video_url');

$video_description = get_field(
    'adhd_testing_video_description'
);


/*
 * WHAT TO EXPECT
 */
$expect_heading = get_field(
    'adhd_testing_expect_heading'
);

if (!$expect_heading) {
    $expect_heading = 'What to Expect';
}

$expect = get_field(
    'adhd_testing_expect'
);


/*
 * BACKWARD COMPATIBILITY:
 *
 * Keep your older ACF fields working too.
 */
if (!$qbtest_text) {
    $qbtest_text = get_field(
        'adhd_testing_overview'
    );
}

if (!$second_text) {
    $second_text = get_field(
        'adhd_testing_why'
    );
}

if (!$second_image) {
    $second_image = get_field(
        'adhd_testing_content_image'
    );
}


/*
 * SIDEBAR CTA
 */
$sidebar_cta_text = get_field(
    'adhd_testing_sidebar_cta_text'
);

if (!$sidebar_cta_text) {
    $sidebar_cta_text = 'Schedule Consultation';
}


$sidebar_cta_link = get_field(
    'adhd_testing_sidebar_cta_link'
);

if (!$sidebar_cta_link) {
    $sidebar_cta_link = home_url('/contact/');
}


/*
 * BOTTOM CTA
 */
$bottom_cta_heading = get_field(
    'adhd_testing_bottom_cta_heading'
);

if (!$bottom_cta_heading) {
    $bottom_cta_heading = 'Book a Consultation';
}


$bottom_cta_text = get_field(
    'adhd_testing_bottom_cta_text'
);

if (!$bottom_cta_text) {
    $bottom_cta_text = 'Schedule Consultation';
}


$bottom_cta_link = get_field(
    'adhd_testing_bottom_cta_link'
);

if (!$bottom_cta_link) {
    $bottom_cta_link = home_url('/contact/');
}


/* =========================================================
 * YOUTUBE HELPER
 * ========================================================= */

if (!function_exists('pinnacle_extract_youtube_id')) {

    function pinnacle_extract_youtube_id($url)
    {
        if (!$url) {
            return '';
        }

        $patterns = array(

            '~youtu\.be/([A-Za-z0-9_-]{11})~i',

            '~youtube\.com/watch\?[^#]*v=([A-Za-z0-9_-]{11})~i',

            '~youtube\.com/embed/([A-Za-z0-9_-]{11})~i',

            '~youtube\.com/shorts/([A-Za-z0-9_-]{11})~i',

        );

        foreach ($patterns as $pattern) {

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


$youtube_id = pinnacle_extract_youtube_id(
    $video_url
);


/* =========================================================
 * RELATED SERVICES
 * ========================================================= */

$related_services = get_field(
    'services_list',
    'option'
);

if (empty($related_services)) {

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
                        $page_title
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
                    $page_title
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


            <a
                class="share-btn share-btn--facebook"
                href="https://www.facebook.com/share.php?u=<?php echo rawurlencode(get_permalink()); ?>"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Share on Facebook"
            >
                f
            </a>


            <a
                class="share-btn share-btn--pinterest"
                href="https://www.pinterest.com/pin/create/button/?url=<?php echo rawurlencode(get_permalink()); ?>"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Share on Pinterest"
            >
                p
            </a>


            <button
                type="button"
                class="share-btn share-btn--pdf"
                onclick="window.print();"
                aria-label="Print page"
            >
                PDF
            </button>


            <button
                type="button"
                class="share-btn share-btn--copy"
                data-copy-link="<?php echo esc_attr(
                    get_permalink()
                ); ?>"
                aria-label="Copy link"
            >
                ↗
            </button>


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
                +
            </button>

        </div>

    </section>


    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

    <section class="service-detail">

        <div class="service-detail__grid">


            <!-- =================================================
                 MAIN COLUMN
            ================================================== -->

            <article class="service-detail__main">


                <!-- =================================================
                     EYEBROW
                ================================================== -->

                <?php if ($eyebrow) : ?>

                    <p class="service-detail__eyebrow">

                        <?php
                        echo esc_html(
                            $eyebrow
                        );
                        ?>

                    </p>

                <?php endif; ?>


                <!-- =================================================
                     INTRO
                ================================================== -->

                <?php if ($intro) : ?>

                    <div
                        class="service-detail__content"
                    >

                        <?php
                        echo wp_kses_post(
                            $intro
                        );
                        ?>

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     TWO TOP IMAGES
                ================================================== -->

                <?php
                $has_top_image_1 =
                    is_array($top_image_1)
                    && !empty(
                        $top_image_1['url']
                    );

                $has_top_image_2 =
                    is_array($top_image_2)
                    && !empty(
                        $top_image_2['url']
                    );
                ?>


                <?php if (
                    $has_top_image_1
                    || $has_top_image_2
                ) : ?>

                    <div class="adhd-top-images">


                        <?php if (
                            $has_top_image_1
                        ) : ?>

                            <figure
                                class="adhd-top-images__item"
                            >

                                <img
                                    src="<?php echo esc_url(
                                        $top_image_1['url']
                                    ); ?>"
                                    alt="<?php echo esc_attr(
                                        $top_image_1['alt']
                                        ?? $page_title
                                    ); ?>"
                                    loading="lazy"
                                >

                            </figure>

                        <?php endif; ?>


                        <?php if (
                            $has_top_image_2
                        ) : ?>

                            <figure
                                class="adhd-top-images__item"
                            >

                                <img
                                    src="<?php echo esc_url(
                                        $top_image_2['url']
                                    ); ?>"
                                    alt="<?php echo esc_attr(
                                        $top_image_2['alt']
                                        ?? $page_title
                                    ); ?>"
                                    loading="lazy"
                                >

                            </figure>

                        <?php endif; ?>

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     QBTEST MAIN TEXT
                ================================================== -->

                <?php if ($qbtest_text) : ?>

                    <div
                        class="adhd-content__text"
                    >

                        <?php
                        echo wp_kses_post(
                            $qbtest_text
                        );
                        ?>

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     QBTECH LOGO
                ================================================== -->

                <?php
                $has_qbtech_logo =
                    is_array($qbtech_logo)
                    && !empty(
                        $qbtech_logo['url']
                    );
                ?>


                <?php if (
                    $has_qbtech_logo
                ) : ?>

                    <div
                        class="adhd-qbtech-logo"
                    >

                        <img
                            src="<?php echo esc_url(
                                $qbtech_logo['url']
                            ); ?>"
                            alt="<?php echo esc_attr(
                                $qbtech_logo['alt']
                                ?? 'Qbtech'
                            ); ?>"
                            loading="lazy"
                        >

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     SECOND TEXT + IMAGE
                ================================================== -->

                <?php
                $has_second_image =
                    is_array($second_image)
                    && !empty(
                        $second_image['url']
                    );
                ?>


                <?php if (
                    $second_text
                    || $has_second_image
                ) : ?>

                    <section
                        class="adhd-second-section"
                    >


                        <?php if (
                            $second_text
                        ) : ?>

                            <div
                                class="adhd-second-section__text"
                            >

                                <?php
                                echo wp_kses_post(
                                    $second_text
                                );
                                ?>

                            </div>

                        <?php endif; ?>


                        <?php if (
                            $has_second_image
                        ) : ?>

                            <figure
                                class="adhd-second-section__image"
                            >

                                <img
                                    src="<?php echo esc_url(
                                        $second_image['url']
                                    ); ?>"
                                    alt="<?php echo esc_attr(
                                        $second_image['alt']
                                        ?? $page_title
                                    ); ?>"
                                    loading="lazy"
                                >

                            </figure>

                        <?php endif; ?>


                    </section>

                <?php endif; ?>


                <!-- =================================================
                     VIDEO
                ================================================== -->

                <?php if ($video_url) : ?>

                    <section
                        class="adhd-video"
                    >

                        <h2>
                            <?php
                            echo esc_html(
                                $video_title
                            );
                            ?>
                        </h2>


                        <div
                            class="adhd-video__frame"
                        >

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


                        <?php if (
                            $video_description
                        ) : ?>

                            <p
                                class="service-detail__video-description"
                            >

                                <?php
                                echo esc_html(
                                    $video_description
                                );
                                ?>

                            </p>

                        <?php endif; ?>

                    </section>

                <?php endif; ?>


                <!-- =================================================
                     WHAT TO EXPECT
                ================================================== -->

                <?php if ($expect) : ?>

                    <section
                        class="service-detail__section"
                    >

                        <h2>
                            <?php
                            echo esc_html(
                                $expect_heading
                            );
                            ?>
                        </h2>


                        <div
                            class="service-detail__content"
                        >

                            <?php
                            echo wp_kses_post(
                                $expect
                            );
                            ?>

                        </div>

                    </section>

                <?php endif; ?>


                <!-- =================================================
                     NORMAL WORDPRESS CONTENT
                ================================================== -->

                <?php
                $standard_content =
                    get_the_content();
                ?>

                <?php if (
                    trim(
                        wp_strip_all_tags(
                            $standard_content
                        )
                    )
                ) : ?>

                    <section
                        class="service-detail__section"
                    >

                        <div
                            class="service-detail__content"
                        >

                            <?php
                            echo apply_filters(
                                'the_content',
                                $standard_content
                            );
                            ?>

                        </div>

                    </section>

                <?php endif; ?>


            </article>


            <!-- =================================================
                 SIDEBAR
            ================================================== -->

            <aside
                class="service-detail__sidebar"
            >


                <!-- =================================================
                     CONTACT CARD
                ================================================== -->

                <div
                    class="pillar-sidebar__inner service-contact-card"
                >

                    <h3
                        class="pillar-sidebar__title"
                    >
                        Contact Us
                    </h3>


 <?php
if ( function_exists( 'do_shortcode' ) ) {

    echo do_shortcode(
        '[contact-form-7 id="477211b" title="ADHD Testing contact form"]'
    );

}
?>

                </div>


                <!-- =================================================
                     RELATED SERVICES
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
                                $related['title']
                                ?? '';

                            $related_link =
                                $related['link']['url']
                                ?? '#';

                            $is_current =
                                strtolower(
                                    trim(
                                        $related_title
                                    )
                                )
                                ===
                                strtolower(
                                    trim(
                                        $page_title
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


                <!-- =================================================
                     SIDEBAR CTA
                ================================================== -->

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


<!-- =========================================================
     COPY LINK
========================================================== -->

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
                            !url ||
                            !navigator.clipboard
                        ) {
                            return;
                        }

                        navigator.clipboard
                            .writeText(url)
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
                );

            }
        );

    }
);
</script>


<?php
get_footer();
?>