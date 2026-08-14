<?php
/**
 * Homepage — About section
 *
 * Desktop presentation:
 * - Offset blue background block behind image
 * - Large image positioned above the block
 * - Story/content on the right
 *
 * Content pulled from the "Homepage Content" ACF options page.
 */

$heading = get_field('about_heading', 'option')
    ?: 'Pinnacle Behavioral Healthcare was founded by Dr. Olukayode Awosika in July 2011';

$body = get_field('about_body', 'option')
    ?: "Exceptional Care by Compassionate People. We are dedicated to providing the highest quality mental healthcare services. We offer a full range of psychiatric services, from medication management to treatment options for depression and ADHD diagnostic testing.";

$cta_text = get_field('about_cta_text', 'option')
    ?: 'Contact Us';

$cta_link = get_field('about_cta_link', 'option')
    ?: '#appointment';

$image = get_field('about_image', 'option');

$image_url = $image['url']
    ?? get_template_directory_uri() . '/assets/images/PinnacleBH2024-1-1-1-300x232-1.webp';

$image_alt = $image['alt']
    ?? 'Pinnacle Behavioral Healthcare clinic';
?>

<section id="about" class="about-section">

    <div class="about-section__inner">

        <!-- IMAGE -->
        <div class="about-section__visual">

            <div class="about-section__backdrop" aria-hidden="true"></div>

            <div class="about-section__image-wrap">
                <img
                    src="<?php echo esc_url($image_url); ?>"
                    alt="<?php echo esc_attr($image_alt); ?>"
                    class="about-section__image"
                    loading="lazy"
                >
            </div>

        </div>


        <!-- CONTENT -->
        <div class="about-section__content">

            <h2 class="about-section__heading">
                <?php echo esc_html($heading); ?>
            </h2>

            <p class="about-section__body">
                <?php echo esc_html($body); ?>
            </p>

            <a
                href="<?php echo esc_url($cta_link); ?>"
                class="about-section__cta"
            >
                <span>
                    <?php echo esc_html($cta_text); ?>
                </span>

                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    aria-hidden="true"
                >
                    <path
                        d="M3 11H19"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M13 5L19 11L13 17"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </a>

        </div>

    </div>

</section>