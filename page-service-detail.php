<?php
/**
 * Template Name: Telehealth Medication Management
 *
 * Imported landing-page design.
 * Uses the existing Pinnacle header and footer.
 *
 * NOTE: everything is wrapped in <div class="telehealth-page">.
 * That wrapper is what scopes telehealth-page-scoped.css to just
 * this template — it defines this page's own --sky/--harbor/--pine
 * etc. tokens and every .hero/.btn/.eyebrow/.faq-item/... rule only
 * applies inside it, so it can't collide with the main theme's CSS
 * or the .intake-v2 / .intake-np page styles.
 */

get_header();
?>

<div class="telehealth-page">

<header class="hero" id="top">
  <div class="wrap">
    <div>
      <span class="eyebrow">Telehealth &middot; Medication Management</span>

      <h1>
        Care that meets you, <em>wherever you are.</em>
      </h1>

      <p class="hero-sub">
        Managing your mental health shouldn't require unnecessary travel or long waits.
        Meet with an experienced psychiatric provider by secure video, from home, work,
        or anywhere you feel comfortable.
      </p>

      <div class="hero-ctas">
       <button type="button" class="btn-consult"  data-consult-trigger  aria-haspopup="dialog" aria-controls="consultModal">Book Your Consultation</button>

        <a
          href="<?php echo esc_url(home_url('/providers/')); ?>"
          style="font-weight:700; font-size:14.5px; color:var(--harbor); display:inline-flex; align-items:center; gap:6px;"
        >
          Get Matched to a Provider

          <svg
            width="15"
            height="15"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2.5"
            stroke-linecap="round"
          >
            <path d="M5 12h14M13 6l6 6-6 6"/>
          </svg>
        </a>
      </div>

      <div class="hero-trust">
        <svg
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="#17847A"
          stroke-width="2.2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M12 22s8-4.5 8-11V5l-8-3-8 3v6c0 6.5 8 11 8 11z"/>
        </svg>

        Serving Minneapolis, Edina &amp; surrounding Minnesota communities
      </div>
    </div>

    <div class="hero-art">
      <div class="device-card">

        <div class="device-topbar">
          <span class="device-dot"></span>
          <span class="device-dot"></span>
          <span class="device-dot"></span>
        </div>

        <div class="device-screen">

          <div class="call-badge">
            <span class="call-dot"></span>
            Secure Video Visit
          </div>

          <div class="call-timer">14:52</div>

          <div class="call-avatar">
            <svg
              width="40"
              height="40"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#fff"
              stroke-width="1.8"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </div>

          <div class="call-name">Dr. Provider</div>

          <div class="call-role">
            Psychiatric Medication Management
          </div>

          <div class="wave-row" id="waveRow"></div>

          <div class="device-controls">
            <div class="ctrl-btn">
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#fff"
                stroke-width="2"
                stroke-linecap="round"
              >
                <path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/>
                <path d="M19 10v2a7 7 0 01-14 0v-2M12 19v3"/>
              </svg>
            </div>

            <div class="ctrl-btn">
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#fff"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <rect x="2" y="6" width="15" height="12" rx="2"/>
                <path d="M17 10l5-3v10l-5-3"/>
              </svg>
            </div>

            <div class="ctrl-btn end">
              <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#fff"
                stroke-width="2.2"
                stroke-linecap="round"
              >
                <path
                  d="M22 16.92v3a2 2 0 01-2.18 2A19.79 19.79 0 013 5.18 2 2 0 015 3h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L9.09 10.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"
                  transform="rotate(135 12 12)"
                />
              </svg>
            </div>
          </div>

        </div>
      </div>

      <div class="floating-chip secure">
        <div class="chip-ico" style="background:var(--pine-tint);">
          <svg
            width="15"
            height="15"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#17847A"
            stroke-width="2.3"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <rect x="4" y="10" width="16" height="10" rx="2"/>
            <path d="M8 10V7a4 4 0 018 0v3"/>
          </svg>
        </div>
        HIPAA-Secure Platform
      </div>

      <div class="floating-chip mn">
        <div class="chip-ico" style="background:var(--sky-tint);">
          <svg
            width="15"
            height="15"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#2CA9DA"
            stroke-width="2.3"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <circle cx="12" cy="12" r="9"/>
            <path d="M3.5 9h17M3.5 15h17M12 3a13 13 0 010 18M12 3a13 13 0 000 18"/>
          </svg>
        </div>
        From Home, Work, or Anywhere
      </div>
    </div>
  </div>
