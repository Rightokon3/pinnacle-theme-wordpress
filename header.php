<?php
/**
 * Site header — matches the reference React header 1:1:
 * desktop nav + search icon, stacked Patient Portal / Pay Your Bill
 * pills, cart icon, Call Us button; mobile collapses to an icon row
 * (search, portal, billing, cart, hamburger) + slide-out drawer.
 *
 * Cart badge count uses WooCommerce's cart count when WooCommerce is
 * active, and falls back to 0 otherwise — swap the fallback for your
 * own logic if you're not using WooCommerce for the dispensary.
 */

$cart_count = 0;
if (function_exists('WC') && WC()->cart) {
    $cart_count = WC()->cart->get_cart_contents_count();
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="site-header" data-site-header>
    <div class="site-header__inner">

        <!-- Logo -->
        <a
            href="<?php echo esc_url(home_url('/')); ?>"
            class="site-logo"
            aria-label="Go to homepage"
        >
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/Pinnacle_Logo.webp'); ?>"
                alt="Pinnacle"
            >
        </a>

        <!-- Desktop Navigation -->
        <nav class="site-navigation" aria-label="Primary">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => false,
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'primary-menu',
            ]);
            ?>

            <button
                type="button"
                class="nav-search-toggle"
                aria-label="Open search"
                data-search-toggle
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </button>
        </nav>

        <!-- Desktop right cluster: stacked pills, cart, call button -->
        <div class="site-header__actions">
            <div class="header-pills">
                <a href="#portal" class="header-pill header-pill--underline">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Patient Portal
                </a>
                <a href="#billing" class="header-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    Pay Your Bill
                </a>
            </div>

            <button type="button" class="icon-btn" aria-label="View cart">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                <span class="icon-btn__badge"><?php echo (int) $cart_count; ?></span>
            </button>

            <a href="tel:+15551234567" class="header-phone">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <span class="header-phone__text">
                    <span class="header-phone__label">Call Us:</span>
                    <span class="header-phone__number">(952) 295-9448</span>
                </span>
            </a>
        </div>

        <!-- Mobile / tablet icon row -->
        <div class="header-icons-mobile">
            <button type="button" class="icon-btn" aria-label="Open search" data-search-toggle>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </button>

            <a href="#portal" class="icon-btn" aria-label="Patient portal">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </a>

            <a href="#billing" class="icon-btn" aria-label="Pay your bill">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </a>

            <button type="button" class="icon-btn" aria-label="View cart">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                <span class="icon-btn__badge"><?php echo (int) $cart_count; ?></span>
            </button>

            <button
                type="button"
                class="menu-toggle"
                aria-label="Open menu"
                aria-expanded="false"
                aria-controls="mobile-nav-drawer"
            >
                <span class="menu-toggle__bar"></span>
                <span class="menu-toggle__bar"></span>
                <span class="menu-toggle__bar"></span>
            </button>
        </div>
    </div>

    <!-- Search overlay -->
    <div class="search-overlay" data-search-overlay hidden>
        <div class="search-overlay__inner">
            <form role="search" method="get" class="search-overlay__form" action="<?php echo esc_url(home_url('/')); ?>">
                <input
                    type="search"
                    name="s"
                    class="search-overlay__input"
                    placeholder="Search Here..."
                    value="<?php echo esc_attr(get_search_query()); ?>"
                    data-search-input
                >
                <button type="submit" class="search-overlay__submit" aria-label="Submit search">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </button>
            </form>
            <button type="button" class="search-overlay__close" aria-label="Close search" data-search-close>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
        </div>
    </div>
</header>

<!-- Mobile drawer -->
<div class="mobile-nav-overlay" id="mobile-nav-overlay" hidden></div>

<aside class="mobile-nav-drawer" id="mobile-nav-drawer" aria-hidden="true">
    <button type="button" class="mobile-nav-drawer__close" aria-label="Close menu">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>

    <nav aria-label="Mobile">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'fallback_cb'    => false,
            'menu_id'        => 'mobile-menu',
            'menu_class'     => 'mobile-menu',
        ]);
        ?>
    </nav>

    <a href="#appointment" class="mobile-nav-cta">Book Appointment</a>
</aside>

<main>