<?php
/**
 * Template Name: PBH Insurance Verification
 * Description: Insurance verification page with isolated styles and JS.
 */
if (!defined('ABSPATH')) exit;

get_header();
$status = isset($_GET['pbh_insurance']) ? sanitize_key(wp_unslash($_GET['pbh_insurance'])) : '';
?>

<main class="pbh-insurance-page">

<?php if ($status === 'success') : ?>
  <div class="pbh-insurance-alert pbh-insurance-alert--success" role="status">
    Your insurance verification request was received. Our patient coordinator will follow up within one business day.
  </div>
<?php elseif ($status === 'error') : ?>
  <div class="pbh-insurance-alert pbh-insurance-alert--error" role="alert">
    We couldn't submit your request. Please check the required fields and try again, or call us directly.
  </div>
<?php endif; ?>

<section class="pbh-insurance-hero">
  <div class="pbh-insurance-wrap">
    <h1>Know your coverage before you walk in.</h1>
    <p class="pbh-insurance-hero-sub">
      Tell us a few details and our care team will confirm your benefits for medication management,
      NeuroStar TMS, or Spravato — directly with us, no outside portal required.
    </p>
    <div class="pbh-insurance-hero-note">
      <span class="pbh-insurance-dot"></span>
      We respond within one business day
    </div>
  </div>
</section>

<section class="pbh-insurance-main">
  <div class="pbh-insurance-wrap pbh-insurance-layout">

    <div class="pbh-insurance-left">

      <div class="pbh-insurance-tabs" data-pbh-insurance-tabs>
        <div class="pbh-insurance-tab-list" role="tablist" aria-label="Insurance verification steps">

          <button type="button"
            class="pbh-insurance-tab pbh-insurance-tab--active"
            id="pbh-insurance-tab-1"
            role="tab" aria-selected="true"
            aria-controls="pbh-insurance-panel-1"
            tabindex="0" data-pbh-tab="1">
            <span class="pbh-insurance-tab-number">01</span>
            <span class="pbh-insurance-tab-label">Your details</span>
          </button>

          <button type="button"
            class="pbh-insurance-tab"
            id="pbh-insurance-tab-2"
            role="tab" aria-selected="false"
            aria-controls="pbh-insurance-panel-2"
            tabindex="-1" data-pbh-tab="2">
            <span class="pbh-insurance-tab-number">02</span>
            <span class="pbh-insurance-tab-label">We verify</span>
          </button>

          <button type="button"
            class="pbh-insurance-tab"
            id="pbh-insurance-tab-3"
            role="tab" aria-selected="false"
            aria-controls="pbh-insurance-panel-3"
            tabindex="-1" data-pbh-tab="3">
            <span class="pbh-insurance-tab-number">03</span>
            <span class="pbh-insurance-tab-label">We follow up</span>
          </button>

        </div>

        <div class="pbh-insurance-tab-panels">

          <div class="pbh-insurance-tab-panel pbh-insurance-tab-panel--active"
            id="pbh-insurance-panel-1" role="tabpanel"
            aria-labelledby="pbh-insurance-tab-1" data-pbh-panel="1">
            <h3>You share your details</h3>
            <p>Name, date of birth, insurance carrier, and member ID — entered once, right here.</p>
          </div>

          <div class="pbh-insurance-tab-panel"
            id="pbh-insurance-panel-2" role="tabpanel"
            aria-labelledby="pbh-insurance-tab-2" data-pbh-panel="2" hidden>
            <h3>Our coordinator verifies your benefits</h3>
            <p>We contact your carrier directly to confirm coverage and any prior-authorization needs for your visit type.</p>
          </div>

          <div class="pbh-insurance-tab-panel"
            id="pbh-insurance-panel-3" role="tabpanel"
            aria-labelledby="pbh-insurance-tab-3" data-pbh-panel="3" hidden>
            <h3>We follow up with your coverage details</h3>
            <p>By phone or email, within one business day — including any out-of-pocket costs before you schedule.</p>
          </div>

        </div>
      </div>

      <div class="pbh-insurance-why">
        <h3>Why this stays on our site</h3>
        <p>
          Some clinics route verification through a third-party portal like Availity. We handle it ourselves instead,
          so a staff member — not a separate login — is your first point of contact, and nothing about your visit gets lost in a handoff.
        </p>
      </div>

      <div class="pbh-insurance-carriers">
        <h3>Carriers we currently verify</h3>
        <div class="pbh-insurance-chip-row">
          <span class="pbh-insurance-chip">Blue Cross Blue Shield of MN</span>
          <span class="pbh-insurance-chip">HealthPartners</span>
          <span class="pbh-insurance-chip">Medica</span>
          <span class="pbh-insurance-chip">UCare</span>
          <span class="pbh-insurance-chip">Optum / UnitedHealthcare</span>
          <span class="pbh-insurance-chip">Cigna / Evernorth</span>
          <span class="pbh-insurance-chip">Medicare</span>
        </div>
        <p class="pbh-insurance-carriers-note">
          Don't see your plan?
          <a href="<?php echo esc_url(home_url('/insurance-accepted/')); ?>">Submit the form anyway</a>
          — we'll check.
        </p>
      </div>

    </div>

    <div class="pbh-insurance-right">
      <div class="pbh-insurance-form-card">

        <div class="pbh-insurance-form-card-head">
          <h2>Request verification</h2>
          <svg class="pbh-insurance-lock" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <rect x="4" y="10" width="16" height="10" rx="2"/>
            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
          </svg>
        </div>

        <p class="pbh-insurance-form-sub">
          Sent straight to our patient coordinator — never a third-party site.
        </p>

    <?php
    echo do_shortcode(
        '[contact-form-7 id="31879b7"]'
    );
    ?>
      </div>
    </div>

  </div>
</section>
<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/css/pbh-insurance-verification.css'); ?>">
<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/js/pbh-insurance-verification.js'); ?>" defer></script>
</main>

<?php get_footer(); ?>
