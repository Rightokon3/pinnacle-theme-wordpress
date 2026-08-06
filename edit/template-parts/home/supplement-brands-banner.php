<?php
/**
 * Homepage / Dispensary — "Best Quality Supplement Brands" promo banner.
 * Content pulled from the "Homepage Content" ACF options page.
 */

$heading = get_field('supplement_banner_heading', 'option') ?: 'The Best Quality Supplement Brands Available';
$body    = get_field('supplement_banner_body', 'option') ?: "We only carry supplements from reputable, quality-tested brands. Every product is chosen to support real results, so you can trust what you're adding to your care plan.";
$cta_text = get_field('supplement_banner_cta_text', 'option') ?: 'Shop Now';
$cta_link = get_field('supplement_banner_cta_link', 'option') ?: '#products';

$image = get_field('supplement_banner_image', 'option');
$image_url = $image['url'] ?? get_template_directory_uri() . '/assets/images/Mask-group-2-1.webp';
$image_alt = $image['alt'] ?? 'Featured supplement products';
?>

<section class="supplement-banner">
    <div class="supplement-banner__grid">
        <div class="supplement-banner__media">
            <div class="supplement-banner__accent" aria-hidden="true"></div>
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