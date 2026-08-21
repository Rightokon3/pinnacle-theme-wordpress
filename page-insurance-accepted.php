<?php
/**
 * Template Name: Insurance Accepted
 *
 * Pinnacle Behavioral Healthcare
 * Public Insurance Accepted page.
 *
 * Insurance companies are managed from:
 * WordPress Admin → Insurance Providers
 *
 * Each provider is an individual "insurance_provider" post
 * with ACF fields:
 * - insurance_logo
 * - insurance_medication
 * - insurance_tms
 * - insurance_spravato
 * - insurance_order
 */

get_header();

/*
 * =========================================================
 * PAGE CONTENT
 * =========================================================
 */

$hero_title = 'Mental Health & Psychiatry Insurance Accepted | Edina, MN';

$share_heading = 'Share and Enjoy !';

$eyebrow = 'Mental Health Care That Fits Your Network';

$intro_heading =
    'We eliminate the guesswork from insurance verification so you can focus purely on recovery.';

$intro_body =
    'We eliminate the guesswork from insurance verification so you can focus purely on recovery. At Pinnacle Behavioral Healthcare, we believe that advanced, life-changing psychiatric treatments should be accessible. We are in-network with the vast majority of major commercial insurance plans, regional provider networks, and Medicare in Minnesota. Our dedicated clinical intake team handles the entire prior-authorization process on your behalf for specialized protocols like Spravato nasal spray and NeuroStar TMS therapy.';

$providers_heading = 'In-Network Insurance Providers';

$providers_intro =
    'Below is the structured list of insurance carriers currently accepted at our Edina clinic.';

/*
 * =========================================================
 * HERO IMAGE
 * =========================================================
 */

$hero_image_url =
    get_template_directory_uri() . '/assets/images/back.webp';


/*
 * =========================================================
 * INSURANCE PROVIDERS
 * =========================================================
 *
 * These are pulled from the Insurance Providers custom
 * post type created in functions.php.
 */

$insurance_query = new WP_Query(
    array(
        'post_type'      => 'insurance_provider',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => 'insurance_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
    )
);


/*
 * =========================================================
 * CTA
 * =========================================================
 */

$cta_heading = 'Book a Consultation';

$cta_button_text = 'Schedule Consultation';

$cta_button_link = home_url('/contact/');

?>

