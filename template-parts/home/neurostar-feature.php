<?php
/**
 * NeuroStar Feature
 *
 * Desktop promotional feature for NeuroStar Advanced TMS Therapy.
 *
 * This section intentionally uses its own class namespace:
 *
 * neurostar-feature
 *
 * It does not share styles with the other services sections.
 */
?>

<section
    class="neurostar-feature"
    aria-labelledby="neurostar-feature-title"
>

    <div class="neurostar-feature__box">

        <!-- LEFT: LOGO AREA -->
        <div class="neurostar-feature__visual">

            <div class="neurostar-feature__logo-card">

                <?php
                /*
                 * Replace this image with the actual NeuroStar logo.
                 *
                 * File location:
                 *
                 * /assets/images/neurostar-logo.png
                 */

                $neurostar_logo =
                    get_template_directory_uri()
                    . '/assets/images/neuro-star-logo-300x116_color.webp';
                ?>

                <img
                    class="neurostar-feature__logo"
                    src="<?php echo esc_url($neurostar_logo); ?>"
                    alt="NeuroStar Advanced Therapy for Mental Health"
                    loading="lazy"
                    decoding="async"
                >

            </div>

        </div>


        <!-- RIGHT: CONTENT -->
        <div class="neurostar-feature__content">




            <p class="neurostar-feature__description">
                We’re proud to provide NeuroStar Advanced TMS Therapy to patients.
            </p>


            <a
                class="neurostar-feature__link"
                href="/tms-treatments/"
            >

                <span class="neurostar-feature__link-text">
                    Learn More About NeuroStar TMS
                </span>

                <svg
                    class="neurostar-feature__link-icon"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    aria-hidden="true"
                    focusable="false"
                >
                    <path
                        d="M3 10H16"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M11 5L16 10L11 15"
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