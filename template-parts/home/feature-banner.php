<?php
/**
 * Homepage — clickable promo banner (links through to the Services page
 * by default). Content pulled from the "Homepage Content" ACF options page.
 */

$banner_image = get_field('feature_banner_image', 'option');
$banner_image_url = $banner_image['url'] ?? get_template_directory_uri() . '/assets/images/feature-banner-promo.jpeg';
$banner_image_alt = $banner_image['alt'] ?? 'Featured advanced treatment technology';

$banner_link = get_field('feature_banner_link', 'option');
$banner_link_url = $banner_link['url'] ?? home_url('/services');
$banner_link_target = $banner_link['target'] ?? '_self';
?>

<section class="feature-banner">
    <a
        href="<?php echo esc_url($banner_link_url); ?>"
        class="feature-banner__link"
        <?php echo $banner_link_target === '_blank' ? 'target="_blank" rel="noopener"' : ''; ?>
    >
        <img
            src="<?php echo esc_url($banner_image_url); ?>"
            alt="<?php echo esc_attr($banner_image_alt); ?>"
            class="feature-banner__image"
            loading="lazy"
        >
    </a>
</section>