<main class="insurance-page">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section
        class="insurance-hero"
        style="background-image:url('<?php echo esc_url($hero_image_url); ?>');"
    >

        <div class="insurance-hero__overlay"></div>

        <div class="insurance-container insurance-hero__inner">

            <h1 class="insurance-hero__title">
                <?php echo esc_html($hero_title); ?>
            </h1>

        </div>

    </section>


    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

    <section class="insurance-content">

        <div class="insurance-container">

            <!-- =================================================
                 SHARE
            ================================================== -->

            <div class="insurance-share">

                <h2 class="insurance-share__title">
                    <?php echo esc_html($share_heading); ?>
                </h2>

                <div class="insurance-share__buttons">

                    <span class="insurance-share__label">
                        ↗
                        <small>SHARES</small>
                    </span>


                    <!-- Facebook -->

                    <a
                        href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode(get_permalink()); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Share on Facebook"
                        class="insurance-share__button insurance-share__button--facebook"
                    >
                        f
                    </a>


                    <!-- Pinterest -->

                    <a
                        href="https://pinterest.com/pin/create/button/?url=<?php echo rawurlencode(get_permalink()); ?>&description=<?php echo rawurlencode($hero_title); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Share on Pinterest"
                        class="insurance-share__button insurance-share__button--pinterest"
                    >
                        p
                    </a>


                    <!-- Print -->

                    <button
                        type="button"
                        aria-label="Print page"
                        class="insurance-share__button insurance-share__button--pdf"
                        onclick="window.print();"
                    >
                        PDF
                    </button>


                    <!-- Copy -->

                    <button
                        type="button"
                        aria-label="Copy page link"
                        class="insurance-share__button insurance-share__button--copy"
                        onclick="
                            if (navigator.clipboard) {
                                navigator.clipboard.writeText(window.location.href);
                            }
                        "
                    >
                        ↗
                    </button>


                    <!-- More -->

                    <button
                        type="button"
                        aria-label="More sharing options"
                        class="insurance-share__button insurance-share__button--more"
                        onclick="
                            if (navigator.share) {
                                navigator.share({
                                    title: document.title,
                                    url: window.location.href
                                });
                            } else if (navigator.clipboard) {
                                navigator.clipboard.writeText(window.location.href);
                            }
                        "
                    >
                        +
                    </button>

                </div>

            </div>


            <!-- =================================================
                 INTRO
            ================================================== -->

            <div class="insurance-copy">

                <p class="insurance-copy__eyebrow">
                    <?php echo esc_html($eyebrow); ?>
                </p>

                <h2 class="insurance-copy__title">
                    <?php echo esc_html($intro_heading); ?>
                </h2>

                <div class="insurance-copy__body">

                    <?php
                    echo wp_kses_post(
                        wpautop($intro_body)
                    );
                    ?>

                </div>

            </div>


            <!-- =================================================
                 INSURANCE PROVIDERS
            ================================================== -->

            <section
                class="insurance-providers"
                aria-labelledby="insurance-providers-heading"
            >

                <h2
                    id="insurance-providers-heading"
                    class="insurance-providers__title"
                >
                    <?php echo esc_html($providers_heading); ?>
                </h2>


                <div class="insurance-providers__intro">

                    <?php
                    echo wp_kses_post(
                        wpautop($providers_intro)
                    );
                    ?>

                </div>


<?php if ( ! empty( $insurance_query->posts ) ) : ?>

    <div class="insurance-grid">

        <?php foreach ( $insurance_query->posts as $provider ) : ?>

            <?php
            $logo = get_field(
                'insurance_logo',
                $provider->ID
            );

            $logo_url = '';

            $logo_alt = get_the_title(
                $provider->ID
            );

            if ( is_array( $logo ) ) {

                $logo_url = $logo['url'] ?? '';

                if ( ! empty( $logo['alt'] ) ) {
                    $logo_alt = $logo['alt'];
                }

            } elseif ( is_numeric( $logo ) ) {

                $logo_url = wp_get_attachment_image_url(
                    (int) $logo,
                    'medium'
                );

            } elseif ( is_string( $logo ) ) {

                $logo_url = $logo;

            }
            ?>

            <?php if ( $logo_url ) : ?>

                <article class="insurance-card insurance-card--logo-only">

                    <div class="insurance-card__logo-wrap">

                        <img
                            class="insurance-card__logo"
                            src="<?php echo esc_url( $logo_url ); ?>"
                            alt="<?php echo esc_attr( $logo_alt ); ?>"
                            loading="lazy"
                        >

                    </div>

                </article>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>

<?php else : ?>

    <div class="insurance-empty">
        <p>No insurance provider logos have been added yet.</p>
    </div>

<?php endif; ?>



            </section>

        </div>

    </section>


    <!-- =====================================================
         CONSULTATION CTA
    ====================================================== -->

    <section class="insurance-cta">

        <div class="insurance-container insurance-cta__inner">

            <h2 class="insurance-cta__title">
                <?php echo esc_html($cta_heading); ?>
            </h2>

            <a
                href="<?php echo esc_url($cta_button_link); ?>"
                class="insurance-cta__button"
            >

                <span>
                    <?php echo esc_html($cta_button_text); ?>
                </span>

                <span aria-hidden="true">
                    →
                </span>

            </a>

        </div>

    </section>


    <!-- =====================================================
         CONTACT
    ====================================================== -->

    <?php
    get_template_part(
        'template-parts/contact/contact'
    );
    ?>

</main>


<?php get_footer(); ?>