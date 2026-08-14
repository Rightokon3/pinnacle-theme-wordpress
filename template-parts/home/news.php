<?php
/**
 * Homepage — News Articles carousel
 *
 * Desktop:
 * - 2 articles visible
 * - Automatic carousel
 *
 * Tablet/Mobile:
 * - 1 article visible
 * - Swipe/drag
 * - Dot navigation
 * - Automatic carousel
 */

$news = get_field('news_list', 'option');

if (empty($news)) {
    $news = [
        [
            'title' => 'Veteran Mental Health Support in Edina, MN: Recognizing the Signs and Finding the Right Care',
            'excerpt' => 'Military service demands courage, discipline, and sacrifice. However, while many veterans transition successfully to civilian life, others continue to face mental health challenges long after their service ends.',
            'date' => 'July 2026',
            'image' => null,
            'link' => null,
        ],
        [
            'title' => 'Does Insurance Cover TMS Therapy? What Patients in Minnesota Should Know',
            'excerpt' => 'Transcranial Magnetic Stimulation (TMS) may be covered by many insurance plans for eligible patients with depression. Learn what insurers typically require and how the approval process works.',
            'date' => 'July 2026',
            'image' => null,
            'link' => null,
        ],
        [
            'title' => 'Spravato vs. IV Ketamine: Understanding the Differences for Depression Treatment',
            'excerpt' => 'Explore the key differences between Spravato and IV Ketamine, including FDA approval, administration, eligibility, and how to determine which treatment may be appropriate for you.',
            'date' => 'June 2026',
            'image' => null,
            'link' => null,
        ],
        [
            'title' => 'NeuroStar TMS for Depression: How It Works and What to Expect',
            'excerpt' => 'Learn how TMS therapy works, who may benefit from treatment, and what patients can expect throughout the treatment process.',
            'date' => 'June 2026',
            'image' => null,
            'link' => null,
        ],
        [
            'title' => 'Advanced Treatment Options for Depression',
            'excerpt' => 'Living with depression can be challenging, especially when symptoms continue despite trying standard treatment approaches.',
            'date' => 'May 2026',
            'image' => null,
            'link' => null,
        ],
        [
            'title' => 'Mental Health Treatment and Personalized Care in Minnesota',
            'excerpt' => 'Discover personalized behavioral healthcare options designed to support your mental health journey and help you move toward renewed hope.',
            'date' => 'May 2026',
            'image' => null,
            'link' => null,
        ],
    ];
}

$news_fallback_image_url = get_template_directory_uri() . '/assets/images/Health.jpeg';
?>

<section id="news" class="news">

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

                <?php foreach ($news as $article) :

                    $image = $article['image'] ?? null;

                    /*
                     * ACF image can sometimes be returned as:
                     * - Array
                     * - ID
                     * - URL
                     */
                    if (is_array($image)) {
                        $image_url = $image['url'] ?? $news_fallback_image_url;
                        $image_alt = $image['alt'] ?? $article['title'];
                    } elseif (is_numeric($image)) {
                        $image_url = wp_get_attachment_image_url(
                            (int) $image,
                            'large'
                        );

                        $image_alt = get_post_meta(
                            (int) $image,
                            '_wp_attachment_image_alt',
                            true
                        );

                        if (!$image_url) {
                            $image_url = $news_fallback_image_url;
                        }

                        if (!$image_alt) {
                            $image_alt = $article['title'];
                        }
                    } elseif (is_string($image) && !empty($image)) {
                        $image_url = $image;
                        $image_alt = $article['title'];
                    } else {
                        $image_url = $news_fallback_image_url;
                        $image_alt = $article['title'];
                    }

                    $link = $article['link'] ?? null;

                    if (is_array($link)) {
                        $link_url = $link['url'] ?? '#';
                        $link_target = $link['target'] ?? '_self';
                    } elseif (is_string($link) && !empty($link)) {
                        $link_url = $link;
                        $link_target = '_self';
                    } else {
                        $link_url = '#';
                        $link_target = '_self';
                    }

                ?>

                    <article class="news__card">

                        <img
                            src="<?php echo esc_url($image_url); ?>"
                            alt="<?php echo esc_attr($image_alt); ?>"
                            class="news__image"
                            loading="lazy"
                        >

                        <div class="news__body">

                            <!-- Kept for accessibility/content, hidden visually -->
                            <?php if (!empty($article['date'])) : ?>
                                <p class="news__date">
                                    <?php echo esc_html($article['date']); ?>
                                </p>
                            <?php endif; ?>

                            <h3 class="news__title">
                                <?php echo esc_html($article['title']); ?>
                            </h3>

                            <p class="news__excerpt">
                                <?php echo esc_html($article['excerpt']); ?>
                            </p>

                            <a
                                href="<?php echo esc_url($link_url); ?>"
                                class="news__read-more"
                                <?php
                                echo $link_target === '_blank'
                                    ? 'target="_blank" rel="noopener"'
                                    : '';
                                ?>
                            >
                                Read More
                            </a>

                        </div>

                    </article>

                <?php endforeach; ?>

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
                get_permalink(get_option('page_for_posts'))
            ); ?>"
            class="news__view-all"
        >
            <span>VIEW ALL</span>
            <span class="news__view-all-arrow">&#8594;</span>
        </a>
    </div>

</section>