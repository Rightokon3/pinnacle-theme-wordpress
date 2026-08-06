<?php
/**
 * Providers page — top banner (page title + breadcrumb),
 * social share section, and the intro paragraph above the grid.
 * Content pulled from the "Providers Page" ACF options page.
 */

$page_title = get_field('providers_page_title', 'option') ?: 'Our Providers';

$intro_heading = get_field('providers_intro_heading', 'option') ?: '';
$intro_body    = get_field('providers_intro_body', 'option') ?: 'At Pinnacle, our providers for mental health are passionate about helping individuals explore lifestyle changes that can improve health and well-being. We specialize in tailor-made and integrative treatment plans that meet each client’s unique needs. Our holistic perspective guides our practice style. Our dedicated providers act as compassionate, expert guides on your unique path to mental wellness';

// Update this path to your exact banner image inside assets/images/
$banner_image_url = get_template_directory_uri() . '/assets/images/back.webp';
?>

<section class="providers-banner" style="background-image: linear-gradient(90deg, #ffffff 0%, rgba(255, 255, 255, 0.85) 35%, rgba(255, 255, 255, 0) 65%), url('<?php echo esc_url($banner_image_url); ?>');">
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

<section class="share-section">
    <div class="share-section__inner">
        <h2 class="share-section__title">Share and Enjoy !</h2>
        <div class="share-section__buttons">
            <span class="share-section__label">SHARES</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="share-btn share-btn--facebook" aria-label="Share on Facebook">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="share-btn share-btn--pinterest" aria-label="Share on Pinterest">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>
            </a>
            <a href="javascript:window.print()" class="share-btn share-btn--pdf" aria-label="Print or Save PDF">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-4 11H9v-5h6v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H7v4h10V3z"/></svg>
            </a>
            <button class="share-btn share-btn--copy" onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied to clipboard!');" aria-label="Copy link">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg>
            </button>
            <button class="share-btn share-btn--more" aria-label="More share options">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
            </button>
        </div>
    </div>
</section>

<section class="providers-intro">
    <div class="providers-intro__inner">
        <?php if ($intro_heading) : ?>
            <h2 class="providers-intro__heading"><?php echo esc_html($intro_heading); ?></h2>
        <?php endif; ?>
        <p class="providers-intro__body"><?php echo esc_html($intro_body); ?></p>
    </div>
</section>