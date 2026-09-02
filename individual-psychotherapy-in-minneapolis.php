<?php
/**
 * Template Name: Service Detail
 *
 * Reusable page template for individual service pages:
 * Medication Management, TMS Treatments, Individual Psychotherapy,
 * Spravato, ADHD Testing, etc.
 *
 * Sidebar:
 * 1. Contact Us
 * 2. Home / Services navigation
 *
 * The Home navigation uses the ACF services_list option when available.
 * If it is empty, a fallback navigation is displayed so the Home section
 * never disappears.
 */

get_header();

/*
|--------------------------------------------------------------------------
| Banner
|--------------------------------------------------------------------------
*/

$banner_image = get_field('service_banner_image');

$banner_image_url =
    $banner_image['url']
    ?? get_template_directory_uri() . '/assets/images/back.webp';

$banner_image_alt =
    $banner_image['alt']
    ?? get_the_title();


/*
|--------------------------------------------------------------------------
| Service Content
|--------------------------------------------------------------------------
*/

$intro_content = get_field('service_intro_content');

$requirements = get_field('service_requirements');

$cta_text =
    get_field('service_cta_text')
    ?: 'Schedule Consultation';

$cta_link =
    get_field('service_cta_link')
    ?: home_url('/contact/');


/*
|--------------------------------------------------------------------------
| Individual Psychotherapy Fallback Content
|--------------------------------------------------------------------------
|
| If the ACF "service_intro_content" field is empty, display the
| Individual Psychotherapy content below.
|
*/

if (empty($intro_content)) {

    $intro_content = '
        <p>
            <a href="' . esc_url(home_url('/')) . '">
                Pinnacle Behavioral Healthcare
            </a>
            offers individual psychotherapy in Edina for patients ages
            18 and up.
        </p>

        <p>
            Psychotherapy is a process through which you can work with
            a trained mental health professional to explore your thoughts,
            feelings, and behaviors in order to gain insight, identify
            patterns, and learn new ways of coping. Our providers for
            mental health offer a safe and supportive environment in which
            you can explore the challenges you are facing and learn new
            skills to help you manage your symptoms. We offer individual
            psychotherapy for a variety of mental health conditions,
            including but not limited to:
        </p>

        <ul class="service-detail__conditions">

            <li>
                <a href="' .
                    esc_url(
                        home_url(
                            '/neurostar-advanced-tms-therapy-in-minneapolis/conditions-treated/anxious-depression/'
                        )
                    ) .
                '">
                    Anxiety disorders
                </a>
            </li>

            <li>
                <a href="' .
                    esc_url(
                        home_url('/adhd-testing/')
                    ) .
                '">
                    Attention-deficit / hyperactivity disorder (ADHD)
                </a>
            </li>

            <li>
                Bipolar disorder
            </li>

            <li>
                <a href="' .
                    esc_url(
                        home_url(
                            '/neurostar-advanced-tms-therapy-in-minneapolis/conditions-treated/'
                        )
                    ) .
                '">
                    Depression
                </a>
            </li>

            <li>
                Eating disorders
            </li>

            <li>
                <a href="' .
                    esc_url(
                        home_url(
                            '/neurostar-advanced-tms-therapy-in-minneapolis/conditions-treated/ocd/'
                        )
                    ) .
                '">
                    Obsessive-compulsive disorder (OCD)
                </a>
            </li>

            <li>
                Posttraumatic stress disorder (PTSD)
            </li>

            <li>
                Substance abuse
            </li>

            <li>
                Schizophrenia
            </li>

        </ul>
    ';
}


/*
|--------------------------------------------------------------------------
| Map + Address
|--------------------------------------------------------------------------
|
| These are kept from your original template because they may be used
| by other parts of your service-page system.
|
*/

$map_lat =
    get_field('service_map_lat')
    ?: get_field('contact_map_lat', 'option')
    ?: 44.9778;

$map_lng =
    get_field('service_map_lng')
    ?: get_field('contact_map_lng', 'option')
    ?: -93.265;

$map_name =
    get_field('service_map_business_name')
    ?: get_field('contact_map_business_name', 'option')
    ?: get_bloginfo('name');

?>



<!-- =========================================================
     SERVICE BANNER
     ========================================================= -->

<section
    class="providers-banner"
    style="background-image:url('<?php echo esc_url($banner_image_url); ?>');"
>

    <div class="providers-banner__overlay">

        <div class="providers-banner__inner">

            <h1 class="providers-banner__title">
                <?php echo esc_html(get_the_title()); ?>
            </h1>

        </div>

    </div>

</section>



<!-- =========================================================
     BREADCRUMB
     ========================================================= -->

<div class="providers-breadcrumb-container">

    <p class="providers-banner__breadcrumb">

        <a href="<?php echo esc_url(home_url('/')); ?>">
            Home
        </a>

        <span aria-hidden="true">
            &raquo;
        </span>

        <span>
            <?php echo esc_html(get_the_title()); ?>
        </span>

    </p>

</div>



<!-- =========================================================
     SHARE SECTION
     ========================================================= -->

