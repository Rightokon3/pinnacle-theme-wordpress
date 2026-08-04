<?php
/**
 * Services page — top banner (full-width background image + overlay,
 * page title), breadcrumb, and "Share and Enjoy!" row. Content
 * pulled from the "Services Page" ACF options page.
 *
 * Deliberately reuses the same .providers-banner / .share-section
 * classes already in style.css — the banner design is identical
 * across Providers and Services on the live site, just different
 * copy/image, so there's no need for a second set of CSS rules.
 */

$page_title = get_field('services_page_title', 'option') ?: 'Our Services';

$banner_image = get_field('services_banner_image', 'option');
$banner_image_url = $banner_image['url'] ?? get_template_directory_uri() . '/assets/images/back.webp';
$banner_image_alt = $banner_image['alt'] ?? 'Pinnacle Behavioral Healthcare building exterior';
?>

<section
    class="providers-banner"
    style="background-image: url('<?php echo esc_url($banner_image_url); ?>');"
>
    <div class="providers-banner__overlay">
        <div class="providers-banner__inner">
            <h1 class="providers-banner__title"><?php echo esc_html($page_title); ?></h1>
        </div>
    </div>
</section>

<div class="providers-breadcrumb-container">
    <nav class="providers-banner__breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span aria-hidden="true">»</span>
        <span><?php echo esc_html($page_title); ?></span>
    </nav>
</div>

<div class="share-section">
    <h2 class="share-section__title">Share and Enjoy !</h2>
    <div class="share-section__buttons">
        <span class="share-section__label">SHARES</span>
        <a href="#" class="share-btn share-btn--facebook" aria-label="Share on Facebook">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.2c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/></svg>
        </a>
        <a href="#" class="share-btn share-btn--pinterest" aria-label="Share on Pinterest">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-3.6 19.3c0-.8 0-1.8.2-2.6l1.4-6s-.3-.7-.3-1.7c0-1.6.9-2.8 2.1-2.8 1 0 1.5.7 1.5 1.6 0 1-.6 2.4-.9 3.8-.3 1.1.6 2 1.7 2 2 0 3.5-2.1 3.5-5.2 0-2.7-2-4.6-4.8-4.6-3.2 0-5.2 2.4-5.2 5 0 1 .3 1.6.8 2.2.1.1.1.2 0 .3l-.3 1c0 .2-.2.2-.4.1-1.1-.5-1.6-1.9-1.6-3.4 0-2.6 2.2-5.6 6.4-5.6 3.4 0 5.7 2.5 5.7 5.1 0 3.5-1.9 6.1-4.8 6.1-1 0-1.9-.5-2.2-1.1l-.6 2.4c-.2.9-.7 1.9-1.1 2.6A10 10 0 1 0 12 2z"/></svg>
        </a>
        <a href="#" class="share-btn share-btn--pdf" aria-label="Download as PDF">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm8 9H8v1.5h6V11zm0 3H8v1.5h6V14z"/></svg>
        </a>
        <button type="button" class="share-btn share-btn--copy" aria-label="Copy link" data-copy-link>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.5.5l2-2a5 5 0 0 0-7-7l-1.5 1.5"/><path d="M14 11a5 5 0 0 0-7.5-.5l-2 2a5 5 0 0 0 7 7l1.5-1.5"/></svg>
        </button>
        <button type="button" class="share-btn share-btn--more" aria-label="More sharing options">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
        </button>
    </div>
</div>