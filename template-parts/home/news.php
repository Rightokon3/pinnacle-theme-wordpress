<?php
/**
 * Homepage — News Articles carousel
 *
 * Uses the Blog Posts custom post type.
 *
 * Desktop:
 * - 2 articles visible
 *
 * Tablet/Mobile:
 * - 1 article visible
 *
 * Content source:
 * - WP Admin → Blog Posts
 */

$news_query = new WP_Query(
    array(
        'post_type'      => 'blog_post',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'order'          => 'DESC',
    )
);

$news_fallback_image_url =
    get_template_directory_uri() . '/assets/images/Health.jpeg';
?>

<section id="news" class="news">

    <?php if ($news_query->have_posts()) : ?>

        <div class="news__carousel">

            <!-- Previous arrow -->
            <button
                type="button"
                class="news__arrow news__arrow--prev"
                aria-label="Previous news article"
            >
                &#10094;
            </button>


            <!-- Carousel viewport -->
            <div class="news__viewport">

                <!-- Moving track -->
                <div class="news__track">

                    <?php while ($news_query->have_posts()) : ?>

                        <?php
                        $news_query->the_post();

                        /*
                         * Featured image
                         */
                        if (has_post_thumbnail()) {

                            $image_url = get_the_post_thumbnail_url(
                                get_the_ID(),
                                'large'
                            );

                            $image_alt = get_the_title();

                        } else {

                            $image_url = $news_fallback_image_url;
                            $image_alt = get_the_title();

                        }


                        /*
                         * Excerpt
                         *
                         * Uses the WordPress excerpt first.
                         * If no excerpt exists, automatically creates
                         * one from the article content.
                         */
                        $excerpt = get_the_excerpt();

                        if (empty($excerpt)) {

                            $excerpt = wp_trim_words(
                                wp_strip_all_tags(
                                    get_the_content()
                                ),
                                28
                            );

                        }


                        /*
                         * Blog category
                         */
                        $categories = get_the_terms(
                            get_the_ID(),
                            'blog_category'
                        );

                        $primary_category = (
                            !empty($categories) &&
                            !is_wp_error($categories)
                        )
                            ? $categories[0]
                            : null;

                        ?>

                        <article class="news__card">

                            <a
                                href="<?php the_permalink(); ?>"
                                class="news__image-link"
                            >

                                <img
                                    src="<?php echo esc_url($image_url); ?>"
                                    alt="<?php echo esc_attr($image_alt); ?>"
                                    class="news__image"
                                    loading="lazy"
                                >

                            </a>


                            <div class="news__body">


                                <!-- Date -->

                                <p class="news__date">

                                    <?php
                                    echo esc_html(
                                        get_the_date('F Y')
                                    );
                                    ?>

                                </p>


                                <!-- Category -->

                                <?php if ($primary_category) : ?>

                                    <a
                                        href="<?php echo esc_url(
                                            get_term_link(
                                                $primary_category,
                                                'blog_category'
                                            )
                                        ); ?>"
                                        class="news__category"
                                    >

                                        <?php
                                        echo esc_html(
                                            $primary_category->name
                                        );
                                        ?>

                                    </a>

                                <?php endif; ?>


                                <!-- Title -->

                                <h3 class="news__title">

                                    <a
                                        href="<?php the_permalink(); ?>"
                                    >
                                        <?php the_title(); ?>
                                    </a>

                                </h3>


                                <!-- Excerpt -->

                                <?php if (!empty($excerpt)) : ?>

                                    <p class="news__excerpt">

                                        <?php
                                        echo esc_html(
                                            wp_trim_words(
                                                $excerpt,
                                                28
                                            )
                                        );
                                        ?>

                                    </p>

                                <?php endif; ?>


                                <!-- Read More -->

                                <a
                                    href="<?php the_permalink(); ?>"
                                    class="news__read-more"
                                >

                                    Read More

                                    <span
                                        aria-hidden="true"
                                    >
                                        →
                                    </span>

                                </a>

                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>

            </div>


            <!-- Next arrow -->

            <button
                type="button"
                class="news__arrow news__arrow--next"
                aria-label="Next news article"
            >
                &#10095;
            </button>

        </div>


        <!-- Dots -->

        <div
            class="news__dots"
            aria-label="News article navigation"
        ></div>


        <!-- View all -->

        <div class="news__view-all-wrap">

            <a
                href="<?php echo esc_url(
                    home_url('/blog/')
                ); ?>"
                class="news__view-all"
            >

                <span>
                    VIEW ALL
                </span>

                <span
                    class="news__view-all-arrow"
                    aria-hidden="true"
                >
                    &#8594;
                </span>

            </a>

        </div>


        <?php wp_reset_postdata(); ?>


    <?php else : ?>

        <!-- No Blog Posts yet -->

        <div class="news__empty">

            <h3>
                Latest News
            </h3>

            <p>
                New blog articles will appear here when they are published.
            </p>

        </div>

    <?php endif; ?>

</section>