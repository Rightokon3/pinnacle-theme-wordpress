
<?php
/**
 * Homepage — "What We Offer"
 *
 * Desktop:
 * - Full-height image on the right
 * - Inset blue content panel on the left
 * - Services scroll beside a sticky image
 *
 * Mobile:
 * - Image first
 * - Blue services panel underneath
 *
 * Content is pulled from the Homepage Content ACF options page.
 */


/* =========================================================
   HEADING
   ========================================================= */

$heading = get_field('services_heading', 'option')
    ?: 'What We Offer';


/* =========================================================
   SERVICE IMAGE
   ========================================================= */

$image = get_field('services_image', 'option');

$image_url = !empty($image['url'])
    ? $image['url']
    : get_template_directory_uri() . '/assets/images/services-side.png';

$image_alt = !empty($image['alt'])
    ? $image['alt']
    : 'Patient in a calm home setting';


/* =========================================================
   SERVICES
   ========================================================= */

$services = get_field('services_list', 'option');


/*
 * Fallback content.
 *
 * These are used if the ACF repeater is empty.
 */

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
            'title' => 'Pinnacle TMS',
            'description' => 'Pinnacle TMS is a non-invasive, FDA-approved treatment option for depression, anxiety, OCD, and other mental health conditions. Treatment uses magnetic pulses to stimulate targeted brain activity.',
        ],

        [
            'icon' => 'target',
            'title' => 'Spravato Treatment',
            'description' => "A supervised in-office treatment option for adults with depression that hasn't responded to standard medication approaches.",
        ],

        [
            'icon' => 'check',
            'title' => 'ADHD Assessment',
            'description' => 'A structured evaluation that measures attention and activity levels to support an accurate ADHD diagnosis in teens and adults.',
        ],

    ];
}


/* =========================================================
   SERVICE ICONS
   ========================================================= */

if (!function_exists('pinnacle_service_icon')) {

    function pinnacle_service_icon(string $icon): string {

        $icons = [

            'pill' => '
<svg
    viewBox="0 0 80 80"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
    focusable="false"
>

    <!-- Large tablet -->
    <circle
        cx="43"
        cy="25"
        r="14"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
    />

    <path
        d="M33 35L53 15"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

    <!-- Small capsule -->
    <rect
        x="13"
        y="38"
        width="31"
        height="14"
        rx="7"
        transform="rotate(-45 13 38)"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
    />

    <path
        d="M19 44L30 33"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

    <!-- Second capsule -->
    <rect
        x="38"
        y="48"
        width="31"
        height="14"
        rx="7"
        transform="rotate(-45 38 48)"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
    />

    <path
        d="M44 54L55 43"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

</svg>
            ',

            'heart' => '
<svg
    viewBox="0 0 80 80"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
    focusable="false"
>

    <!-- Person -->
    <circle
        cx="29"
        cy="36"
        r="10"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
    />

    <path
        d="M14 67
           C14 55 20 48 29 48
           C38 48 44 55 44 67"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

    <!-- Hair -->
    <path
        d="M19 33
           C19 25 24 20 31 20
           C38 20 43 26 42 34"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

    <!-- Speech bubble -->
    <path
        d="M43 17
           H67
           C70 17 72 19 72 22
           V39
           C72 42 70 44 67 44
           H55
           L47 50
           V44
           H43
           C40 44 38 42 38 39
           V22
           C38 19 40 17 43 17Z"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linejoin="round"
    />

    <!-- Speech lines -->
    <path
        d="M45 25H65"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
    />

    <path
        d="M45 31H62"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
    />

</svg>
            ',

            'zap' => '
<svg
    viewBox="0 0 80 80"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
    focusable="false"
>

    <!-- Head outline -->
    <path
        d="M31 67
           V56
           C23 52 18 45 18 36
           C18 24 27 15 39 15
           C51 15 60 24 60 36
           C60 42 57 47 53 51
           C51 53 50 56 50 60
           V67"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
        stroke-linejoin="round"
    />

    <!-- Face/nose -->
    <path
        d="M51 38
           C56 38 60 39 63 41
           C60 44 57 45 53 44"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
        stroke-linejoin="round"
    />

    <!-- Waveform -->
    <path
        d="M22 34
           H27
           L30 27
           L34 43
           L38 24
           L42 46
           L46 30
           L50 38
           H56"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
        stroke-linejoin="round"
    />

    <!-- Neck -->
    <path
        d="M31 67H50"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

</svg>
            ',

            'target' => '
<svg
    viewBox="0 0 80 80"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
    focusable="false"
>

    <!-- Spray bottle -->
    <path
        d="M29 57
           L43 31
           C45 28 48 27 51 29
           L58 33
           C61 35 62 38 60 41
           L46 66
           C44 69 41 70 38 68
           L31 64
           C28 63 27 60 29 57Z"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linejoin="round"
    />

    <!-- Bottle neck -->
    <path
        d="M43 31L38 27"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

    <!-- Spray nozzle -->
    <path
        d="M37 27L33 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

    <path
        d="M34 24L29 22"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
    />

    <!-- Spray marks -->
    <path
        d="M27 18L25 15"
        fill="none"
        stroke="currentColor"
        stroke-width="1.8"
        stroke-linecap="round"
    />

    <path
        d="M32 16L32 12"
        fill="none"
        stroke="currentColor"
        stroke-width="1.8"
        stroke-linecap="round"
    />

    <path
        d="M37 18L39 14"
        fill="none"
        stroke="currentColor"
        stroke-width="1.8"
        stroke-linecap="round"
    />

</svg>
            ',

            'check' => '
<svg
    viewBox="0 0 80 80"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
    focusable="false"
>

    <!-- Head -->
    <path
        d="M31 67
           V57
           C23 53 18 46 18 36
           C18 24 27 15 39 15
           C51 15 60 24 60 36
           C60 43 57 48 53 52
           C51 54 50 57 50 61
           V67"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
        stroke-linejoin="round"
    />

    <!-- Nose -->
    <path
        d="M51 37
           C56 38 59 40 62 42
           C59 44 56 44 52 43"
        fill="none"
        stroke="currentColor"
        stroke-width="2.2"
        stroke-linecap="round"
        stroke-linejoin="round"
    />

    <!-- Target -->
    <circle
        cx="39"
        cy="36"
        r="13"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
    />

    <circle
        cx="39"
        cy="36"
        r="7"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
    />

    <circle
        cx="39"
        cy="36"
        r="2"
        fill="currentColor"
    />

    <!-- Target crosshair -->
    <path
        d="M39 20V16
           M39 56V52
           M23 36H19
           M59 36H55"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
    />

</svg>
            ',
        ];


        return $icons[$icon] ?? $icons['pill'];
    }

}

