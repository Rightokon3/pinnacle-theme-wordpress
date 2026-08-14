<?php
/**
 * Template Name: Brain Health Series
 * File: page-brain-health-series.php
 */

get_header();

/*
 * Banner image.
 * Uses the same background image as the rest of the site.
 */
$banner_image =
    get_template_directory_uri() .
    '/assets/images/back.webp';


/*
 * Brain Health Series resources.
 * Replace the "#" URLs with your real pages/YouTube links.
 */
$brain_health_items = array(

    array(
        'title'       => 'The Triple Network Guide',
        'subtitle'    => '',
        'description' => 'The foundation guide. Explains the Default Mode Network, Central Executive Network, and Salience Network. Every patient receives this first.',
        'button'      => 'THE TRIPLE NETWORK GUIDE',
        'url'         => 'https://youtu.be/gexWEYLPOGo',
    ),

    array(
        'title'       => 'The Neuroscience of Positive Psychiatry',
        'subtitle'    => '',
        'description' => 'The permission layer. Covers HERO traits, NMDA/AMPA permission system, reward prediction error, affective temperament, and WILD 5 Wellness.',
        'button'      => 'NEUROSCIENCE OF POSITIVE PSYCHIATRY',
        'url'         => 'https://youtu.be/5lBFDKYbgGs',
    ),

    array(
        'title'       => 'Anxiety',
        'subtitle'    => 'From Blame to Strategy',
        'description' => 'Covers the Salience Network’s role in threat detection, GAD, panic disorder, social anxiety, CBT, exposure therapy, and medication options.',
        'button'      => 'BLAME TO STRATEGY',
        'url'         => 'https://youtu.be/0HbW0KZe-U4',
    ),

    array(
        'title'       => 'Depression',
        'subtitle'    => 'Understanding Your Brain',
        'description' => 'Covers the Default Mode Network in depression, blunted reward prediction, anhedonia, behavioral activation, and the Tune vs. Train principle.',
        'button'      => 'UNDERSTANDING YOUR BRAIN',
        'url'         => 'https://youtu.be/rbURNyPa54E',
    ),

    array(
        'title'       => 'ADHD',
        'subtitle'    => 'The Focus Network Guide',
        'description' => 'Covers Focus Network switching reliability, high-interest vs. routine task activation, stimulant medications, exercise, and external structure strategies.',
        'button'      => 'FOCUS NETWORK GUIDE',
        'url'         => 'https://youtu.be/_r06U4w6h44',
    ),

    array(
        'title'       => 'Bipolar Disorder',
        'subtitle'    => 'The Brain User Manual',
        'description' => 'Covers Salience Network instability, mood stabilizers, circadian anchoring, and the SAMe and St. John’s Wort contraindication warning.',
        'button'      => 'BRAIN USER MANUAL',
        'url'         => 'https://youtu.be/Ae94wT3sMec',
    ),

    array(
        'title'       => 'PTSD',
        'subtitle'    => 'The Trauma Recovery Toolkit',
        'description' => 'Covers the cortico-striato-thalamo-cortical loop, why reassurance doesn’t work, exposure and response prevention, and serotonin/glutamate in OCD.',
        'button'      => 'TRAUMA RECOVERY TOOLKIT',
        'url'         => 'https://youtu.be/YLwEmvmH3Us',
    ),

    array(
        'title'       => 'OCD',
        'subtitle'    => 'The Error Signal Guide',
        'description' => 'Covers the cortico-striato-thalamo-cortical loop, why reassurance doesn’t work, exposure and response prevention, and serotonin/glutamate in OCD.',
        'button'      => 'ERROR SIGNAL GUIDE',
        'url'         => 'https://youtu.be/gLX82AA5O1A',
    ),

    array(
        'title'       => 'Sleep',
        'subtitle'    => 'The Reference Guide',
        'description' => 'Covers chronotype, delayed sleep phase, sleep architecture, CBT-I, sleep fragmentation, and the eye movement sleep onset protocol.',
        'button'      => 'REFERENCE GUIDE',
        'url'         => 'https://youtu.be/Ub6YtMoXt_k',
    ),

    array(
        'title'       => 'Breath & CO₂',
        'subtitle'    => 'Resonance Breathing',
        'description' => 'Covers the physiology of CO₂ and breathing, resonance breathing and heart rate variability, the physiological sigh, and practical breathing protocols.',
        'button'      => 'RESONANCE BREATHING',
        'url'         => 'https://youtu.be/juDWCjPzfzs',
    ),
);

