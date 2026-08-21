<?php
/**
 * Plugin Name: PBH Insurance Verification Support
 * Version: 1.1.0
 */
if (!defined('ABSPATH')) exit;

function pbh_insurance_page_assets() {
  if (!is_page_template('page-pbh-insurance.php')) return;

  $css = get_template_directory() . '/assets/css/pbh-insurance-verification.css';
  $js  = get_template_directory() . '/assets/js/pbh-insurance-verification.js';

  if (file_exists($css)) {
    wp_enqueue_style(
      'pbh-insurance-verification',
      get_template_directory_uri() . '/assets/css/pbh-insurance-verification.css',
      array(),
      filemtime($css)
    );
  }

  if (file_exists($js)) {
    wp_enqueue_script(
      'pbh-insurance-verification',
      get_template_directory_uri() . '/assets/js/pbh-insurance-verification.js',
      array(),
      filemtime($js),
      true
    );
  }
}
add_action('wp_enqueue_scripts', 'pbh_insurance_page_assets', 31);

function pbh_insurance_submit() {
  $redirect = wp_get_referer() ?: home_url('/');

  if (
    !isset($_POST['pbh_insurance_nonce']) ||
    !wp_verify_nonce(
      sanitize_text_field(wp_unslash($_POST['pbh_insurance_nonce'])),
      'pbh_insurance_submit'
    )
  ) {
    wp_safe_redirect(add_query_arg('pbh_insurance', 'error', $redirect));
    exit;
  }

  $fields = array(
    'full_name' => isset($_POST['full_name']) ? sanitize_text_field(wp_unslash($_POST['full_name'])) : '',
    'dob'       => isset($_POST['dob']) ? sanitize_text_field(wp_unslash($_POST['dob'])) : '',
    'phone'     => isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '',
    'email'     => isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '',
    'carrier'   => isset($_POST['carrier']) ? sanitize_text_field(wp_unslash($_POST['carrier'])) : '',
    'member_id' => isset($_POST['member_id']) ? sanitize_text_field(wp_unslash($_POST['member_id'])) : '',
    'reason'    => isset($_POST['reason']) ? sanitize_text_field(wp_unslash($_POST['reason'])) : '',
    'notes'     => isset($_POST['notes']) ? sanitize_textarea_field(wp_unslash($_POST['notes'])) : '',
  );

  if (
    $fields['full_name'] === '' || $fields['dob'] === '' || $fields['phone'] === '' ||
    $fields['carrier'] === '' || $fields['member_id'] === '' || $fields['reason'] === '' ||
    empty($_POST['consent'])
  ) {
    wp_safe_redirect(add_query_arg('pbh_insurance', 'error', $redirect));
    exit;
  }

  if ($fields['email'] !== '' && !is_email($fields['email'])) {
    wp_safe_redirect(add_query_arg('pbh_insurance', 'error', $redirect));
    exit;
  }

  $body  = "Insurance Verification Request

";
  $body .= "Name: {$fields['full_name']}
";
  $body .= "Date of Birth: {$fields['dob']}
";
  $body .= "Phone: {$fields['phone']}
";
  $body .= "Email: {$fields['email']}
";
  $body .= "Insurance Carrier: {$fields['carrier']}
";
  $body .= "Member ID: {$fields['member_id']}
";
  $body .= "Reason for Visit: {$fields['reason']}
";
  $body .= "Additional Notes: {$fields['notes']}
";
  $body .= "Consent: Yes
";

  $headers = array('Content-Type: text/plain; charset=UTF-8');
  if ($fields['email'] !== '') {
    $headers[] = 'Reply-To: ' . $fields['full_name'] . ' <' . $fields['email'] . '>';
  }

  $sent = wp_mail(
    get_option('admin_email'),
    'Insurance Verification Request — ' . $fields['full_name'],
    $body,
    $headers
  );

  wp_safe_redirect(add_query_arg('pbh_insurance', $sent ? 'success' : 'error', $redirect));
  exit;
}
add_action('admin_post_pbh_insurance_submit', 'pbh_insurance_submit');
add_action('admin_post_nopriv_pbh_insurance_submit', 'pbh_insurance_submit');