</header>


<!-- TRUST STRIP -->

<div style="background:var(--paper); border-bottom:1px solid var(--line-soft);">
  <div
    class="wrap"
    style="display:flex; justify-content:space-between; align-items:center; padding-top:34px; padding-bottom:34px; flex-wrap:wrap; gap:24px;"
  >

    <div style="display:flex; align-items:center; gap:12px; font-size:13.5px; font-weight:700; color:var(--harbor);">
      <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="4" y="10" width="16" height="10" rx="2"/>
        <path d="M8 10V7a4 4 0 018 0v3"/>
      </svg>
      Secure, Confidential Video Visits
    </div>

    <div style="display:flex; align-items:center; gap:12px; font-size:13.5px; font-weight:700; color:var(--harbor);">
      <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="9"/>
        <path d="M12 7v5l3 3"/>
      </svg>
      Flexible Scheduling
    </div>

    <div style="display:flex; align-items:center; gap:12px; font-size:13.5px; font-weight:700; color:var(--harbor);">
      <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#E2984E" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4z"/>
      </svg>
      Licensed Psychiatric Providers
    </div>

    <div style="display:flex; align-items:center; gap:12px; font-size:13.5px; font-weight:700; color:var(--harbor);">
      <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M2 12h4l3-9 4 18 3-9h6"/>
      </svg>
      Care Across Minnesota
    </div>

  </div>
</div>


<!-- WHAT IS IT -->

<section id="what-is-it" class="reveal">
  <div class="wrap">

    <div class="two-col" style="align-items:start;">

      <div class="section-head" style="margin-bottom:0;">
        <span class="eyebrow">What It Is</span>

        <h2>
          Psychiatric care, delivered through a secure screen
        </h2>

        <p>
         Pinnacle Behavioral Healthcare is proud to offer mental Telehealth Psychiatric Medication Management in addition to in-person, face-to-face visits at our Edina clinic in Edina. This allows you the option of meeting with your provider in the clinic or from the comfort of your own home or office using a computer, tablet, or smartphone. Telehealth Psychiatric Medication Management is a convenient and effective way to receive psychiatric medication management services. You will be able to meet with your provider on a regular basis, without having to travel to our office. We offer comprehensive mental telehealth evaluations to determine the best course of treatment, which may or may not include medication. Our providers for mental health work with you to find the right medication at the right dose to help improve your symptoms. We understand that each person is unique and will respond differently to various medications. We will work with you to find the best medication for you, taking into account your individual needs and preferences. In order to participate in Telehealth Psychiatric Medication Management, you will need:

A computer, tablet, or smartphone with a webcam and microphone
A high-speed internet connection
        </p>
      </div>

      <div
        style="background:var(--paper); border:1px solid var(--line); border-radius:20px; padding:38px; position:relative;"
      >
        <svg
          width="34"
          height="34"
          viewBox="0 0 24 24"
          fill="none"
          stroke="var(--sand)"
          style="margin-bottom:20px;"
        >
          <path
            d="M7.17 6A5.99 5.99 0 002 12v6h6v-6H4.9c.2-1.68 1.2-3.13 2.7-3.87L7.17 6zm10 0A5.99 5.99 0 0012 12v6h6v-6h-3.1c.2-1.68 1.2-3.13 2.7-3.87L17.17 6z"
            fill="var(--sand)"
            stroke="none"
          />
        </svg>

        <p
          style="font-family:var(--serif); font-size:21px; font-style:italic; color:var(--harbor); line-height:1.5;"
        >
          Medication management goes beyond writing prescriptions — it's
          ongoing assessment, education, and collaboration to keep your
          treatment safe, effective, and aligned with your goals.
        </p>

        <div
          style="margin-top:26px; padding-top:22px; border-top:1px solid var(--line-soft); font-size:14px; color:var(--muted);"
        >
          Whether you're beginning treatment, continuing an existing
          medication plan, or seeking a second opinion, your provider
          tailors every step to your unique needs.
        </div>
      </div>

    </div>

  </div>
</section>


<!-- CONDITIONS -->

<section
  id="conditions"
  style="background:var(--paper); border-top:1px solid var(--line-soft); border-bottom:1px solid var(--line-soft);"
