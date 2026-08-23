<?php
/**
 * Pinnacle Behavioral Healthcare
 * Custom Search Results
 */

get_header();

$search_term = trim( get_search_query() );

$search_post_types = array(
    'page',
    'post',
    'blog_post',
    'provider',
);

/*
 * =========================================================
 * EXACT TITLE MATCHES
 * =========================================================
 *
 * We run a separate query first so:
 *
 * Search: insurance
 *
 * will prioritize a page/post titled exactly:
 *
 * Insurance
 * Insurance Accepted
 * Insurance Verification
 */

$exact_query = new WP_Query(
    array(
        'post_type'      => $search_post_types,
        'post_status'    => 'publish',
        'posts_per_page' => 20,
        's'              => '',
        'post__not_in'   => array(),
    )
);

$exact_matches = array();

if ( $exact_query->have_posts() && $search_term !== '' ) {

    foreach ( $exact_query->posts as $exact_post ) {

        $title = trim(
            wp_strip_all_tags(
                get_the_title( $exact_post )
            )
        );

        /*
         * Exact title.
         */
        if (
            mb_strtolower( $title ) ===
            mb_strtolower( $search_term )
        ) {
            $exact_matches[] = $exact_post;
        }

    }
}


/*
 * =========================================================
 * NORMAL SEARCH RESULTS
 * =========================================================
 */

$paged = max(
    1,
    (int) get_query_var( 'paged' )
);

$normal_query = new WP_Query(
    array(
        'post_type'      => $search_post_types,
        'post_status'    => 'publish',
        'posts_per_page' => 10,
        'paged'          => $paged,
        's'              => $search_term,
        'post__not_in'   => wp_list_pluck(
            $exact_matches,
            'ID'
        ),
        'orderby'        => 'date',
        'order'          => 'DESC',
    )
);


/*
 * =========================================================
 * HELPERS
 * =========================================================
 */

function pinnacle_search_result_type( $post ) {

    $post_type = get_post_type( $post );

    switch ( $post_type ) {

        case 'blog_post':
            return 'Blog';

        case 'provider':
            return 'Provider';

        case 'page':
            return 'Page';

        case 'post':
            return 'Article';

        default:
            return 'Result';
    }
}


function pinnacle_search_result_excerpt( $post ) {

    $excerpt = get_the_excerpt( $post );

    if ( ! $excerpt ) {

        $excerpt = wp_trim_words(
            wp_strip_all_tags(
                get_post_field(
                    'post_content',
                    $post
                )
            ),
            32
        );

    }

    return $excerpt;
}

?>

