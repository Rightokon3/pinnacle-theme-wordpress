<?php
/**
 * Template Name: Contact Page
 * File: page-contact.php
 *
 * Heading/intro are ACF fields on this page ("Contact Page" group).
 * Address, phone, map coordinates, and social links all come from the
 * shared "Contact Section" group on Homepage Content (options page) —
 * that's the same source page-service-detail.php's map fallback
 * already reads from, so setting it once covers every page.
 *
 * Note: this form posts to itself for now, same as the sidebar
 * contact forms on the other templates. The live site uses Contact
 * Form 7 here — installing that plugin and swapping this block for
 * its shortcode is the easiest way to get it actually sending email.
 */

get_header();

$banner_image_url = get_template_directory_uri() . '/assets/images/back.webp';

$heading = get_field('contact_heading') ?: 'Schedule a Consultation';
$intro   = get_field('contact_intro');

$services = get_field('services_list', 'option'); // reuse the Services Page list for the dropdown

$business_name    = get_field('contact_map_business_name', 'option') ?: get_bloginfo('name');
$map_lat          = get_field('contact_map_lat', 'option') ?: 44.9778;
$map_lng          = get_field('contact_map_lng', 'option') ?: -93.265;
$address_lines    = get_field('contact_address_lines', 'option');
$phone_display    = get_field('contact_phone', 'option') ?: '(952) 303-6832';
$phone_link       = get_field('contact_phone_link', 'option') ?: '9523036832';
$facebook_url     = get_field('contact_facebook_url', 'option');
$instagram_url    = get_field('contact_instagram_url', 'option');
$twitter_url      = get_field('contact_twitter_url', 'option');
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

            <div class="contact-hero">
                <h2 class="contact-hero__heading"><?php echo esc_html($heading); ?></h2>
                <?php if ($intro) : ?>
                    <p class="contact-hero__intro"><?php echo esc_html($intro); ?></p>
                <?php endif; ?>
            </div>

            <form class="contact-form__form" method="post" action="">
                <label>
                    <span class="sr-only">Choose Service</span>
                    <select name="service" class="contact-form__select" required>
                        <option value="" disabled selected>Choose Service*</option>
                        <?php if (!empty($services)) : ?>
                            <?php foreach ($services as $service) : ?>
                                <option value="<?php echo esc_attr($service['title'] ?? ''); ?>"><?php echo esc_html($service['title'] ?? ''); ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="Medication Management">Medication Management</option>
                            <option value="Individual Psychotherapy">Individual Psychotherapy</option>
                            <option value="TMS Therapy">TMS Therapy</option>
                            <option value="Spravato">Spravato</option>
                            <option value="ADHD Testing">ADHD Testing</option>
                        <?php endif; ?>
                    </select>
                </label>

                <div class="contact-form__row">
                    <label>
                        <span class="sr-only">First Name</span>
                        <input type="text" name="first_name" class="contact-form__input" placeholder="First Name*" required>
                    </label>
                    <label>
                        <span class="sr-only">Last Name</span>
                        <input type="text" name="last_name" class="contact-form__input" placeholder="Last Name*" required>
                    </label>
                </div>

                <div class="contact-form__row">
                    <label>
                        <span class="sr-only">Phone Number</span>
                        <input type="tel" name="phone" class="contact-form__input" placeholder="Phone Number*" required>
                    </label>
                    <label>
                        <span class="sr-only">Email Address</span>
                        <input type="email" name="email" class="contact-form__input" placeholder="Email Address*" required>
                    </label>
                </div>

                <label>
                    <span class="sr-only">Message</span>
                    <textarea name="message" class="contact-form__input contact-form__textarea" rows="5" placeholder="Message*" required></textarea>
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

        <aside class="service-detail__sidebar">

            <?php
            // 1. Contact info card — address, phone, social links, all
            // from the shared "Contact Section" options fields.
            ?>
            <div class="pillar-sidebar__inner contact-info-card">
                <h3 class="pillar-sidebar__title">Contact Us</h3>

                <div class="contact-info-card__row">
                    <span class="contact-info-card__icon" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <div>
                        <?php if (!empty($address_lines)) : ?>
                            <?php foreach ($address_lines as $line) : ?>
                                <p class="contact-info-card__text"><?php echo esc_html($line['line'] ?? ''); ?></p>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="contact-info-card__text">6600 France Ave S</p>
                            <p class="contact-info-card__text">Suite 415</p>
                            <p class="contact-info-card__text">Edina, MN 55435</p>
                        <?php endif; ?>
                        <?php $directions = get_field('contact_map_directions_url', 'option') ?: 'https://www.google.com/maps/dir/?api=1&destination=' . urlencode($map_lat . ',' . $map_lng); ?>
                        <a href="<?php echo esc_url($directions); ?>" class="contact-info-card__directions" target="_blank" rel="noopener">Get Directions</a>
                    </div>
                </div>

                <div class="contact-info-card__row">
                    <span class="contact-info-card__icon" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </span>
                    <a href="tel:<?php echo esc_attr($phone_link); ?>" class="contact-info-card__phone"><?php echo esc_html($phone_display); ?></a>
                </div>

                <?php if ($facebook_url || $instagram_url || $twitter_url) : ?>
                    <div class="contact-social">
                        <?php if ($facebook_url) : ?>
                            <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ($instagram_url) : ?>
                            <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ($twitter_url) : ?>
                            <a href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener" aria-label="Twitter / X">
                                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.24 2H21l-6.5 7.43L22 22h-6.62l-5.18-6.77L4.24 22H1.46l7-8.01L2 2h6.75l4.68 6.2L18.24 2zm-1.16 18h1.83L7.02 4h-1.9l11.96 16z"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>


        </aside>

    </div>

    <?php
    // Map — full width, below the form/sidebar grid, same as the
    // live site (not squeezed into the sidebar card). Same
    // ".contact-map" partial the other templates use.
    get_template_part('template-parts/contact/contact', null, [
        'latitude'      => $map_lat,
        'longitude'     => $map_lng,
        'business_name' => $business_name,
        'address_lines' => $address_lines ?: [],
    ]);
    ?>
</section>

<?php get_footer(); ?>