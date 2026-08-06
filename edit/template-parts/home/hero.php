<?php
/**
 * Homepage — Hero section + appointment booking card.
 * Content pulled from the "Homepage Content" ACF options page so the
 * client can edit it from wp-admin without touching this file.
 */

$hero_headline = get_field('hero_headline', 'option') ?: 'Mental Healthcare, Personalized For You';
$hero_subtitle = get_field('hero_subtitle', 'option') ?: 'Providing cutting-edge mental health treatment plans and psychiatric services for patients of every age.';
$hero_image    = get_field('hero_image', 'option');
$hero_image_url = $hero_image['url'] ?? get_template_directory_uri() . '/assets/images/hero-consultation.webp';
$hero_image_alt = $hero_image['alt'] ?? 'Therapist and patient in a calm consultation session';

$appointment_title = get_field('appointment_form_title', 'option') ?: 'Book a Consultation';
$services = get_field('appointment_form_services', 'option');
if (empty($services)) {
    $services = [
        ['service_name' => 'Individual Psychotherapy'],
        ['service_name' => 'Medication Management'],
        ['service_name' => 'TMS Therapy'],
        ['service_name' => 'Spravato Treatment'],
        ['service_name' => 'ADHD Assessment'],
    ];
}
?>

<section id="home" class="hero">
    <div class="hero__media">
        <img
            src="<?php echo esc_url($hero_image_url); ?>"
            alt="<?php echo esc_attr($hero_image_alt); ?>"
            class="hero__image"
            loading="eager"
        >
        <div class="hero__scrim"></div>

        <div class="hero__content-wrap">
            <div class="hero__content">
                <h1 class="hero__title"><?php echo esc_html($hero_headline); ?></h1>
                <p class="hero__subtitle"><?php echo esc_html($hero_subtitle); ?></p>
            </div>
        </div>
    </div>

    <div class="hero__form-wrap">
        <?php get_template_part('template-parts/home/appointment-form', null, [
            'title'    => $appointment_title,
            'services' => $services,
        ]); ?>
    </div>
</section>