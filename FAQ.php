<?php
/**
 * Template Name: FAQ Page
 * File: page-faq.php
 *
 * Standalone FAQ page — same banner / share-section / sidebar shell as
 * page-service-detail.php (so the two look like one design system),
 * but the main column is an accordion of Q&A pairs instead of service
 * content blocks. Everything is editable from wp-admin via the "FAQ
 * Page" ACF field group in functions.php: create a Page, assign this
 * template, fill in the fields.
 *
 * The accordion reuses the ".pillar-faq" component already in
 * style.css; assets/js/faq-accordion.js (enqueued in functions.php)
 * handles the open/close toggle — no new CSS needed.
 */

get_header();

$banner_image = get_field('faq_banner_image');
$banner_image_url = $banner_image['url'] ?? get_template_directory_uri() . '/assets/images/back.webp';

$faq_heading = get_field('faq_heading') ?: 'Frequently Asked Questions';
$faq_intro   = get_field('faq_intro');
$faq_items   = get_field('faq_items');

$cta_text = get_field('faq_cta_text') ?: 'Schedule Consultation';
$cta_link = get_field('faq_cta_link') ?: home_url('/contact/');
?>

<section class="providers-banner" style="background-image:url('<?php echo esc_url($banner_image_url); ?>');">
    <div class="providers-banner__overlay">
        <div class="providers-banner__inner">
            <h1 class="providers-banner__title"><?php echo esc_html(get_the_title()); ?></h1>
        </div>
    </div>
</section>

<div class="providers-breadcrumb-container">
    <p class="providers-banner__breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span aria-hidden="true">&raquo;</span>
        <span><?php echo esc_html(get_the_title()); ?></span>
    </p>
</div>

<section class="share-section">
    <h2 class="share-section__title">Share and Enjoy !</h2>
    <div class="share-section__buttons">
        <span class="share-section__label">SHARES</span>
        <a class="share-btn share-btn--facebook" href="https://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>" aria-label="Share on Facebook" target="_blank" rel="noopener">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/></svg>
        </a>
        <a class="share-btn share-btn--pinterest" href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" aria-label="Share on Pinterest" target="_blank" rel="noopener">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.5 2 2 6.5 2 12c0 4.2 2.6 7.8 6.3 9.3-.1-.8-.2-2 0-2.9l1.4-6s-.4-.7-.4-1.8c0-1.7 1-2.9 2.2-2.9 1 0 1.5.8 1.5 1.7 0 1-.7 2.6-1 4-.3 1.2.6 2.2 1.8 2.2 2.1 0 3.7-2.3 3.7-5.5 0-2.9-2.1-4.9-5-4.9-3.4 0-5.5 2.6-5.5 5.2 0 1 .4 2.1.9 2.7.1.1.1.2.1.3-.1.4-.3 1.2-.3 1.4-.1.2-.2.3-.4.2-1.5-.7-2.4-2.9-2.4-4.6 0-3.8 2.7-7.2 7.9-7.2 4.1 0 7.4 3 7.4 6.9 0 4.1-2.6 7.4-6.2 7.4-1.2 0-2.4-.6-2.7-1.4l-.8 2.9c-.3 1-1 2.3-1.5 3.1 1.1.3 2.3.5 3.5.5 5.5 0 10-4.5 10-10S17.5 2 12 2z"/></svg>
        </a>
        <button type="button" class="share-btn share-btn--pdf" onclick="window.print()" aria-label="Print / Save as PDF">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9V2h9l5 5v2"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        </button>
        <button type="button" class="share-btn share-btn--copy" data-copy-link="<?php echo esc_url(get_permalink()); ?>" aria-label="Copy link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        </button>
        <button type="button" class="share-btn share-btn--more" aria-label="More sharing options">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </button>
    </div>
</section>

<section class="service-detail">
    <div class="service-detail__grid">

        <div class="service-detail__main">

            <div class="pillar-faq">
                <h2 class="pillar-faq__heading"><?php echo esc_html($faq_heading); ?></h2>

                <?php if ($faq_intro) : ?>
                    <p class="pillar-faq__intro"><?php echo esc_html($faq_intro); ?></p>
                <?php endif; ?>

                <?php if (!empty($faq_items)) : ?>
                    <div class="pillar-faq__list">
                        <?php foreach ($faq_items as $i => $faq) :
                            if (empty($faq['question'])) {
                                continue;
                            }
                        ?>
                            <div class="pillar-faq__item">
                                <button type="button" class="pillar-faq__question" aria-expanded="false" aria-controls="faq-answer-<?php echo esc_attr($i); ?>">
                                    <span><?php echo esc_html($faq['question']); ?></span>
                                    <span class="pillar-faq__toggle" aria-hidden="true">+</span>
                                </button>
                                <div class="pillar-faq__answer" id="faq-answer-<?php echo esc_attr($i); ?>">
                                    <?php echo wp_kses_post($faq['answer'] ?? ''); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p class="pillar-faq__intro">Questions will appear here once added in wp-admin under the "FAQ Page" fields — click "Add Question" for each one.</p>
                <?php endif; ?>
            </div>

        </div>

        <aside class="service-detail__sidebar">

            <?php
            // 1. Contact form card — same markup/classes as the Service
            // Detail template, so it needed no new styling.
            ?>
            <div class="pillar-sidebar__inner service-contact-card">
                <h3 class="pillar-sidebar__title">Contact Us</h3>
                <form class="contact-form__form" method="post" action="">
                    <label>
                        <span class="sr-only">First Name</span>
                        <input type="text" name="first_name" class="contact-form__input" placeholder="First Name*" required>
                    </label>
                    <label>
                        <span class="sr-only">Last Name</span>
                        <input type="text" name="last_name" class="contact-form__input" placeholder="Last Name*" required>
                    </label>
                    <label>
                        <span class="sr-only">Phone Number</span>
                        <input type="tel" name="phone" class="contact-form__input" placeholder="Phone Number*" required>
                    </label>
                    <label>
                        <span class="sr-only">Email Address</span>
                        <input type="email" name="email" class="contact-form__input" placeholder="Email Address*" required>
                    </label>
                    <label>
                        <span class="sr-only">Message</span>
                        <textarea name="message" class="contact-form__input contact-form__textarea" rows="4" placeholder="Message*" required></textarea>
                    </label>

                    <button type="submit" class="contact-form__submit">
                        Send Message
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                </form>
            </div>

            <?php
            // 2. "Home" services nav card — same shared Services Page
            // options as the Service Detail template.
            $related_services = get_field('services_list', 'option');
            if (!empty($related_services)) :
            ?>
                <div class="pillar-sidebar__inner service-nav-card">
                    <h3 class="pillar-sidebar__title">Home</h3>
                    <ul class="pillar-sidebar__list">
                        <?php foreach ($related_services as $related) : ?>
                            <li>
                                <a href="<?php echo esc_url($related['link']['url'] ?? '#'); ?>">
                                    <span><?php echo esc_html($related['title'] ?? ''); ?></span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                        <polyline points="12 5 19 12 12 19"/>
                                    </svg>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php
            // 3. "Book a Consultation" card — same as Service Detail.
            ?>
            <div class="pillar-sidebar__inner service-booking-card">
                <h3 class="pillar-sidebar__title">Book a Consultation</h3>
                <a href="<?php echo esc_url($cta_link); ?>" class="service-sidebar-card__cta"><?php echo esc_html($cta_text); ?></a>
            </div>

        </aside>

    </div>
    <?php get_template_part('template-parts/contact/contact'); ?>
</section>

<?php get_footer(); ?>