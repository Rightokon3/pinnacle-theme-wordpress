<?php
/**
 * Template Name: FAQ Page
 * File: page-faq.php
 *
 * Pinnacle FAQ page.
 *
 * Content is managed from ACF:
 * - faq_banner_image
 * - faq_heading
 * - faq_intro
 * - faq_items
 * - faq_cta_text
 * - faq_cta_link
 */

get_header();


/* =========================================================
   FAQ DATA
   ========================================================= */

$banner_image = get_field('faq_banner_image');

$banner_image_url =
    (
        is_array($banner_image) &&
        !empty($banner_image['url'])
    )
    ? $banner_image['url']
    : get_template_directory_uri() . '/assets/images/back.webp';


$faq_heading =
    get_field('faq_heading')
    ?: 'Frequently Asked Questions';

$faq_intro =
    get_field('faq_intro');


$faq_items =
    get_field('faq_items');


$cta_text =
    get_field('faq_cta_text')
    ?: 'Schedule Consultation';


$cta_link =
    get_field('faq_cta_link')
    ?: home_url('/contact/');

?>

<main class="pinnacle-faq-page">


    <!-- =====================================================
         HERO
    ====================================================== -->

    <section
        class="providers-banner pinnacle-faq-page__banner"
        style="background-image:url('<?php echo esc_url($banner_image_url); ?>');"
    >

        <div class="providers-banner__overlay">

            <div class="providers-banner__inner">

                <h1 class="providers-banner__title">
                    <?php echo esc_html(get_the_title()); ?>
                </h1>

            </div>

        </div>

    </section>


    <!-- =====================================================
         BREADCRUMB
    ====================================================== -->

    <div class="providers-breadcrumb-container pinnacle-faq-page__breadcrumb">

        <p class="providers-banner__breadcrumb">

            <a href="<?php echo esc_url(home_url('/')); ?>">
                Home
            </a>

            <span aria-hidden="true">
                »
            </span>

            <span>
                <?php echo esc_html(get_the_title()); ?>
            </span>

        </p>

    </div>


    <!-- =====================================================
         INTRO
    ====================================================== -->

    <section class="pinnacle-faq-page__intro-section">

        <div class="pinnacle-faq-page__container">

            <div class="pinnacle-faq-page__intro">

                <h2>
                    <?php echo esc_html($faq_heading); ?>
                </h2>


                <?php if ($faq_intro) : ?>

                    <p>
                        <?php echo esc_html($faq_intro); ?>
                    </p>

                <?php endif; ?>

            </div>

        </div>

    </section>


    <!-- =====================================================
         FAQ LIST
    ====================================================== -->

    <section class="pinnacle-faq-page__questions">

        <div class="pinnacle-faq-page__container">

            <?php if (!empty($faq_items)) : ?>

                <div class="pinnacle-faq-list">

                    <?php foreach ($faq_items as $index => $faq) : ?>

                        <?php

                        $question =
                            $faq['question'] ?? '';

                        $answer =
                            $faq['answer'] ?? '';

                        if (!$question) {
                            continue;
                        }

                        $answer_id =
                            'pinnacle-faq-answer-' . $index;

                        ?>

                        <article class="pinnacle-faq-item">


                            <!-- QUESTION -->

                            <button
                                type="button"
                                class="pinnacle-faq-question"
                                aria-expanded="false"
                                aria-controls="<?php echo esc_attr($answer_id); ?>"
                            >

                                <span class="pinnacle-faq-question__text">

                                    <?php
                                    echo esc_html($question);
                                    ?>

                                </span>


                                <span
                                    class="pinnacle-faq-question__icon"
                                    aria-hidden="true"
                                >
                                    +
                                </span>

                            </button>


                            <!-- ANSWER -->

                            <div
                                id="<?php echo esc_attr($answer_id); ?>"
                                class="pinnacle-faq-answer"
                                hidden
                            >

                                <div class="pinnacle-faq-answer__inner">

                                    <?php
                                    echo wp_kses_post($answer);
                                    ?>

                                </div>

                            </div>

                        </article>

                    <?php endforeach; ?>

                </div>


            <?php else : ?>

                <div class="pinnacle-faq-empty">

                    <h3>
                        Frequently Asked Questions
                    </h3>

                    <p>
                        Questions and answers will appear here once they are
                        added in WordPress.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>


    <!-- =====================================================
         BOOK CONSULTATION
    ====================================================== -->

    <section class="pinnacle-faq-page__consultation">

        <div class="pinnacle-faq-page__consultation-inner">

            <div class="pinnacle-faq-page__consultation-text">

                <h2>
                    Book a Consultation
                </h2>

            </div>


            <a
                href="<?php echo esc_url($cta_link); ?>"
                class="pinnacle-faq-page__consultation-button"
            >

                <span>
                    <?php echo esc_html($cta_text); ?>
                </span>

                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <line
                        x1="5"
                        y1="12"
                        x2="19"
                        y2="12"
                    />

                    <polyline
                        points="12 5 19 12 12 19"
                    />

                </svg>

            </a>

        </div>

    </section>


    <!-- =====================================================
         EXISTING CONTACT SECTION
    ====================================================== -->

    <?php
    get_template_part(
        'template-parts/contact/contact'
    );
    ?>

</main>


<!-- =========================================================
     FAQ ACCORDION
========================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const questions =
            document.querySelectorAll(
                '.pinnacle-faq-question'
            );


        questions.forEach(
            function (question) {

                question.addEventListener(
                    'click',
                    function () {

                        const item =
                            question.closest(
                                '.pinnacle-faq-item'
                            );

                        const answerId =
                            question.getAttribute(
                                'aria-controls'
                            );

                        const answer =
                            document.getElementById(
                                answerId
                            );

                        const isOpen =
                            question.getAttribute(
                                'aria-expanded'
                            ) === 'true';


                        /*
                         * Close all FAQ items.
                         */
                        questions.forEach(
                            function (otherQuestion) {

                                const otherAnswerId =
                                    otherQuestion.getAttribute(
                                        'aria-controls'
                                    );

                                const otherAnswer =
                                    document.getElementById(
                                        otherAnswerId
                                    );

                                const otherItem =
                                    otherQuestion.closest(
                                        '.pinnacle-faq-item'
                                    );

                                otherQuestion.setAttribute(
                                    'aria-expanded',
                                    'false'
                                );

                                otherItem.classList.remove(
                                    'is-open'
                                );

                                if (otherAnswer) {
                                    otherAnswer.hidden = true;
                                }

                            }
                        );


                        /*
                         * Open clicked item if it
                         * wasn't already open.
                         */
                        if (!isOpen) {

                            question.setAttribute(
                                'aria-expanded',
                                'true'
                            );

                            item.classList.add(
                                'is-open'
                            );

                            answer.hidden = false;

                        }

                    }
                );

            }
        );

    }
);

</script>


<?php get_footer(); ?>