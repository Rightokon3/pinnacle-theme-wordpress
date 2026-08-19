<?php
/**
 * Single Blog Post
 * Pinnacle Behavioral Healthcare
 *
 * Matches the Pinnacle blog article design:
 *
 * Header
 * Blog banner
 * Article title
 * Share and Enjoy
 * Article content
 * Search sidebar
 * Contact Us sidebar
 * Categories sidebar
 */

get_header();


/* =========================================================
   BLOG CATEGORY
   ========================================================= */

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


/* =========================================================
   BANNER
   ========================================================= */

$banner_image = get_field(
    'blog_banner_image',
    'option'
);

$banner_image_url = (
    is_array($banner_image) &&
    !empty($banner_image['url'])
)
    ? $banner_image['url']
    : get_template_directory_uri() . '/assets/images/back.webp';

?>

<main class="single-blog-page">


    <!-- =====================================================
         BLOG BANNER
    ====================================================== -->

    <section
        class="providers-banner blog-page__banner"
        style="background-image:url('<?php echo esc_url($banner_image_url); ?>');"
    >

        <div class="providers-banner__overlay">

            <div class="providers-banner__inner">

                <h1 class="providers-banner__title">
                    Blog
                </h1>

            </div>

        </div>

    </section>


    <!-- =====================================================
         ARTICLE AREA
    ====================================================== -->

    <section class="single-blog">

        <div class="single-blog__grid">


            <!-- =================================================
                 MAIN ARTICLE
            ================================================== -->

            <article class="single-blog__main">

                <?php while (have_posts()) : the_post(); ?>


                    <!-- =========================================
                         TITLE
                    ========================================== -->

                    <h1 class="single-blog__title">

                        <?php the_title(); ?>

                    </h1>


                    <!-- =========================================
                         SHARE
                    ========================================== -->

                    <section class="share-section">

                        <h2 class="share-section__title">
                            Share and Enjoy !
                        </h2>


                        <div class="share-section__buttons">

                            <span class="share-section__label">
                                SHARES
                            </span>


                            <!-- Facebook -->

                            <a
                                class="share-btn share-btn--facebook"
                                href="https://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>"
                                target="_blank"
                                rel="noopener"
                                aria-label="Share on Facebook"
                            >

                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/>
                                </svg>

                            </a>


                            <!-- Pinterest -->

                            <a
                                class="share-btn share-btn--pinterest"
                                href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>"
                                target="_blank"
                                rel="noopener"
                                aria-label="Share on Pinterest"
                            >

                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="M12 2C6.5 2 2 6 2 11.3c0 3.9 2.2 6.8 5.6 8 .1-.9.1-1.6 0-2.4l-.9-3.5s-.2-.7-.2-1.7c0-1.6 1-2.9 2.2-2.9 1 0 1.5.8 1.5 1.7 0 1-.7 2.5-1 3.9-.3 1.2.6 2.2 1.8 2.2 2.1 0 3.7-2.2 3.7-5.5 0-2.9-2.1-4.9-5-4.9-3.4 0-5.5 2.6-5.5 5.2 0 1 .4 2.1.9 2.7.1.1.1.2.1.3-.1.4-.3 1.2-.3 1.4-.1.2-.2.2-.4.1-1.5-.7-2.4-2.9-2.4-4.6C4.7 7.1 7.4 4 12.6 4c4.1 0 7.4 3 7.4 6.9 0 4.1-2.6 7.4-6.2 7.4-1.2 0-2.4-.6-2.7-1.4l-.8 3c-.3 1.1-1 2.4-1.5 3.1.9.3 1.9.5 2.9.5 5.5 0 10-4.5 10-10S17.5 2 12 2z"/>
                                </svg>

                            </a>


                            <!-- PDF -->

                            <button
                                type="button"
                                class="share-btn share-btn--pdf"
                                onclick="window.print()"
                                aria-label="Print or save as PDF"
                            >

                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >

                                    <path d="M6 9V2h9l5 5v2"/>

                                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>

                                    <rect
                                        x="6"
                                        y="14"
                                        width="12"
                                        height="8"
                                    />

                                </svg>

                            </button>


                            <!-- Copy -->

                            <button
                                type="button"
                                class="share-btn share-btn--copy"
                                data-copy-link="<?php echo esc_url(get_permalink()); ?>"
                                aria-label="Copy article link"
                            >

                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >

                                    <rect
                                        x="9"
                                        y="9"
                                        width="13"
                                        height="13"
                                        rx="2"
                                    />

                                    <path
                                        d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"
                                    />

                                </svg>

                            </button>


                            <!-- More -->

                            <button
                                type="button"
                                class="share-btn share-btn--more"
                                aria-label="More sharing options"
                            >

                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2.4"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >

                                    <line
                                        x1="12"
                                        y1="5"
                                        x2="12"
                                        y2="19"
                                    />

                                    <line
                                        x1="5"
                                        y1="12"
                                        x2="19"
                                        y2="12"
                                    />

                                </svg>

                            </button>

                        </div>

                    </section>


                    <!-- =========================================
                         ARTICLE CONTENT
                    ========================================== -->

                    <div class="single-blog__content">

                        <?php the_content(); ?>

                    </div>


                <?php endwhile; ?>

            </article>


            <!-- =================================================
                 SIDEBAR
            ================================================== -->

            <aside class="single-blog__sidebar">


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
                            for="single-blog-search"
                            class="sr-only"
                        >
                            Search the blog
                        </label>

                        <input
                            id="single-blog-search"
                            type="search"
                            name="s"
                            value="<?php echo esc_attr(get_search_query()); ?>"
                            placeholder="Search"
                            class="blog-search__input"
                        >

                        <button
                            type="submit"
                            class="blog-search__button"
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

                                <circle
                                    cx="11"
                                    cy="11"
                                    r="8"
                                />

                                <line
                                    x1="21"
                                    y1="21"
                                    x2="16.65"
                                    y2="16.65"
                                />

                            </svg>

                            <span>
                                SUBMIT
                            </span>

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


                    <form
                        class="blog-contact-form"
                        method="post"
                        action=""
                    >

                        <label>

                            <span class="sr-only">
                                First Name
                            </span>

                            <input
                                type="text"
                                name="first_name"
                                placeholder="First Name*"
                                required
                            >

                        </label>


                        <label>

                            <span class="sr-only">
                                Last Name
                            </span>

                            <input
                                type="text"
                                name="last_name"
                                placeholder="Last Name*"
                                required
                            >

                        </label>


                        <label>

                            <span class="sr-only">
                                Phone Number
                            </span>

                            <input
                                type="tel"
                                name="phone"
                                placeholder="Phone Number*"
                                required
                            >

                        </label>


                        <label>

                            <span class="sr-only">
                                Email Address
                            </span>

                            <input
                                type="email"
                                name="email"
                                placeholder="Email Address*"
                                required
                            >

                        </label>


                        <label>

                            <span class="sr-only">
                                Message
                            </span>

                            <textarea
                                name="message"
                                rows="4"
                                placeholder="Message*"
                                required
                            ></textarea>

                        </label>


                        <button
                            type="submit"
                            class="blog-contact-form__submit"
                        >

                            <span>
                                SEND MESSAGE
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

                        </button>

                    </form>

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

                <?php
                if (
                    !empty($blog_categories) &&
                    !is_wp_error($blog_categories)
                ) :
                ?>

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


            </aside>

        </div>

    </section>


    <!-- =====================================================
         CONTACT SECTION
    ====================================================== -->

    <?php
    get_template_part(
        'template-parts/contact/contact'
    );
    ?>


</main>


<?php get_footer(); ?>