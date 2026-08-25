<?php
/**
 * Homepage — Why Choose Pinnacle
 *
 * Left: 7-image carousel
 * Right: heading, body and CTA
 */


/* =========================================================
   CONTENT
   ========================================================= */

$heading = get_field('why_choose_heading', 'option')
    ?: 'Why Choose Pinnacle';

$body = get_field('why_choose_body', 'option')
    ?: "Accurate diagnosis of mental health disorders can be difficult. At Pinnacle, we use the most advanced technology and techniques to ensure an accurate diagnosis. We believe that the best way to treat mental illness is to first get a precise understanding of the individuals’ unique needs.";

$cta_text = get_field('why_choose_cta_text', 'option')
    ?: 'Schedule Consultation';

$cta_link = get_field('why_choose_cta_link', 'option')
    ?: '' . home_url('/contact') . '';


/* =========================================================
   SEVEN CAROUSEL IMAGES
   ========================================================= */

$carousel_images = [

    [
        'url' => get_template_directory_uri() . '/assets/images/first.webp',
        'alt' => 'Pinnacle Behavioral Healthcare consultation room'
    ],

    [
        'url' => get_template_directory_uri() . '/assets/images/second.webp',
        'alt' => 'Pinnacle Behavioral Healthcare office'
    ],

    [
        'url' => get_template_directory_uri() . '/assets/images/third.webp',
        'alt' => 'Pinnacle Behavioral Healthcare treatment space'
    ],

    [
        'url' => get_template_directory_uri() . '/assets/images/fourth.webp',
        'alt' => 'Pinnacle Behavioral Healthcare facility'
    ],

    [
        'url' => get_template_directory_uri() . '/assets/images/fifth.webp',
        'alt' => 'Pinnacle Behavioral Healthcare care environment'
    ],

    [
        'url' => get_template_directory_uri() . '/assets/images/sixth.webp',
        'alt' => 'Pinnacle Behavioral Healthcare office environment'
    ],

    [
        'url' => get_template_directory_uri() . '/assets/images/seventh.webp',
        'alt' => 'Pinnacle Behavioral Healthcare consultation space'
    ],

];

?>

<section
    class="why-choose"
    aria-labelledby="why-choose-heading"
>

    <div class="why-choose__grid">


        <!-- =================================================
             LEFT — CAROUSEL
             ================================================= -->

        <div
            class="why-choose__carousel"
            id="why-choose-carousel"
            data-why-choose-carousel
            tabindex="0"
            aria-label="Why Choose Pinnacle image gallery"
        >

            <div class="why-choose__carousel-viewport">

                <div class="why-choose__carousel-track">

                    <?php foreach ($carousel_images as $index => $image) : ?>

                        <div
                            class="why-choose__slide <?php echo $index === 0 ? 'is-active' : ''; ?>"
                            data-carousel-slide
                            aria-hidden="<?php echo $index === 0 ? 'false' : 'true'; ?>"
                        >

                            <img
                                src="<?php echo esc_url($image['url']); ?>"
                                alt="<?php echo esc_attr($image['alt']); ?>"
                                class="why-choose__image"
                                <?php echo $index === 0 ? 'loading="eager"' : 'loading="lazy"'; ?>
                                decoding="async"
                            >

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>


            <!-- =================================================
                 DOTS
                 ================================================= -->

            <div
                class="why-choose__dots"
                aria-label="Carousel navigation"
            >

                <?php foreach ($carousel_images as $index => $image) : ?>

                    <button
                        type="button"
                        class="why-choose__dot <?php echo $index === 0 ? 'is-active' : ''; ?>"
                        data-carousel-dot
                        data-slide="<?php echo esc_attr($index); ?>"
                        aria-label="Show image <?php echo esc_attr($index + 1); ?>"
                        aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                    ></button>

                <?php endforeach; ?>

            </div>

        </div>


        <!-- =================================================
             RIGHT — CONTENT
             ================================================= -->

        <div class="why-choose__content">

            <h2
                id="why-choose-heading"
                class="why-choose__heading"
            >
                <?php echo esc_html($heading); ?>
            </h2>


            <p class="why-choose__body">
                <?php echo esc_html($body); ?>
            </p>


            <a
                href="<?php echo esc_url($cta_link); ?>"
                class="why-choose__cta"
            >

                <?php echo esc_html($cta_text); ?>

                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    aria-hidden="true"
                    focusable="false"
                >

                    <path
                        d="M2 8H14M14 8L9 3M14 8L9 13"
                        stroke="currentColor"
                        stroke-width="1.6"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                </svg>

            </a>

        </div>

    </div>

</section>


<!-- =========================================================
     WHY CHOOSE CAROUSEL JAVASCRIPT
     ========================================================= -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    const carousel = document.querySelector(
        '[data-why-choose-carousel]'
    );

    if (!carousel) {
        console.log('Why Choose carousel: element not found.');
        return;
    }


    const slides = carousel.querySelectorAll(
        '[data-carousel-slide]'
    );

    const dots = carousel.querySelectorAll(
        '[data-carousel-dot]'
    );


    if (!slides.length) {
        console.log('Why Choose carousel: no slides found.');
        return;
    }


    let currentIndex = 0;

    let autoplay = null;


    /* =====================================================
       SHOW SLIDE
       ===================================================== */

    function showSlide(index) {

        if (index >= slides.length) {
            index = 0;
        }

        if (index < 0) {
            index = slides.length - 1;
        }

        currentIndex = index;


        slides.forEach(function (slide, i) {

            const active = i === currentIndex;

            slide.classList.toggle(
                'is-active',
                active
            );

            slide.setAttribute(
                'aria-hidden',
                active ? 'false' : 'true'
            );

        });


        dots.forEach(function (dot, i) {

            const active = i === currentIndex;

            dot.classList.toggle(
                'is-active',
                active
            );

            dot.setAttribute(
                'aria-current',
                active ? 'true' : 'false'
            );

        });

    }


    /* =====================================================
       NEXT
       ===================================================== */

    function nextSlide() {

        showSlide(currentIndex + 1);

    }


    /* =====================================================
       AUTOPLAY
       ===================================================== */

    function startAutoplay() {

        clearInterval(autoplay);

        autoplay = setInterval(function () {

            nextSlide();

        }, 5000);

    }


    /* =====================================================
       DOT CLICK
       ===================================================== */

    dots.forEach(function (dot) {

        dot.addEventListener('click', function () {

            const index = parseInt(
                dot.getAttribute('data-slide'),
                10
            );

            showSlide(index);

            startAutoplay();

        });

    });


    /* =====================================================
       KEYBOARD
       ===================================================== */

    carousel.addEventListener('keydown', function (event) {

        if (event.key === 'ArrowRight') {

            event.preventDefault();

            showSlide(currentIndex + 1);

            startAutoplay();

        }


        if (event.key === 'ArrowLeft') {

            event.preventDefault();

            showSlide(currentIndex - 1);

            startAutoplay();

        }

    });


    /* =====================================================
       PAUSE ON HOVER
       ===================================================== */

    carousel.addEventListener('mouseenter', function () {

        clearInterval(autoplay);

    });


    carousel.addEventListener('mouseleave', function () {

        startAutoplay();

    });


    /* =====================================================
       INITIALIZE
       ===================================================== */

    showSlide(0);

    startAutoplay();


    console.log(
        'Why Choose carousel initialized:',
        slides.length,
        'slides'
    );

});
</script>