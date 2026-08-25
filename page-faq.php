<?php
/**
 * Template Name: FAQ Page
 * File: page-faq.php
 *
 * Pinnacle FAQ page.
 *
 * Page-level content is managed from ACF (group_faq_page):
 * - faq_banner_image
 * - faq_heading
 * - faq_intro
 * - faq_cta_text
 * - faq_cta_link
 *
 * Individual questions/answers are managed via the "FAQ" custom
 * post type (post_type = faq). Each FAQ post's Title is the
 * question and its main content editor is the answer. Order is
 * controlled with the built-in "Order" field (page-attributes).
 */

get_header();


/* =========================================================
   PAGE-LEVEL FAQ CONTENT (ACF)
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


$cta_text =
    get_field('faq_cta_text')
    ?: 'Schedule Consultation';


$cta_link =
    get_field('faq_cta_link')
    ?: home_url('/contact/');


/* =========================================================
   INDIVIDUAL FAQ ITEMS (CPT)
   ========================================================= */

$faq_query = new WP_Query(array(
    'post_type'      => 'faq',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
));

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
         PAGE-LEVEL SHARE
    ====================================================== -->

    <div class="pinnacle-faq-page__container">

        <?php
        pinnacle_render_share_buttons(
            get_permalink(),
            $faq_heading
        );
        ?>

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

            <?php if ($faq_query->have_posts()) : ?>

                <div class="pinnacle-faq-list">

                    <?php while ($faq_query->have_posts()) : $faq_query->the_post(); ?>

                        <?php

                        $answer_id =
                            'pinnacle-faq-answer-' . get_the_ID();

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
                                    the_title();
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
                                    pinnacle_render_share_buttons(
                                        get_permalink() . '#' . $answer_id,
                                        get_the_title()
                                    );
                                    ?>

                                    <?php
                                    the_content();
                                    ?>

                                </div>

                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>


            <?php

            wp_reset_postdata();

            else : ?>

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
         EXISTING CONTACT SECTION
    ====================================================== -->

    <?php
    get_template_part(
        'template-parts/contact/contact'
    );
    ?>

</main>


<!-- =========================================================
     SHARE PANEL (networks) + COPY SHORT LINK PANEL
     Single shared pair of modals for the whole page. JS fills
     in each network's href / the copy input based on whichever
     share row was clicked (page-level or a specific FAQ item).
========================================================== -->

<div class="pinnacle-share-modal" id="pinnacle-share-modal" hidden>

    <div class="pinnacle-share-modal__overlay" data-modal-close></div>

    <div class="pinnacle-share-modal__panel">

        <button type="button" class="pinnacle-share-modal__close" data-modal-close aria-label="Close">
            &times;
        </button>

        <h3 class="pinnacle-share-modal__title">Share</h3>

        <div class="pinnacle-share-modal__grid" id="pinnacle-share-modal-grid">
            <!-- links injected by JS -->
        </div>

    </div>

</div>

<div class="pinnacle-share-modal" id="pinnacle-copy-modal" hidden>

    <div class="pinnacle-share-modal__overlay" data-modal-close></div>

    <div class="pinnacle-share-modal__panel pinnacle-share-modal__panel--narrow">

        <button type="button" class="pinnacle-share-modal__close" data-modal-close aria-label="Close">
            &times;
        </button>

        <h3 class="pinnacle-share-modal__title">Copy short link</h3>

        <div class="pinnacle-copy-modal__row">

            <input
                type="text"
                id="pinnacle-copy-modal-input"
                class="pinnacle-copy-modal__input"
                readonly
            >

            <button
                type="button"
                class="pinnacle-copy-modal__button"
                id="pinnacle-copy-modal-button"
            >
                Copy link
            </button>

        </div>

    </div>

</div>


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


<!-- =========================================================
     SHARE PANELS: "MORE" NETWORKS + "COPY SHORT LINK"
