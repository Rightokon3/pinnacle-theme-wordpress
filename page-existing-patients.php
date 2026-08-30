<?php 
/** 
 * Template Name: Existing Patients 
 * File: page-existing-patients.php 
 * 
 * Faithful clone of the "Existing Patient Intake Page" reference file, 
 * adapted to WordPress: 
 *  - Uses the site's real header/footer (the reference file's own 
 *    slim logo+phone bar was a standalone-mockup-only nav, not meant 
 *    to replace the site's real navigation). 
 *  - All of the reference page's CSS is scoped under .intake-v2 in 
 *    style.css so its color tokens can't leak into the rest of the 
 *    theme. 
 *  - The 5 request-type cards use separate Contact Form 7 forms. 
 *  - Only the selected request type's CF7 form is displayed. 
 *  - Contact Form 7 handles submission and WP Mail SMTP handles delivery. 
 */ 
 
get_header(); 


/* =========================================================
 * CONTACT FORM 7 FORM IDs
 *
 * Replace the values below with the IDs of your five CF7 forms.
 * ========================================================= */

$cf7_appointment_id = '0dead7c';
$cf7_refill_id      = '34c4ac8';
$cf7_question_id    = '27f88df';
$cf7_update_id      = '13eff08';
$cf7_callback_id    = '661a547';


/* =========================================================
 * CONTACT FORM 7 RENDER HELPER
 * ========================================================= */

function pinnacle_render_existing_patient_cf7( $form_id ) {

    if ( ! $form_id ) {
        return;
    }

    if ( ! function_exists( 'do_shortcode' ) ) {
        return;
    }

    echo do_shortcode(
        '[contact-form-7 id="' . esc_attr( $form_id ) . '"]'
    );
}

?>

<div class="intake-v2">

<header class="hero" id="top" style="background:none;padding:0;"> 
  <div class="wrap"> 
    <div class="hero-top"> 
      <span class="eyebrow">Existing Patients</span> 
      <h1>Welcome back. Let's get <em>you taken care of.</em></h1> 
      <p class="hero-sub">Tell us what you need below and our care team will follow up — usually within one business day.</p> 
    </div> 
 
    <div class="req-grid" id="reqGrid"> 
      <div class="req-card" data-type="appointment"> 
        <div class="req-ico"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg></div> 
        <div class="req-label">Schedule an Appointment</div> 
      </div> 
      <div class="req-card" data-type="refill"> 
        <div class="req-ico"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4.5 8-11V5l-8-3-8 3v6c0 6.5 8 11 8 11z"/><path d="M9 12l2 2 4-4"/></svg></div> 
        <div class="req-label">Prescription Refill</div> 
      </div> 
      <div class="req-card" data-type="question"> 
        <div class="req-ico"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></div> 
        <div class="req-label">Ask a Clinical Question</div> 
      </div> 
      <div class="req-card" data-type="update"> 
        <div class="req-ico"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 013 3L12 15l-4 1 1-4z"/></svg></div> 
        <div class="req-label">Update My Information</div> 
      </div> 
      <div class="req-card" data-type="callback"> 
        <div class="req-ico"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#17847A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg></div> 
        <div class="req-label">Request a Callback</div> 
      </div> 
    </div> 


    <!-- =====================================================
         CONTACT FORM 7 AREA
    ====================================================== -->

    <div class="form-panel" id="intakeForm"> 

      <div class="form-panel-head"> 
        <h3 style="font-size:19px;">Your Request</h3> 

        <span class="selected-tag" id="selectedTag" style="display:none;"> 
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> 
          <span id="selectedTagText"></span> 
        </span> 
      </div> 

      <div class="form-hint" id="formHint">
        Choose an option above to get started — the form below will adjust to match.
      </div> 


      <!-- =================================================
           APPOINTMENT FORM
      ================================================== -->

      <div
          class="cf7-intake-form"
          data-cf7-form="appointment"
          style="display:none;"
      >
          <?php
          pinnacle_render_existing_patient_cf7(
              $cf7_appointment_id
          );
          ?>
      </div>


      <!-- =================================================
           REFILL FORM
      ================================================== -->

      <div
          class="cf7-intake-form"
          data-cf7-form="refill"
          style="display:none;"
      >
          <?php
          pinnacle_render_existing_patient_cf7(
              $cf7_refill_id
          );
          ?>
      </div>


      <!-- =================================================
           CLINICAL QUESTION FORM
      ================================================== -->

      <div
          class="cf7-intake-form"
          data-cf7-form="question"
          style="display:none;"
      >
          <?php
          pinnacle_render_existing_patient_cf7(
              $cf7_question_id
          );
          ?>
      </div>


      <!-- =================================================
           UPDATE INFORMATION FORM
      ================================================== -->

      <div
          class="cf7-intake-form"
          data-cf7-form="update"
          style="display:none;"
      >
          <?php
          pinnacle_render_existing_patient_cf7(
              $cf7_update_id
          );
          ?>
      </div>


      <!-- =================================================
           CALLBACK FORM
      ================================================== -->

      <div
          class="cf7-intake-form"
          data-cf7-form="callback"
          style="display:none;"
      >
          <?php
          pinnacle_render_existing_patient_cf7(
              $cf7_callback_id
          );
          ?>
      </div>

    </div>

  </div>