>
  <div class="wrap">

    <div class="section-head center">
      <span class="eyebrow">Conditions We Treat</span>

      <h2>
        Care for a wide range of mental health conditions
      </h2>

      <p>
        Every patient's experience is different. Your treatment plan is built
        around your symptoms, diagnosis, lifestyle, and overall health.
      </p>
    </div>

    <div class="cond-grid">

      <div class="cond-card">
        <span class="cond-dot"></span>
        Depression
      </div>

      <div class="cond-card">
        <span class="cond-dot"></span>
        Anxiety Disorders
      </div>

      <div class="cond-card">
        <span class="cond-dot"></span>
        ADHD
      </div>

      <div class="cond-card">
        <span class="cond-dot"></span>
        Bipolar Disorder
      </div>

      <div class="cond-card">
        <span class="cond-dot"></span>
        Obsessive-Compulsive Disorder
      </div>

      <div class="cond-card">
        <span class="cond-dot"></span>
        Panic Disorder
      </div>

      <div class="cond-card">
        <span class="cond-dot"></span>
        Post-Traumatic Stress Disorder
      </div>

      <div class="cond-card">
        <span class="cond-dot"></span>
        Mood Disorders
      </div>

      <div class="cond-card">
        <span class="cond-dot"></span>
        Other Behavioral &amp; Emotional Concerns
      </div>

    </div>
  </div>
</section>


<!-- PROCESS -->

<section id="process">
  <div class="wrap">

    <div class="section-head">
      <span class="eyebrow">Our Process</span>

      <h2>
        Three steps, start to ongoing care
      </h2>

      <p>
        A clear, unhurried path — from your first evaluation to continued
        monitoring as your treatment evolves.
      </p>
    </div>

    <div class="process-list">

      <div class="process-item">
        <div class="process-num">01</div>
        <div class="process-line"></div>

        <div class="process-body">
          <h3 style="font-size:21px;">
            Comprehensive Psychiatric Evaluation
          </h3>

          <p>
            Your care begins with a detailed evaluation to understand your
            symptoms, medical history, previous treatments, current
            medications, and personal goals — helping determine the most
            appropriate course of care.
          </p>
        </div>
      </div>

      <div class="process-item">
        <div class="process-num">02</div>
        <div class="process-line"></div>

        <div class="process-body">
          <h3 style="font-size:21px;">
            Personalized Treatment Plan
          </h3>

          <p>
            If medication is recommended, your provider walks you through
            why it's prescribed, expected benefits, possible side effects,
            how long it may take to work, recommended dosage, and what to
            expect during follow-up care.
          </p>
        </div>
      </div>

      <div class="process-item">
        <div class="process-num">03</div>

        <div class="process-body">
          <h3 style="font-size:21px;">
            Ongoing Monitoring &amp; Follow-Up
          </h3>

          <p>
            Regular follow-up appointments let your provider monitor
            progress, evaluate symptom improvement, adjust dosages when
            appropriate, address side effects, and ensure your treatment
            keeps meeting your needs.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>


<!-- WHY TELEHEALTH -->

<section style="background:var(--harbor);">
  <div class="wrap">

    <div
      class="section-head center"
      style="max-width:640px;"
    >
      <span
        class="eyebrow"
        style="color:#7FD4F0;"
      >
        Why Telehealth
      </span>

      <h2 style="color:#fff;">
        Advantages of virtual psychiatric care
      </h2>

      <p style="color:#AEC0CC;">
        Many patients find telehealth a convenient, effective way to
        maintain continuity of care while balancing work, school, and family.
      </p>
    </div>

    <div class="benefit-grid">

      <div class="benefit-card">
        <div class="benefit-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            <path d="M9 22V12h6v10"/>
          </svg>
        </div>
        Attend from home or work
      </div>

      <div class="benefit-card">
        <div class="benefit-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v5l3 3"/>
          </svg>
        </div>
        Save time avoiding travel
      </div>

      <div class="benefit-card">
        <div class="benefit-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="10" width="16" height="10" rx="2"/>
            <path d="M8 10V7a4 4 0 018 0v3"/>
          </svg>
        </div>
        Secure, confidential visits
      </div>

      <div class="benefit-card">
        <div class="benefit-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2"/>
            <path d="M3 10h18M8 2v4M16 2v4"/>
          </svg>
        </div>
        Flexible scheduling options
      </div>

      <div class="benefit-card">
        <div class="benefit-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
            <path d="M22 4L12 14.01l-3-3"/>
          </svg>
        </div>
        Easier access to ongoing care
      </div>

      <div class="benefit-card">
        <div class="benefit-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 1l4 4-4 4"/>
            <path d="M3 11V9a4 4 0 014-4h14"/>
            <path d="M7 23l-4-4 4-4"/>
            <path d="M21 13v2a4 4 0 01-4 4H3"/>
          </svg>
        </div>
        Consistent provider follow-up
      </div>

      <div
        class="benefit-card"
        style="grid-column:span 2;"
      >
        <div class="benefit-ico">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2CA9DA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/>
          </svg>
        </div>
        Personalized treatment tailored to your progress
      </div>

    </div>

  </div>
