<?php
/**
 * Homepage — three-up feature icon row (years of experience, treatment
 * plans, facilities). Content pulled from the "Homepage Content" ACF
 * options page via a repeater; falls back to the original three items.
 */

$features = get_field('feature_icons', 'option');
if (empty($features)) {
    $features = [
        ['icon' => 'award', 'title' => '10+ Years Of Experience'],
        ['icon' => 'clipboard', 'title' => 'Individualized Treatment Plans'],
        ['icon' => 'home', 'title' => 'State-Of-The-Art Facilities'],
    ];
}

/**
 * Feather-style outline icons, inlined so the theme has no icon-font
 * dependency. Add a case here if a new icon choice is added to the
 * ACF select field below.
 */
function pinnacle_feature_icon(string $icon): string {
    $icons = [
        'award' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><path d="M8.21 13.89 7 23l5-3 5 3-1.21-9.12"/></svg>',
        'clipboard' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>',
        'home' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
    ];

    return $icons[$icon] ?? $icons['award'];
}
?>

<section class="feature-icons">
    <div class="feature-icons__grid">
        <?php foreach ($features as $feature) : ?>
            <div class="feature-icons__card">
                <span class="feature-icons__icon">
                    <?php echo pinnacle_feature_icon($feature['icon']); ?>
                </span>
                <p class="feature-icons__title"><?php echo esc_html($feature['title']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>