</header> 
 
<section class="tight" style="background:var(--paper); border-top:1px solid var(--line-soft); border-bottom:1px solid var(--line-soft);"> 
  <div class="wrap"> 
    <div class="next-grid"> 
      <div class="next-item"> 
        <div class="next-num">1</div> 
        <div> 
          <div class="next-title">You submit your request</div> 
          <div class="next-sub">Takes less than two minutes — no login required.</div> 
        </div> 
      </div> 
      <div class="next-item"> 
        <div class="next-num">2</div> 
        <div> 
          <div class="next-title">Your care team reviews it</div> 
          <div class="next-sub">Routed directly to the right person for your need.</div> 
        </div> 
      </div> 
      <div class="next-item"> 
        <div class="next-num">3</div> 
        <div> 
          <div class="next-title">We follow up with you</div> 
          <div class="next-sub">Usually within one business day, by your preferred contact method.</div> 
        </div> 
      </div> 
    </div> 
  </div> 
</section> 
 
<section id="faq"> 
  <div class="wrap" style="max-width:760px;"> 
    <div class="section-head"> 
      <span class="eyebrow">Quick Answers</span> 
      <h2>Common questions from existing patients</h2> 
    </div> 
    <div class="faq-list"> 
      <div class="faq-item open"> 
        <button class="faq-q">How long will it take to hear back?<span class="faq-plus">+</span></button> 
        <div class="faq-a"><p>Most requests are reviewed and responded to within one business day. Prescription refill requests are often handled sooner — same day when submitted before 2pm.</p></div> 
      </div> 
      <div class="faq-item"> 
        <button class="faq-q">Can I request a specific provider for my appointment?<span class="faq-plus">+</span></button> 
        <div class="faq-a"><p>Yes. Note your preferred provider in the scheduling form and we'll do our best to accommodate — subject to availability.</p></div> 
      </div> 
      <div class="faq-item"> 
        <button class="faq-q">What if I need a refill sooner than expected?<span class="faq-plus">+</span></button> 
        <div class="faq-a"><p>Submit your refill request as soon as you know you're running low. If it's urgent, call our office directly at (952) 303-6832.</p></div> 
      </div> 
      <div class="faq-item"> 
        <button class="faq-q">Is this form secure and confidential?<span class="faq-plus">+</span></button> 
        <div class="faq-a"><p>Yes. Information submitted here is handled confidentially and used only to route and respond to your request.</p></div> 
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


<!-- =========================================================
     CONTACT FORM 7 TAB SWITCHING
========================================================== -->

<script>
document.addEventListener(
    'DOMContentLoaded',
    function () {

        const cards =
            document.querySelectorAll(
                '.req-card[data-type]'
            );

        const forms =
            document.querySelectorAll(
                '.cf7-intake-form[data-cf7-form]'
            );

        const selectedTag =
            document.getElementById(
                'selectedTag'
            );

        const selectedTagText =
            document.getElementById(
                'selectedTagText'
            );

        const formHint =
            document.getElementById(
                'formHint'
            );


        const labels = {
            appointment: 'Schedule an Appointment',
            refill: 'Prescription Refill',
            question: 'Ask a Clinical Question',
            update: 'Update My Information',
            callback: 'Request a Callback'
        };


        function showForm(type) {

            forms.forEach(
                function (form) {

                    const formType =
                        form.getAttribute(
                            'data-cf7-form'
                        );

                    if (
                        formType === type
                    ) {

                        form.style.display =
                            'block';

                    } else {

                        form.style.display =
                            'none';

                    }

                }
            );


            cards.forEach(
                function (card) {

                    const cardType =
                        card.getAttribute(
                            'data-type'
                        );

                    if (
                        cardType === type
                    ) {

                        card.classList.add(
                            'active'
                        );

                    } else {

                        card.classList.remove(
                            'active'
                        );

                    }

                }
            );


            if (
                selectedTag &&
                selectedTagText
            ) {

                selectedTag.style.display =
                    'inline-flex';

                selectedTagText.textContent =
                    labels[type] || '';

            }


            if (formHint) {

                formHint.style.display =
                    'none';

            }

        }


        cards.forEach(
            function (card) {

                card.addEventListener(
                    'click',
                    function () {

                        const type =
                            card.getAttribute(
                                'data-type'
                            );

                        if (!type) {
                            return;
                        }

                        showForm(type);

                    }
                );

            }
        );


    }
);
</script>
 
 
<?php get_footer(); ?>