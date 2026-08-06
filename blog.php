<?php
/**
 * Template Name: Blog Archive
 * File: page-blog.php
 *
 * Lists real Posts (not ACF fields) — title, excerpt, featured image,
 * and category, pulled live from whatever you publish under Posts in
 * wp-admin. Nothing to fill in on this page itself beyond assigning
 * the template; just write and publish blog posts as usual and they
 * show up here automatically, newest first, 8 per page.
 *
 * Same banner / breadcrumb / two-column shell as the Service Detail
 * and FAQ templates. Sidebar is: search box, Contact Us card,
 * Categories card (pulled live from your Categories list), then
 * Book a Consultation. Map is rendered once via
 * template-parts/contact/contact.php, same as the other templates.
 */

get_header();

$banner_image = get_field('blog_banner_image');
$banner_image_url = $banner_image['url'] ?? get_template_directory_uri() . '/assets/images/back.webp';

$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);

$blog_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 8,
    'paged'          => $paged,
]);
?>

<section class="providers-banner" style="background-image:url('<?php echo esc_url($banner_image_url); ?>');">
    <div class="providers-banner__overlay">
        <div class="providers-banner__inner">
            <h1 class="providers-banner__title"><?php echo esc_html(get_the_title()); ?></h1>
        </div>
    </div>
</section>

<div class="providers-breadcrumb-container">
    <p class="providers-banner__breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span aria-hidden="true">&raquo;</span>
        <span><?php echo esc_html(get_the_title()); ?></span>
    </p>
</div>

<section class="service-detail">
    <div class="service-detail__grid">

        <div class="service-detail__main">

            <?php if ($blog_query->have_posts()) : ?>
                <div class="blog-list">
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <article class="blog-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="blog-card__image-link">
                                    <?php the_post_thumbnail('medium_large', ['class' => 'blog-card__image']); ?>
                                </a>
                            <?php endif; ?>

                            <div class="blog-card__body">
                                <?php $categories = get_the_category(); ?>
                                <?php if (!empty($categories)) : ?>
                                    <div class="blog-card__categories">
                                        <?php foreach ($categories as $category) : ?>
                                            <a href="<?php echo esc_url(get_category_link($category)); ?>" class="blog-card__category"><?php echo esc_html($category->name); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <h2 class="blog-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <?php if (has_excerpt() || get_the_content()) : ?>
                                    <p class="blog-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30)); ?></p>
                                <?php endif; ?>

                                <a href="<?php the_permalink(); ?>" class="blog-card__cta">
                                    Read More
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                $pagination_links = paginate_links([
                    'total'     => $blog_query->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                    'type'      => 'array',
                ]);

                if (!empty($pagination_links)) : ?>
                    <nav class="blog-pagination" aria-label="Posts pagination">
                        <?php foreach ($pagination_links as $link) {
                            echo wp_kses($link, ['a' => ['href' => [], 'class' => []], 'span' => ['aria-current' => [], 'class' => []]]);
                        } ?>
                    </nav>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <p class="pillar-faq__intro">No posts published yet — anything you publish under Posts in wp-admin will show up here.</p>
            <?php endif; ?>

        </div>

        <aside class="service-detail__sidebar">

            <?php
            // 1. Search box — posts a native WP search request, no JS
            // needed.
            ?>
            <div class="pillar-sidebar__inner blog-search-card">
                <form role="search" method="get" class="blog-search__form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label>
                        <span class="sr-only">Search</span>
                        <input type="search" name="s" class="blog-search__input" placeholder="Search the blog...">
                    </label>
                    <button type="submit" class="blog-search__submit" aria-label="Search">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </form>
            </div>

            <?php
            // 2. Contact form card — same markup/classes as the other
            // templates.
            ?>
            <div class="pillar-sidebar__inner service-contact-card">
                <h3 class="pillar-sidebar__title">Contact Us</h3>
                <form class="contact-form__form" method="post" action="">
                    <label>
                        <span class="sr-only">First Name</span>
                        <input type="text" name="first_name" class="contact-form__input" placeholder="First Name*" required>
                    </label>
                    <label>
                        <span class="sr-only">Last Name</span>
                        <input type="text" name="last_name" class="contact-form__input" placeholder="Last Name*" required>
                    </label>
                    <label>
                        <span class="sr-only">Phone Number</span>
                        <input type="tel" name="phone" class="contact-form__input" placeholder="Phone Number*" required>
                    </label>
                    <label>
                        <span class="sr-only">Email Address</span>
                        <input type="email" name="email" class="contact-form__input" placeholder="Email Address*" required>
                    </label>
                    <label>
                        <span class="sr-only">Message</span>
                        <textarea name="message" class="contact-form__input contact-form__textarea" rows="4" placeholder="Message*" required></textarea>
                    </label>

                    <button type="submit" class="contact-form__submit">
                        Send Message
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                </form>
            </div>

            <?php
            // 3. Categories card — pulled live from whatever categories
            // actually have published posts, so it never goes stale.
            $blog_categories = get_categories(['hide_empty' => true]);
            if (!empty($blog_categories)) :
            ?>
                <div class="pillar-sidebar__inner">
                    <h3 class="pillar-sidebar__title">Categories</h3>
                    <ul class="blog-categories__list">
                        <?php foreach ($blog_categories as $category) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_category_link($category)); ?>">
                                    <span><?php echo esc_html($category->name); ?></span>
                                    <span class="blog-categories__count"><?php echo esc_html($category->count); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>


        </aside>

    </div>
    <?php get_template_part('template-parts/contact/contact'); ?>
</section>

<?php get_footer(); ?>