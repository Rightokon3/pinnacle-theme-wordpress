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

        /*
         * =====================================================
         * 10+ YEARS OF EXPERIENCE
         * Award / certificate icon
         * =====================================================
         */
        'award' => '
            <svg
                width="72"
                height="72"
                viewBox="0 0 72 72"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
                focusable="false"
            >
                <!-- Certificate -->
                <path
                    d="M20 8H49C52.3 8 55 10.7 55 14V51C55 54.3 52.3 57 49 57H20C16.7 57 14 54.3 14 51V14C14 10.7 16.7 8 20 8Z"
                    fill="currentColor"
                />

                <!-- Certificate cutout -->
                <rect
                    x="21"
                    y="17"
                    width="27"
                    height="5"
                    rx="2"
                    fill="#ffffff"
                />

                <rect
                    x="21"
                    y="27"
                    width="20"
                    height="4"
                    rx="2"
                    fill="#ffffff"
                />

                <!-- Medal -->
                <circle
                    cx="48"
                    cy="49"
                    r="11"
                    fill="currentColor"
                />

                <circle
                    cx="48"
                    cy="49"
                    r="6"
                    fill="#ffffff"
                />

                <!-- Ribbon -->
                <path
                    d="M41 57L37 68L48 63L59 68L55 57"
                    fill="currentColor"
                />
            </svg>
        ',


        /*
         * =====================================================
         * INDIVIDUALIZED TREATMENT PLANS
         * Hands / care icon
         * =====================================================
         */
      'clipboard' => '
    <svg
        width="72"
        height="72"
        viewBox="0 0 72 72"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
        focusable="false"
    >

        <!-- Central blue shape -->
        <path
            d="M36 8
               C31 8 27 12 27 17
               V22
               C22 23 18 27 17 32
               L14 47
               C13 52 17 56 22 56
               H50
               C55 56 59 52 58 47
               L55 32
               C54 27 50 23 45 22
               V17
               C45 12 41 8 36 8Z"
            fill="currentColor"
        />

        <!-- Left hand -->
        <path
            d="M17 45
               C20 41 24 38 28 36
               L32 34
               C34 33 36 35 36 37
               C36 39 34 41 32 42
               L27 45
               L39 42
               C42 41 44 43 44 45
               C44 47 42 49 40 49
               L27 53
               H21
               C18 53 16 50 17 45Z"
            fill="#ffffff"
        />

        <!-- Right hand -->
        <path
            d="M55 45
               C52 41 48 38 44 36
               L40 34
               C38 33 36 35 36 37
               C36 39 38 41 40 42
               L45 45
               L33 42
               C30 41 28 43 28 45
               C28 47 30 49 32 49
               L45 53
               H51
               C54 53 56 50 55 45Z"
            fill="#ffffff"
        />

        <!-- Small center fingers -->
        <path
            d="M29 26
               C31 22 34 20 36 20
               C38 20 41 22 43 26"
            stroke="#ffffff"
            stroke-width="2.2"
            stroke-linecap="round"
        />

    </svg>
',


        /*
         * =====================================================
         * STATE-OF-THE-ART FACILITIES
         * Hand + medical cross
         * =====================================================
         */
        'home' => '
            <svg
                width="72"
                height="72"
                viewBox="0 0 72 72"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
                focusable="false"
            >

                <!-- Medical cross circle -->
                <circle
                    cx="47"
                    cy="20"
                    r="12"
                    fill="currentColor"
                />

                <rect
                    x="43"
                    y="13"
                    width="8"
                    height="14"
                    rx="1"
                    fill="#ffffff"
                />

                <rect
                    x="40"
                    y="16"
                    width="14"
                    height="8"
                    rx="1"
                    fill="#ffffff"
                />

                <!-- Hand -->
                <path
                    d="M17 51
                       C17 46 20 42 24 40
                       L31 37
                       C34 36 36 38 37 40
                       C38 42 37 44 35 45
                       L30 48
                       L42 44
                       C45 43 48 45 48 48
                       C48 50 47 52 44 53
                       L30 59
                       H23
                       C19 59 17 56 17 51Z"
                    fill="currentColor"
                />

                <!-- Wrist -->
                <path
                    d="M13 50V59C13 61 15 63 17 63H24V50H13Z"
                    fill="currentColor"
                />

                <!-- Separation -->
                <path
                    d="M28 49L39 46"
                    stroke="#ffffff"
                    stroke-width="2"
                    stroke-linecap="round"
                />

            </svg>
        ',
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