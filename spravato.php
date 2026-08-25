
<?php
/**
 * Template Name: Service Detail
 *
 * Pinnacle Behavioral Healthcare
 *
 * Reusable service page template for:
 * - Spravato
 * - TMS
 * - ADHD Testing
 * - Individual Psychotherapy
 * - Medication Management
 * - Other service pages
 *
 * ACF FREE compatible.
 *
 * Content:
 * 1. Banner image
 * 2. Intro content
 * 3. Video embed
 * 4. Content image
 * 5. Normal WordPress editor content
 * 6. Requirements
 * 7. Contact sidebar
 * 8. Services navigation
 * 9. Consultation CTA
 * 10. Existing site contact section
 */

get_header();


/* =========================================================
   PAGE DATA
   ========================================================= */

$banner_image = get_field(
    'service_banner_image'
);

$banner_image_url = (
    is_array( $banner_image )
    && ! empty( $banner_image['url'] )
)
    ? $banner_image['url']
    : get_template_directory_uri()
        . '/assets/images/back.webp';


$banner_image_alt = (
    is_array( $banner_image )
    && ! empty( $banner_image['alt'] )
)
    ? $banner_image['alt']
    : get_the_title();


/*
 * Main introduction.
 *
 * ACF Free WYSIWYG.
 */
$intro_content = get_field(
    'service_intro_content'
);


/*
 * Video.
 */
$video_url = get_field(
    'service_video_url'
);

$video_title = get_field(
    'service_video_title'
);

if ( ! $video_title ) {
    $video_title =
        get_the_title()
        . ' Video';
}

$video_description = get_field(
    'service_video_description'
);


/*
 * Content image.
 */
$content_image = get_field(
    'service_content_image'
);


/*
 * Requirements.
 *
 * This assumes your existing ACF field
 * service_requirements is a repeater.
 */
$requirements = get_field(
    'service_requirements'
);


/*
 * Sidebar CTA.
 */
$cta_text = get_field(
    'service_cta_text'
);

if ( ! $cta_text ) {
    $cta_text = 'Schedule Consultation';
}


$cta_link = get_field(
    'service_cta_link'
);

if ( ! $cta_link ) {
    $cta_link = home_url(
        '/contact/'
    );
}


/* =========================================================
   YOUTUBE URL HELPER
   ========================================================= */

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

            /*
             * youtu.be/XXXXXXXXXXX
             */
            '~youtu\.be/([A-Za-z0-9_-]{11})~i',

            /*
             * youtube.com/watch?v=XXXXXXXXXXX
             */
            '~youtube\.com/watch\?[^#]*v=([A-Za-z0-9_-]{11})~i',

            /*
             * youtube.com/embed/XXXXXXXXXXX
             */
            '~youtube\.com/embed/([A-Za-z0-9_-]{11})~i',

            /*
             * youtube.com/shorts/XXXXXXXXXXX
             */
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
   HERO
   ========================================================= */

?>

<section
    class="providers-banner"
    style="
        background-image:
        url('<?php echo esc_url(
            $banner_image_url
        ); ?>');
    "
>

    <div class="providers-banner__overlay">

        <div class="providers-banner__inner">

            <h1 class="providers-banner__title">

                <?php
                echo esc_html(
                    get_the_title()
                );
                ?>

            </h1>

        </div>

    </div>

</section>


<!-- =========================================================
     BREADCRUMB
========================================================== -->

<div
    class="providers-breadcrumb-container"
>

    <p
        class="providers-banner__breadcrumb"
    >

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
                get_the_title()
            );
            ?>
        </span>

    </p>

</div>


<!-- =========================================================
     SHARE
========================================================== -->

<section
    class="share-section"
>

    <h2
        class="share-section__title"
    >
        Share and Enjoy !
    </h2>


    <div
        class="share-section__buttons"
    >

        <span
            class="share-section__label"
        >
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
                aria-hidden="true"
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


        <!-- COPY LINK -->

        <button
            type="button"
            class="share-btn share-btn--copy"
            data-copy-link="<?php echo esc_url(
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
                aria-hidden="true"
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
                stroke-width="2.4"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
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


<!-- =========================================================
     MAIN SERVICE CONTENT
========================================================== -->

<section
    class="service-detail"
