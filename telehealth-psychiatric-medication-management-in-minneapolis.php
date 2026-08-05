<?php
/**
 * Template Name: Service Detail
 *
 * Reusable page template for individual service pages (Medication
 * Management, TMS Treatments, Spravato, etc.) — create a new Page in
 * wp-admin, assign this template, and fill in the fields below.
 *
 * Layout: banner + breadcrumb, share row, two-column body (rich-text
 * content + optional requirements list on the left, appointment form
 * + related services + quick contact card on the right).
 */

get_header();

$banner_image = get_field('service_banner_image');
$banner_image_url = $banner_image['url'] ?? get_template_directory_uri() . '/assets/images/back.webp';
$banner_image_alt = $banner_image['alt'] ?? get_the_title();

$intro_content = get_field('service_intro_content'); // WYSIWYG — paragraphs, in the client's own words
$requirements  = get_field('service_requirements');   // repeater: item text
$cta_text = get_field('service_cta_text') ?: 'Schedule Consultation';
$cta_link = get_field('service_cta_link') ?: home_url('/contact/');
?>

<section class="providers-banner" style="background-image:url('<?php echo esc_url($banner_image_url); ?>');">
    <div class="providers-banner__overlay">
        <div class="providers-banner__inner">
            <h1 class="providers-banner__title">Telehealth Psychiatric Medication Management in Minneapolis</h1>
        </div>
    </div>
</section>

<div class="providers-breadcrumb-container">
    <p class="providers-banner__breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span aria-hidden="true">&raquo;</span>
        <span>Telehealth Psychiatric Medication Management in Minneapolis</span>
    </p>
</div>

<section class="share-section">
    <h2 class="share-section__title">Share and Enjoy!</h2>
    <div class="share-section__buttons">
        <span class="share-section__label">SHARE</span>
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
    </div>
</section>

<section class="service-detail">
    <div class="service-detail__grid">

        <div class="service-detail__main">
            <?php if ($intro_content) : ?>
                <div class="service-detail__content">
                    <?php echo wp_kses_post($intro_content); ?>
                </div>
            <?php else : ?>
                <div class="service-detail__content">
                    <p>
                       <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #0073aa; text-decoration: none;">Pinnacle Behavioral Healthcare</a> is proud to offer mental Telehealth Psychiatric Medication Management in addition to in-person, face-to-face visits at our Edina clinic in Edina. This allows you the option of meeting with your provider in the clinic or from the comfort of your own home or office using a computer, tablet, or smartphone.

           Telehealth Psychiatric Medication Management is a convenient and effective way to receive psychiatric medication management services. You will be able to meet with your provider on a regular basis, without having to travel to our office.

        We offer comprehensive mental telehealth evaluations to determine the best course of treatment, which may or may not include medication. Our providers for mental health work with you to find the right medication at the right dose to help improve your symptoms. We understand that each person is unique and will respond differently to various medications. We will work with you to find the best medication for you, taking into account your individual needs and preferences.

         In order to participate in Telehealth Psychiatric Medication Management, you will need:

       <li>A computer, tablet, or smartphone with a webcam and microphone</li>
       <li>A high-speed internet connection</li>
                    </p>
                </div>
            <?php endif; ?>

            <?php if (!empty($requirements)) : ?>
                <div class="service-detail__requirements">
                    <h2>What You'll Need</h2>
                    <ul>
                        <?php foreach ($requirements as $req) : ?>
                            <li><?php echo esc_html($req['item'] ?? ''); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <aside class="service-detail__sidebar">

            <?php
            // "Home" services nav card — same list on every service page,
            // current page highlighted. Uses the shared Services Page
            // options (services-page > services_list) so it only needs
            // editing in one place.
            $related_services = get_field('services_list', 'option');
            if (!empty($related_services)) :
            ?>
                <div class="service-nav-card">
                    <h3 class="service-nav-card__heading">Home</h3>
                    <ul class="service-nav-card__list">
                        <?php foreach ($related_services as $related) :
                            $is_current = isset($related['title']) && $related['title'] === get_the_title();
                        ?>
                            <li>
                                <a href="<?php echo esc_url($related['link']['url'] ?? '#'); ?>" class="<?php echo $is_current ? 'is-current' : ''; ?>">
                                    <span><?php echo esc_html($related['title'] ?? ''); ?></span>
                                    <svg class="service-nav-card__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
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
            /**
             * Contact form card.
             * TODO: this markup posts to itself for now — wire up real
             * handling before launch (e.g. a plugin like WPForms/Contact
             * Form 7, or a custom admin-post.php action that emails the
             * clinic and redirects back with a success message).
             */
            ?>
            <div class="service-contact-card">
                <h3 class="service-contact-card__heading">Contact Us</h3>
                <form class="contact-form__form" method="post" action="">
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

        </aside>

    </div>
</section>

<?php get_footer(); ?>