?>

<main class="brain-health-page">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section
        class="brain-health-hero"
        style="background-image:url('<?php echo esc_url( $banner_image ); ?>');"
    >

        <div class="brain-health-hero__overlay">

            <div class="brain-health-container">

                <h1 class="brain-health-hero__title">
                    Brain Health Series
                </h1>

            </div>

        </div>

    </section>


    <!-- =====================================================
         SHARE
    ====================================================== -->

    <section class="brain-health-share">

        <div class="brain-health-container">

            <h2>
                Share and Enjoy !
            </h2>

            <div class="brain-health-share__buttons">

                <span class="brain-health-share__count">
                    <span>↗</span>
                    <small>SHARES</small>
                </span>

                <a
                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="brain-share brain-share--facebook"
                >
                    f
                </a>

                <a
                    href="https://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink() ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="brain-share brain-share--pinterest"
                >
                    p
                </a>

                <button
                    type="button"
                    class="brain-share brain-share--pdf"
                    onclick="window.print();"
                >
                    PDF
                </button>

                <button
                    type="button"
                    class="brain-share brain-share--link"
                    onclick="
                        if (navigator.clipboard) {
                            navigator.clipboard.writeText(
                                window.location.href
                            );
                        }
                    "
                >
                    🔗
                </button>

                <button
                    type="button"
                    class="brain-share brain-share--more"
                    onclick="
                        if (navigator.share) {
                            navigator.share({
                                title: document.title,
                                url: window.location.href
                            });
                        }
                    "
                >
                    +
                </button>

            </div>

        </div>

    </section>


    <!-- =====================================================
         RESOURCE GRID
    ====================================================== -->

    <section class="brain-health-resources">

        <div class="brain-health-container">

            <div class="brain-health-grid">

                <?php foreach (
                    $brain_health_items as $item
                ) : ?>

                    <article class="brain-health-card">

                        <div class="brain-health-card__inner">

                            <h2 class="brain-health-card__title">
                                <?php
                                echo esc_html(
                                    $item['title']
                                );
                                ?>
                            </h2>


                            <?php if (
                                ! empty(
                                    $item['subtitle']
                                )
                            ) : ?>

                                <h3 class="brain-health-card__subtitle">
                                    <?php
                                    echo esc_html(
                                        $item['subtitle']
                                    );
                                    ?>
                                </h3>

                            <?php endif; ?>


                            <p class="brain-health-card__description">
                                <?php
                                echo esc_html(
                                    $item['description']
                                );
                                ?>
                            </p>


                            <a
                                href="<?php echo esc_url( $item['url'] ); ?>"
                                class="brain-health-card__button"
                            >

                                <?php
                                echo esc_html(
                                    $item['button']
                                );
                                ?>

                                <span aria-hidden="true">
                                    →
                                </span>

                            </a>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>


            <!-- =================================================
                 BRAIN HEALTH PLAN
            ================================================== -->

            <section class="brain-health-plan">

                <div class="brain-health-plan__content">

                    <span class="brain-health-plan__eyebrow">
                        THE COMPLETE ROADMAP
                    </span>

                    <h2>
                        The Brain Health Plan
                    </h2>

                    <h3>
                        Tune · Train · Reset
                    </h3>

                    <p>
                        The complete treatment roadmap. Covers the three
                        biological systems, Tune/Train/Reset framework,
                        daily structure, nutrition, supplements, and
                        setbacks.
                    </p>

                    <a
                        href="https://youtu.be/hnXgfngtUlA"
                        class="brain-health-card__button"
                    >
                        TTR
                        <span aria-hidden="true">→</span>
                    </a>

                </div>

            </section>

        </div>

    </section>


    <!-- =====================================================
         CONSULTATION
    ====================================================== -->

  


    <!-- =====================================================
         EXISTING CONTACT SECTION
    ====================================================== -->

    <?php
    get_template_part(
        'template-parts/contact/contact'
    );
    ?>

</main>

<?php get_footer(); ?>