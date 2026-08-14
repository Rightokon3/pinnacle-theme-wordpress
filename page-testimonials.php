<?php
/**
 * Template Name: Testimonials
 * File: page-testimonials.php
 */

get_header();


/* =========================================================
 * BANNER
 * ========================================================= */

$banner_image =
    get_template_directory_uri()
    . '/assets/images/back.webp';


$custom_banner =
    get_field(
        'testimonials_banner_image'
    );


if (
    is_array( $custom_banner )
    && ! empty( $custom_banner['url'] )
) {
    $banner_image =
        $custom_banner['url'];
}


/* =========================================================
 * TESTIMONIAL QUERY
 * ========================================================= */

$testimonial_query = new WP_Query(
    array(
        'post_type'      => 'testimonial',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    )
);

?>

<main class="pinnacle-testimonials-page">


    <!-- =====================================================
         HERO
    ====================================================== -->

    <section
        class="pinnacle-testimonials-banner"
        style="background-image:url('<?php echo esc_url( $banner_image ); ?>');"
    >

        <div class="pinnacle-testimonials-banner__overlay">

            <div class="pinnacle-testimonials-container">

                <h1 class="pinnacle-testimonials-banner__title">
                    Testimonials
                </h1>

            </div>

        </div>

    </section>


    <!-- =====================================================
         BREADCRUMB
    ====================================================== -->

    <div class="pinnacle-testimonials-breadcrumb">

        <div class="pinnacle-testimonials-container">

            <p>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    Home
                </a>

                <span aria-hidden="true">
                    »
                </span>

                <span>
                    Testimonials
                </span>

            </p>

        </div>

    </div>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <section class="pinnacle-testimonials-content">

        <div class="pinnacle-testimonials-container">


            <!-- PAGE SHARE -->

            <div class="pinnacle-testimonials-share">

                <h2>
                    Share and Enjoy !
                </h2>

                <div class="pinnacle-testimonials-share__buttons">

                    <span class="pinnacle-share-count">

                        <span>
                            ↗
                        </span>

                        <small>
                            SHARES
                        </small>

                    </span>


                    <a
                        href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="share-facebook"
                        aria-label="Share on Facebook"
                    >
                        f
                    </a>


                    <a
                        href="https://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink() ); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="share-pinterest"
                        aria-label="Share on Pinterest"
                    >
                        p
                    </a>


                    <button
                        type="button"
                        class="share-pdf"
                        onclick="window.print();"
                    >
                        PDF
                    </button>


                    <button
                        type="button"
                        class="share-copy"
                        onclick="
                            if (navigator.clipboard) {
                                navigator.clipboard.writeText(
                                    window.location.href
                                );
                            }
                        "
                        aria-label="Copy link"
                    >
                        🔗
                    </button>


                    <button
                        type="button"
                        class="share-more"
                        onclick="
                            if (navigator.share) {
                                navigator.share({
                                    title: document.title,
                                    url: window.location.href
                                });
                            }
                        "
                        aria-label="More sharing options"
                    >
                        +
                    </button>

                </div>

            </div>


            <!-- =================================================
                 TESTIMONIAL CARDS
            ================================================== -->

            <?php if ( $testimonial_query->have_posts() ) : ?>

                <div
                    class="pinnacle-testimonials-list"
                    id="pinnacle-testimonials-list"
                >

                    <?php

                    $testimonial_index = 0;

                    while (
                        $testimonial_query->have_posts()
                    ) :

                        $testimonial_query->the_post();

                        $testimonial_index++;

                        $reviewer_name =
                            get_post_meta(
                                get_the_ID(),
                                '_testimonial_reviewer_name',
                                true
                            );


                        $source =
                            get_post_meta(
                                get_the_ID(),
                                '_testimonial_source',
                                true
                            );


                        if ( ! $reviewer_name ) {

                            $reviewer_name =
                                get_the_title();

                        }


                        if ( ! $source ) {

                            $source =
                                'Google';

                        }

                        ?>


                        <article
                            class="pinnacle-testimonial-card <?php echo $testimonial_index > 5 ? 'is-hidden-testimonial' : ''; ?>"
                        >


                            <!-- QUOTE MARK -->

                            <div
                                class="pinnacle-testimonial-card__quote"
                                aria-hidden="true"
                            >
                                “
                            </div>


                            <!-- TITLE -->

                            <h2 class="pinnacle-testimonial-card__heading">
                                Share and Enjoy !
                            </h2>


                            <!-- SHARE -->

                            <div
                                class="pinnacle-testimonial-card__share"
                            >

                                <span class="pinnacle-share-count">

                                    <span>
                                        ↗
                                    </span>

                                    <small>
                                        SHARES
                                    </small>

                                </span>


                                <a
                                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="share-facebook"
                                    aria-label="Share on Facebook"
                                >
                                    f
                                </a>


                                <a
                                    href="https://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink() ); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="share-pinterest"
                                    aria-label="Share on Pinterest"
                                >
                                    p
                                </a>


                                <button
                                    type="button"
                                    class="share-pdf"
                                    onclick="window.print();"
                                >
                                    PDF
                                </button>


                                <button
                                    type="button"
                                    class="share-copy"
                                    onclick="
                                        if (navigator.clipboard) {
                                            navigator.clipboard.writeText(
                                                window.location.href
                                            );
                                        }
                                    "
                                    aria-label="Copy link"
                                >
                                    🔗
                                </button>


                                <button
                                    type="button"
                                    class="share-more"
                                    onclick="
                                        if (navigator.share) {
                                            navigator.share({
                                                title: document.title,
                                                url: window.location.href
                                            });
                                        }
                                    "
                                    aria-label="More sharing options"
                                >
                                    +
                                </button>

                            </div>


                            <!-- REVIEW -->

                            <div
                                class="pinnacle-testimonial-card__text"
                            >

                                <?php
                                the_content();
                                ?>

                            </div>


                            <!-- NAME -->

                            <div
                                class="pinnacle-testimonial-card__footer"
                            >

                                <strong>
                                    <?php
                                    echo esc_html(
                                        $reviewer_name
                                    );
                                    ?>
                                </strong>


                                <?php if ( $source ) : ?>

                                    <span
                                        class="pinnacle-testimonial-card__source"
                                    >

                                        <?php
                                        echo esc_html(
                                            $source
                                        );
                                        ?>

                                    </span>

                                <?php endif; ?>

                            </div>

                        </article>


                    <?php endwhile; ?>

                </div>


                <?php wp_reset_postdata(); ?>


                <!-- LOAD MORE -->

                <?php if ( $testimonial_index > 5 ) : ?>

                    <div class="pinnacle-testimonials-load-more-wrap">

                        <button
                            type="button"
                            id="pinnacle-load-more"
                            class="pinnacle-testimonials-load-more"
                        >
                            Load More
                        </button>

                    </div>

                <?php endif; ?>


            <?php else : ?>

                <div class="pinnacle-testimonials-empty">

                    <h2>
                        Testimonials
                    </h2>

                    <p>
                        Testimonials will appear here once they are
                        published.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>


    <!-- =====================================================
         BOOK CONSULTATION
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


<!-- =========================================================
     LOAD MORE JAVASCRIPT
========================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const button =
            document.getElementById(
                'pinnacle-load-more'
            );

        const hiddenCards =
            document.querySelectorAll(
                '.is-hidden-testimonial'
            );


        if (
            !button ||
            !hiddenCards.length
        ) {
            return;
        }


        let visibleCount = 0;

        const amountPerClick = 5;


        button.addEventListener(
            'click',
            function () {

                const end =
                    Math.min(
                        visibleCount + amountPerClick,
                        hiddenCards.length
                    );


                for (
                    let i = visibleCount;
                    i < end;
                    i++
                ) {

                    hiddenCards[i].classList.remove(
                        'is-hidden-testimonial'
                    );

                    hiddenCards[i].classList.add(
                        'testimonial-revealed'
                    );

                }


                visibleCount = end;


                if (
                    visibleCount >=
                    hiddenCards.length
                ) {

                    button.remove();

                }

            }
        );

    }
);

</script>


<?php get_footer(); ?>