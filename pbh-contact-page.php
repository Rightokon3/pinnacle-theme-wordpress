<?php
/**
 * Plugin Name: PBH Contact Page Support
 * Description: Isolated assets and form handler for the PBH Contact Page template.
 * Version: 1.0.0
 * Author: Right
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load ONLY the CSS/JS used by the PBH Contact Page template.
 */
function pbh_contact_page_assets() {
    if (!is_page_template('page-pbh-contact.php')) {
        return;
    }

    $css_file = get_template_directory() . '/assets/css/pbh-contact-page.css';
    $js_file  = get_template_directory() . '/assets/js/pbh-contact-page.js';

    if (file_exists($css_file)) {
        wp_enqueue_style(
            'pbh-contact-page',
            get_template_directory_uri() . '/assets/css/pbh-contact-page.css',
            array(),
            filemtime($css_file)
        );
    }

    if (file_exists($js_file)) {
        wp_enqueue_script(
            'pbh-contact-page',
            get_template_directory_uri() . '/assets/js/pbh-contact-page.js',
            array(),
            filemtime($js_file),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'pbh_contact_page_assets', 30);

/**
 * Process the isolated PBH contact form.
 */
function pbh_contact_page_submit() {
    $redirect = wp_get_referer();

    if (!$redirect) {
        $redirect = home_url('/');
    }

    if (
        !isset($_POST['pbh_contact_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(wp_unslash($_POST['pbh_contact_nonce'])),
            'pbh_contact_submit'
        )
    ) {
        wp_safe_redirect(add_query_arg('pbh_contact', 'error', $redirect));
        exit;
    }

    $first_name = isset($_POST['first_name'])
        ? sanitize_text_field(wp_unslash($_POST['first_name']))
        : '';

    $last_name = isset($_POST['last_name'])
        ? sanitize_text_field(wp_unslash($_POST['last_name']))
        : '';

    $phone = isset($_POST['phone'])
        ? sanitize_text_field(wp_unslash($_POST['phone']))
        : '';

    $email = isset($_POST['email'])
        ? sanitize_email(wp_unslash($_POST['email']))
        : '';

    $service = isset($_POST['service'])
        ? sanitize_text_field(wp_unslash($_POST['service']))
        : '';

    $message = isset($_POST['message'])
        ? sanitize_textarea_field(wp_unslash($_POST['message']))
        : '';

    if (
        $first_name === '' ||
        $last_name === '' ||
        $phone === '' ||
        $service === '' ||
        $message === '' ||
        !is_email($email)
    ) {
        wp_safe_redirect(add_query_arg('pbh_contact', 'error', $redirect));
        exit;
    }

    $recipient = get_option('admin_email');

    /*
     * If you want a different destination later, change only this line.
     * Nothing else in the existing theme functions.php needs to change.
     */
    $subject = sprintf(
        'New Contact Page Message — %s %s',
        $first_name,
        $last_name
    );

    $body = "New contact-page submission\n\n";
    $body .= "First Name: {$first_name}\n";
    $body .= "Last Name: {$last_name}\n";
    $body .= "Phone: {$phone}\n";
    $body .= "Email: {$email}\n";
    $body .= "Service: {$service}\n\n";
    $body .= "Message:\n{$message}\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $first_name . ' ' . $last_name . ' <' . $email . '>',
    );

    $sent = wp_mail($recipient, $subject, $body, $headers);

    wp_safe_redirect(
        add_query_arg(
            'pbh_contact',
            $sent ? 'success' : 'error',
            $redirect
        )
    );
    exit;
}

add_action('admin_post_pbh_contact_submit', 'pbh_contact_page_submit');
add_action('admin_post_nopriv_pbh_contact_submit', 'pbh_contact_page_submit');
