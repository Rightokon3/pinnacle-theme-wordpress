<?php
/**
 * Template Name: New Patients Intake
 * Template Post Type: page
 *
 * New Patients intake landing page converted from the supplied HTML.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main class="pnp-page" id="top">

  <header class="pnp-hero">
    <div class="pnp-wrap">
      <div class="pnp-hero-inner">
        <span class="pnp-eyebrow">New Patients</span>
        <h1>Take the first step. <em>And we'll take it from here.</em></h1>
        <p class="pnp-hero-sub">Tell us a little about what brought you here, and we'll match you with the right provider — in person in Edina, or by secure telehealth from anywhere in Minnesota.</p>

        <div class="pnp-hero-ctas">
          <a href="#intake-form" class="pnp-btn pnp-btn-primary">Begin New Patient Intake</a>
          <a href="#what-to-expect" class="pnp-next-link">
            What happens next?
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <path d="M5 12h14M13 6l6 6-6 6"/>
            </svg>
          </a>
        </div>

        <div class="pnp-hero-note">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
          </svg>
          Takes about 3 minutes &middot; No account or login required
        </div>
      </div>
    </div>

    <div class="pnp-trust-strip">
      <div class="pnp-wrap">
        <div class="pnp-trust-item">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4z"/></svg>
          Licensed Psychiatric Providers
        </div>
        <div class="pnp-trust-item">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
          Now Accepting New Patients
        </div>
        <div class="pnp-trust-item">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#E2984E" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
          Most Insurance Accepted
        </div>
        <div class="pnp-trust-item">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="15" height="12" rx="2"/><path d="M17 9l5-3v10l-5-3"/></svg>
          Telehealth Available
        </div>
      </div>
    </div>
  </header>

  <section id="conditions">
    <div class="pnp-wrap">
      <div class="pnp-section-head pnp-center">
        <span class="pnp-eyebrow">What We Treat</span>
        <h2>Care for a wide range of mental health conditions</h2>
        <p>If you're not sure whether we're the right fit, that's okay — tell us what's going on and we'll help you figure out the next step.</p>
      </div>

      <div class="pnp-cond-grid">
        <?php
        $conditions = array(
          'Depression',
          'Anxiety Disorders',
          'ADHD',
          'Bipolar Disorder',
          'Obsessive-Compulsive Disorder',
          'Panic Disorder',
          'Post-Traumatic Stress Disorder',
          'Mood Disorders',
          "Not Sure Yet — That's Okay",
        );
        foreach ($conditions as $condition) :
        ?>
          <div class="pnp-cond-card"><span class="pnp-cond-dot"></span><?php echo esc_html($condition); ?></div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section id="intake-form" class="pnp-form-section">
    <div class="pnp-wrap pnp-form-wrap">
      <div class="pnp-section-head pnp-center">
        <span class="pnp-eyebrow">Begin Your Care</span>
        <h2>New Patient Intake</h2>
        <p>Share a few details below. There's no wrong answer — this just helps us match you with the right provider.</p>
      </div>

      <form class="pnp-form-panel" id="pnpIntakeForm" novalidate>
        <?php wp_nonce_field('pnp_intake_form', 'pnp_intake_nonce'); ?>

        <h3 class="pnp-form-heading">Your Information</h3>

        <div class="pnp-field-row">
          <div class="pnp-field">
            <label for="pnp-full-name">Full Name</label>
            <input type="text" id="pnp-full-name" name="full_name" placeholder="Jane Doe" autocomplete="name" required>
          </div>
          <div class="pnp-field">
            <label for="pnp-dob">Date of Birth</label>
            <input type="date" id="pnp-dob" name="dob" autocomplete="bday" required>
          </div>
        </div>

        <div class="pnp-field-row">
          <div class="pnp-field">
            <label for="pnp-phone">Phone Number</label>
            <input type="tel" id="pnp-phone" name="phone" placeholder="(952) 555-0100" autocomplete="tel" required>
          </div>
          <div class="pnp-field">
            <label for="pnp-email">Email</label>
            <input type="email" id="pnp-email" name="email" placeholder="jane@example.com" autocomplete="email" required>
          </div>
        </div>

        <h3 class="pnp-form-heading pnp-form-heading-spaced">What Brings You In</h3>

        <div class="pnp-field-row">
          <div class="pnp-field">
            <label for="pnp-concern">Primary Concern</label>
            <select id="pnp-concern" name="concern">
              <option>Depression</option>
              <option>Anxiety Disorders</option>
              <option>ADHD</option>
              <option>Bipolar Disorder</option>
              <option>Obsessive-Compulsive Disorder</option>
              <option>Panic Disorder</option>
              <option>Post-Traumatic Stress Disorder</option>
              <option>Mood Disorders</option>
              <option>Not sure yet</option>
            </select>
          </div>

          <div class="pnp-field">
            <label for="pnp-service">Service You're Interested In</label>
            <select id="pnp-service" name="service">
              <option>Psychiatric Evaluation</option>
              <option>Medication Management</option>
              <option>Therapy</option>
              <option>TMS Therapy</option>
              <option>Spravato</option>
              <option>ADHD Testing</option>
              <option>Not sure yet</option>
            </select>
          </div>
        </div>

        <div class="pnp-field-row">
          <div class="pnp-field">
            <label for="pnp-seen-before">Seen a Mental Health Provider Before?</label>
            <select id="pnp-seen-before" name="seen_before">
              <option>Yes</option>
              <option>No</option>
            </select>
          </div>

          <div class="pnp-field">
            <label for="pnp-format">Preferred Appointment Format</label>
            <select id="pnp-format" name="appointment_format">
              <option>No preference</option>
              <option>In-person (Edina, MN)</option>
              <option>Telehealth</option>
            </select>
          </div>
        </div>

        <h3 class="pnp-form-heading pnp-form-heading-spaced">Insurance &amp; Scheduling</h3>

        <div class="pnp-field-row">
          <div class="pnp-field">
            <label for="pnp-insurance">Insurance Provider <span class="pnp-opt">(optional)</span></label>
            <input type="text" id="pnp-insurance" name="insurance" placeholder="e.g., Blue Cross Blue Shield">
          </div>

          <div class="pnp-field">
            <label for="pnp-pref-time">Preferred Days / Times</label>
            <select id="pnp-pref-time" name="preferred_time">
              <option>Mornings</option>
              <option>Afternoons</option>
              <option>Evenings</option>
              <option>No preference</option>
            </select>
          </div>
        </div>

        <div class="pnp-field-row">
          <div class="pnp-field pnp-full-field">
            <label for="pnp-notes">Anything Else We Should Know? <span class="pnp-opt">(optional)</span></label>
            <textarea id="pnp-notes" name="notes" placeholder="Share anything that would help us prepare for your first visit."></textarea>
          </div>
        </div>

        <div class="pnp-form-foot">
          <button type="submit" class="pnp-btn pnp-btn-primary">Submit Intake Form</button>
          <span class="pnp-note">We'll never share your information. A member of our team will follow up within 1 business day.</span>
        </div>

        <div class="pnp-form-status" id="pnpFormStatus" aria-live="polite"></div>
      </form>
    </div>
  </section>

  <section class="pnp-tight pnp-cost-section">
    <div class="pnp-wrap pnp-cost-inner">
      <div class="pnp-cost-icon">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#E2984E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
      </div>
      <div>
        <h3>Not sure about cost or coverage?</h3>
        <p>We accept most major insurance plans and will verify your benefits before your first visit. Self-pay options are also available — just note it on the form and our team will follow up with details.</p>
      </div>
    </div>
  </section>

  <section id="what-to-expect" class="pnp-expect-section">
    <div class="pnp-wrap">
      <div class="pnp-section-head">
        <span class="pnp-eyebrow">What To Expect</span>
        <h2>From first form to first appointment</h2>
        <p>A clear, unhurried path designed to make starting care feel manageable.</p>
      </div>

      <div class="pnp-expect-grid">
        <div class="pnp-expect-item">
          <div class="pnp-expect-num">01</div>
          <div class="pnp-expect-title">Share Your Story</div>
          <div class="pnp-expect-sub">Complete a short intake form about what brought you in and your history.</div>
        </div>
        <div class="pnp-expect-item">
          <div class="pnp-expect-num">02</div>
          <div class="pnp-expect-title">Get Matched</div>
          <div class="pnp-expect-sub">We match you with a provider suited to your needs and preferred format.</div>
        </div>
        <div class="pnp-expect-item">
          <div class="pnp-expect-num">03</div>
          <div class="pnp-expect-title">First Evaluation</div>
          <div class="pnp-expect-sub">Meet your provider for a comprehensive evaluation — in person or by video.</div>
        </div>
        <div class="pnp-expect-item">
          <div class="pnp-expect-num">04</div>
          <div class="pnp-expect-title">Your Care Plan</div>
          <div class="pnp-expect-sub">Leave with a personalized plan and a clear next appointment.</div>
        </div>
      </div>
    </div>
  </section>

  <section id="faq" class="pnp-faq-section">
    <div class="pnp-wrap pnp-faq-wrap">
      <div class="pnp-section-head">
        <span class="pnp-eyebrow">Frequently Asked Questions</span>
        <h2>Answers before you start</h2>
      </div>

      <div class="pnp-faq-list">
        <div class="pnp-faq-item open">
          <button type="button" class="pnp-faq-q">How soon can I be seen?<span class="pnp-faq-plus">+</span></button>
          <div class="pnp-faq-a"><p>Most new patients are matched with a provider and scheduled for their first evaluation within one to two weeks, depending on appointment format and provider availability.</p></div>
        </div>

        <div class="pnp-faq-item">
          <button type="button" class="pnp-faq-q">Do you accept my insurance?<span class="pnp-faq-plus">+</span></button>
          <div class="pnp-faq-a"><p>We accept most major insurance plans. Share your insurance provider on the intake form and our team will verify your specific benefits before your visit.</p></div>
        </div>

        <div class="pnp-faq-item">
          <button type="button" class="pnp-faq-q">What happens at my first appointment?<span class="pnp-faq-plus">+</span></button>
          <div class="pnp-faq-a"><p>Your first visit is a comprehensive evaluation — your provider will review your history, current concerns, and goals, then walk you through a personalized care plan.</p></div>
        </div>

        <div class="pnp-faq-item">
          <button type="button" class="pnp-faq-q">Can I do telehealth instead of an in-person visit?<span class="pnp-faq-plus">+</span></button>
          <div class="pnp-faq-a"><p>Yes. Telehealth is available for most services. Note your preference on the intake form and we'll schedule accordingly.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="pnp-help-section">
    <div class="pnp-wrap pnp-help-inner">
      <div class="pnp-help-copy">
        <h2>Need help right away?</h2>
        <p>This form is reviewed during business hours and isn't monitored in real time. If this is a medical emergency or you're in crisis, call 911 or the 988 Suicide &amp; Crisis Lifeline right away.</p>
      </div>
      <div class="pnp-help-actions">
        <a href="tel:988" class="pnp-btn pnp-btn-light">Call 988</a>
        <a href="tel:9523036832" class="pnp-btn pnp-btn-outline-light">Call Our Office</a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
