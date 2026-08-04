<?php
/**
 * Homepage — "Why Choose Pinnacle" section: image + copy + CTA button.
 * Content pulled from the "Homepage Content" ACF options page.
 */

$heading = get_field('why_choose_heading', 'option') ?: 'Why Choose Pinnacle';
$body    = get_field('why_choose_body', 'option') ?: "Accurate diagnosis of mental health disorders can be difficult. We use advanced technology and evidence-based techniques to make sure every treatment plan starts with a precise understanding of each person's unique needs.";
$cta_text = get_field('why_choose_cta_text', 'option') ?: 'Schedule Consultation';
$cta_link = get_field('why_choose_cta_link', 'option') ?: '#appointment';

$image = get_field('why_choose_image', 'option');
$image_url = $image['url'] ?? get_template_directory_uri() . '/assets/images/why-choose-us.webp';
$image_alt = $image['alt'] ?? 'Consultation room';
?>

<section class="why-choose">
    <div class="why-choose__grid">
        <img
            src="<?php echo esc_url($image_url); ?>"
            alt="<?php echo esc_attr($image_alt); ?>"
            class="why-choose__image"
            loading="lazy"
        >

        <div class="why-choose__content">
            <h2 class="why-choose__heading"><?php echo esc_html($heading); ?></h2>
            <p class="why-choose__body"><?php echo esc_html($body); ?></p>
            <a href="<?php echo esc_url($cta_link); ?>" class="why-choose__cta">
                <?php echo esc_html($cta_text); ?>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>