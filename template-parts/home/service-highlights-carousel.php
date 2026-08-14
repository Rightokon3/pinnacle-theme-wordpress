<?php
/**
 * Homepage — Services Highlights
 *
 * Desktop design:
 * - Vertical service navigation on the left
 * - Large changing image on the right
 * - Blue active service bar
 * - Image changes on hover/focus/click
 *
 * Content pulled from the "Homepage Content" ACF options page.
 * Falls back to the original five services.
 */

$highlights = get_field('service_highlights_list', 'option');

if (empty($highlights)) {
    $highlights = [
        [
            'label'       => 'Medication Management',
            'description' => 'Our providers prescribe, monitor, and adjust medication in-person or through secure telehealth visits.',
            'telehealth'  => true,
            'icon'        => 'medication',
            'image'       => [
                'url' => get_template_directory_uri() . '/assets/images/Image_fx-4.png'
            ],
            'link'        => [
                'url'   => home_url('/contact'),
                'title' => 'Learn More'
            ],
        ],

        [
            'label'       => 'Neurostar Advanced TMS Therapy',
            'description' => 'A non-invasive, FDA-approved option for depression, anxiety, and OCD using targeted magnetic stimulation.',
            'telehealth'  => false,
            'icon'        => 'tms',
            'image'       => [
                'url' => get_template_directory_uri() . '/assets/images/Image_fx-1.png'
            ],
            'link'        => [
                'url'   => home_url('/contact'),
                'title' => 'Learn More'
            ],
        ],

        [
            'label'       => 'Individual Psychotherapy',
            'description' => 'One-on-one sessions built around your goals, in a private and supportive setting.',
            'telehealth'  => true,
            'icon'        => 'therapy',
            'image'       => [
                'url' => get_template_directory_uri() . '/assets/images/Image_fx-2.png'
            ],
            'link'        => [
                'url'   => home_url('/contact'),
                'title' => 'Learn More'
            ],
        ],

        [
            'label'       => 'Spravato Therapy',
            'description' => "A supervised, in-office option for adults with depression that hasn't responded to standard treatment.",
            'telehealth'  => false,
            'icon'        => 'spravato',
            'image'       => [
                'url' => get_template_directory_uri() . '/assets/images/Image_fx.png'
            ],
            'link'        => [
                'url'   => home_url('/contact'),
                'title' => 'Learn More'
            ],
        ],

        [
            'label'       => 'Qb Test For ADHD',
            'description' => 'A structured, computer-based evaluation that supports an accurate ADHD diagnosis in teens and adults.',
            'telehealth'  => true,
            'icon'        => 'adhd',
            'image'       => [
                'url' => get_template_directory_uri() . '/assets/images/PinnacleBH2024_1_-00101_1_1-1.webp'
            ],
            'link'        => [
                'url'   => home_url('/contact'),
                'title' => 'Learn More'
            ],
        ],
    ];
}


/**
 * SVG icons
 */
