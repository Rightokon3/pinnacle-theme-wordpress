<?php
/**
 * Quick Facts band — three even columns (location, history, offer),
 * each with a title, short description, and CTA link.
 *
 * Content pulled from the "Quick Facts Band" field on the "Homepage
 * Content" ACF options page (same options-page pattern as
 * template-parts/contact/contact.php). Each item's link comes from an
 * ACF Link field, so the CTA label and URL are both editable from
 * wp-admin without touching code.
 */

$facts = get_field('quick_facts_list', 'option');

if (empty($facts)) {
    $facts = [
        [
            'title'       => 'Serving Minneapolis And The Twin Cities Area',
            'description' => "We specialize in treating adults with mental health disorders. Our goal is to help people facing emotional distress reach their greatest potential.",
            'link'        => ['title' => 'View Services', 'url' => home_url('/services'), 'target' => ''],
        ],
        [
            'title'       => 'Helping The Community Since 2015',
            'description' => "Dr. Maya Whitfield founded our practice to give patients access to a genuinely high level of mental healthcare, built around real relationships with providers.",
            'link'        => ['title' => 'Read About Us', 'url' => home_url('/providers'), 'target' => ''],
        ],
        [
            'title'       => '10% Off Your First Supplement Order',
            'description' => "We only carry supplements from reputable, quality-tested brands, so you can trust what you're adding to your care plan. Offer code: WELCOME10",
            'link'        => ['title' => 'Shop Now', 'url' => home_url('/dispensary'), 'target' => ''],
        ],
    ];
}
?>

<section class="quick-facts">
    <div class="quick-facts__grid">

        <?php foreach ($facts as $fact) :
            $link        = $fact['link'] ?? [];
            $link_url    = $link['url'] ?? '#';
            $link_title  = $link['title'] ?? 'Learn More';
            $is_new_tab  = !empty($link['target']) && $link['target'] === '_blank';
            ?>
            <div class="quick-facts__item">
                <h2 class="quick-facts__title"><?php echo esc_html($fact['title']); ?></h2>
                <p class="quick-facts__description"><?php echo esc_html($fact['description']); ?></p>

                <a
                    href="<?php echo esc_url($link_url); ?>"
                    class="quick-facts__cta"
                    <?php echo $is_new_tab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
                >
                    <?php echo esc_html($link_title); ?>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</section>