<main class="search-page">

    <!-- =====================================================
         SEARCH HERO
    ====================================================== -->

    <section class="search-page__hero">

        <div class="search-page__hero-overlay"></div>

        <div class="search-page__container">

            <h1 class="search-page__hero-title">
                Search Results
            </h1>

        </div>

    </section>


    <!-- =====================================================
         SEARCH CONTENT
    ====================================================== -->

    <section class="search-page__content">

        <div class="search-page__container">

            <div class="search-page__grid">


                <!-- =================================================
                     RESULTS
                ================================================== -->

                <div class="search-page__results">

                    <div class="search-page__query-heading">

                        Search Results For:

                        <span>
                            <?php echo esc_html( $search_term ); ?>
                        </span>

                    </div>


                    <!-- =================================================
                         SEARCH BOX
                    ================================================== -->

                    <form
                        class="search-page__form"
                        role="search"
                        method="get"
                        action="<?php echo esc_url( home_url( '/' ) ); ?>"
                    >

                        <label
                            for="search-page-input"
                            class="screen-reader-text"
                        >
                            Search the website
                        </label>

                        <input
                            id="search-page-input"
                            class="search-page__input"
                            type="search"
                            name="s"
                            value="<?php echo esc_attr( $search_term ); ?>"
                            placeholder="Search..."
                            autocomplete="off"
                        >

                        <button
                            type="submit"
                            class="search-page__submit"
                        >
                            Search
                        </button>

                    </form>


                    <!-- =================================================
                         EXACT MATCHES
                    ================================================== -->

                    <?php if ( ! empty( $exact_matches ) ) : ?>

                        <div class="search-page__section-label">
                            Best Match
                        </div>

                        <?php foreach ( $exact_matches as $result ) : ?>

                            <?php
                            $title =
                                get_the_title( $result );

                            $type =
                                pinnacle_search_result_type(
                                    $result
                                );

                            $excerpt =
                                pinnacle_search_result_excerpt(
                                    $result
                                );

                            $thumbnail =
                                get_the_post_thumbnail_url(
                                    $result,
                                    'large'
                                );
                            ?>

                            <article
                                class="search-result-card search-result-card--exact"
                            >

                                <?php if ( $thumbnail ) : ?>

                                    <a
                                        class="search-result-card__image"
                                        href="<?php echo esc_url(
                                            get_permalink( $result )
                                        ); ?>"
                                    >

                                        <img
                                            src="<?php echo esc_url(
                                                $thumbnail
                                            ); ?>"
                                            alt="<?php echo esc_attr(
                                                $title
                                            ); ?>"
                                            loading="lazy"
                                        >

                                    </a>

                                <?php endif; ?>


                                <div class="search-result-card__body">

                                    <span class="search-result-card__type">
                                        <?php echo esc_html( $type ); ?>
                                    </span>

                                    <h2 class="search-result-card__title">

                                        <a
                                            href="<?php echo esc_url(
                                                get_permalink( $result )
                                            ); ?>"
                                        >
                                            <?php echo esc_html(
                                                $title
                                            ); ?>
                                        </a>

                                    </h2>

                                    <?php if ( $excerpt ) : ?>

                                        <p class="search-result-card__excerpt">
                                            <?php echo esc_html(
                                                $excerpt
                                            ); ?>
                                        </p>

                                    <?php endif; ?>

                                    <a
                                        class="search-result-card__link"
                                        href="<?php echo esc_url(
                                            get_permalink( $result )
                                        ); ?>"
                                    >
                                        <span>
                                            <?php
                                            echo (
                                                get_post_type(
                                                    $result
                                                ) === 'blog_post'
                                            )
                                                ? 'READ ARTICLE'
                                                : 'VIEW PAGE';
                                            ?>
                                        </span>

                                        <span aria-hidden="true">
                                            →
                                        </span>
                                    </a>

                                </div>

                            </article>

                        <?php endforeach; ?>

                    <?php endif; ?>


                    <!-- =================================================
                         NORMAL RESULTS
                    ================================================== -->

                    <?php if ( $normal_query->have_posts() ) : ?>

                        <div class="search-page__section-label">

                            <?php
                            echo ! empty( $exact_matches )
                                ? 'More Results'
                                : 'Results';
                            ?>

                        </div>


                        <?php while (
                            $normal_query->have_posts()
                        ) : ?>

                            <?php
                            $normal_query->the_post();

                            $result_type =
                                pinnacle_search_result_type(
                                    get_post()
                                );

                            $result_excerpt =
                                pinnacle_search_result_excerpt(
                                    get_post()
                                );

                            $thumbnail =
                                get_the_post_thumbnail_url(
                                    get_the_ID(),
                                    'large'
                                );
                            ?>

                            <article
                                <?php post_class(
                                    'search-result-card',
                                    get_the_ID()
                                ); ?>
                            >

                                <?php if ( $thumbnail ) : ?>

                                    <a
                                        class="search-result-card__image"
                                        href="<?php the_permalink(); ?>"
                                    >

                                        <img
                                            src="<?php echo esc_url(
                                                $thumbnail
                                            ); ?>"
                                            alt="<?php the_title_attribute(); ?>"
                                            loading="lazy"
                                        >

                                    </a>

                                <?php endif; ?>


                                <div class="search-result-card__body">

                                    <span class="search-result-card__type">
                                        <?php echo esc_html(
                                            $result_type
                                        ); ?>
                                    </span>


                                    <h2 class="search-result-card__title">

                                        <a href="<?php the_permalink(); ?>">

                                            <?php the_title(); ?>

                                        </a>

                                    </h2>


                                    <?php if ( $result_excerpt ) : ?>

                                        <p class="search-result-card__excerpt">

                                            <?php echo esc_html(
                                                wp_trim_words(
                                                    $result_excerpt,
                                                    35
                                                )
                                            ); ?>

                                        </p>

                                    <?php endif; ?>


                                    <a
                                        href="<?php the_permalink(); ?>"
                                        class="search-result-card__link"
                                    >

                                        <span>

                                            <?php
                                            echo (
                                                get_post_type()
                                                === 'blog_post'
                                            )
                                                ? 'READ ARTICLE'
                                                : 'VIEW PAGE';
                                            ?>

                                        </span>

                                        <span aria-hidden="true">
                                            →
                                        </span>

                                    </a>

                                </div>

                            </article>

                        <?php endwhile; ?>


                        <!-- PAGINATION -->

                        <?php
                        $pagination =
                            paginate_links(
                                array(
                                    'total' =>
                                        $normal_query->max_num_pages,
                                    'current' =>
                                        $paged,
                                    'mid_size' => 1,
                                    'end_size' => 1,
                                    'prev_text' => '←',
                                    'next_text' => '→',
                                    'type' => 'list',
                                )
                            );
                        ?>

                        <?php if ( $pagination ) : ?>

                            <nav
                                class="search-pagination"
                                aria-label="Search pagination"
                            >
                                <?php
                                echo wp_kses_post(
                                    $pagination
                                );
                                ?>
                            </nav>

                        <?php endif; ?>


                        <?php
                        wp_reset_postdata();
                        ?>


                    <?php elseif ( empty( $exact_matches ) ) : ?>

                        <!-- NO RESULTS -->

                        <div class="search-page__empty">

                            <h2>
                                No results found
                            </h2>

                            <p>
                                We couldn't find anything matching
                                "<?php echo esc_html(
                                    $search_term
                                ); ?>".
                            </p>

                            <a
                                href="<?php echo esc_url(
                                    home_url( '/' )
                                ); ?>"
                                class="search-page__empty-button"
                            >
                                Return Home
                            </a>

                        </div>

                    <?php endif; ?>

                </div>


                <!-- =================================================
                     SIDEBAR
                ================================================== -->

                <aside class="search-page__sidebar">


                    <!-- SEARCH -->

                    <div class="search-sidebar-card search-sidebar-card--search">

                        <form
                            role="search"
                            method="get"
                            action="<?php echo esc_url(
                                home_url( '/' )
                            ); ?>"
                            class="search-sidebar-form"
                        >

                            <input
                                type="search"
                                name="s"
                                value="<?php echo esc_attr(
                                    $search_term
                                ); ?>"
                                placeholder="Search..."
                                aria-label="Search"
                            >

                            <button type="submit" aria-label="Submit search">
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <circle
                                        cx="11"
                                        cy="11"
                                        r="8"
                                    ></circle>

                                    <line
                                        x1="21"
                                        y1="21"
                                        x2="16.65"
                                        y2="16.65"
                                    ></line>
                                </svg>
                            </button>

                        </form>

                    </div>


                    <!-- CONTACT -->

                    <div class="search-sidebar-card search-sidebar-card--contact">

                        <h2>
                            Contact Us
                        </h2>

                        <?php
                        get_template_part(
                            'template-parts/contact/contact-form'
                        );
                        ?>

                    </div>


                    <!-- PRACTICE AREAS -->

                    <div class="search-sidebar-card search-sidebar-card--areas">

                        <h2>
                            Practice Areas
                        </h2>

                        <ul>

                            <li>
                                <a
                                    href="<?php echo esc_url(
                                        home_url(
                                            '/providers/'
                                        )
                                    ); ?>"
                                >
                                    <span>
                                        Our Providers
                                    </span>

                                    <span>
                                        →
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a
                                    href="<?php echo esc_url(
                                        home_url(
                                            '/services/'
                                        )
                                    ); ?>"
                                >
                                    <span>
                                        Our Services
                                    </span>

                                    <span>
                                        →
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a
                                    href="<?php echo esc_url(
                                        home_url(
                                            '/dispensary/'
                                        )
                                    ); ?>"
                                >
                                    <span>
                                        Our Supplements
                                    </span>

                                    <span>
                                        →
                                    </span>
                                </a>
                            </li>

                        </ul>

                    </div>

                </aside>

            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>