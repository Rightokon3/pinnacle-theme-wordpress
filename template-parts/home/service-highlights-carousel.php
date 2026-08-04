<?php
/**
 * Homepage — auto-rotating "Our Services" tab carousel: a vertical list of
 * service tabs next to a large image panel that fades between services.
 * Content pulled from the "Homepage Content" ACF options page via a
 * repeater; falls back to the original five service highlights.
 *
 * The original React build used component state + setInterval to drive
 * rotation and pausing. assets/js/service-highlights-carousel.js
 * implements the same behavior in plain JS, following the same
 * data-attribute pattern as assets/js/testimonials.js.
 */

$heading = get_field('service_highlights_heading', 'option') ?: 'Our Services';

$highlights = get_field('service_highlights_list', 'option');
if (empty($highlights)) {
    $highlights = [
        [
            'label' => 'Medication Management',
            'description' => 'Our providers prescribe, monitor, and adjust medication in-person or through secure telehealth visits.',
            'telehealth' => true,
            'image' => ['url' => get_template_directory_uri() . '/assets/images/Image_fx-4.png'],
            'link' => ['url' => home_url('/contact'), 'title' => 'Learn More'],
        ],
        [
            'label' => 'Neurostar Advanced TMS Therapy',
            'description' => 'A non-invasive, FDA-approved option for depression, anxiety, and OCD using targeted magnetic stimulation.',
            'telehealth' => false,
            'image' => ['url' => get_template_directory_uri() . '/assets/images/Image_fx-1.png'],
            'link' => ['url' => home_url('/contact'), 'title' => 'Learn More'],
        ],
        [
            'label' => 'Individual Psychotherapy',
            'description' => 'One-on-one sessions built around your goals, in a private and supportive setting.',
            'telehealth' => true,
            'image' => ['url' => get_template_directory_uri() . '/assets/images/Image_fx-2.png'],
            'link' => ['url' => home_url('/contact'), 'title' => 'Learn More'],
        ],
        [
            'label' => 'Spravato Treatment',
            'description' => "A supervised, in-office option for adults with depression that hasn't responded to standard treatment.",
            'telehealth' => false,
            'image' => ['url' => get_template_directory_uri() . '/assets/images/Image_fx.png'],
            'link' => ['url' => home_url('/contact'), 'title' => 'Learn More'],
        ],
        [
            'label' => 'Qb Test For ADHD',
            'description' => 'A structured, computer-based evaluation that supports an accurate ADHD diagnosis in teens and adults.',
            'telehealth' => true,
            'image' => ['url' => get_template_directory_uri() . '/assets/images/PinnacleBH2024_1_-00101_1_1-1.webp'],
            'link' => ['url' => home_url('/contact'), 'title' => 'Learn More'],
        ],
    ];
}
?>

<section class="service-highlights" data-service-highlights data-autoplay-delay="4500">
    <h2 class="service-highlights__heading"><?php echo esc_html($heading); ?></h2>

    <div class="service-highlights__grid">
        <!-- vertical tab list -->
        <div
            role="tablist"
            aria-label="Service highlights"
            class="service-highlights__tabs"
            data-service-highlights-tabs
        >
            <?php foreach ($highlights as $i => $tab) : ?>
                <button
                    type="button"
                    role="tab"
                    aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                    class="service-highlights__tab<?php echo $i === 0 ? ' is-active' : ''; ?>"
                    data-service-highlights-tab
                    data-index="<?php echo (int) $i; ?>"
                >
                    <?php echo esc_html($tab['label']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- panels (all rendered; JS toggles which is visible) -->
        <div class="service-highlights__panels" data-service-highlights-panels>
            <?php foreach ($highlights as $i => $tab) :
                $image = $tab['image'] ?? null;
                $image_url = $image['url'] ?? get_template_directory_uri() . '/assets/images/service-highlight-placeholder.webp';
                $image_alt = $image['alt'] ?? $tab['label'];

                $link = $tab['link'] ?? null;
                $link_url = $link['url'] ?? home_url('/contact');
                $link_text = $link['title'] ?? 'Learn More';
                $link_target = $link['target'] ?? '_self';
            ?>
                <div
                    class="service-highlights__panel<?php echo $i === 0 ? ' is-active' : ''; ?>"
                    data-service-highlights-panel
                    data-index="<?php echo (int) $i; ?>"
                >
                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        class="service-highlights__image"
                        loading="lazy"
                    >
                    <div class="service-highlights__scrim"></div>

                    <div class="service-highlights__content">
                        <?php if (!empty($tab['telehealth'])) : ?>
                            <span class="service-highlights__badge">Telehealth Services Available</span>
                        <?php endif; ?>
                        <h3 class="service-highlights__title"><?php echo esc_html($tab['label']); ?></h3>
                        <p class="service-highlights__description"><?php echo esc_html($tab['description']); ?></p>
                        <a
                            href="<?php echo esc_url($link_url); ?>"
                            class="service-highlights__cta"
                            <?php echo $link_target === '_blank' ? 'target="_blank" rel="noopener"' : ''; ?>
                        >
                            <?php echo esc_html($link_text); ?>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>