<?php
/**
 * Homepage — clickable promo banner (links through to the Services page
 * by default). Content pulled from the "Homepage Content" ACF options page.
 *
 * Uses <picture> for art direction: the banner's subtext is baked into the
 * image itself, so a single scaled-down image becomes illegible on small
 * screens. The mobile source should be a separately designed crop with
 * larger, simplified text — not just a resized version of the desktop image.
 */

$banner_image = get_field('feature_banner_image', 'option');
$banner_image_url = $banner_image['url'] ?? get_template_directory_uri() . '/assets/images/feature-banner-promo.jpeg';
$banner_image_alt = $banner_image['alt'] ?? 'Featured advanced treatment technology';

$banner_image_mobile = get_field('feature_banner_image_mobile', 'option');
$banner_image_mobile_url = $banner_image_mobile['url'] ?? get_template_directory_uri() . '/assets/images/feature-banner-promo-mobile.jpeg';

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
    
<picture>
    <?php if (!empty($banner_image_mobile['url'])) : ?>
        <source media="(max-width: 639px)" srcset="<?php echo esc_url($banner_image_mobile['url']); ?>">
    <?php endif; ?>
    <img
        src="<?php echo esc_url($banner_image_url); ?>"
        alt="<?php echo esc_attr($banner_image_alt); ?>"
        class="feature-banner__image"
        loading="lazy"
    >
</picture>
    </a>
</section>