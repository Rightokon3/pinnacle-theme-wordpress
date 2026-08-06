<?php
/**
 * Homepage — "What We Offer" services section: sticky image column +
 * scrolling list of services on the primary-blue background.
 * Content pulled from the "Homepage Content" ACF options page via a
 * repeater; falls back to the original five services.
 */

$heading = get_field('services_heading', 'option') ?: 'What We Offer';

$image = get_field('services_image', 'option');
$image_url = $image['url'] ?? get_template_directory_uri() . '/assets/images/services-side.png';
$image_alt = $image['alt'] ?? 'Patient in a calm home setting';

$services = get_field('services_list', 'option');
if (empty($services)) {
    $services = [
        [
            'icon' => 'pill',
            'title' => 'Medication Management',
            'description' => "In-person visits and secure telehealth appointments with providers who can prescribe medication, track your progress, and adjust your plan whenever it's needed.",
        ],
        [
            'icon' => 'heart',
            'title' => 'Individual Psychotherapy',
            'description' => "A private, supportive space to work through what's on your mind, with a therapist who builds the plan around your goals rather than a one-size-fits-all script.",
        ],
        [
            'icon' => 'zap',
            'title' => 'Advanced TMS Therapy',
            'description' => 'A non-invasive, FDA-approved option for depression, anxiety, and OCD that uses magnetic pulses to stimulate targeted brain activity, with minimal downtime.',
        ],
        [
            'icon' => 'target',
            'title' => 'Spravato Treatment',
            'description' => "A supervised in-office treatment option for adults with depression that hasn't responded to standard medication approaches.",
        ],
        [
            'icon' => 'check',
            'title' => 'ADHD Assessment',
            'description' => 'A structured, computer-based evaluation that measures attention and activity levels to support an accurate ADHD diagnosis in teens and adults.',
        ],
    ];
}

/**
 * Feather-style outline icons, inlined so the theme has no icon-font
 * dependency. Add a case here if a new icon choice is added to the
 * ACF select field below.
 */
function pinnacle_service_icon(string $icon): string {
    $icons = [
        'pill' => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
        'heart' => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.8 1-1a5.5 5.5 0 0 0 0-7.6z"/></svg>',
        'zap' => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
        'target' => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
        'check' => '<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><polyline points="9 12 11 14 16 9"/></svg>',
    ];

    return $icons[$icon] ?? $icons['pill'];
}
?>

<section id="services" class="services">
    <div class="services__media">
        <div class="services__media-inner">
            <img
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo esc_attr($image_alt); ?>"
                class="services__image"
                loading="lazy"
            >
        </div>
    </div>

    <div class="services__content">
        <h2 class="services__heading"><?php echo esc_html($heading); ?></h2>

        <div class="services__list">
            <?php foreach ($services as $service) : ?>
                <div id="<?php echo esc_attr(sanitize_title($service['title'])); ?>" class="services__item">
                    <span class="services__icon"><?php echo pinnacle_service_icon($service['icon']); ?></span>
                    <h3 class="services__item-title"><?php echo esc_html($service['title']); ?></h3>
                    <p class="services__item-description"><?php echo esc_html($service['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>