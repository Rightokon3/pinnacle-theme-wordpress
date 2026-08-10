<?php
/**
 * Template Name: New Patients
 * File: page-new-patients.php
 *
 * Faithful clone of the "New Patient Intake Page" reference file,
 * adapted to WordPress the same way as page-existing-patients.php:
 *  - Uses the site's real header/footer (the reference file's own
 *    slim logo+phone nav was a standalone-mockup-only bar).
 *  - All of the reference page's CSS is scoped under .intake-np in
 *    style.css so its color tokens can't leak into the rest of the
 *    theme.
 *  - Content (conditions list, form fields, "What to Expect" steps,
 *    FAQ, crisis banner) is reproduced with the same copy/structure
 *    as the reference file, matching the same pattern used for the
 *    Existing Patients page.
 */

get_header();
?>

<div class="intake-np">

<header class="hero" id="top">
  <div class="wrap">
    <div class="hero-inner">
      <span class="eyebrow">New Patients</span>
      <h1>Take the first step. <em>And we'll take it from here.</em></h1>
      <p class="hero-sub">Tell us a little about what brought you here, and we'll match you with the right provider — in person in Edina, or by secure telehealth from anywhere in Minnesota.</p>
      <div class="hero-ctas">
        <a href="#intake-form" class="btn btn-primary">Begin New Patient Intake</a>
        <a href="#what-to-expect" style="font-weight:700; font-size:14.5px; color:var(--harbor); display:inline-flex; align-items:center; gap:6px;">
          What happens next?
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>
      <div class="hero-note">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
        Takes about 3 minutes &middot; No account or login required
      </div>
    </div>
  </div>

  <div class="trust-strip">
    <div class="wrap">
      <div class="trust-item">
        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4z"/></svg>
        Licensed Psychiatric Providers
      </div>
      <div class="trust-item">
        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
        Now Accepting New Patients
      </div>
      <div class="trust-item">
        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#E2984E" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
        Most Insurance Accepted
      </div>
      <div class="trust-item">
        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="15" height="12" rx="2"/><path d="M17 9l5-3v10l-5-3"/></svg>
        Telehealth Available
      </div>
    </div>
  </div>
</header>

<section id="conditions">
  <div class="wrap">
    <div class="section-head center">
      <span class="eyebrow">What We Treat</span>
      <h2>Care for a wide range of mental health conditions</h2>
      <p>If you're not sure whether we're the right fit, that's okay — tell us what's going on and we'll help you figure out the next step.</p>
    </div>
    <div class="cond-grid">
      <div class="cond-card"><span class="cond-dot"></span>Depression</div>
      <div class="cond-card"><span class="cond-dot"></span>Anxiety Disorders</div>
      <div class="cond-card"><span class="cond-dot"></span>ADHD</div>
      <div class="cond-card"><span class="cond-dot"></span>Bipolar Disorder</div>
      <div class="cond-card"><span class="cond-dot"></span>Obsessive-Compulsive Disorder</div>
      <div class="cond-card"><span class="cond-dot"></span>Panic Disorder</div>
      <div class="cond-card"><span class="cond-dot"></span>Post-Traumatic Stress Disorder</div>
      <div class="cond-card"><span class="cond-dot"></span>Mood Disorders</div>
      <div class="cond-card"><span class="cond-dot"></span>Not Sure Yet — That's Okay</div>
    </div>
  </div>
</section>

<section id="intake-form" style="background:var(--paper); border-top:1px solid var(--line-soft);">
  <div class="wrap" style="max-width:820px;">
    <div class="section-head center">
      <span class="eyebrow">Begin Your Care</span>
      <h2>New Patient Intake</h2>
      <p>Share a few details below. There's no wrong answer — this just helps us match you with the right provider.</p>
    </div>

    <form class="form-panel" id="intakeForm">
      <h3 style="font-size:15px; text-transform:uppercase; letter-spacing:0.04em; color:var(--pine); font-family:var(--sans); margin-bottom:20px;">Your Information</h3>
      <div class="field-row">
        <div class="field">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" placeholder="Jane Doe" required>
        </div>
        <div class="field">
          <label for="dob">Date of Birth</label>
          <input type="date" id="dob" required>
        </div>
      </div>
      <div class="field-row">
        <div class="field">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" placeholder="(952) 555-0100" required>
        </div>
        <div class="field">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="jane@example.com" required>
        </div>
      </div>

      <h3 style="font-size:15px; text-transform:uppercase; letter-spacing:0.04em; color:var(--pine); font-family:var(--sans); margin:32px 0 20px;">What Brings You In</h3>
      <div class="field-row">
        <div class="field">
          <label for="concern">Primary Concern</label>
          <select id="concern">
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
        <div class="field">
          <label for="service">Service You're Interested In</label>
          <select id="service">
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
      <div class="field-row">
        <div class="field">
          <label for="seenBefore">Seen a Mental Health Provider Before?</label>
          <select id="seenBefore">
            <option>Yes</option>
            <option>No</option>
          </select>
        </div>
        <div class="field">
          <label for="format">Preferred Appointment Format</label>
          <select id="format">
            <option>No preference</option>
            <option>In-person (Edina, MN)</option>
            <option>Telehealth</option>
          </select>
        </div>
      </div>

      <h3 style="font-size:15px; text-transform:uppercase; letter-spacing:0.04em; color:var(--pine); font-family:var(--sans); margin:32px 0 20px;">Insurance &amp; Scheduling</h3>
      <div class="field-row">
        <div class="field">
          <label for="insurance">Insurance Provider <span class="opt">(optional)</span></label>
          <input type="text" id="insurance" placeholder="e.g., Blue Cross Blue Shield">
        </div>
        <div class="field">
          <label for="prefTime">Preferred Days / Times</label>
          <select id="prefTime">
            <option>Mornings</option>
            <option>Afternoons</option>
            <option>Evenings</option>
            <option>No preference</option>
          </select>
        </div>
      </div>
      <div class="field-row">
        <div class="field" style="grid-column:1 / -1;">
          <label for="notes">Anything Else We Should Know? <span class="opt">(optional)</span></label>
          <textarea id="notes" placeholder="Share anything that would help us prepare for your first visit."></textarea>
        </div>
      </div>

      <div class="form-foot">
        <button type="submit" class="btn btn-primary">Submit Intake Form</button>
        <span class="note">We'll never share your information. A member of our team will follow up within 1 business day.</span>
      </div>
    </form>
  </div>
