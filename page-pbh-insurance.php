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

        <form class="pbh-insurance-form" method="post"
          action="<?php echo esc_url(admin_url('admin-post.php')); ?>" novalidate>

          <input type="hidden" name="action" value="pbh_insurance_submit">
          <?php wp_nonce_field('pbh_insurance_submit', 'pbh_insurance_nonce'); ?>

          <div class="pbh-insurance-field" data-field="full_name">
            <label for="pbh-full-name">Full name <span>*</span></label>
            <input type="text" id="pbh-full-name" name="full_name" autocomplete="name" required>
            <p class="pbh-insurance-error">Enter your full name.</p>
          </div>

          <div class="pbh-insurance-field-row">
            <div class="pbh-insurance-field" data-field="dob">
              <label for="pbh-dob">Date of birth <span>*</span></label>
              <input type="date" id="pbh-dob" name="dob" required>
              <p class="pbh-insurance-error">Enter your date of birth.</p>
            </div>
            <div class="pbh-insurance-field" data-field="phone">
              <label for="pbh-phone">Phone <span>*</span></label>
              <input type="tel" id="pbh-phone" name="phone" autocomplete="tel" required>
              <p class="pbh-insurance-error">Enter a callback number.</p>
            </div>
          </div>

          <div class="pbh-insurance-field">
            <label for="pbh-email">Email</label>
            <input type="email" id="pbh-email" name="email" autocomplete="email">
            <p class="pbh-insurance-hint">Optional — we'll use this if we can't reach you by phone.</p>
          </div>

          <div class="pbh-insurance-field" data-field="carrier">
            <label for="pbh-carrier">Insurance carrier <span>*</span></label>
            <select id="pbh-carrier" name="carrier" required>
              <option value="" selected disabled>Select your carrier</option>
              <option>Blue Cross Blue Shield of Minnesota</option>
              <option>HealthPartners</option>
              <option>Medica</option>
              <option>UCare</option>
              <option>Optum / UnitedHealthcare</option>
              <option>Cigna / Evernorth</option>
              <option>Medicare</option>
              <option>Other / not listed</option>
            </select>
            <p class="pbh-insurance-error">Select your insurance carrier.</p>
          </div>

          <div class="pbh-insurance-field" data-field="member_id">
            <label for="pbh-member-id">Member ID <span>*</span></label>
            <input type="text" id="pbh-member-id" name="member_id" required>
            <p class="pbh-insurance-hint">Found on the front of your insurance card.</p>
            <p class="pbh-insurance-error">Enter your member ID.</p>
          </div>

          <div class="pbh-insurance-field" data-field="reason">
            <label for="pbh-reason">Reason for visit <span>*</span></label>
            <select id="pbh-reason" name="reason" required>
              <option value="" selected disabled>Select a reason</option>
              <option>Medication Management</option>
              <option>NeuroStar TMS Therapy</option>
              <option>Spravato (Esketamine)</option>
              <option>ADHD Testing</option>
              <option>Individual Psychotherapy</option>
              <option>Not sure yet</option>
            </select>
            <p class="pbh-insurance-error">Let us know why you're visiting.</p>
          </div>

          <div class="pbh-insurance-field">
            <label for="pbh-notes">Anything else we should know</label>
            <textarea id="pbh-notes" name="notes" placeholder="Optional"></textarea>
          </div>

          <div class="pbh-insurance-consent" data-field="consent">
            <input type="checkbox" id="pbh-consent" name="consent" value="1" required>
            <label for="pbh-consent">
              I authorize Pinnacle Behavioral Healthcare to contact my insurance carrier to verify benefits on my behalf,
              and to reach me at the phone number or email above. <span>*</span>
            </label>
            <p class="pbh-insurance-error">You must authorize insurance verification.</p>
          </div>

          <button type="submit" class="pbh-insurance-submit">Request insurance verification</button>

          <p class="pbh-insurance-form-foot">
            Prefer to talk it through? <a href="tel:9523036832">Call (952) 303-6832</a>
          </p>

        </form>
      </div>
    </div>

  </div>
</section>
<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/css/pbh-insurance-verification.css'); ?>">
<script src="<?php echo esc_url(get_template_directory_uri() . '/assets/js/pbh-insurance-verification.js'); ?>" defer></script>
</main>

<?php get_footer(); ?>