</section>


<!-- WHAT YOU'LL NEED -->

<section class="tight">
  <div class="wrap two-col" style="align-items:center;">

    <div>
      <span class="eyebrow">Before Your Visit</span>

      <h2 style="font-size:30px;">
        What you'll need for your appointment
      </h2>

      <p
        style="margin-top:16px; color:var(--muted); font-size:15.5px; line-height:1.7;"
      >
        Participating in a telehealth visit is simple. Our team provides
        instructions before your appointment to help ensure a smooth virtual
        experience.
      </p>
    </div>

    <div class="need-card">

      <div class="need-row">
        <span class="need-check">&check;</span>
        A computer, tablet, or smartphone with a camera and microphone
      </div>

      <div class="need-row">
        <span class="need-check">&check;</span>
        A reliable high-speed internet connection
      </div>

      <div class="need-row">
        <span class="need-check">&check;</span>
        A quiet, private location for your appointment
      </div>

      <div class="need-row">
        <span class="need-check">&check;</span>
        A valid photo ID, if requested
      </div>

      <div
        class="need-row"
        style="border-bottom:none;"
      >
        <span class="need-check">&check;</span>
        A list of current medications and any questions to discuss
      </div>

    </div>

  </div>
</section>


<!-- PERSONALIZED APPROACH -->

<section style="background:var(--sand-tint);">
  <div
    class="wrap"
    style="max-width:820px; text-align:center;"
  >

    <svg
      width="30"
      height="30"
      viewBox="0 0 24 24"
      style="margin:0 auto 22px;"
    >
      <path
        d="M7.17 6A5.99 5.99 0 002 12v6h6v-6H4.9c.2-1.68 1.2-3.13 2.7-3.87L7.17 6zm10 0A5.99 5.99 0 0012 12v6h6v-6h-3.1c.2-1.68 1.2-3.13 2.7-3.87L17.17 6z"
        fill="var(--sand)"
      />
    </svg>

    <h2
      style="font-size:clamp(24px,3vw,32px); font-style:italic; font-weight:500; line-height:1.4;"
    >
      "Every individual responds differently to psychiatric medications,
      and treatment should never be one-size-fits-all."
    </h2>

    <p
      style="margin-top:22px; color:var(--muted); font-size:15.5px; max-width:600px; margin-left:auto; margin-right:auto;"
    >
      Finding the right medication takes time and careful monitoring.
      We work closely with you to evaluate your response, make adjustments
      when needed, and support your long-term mental health goals.
    </p>

  </div>
</section>


<!-- FAQ -->

<section
  id="faq"
  style="background:var(--paper); border-top:1px solid var(--line-soft);"
