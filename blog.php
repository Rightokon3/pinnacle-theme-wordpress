<?php
/**
 * Template Name: Blog Archive
 * File: page-blog.php
 *
 * Pinnacle Blog Archive
 */

get_header();


/* =========================================================
   BANNER
   ========================================================= */

$banner_image = get_field('blog_banner_image');

$banner_image_url = (
    is_array($banner_image) &&
    !empty($banner_image['url'])
)
    ? $banner_image['url']
    : get_template_directory_uri() . '/assets/images/back.webp';


/* =========================================================
   PAGINATION
   ========================================================= */

$paged = get_query_var('paged')
    ? get_query_var('paged')
    : (
        get_query_var('page')
            ? get_query_var('page')
            : 1
    );


/* =========================================================
   BLOG QUERY
   ========================================================= */

$blog_query = new WP_Query(
    array(
        'post_type' => 'blog_post',
        'post_status'    => 'publish',
        'posts_per_page' => 8,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    )
);

?>

<main class="blog-page">


    <!-- =====================================================
         BLOG HERO
    ====================================================== -->

    <section
        class="providers-banner blog-page__banner"
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

    <div class="providers-breadcrumb-container blog-page__breadcrumb-wrap">

        <p class="providers-banner__breadcrumb blog-page__breadcrumb">

            <a href="<?php echo esc_url(home_url('/')); ?>">
                Home
            </a>

            <span aria-hidden="true">
                »
            </span>

            <span>
                Blog
            </span>

        </p>

    </div>


    <!-- =====================================================
         BLOG CONTENT
    ====================================================== -->

    <section class="blog-page__content">

        <div class="blog-page__grid">


            <!-- =================================================
                 LEFT COLUMN — POSTS
            ================================================== -->

            <div class="blog-page__posts">

                <?php if ($blog_query->have_posts()) : ?>

                    <?php while ($blog_query->have_posts()) : ?>

                        <?php
                        $blog_query->the_post();

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


                        <article class="blog-post-card">


                            <!-- =================================
                                 FEATURED IMAGE
                            ================================== -->

                            <?php if (has_post_thumbnail()) : ?>

                                <div class="blog-post-card__media">

                                    <a
                                        href="<?php the_permalink(); ?>"
                                        class="blog-post-card__image-link"
                                    >

                                        <?php
                                        the_post_thumbnail(
                                            'medium_large',
                                            array(
                                                'class'   => 'blog-post-card__image',
                                                'loading' => 'lazy',
                                                'alt'     => the_title_attribute(
                                                    array(
                                                        'echo' => false,
                                                    )
                                                ),
                                            )
                                        );
                                        ?>

                                    </a>


                                    <?php if ($primary_category) : ?>

                                        <a
                                            class="blog-post-card__category"
                                            href="<?php echo esc_url(
                                               get_term_link(
                                                   $primary_category,
                                             'blog_category'
                                            )
                                            ); ?>"
                                        >

                                            <?php
                                            echo esc_html(
                                                $primary_category->name
                                            );
                                            ?>

                                        </a>

                                    <?php endif; ?>

                                </div>

                            <?php else : ?>

                                <div class="blog-post-card__media blog-post-card__media--placeholder">

                                    <?php if ($primary_category) : ?>

                                        <a
                                            class="blog-post-card__category"
                                            href="<?php echo esc_url(
                                                get_category_link(
                                                    $primary_category->term_id
                                                )
                                            ); ?>"
                                        >
                                            <?php
                                            echo esc_html(
                                                $primary_category->name
                                            );
                                            ?>
                                        </a>

                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>


                            <!-- =================================
                                 ARTICLE BODY
                            ================================== -->

                            <div class="blog-post-card__body">


                                <h2 class="blog-post-card__title">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php the_title(); ?>

                                    </a>

                                </h2>


                                <?php
                                $excerpt = get_the_excerpt();

                                if (!$excerpt) {
                                    $excerpt = wp_trim_words(
                                        wp_strip_all_tags(
                                            get_the_content()
                                        ),
                                        30
                                    );
                                }
                                ?>


                                <?php if ($excerpt) : ?>

                                    <p class="blog-post-card__excerpt">

                                        <?php
                                        echo esc_html(
                                            wp_trim_words(
                                                $excerpt,
                                                30
                                            )
                                        );
                                        ?>

                                    </p>

                                <?php endif; ?>


                                <a
                                    href="<?php the_permalink(); ?>"
                                    class="blog-post-card__button"
                                >

                                    <span>
                                        READ MORE
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

                        </article>

                    <?php endwhile; ?>


                    <!-- =========================================
                         PAGINATION
                    ========================================== -->

                    <?php

                    $pagination_links = paginate_links(
                        array(
                            'total'     => $blog_query->max_num_pages,
                            'current'   => $paged,
                            'mid_size'  => 1,
                            'end_size'  => 1,
                            'prev_text' => '←',
                            'next_text' => '→',
                            'type'      => 'array',
                        )
                    );

                    ?>

                    <?php if (!empty($pagination_links)) : ?>

                        <nav
                            class="blog-pagination"
                            aria-label="Blog pagination"
                        >

                            <?php foreach ($pagination_links as $link) : ?>

                                <?php
                                echo wp_kses(
                                    $link,
                                    array(
                                        'a' => array(
                                            'href'  => true,
                                            'class' => true,
                                        ),
                                        'span' => array(
                                            'class'       => true,
                                            'aria-current'=> true,
                                        ),
                                    )
                                );
                                ?>

                            <?php endforeach; ?>

                        </nav>

                    <?php endif; ?>


                    <?php wp_reset_postdata(); ?>


                <?php else : ?>

                    <div class="blog-page__empty">

                        <h2>
                            No posts published yet
                        </h2>

                        <p>
                            Your published WordPress posts will appear here automatically.
                        </p>

                    </div>

                <?php endif; ?>

            </div>


            <!-- =================================================
                 RIGHT SIDEBAR
            ================================================== -->

            <aside class="blog-page__sidebar">


                <!-- =============================================
                     SEARCH
                ============================================== -->

                <div class="blog-sidebar-card blog-search-card">

                    <form
                        role="search"
                        method="get"
                        action="<?php echo esc_url(home_url('/')); ?>"
                        class="blog-search"
                    >

                        <label
                            for="blog-search-input"
                            class="sr-only"
                        >
                            Search the blog
                        </label>

                        <input
                            id="blog-search-input"
                            type="search"
                            name="s"
                            value="<?php echo esc_attr(get_search_query()); ?>"
                            placeholder="Search the blog..."
                            class="blog-search__input"
                        >

                        <button
                            type="submit"
                            class="blog-search__button"
                            aria-label="Search"
                        >

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
                                <circle cx="11" cy="11" r="8"/>
                                <line
                                    x1="21"
                                    y1="21"
                                    x2="16.65"
                                    y2="16.65"
                                />
                            </svg>

                        </button>

                    </form>

                </div>


                <!-- =============================================
                     CONTACT
                ============================================== -->

                <div class="blog-sidebar-card blog-contact-card">

                    <h2 class="blog-sidebar-card__title">
                        Contact Us
                    </h2>

                 <?php
