<?php
/**
 * Homepage — "News" cards: image, date, title, excerpt, read-more link.
 * Content pulled from the "Homepage Content" ACF options page via a
 * repeater; falls back to two placeholder articles.
 */

$news = get_field('news_list', 'option');
if (empty($news)) {
    $news = [
        [
            'title' => 'How Veterans Can Manage Their Mental Health',
            'excerpt' => "Many veterans face unique mental health challenges after service. Here's what support can look like.",
            'date' => 'July 2026',
            'image' => null,
            'link' => null,
        ],
        [
            'title' => 'How to Qualify for TMS Through Insurance',
            'excerpt' => "TMS is increasingly covered by insurance providers. Here's what documentation is typically required.",
            'date' => 'June 2026',
            'image' => null,
            'link' => null,
        ],
    ];
}

$news_fallback_image_url = get_template_directory_uri() . '/assets/images/Health.jpeg';
?>

<section id="news" class="news">
    <div class="news__grid">
        <?php foreach ($news as $article) :
            $image = $article['image'] ?? null;
            $image_url = $image['url'] ?? $news_fallback_image_url;
            $image_alt = $image['alt'] ?? '';

            $link = $article['link'] ?? null;
            $link_url = $link['url'] ?? '#';
            $link_target = $link['target'] ?? '_self';
        ?>
            <article class="news__card">
                <img
                    src="<?php echo esc_url($image_url); ?>"
                    alt="<?php echo esc_attr($image_alt); ?>"
                    class="news__image"
                    loading="lazy"
                >
                <div class="news__body">
                    <p class="news__date"><?php echo esc_html($article['date']); ?></p>
                    <h3 class="news__title"><?php echo esc_html($article['title']); ?></h3>
                    <p class="news__excerpt"><?php echo esc_html($article['excerpt']); ?></p>
                    <a
                        href="<?php echo esc_url($link_url); ?>"
                        class="news__read-more"
                        <?php echo $link_target === '_blank' ? 'target="_blank" rel="noopener"' : ''; ?>
                    >
                        Read More
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>