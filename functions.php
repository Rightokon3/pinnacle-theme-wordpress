<?php

function pinnacle_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary' => 'Primary Menu',
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

if (function_exists('acf_add_options_page')) {
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
}

/* =========================================================
   Cart page - "Return to Shop" points to the real store
   (Fullscript), not the unused local WooCommerce shop page
   ========================================================= */

add_filter('woocommerce_return_to_shop_redirect', function () {
    return 'https://us.fullscript.com/s/pinnaclebhc/shop';
});