<?php
/**
 * Services page — 2-column card grid (image with offset accent
 * block behind it, title, "Learn More" button). Content pulled from
 * the "Services Page" ACF options page.
 *
 * Hovering a card fades in a blue gradient over its photo — see
 * .service-card__image-wrap::after in style.css.
 *
 * Each image falls back to a placeholder graphic — replace per
 * service via the ACF repeater in wp-admin.
 */


$services = get_field('services_list', 'option');

$placeholder_image = get_template_directory_uri() . '/assets/images/image_fx-4.png';
$placeholder_image1 = get_template_directory_uri() . '/assets/images/Cara_Reclined-1.png';
$placeholder_image2 = get_template_directory_uri() . '/assets/images/Mask-group-8-1.webp';
$placeholder_image3 = get_template_directory_uri() . '/assets/images/spravato-treatment-near-me-san-diego-ca-2.jpeg';
$placeholder_image4 = get_template_directory_uri() . '/assets/images/PinnacleBH2024_1_-00101_1_1-1.webp';

if (empty($services)) {
    $services = [
        [
            'image' => ['url' => $placeholder_image, 'alt' => 'Service image placeholder'],
            'title' => 'Medication Management',
            'link'  => ['url' => '#', 'title' => 'Learn More'],
        ],
        [
            'image' => ['url' => $placeholder_image1, 'alt' => 'Service image placeholder'],
            'title' => 'TMS Treatments',
            'link'  => ['url' => '#', 'title' => 'Learn More'],
        ],
        [
            'image' => ['url' => $placeholder_image2, 'alt' => 'Service image placeholder'],
            'title' => 'Individual Psychotherapy',
            'link'  => ['url' => '#', 'title' => 'Learn More'],
        ],
        [
            'image' => ['url' => $placeholder_image3, 'alt' => 'Service image placeholder'],
            'title' => 'Spravato',
            'link'  => ['url' => '#', 'title' => 'Learn More'],
        ],
        [
            'image' => ['url' => $placeholder_image4, 'alt' => 'Service image placeholder'],
            'title' => 'ADHD Testing',
            'link'  => ['url' => '#', 'title' => 'Learn More'],
        ],
    ];
}
?>

<section class="services-grid">
    <div class="services-grid__inner">

        <?php foreach ($services as $service) :
            $image     = $service['image'] ?? [];
            $image_url = $image['url'] ?? $placeholder_image;
            $image_alt = $image['alt'] ?? esc_attr($service['title'] ?? 'Service image placeholder');
            $link      = $service['link'] ?? [];
            $link_url  = $link['url'] ?? '#';
            $link_text = $link['title'] ?? 'Learn More';
            ?>
            <div class="service-card">
                <div class="service-card__media">
                    <div class="service-card__accent"></div>
                    <div class="service-card__image-wrap">
                        <img
                            src="<?php echo esc_url($image_url); ?>"
                            alt="<?php echo esc_attr($image_alt); ?>"
                            class="service-card__image"
                            loading="lazy"
                        >
                    </div>
                </div>
                <h3 class="service-card__title"><?php echo esc_html($service['title'] ?? ''); ?></h3>
                <a href="<?php echo esc_url($link_url); ?>" class="service-card__cta">
                    <?php echo esc_html($link_text); ?>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</section>