function pinnacle_highlight_icon($icon) {

    switch ($icon) {

        case 'medication':
            return '
                <svg viewBox="0 0 64 64" aria-hidden="true">
                    <rect x="18" y="18" width="28" height="38" rx="2"/>
                    <rect x="25" y="8" width="14" height="10" rx="2"/>
                    <path d="M25 29h14M32 22v14"/>
                    <path d="M28 29v8M36 29v8"/>
                    <path d="M12 25h6v22h-6z"/>
                    <path d="M12 31h6M15 28v6"/>
                    <circle cx="45" cy="25" r="3"/>
                    <circle cx="45" cy="34" r="3"/>
                    <circle cx="45" cy="43" r="3"/>
                </svg>
            ';

        case 'tms':
            return '
                <svg viewBox="0 0 80 40" aria-hidden="true" class="pinnacle-tms-icon">
                    <text x="2" y="30"
                        font-family="Arial, Helvetica, sans-serif"
                        font-size="30"
                        font-style="italic"
                        font-weight="700">
                        TMS
                    </text>
                </svg>
            ';

        case 'therapy':
            return '
                <svg viewBox="0 0 64 64" aria-hidden="true">
                    <circle cx="22" cy="16" r="6"/>
                    <circle cx="45" cy="16" r="6"/>
                    <path d="M22 23v17"/>
                    <path d="M45 23v17"/>
                    <path d="M22 30l-8 10"/>
                    <path d="M22 30l9 10"/>
                    <path d="M45 30l-9 10"/>
                    <path d="M45 30l8 10"/>
                    <path d="M14 50h17"/>
                    <path d="M36 50h17"/>
                    <path d="M25 14c7-10 17-10 24 0"/>
                    <path d="M37 9c3-5 9-5 13-1"/>
                </svg>
            ';

        case 'spravato':
            return '
                <svg viewBox="0 0 64 64" aria-hidden="true">
                    <path d="M12 45l24-24"/>
                    <path d="M20 53l24-24"/>
                    <path d="M11 45l8 8"/>
                    <path d="M36 21l8 8"/>
                    <path d="M39 18l7-7"/>
                    <path d="M45 11l4 4"/>
                    <path d="M49 8l4 4"/>
                    <path d="M14 46c-6 6-5 11 0 13 5 2 10-1 15-6"/>
                </svg>
            ';

        case 'adhd':
            return '
                <svg viewBox="0 0 64 64" aria-hidden="true">
                    <path d="M32 8c-11 0-20 9-20 20v10c0 10 9 18 20 18"/>
                    <path d="M32 8c11 0 20 9 20 20v10c0 10-9 18-20 18"/>
                    <circle cx="32" cy="32" r="12"/>
                    <circle cx="32" cy="32" r="5"/>
                    <path d="M32 20v-7M32 51v-7M20 32h-7M51 32h-7"/>
                    <path d="M23 23l-5-5M41 23l5-5M23 41l-5 5M41 41l5 5"/>
                </svg>
            ';

        default:
            return '
                <svg viewBox="0 0 64 64" aria-hidden="true">
                    <circle cx="32" cy="32" r="20"/>
                    <path d="M22 32h20M32 22v20"/>
                </svg>
            ';
    }
}
?>

<section
    class="service-highlights"
    data-service-highlights
    data-autoplay-delay="4500"
    aria-label="Our services"
>

    <div class="service-highlights__inner">

        <!-- LEFT SIDE -->
        <div
            class="service-highlights__list"
            role="tablist"
            aria-label="Services"
            data-service-highlights-tabs
        >

            <?php foreach ($highlights as $i => $service) :

                $label = $service['label'] ?? 'Service';

                $icon = $service['icon'] ?? '';

                $link = $service['link'] ?? [];

                $link_url = $link['url'] ?? home_url('/contact');

                $link_text = $link['title'] ?? 'Learn More';

            ?>

                <button
                    type="button"
                    class="service-highlights__item<?php echo $i === 0 ? ' is-active' : ''; ?>"
                    role="tab"
                    aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                    aria-controls="service-highlight-panel-<?php echo esc_attr($i); ?>"
                    data-service-highlights-tab
                    data-index="<?php echo esc_attr($i); ?>"
                >

                    <span class="service-highlights__icon">
                        <?php echo pinnacle_highlight_icon($icon); ?>
                    </span>

                    <span class="service-highlights__item-content">

                        <span class="service-highlights__item-title">
                            <?php echo esc_html($label); ?>
                        </span>

                        <span class="service-highlights__learn">
                            Learn More

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M4 12h15"/>
                                <path d="M13 5l7 7-7 7"/>
                            </svg>
                        </span>

                    </span>

                </button>

            <?php endforeach; ?>

        </div>


        <!-- RIGHT SIDE -->
        <div
            class="service-highlights__visual"
            data-service-highlights-panels
        >

            <span class="service-highlights__accent" aria-hidden="true"></span>

            <?php foreach ($highlights as $i => $service) :

                $image = $service['image'] ?? [];

                $image_url = $image['url']
                    ?? get_template_directory_uri() . '/assets/images/service-highlight-placeholder.webp';

                $image_alt = $image['alt']
                    ?? ($service['label'] ?? 'Pinnacle Behavioral Healthcare service');

                $link = $service['link'] ?? [];

                $link_url = $link['url'] ?? home_url('/contact');

            ?>

                <a
                    id="service-highlight-panel-<?php echo esc_attr($i); ?>"
                    class="service-highlights__panel<?php echo $i === 0 ? ' is-active' : ''; ?>"
                    data-service-highlights-panel
                    data-index="<?php echo esc_attr($i); ?>"
                    href="<?php echo esc_url($link_url); ?>"
                    role="tabpanel"
                    aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>"
                    tabindex="<?php echo $i === 0 ? '0' : '-1'; ?>"
                >

                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        class="service-highlights__image"
                        loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
                    >

                </a>

            <?php endforeach; ?>

        </div>

    </div>

</section>