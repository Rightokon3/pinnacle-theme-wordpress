<?php
/**
 * Homepage — "Our Specialists" grid: photo, name, credentials, profile link.
 * Content pulled from the "Homepage Content" ACF options page via a
 * repeater; falls back to three placeholder specialists.
 *
 * Add a True/False sub-field named "featured" to the specialists_list
 * repeater in ACF and check it for the founder to get the taller photo card.
 */

$specialists = get_field('specialists_list', 'option');
if (empty($specialists)) {
    $specialists = [
        [
            'name' => 'Tami Kittlesonrn',
            'title' => 'APRN, CNP, PMHNP-BC',
            'photo' => ['url' => get_template_directory_uri() . '/assets/images/Dara-Awosika-1-2-1024x328.webp'],
            'link' => ['url' => home_url('/contact'), 'title' => 'View Profile'],
        ],
        [
            'name' => 'Olukayode Awosika',
            'title' => 'MD, FAPA',
            'photo' => ['url' => get_template_directory_uri() . '/assets/images/Headshot-Olukayode-Awosika-B.webp'],
            'link' => ['url' => home_url('/contact'), 'title' => 'View Profile'],
            'featured' => true,
        ],
        [
            'name' => 'Fatuma Guhadrn',
            'title' => 'APRN, CNP, PMHNP-BCrn',
            'photo' => ['url' => get_template_directory_uri() . '/assets/images/Mask-group-5.webp'],
            'link' => ['url' => home_url('/contact'), 'title' => 'View Profile'],
        ],
    ];
}
?>

<section id="specialists" class="specialists">
    <div class="specialists__grid">
        <?php foreach ($specialists as $doc) :
            $photo = $doc['photo'] ?? null;
            $photo_url = $photo['url'] ?? get_template_directory_uri() . '/assets/images/specialist-placeholder.webp';
            $photo_alt = $photo['alt'] ?? ('Portrait of ' . $doc['name']);

            $link = $doc['link'] ?? null;
            $link_url = $link['url'] ?? home_url('/contact');
            $link_text = $link['title'] ?? 'View Profile';
            $link_target = $link['target'] ?? '_self';

            // Founder gets the featured (taller) treatment
            $is_founder = !empty($doc['featured']);
            $card_class = 'specialists__card' . ($is_founder ? ' specialists__card--featured' : '');
        ?>
            <div class="<?php echo esc_attr($card_class); ?>">
                <div class="specialists__photo-wrap">
                    <img
                        src="<?php echo esc_url($photo_url); ?>"
                        alt="<?php echo esc_attr($photo_alt); ?>"
                        class="specialists__photo"
                        loading="lazy"
                    >
                </div>
                <div class="specialists__body">
                    <p class="specialists__name"><?php echo esc_html($doc['name']); ?></p>
                    <p class="specialists__title"><?php echo esc_html($doc['title']); ?></p>
                    
                        href="<?php echo esc_url($link_url); ?>"
                        class="specialists__link"
                        <?php echo $link_target === '_blank' ? 'target="_blank" rel="noopener"' : ''; ?>
                    >
                        <?php echo esc_html($link_text); ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>