>
  <div
    class="wrap"
    style="max-width:820px;"
  >

    <div class="section-head">

      <span class="eyebrow">
        Frequently Asked Questions
      </span>

      <h2>
        Answers before you book
      </h2>

    </div>

    <div class="faq-list">

      <div class="faq-item open">

        <button class="faq-q">
          Is telehealth medication management as effective as in-person visits?
          <span class="faq-plus">+</span>
        </button>

        <div class="faq-a">
          <p>
            For many patients, virtual medication management provides the same
            high standard of ongoing psychiatric care as in-person follow-up
            appointments when clinically appropriate.
          </p>
        </div>

      </div>


      <div class="faq-item">

        <button class="faq-q">
          Can medications be prescribed during a telehealth appointment?
          <span class="faq-plus">+</span>
        </button>

        <div class="faq-a">
          <p>
            If medication is clinically appropriate and permitted under
            applicable laws and regulations, your provider will discuss
            treatment options and prescribe medication when appropriate.
          </p>
        </div>

      </div>


      <div class="faq-item">

        <button class="faq-q">
          How often will I need follow-up appointments?
          <span class="faq-plus">+</span>
        </button>

        <div class="faq-a">
          <p>
            The frequency of follow-up visits depends on your diagnosis,
            treatment plan, and how well your symptoms are responding.
            Your provider will recommend a schedule based on your
            individual needs.
          </p>
        </div>

      </div>


      <div class="faq-item">

        <button class="faq-q">
          What if my medication isn't working?
          <span class="faq-plus">+</span>
        </button>

        <div class="faq-a">
          <p>
            Your provider will review your symptoms, discuss any side effects,
            and make adjustments to your treatment plan when clinically
            appropriate. Medication management is designed to evolve with
            your needs.
          </p>
        </div>

      </div>

    </div>

  </div>
</section>


<!-- FINAL CTA -->

<section
  id="book"
  style="background:var(--harbor-deep); position:relative; overflow:hidden;"
>

  <div
    style="position:absolute; top:-160px; right:-120px; width:480px; height:480px; border-radius:50%; background:radial-gradient(circle, rgba(44,169,218,0.20), transparent 70%);"
  ></div>

  <div
    class="wrap"
    style="position:relative; text-align:center; max-width:700px;"
  >

    <h2
      style="color:#fff; font-size:clamp(28px,4vw,42px); line-height:1.2;"
    >
      You don't have to navigate this alone.
    </h2>

    <p
      style="margin-top:18px; color:#AEC0CC; font-size:16.5px; line-height:1.7;"
    >
      Whether you're starting treatment for the first time or continuing
      ongoing care, our providers are ready to help you move forward —
      from wherever you are.
    </p>

    <div
      style="margin-top:36px; display:flex; justify-content:center; gap:20px; flex-wrap:wrap;"
    >
      <a
        href="#"
        class="btn btn-primary"
        style="padding:17px 34px; font-size:16px;"
      >
        Schedule Your Telehealth Appointment
      </a>
    </div>

  </div>

</section>
<?php /* ============================================================
   PASTE THIS just before the closing </div> of <div class="telehealth-page">,
   i.e. right after the </section> for #book and before:

     </div>
     <?php get_footer(); ?>

   ============================================================ */
?>

<!-- BOOK CONSULTATION MODAL -->
<div class="consult-modal" id="consultModal" hidden>

  <div class="consult-modal__overlay" data-consult-close></div>

  <div
    class="consult-modal__panel"
    role="dialog"
    aria-modal="true"
    aria-labelledby="consultModalTitle"
  >
    <button
      type="button"
      class="consult-modal__close"
      data-consult-close
      aria-label="Close"
    >
      &times;
    </button>

    <h2 id="consultModalTitle" class="consult-modal__title">
      Book Your Consultation
    </h2>

    <p class="consult-modal__subtitle">
      Tell us a bit about you so we can send you to the right form.
    </p>

    <div class="consult-modal__options">

      <a
        href="<?php echo esc_url(home_url('/new-patients/')); ?>"
        class="consult-modal__option"
      >
        <span class="consult-modal__option-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M19 8v6M22 11h-6"/>
          </svg>
        </span>
        <span class="consult-modal__option-text">
          <span class="consult-modal__option-label">New Patient</span>
          <span class="consult-modal__option-sub">This is my first visit</span>
        </span>
        <span class="consult-modal__option-arrow">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M5 12h14M13 6l6 6-6 6"/>
          </svg>
        </span>
      </a>

      <a
        href="<?php echo esc_url(home_url('/existing-patients/')); ?>"
        class="consult-modal__option"
      >
        <span class="consult-modal__option-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
            <path d="M9 14l2 2 4-4"/>
          </svg>
        </span>
        <span class="consult-modal__option-text">
          <span class="consult-modal__option-label">Existing Patient</span>
          <span class="consult-modal__option-sub">I'm already a Pinnacle patient</span>
        </span>
        <span class="consult-modal__option-arrow">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M5 12h14M13 6l6 6-6 6"/>
          </svg>
        </span>
      </a>

    </div>
  </div>
</div>
</div>


<?php
get_footer();