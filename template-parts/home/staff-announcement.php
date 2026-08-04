<?php
/**
 * Homepage — staff announcement banner (sits right under the hero
 * appointment card). Content pulled from the "Homepage Content" ACF
 * options page.
 */

$eyebrow    = get_field('staff_eyebrow', 'option') ?: 'Welcome our New Psychotherapist';
$staff_name = get_field('staff_name', 'option') ?: 'Dara Awosika';
$staff_credentials = get_field('staff_credentials', 'option') ?: 'BSW , MSW , LICSW';
$staff_photo = get_field('staff_photo', 'option');
$staff_photo_url = $staff_photo['url'] ?? get_template_directory_uri() . '/assets/images/staff-amara-bello.png';
$staff_photo_alt = $staff_photo['alt'] ?? ('Portrait of ' . $staff_name);
?>

<section class="staff-announcement">
    <div class="staff-announcement__inner">
        <div class="staff-announcement__card">
            <p class="staff-announcement__eyebrow"><?php echo esc_html($eyebrow); ?></p>
            <p class="staff-announcement__name"><?php echo esc_html($staff_name); ?></p>
            <p class="staff-announcement__credentials"><?php echo esc_html($staff_credentials); ?></p>
        </div>

        <img
            src="<?php echo esc_url($staff_photo_url); ?>"
            alt="<?php echo esc_attr($staff_photo_alt); ?>"
            class="staff-announcement__photo"
            loading="lazy"
        >
    </div>
</section>