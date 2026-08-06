<?php
/**
 * Homepage — "About" section: founder photo + story + CTA.
 * Content pulled from the "Homepage Content" ACF options page.
 */

$heading = get_field('about_heading', 'option') ?: 'Pinnacle Behavioral Healthcare was founded by Dr. Olukayode Awosika in July 2011';
$body    = get_field('about_body', 'option') ?: "Exceptional Care by Compassionate People. We are dedicated to providing the highest quality mental healthcare services. We offer a full range of psychiatric services, from medication management to treatment options for depression and ADHD diagnostic testing.";
$cta_text = get_field('about_cta_text', 'option') ?: 'Contact Us';
$cta_link = get_field('about_cta_link', 'option') ?: '#appointment';

$image = get_field('about_image', 'option');
$image_url = $image['url'] ?? get_template_directory_uri() . '/assets/images/PinnacleBH2024-1-1-1-300x232-1.webp';
$image_alt = $image['alt'] ?? 'Practice founder in the clinic';
?>

<section id="about" class="about">
    <div class="about__grid">
        <img
            src="<?php echo esc_url($image_url); ?>"
            alt="<?php echo esc_attr($image_alt); ?>"
            class="about__image"
            loading="lazy"
        >

        <div class="about__content">
            <h2 class="about__heading"><?php echo esc_html($heading); ?></h2>
            <p class="about__body"><?php echo esc_html($body); ?></p>
            <a href="<?php echo esc_url($cta_link); ?>" class="about__cta">
                <?php echo esc_html($cta_text); ?>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>