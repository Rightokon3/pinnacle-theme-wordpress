<?php
/**
 * Contact page — banner strip + contact form / map grid.
 * Content pulled from the "Contact Page" ACF options page.
 */

$banner_heading  = get_field('contact_banner_heading', 'option') ?: 'Book a Consultation';
$banner_cta_text = get_field('contact_banner_cta_text', 'option') ?: 'Schedule Consultation';
$banner_cta_link = get_field('contact_banner_cta_link', 'option') ?: '#appointment';

$heading = get_field('contact_heading', 'option') ?: 'Contact Us';
$body    = get_field('contact_body', 'option') ?: "Ready to take the first step towards your mental health and wellness goals? Schedule a consultation with our team — we're here to help you find a plan that fits.";

$map_lat = get_field('contact_map_lat', 'option') ?: 44.9778;
$map_lng = get_field('contact_map_lng', 'option') ?: -93.265;
$map_business_name = get_field('contact_map_business_name', 'option') ?: 'Pinnacle Behavioral Healthcare';

$map_address_lines = get_field('contact_map_address_lines', 'option');
if (empty($map_address_lines)) {
    $map_address_lines = [
        ['line' => '500 Wellness Blvd, Suite 200'],
        ['line' => 'Minneapolis, MN 55401'],
    ];
}
?>

<section id="contact-us" class="contact">

    <!-- light blue banner strip -->
    <div class="contact__banner">
        <div class="contact__banner-inner">
            <h2 class="contact__banner-heading"><?php echo esc_html($banner_heading); ?></h2>
            <a href="<?php echo esc_url($banner_cta_link); ?>" class="contact__banner-cta">
                <?php echo esc_html($banner_cta_text); ?>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- contact form + map -->
    <div class="contact__grid">
        <div class="contact__form-col">
            <h2 class="contact__heading"><?php echo esc_html($heading); ?></h2>
            <p class="contact__body"><?php echo esc_html($body); ?></p>

            <?php get_template_part('template-parts/contact/contact-form'); ?>
        </div>

        <div class="contact__map-col">
            <?php get_template_part('template-parts/contact/contact-map', null, [
                'latitude'      => $map_lat,
                'longitude'     => $map_lng,
                'business_name' => $map_business_name,
                'address_lines' => $map_address_lines,
            ]); ?>
        </div>
    </div>
</section>