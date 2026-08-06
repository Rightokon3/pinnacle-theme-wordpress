<?php
/**
 * Template Name: Services
 *
 * Services page — banner/breadcrumb/share row, 2-column service
 * card grid, supplement/dispensary promo banner, testimonials, and
 * the shared "book a consultation" + contact section.
 */
get_header();
?>

<?php get_template_part('template-parts/services/services-banner'); ?>
<?php get_template_part('template-parts/services/services-list'); ?>
<?php get_template_part('template-parts/home/supplement-brands-banner'); ?>
<?php get_template_part('template-parts/home/testimonials'); ?>
<?php get_template_part('template-parts/contact/contact'); ?>

<?php
get_footer();