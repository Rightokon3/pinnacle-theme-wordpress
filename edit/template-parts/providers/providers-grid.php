<?php
/**
 * Providers page — grid of provider cards (photo, name, title, Read
 * More link) plus a closing "Book a Consultation" card. Content
 * pulled from the "Providers Page" ACF options page.
 *
 * Each provider photo falls back to a placeholder graphic — replace
 * per-provider via the ACF repeater in wp-admin.
 */

$providers = get_field('providers_list', 'option');

$placeholder1_photo = get_template_directory_uri() . '/assets/images/Headshot-Olukayode-Awosika-B.webp';
$placeholder2_photo = get_template_directory_uri() . '/assets/images/Dara-Awosika-1-2-1024x328.webp';
$placeholder3_photo = get_template_directory_uri() . '/assets/images/Derek-2.jpg';
$placeholder4_photo = get_template_directory_uri() . '/assets/images/Mask-group-4-1.webp';
$placeholder5_photo = get_template_directory_uri() . '/assets/images/Mask-group-5.webp';
$placeholder6_photo = get_template_directory_uri() . '/assets/images/Headshot-Mary-Guest-1536x1024.jpg';
$placeholder7_photo = get_template_directory_uri() . '/assets/images/1_1_1-e1722879349378.webp';
$placeholder8_photo = get_template_directory_uri() . '/assets/images/Dara-Awosika-1-2-1024x328 (1).png';
$placeholder9_photo = get_template_directory_uri() . '/assets/images/3_1-e1722879273384.webp';

if (empty($providers)) {
    $providers = [
        [
            'photo' => ['url' => $placeholder1_photo, 'alt' => 'Olukayode'],
            'name'  => 'Olukayode Awosika, MD',
            'title' => 'Psychiatrist',
            'link'  => ['url' => '#', 'title' => 'Read More'],
        ],
        [
            'photo' => ['url' => $placeholder2_photo, 'alt' => 'Dara'],
            'name'  => 'Tami Kittleson, APRN, CNP, PMHNP-BC​',
            'title' => 'Psychiatric Mental Health Nurse Practitioner',
            'link'  => ['url' => '#', 'title' => 'Read More'],
        ],
        [
            'photo' => ['url' => $placeholder3_photo, 'alt' => 'Derek'],
            'name'  => 'Derek Davis, PMHNP-BC',
            'title' => 'Psychiatric Mental Health Nurse Practitioner',
            'link'  => ['url' => '#', 'title' => 'Read More'],
        ],
             
        [
            'photo' => ['url' => $placeholder4_photo, 'alt' => 'Funsho'],
            'name'  => 'Funsho King, APRN, CNP, PMHNP-BC',
            'title' => 'Psychiatric Mental Health Nurse Practitioner',
            'link'  => ['url' => '#', 'title' => 'Read More'],
        ],
                     
        [
            'photo' => ['url' => $placeholder5_photo, 'alt' => 'Fatuma'],
            'name'  => 'Fatuma Guhad, APRN, CNP, PMHNP-BC',
            'title' => 'Psychiatric Mental Health Nurse Practitioner',
            'link'  => ['url' => '#', 'title' => 'Read More'],
        ],
             
        [
            'photo' => ['url' => $placeholder6_photo, 'alt' => 'Mary'],
            'name'  => 'Mary Guest, MSW, LICSW',
            'title' => 'Psychotherapist',
            'link'  => ['url' => '#', 'title' => 'Read More'],
        ],
              
        [
            'photo' => ['url' => $placeholder7_photo, 'alt' => 'John'],
            'name'  => 'Ebi Awosika, M.D., MPH, FACOEM',
            'title' => 'Clinic Director/Physician',
            'link'  => ['url' => '#', 'title' => 'Read More'],
        ],
        [
            'photo' => ['url' => $placeholder8_photo, 'alt' => 'Dara'],
            'name'  => 'Dara Awosika',
            'title' => 'Psychologist',
            'link'  => ['url' => '#', 'title' => 'Read More'],
        ],
    ];
}

$closing_photo   = get_field('providers_closing_photo', 'option');
$closing_photo_url = $closing_photo['url'] ?? $placeholder9_photo;
$closing_photo_alt = $closing_photo['alt'] ?? 'Team member headshot placeholder';
$closing_role     = get_field('providers_closing_role', 'option') ?: 'Clinic Operations Manager';
$closing_cta_link = get_field('providers_closing_cta_link', 'option') ?: home_url('/contact');
?>

<section class="providers-grid">
    <div class="providers-grid__inner">

        <?php foreach ($providers as $provider) :
            $photo     = $provider['photo'] ?? [];
            $photo_url = $photo['url'] ?? $placeholder1_photo;
            $photo_alt = $photo['alt'] ?? esc_attr($provider['name'] ?? 'Provider headshot placeholder');
            $link      = $provider['link'] ?? [];
            $link_url  = $link['url'] ?? '#';
            $link_text = $link['title'] ?? 'Read More';
            ?>
            <div class="provider-card">
                <a href="<?php echo esc_url($link_url); ?>" class="provider-card__photo-link">
                    <img
                        src="<?php echo esc_url($photo_url); ?>"
                        alt="<?php echo esc_attr($photo_alt); ?>"
                        class="provider-card__photo"
                        loading="lazy"
                    >
                </a>
                <h3 class="provider-card__name">
                    <a href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($provider['name'] ?? ''); ?></a>
                </h3>
                <p class="provider-card__title"><?php echo esc_html($provider['title'] ?? ''); ?></p>
                <a href="<?php echo esc_url($link_url); ?>" class="provider-card__cta">
                    <?php echo esc_html($link_text); ?>
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        <?php endforeach; ?>

        <!-- closing card: team member photo + booking CTA, matches the grid rhythm -->
        <div class="provider-card provider-card--closing">
            <div class="provider-card__photo-link">
                <img
                    src="<?php echo esc_url($closing_photo_url); ?>"
                    alt="<?php echo esc_attr($closing_photo_alt); ?>"
                    class="provider-card__photo"
                    loading="lazy"
                >
            </div>
            <p class="provider-card__title"><?php echo esc_html($closing_role); ?></p>
           

        </div>

    </div>
</section>