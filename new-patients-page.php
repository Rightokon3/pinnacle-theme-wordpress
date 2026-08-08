<?php
/**
 * Fallback template. The design in this theme is a one-page landing page
 * (see front-page.php), so this file simply renders standard post content
 * when a template other than the front page is requested.
 */

get_header();
?>

<section>
  <div class="wrap">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
          <div class="section-head">
            <h2><?php the_title(); ?></h2>
          </div>
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <div class="section-head">
        <h2><?php esc_html_e( 'Nothing found', 'pinnacle-behavioral' ); ?></h2>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php
get_footer();
