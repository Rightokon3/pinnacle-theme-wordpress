<?php
/**
 * Homepage — What Our Patients Say
 *
 * Matches the live Pinnacle testimonial section:
 * - 2 testimonials visible on desktop
 * - 1 testimonial visible on mobile
 * - Initial circle + patient name
 * - Quote underneath
 * - Arrow controls
 * - Dot pagination
 * - View All button
 *
 * Content is pulled from the "Homepage Content" ACF options page.
 */

$heading = get_field('testimonials_heading', 'option')
    ?: 'What Our Patients Say';

$cta_text = get_field('testimonials_cta_text', 'option')
    ?: 'View All';

$cta_link = get_field('testimonials_cta_link', 'option')
    ?: '/testimonials/';

$testimonials = get_field('testimonials_list', 'option');


/*
 * Fallback names from the current live homepage.
 *
 * Put the exact live review text into your ACF repeater
 * when you're ready.
 */
if (empty($testimonials)) {
    $testimonials = [
        [
            'name'  => 'Ikram Osman',
            'quote' => "This is probably the best medical and psychiatric experience I've ever had. CNP Fatuma was easy to talk to and connect with. She truly listened to my concerns.",
        ],
        [
            'name'  => 'Jayce Warner',
            'quote' => "This has been by far the best experience I've had at the doctors. Every time I have called to schedule or change an appointment, someone has answered right away.",
        ],
        [
            'name'  => 'Patrick Porter',
            'quote' => "So far I'm pleased. I learned a lot from talking with Fatuma. She seems very knowledgeable, and I'm hopeful that things will work out well.",
        ],
        [
            'name'  => 'Jan Clark',
            'quote' => "I love the respect and caring that I always feel when I speak with Fatuma. She is the best. All the staff is so respectful and helpful.",
        ],
        [
            'name'  => 'Sara Pette',
            'quote' => "All of my interactions with providers and front desk staff have been amazing. I'm so lucky to be in such good hands.",
        ],
        [
            'name'  => 'Deborah Talley',
            'quote' => "I am very happy with Dr. Awosika. He takes the time to listen and has excellent recommendations when I'm struggling.",
        ],
    ];
}
?>

<section
    id="testimonials"
    class="testimonials"
    aria-labelledby="testimonials-heading"
>

    <div class="testimonials__inner">

        <h2
            id="testimonials-heading"
            class="testimonials__heading"
        >
            <?php echo esc_html($heading); ?>
        </h2>


        <div
            class="testimonials__carousel"
            data-testimonials-carousel
        >

            <!-- Previous -->
            <button
                type="button"
                class="testimonials__arrow testimonials__arrow--prev"
                aria-label="Previous testimonials"
            >
                <span aria-hidden="true">‹</span>
            </button>


            <!-- Viewport / Track -->
            <div
                class="testimonials__viewport"
            >

                <div
                    class="testimonials__track"
                    data-testimonials-track
                    tabindex="0"
                >

                    <?php foreach ($testimonials as $testimonial) :

                        $name = trim(
                            $testimonial['name'] ?? 'Patient'
                        );

                        $initial = function_exists('mb_substr')
                            ? mb_substr($name, 0, 1)
                            : substr($name, 0, 1);

                    ?>

                        <article class="testimonials__slide">

                            <div class="testimonials__card">

                                <div class="testimonials__header">

                                    <span
                                        class="testimonials__avatar"
                                        aria-hidden="true"
                                    >
                                        <?php
                                        echo esc_html(
                                            strtoupper($initial)
                                        );
                                        ?>
                                    </span>

                                    <p class="testimonials__name">
                                        <?php echo esc_html($name); ?>
                                    </p>

                                </div>


                                <p class="testimonials__quote">
                                    <?php echo esc_html(
                                        $testimonial['quote'] ?? ''
                                    ); ?>
                                </p>

                            </div>

                        </article>

                    <?php endforeach; ?>

                </div>

            </div>


            <!-- Next -->
            <button
                type="button"
                class="testimonials__arrow testimonials__arrow--next"
                aria-label="Next testimonials"
            >
                <span aria-hidden="true">›</span>
            </button>


            <!-- Dots -->
            <div
                class="testimonials__dots"
                data-testimonials-dots
                aria-label="Testimonial navigation"
            ></div>

        </div>


        <!-- View All -->
        <div class="testimonials__cta-wrap">

            <a
                href="<?php echo esc_url($cta_link); ?>"
                class="testimonials__cta"
            >
                <span>
                    <?php echo esc_html($cta_text); ?>
                </span>

                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    aria-hidden="true"
                    focusable="false"
                >
                    <path
                        d="M3 10H17"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M11 4L17 10L11 16"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

            </a>

        </div>

    </div>

</section>