>

    <div
        class="service-detail__grid"
    >


        <!-- =====================================================
             MAIN CONTENT
        ====================================================== -->

        <div
            class="service-detail__main"
        >


            <!-- =================================================
                 ACF INTRO
            ================================================== -->

            <?php if (
                ! empty(
                    $intro_content
                )
            ) : ?>

                <div
                    class="service-detail__content"
                >

                    <?php
                    echo wp_kses_post(
                        $intro_content
                    );
                    ?>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 CONTENT IMAGE
            ================================================== -->

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
                            ! empty(
                                $content_image['alt']
                            )
                                ? $content_image['alt']
                                : get_the_title()
                        ); ?>"
                        loading="lazy"
                    >

                </figure>

            <?php endif; ?>


            <!-- =================================================
                 VIDEO
            ================================================== -->

            <?php if (
                $video_url
            ) : ?>

                <?php

                $youtube_id =
                    pinnacle_extract_youtube_id(
                        $video_url
                    );

                ?>

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


                    <div
                        class="pillar-video"
                    >

                        <div
                            class="pillar-video__frame"
                        >

                            <?php if (
                                $youtube_id
                            ) : ?>

                                <!-- YOUTUBE -->

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

                            <?php elseif (
                                strpos(
                                    strtolower(
                                        $video_url
                                    ),
                                    'brightcove'
                                ) !== false
                            ) : ?>

                                <!-- BRIGHTCOVE -->

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

                            <?php else : ?>

                                <!-- GENERIC EMBED -->

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
                 NORMAL WORDPRESS EDITOR
            ================================================== -->

            <?php if (
                trim(
                    get_the_content()
                )
            ) : ?>

                <div
                    class="service-detail__content"
                >

                    <?php
                    the_content();
                    ?>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 REQUIREMENTS
            ================================================== -->

            <?php if (
                ! empty(
                    $requirements
                )
            ) : ?>

                <section
                    class="service-detail__requirements"
                >

                    <h2>
                        What You'll Need
                    </h2>


                    <ul>

                        <?php
                        foreach (
                            $requirements
                            as $requirement
                        ) :
                        ?>

                            <?php
                            if (
                                empty(
                                    $requirement['item']
                                )
                            ) {
                                continue;
                            }
                            ?>

                            <li>

                                <?php
                                echo esc_html(
                                    $requirement['item']
                                );
                                ?>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                </section>

            <?php endif; ?>


        </div>


        <!-- =====================================================
             RIGHT SIDEBAR
        ====================================================== -->

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


                <form
                    class="contact-form__form"
                    method="post"
                    action=""
                >

                    <label>

                        <span class="sr-only">
                            First Name
                        </span>

                        <input
                            type="text"
                            name="first_name"
                            class="contact-form__input"
                            placeholder="First Name*"
                            required
                        >

                    </label>


                    <label>

                        <span class="sr-only">
                            Last Name
                        </span>

                        <input
                            type="text"
                            name="last_name"
                            class="contact-form__input"
                            placeholder="Last Name*"
                            required
                        >

                    </label>


                    <label>

                        <span class="sr-only">
                            Phone Number
                        </span>

                        <input
                            type="tel"
                            name="phone"
                            class="contact-form__input"
                            placeholder="Phone Number*"
                            required
                        >

                    </label>


                    <label>

                        <span class="sr-only">
                            Email Address
                        </span>

                        <input
                            type="email"
                            name="email"
                            class="contact-form__input"
                            placeholder="Email Address*"
                            required
                        >

                    </label>


                    <label>

                        <span class="sr-only">
                            Message
                        </span>

                        <textarea
                            name="message"
                            class="contact-form__input contact-form__textarea"
                            rows="4"
                            placeholder="Message*"
                            required
                        ></textarea>

                    </label>


                    <button
                        type="submit"
                        class="contact-form__submit"
                    >

                        Send Message

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

                    </button>

                </form>

            </div>


            <!-- =================================================
                 RELATED SERVICES
            ================================================== -->

            <?php

            $related_services =
                get_field(
                    'services_list',
                    'option'
                );

            ?>


            <?php if (
                ! empty(
                    $related_services
                )
            ) : ?>

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


            <?php else : ?>


                <!-- =================================================
                     FALLBACK SERVICES
                ================================================== -->

                <?php

                $fallback_services = array(

                    'ADHD Testing' =>
                        home_url(
                            '/adhd-testing/'
                        ),

                    'Individual Psychotherapy' =>
                        home_url(
                            '/individual-psychotherapy-in-minneapolis/'
                        ),

                    'NeuroStar Advanced TMS Therapy' =>
                        home_url(
                            '/neurostar-advanced-tms-therapy-in-minneapolis/'
                        ),

                    'Spravato' =>
                        home_url(
                            '/spravato/'
                        ),

                    'Telehealth Psychiatric Medication Management' =>
                        home_url(
                            '/telehealth-psychiatric-medication-management/'
                        ),

                    'Medication Management' =>
                        home_url(
                            '/medication-management/'
                        ),
                );

                ?>


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
                            $fallback_services
                            as $service_title => $service_url
                        ) :
                        ?>

                            <?php

                            $is_current =
                                strtolower(
                                    trim(
                                        $service_title
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
                                        $service_url
                                    ); ?>"
                                    class="<?php echo $is_current
                                        ? 'is-current'
                                        : ''; ?>"
                                >

                                    <span>

                                        <?php
                                        echo esc_html(
                                            $service_title
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

            <?php endif; ?>


            <!-- =================================================
                 SIDEBAR CTA
            ================================================== -->

            <a
                href="<?php echo esc_url(
                    $cta_link
                ); ?>"
                class="service-detail__sidebar-cta"
            >

                <?php
                echo esc_html(
                    $cta_text
                );
                ?>

                <span>
                    →
                </span>

            </a>


        </aside>

    </div>


    <!-- =====================================================
         EXISTING CONTACT SECTION
    ====================================================== -->

    <?php

    get_template_part(
        'template-parts/contact/contact'
    );

    ?>

</section>


<!-- =========================================================
     COPY LINK SCRIPT
========================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const copyButtons =
            document.querySelectorAll(
                '[data-copy-link]'
            );


        copyButtons.forEach(
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
                            || ! navigator.clipboard
                        ) {
                            return;
                        }


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
                );

            }
        );

    }
);

</script>


<?php
get_footer();
?>

