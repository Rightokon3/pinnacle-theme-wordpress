<?php
/**
 * Pinnacle Behavioral Healthcare — consolidated theme functions.
 * Single functions.php containing the site's theme, ACF, CPT, assets,
 * location SEO/schema, WooCommerce, and form-routing functionality.
 */

if (!defined('ABSPATH')) {
    exit;
}

function pinnacle_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'pinnacle-behavioral'),
    ]);
}
add_action('after_setup_theme', 'pinnacle_theme_setup');


function pinnacle_theme_assets() {
wp_enqueue_style(
    'pinnacle-style',
    get_stylesheet_uri(),
    [],
    filemtime(get_stylesheet_directory() . '/style.css')
);

    wp_enqueue_script(
        'pinnacle-nav-dropdown',
        get_template_directory_uri() . '/assets/js/nav-dropdown.js',
        [],
        '1.0',
        true
    );

    wp_enqueue_script(
        'pinnacle-mobile-nav',
        get_template_directory_uri() . '/assets/js/mobile-nav.js',
        [],
        '1.0',
        true
    );

    wp_enqueue_script(
        'pinnacle-appointment-form',
        get_template_directory_uri() . '/assets/js/appointment-form.js',
        [],
        '1.0',
        true
    );

    wp_enqueue_script(
        'pinnacle-testimonials',
        get_template_directory_uri() . '/assets/js/testimonials.js',
        [],
        '1.0',
        true
    );

    wp_enqueue_script(
        'pinnacle-service-highlights-carousel',
        get_template_directory_uri() . '/assets/js/service-highlights-carousel.js',
        [],
        '1.0',
        true
    );

    wp_enqueue_script(
        'pinnacle-contact-form',
        get_template_directory_uri() . '/assets/js/contact-form.js',
        [],
        '1.0',
        true
    );

    wp_enqueue_script(
        'pinnacle-faq-accordion',
        get_template_directory_uri() . '/assets/js/faq-accordion.js',
        [],
        '1.0',
        true
    );

    if (is_page_template('page-existing-patients.php')) {
        wp_enqueue_script(
            'pinnacle-intake-selector',
            get_template_directory_uri() . '/assets/js/intake-selector.js',
            [],
            '1.0',
            true
        );
    }

    if (is_page_template('page-new-patients.php')) {
        wp_enqueue_script(
            'pinnacle-new-patients-intake',
            get_template_directory_uri() . '/assets/js/new-patients-intake.js',
            [],
            '1.0',
            true
        );
    }

    // Newer theme-wide interactions. Load only when the files exist.
    $main_js = get_template_directory() . '/assets/js/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script(
            'pinnacle-main',
            get_template_directory_uri() . '/assets/js/main.js',
            [],
            filemtime($main_js),
            true
        );
    }

    if (is_page_template('page-existing-patients.php')) {
        $intake_js = get_template_directory() . '/assets/js/intake.js';
        if (file_exists($intake_js)) {
            wp_enqueue_script(
                'pinnacle-intake',
                get_template_directory_uri() . '/assets/js/intake.js',
                [],
                filemtime($intake_js),
                true
            );
        }
    }
}
function pinnacle_theme_fonts() {
    wp_enqueue_style(
        'pinnacle-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&display=swap',
        [],
        null
    );
}
add_action('wp_enqueue_scripts', 'pinnacle_theme_fonts');
add_action('wp_enqueue_scripts', 'pinnacle_theme_assets');


/**
 * ---------------------------------------------------------------
 * Homepage content — editable via ACF
 * ---------------------------------------------------------------
 * Registers an options page ("Homepage Content") so the client can
 * edit body-section copy/images from wp-admin, plus the field group
 * for it. Fields are added here in PHP so they ship with the theme
 * instead of needing to be recreated by hand in the ACF UI.
 *
 * Requires the free or Pro version of Advanced Custom Fields to be
 * active. Everything below is skipped gracefully if ACF isn't
 * installed — templates fall back to the original hardcoded copy.
 */

add_action('acf/init', 'pinnacle_register_option_pages');

function pinnacle_register_option_pages() {

    if ( ! function_exists('acf_add_options_page') ) {
        return;
    }

    acf_add_options_page([
        'page_title' => 'Homepage Content',
        'menu_title' => 'Homepage Content',
        'menu_slug'  => 'homepage-content',
        'capability' => 'edit_posts',
        'icon_url'   => 'dashicons-edit-page',
        'redirect'   => false,
    ]);

    acf_add_options_page([
        'page_title' => 'Providers Page',
        'menu_title' => 'Providers Page',
        'menu_slug'  => 'providers-page',
        'capability' => 'edit_posts',
        'icon_url'   => 'dashicons-groups',
        'redirect'   => false,
    ]);

    acf_add_options_page([
        'page_title' => 'Services Page',
        'menu_title' => 'Services Page',
        'menu_slug'  => 'services-page',
        'capability' => 'edit_posts',
        'icon_url'   => 'dashicons-heart',
        'redirect'   => false,
    ]);


}