<section class="share-section">

    <h2 class="share-section__title">
        Share and Enjoy !
    </h2>


    <div class="share-section__buttons">

        <span class="share-section__label">
            SHARES
        </span>


        <!-- Facebook -->

        <a
            class="share-btn share-btn--facebook"
            href="https://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>"
            aria-label="Share on Facebook"
            target="_blank"
            rel="noopener"
        >

            <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="currentColor"
                aria-hidden="true"
            >

                <path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/>

            </svg>

        </a>



        <!-- Pinterest -->

        <a
            class="share-btn share-btn--pinterest"
            href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>"
            aria-label="Share on Pinterest"
            target="_blank"
            rel="noopener"
        >

            <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="currentColor"
                aria-hidden="true"
            >

                <path d="M12 2C6.5 2 2 6.5 2 12c0 4.2 2.6 7.8 6.3 9.3-.1-.8-.2-2 0-2.9l1.4-6s-.4-.7-.4-1.8c0-1.7 1-2.9 2.2-2.9 1 0 1.5.8 1.5 1.7 0 1-.7 2.6-1 4-.3 1.2.6 2.2 1.8 2.2 2.1 0 3.7-2.3 3.7-5.5 0-2.9-2.1-4.9-5-4.9-3.4 0-5.5 2.6-5.5 5.2 0 1 .4 2.1.9 2.7.1.1.1.2.1.3-.1.4-.3 1.2-.3 1.4-.1.2-.2.3-.4.2-1.5-.7-2.4-2.9-2.4-4.6 0-3.8 2.7-7.2 7.9-7.2 4.1 0 7.4 3 7.4 6.9 0 4.1-2.6 7.4-6.2 7.4-1.2 0-2.4-.6-2.7-1.4l-.8 2.9c-.3 1-1 2.3-1.5 3.1 1.1.3 2.3.5 3.5.5 5.5 0 10-4.5 10-10S17.5 2 12 2z"/>

            </svg>

        </a>



        <!-- PDF / Print -->

        <button
            type="button"
            class="share-btn share-btn--pdf"
            onclick="window.print()"
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

                <path d="M6 9V2h9l5 5v2"/>

                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>

                <rect
                    x="6"
                    y="14"
                    width="12"
                    height="8"
                />

            </svg>

        </button>



        <!-- Copy Link -->

        <button
            type="button"
            class="share-btn share-btn--copy"
            data-copy-link="<?php echo esc_url(get_permalink()); ?>"
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

                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>

            </svg>

        </button>



        <!-- More -->

        <button
            type="button"
            class="share-btn share-btn--more"
            aria-label="More sharing options"
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
     ========================================================= -->

<section class="service-detail">

    <div class="service-detail__grid">


        <!-- =================================================
             LEFT SIDE
             ================================================= -->

        <div class="service-detail__main">

            <?php if ($intro_content) : ?>

                <div class="service-detail__content">

                    <?php
                    echo wp_kses_post($intro_content);
                    ?>

                </div>

            <?php endif; ?>


            <?php
            /*
             * Keep the existing "What You'll Need" section
             * for other service pages.
             *
             * It will not interfere with the psychotherapy
             * fallback content above.
             */

            if (!empty($requirements)) :
            ?>

                <div class="service-detail__requirements">

                    <h2>
                        What You'll Need
                    </h2>

                    <ul>

                        <?php foreach ($requirements as $req) : ?>

                            <li>
                                <?php
                                echo esc_html(
                                    $req['item'] ?? ''
                                );
                                ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>

        </div>



        <!-- =================================================
             RIGHT SIDEBAR
             ================================================= -->

        <aside class="service-detail__sidebar">


            <!-- =============================================
                 CONTACT US
                 ============================================= -->

            <div class="pillar-sidebar__inner service-contact-card">

                <h3 class="pillar-sidebar__title">
                    Contact Us
                </h3>


       <?php echo do_shortcode('[contact-form-7 id="dd2ccc0" title="Service Contact Form"]'); ?>

            </div>



            <!-- =============================================
                 HOME / SERVICES NAVIGATION
                 ============================================= -->

            <?php

            /*
             * First try the ACF services_list option.
             */

            $related_services =
                get_field(
                    'services_list',
                    'option'
                );


            /*
             * If ACF is empty, use the fallback list.
             *
             * This is what fixes the missing "Home" box.
             */

            if (empty($related_services)) {

                $related_services = [

                    [
                        'title' => 'ADHD Testing',

                        'link' => [
                            'url' => home_url(
                                '/adhd-testing/'
                            ),
                        ],
                    ],


                    [
                        'title' => 'Individual Psychotherapy',

                        'link' => [
                            'url' => home_url(
                                '/individual-psychotherapy-in-minneapolis/'
                            ),
                        ],
                    ],


                    [
                        'title' => 'NeuroStar Advanced TMS Therapy',

                        'link' => [
                            'url' => home_url(
                                '/neurostar-advanced-tms-therapy-in-minneapolis/'
                            ),
                        ],
                    ],


                    [
                        'title' => 'Spravato',

                        'link' => [
                            'url' => home_url(
                                '/spravato/'
                            ),
                        ],
                    ],


                    [
                        'title' => 'Medication Management',

                        'link' => [
                            'url' => home_url(
                                '/medication-management/'
                            ),
                        ],
                    ],

                ];

            }

            ?>


            <!-- HOME CARD -->

            <div class="pillar-sidebar__inner service-nav-card">

                <h3 class="pillar-sidebar__title">
                    Home
                </h3>


                <ul class="pillar-sidebar__list">


                    <?php foreach ($related_services as $related) : ?>


                        <?php

                        $service_title =
                            $related['title']
                            ?? '';

                        $service_url =
                            $related['link']['url']
                            ?? '#';


                        /*
                         * Highlight current service.
                         */

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
                                href="<?php echo esc_url($service_url); ?>"
                                class="<?php echo $is_current ? 'is-current' : ''; ?>"
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


        </aside>


    </div>


    <?php
    /*
     * Existing contact section from your theme.
     */
    get_template_part(
        'template-parts/contact/contact'
    );
    ?>


</section>



<?php

get_footer();

?>