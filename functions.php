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
}
function pinnacle_theme_fonts() {
    wp_enqueue_style(
        'pinnacle-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap',
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
     * Service Detail page (page-service-detail.php) — this field
     * group was in an earlier version of this file and had been
     * dropped; re-added here since style.css's .service-detail
     * classes depend on it.
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
}