</section>

<section class="tight" style="background:var(--sand-tint);">
  <div class="wrap" style="display:flex; align-items:center; gap:28px; flex-wrap:wrap;">
    <div style="width:52px; height:52px; border-radius:14px; background:#fff; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#E2984E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
    </div>
    <div style="flex:1; min-width:260px;">
      <h3 style="font-size:18px;">Not sure about cost or coverage?</h3>
      <p style="margin-top:6px; color:var(--muted); font-size:14px; line-height:1.6;">We accept most major insurance plans and will verify your benefits before your first visit. Self-pay options are also available — just note it on the form and our team will follow up with details.</p>
    </div>
  </div>
</section>

<section id="what-to-expect" style="background:var(--cloud); border-top:1px solid var(--line-soft); border-bottom:1px solid var(--line-soft);">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">What To Expect</span>
      <h2>From first form to first appointment</h2>
      <p>A clear, unhurried path designed to make starting care feel manageable.</p>
    </div>
    <div class="expect-grid">
      <div class="expect-item">
        <div class="expect-num">01</div>
        <div class="expect-title">Share Your Story</div>
        <div class="expect-sub">Complete a short intake form about what brought you in and your history.</div>
      </div>
      <div class="expect-item">
        <div class="expect-num">02</div>
        <div class="expect-title">Get Matched</div>
        <div class="expect-sub">We match you with a provider suited to your needs and preferred format.</div>
      </div>
      <div class="expect-item">
        <div class="expect-num">03</div>
        <div class="expect-title">First Evaluation</div>
        <div class="expect-sub">Meet your provider for a comprehensive evaluation — in person or by video.</div>
      </div>
      <div class="expect-item">
        <div class="expect-num">04</div>
        <div class="expect-title">Your Care Plan</div>
        <div class="expect-sub">Leave with a personalized plan and a clear next appointment.</div>
      </div>
    </div>
  </div>
</section>

<section id="faq" style="background:var(--paper);">
  <div class="wrap" style="max-width:760px;">
    <div class="section-head">
      <span class="eyebrow">Frequently Asked Questions</span>
      <h2>Answers before you start</h2>
    </div>
    <div class="faq-list">
      <div class="faq-item open">
        <button class="faq-q">How soon can I be seen?<span class="faq-plus">+</span></button>
        <div class="faq-a"><p>Most new patients are matched with a provider and scheduled for their first evaluation within one to two weeks, depending on appointment format and provider availability.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">Do you accept my insurance?<span class="faq-plus">+</span></button>
        <div class="faq-a"><p>We accept most major insurance plans. Share your insurance provider on the intake form and our team will verify your specific benefits before your visit.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">What happens at my first appointment?<span class="faq-plus">+</span></button>
        <div class="faq-a"><p>Your first visit is a comprehensive evaluation — your provider will review your history, current concerns, and goals, then walk you through a personalized care plan.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">Can I do telehealth instead of an in-person visit?<span class="faq-plus">+</span></button>
        <div class="faq-a"><p>Yes. Telehealth is available for most services. Note your preference on the intake form and we'll schedule accordingly.</p></div>
      </div>
    </div>
  </div>
</section>

<section style="background:var(--harbor);">
  <div class="wrap" style="display:flex; align-items:center; justify-content:space-between; gap:32px; flex-wrap:wrap;">
    <div style="max-width:520px;">
      <h2 style="color:#fff; font-size:24px;">Need help right away?</h2>
      <p style="color:#AEC0CC; margin-top:10px; font-size:14.5px; line-height:1.6;">This form is reviewed during business hours and isn't monitored in real time. If this is a medical emergency or you're in crisis, call 911 or the 988 Suicide &amp; Crisis Lifeline right away.</p>
    </div>
    <div style="display:flex; gap:14px; flex-wrap:wrap;">
      <a href="tel:988" class="btn" style="background:#fff; color:var(--harbor);">Call 988</a>
      <a href="tel:9523036832" class="btn btn-outline" style="background:transparent; border-color:rgba(255,255,255,0.35); color:#fff;">Call Our Office</a>
    </div>
  </div>
</section>

</div>

<?php get_footer(); ?>