if ( function_exists( 'do_shortcode' ) ) {

    echo do_shortcode(
        '[contact-form-7 id="d8dbe66" title="Blog Contact form"]'
    );

}
?>

                </div>


                <!-- =============================================
                     CATEGORIES
                ============================================== -->

<?php

$blog_categories = get_terms(
    array(
        'taxonomy'   => 'blog_category',
        'hide_empty' => true,
    )
);

?>

<?php if (!empty($blog_categories) && !is_wp_error($blog_categories)) : ?>

    <div class="blog-sidebar-card blog-categories-card">

        <h2 class="blog-sidebar-card__title">
            Categories
        </h2>

        <ul class="blog-categories">

            <?php foreach ($blog_categories as $category) : ?>

                <li>

                    <a
                        href="<?php echo esc_url(
                            get_term_link(
                                $category,
                                'blog_category'
                            )
                        ); ?>"
                    >

                        <span>
                            <?php echo esc_html($category->name); ?>
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

                </li>

            <?php endforeach; ?>

        </ul>

    </div>

<?php endif; ?>


                <?php if (!empty($blog_categories)) : ?>

                    <div class="blog-sidebar-card blog-categories-card">

                        <h2 class="blog-sidebar-card__title">
                            Categories
                        </h2>


                        <ul class="blog-categories">

                            <?php foreach ($blog_categories as $category) : ?>

                                <li>

                                    <a
                                        href="<?php echo esc_url(
                                            get_category_link(
                                                $category->term_id
                                            )
                                        ); ?>"
                                    >

                                        <span>
                                            <?php
                                            echo esc_html(
                                                $category->name
                                            );
                                            ?>
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

                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>


                <!-- =============================================
                     BOOK CONSULTATION
                ============================================== -->

                <div class="blog-sidebar-card blog-consultation-card">

                    <h2 class="blog-sidebar-card__title">
                        Book a Consultation
                    </h2>

                    <p>
                        Ready to take the next step toward better mental health?
                    </p>

                    <a
                        href="<?php echo esc_url(home_url('/contact/')); ?>"
                        class="blog-consultation-card__button"
                    >

                        <span>
                            SCHEDULE CONSULTATION
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

            </aside>

        </div>

    </section>


    <!-- =====================================================
         EXISTING CONTACT SECTION / MAP
    ====================================================== -->

    <?php
    get_template_part(
        'template-parts/contact/contact'
    );
    ?>

</main>


<?php get_footer(); ?>