========================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const shareModal = document.getElementById('pinnacle-share-modal');
        const shareGrid = document.getElementById('pinnacle-share-modal-grid');
        const copyModal = document.getElementById('pinnacle-copy-modal');
        const copyInput = document.getElementById('pinnacle-copy-modal-input');
        const copyButton = document.getElementById('pinnacle-copy-modal-button');

        /*
         * Networks shown in the "+" panel. Each gets its
         * share URL built at open-time from whichever
         * share row was clicked.
         */
        const networks = [
            {
                label: 'X / Twitter',
                build: function (url, title) {
                    return 'https://twitter.com/intent/tweet?url=' + url + '&text=' + title;
                }
            },
            {
                label: 'LinkedIn',
                build: function (url) {
                    return 'https://www.linkedin.com/sharing/share-offsite/?url=' + url;
                }
            },
            {
                label: 'WhatsApp',
                build: function (url, title) {
                    return 'https://wa.me/?text=' + title + '%20' + url;
                }
            },
            {
                label: 'Telegram',
                build: function (url, title) {
                    return 'https://t.me/share/url?url=' + url + '&text=' + title;
                }
            },
            {
                label: 'Reddit',
                build: function (url, title) {
                    return 'https://www.reddit.com/submit?url=' + url + '&title=' + title;
                }
            },
            {
                label: 'Tumblr',
                build: function (url, title) {
                    return 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' + url + '&title=' + title;
                }
            },
            {
                label: 'Email',
                build: function (url, title) {
                    return 'mailto:?subject=' + title + '&body=' + url;
                }
            },
            {
                label: 'SMS',
                build: function (url, title) {
                    return 'sms:?&body=' + title + '%20' + url;
                }
            },
            {
                label: 'Print',
                build: function (url) {
                    return 'javascript:void(0)';
                },
                isPrint: true
            }
        ];

        function openModal(modal) {
            modal.hidden = false;
            requestAnimationFrame(function () {
                modal.classList.add('is-open');
            });
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modal) {
            modal.classList.remove('is-open');
            document.body.style.overflow = '';
            setTimeout(function () {
                modal.hidden = true;
            }, 200);
        }

        document.querySelectorAll('[data-modal-close]').forEach(function (el) {
            el.addEventListener('click', function () {
                closeModal(el.closest('.pinnacle-share-modal'));
            });
        });

        document.querySelectorAll('.pinnacle-share-more-trigger').forEach(function (button) {
            button.addEventListener('click', function () {

                const row = button.closest('.share-section__buttons');
                const url = encodeURIComponent(row.getAttribute('data-share-url'));
                const title = encodeURIComponent(row.getAttribute('data-share-title'));

                shareGrid.innerHTML = '';

                networks.forEach(function (network) {

                    const link = document.createElement('a');
                    link.className = 'pinnacle-share-modal__link';
                    link.textContent = network.label;

                    if (network.isPrint) {
                        link.href = '#';
                        link.addEventListener('click', function (event) {
                            event.preventDefault();
                            window.print();
                        });
                    } else {
                        link.href = network.build(url, title);
                        link.target = '_blank';
                        link.rel = 'noopener noreferrer';
                    }

                    shareGrid.appendChild(link);

                });

                openModal(shareModal);

            });
        });

        document.querySelectorAll('.pinnacle-copy-link-trigger').forEach(function (button) {
            button.addEventListener('click', function () {

                const row = button.closest('.share-section__buttons');
                const url = row.getAttribute('data-share-url');

                copyInput.value = url;

                openModal(copyModal);

            });
        });

        copyButton.addEventListener('click', function () {

            copyInput.select();

            if (navigator.clipboard) {
                navigator.clipboard.writeText(copyInput.value);
            }

            const original = copyButton.textContent;
            copyButton.textContent = 'Copied!';

            setTimeout(function () {
                copyButton.textContent = original;
            }, 1500);

        });

    }
);

</script>


<?php get_footer(); ?>