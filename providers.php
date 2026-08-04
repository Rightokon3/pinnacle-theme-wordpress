<?php
/**
 * Template Name: Providers
 *
 * Providers page — banner strip, intro copy, provider grid, and the
 * shared contact section. Built the same way as the homepage: each
 * chunk is its own template-part, content comes from an ACF options
 * page so the client can edit everything from wp-admin.
 */
get_header();
?>

<?php get_template_part('template-parts/providers/providers-banner'); ?>
<?php get_template_part('template-parts/providers/providers-grid'); ?>
<?php get_template_part('template-parts/contact/contact'); ?>

<?php
get_footer();