?>


<section
    id="services"
    class="services"
    aria-labelledby="services-heading"
>


    <!-- =====================================================
         RIGHT — STICKY IMAGE
         ===================================================== -->

    <div class="services__media">

        <div class="services__media-inner">

            <img
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo esc_attr($image_alt); ?>"
                class="services__image"
                loading="lazy"
                decoding="async"
            >

        </div>

    </div>


    <!-- =====================================================
         LEFT — BLUE CONTENT PANEL
         ===================================================== -->

    <div class="services__panel">

        <div class="services__content">

            <h2
                id="services-heading"
                class="services__heading"
            >
                <?php echo esc_html($heading); ?>
            </h2>


            <div class="services__list">

                <?php foreach ($services as $service) : ?>

                    <?php

                    $service_title =
                        $service['title'] ?? '';

                    $service_description =
                        $service['description'] ?? '';

                    $service_icon =
                        $service['icon'] ?? 'pill';


                    /*
                     * SERVICE LINK
                     *
                     * First use the ACF Link field.
                     */
                    $service_link = '';

                    if (
                        ! empty($service['link'])
                        && is_array($service['link'])
                        && ! empty($service['link']['url'])
                    ) {
                        $service_link =
                            $service['link']['url'];
                    }


                    /*
                     * FALLBACK LINKS
                     *
                     * Used when the ACF Link field
                     * has not been filled in.
                     */
                    if (! $service_link) {

                        $service_links = [

                            'Medication Management' =>
                                home_url(
                                    '/medication-management/'
                                ),

                            'Individual Psychotherapy' =>
                                home_url(
                                    '/individual-psychotherapy/'
                                ),

                            'Pinnacle TMS' =>
                                home_url(
                                    '/tms-treatments/'
                                ),

                            'Spravato Treatment' =>
                                home_url(
                                    '/spravato/'
                                ),

                            'ADHD Assessment' =>
                                home_url(
                                    '/adhd-testing/'
                                ),

                        ];

                        $service_link =
                            $service_links[$service_title]
                            ?? '#';
                    }

                    ?>


                    <article
                        id="<?php echo esc_attr(
                            sanitize_title($service_title)
                        ); ?>"
                        class="services__item"
                    >

                        <div class="services__icon">

                            <?php
                            echo pinnacle_service_icon(
                                $service_icon
                            );
                            ?>

                        </div>


                        <h3 class="services__item-title">

                            <?php
                            echo esc_html(
                                $service_title
                            );
                            ?>

                        </h3>


                        <p class="services__item-description">

                            <?php
                            echo esc_html(
                                $service_description
                            );
                            ?>

                        </p>


                        <!-- SERVICE CTA -->

                        <a
                            href="<?php echo esc_url(
                                $service_link
                            ); ?>"
                            class="services__item-button"
                        >

                            View Service

                            <span aria-hidden="true">
                                →
                            </span>

                        </a>


                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>

