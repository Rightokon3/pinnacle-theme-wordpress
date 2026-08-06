<?php
/**
 * Homepage — "What Our Patients Say" testimonial carousel.
 * Content pulled from the "Homepage Content" ACF options page via a
 * repeater; falls back to the original three testimonials.
 *
 * The original React build used the Swiper library for this. Rather
 * than pull in a JS carousel dependency, assets/js/testimonials.js
 * implements the same scroll-snap + dot-pagination + autoplay
 * behavior in plain JS.
 */

$heading = get_field('testimonials_heading', 'option') ?: 'What Our Patients Say';
$cta_text = get_field('testimonials_cta_text', 'option') ?: 'View All';
$cta_link = get_field('testimonials_cta_link', 'option') ?: '#testimonials';

$testimonials = get_field('testimonials_list', 'option');
if (empty($testimonials)) {
    $testimonials = [
        [
            'quote' => "This was one of the best medical experiences I've had. The team was easy to talk to and made me feel truly heard from the very first visit.",
            'name' => 'J. Alvarez',
        ],
        [
            'quote' => "I've never had a provider follow up so closely. Every question I had between appointments was answered quickly and clearly.",
            'name' => 'R. Chen',
        ],
        [
            'quote' => "Scheduling was simple and the care plan actually fit my life instead of the other way around. I finally feel like I'm making progress.",
            'name' => 'M. Okafor',
        ],
    ];
}
?>

<section class="testimonials">
    <h2 class="testimonials__heading"><?php echo esc_html($heading); ?></h2>

    <div class="testimonials__carousel" data-testimonials-carousel>
        <div class="testimonials__track" data-testimonials-track>
            <?php foreach ($testimonials as $testimonial) : ?>
                <div class="testimonials__slide">
                    <div class="testimonials__card">
                        <span class="testimonials__avatar">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <p class="testimonials__quote">&ldquo;<?php echo esc_html($testimonial['quote']); ?>&rdquo;</p>
                        <p class="testimonials__name"><?php echo esc_html($testimonial['name']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="testimonials__dots" data-testimonials-dots></div>
    </div>

    <div class="testimonials__cta-wrap">
        <a href="<?php echo esc_url($cta_link); ?>" class="testimonials__cta">
            <?php echo esc_html($cta_text); ?>
        </a>
    </div>
</section>