if (function_exists('acf_add_local_field_group')) {

    /**
     * ---------------------------------------------------------------
     * Hero Section (Homepage Content options page)
     * ---------------------------------------------------------------
     * NOTE: this group was accidentally dropped from the file when
     * the Service Pillar page group was added below. Restored here —
     * the homepage hero template part depends on these fields.
     */
    acf_add_local_field_group([
        'key' => 'group_homepage_hero',
        'title' => 'Hero Section',
        'fields' => [
            [
                'key' => 'field_hero_headline',
                'label' => 'Headline',
                'name' => 'hero_headline',
                'type' => 'text',
                'default_value' => 'Mental Healthcare, Personalized For You',
            ],
            [
                'key' => 'field_hero_subtitle',
                'label' => 'Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Providing cutting-edge mental health treatment plans and psychiatric services for patients of every age.',
            ],
            [
                'key' => 'field_hero_image',
                'label' => 'Background Photo',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_appointment_form_title',
                'label' => 'Appointment Form — Title',
                'name' => 'appointment_form_title',
                'type' => 'text',
                'default_value' => 'Book a Consultation',
            ],
            [
                'key' => 'field_appointment_form_services',
                'label' => 'Appointment Form — Services',
                'name' => 'appointment_form_services',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Service',
                'sub_fields' => [
                    [
                        'key' => 'field_service_name',
                        'label' => 'Service Name',
                        'name' => 'service_name',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * Contact Section (Homepage Content options page)
     * ---------------------------------------------------------------
     * Single source of truth for the business address / phone / map,
     * so it only needs setting once. page-service-detail.php already
     * falls back to these same field names (contact_map_lat,
     * contact_map_lng, contact_map_business_name, contact_map_address)
     * when a page doesn't set its own override — this group is what
     * actually registers them. page-contact.php uses them directly.
     */
    acf_add_local_field_group([
        'key' => 'group_contact_section',
        'title' => 'Contact Section',
        'fields' => [
            [
                'key' => 'field_contact_map_business_name',
                'label' => 'Business Name',
                'name' => 'contact_map_business_name',
                'type' => 'text',
                'default_value' => 'Pinnacle Behavioral Healthcare',
            ],
            [
                'key' => 'field_contact_map_lat',
                'label' => 'Map Latitude',
                'name' => 'contact_map_lat',
                'type' => 'number',
                'step' => '0.000001',
                'default_value' => 44.9778,
            ],
            [
                'key' => 'field_contact_map_lng',
                'label' => 'Map Longitude',
                'name' => 'contact_map_lng',
                'type' => 'number',
                'step' => '0.000001',
                'default_value' => -93.265,
            ],
            [
                'key' => 'field_contact_map_address',
                'label' => 'Address (single line, for the map card)',
                'name' => 'contact_map_address',
                'type' => 'text',
            ],
            [
                'key' => 'field_contact_address_lines',
                'label' => 'Address (multi-line, for the Contact page sidebar)',
                'name' => 'contact_address_lines',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Line',
                'sub_fields' => [
                    [
                        'key' => 'field_contact_address_line',
                        'label' => 'Line',
                        'name' => 'line',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_contact_phone',
                'label' => 'Phone Number (display)',
                'name' => 'contact_phone',
                'type' => 'text',
                'default_value' => '(952) 303-6832',
            ],
            [
                'key' => 'field_contact_phone_link',
                'label' => 'Phone Number (tel: link, digits only)',
                'name' => 'contact_phone_link',
                'type' => 'text',
                'default_value' => '9523036832',
            ],
            [
                'key' => 'field_contact_map_directions_url',
                'label' => 'Map "Get Directions" Link',
                'name' => 'contact_map_directions_url',
                'type' => 'url',
                'instructions' => 'Google Maps share link.',
            ],
            [
                'key' => 'field_contact_facebook_url',
                'label' => 'Facebook URL',
                'name' => 'contact_facebook_url',
                'type' => 'url',
            ],
            [
                'key' => 'field_contact_instagram_url',
                'label' => 'Instagram URL',
                'name' => 'contact_instagram_url',
                'type' => 'url',
            ],
            [
                'key' => 'field_contact_twitter_url',
                'label' => 'Twitter / X URL',
                'name' => 'contact_twitter_url',
                'type' => 'url',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * Service Pillar page (page-service-pillar.php)
     * ---------------------------------------------------------------
     * Newer long-form service landing page template: hero image,
     * banner CTA, alternating fact strip, optional video embed, FAQ
     * accordion, contact form, and a sticky sidebar table of contents.
     */
    acf_add_local_field_group([
        'key' => 'group_service_pillar',
        'title' => 'Service Pillar Page',
        'fields' => [
            [
                'key' => 'field_pillar_hero_image',
                'label' => 'Hero Image',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_pillar_banner_heading',
                'label' => 'Banner Heading',
                'name' => 'banner_heading',
                'type' => 'text',
                'default_value' => 'Book a Consultation',
            ],
            [
                'key' => 'field_pillar_banner_cta_text',
                'label' => 'Banner Button Text',
                'name' => 'banner_cta_text',
                'type' => 'text',
                'default_value' => 'Schedule Consultation',
            ],
            [
                'key' => 'field_pillar_banner_cta_link',
                'label' => 'Banner Button Link',
                'name' => 'banner_cta_link',
                'type' => 'text',
                'instructions' => 'Defaults to the contact form at the bottom of this page (#contact-form) if left blank.',
            ],
            [
                'key' => 'field_pillar_fact_strip',
                'label' => 'Fact Strip',
                'name' => 'fact_strip',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Fact',
                'instructions' => 'Colors alternate automatically (navy / purple) — no need to set that per item.',
                'sub_fields' => [
                    [
                        'key' => 'field_pillar_fact_icon',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => [
                            'brain' => 'Brain',
                            'pill' => 'Pill',
                            'calendar' => 'Calendar',
                            'clock' => 'Clock',
                            'check' => 'Checkmark',
                        ],
                        'default_value' => 'brain',
                    ],
                    [
                        'key' => 'field_pillar_fact_heading',
                        'label' => 'Heading',
                        'name' => 'heading',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pillar_fact_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                ],
            ],
            [
                'key' => 'field_pillar_video_url',
                'label' => 'Video Embed URL',
                'name' => 'video_url',
                'type' => 'url',
                'instructions' => 'YouTube/Vimeo embed URL. Leave blank to hide the video section.',
            ],
            [
                'key' => 'field_pillar_faq_heading',
                'label' => 'FAQ Heading',
                'name' => 'faq_heading',
                'type' => 'text',
                'default_value' => 'Frequently Asked Questions (FAQs)',
            ],
            [
                'key' => 'field_pillar_faq_intro',
                'label' => 'FAQ Intro Text',
                'name' => 'faq_intro',
                'type' => 'textarea',
                'rows' => 2,
            ],
            [
                'key' => 'field_pillar_faqs',
                'label' => 'FAQs',
                'name' => 'faqs',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add FAQ',
                'sub_fields' => [
                    [
                        'key' => 'field_pillar_faq_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pillar_faq_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],
            [
                'key' => 'field_pillar_contact_heading',
                'label' => 'Contact Form Heading',
                'name' => 'contact_heading',
                'type' => 'text',
                'default_value' => 'Contact Us',
            ],
            [
                'key' => 'field_pillar_sidebar_links',
                'label' => 'Sidebar Table of Contents',
                'name' => 'sidebar_links',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Link',
                'instructions' => 'The anchor must match the id on the section it should jump to — the Fact Strip items get one automatically from their heading; add a matching #anchor manually for other sections (e.g. "faq" or "contact-form" are already built in).',
                'sub_fields' => [
                    [
                        'key' => 'field_pillar_sidebar_label',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pillar_sidebar_anchor',
                        'label' => 'Anchor (no #)',
                        'name' => 'anchor',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-service-pillar.php',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_staff_announcement',
        'title' => 'Staff Announcement',
        'fields' => [
            [
                'key' => 'field_staff_eyebrow',
                'label' => 'Eyebrow Text',
                'name' => 'staff_eyebrow',
                'type' => 'text',
                'default_value' => 'Welcome our New Psychotherapist',
            ],
            [
                'key' => 'field_staff_name',
                'label' => 'Name',
                'name' => 'staff_name',
                'type' => 'text',
                'default_value' => 'Dara Awosika',
            ],
            [
                'key' => 'field_staff_credentials',
                'label' => 'Credentials',
                'name' => 'staff_credentials',
                'type' => 'text',
                'default_value' => 'BSW , MSW , LICSW',
            ],
            [
                'key' => 'field_staff_photo',
                'label' => 'Photo',
                'name' => 'staff_photo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_feature_banner',
        'title' => 'Feature Banner',
        'fields' => [
            [
                'key' => 'field_feature_banner_image',
                'label' => 'Banner Image',
                'name' => 'feature_banner_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'Wide image works best — it displays cropped to a short banner strip.',
            ],
            [
                'key' => 'field_feature_banner_link',
                'label' => 'Banner Link',
                'name' => 'feature_banner_link',
                'type' => 'link',
                'instructions' => 'Defaults to the Services page if left blank.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_why_choose_us',
        'title' => 'Why Choose Us',
        'fields' => [
            [
                'key' => 'field_why_choose_heading',
                'label' => 'Heading',
                'name' => 'why_choose_heading',
                'type' => 'text',
                'default_value' => 'Why Choose Pinnacle',
            ],
            [
                'key' => 'field_why_choose_body',
                'label' => 'Body Text',
                'name' => 'why_choose_body',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => "Accurate diagnosis of mental health disorders can be difficult. We use advanced technology and evidence-based techniques to make sure every treatment plan starts with a precise understanding of each person's unique needs.",
            ],
            [
                'key' => 'field_why_choose_cta_text',
                'label' => 'Button Text',
                'name' => 'why_choose_cta_text',
                'type' => 'text',
                'default_value' => 'Schedule Consultation',
            ],
            [
                'key' => 'field_why_choose_cta_link',
                'label' => 'Button Link',
                'name' => 'why_choose_cta_link',
                'type' => 'text',
                'default_value' => '#appointment',
                'instructions' => 'A URL, or an on-page anchor like #appointment.',
            ],
            [
                'key' => 'field_why_choose_image',
                'label' => 'Image',
                'name' => 'why_choose_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_feature_icons',
        'title' => 'Feature Icons',
        'fields' => [
            [
                'key' => 'field_feature_icons',
                'label' => 'Feature Icons',
                'name' => 'feature_icons',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Feature',
                'sub_fields' => [
                    [
                        'key' => 'field_feature_icon_choice',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => [
                            'award' => 'Award',
                            'clipboard' => 'Clipboard',
                            'home' => 'Home',
                        ],
                        'default_value' => 'award',
                    ],
                    [
                        'key' => 'field_feature_icon_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_services',
        'title' => 'Services',
        'fields' => [
            [
                'key' => 'field_services_heading',
                'label' => 'Heading',
                'name' => 'services_heading',
                'type' => 'text',
                'default_value' => 'What We Offer',
            ],
            [
                'key' => 'field_services_image',
                'label' => 'Side Image',
                'name' => 'services_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_services_list',
                'label' => 'Services',
                'name' => 'services_list',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Service',
                'sub_fields' => [
                    [
                        'key' => 'field_service_icon',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => [
                            'pill' => 'Pill',
                            'heart' => 'Heart',
                            'zap' => 'Zap',
                            'target' => 'Target',
                            'check' => 'Checklist',
                        ],
                        'default_value' => 'pill',
                    ],
                    [
                        'key' => 'field_service_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_service_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_testimonials',
        'title' => 'Testimonials',
        'fields' => [
            [
                'key' => 'field_testimonials_heading',
                'label' => 'Heading',
                'name' => 'testimonials_heading',
                'type' => 'text',
                'default_value' => 'What Our Patients Say',
            ],
            [
                'key' => 'field_testimonials_cta_text',
                'label' => 'Button Text',
                'name' => 'testimonials_cta_text',
                'type' => 'text',
                'default_value' => 'View All',
            ],
            [
                'key' => 'field_testimonials_cta_link',
                'label' => 'Button Link',
                'name' => 'testimonials_cta_link',
                'type' => 'text',
                'default_value' => '#testimonials',
            ],
            [
                'key' => 'field_testimonials_list',
                'label' => 'Testimonials',
                'name' => 'testimonials_list',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Testimonial',
                'sub_fields' => [
                    [
                        'key' => 'field_testimonial_quote',
                        'label' => 'Quote',
                        'name' => 'quote',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_testimonial_name',
                        'label' => 'Patient Name',
                        'name' => 'name',
                        'type' => 'text',
                        'instructions' => 'First initial + last name is typical for privacy, e.g. "J. Alvarez".',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_cta',
        'title' => 'CTA Banner',
        'fields' => [
            [
                'key' => 'field_cta_heading',
                'label' => 'Heading',
                'name' => 'cta_heading',
                'type' => 'text',
                'default_value' => 'Ready to take the next step in your care?',
            ],
            [
                'key' => 'field_cta_button_text',
                'label' => 'Button Text',
                'name' => 'cta_button_text',
                'type' => 'text',
                'default_value' => 'Book Your Consultation',
            ],
            [
                'key' => 'field_cta_button_link',
                'label' => 'Button Link',
                'name' => 'cta_button_link',
                'type' => 'text',
                'default_value' => '#appointment',
                'instructions' => 'A URL, or an on-page anchor like #appointment.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_about',
        'title' => 'About',
        'fields' => [
            [
                'key' => 'field_about_heading',
                'label' => 'Heading',
                'name' => 'about_heading',
                'type' => 'text',
                'default_value' => 'Pinnacle Behavioral Healthcare was founded by Dr. Olukayode Awosika in July 2011',
            ],
            [
                'key' => 'field_about_body',
                'label' => 'Body Text',
                'name' => 'about_body',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => "Exceptional Care by Compassionate People. We are dedicated to providing the highest quality mental healthcare services. We offer a full range of psychiatric services, from medication management to treatment options for depression and ADHD diagnostic testing.",
            ],
            [
                'key' => 'field_about_cta_text',
                'label' => 'Button Text',
                'name' => 'about_cta_text',
                'type' => 'text',
                'default_value' => 'Contact Us',
            ],
            [
                'key' => 'field_about_cta_link',
                'label' => 'Button Link',
                'name' => 'about_cta_link',
                'type' => 'text',
                'default_value' => '#appointment',
                'instructions' => 'A URL, or an on-page anchor like #appointment.',
            ],
            [
                'key' => 'field_about_image',
                'label' => 'Image',
                'name' => 'about_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_service_highlights',
        'title' => 'Service Highlights Carousel',
        'fields' => [
            [
                'key' => 'field_service_highlights_heading',
                'label' => 'Heading',
                'name' => 'service_highlights_heading',
                'type' => 'text',
                'default_value' => 'Our Services',
            ],
            [
                'key' => 'field_service_highlights_list',
                'label' => 'Service Highlights',
                'name' => 'service_highlights_list',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Service Highlight',
                'sub_fields' => [
                    [
                        'key' => 'field_service_highlight_label',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                        'instructions' => 'Shown on the tab button.',
                    ],
                    [
                        'key' => 'field_service_highlight_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_service_highlight_telehealth',
                        'label' => 'Telehealth Available',
                        'name' => 'telehealth',
                        'type' => 'true_false',
                        'ui' => 1,
                    ],
                    [
                        'key' => 'field_service_highlight_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],
                    [
                        'key' => 'field_service_highlight_link',
                        'label' => 'Learn More Link',
                        'name' => 'link',
                        'type' => 'link',
                        'instructions' => 'Defaults to the Contact page if left blank.',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_specialists',
        'title' => 'Specialists',
        'fields' => [
            [
                'key' => 'field_specialists_list',
                'label' => 'Specialists',
                'name' => 'specialists_list',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Specialist',
                'sub_fields' => [
                    [
                        'key' => 'field_specialist_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_specialist_title',
                        'label' => 'Credentials',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'e.g. "APRN, PMHNP-BC".',
                    ],
                    [
                        'key' => 'field_specialist_photo',
                        'label' => 'Photo',
                        'name' => 'photo',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],
                    [
                        'key' => 'field_specialist_link',
                        'label' => 'View Profile Link',
                        'name' => 'link',
                        'type' => 'link',
                        'instructions' => 'Defaults to the Contact page if left blank.',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_supplement_banner',
        'title' => 'Supplement Banner',
        'fields' => [
            [
                'key' => 'field_supplement_banner_heading',
                'label' => 'Heading',
                'name' => 'supplement_banner_heading',
                'type' => 'text',
                'default_value' => 'The Best Quality Supplement Brands Available',
            ],
            [
                'key' => 'field_supplement_banner_body',
                'label' => 'Body Text',
                'name' => 'supplement_banner_body',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => "We only carry supplements from reputable, quality-tested brands. Every product is chosen to support real results, so you can trust what you're adding to your care plan.",
            ],
            [
                'key' => 'field_supplement_banner_cta_text',
                'label' => 'Button Text',
                'name' => 'supplement_banner_cta_text',
                'type' => 'text',
                'default_value' => 'Shop Now',
            ],
            [
                'key' => 'field_supplement_banner_cta_link',
                'label' => 'Button Link',
                'name' => 'supplement_banner_cta_link',
                'type' => 'text',
                'default_value' => '#products',
                'instructions' => 'A URL, or an on-page anchor like #products.',
            ],
            [
                'key' => 'field_supplement_banner_image',
                'label' => 'Image',
                'name' => 'supplement_banner_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_news',
        'title' => 'News',
        'fields' => [
            [
                'key' => 'field_news_list',
                'label' => 'News Articles',
                'name' => 'news_list',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Article',
                'sub_fields' => [
                    [
                        'key' => 'field_news_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_news_excerpt',
                        'label' => 'Excerpt',
                        'name' => 'excerpt',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_news_date',
                        'label' => 'Date Label',
                        'name' => 'date',
                        'type' => 'text',
                        'instructions' => 'Free text, e.g. "July 2026".',
                    ],
                    [
                        'key' => 'field_news_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],
                    [
                        'key' => 'field_news_link',
                        'label' => 'Read More Link',
                        'name' => 'link',
                        'type' => 'link',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_quick_facts',
        'title' => 'Quick Facts Band',
        'fields' => [
            [
                'key' => 'field_quick_facts_list',
                'label' => 'Quick Facts',
                'name' => 'quick_facts_list',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Fact',
                'sub_fields' => [
                    [
                        'key' => 'field_quick_fact_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_quick_fact_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_quick_fact_link',
                        'label' => 'CTA Link',
                        'name' => 'link',
                        'type' => 'link',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_homepage_contact',
        'title' => 'Contact Section',
        'fields' => [
            [
                'key' => 'field_contact_banner_heading',
                'label' => 'Banner Heading',
                'name' => 'contact_banner_heading',
                'type' => 'text',
                'default_value' => 'Book a Consultation',
            ],
            [
                'key' => 'field_contact_banner_cta_text',
                'label' => 'Banner Button Text',
                'name' => 'contact_banner_cta_text',
                'type' => 'text',
                'default_value' => 'Schedule Consultation',
            ],
            [
                'key' => 'field_contact_banner_cta_link',
                'label' => 'Banner Button Link',
                'name' => 'contact_banner_cta_link',
                'type' => 'text',
                'default_value' => '#appointment',
                'instructions' => 'A URL, or an on-page anchor like #appointment.',
            ],
            [
                'key' => 'field_contact_heading',
                'label' => 'Heading',
                'name' => 'contact_heading',
                'type' => 'text',
                'default_value' => 'Contact Us',
            ],
            [
                'key' => 'field_contact_body',
                'label' => 'Body Text',
                'name' => 'contact_body',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => "Ready to take the first step towards your mental health and wellness goals? Schedule a consultation with our team — we're here to help you find a plan that fits.",
            ],
            [
                'key' => 'field_contact_map_lat',
                'label' => 'Map Latitude',
                'name' => 'contact_map_lat',
                'type' => 'number',
                'step' => '0.000001',
                'default_value' => 44.9778,
            ],
            [
                'key' => 'field_contact_map_lng',
                'label' => 'Map Longitude',
                'name' => 'contact_map_lng',
                'type' => 'number',
                'step' => '0.000001',
                'default_value' => -93.265,
            ],
            [
                'key' => 'field_contact_map_business_name',
                'label' => 'Business Name',
                'name' => 'contact_map_business_name',
                'type' => 'text',
                'default_value' => 'Pinnacle Behavioral Healthcare',
            ],
            [
                'key' => 'field_contact_map_address_lines',
                'label' => 'Address Lines',
                'name' => 'contact_map_address_lines',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Line',
                'sub_fields' => [
                    [
                        'key' => 'field_contact_map_address_line',
                        'label' => 'Line',
                        'name' => 'line',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'homepage-content',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * Providers page — banner/intro copy and the provider grid, on
     * their own "Providers Page" options page. Same pattern as the
     * Homepage Content groups above.
     */

    acf_add_local_field_group([
        'key' => 'group_providers_banner',
        'title' => 'Providers — Banner & Intro',
        'fields' => [
            [
                'key' => 'field_providers_page_title',
                'label' => 'Page Title',
                'name' => 'providers_page_title',
                'type' => 'text',
                'default_value' => 'Our Providers',
            ],
            [
                'key' => 'field_providers_intro_heading',
                'label' => 'Intro Heading (optional)',
                'name' => 'providers_intro_heading',
                'type' => 'text',
            ],
            [
                'key' => 'field_providers_intro_body',
                'label' => 'Intro Body',
                'name' => 'providers_intro_body',
                'type' => 'textarea',
                'rows' => 3,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'providers-page',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_providers_grid',
        'title' => 'Providers — Grid',
        'fields' => [
            [
                'key' => 'field_providers_list',
                'label' => 'Providers',
                'name' => 'providers_list',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Provider',
                'sub_fields' => [
                    [
                        'key' => 'field_provider_photo',
                        'label' => 'Photo',
                        'name' => 'photo',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],
                    [
                        'key' => 'field_provider_name',
                        'label' => 'Name & Credentials',
                        'name' => 'name',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_provider_title',
                        'label' => 'Title / Role',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_provider_link',
                        'label' => 'Profile Link',
                        'name' => 'link',
                        'type' => 'link',
                    ],
                ],
            ],
            [
                'key' => 'field_providers_closing_photo',
                'label' => 'Closing Card Photo',
                'name' => 'providers_closing_photo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_providers_closing_role',
                'label' => 'Closing Card Role',
                'name' => 'providers_closing_role',
                'type' => 'text',
                'default_value' => 'Clinic Operations Manager',
            ],
            [
                'key' => 'field_providers_closing_heading',
                'label' => 'Closing Card Heading',
                'name' => 'providers_closing_heading',
                'type' => 'text',
                'default_value' => 'Book a Consultation',
            ],
            [
                'key' => 'field_providers_closing_cta_text',
                'label' => 'Closing Card Button Text',
                'name' => 'providers_closing_cta_text',
                'type' => 'text',
                'default_value' => 'Schedule Consultation',
            ],
            [
                'key' => 'field_providers_closing_cta_link',
                'label' => 'Closing Card Button Link',
                'name' => 'providers_closing_cta_link',
                'type' => 'text',
                'default_value' => '/contact',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'providers-page',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * Services page — alternating service list and the supplement
     * promo banner, on their own "Services Page" options page. Same
     * pattern as the Providers Page groups above.
     */

    acf_add_local_field_group([
        'key' => 'group_services_list',
        'title' => 'Services — List',
        'fields' => [
            [
                'key' => 'field_services_list',
                'label' => 'Services',
                'name' => 'services_list',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Service',
                'sub_fields' => [
                    [
                        'key' => 'field_service_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],
                    [
                        'key' => 'field_service_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_service_body',
                        'label' => 'Body',
                        'name' => 'body',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                    [
                        'key' => 'field_service_link',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'link',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'services-page',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_services_supplement_banner',
        'title' => 'Services — Supplement Banner',
        'fields' => [
            [
                'key' => 'field_services_supplement_image',
                'label' => 'Image',
                'name' => 'services_supplement_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_services_supplement_heading',
                'label' => 'Heading',
                'name' => 'services_supplement_heading',
                'type' => 'text',
                'default_value' => 'The Best Quality Supplement Brands Available',
            ],
            [
                'key' => 'field_services_supplement_body',
                'label' => 'Body',
                'name' => 'services_supplement_body',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_services_supplement_cta_text',
                'label' => 'Button Text',
                'name' => 'services_supplement_cta_text',
                'type' => 'text',
                'default_value' => 'Shop Now',
            ],
            [
                'key' => 'field_services_supplement_cta_link',
                'label' => 'Button Link',
                'name' => 'services_supplement_cta_link',
                'type' => 'text',
                'default_value' => '/dispensary',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'services-page',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * Service Detail page (page-service-detail.php) — restored the
     * optional per-service map override fields (service_map_lat,
     * service_map_lng, service_map_business_name) that were dropped
     * when the Service Pillar group was added; style.css's
     * .service-sidebar-card--map classes depend on them.
     */

    acf_add_local_field_group([
        'key' => 'group_service_detail',
        'title' => 'Service Detail Page',
        'fields' => [
            [
                'key' => 'field_service_banner_image',
                'label' => 'Banner Image',
                'name' => 'service_banner_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_service_intro_content',
                'label' => 'Content',
                'name' => 'service_intro_content',
                'type' => 'wysiwyg',
                'tabs' => 'visual',
                'media_upload' => 0,
                'instructions' => 'Used when "Content Blocks" below is left empty. Simple pages (a single block of copy) can just use this field.',
            ],
            [
                'key' => 'field_service_content_blocks',
                'label' => 'Content Blocks (optional)',
                'name' => 'service_content_blocks',
                'type' => 'flexible_content',
                'button_label' => 'Add Block',
                'instructions' => 'For pages that interleave text with videos/images (e.g. Spravato) — add blocks in the order they should appear. Leave empty to just use the plain "Content" field above instead.',
                'layouts' => [
                    'layout_block_text' => [
                        'key' => 'layout_block_text',
                        'name' => 'text',
                        'label' => 'Text',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_block_text_content',
                                'label' => 'Text',
                                'name' => 'content',
                                'type' => 'wysiwyg',
                                'tabs' => 'visual',
                                'media_upload' => 0,
                            ],
                        ],
                    ],
                    'layout_block_video' => [
                        'key' => 'layout_block_video',
                        'name' => 'video',
                        'label' => 'Video Embed',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_block_video_url',
                                'label' => 'Embed URL',
                                'name' => 'embed_url',
                                'type' => 'url',
                                'instructions' => 'Brightcove / YouTube / Vimeo embed (iframe src) URL.',
                            ],
                            [
                                'key' => 'field_block_video_title',
                                'label' => 'Accessible Title',
                                'name' => 'title',
                                'type' => 'text',
                                'default_value' => 'Video',
                            ],
                        ],
                    ],
                    'layout_block_image' => [
                        'key' => 'layout_block_image',
                        'name' => 'image',
                        'label' => 'Image',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_block_image_image',
                                'label' => 'Image',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'medium',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_service_requirements',
                'label' => 'What You\'ll Need (optional)',
                'name' => 'service_requirements',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Item',
                'sub_fields' => [
                    [
                        'key' => 'field_service_requirement_item',
                        'label' => 'Item',
                        'name' => 'item',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_service_cta_text',
                'label' => 'Sidebar Button Text',
                'name' => 'service_cta_text',
                'type' => 'text',
                'default_value' => 'Schedule Consultation',
            ],
            [
                'key' => 'field_service_cta_link',
                'label' => 'Sidebar Button Link',
                'name' => 'service_cta_link',
                'type' => 'text',
                'instructions' => 'Defaults to the Contact page if left blank.',
            ],
            [
                'key' => 'field_service_map_lat',
                'label' => 'Map Latitude (optional)',
                'name' => 'service_map_lat',
                'type' => 'number',
                'step' => '0.000001',
                'instructions' => 'Leave blank to use the same location as the main Contact page.',
            ],
            [
                'key' => 'field_service_map_lng',
                'label' => 'Map Longitude (optional)',
                'name' => 'service_map_lng',
                'type' => 'number',
                'step' => '0.000001',
                'instructions' => 'Leave blank to use the same location as the main Contact page.',
            ],
            [
                'key' => 'field_service_map_business_name',
                'label' => 'Map Business Name (optional)',
                'name' => 'service_map_business_name',
                'type' => 'text',
                'instructions' => 'Leave blank to use the same name as the main Contact page.',
            ],
            [
                'key' => 'field_service_map_address',
                'label' => 'Map Address Line (optional)',
                'name' => 'service_map_address',
                'type' => 'text',
                'instructions' => 'Leave blank to use the same address as the main Contact page.',
            ],
            [
                'key' => 'field_service_map_directions_url',
                'label' => 'Map "Get Directions" Link (optional)',
                'name' => 'service_map_directions_url',
                'type' => 'url',
                'instructions' => 'Google Maps share link. Leave blank to use the same link as the main Contact page.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-service-detail.php',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * FAQ page (page-faq.php)
     * ---------------------------------------------------------------
     * Same banner/share/sidebar shell as the Service Detail template,
     * with an accordion list of Q&A pairs (.pillar-faq, already in
     * style.css) instead of the service content blocks.
     */

    acf_add_local_field_group([
        'key' => 'group_faq_page',
        'title' => 'FAQ Page',
        'fields' => [
            [
                'key' => 'field_faq_banner_image',
                'label' => 'Banner Image',
                'name' => 'faq_banner_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_faq_heading',
                'label' => 'Heading',
                'name' => 'faq_heading',
                'type' => 'text',
                'default_value' => 'Frequently Asked Questions',
            ],
            [
                'key' => 'field_faq_intro',
                'label' => 'Intro Text',
                'name' => 'faq_intro',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_faq_items',
                'label' => 'Questions',
                'name' => 'faq_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Question',
                'sub_fields' => [
                    [
                        'key' => 'field_faq_item_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_faq_item_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'wysiwyg',
                        'tabs' => 'visual',
                        'media_upload' => 0,
                    ],
                ],
            ],
            [
                'key' => 'field_faq_cta_text',
                'label' => 'Sidebar Button Text',
                'name' => 'faq_cta_text',
                'type' => 'text',
                'default_value' => 'Schedule Consultation',
            ],
            [
                'key' => 'field_faq_cta_link',
                'label' => 'Sidebar Button Link',
                'name' => 'faq_cta_link',
                'type' => 'text',
                'instructions' => 'Defaults to the Contact page if left blank.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-faq.php',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * Existing Patients page (page-existing-patients.php)
     * ---------------------------------------------------------------
     * Intake page: a heading/subheading, a set of clickable "reason
     * for contact" cards, a shared contact form (same field styling
     * as the main Contact page), a requirements checklist (same
     * pattern as the Service Detail page's "What You'll Need"), an
     * FAQ accordion (same pattern/JS as the FAQ page), and a 3-step
     * "what happens next" band.
     */

    acf_add_local_field_group([
        'key' => 'group_existing_patients_page',
        'title' => 'Existing Patients Page',
        'fields' => [
            [
                'key' => 'field_intake_heading',
                'label' => 'Heading',
                'name' => 'intake_heading',
                'type' => 'text',
                'default_value' => 'Existing Patients',
            ],
            [
                'key' => 'field_intake_subheading',
                'label' => 'Subheading',
                'name' => 'intake_subheading',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Already a Pinnacle patient? Let us know what you need and our team will follow up shortly.',
            ],
            [
                'key' => 'field_intake_request_types',
                'label' => 'Request Type Cards',
                'name' => 'intake_request_types',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Request Type',
                'instructions' => 'Leave empty to use the 5 default options (Refill, Appointment, Question, Insurance, Records).',
                'sub_fields' => [
                    [
                        'key' => 'field_intake_type_icon',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => [
                            'refill' => 'Prescription Refill',
                            'calendar' => 'Calendar',
                            'question' => 'Question Mark',
                            'shield' => 'Insurance/Shield',
                            'file' => 'Records/File',
                        ],
                        'default_value' => 'question',
                    ],
                    [
                        'key' => 'field_intake_type_label',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_intake_requirements_heading',
                'label' => 'Checklist Heading',
                'name' => 'intake_requirements_heading',
                'type' => 'text',
                'default_value' => "What You'll Need",
            ],
            [
                'key' => 'field_intake_requirements',
                'label' => 'Checklist Items',
                'name' => 'intake_requirements',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Item',
                'sub_fields' => [
                    [
                        'key' => 'field_intake_requirement_item',
                        'label' => 'Item',
                        'name' => 'item',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_intake_faq_heading',
                'label' => 'FAQ Heading',
                'name' => 'intake_faq_heading',
                'type' => 'text',
                'default_value' => 'Frequently Asked Questions',
            ],
            [
                'key' => 'field_intake_faqs',
                'label' => 'FAQs',
                'name' => 'intake_faqs',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add FAQ',
                'sub_fields' => [
                    [
                        'key' => 'field_intake_faq_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_intake_faq_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'wysiwyg',
                        'tabs' => 'visual',
                        'media_upload' => 0,
                    ],
                ],
            ],
            [
                'key' => 'field_intake_next_steps',
                'label' => 'What Happens Next (3 steps)',
                'name' => 'intake_next_steps',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Step',
                'sub_fields' => [
                    [
                        'key' => 'field_intake_next_step_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_intake_next_step_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-existing-patients.php',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * Blog Archive page (page-blog.php)
     * ---------------------------------------------------------------
     * Only the banner image is a field here — everything else on that
     * template comes from real Posts, not ACF content.
     */

    acf_add_local_field_group([
        'key' => 'group_blog_page',
        'title' => 'Blog Archive Page',
        'fields' => [
            [
                'key' => 'field_blog_banner_image',
                'label' => 'Banner Image',
                'name' => 'blog_banner_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-blog.php',
                ],
            ],
        ],
    ]);

    /**
     * ---------------------------------------------------------------
     * Contact page (page-contact.php)
     * ---------------------------------------------------------------
     * Heading/intro only — address, phone, map, and socials all come
     * from the shared "Contact Section" options group above so they
     * only need setting in one place. The service dropdown reuses the
     * existing Services Page "services_list" option.
     */

    acf_add_local_field_group([
        'key' => 'group_contact_page',
        'title' => 'Contact Page',
        'fields' => [
            [
                'key' => 'field_contact_heading',
                'label' => 'Heading',
                'name' => 'contact_heading',
                'type' => 'text',
                'default_value' => 'Schedule a Consultation',
            ],
            [
                'key' => 'field_contact_intro',
                'label' => 'Intro Text',
                'name' => 'contact_intro',
                'type' => 'textarea',
                'rows' => 3,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-contact.php',
                ],
            ],
        ],
    ]);


acf_add_local_field_group([
    'key' => 'group_insurance_page',
    'title' => 'Insurance Page',
    'fields' => [

        [
            'key' => 'field_insurance_hero_image',
            'label' => 'Hero Image',
            'name' => 'insurance_hero_image',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ],

        [
            'key' => 'field_insurance_page_title',
            'label' => 'Page Title',
            'name' => 'insurance_page_title',
            'type' => 'text',
            'default_value' => 'Mental Health & Psychiatry Insurance Accepted | Edina, MN',
        ],

        [
            'key' => 'field_insurance_intro_heading',
            'label' => 'Intro Heading',
            'name' => 'insurance_intro_heading',
            'type' => 'text',
            'default_value' => 'We eliminate the guesswork from insurance verification so you can focus purely on recovery.',
        ],

        [
            'key' => 'field_insurance_intro_body',
            'label' => 'Intro Body',
            'name' => 'insurance_intro_body',
            'type' => 'textarea',
            'rows' => 5,
        ],

        [
            'key' => 'field_insurance_providers_heading',
            'label' => 'Insurance Providers Heading',
            'name' => 'insurance_providers_heading',
            'type' => 'text',
            'default_value' => 'In-Network Insurance Providers',
        ],

        [
            'key' => 'field_insurance_providers_intro',
            'label' => 'Insurance Providers Intro',
            'name' => 'insurance_providers_intro',
            'type' => 'textarea',
            'rows' => 3,
            'default_value' => 'Below is the structured list of insurance carriers currently accepted at our Edina clinic.',
        ],

        [
            'key' => 'field_insurance_providers',
            'label' => 'Insurance Carriers',
            'name' => 'insurance_providers',
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => 'Add Insurance Carrier',

            'sub_fields' => [

                [
                    'key' => 'field_insurance_provider_logo',
                    'label' => 'Insurance Logo',
                    'name' => 'logo',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ],

                [
                    'key' => 'field_insurance_provider_name',
                    'label' => 'Insurance Carrier Name',
                    'name' => 'name',
                    'type' => 'text',
                ],

                [
                    'key' => 'field_insurance_provider_medication',
                    'label' => 'Medication Management',
                    'name' => 'medication_management',
                    'type' => 'text',
                    'default_value' => 'In-Network',
                ],

                [
                    'key' => 'field_insurance_provider_tms',
                    'label' => 'NeuroStar TMS Therapy',
                    'name' => 'tms',
                    'type' => 'text',
                    'default_value' => 'Covered — Prior Authorization Required',
                ],

                [
                    'key' => 'field_insurance_provider_spravato',
                    'label' => 'Spravato (Esketamine)',
                    'name' => 'spravato',
                    'type' => 'text',
                    'default_value' => 'Covered — Prior Authorization Required',
                ],

            ],
        ],

        [
            'key' => 'field_insurance_cta_heading',
            'label' => 'CTA Heading',
            'name' => 'insurance_cta_heading',
            'type' => 'text',
            'default_value' => 'Book a Consultation',
        ],

        [
            'key' => 'field_insurance_cta_text',
            'label' => 'CTA Button Text',
            'name' => 'insurance_cta_text',
            'type' => 'text',
            'default_value' => 'Schedule Consultation',
        ],

        [
            'key' => 'field_insurance_cta_link',
            'label' => 'CTA Button Link',
            'name' => 'insurance_cta_link',
            'type' => 'url',
        ],

    ],

    'location' => [
        [
            [
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'insurance-page',
            ],
        ],
    ],
]);


}

function pinnacle_enqueue_homepage_scripts() {
    if (is_front_page()) {
        wp_enqueue_script(
            'pinnacle-homepage',
            get_template_directory_uri() . '/assets/js/homepage.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/homepage.js'),
            true
        );
    }
}
/**
 * Medical Professionals Custom Post Type
 */
function pinnacle_register_provider_cpt() {

    $labels = array(
        'name'               => 'Medical Professionals',
        'singular_name'      => 'Medical Professional',
        'menu_name'          => 'Medical Professionals',
        'add_new'            => 'Add Professional',
        'add_new_item'       => 'Add New Medical Professional',
        'edit_item'          => 'Edit Medical Professional',
        'new_item'           => 'New Medical Professional',
        'view_item'          => 'View Medical Professional',
        'search_items'       => 'Search Medical Professionals',
        'not_found'          => 'No medical professionals found',
        'not_found_in_trash' => 'No medical professionals found in trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array('title', 'thumbnail'),
        'has_archive'        => false,
        'rewrite'            => array(
            'slug'       => 'provider',
            'with_front' => false,
        ),
        'show_in_rest'       => true,
    );

    register_post_type('provider', $args);
}
add_action('init', 'pinnacle_register_provider_cpt');


/* =========================================================
 * TESTIMONIALS CUSTOM POST TYPE
 * ========================================================= */

function pinnacle_register_testimonial_cpt() {

    $labels = array(
        'name'                  => 'Testimonials',
        'singular_name'         => 'Testimonial',
        'menu_name'             => 'Testimonials',
        'add_new'               => 'Add Testimonial',
        'add_new_item'          => 'Add New Testimonial',
        'edit_item'             => 'Edit Testimonial',
        'new_item'              => 'New Testimonial',
        'view_item'             => 'View Testimonial',
        'search_items'          => 'Search Testimonials',
        'not_found'             => 'No testimonials found',
        'not_found_in_trash'    => 'No testimonials found in trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'editor'),
        'show_in_rest'       => true,
    );

    register_post_type(
        'testimonial',
        $args
    );
}

add_action(
    'init',
    'pinnacle_register_testimonial_cpt'
);


/* =========================================================
 * TESTIMONIAL META BOX
 * ========================================================= */

function pinnacle_add_testimonial_meta_box() {

    add_meta_box(
        'pinnacle_testimonial_information',
        'Testimonial Information',
        'pinnacle_render_testimonial_meta_box',
        'testimonial',
        'normal',
        'high'
    );
}

add_action(
    'add_meta_boxes',
    'pinnacle_add_testimonial_meta_box'
);


function pinnacle_render_testimonial_meta_box( $post ) {

    wp_nonce_field(
        'pinnacle_save_testimonial',
        'pinnacle_testimonial_nonce'
    );

    $reviewer_name = get_post_meta(
        $post->ID,
        '_testimonial_reviewer_name',
        true
    );

    $source = get_post_meta(
        $post->ID,
        '_testimonial_source',
        true
    );

    ?>

    <p>
        <label
            for="pinnacle_testimonial_reviewer_name"
            style="display:block;font-weight:600;margin-bottom:6px;"
        >
            Reviewer Name
        </label>

        <input
            type="text"
            id="pinnacle_testimonial_reviewer_name"
            name="pinnacle_testimonial_reviewer_name"
            value="<?php echo esc_attr( $reviewer_name ); ?>"
            placeholder="Ikram Osman"
            style="width:100%;max-width:600px;"
        >
    </p>


    <p>
        <label
            for="pinnacle_testimonial_source"
            style="display:block;font-weight:600;margin-bottom:6px;"
        >
            Source
        </label>

        <input
            type="text"
            id="pinnacle_testimonial_source"
            name="pinnacle_testimonial_source"
            value="<?php echo esc_attr( $source ); ?>"
            placeholder="Google"
            style="width:100%;max-width:600px;"
        >
    </p>

    <p style="color:#646970;">
        Enter the testimonial itself in the normal WordPress editor above/below.
    </p>

    <?php
}


function pinnacle_save_testimonial(
    $post_id
) {

    if (
        ! isset(
            $_POST['pinnacle_testimonial_nonce']
        )
    ) {
        return;
    }

    if (
        ! wp_verify_nonce(
            $_POST['pinnacle_testimonial_nonce'],
            'pinnacle_save_testimonial'
        )
    ) {
        return;
    }

    if (
        defined( 'DOING_AUTOSAVE' )
        && DOING_AUTOSAVE
    ) {
        return;
    }

    if (
        wp_is_post_revision( $post_id )
    ) {
        return;
    }

    if (
        ! current_user_can(
            'edit_post',
            $post_id
        )
    ) {
        return;
    }

    if (
        get_post_type( $post_id ) !== 'testimonial'
    ) {
        return;
    }


    if (
        isset(
            $_POST['pinnacle_testimonial_reviewer_name']
        )
    ) {

        update_post_meta(
            $post_id,
            '_testimonial_reviewer_name',
            sanitize_text_field(
                $_POST['pinnacle_testimonial_reviewer_name']
            )
        );

    }


    if (
        isset(
            $_POST['pinnacle_testimonial_source']
        )
    ) {

        update_post_meta(
            $post_id,
            '_testimonial_source',
            sanitize_text_field(
                $_POST['pinnacle_testimonial_source']
            )
        );

    }

}

add_action(
    'save_post_testimonial',
    'pinnacle_save_testimonial'
);

/**
 * Medical Professional ACF Fields
 */
function pinnacle_register_provider_fields() {

    if ( ! function_exists('acf_add_local_field_group') ) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_provider_information',
        'title' => 'Medical Professional Information',
        'fields' => array(

            array(
                'key' => 'field_provider_photo',
                'label' => 'Professional Photo',
                'name' => 'provider_photo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),

            array(
                'key' => 'field_provider_credentials',
                'label' => 'Name & Credentials',
                'name' => 'provider_credentials',
                'type' => 'text',
                'placeholder' => 'Dara Awosika BSW, MSW, LICSW',
            ),

            array(
                'key' => 'field_provider_title',
                'label' => 'Professional Title',
                'name' => 'provider_title',
                'type' => 'text',
                'placeholder' => 'Psychotherapist',
            ),

            array(
                'key' => 'field_provider_bio',
                'label' => 'Biography',
                'name' => 'provider_bio',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => false,
            ),

            array(
                'key' => 'field_provider_education',
                'label' => 'Education',
                'name' => 'provider_education',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => false,
            ),

            array(
                'key' => 'field_provider_philosophy',
                'label' => 'Treatment Philosophy',
                'name' => 'provider_treatment_philosophy',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => false,
            ),

            array(
                'key' => 'field_provider_modalities',
                'label' => 'Therapy Modalities',
                'name' => 'provider_therapy_modalities',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => false,
            ),
    array(
      'key' => 'field_provider_email',
      'label' => 'Provider Email',
     'name' => 'provider_email',
    'type' => 'email',
    'instructions' => 'Email address that should receive booking requests for this provider.',
    'placeholder' => 'provider@example.com',
    ),

            array(
                'key' => 'field_provider_focus',
                'label' => 'Areas of Focus',
                'name' => 'provider_areas_of_focus',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => false,
            ),

            array(
                'key' => 'field_provider_experience',
                'label' => 'Professional Experience',
                'name' => 'provider_professional_experience',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => false,
            ),

            array(
                'key' => 'field_provider_community',
                'label' => 'Community Involvement',
                'name' => 'provider_community_involvement',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => false,
            ),

            array(
                'key' => 'field_provider_consultation',
                'label' => 'Consultation Link',
                'name' => 'provider_consultation_link',
                'type' => 'url',
                'placeholder' => 'https://...',
            ),
            /* =========================================================
 * OPTIONAL PROVIDER SECTIONS
 * ========================================================= */

/*
 * Psychology Today
 */
array(
    'key' => 'field_provider_psychology_today',
    'label' => 'Psychology Today Profile',
    'name' => 'provider_psychology_today_url',
    'type' => 'url',
    'instructions' => 'Optional. Add the provider\'s Psychology Today profile URL.',
    'placeholder' => 'https://www.psychologytoday.com/...',
),

/*
 * Show Testimonials
 */
array(
    'key' => 'field_provider_show_testimonials',
    'label' => 'Show Testimonials',
    'name' => 'provider_show_testimonials',
    'type' => 'true_false',
    'instructions' => 'Turn this on to display the Testimonials section on this provider page.',
    'default_value' => 0,
    'ui' => 1,
    'ui_on_text' => 'Yes',
    'ui_off_text' => 'No',
),

array(
    'key' => 'field_provider_testimonials_heading',
    'label' => 'Testimonials Section Heading',
    'name' => 'provider_testimonials_heading',
    'type' => 'text',
    'instructions' => 'Optional. Enter the heading to display above this provider\'s testimonials.',
    'default_value' => 'Testimonials',
    'placeholder' => 'Testimonials',
),


        ),

        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'provider',
                ),
            ),
        ),

        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ));
}

add_action('acf/init', 'pinnacle_register_provider_fields');

/* =========================================================
 * NATIVE PROVIDER TESTIMONIALS
 * Does not require ACF Pro.
 * ========================================================= */



/* =========================================================
 * BLOG POSTS CUSTOM POST TYPE
 * ========================================================= */

/* =========================================================
 * BLOG POSTS CUSTOM POST TYPE
 * ========================================================= */

function pinnacle_register_blog_post_cpt() {

    $labels = array(
        'name'               => 'Blog Posts',
        'singular_name'      => 'Blog Post',
        'menu_name'          => 'Blog Posts',
        'name_admin_bar'     => 'Blog Post',
        'add_new'            => 'Add Post',
        'add_new_item'       => 'Add New Blog Post',
        'new_item'           => 'New Blog Post',
        'edit_item'          => 'Edit Blog Post',
        'view_item'          => 'View Blog Post',
        'all_items'          => 'Blog Posts',
        'search_items'       => 'Search Blog Posts',
        'not_found'          => 'No blog posts found.',
        'not_found_in_trash' => 'No blog posts found in Trash.',
    );

    $args = array(
        'labels' => $labels,

        'public' => true,

        'publicly_queryable' => true,

        'show_ui' => true,

        'show_in_menu' => true,

        'show_in_rest' => true,

        'menu_icon' => 'dashicons-edit-page',

        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'author',
        ),

        'has_archive' => false,

        'query_var' => true,

        'rewrite' => array(
            'slug'       => 'blog',
            'with_front' => false,
        ),
    );

    register_post_type(
        'blog_post',
        $args
    );
}

add_action(
    'init',
    'pinnacle_register_blog_post_cpt'
);




/**
 * Add the Testimonials metabox.
 */
function pinnacle_add_provider_testimonials_metabox() {

    add_meta_box(
        'pinnacle_provider_testimonials',
        'Provider Testimonials',
        'pinnacle_render_provider_testimonials_metabox',
        'provider',
        'normal',
        'default'
    );
}

add_action(
    'add_meta_boxes',
    'pinnacle_add_provider_testimonials_metabox'
);


/**
 * Render the Testimonials editor.
 */
function pinnacle_render_provider_testimonials_metabox( $post ) {

    wp_nonce_field(
        'pinnacle_save_provider_testimonials',
        'pinnacle_provider_testimonials_nonce'
    );

    $testimonials = get_post_meta(
        $post->ID,
        '_pinnacle_provider_testimonials',
        true
    );

    if ( ! is_array( $testimonials ) ) {
        $testimonials = array();
    }

    ?>

    <div
        id="pinnacle-testimonials-editor"
        class="pinnacle-testimonials-editor"
    >

        <p>
            Add the testimonials you have permission to publish for this
            medical professional.
        </p>


        <div
            id="pinnacle-testimonial-items"
        >

            <?php

            if ( ! empty( $testimonials ) ) :

                foreach (
                    $testimonials as $index => $testimonial
                ) :

                    pinnacle_render_provider_testimonial_row(
                        $index,
                        $testimonial
                    );

                endforeach;

            else :

                pinnacle_render_provider_testimonial_row(
                    0,
                    array()
                );

            endif;

            ?>

        </div>


        <p>

            <button
                type="button"
                class="button button-primary"
                id="pinnacle-add-testimonial"
            >
                + Add Testimonial
            </button>

        </p>

    </div>


    <script type="text/html" id="pinnacle-testimonial-template">

        <?php
        pinnacle_render_provider_testimonial_row(
            '__INDEX__',
            array()
        );
        ?>

    </script>


    <style>

        .pinnacle-testimonials-editor {
            max-width: 100%;
        }

        .pinnacle-testimonial-row {
            margin-bottom: 20px;
            padding: 20px;

            border: 1px solid #dcdcde;
            background: #fff;
            box-sizing: border-box;
        }

        .pinnacle-testimonial-row__grid {
            display: grid;
            grid-template-columns:
                100px
                1fr
                180px;

            gap: 15px;
            margin-bottom: 15px;
        }

        .pinnacle-testimonial-field label {
            display: block;

            margin-bottom: 6px;

            font-weight: 600;
        }

        .pinnacle-testimonial-field input,
        .pinnacle-testimonial-field textarea {
            width: 100%;
            box-sizing: border-box;
        }

        .pinnacle-testimonial-field--full {
            margin-bottom: 15px;
        }

        .pinnacle-testimonial-field--initial input {
            max-width: 80px;
        }

        .pinnacle-remove-testimonial {
            color: #b32d2e !important;
        }

        @media (max-width: 782px) {

            .pinnacle-testimonial-row__grid {
                grid-template-columns: 1fr;
            }

            .pinnacle-testimonial-field--initial input {
                max-width: none;
            }

        }

    </style>


    <script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const container =
                document.getElementById(
                    'pinnacle-testimonial-items'
                );

            const addButton =
                document.getElementById(
                    'pinnacle-add-testimonial'
                );

            const template =
                document.getElementById(
                    'pinnacle-testimonial-template'
                );


            if (
                !container ||
                !addButton ||
                !template
            ) {
                return;
            }


            let index =
                container.querySelectorAll(
                    '.pinnacle-testimonial-row'
                ).length;


            addButton.addEventListener(
                'click',
                function () {

                    const html =
                        template.innerHTML.replace(
                            /__INDEX__/g,
                            index
                        );

                    container.insertAdjacentHTML(
                        'beforeend',
                        html
                    );

                    index++;

                }
            );


            container.addEventListener(
                'click',
                function (event) {

                    const removeButton =
                        event.target.closest(
                            '.pinnacle-remove-testimonial'
                        );

                    if ( ! removeButton ) {
                        return;
                    }


                    const row =
                        removeButton.closest(
                            '.pinnacle-testimonial-row'
                        );

                    if ( row ) {
                        row.remove();
                    }

                }
            );

        }
    );

    </script>

    <?php
}


/**
 * Output one testimonial row.
 */
function pinnacle_render_provider_testimonial_row(
    $index,
    $testimonial
) {

    $initial =
        isset( $testimonial['initial'] )
            ? $testimonial['initial']
            : '';

    $name =
        isset( $testimonial['name'] )
            ? $testimonial['name']
            : '';

    $role =
        isset( $testimonial['role'] )
            ? $testimonial['role']
            : '';

    $text =
        isset( $testimonial['text'] )
            ? $testimonial['text']
            : '';

    ?>

    <div
        class="pinnacle-testimonial-row"
        data-index="<?php echo esc_attr( $index ); ?>"
    >

        <div
            class="pinnacle-testimonial-row__grid"
        >


            <!-- Initial -->

            <div
                class="pinnacle-testimonial-field pinnacle-testimonial-field--initial"
            >

                <label>
                    Initial
                </label>

                <input
                    type="text"
                    name="pinnacle_testimonials[<?php echo esc_attr( $index ); ?>][initial]"
                    value="<?php echo esc_attr( $initial ); ?>"
                    maxlength="1"
                    placeholder="J"
                >

            </div>


            <!-- Name -->

            <div
                class="pinnacle-testimonial-field"
            >

                <label>
                    Name
                </label>

                <input
                    type="text"
                    name="pinnacle_testimonials[<?php echo esc_attr( $index ); ?>][name]"
                    value="<?php echo esc_attr( $name ); ?>"
                    placeholder="J.R. or Anonymous"
                >

            </div>


            <!-- Role -->

            <div
                class="pinnacle-testimonial-field"
            >

                <label>
                    Role
                </label>

                <input
                    type="text"
                    name="pinnacle_testimonials[<?php echo esc_attr( $index ); ?>][role]"
                    value="<?php echo esc_attr( $role ); ?>"
                    placeholder="Client"
                >

            </div>

        </div>


        <!-- Testimonial -->

        <div
            class="pinnacle-testimonial-field pinnacle-testimonial-field--full"
        >

            <label>
                Testimonial
            </label>

            <textarea
                name="pinnacle_testimonials[<?php echo esc_attr( $index ); ?>][text]"
                rows="5"
                placeholder="Enter the testimonial..."
            ><?php echo esc_textarea( $text ); ?></textarea>

        </div>


        <button
            type="button"
            class="button pinnacle-remove-testimonial"
        >
            Remove Testimonial
        </button>

    </div>

    <?php
}


/**
 * Save the testimonials.
 */
function pinnacle_save_provider_testimonials(
    $post_id
) {

    /*
     * Nonce check.
     */
    if (
        ! isset(
            $_POST['pinnacle_provider_testimonials_nonce']
        )
    ) {
        return;
    }


    if (
        ! wp_verify_nonce(
            $_POST['pinnacle_provider_testimonials_nonce'],
            'pinnacle_save_provider_testimonials'
        )
    ) {
        return;
    }


    /*
     * Autosave check.
     */
    if (
        defined( 'DOING_AUTOSAVE' )
        && DOING_AUTOSAVE
    ) {
        return;
    }


    /*
     * Revision check.
     */
    if (
        wp_is_post_revision( $post_id )
    ) {
        return;
    }


    /*
     * Permission check.
     */
    if (
        ! current_user_can(
            'edit_post',
            $post_id
        )
    ) {
        return;
    }


    /*
     * Only providers.
     */
    if (
        get_post_type( $post_id ) !== 'provider'
    ) {
        return;
    }


    $submitted =
        isset(
            $_POST['pinnacle_testimonials']
        )
            ? $_POST['pinnacle_testimonials']
            : array();


    $clean = array();


    if ( is_array( $submitted ) ) {

        foreach (
            $submitted as $testimonial
        ) {

            $initial =
                isset( $testimonial['initial'] )
                    ? sanitize_text_field(
                        $testimonial['initial']
                    )
                    : '';

            $name =
                isset( $testimonial['name'] )
                    ? sanitize_text_field(
                        $testimonial['name']
                    )
                    : '';

            $role =
                isset( $testimonial['role'] )
                    ? sanitize_text_field(
                        $testimonial['role']
                    )
                    : '';

            $text =
                isset( $testimonial['text'] )
                    ? sanitize_textarea_field(
                        $testimonial['text']
                    )
                    : '';


            /*
             * Don't save completely empty rows.
             */
            if (
                $initial === ''
                && $name === ''
                && $role === ''
                && $text === ''
            ) {
                continue;
            }


            $clean[] = array(
                'initial' => mb_substr(
                    $initial,
                    0,
                    1
                ),
                'name'    => $name,
                'role'    => $role,
                'text'    => $text,
            );

        }

    }


    if ( ! empty( $clean ) ) {

        update_post_meta(
            $post_id,
            '_pinnacle_provider_testimonials',
            $clean
        );

    } else {

        delete_post_meta(
            $post_id,
            '_pinnacle_provider_testimonials'
        );

    }

}

add_action(
    'save_post_provider',
    'pinnacle_save_provider_testimonials'
);

add_action('wp_enqueue_scripts', 'pinnacle_enqueue_homepage_scripts');
/* =========================================================
   Cart page - "Return to Shop" points to the real store
   (Fullscript), not the unused local WooCommerce shop page
   ========================================================= */

add_filter('woocommerce_return_to_shop_redirect', function () {
    return 'https://us.fullscript.com/s/pinnaclebhc/shop';
});


/* =========================================================
 * GOOGLE FONT RESOURCE HINTS
 * ========================================================= */
function pinnacle_resource_hints($urls, $relation_type) {
    if ('preconnect' !== $relation_type) {
        return $urls;
    }

    $urls[] = [
        'href' => 'https://fonts.googleapis.com',
    ];

    $urls[] = [
        'href' => 'https://fonts.gstatic.com',
        'crossorigin',
    ];

    return $urls;
}
add_filter('wp_resource_hints', 'pinnacle_resource_hints', 10, 2);


/* =========================================================
 * EDINA LOCATION PAGE
 * ========================================================= */
function pinnacle_enqueue_edina_location_assets() {
    if (!is_page_template('page-edina.php')) {
        return;
    }

    $js_file = get_template_directory() . '/assets/js/edina.js';

    if (file_exists($js_file)) {
        wp_enqueue_script(
            'pinnacle-edina-location',
            get_template_directory_uri() . '/assets/js/edina.js',
            [],
            filemtime($js_file),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'pinnacle_enqueue_edina_location_assets');

function pinnacle_edina_location_document_title($title) {
    if (is_page_template('page-edina.php')) {
        return 'Psychiatric & Behavioral Health Care in Edina, MN | Pinnacle Behavioral Healthcare';
    }

    return $title;
}
add_filter('pre_get_document_title', 'pinnacle_edina_location_document_title');

function pinnacle_edina_location_schema() {
    if (!is_page_template('page-edina.php')) {
        return;
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'MedicalClinic',
        'name' => 'Pinnacle Behavioral Healthcare | Edina',
        'image' => 'https://pinnaclebhc.com/wp-content/uploads/2024/05/Pinnacle_Logo_final_L.webp',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => '6600 France Ave S, Suite 415',
            'addressLocality' => 'Edina',
            'addressRegion' => 'MN',
            'postalCode' => '55435',
            'addressCountry' => 'US',
        ],
        'url' => home_url('/locations/edina/'),
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.6',
            'reviewCount' => '274',
        ],
        'medicalSpecialty' => 'Psychiatric',
    ];

    echo '<script type="application/ld+json">'
        . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . '</script>';
}
add_action('wp_head', 'pinnacle_edina_location_schema', 20);


/* =========================================================
 * TELEHEALTH PAGE
 * ========================================================= */
function pinnacle_telehealth_assets() {
    $is_telehealth = is_page('telehealth')
        || is_page_template('telehealth-psychiatric-medication-management-in-minneapolis.php')
        || is_page_template('page-service-detail.php');

    if (!$is_telehealth) {
        return;
    }

    $js_file = get_template_directory() . '/assets/js/telehealth-consult-modal.js';

    if (file_exists($js_file)) {
        wp_enqueue_script(
            'pinnacle-telehealth-consult-modal',
            get_template_directory_uri() . '/assets/js/telehealth-consult-modal.js',
            [],
            filemtime($js_file),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'pinnacle_telehealth_assets', 20);


/* =========================================================
 * NEW PATIENTS PAGE
 * ========================================================= */
function pinnacle_new_patients_assets() {
    if (!is_page_template('page-new-patients.php')) {
        return;
    }

    $css_file = get_template_directory() . '/assets/css/new-patients.css';
    $js_file  = get_template_directory() . '/assets/js/new-patients.js';

    if (file_exists($css_file)) {
        wp_enqueue_style(
            'pinnacle-new-patients',
            get_template_directory_uri() . '/assets/css/new-patients.css',
            [],
            filemtime($css_file)
        );
    }

    if (file_exists($js_file)) {
        wp_enqueue_script(
            'pinnacle-new-patients',
            get_template_directory_uri() . '/assets/js/new-patients.js',
            [],
            filemtime($js_file),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'pinnacle_new_patients_assets', 20);


/* =========================================================
 * WOOCOMMERCE / FULLSCRIPT
 * ========================================================= */
add_filter('woocommerce_return_to_shop_redirect', function () {
    return 'https://us.fullscript.com/s/pinnaclebhc/shop';
});


/* =========================================================
 * CONTACT FORM 7 — ROUTE PROVIDER BOOKING EMAIL
 * ========================================================= */
/* =========================================================
 * PROVIDER BOOKING EMAIL ROUTING
 * =========================================================
 *
 * Contact Form 7 form ID: f756eed
 *
 * The booking form submits provider_id.
 * We use that ID to find the provider's ACF
 * provider_email field and send the form to that
 * provider.
 * ========================================================= */

add_filter(
    'wpcf7_mail_components',
    'pinnacle_route_provider_booking_email',
    10,
    3
);

function pinnacle_route_provider_booking_email(
    $components,
    $contact_form,
    $mail
) {

    /*
     * Only run for the Provider Booking Form.
     */
    if (
        ! $contact_form ||
        (string) $contact_form->id() !== 'f756eed'
    ) {
        return $components;
    }


    /*
     * Get the current Contact Form 7 submission.
     */
    $submission = WPCF7_Submission::get_instance();

    if ( ! $submission ) {
        return $components;
    }


    /*
     * Get the provider ID from the hidden form field.
     */
    $provider_id = $submission->get_posted_data(
        'provider_id'
    );

    $provider_id = absint( $provider_id );


    /*
     * If no provider ID was submitted,
     * keep the normal Contact Form 7 recipient.
     */
    if ( ! $provider_id ) {
        return $components;
    }


    /*
     * Make sure this is actually a provider post.
     */
    if (
        get_post_type( $provider_id ) !== 'provider'
    ) {
        return $components;
    }


    /*
     * Get the provider email from ACF.
     */
    $provider_email = get_field(
        'provider_email',
        $provider_id
    );
    
    error_log(
    'PROVIDER BOOKING ROUTING: provider_id=' .
    $provider_id .
    ' email=' .
    $provider_email
);


    /*
     * Make sure the email is valid.
     */
    if (
        ! $provider_email ||
        ! is_email( $provider_email )
    ) {
        return $components;
    }


    /*
     * Replace Contact Form 7's recipient.
     */
    $components['recipient'] = sanitize_email(
        $provider_email
    );


    return $components;
}

function pinnacle_enqueue_insurance_accepted_assets() {
    if ( ! is_page_template( 'page-insurance-accepted.php' ) ) {
        return;
    }

    $css_file = get_template_directory() . '/style.css';
    $css_uri  = get_template_directory_uri() . '/style.css';

    wp_enqueue_style(
        'pinnacle-insurance-accepted',
        $css_uri,
        array('pinnacle-style'),
        file_exists($css_file) ? filemtime($css_file) : '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'pinnacle_enqueue_insurance_accepted_assets');



function pinnacle_register_insurance_accepted_fields() {

    if ( ! function_exists('acf_add_local_field_group') ) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_insurance_accepted_page',
        'title' => 'Insurance Accepted Page',

        // ... all the fields ...

        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-insurance-accepted.php',
                ),
            ),
        ),
    ));
}

add_action(
    'acf/init',
    'pinnacle_register_insurance_accepted_fields'
);


/* =========================================================
 * INSURANCE PROVIDERS
 * ========================================================= */

function pinnacle_register_insurance_provider_cpt() {

    $labels = array(
        'name'               => 'Insurance Providers',
        'singular_name'      => 'Insurance Provider',
        'menu_name'          => 'Insurance Providers',
        'name_admin_bar'     => 'Insurance Provider',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Insurance Provider',
        'new_item'           => 'New Insurance Provider',
        'edit_item'          => 'Edit Insurance Provider',
        'view_item'          => 'View Insurance Provider',
        'all_items'          => 'Insurance Providers',
        'search_items'       => 'Search Insurance Providers',
        'not_found'          => 'No insurance providers found.',
        'not_found_in_trash' => 'No insurance providers found in Trash.',
    );

    $args = array(
        'labels' => $labels,

        'public' => false,

        'show_ui' => true,

        'show_in_menu' => true,

        'show_in_rest' => true,

        'menu_icon' => 'dashicons-shield',

        'supports' => array(
            'title',
        ),

        'capability_type' => 'post',

        'has_archive' => false,

        'rewrite' => false,
    );

    register_post_type(
        'insurance_provider',
        $args
    );
}

add_action(
    'init',
    'pinnacle_register_insurance_provider_cpt'
);


/* =========================================================
 * INSURANCE PROVIDER FIELDS
 * ========================================================= */

function pinnacle_register_insurance_provider_fields() {

    if (
        ! function_exists(
            'acf_add_local_field_group'
        )
    ) {
        return;
    }

    acf_add_local_field_group(
        array(

            'key' => 'group_insurance_provider',

            'title' => 'Insurance Provider Information',

            'fields' => array(

                /*
                 * LOGO
                 */
                array(
                    'key' => 'field_insurance_provider_logo',

                    'label' => 'Insurance Logo',

                    'name' => 'insurance_logo',

                    'type' => 'image',

                    'return_format' => 'array',

                    'preview_size' => 'medium',

                    'library' => 'all',
                ),

                /*
                 * MEDICATION MANAGEMENT
                 */
                array(
                    'key' => 'field_insurance_medication',

                    'label' => 'Medication Management',

                    'name' => 'insurance_medication',

                    'type' => 'text',

                    'default_value' => 'In-Network',

                    'placeholder' => 'In-Network',
                ),

                /*
                 * NEUROSTAR TMS
                 */
                array(
                    'key' => 'field_insurance_tms',

                    'label' => 'NeuroStar TMS Therapy',

                    'name' => 'insurance_tms',

                    'type' => 'text',

                    'default_value' =>
                        'Covered — Prior Authorization Required',

                    'placeholder' =>
                        'Covered — Prior Authorization Required',
                ),

                /*
                 * SPRAVATO
                 */
                array(
                    'key' => 'field_insurance_spravato',

                    'label' => 'Spravato (Esketamine)',

                    'name' => 'insurance_spravato',

                    'type' => 'text',

                    'default_value' =>
                        'Covered — Prior Authorization Required',

                    'placeholder' =>
                        'Covered — Prior Authorization Required',
                ),

                /*
                 * DISPLAY ORDER
                 */
                array(
                    'key' => 'field_insurance_order',

                    'label' => 'Display Order',

                    'name' => 'insurance_order',

                    'type' => 'number',

                    'default_value' => 10,

                    'instructions' =>
                        'Lower numbers appear first on the Insurance Accepted page.',
                ),

            ),

            'location' => array(

                array(

                    array(

                        'param' =>
                            'post_type',

                        'operator' =>
                            '==',

                        'value' =>
                            'insurance_provider',

                    ),

                ),

            ),

            'position' => 'normal',

            'style' => 'default',

            'active' => true,
        )
    );
}

add_action(
    'acf/init',
    'pinnacle_register_insurance_provider_fields'
);

add_action(
    'pre_get_posts',
    'pinnacle_extend_search_post_types'
);

function pinnacle_extend_search_post_types( $query ) {

    if (
        is_admin()
        || ! $query->is_main_query()
        || ! $query->is_search()
    ) {
        return;
    }

    $query->set(
        'post_type',
        array(
            'page',
            'post',
            'blog_post',
            'provider',
        )
    );
}


