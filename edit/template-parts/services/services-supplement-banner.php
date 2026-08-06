<?php
/**
 * Services page — supplement/dispensary promo banner. Two-column:
 * product image on one side, heading/body/CTA on the other. Content
 * pulled from the "Services Page" ACF options page.
 */

$image = get_field('services_supplement_image', 'option');
$image_url = $image['url'] ?? get_template_directory_uri() . '/assets/images/Mask-group-2-1.webp';
$image_alt = $image['alt'] ?? 'Supplement products placeholder';

$heading = get_field('services_supplement_heading', 'option') ?: 'The Best Quality Supplement Brands Available';
$body    = get_field('services_supplement_body', 'option') ?: 'We only sell top quality supplements from reputable brands, formulated to support your overall wellness plan.';

$cta_text = get_field('services_supplement_cta_text', 'option') ?: 'Shop Now';
$cta_link = get_field('services_supplement_cta_link', 'option') ?: home_url('/dispensary');
?>

<section class="supplement-banner">
    <div class="supplement-banner__inner">
        <div class="supplement-banner__media">
            <img
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo esc_attr($image_alt); ?>"
                class="supplement-banner__image"
                loading="lazy"
            >
        </div>
        <div class="supplement-banner__content">
            <h2 class="supplement-banner__heading"><?php echo esc_html($heading); ?></h2>
            <p class="supplement-banner__body"><?php echo esc_html($body); ?></p>
            <a href="<?php echo esc_url($cta_link); ?>" class="supplement-banner__cta">
                <?php echo esc_html($cta_text); ?>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>