<?php
/**
 * Template Name: PBH Contact Page
 * Description: Isolated WordPress version of the supplied Pinnacle Contact Us page.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$pbh_contact_status = isset($_GET['pbh_contact']) ? sanitize_key(wp_unslash($_GET['pbh_contact'])) : '';
?>

<main class="pbh-contact-page">
    <section class="pbh-contact-intro">
        <div class="pbh-contact-wrap">
            <h1>Contact Us</h1>
            <p>Have a question, or ready to get started? Send us a message and our Edina team will follow up — or jump straight to the option that fits you below.</p>
        </div>
    </section>

    <?php if ($pbh_contact_status === 'success') : ?>
        <div class="pbh-contact-notice pbh-contact-notice--success" role="status">
            Your message has been sent successfully. We typically respond within one business day.
        </div>
    <?php elseif ($pbh_contact_status === 'error') : ?>
        <div class="pbh-contact-notice pbh-contact-notice--error" role="alert">
            We couldn't send your message right now. Please try again or call us directly.
        </div>
    <?php endif; ?>

    <section class="pbh-contact-main">
        <div class="pbh-contact-wrap">
            <div class="pbh-contact-grid">

                <div class="pbh-contact-form-side">
                    <form class="pbh-contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="pbh_contact_submit">
                        <?php wp_nonce_field('pbh_contact_submit', 'pbh_contact_nonce'); ?>

                        <div class="pbh-contact-field-row">
                            <div class="pbh-contact-field">
                                <label for="pbh-first-name">First Name<span>*</span></label>
                                <input id="pbh-first-name" type="text" name="first_name" autocomplete="given-name" required>
                            </div>
                            <div class="pbh-contact-field">
                                <label for="pbh-last-name">Last Name<span>*</span></label>
                                <input id="pbh-last-name" type="text" name="last_name" autocomplete="family-name" required>
                            </div>
                        </div>

                        <div class="pbh-contact-field-row">
                            <div class="pbh-contact-field">
                                <label for="pbh-phone">Phone Number<span>*</span></label>
                                <input id="pbh-phone" type="tel" name="phone" autocomplete="tel" required>
                            </div>
                            <div class="pbh-contact-field">
                                <label for="pbh-email">Email Address<span>*</span></label>
                                <input id="pbh-email" type="email" name="email" autocomplete="email" required>
                            </div>
                        </div>

                        <div class="pbh-contact-field">
                            <label for="pbh-service">Choose Service<span>*</span></label>
                            <select id="pbh-service" name="service" required>
                                <option value="" selected disabled>Select a service</option>
                                <option>Psychiatric Evaluation</option>
                                <option>Medication Management</option>
                                <option>Individual Therapy</option>
                                <option>Adolescent &amp; Teen Care</option>
                                <option>Telehealth</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="pbh-contact-field">
                            <label for="pbh-message">Message<span>*</span></label>
                            <textarea id="pbh-message" name="message" rows="2" required></textarea>
                        </div>

                        <button type="submit" class="pbh-contact-submit">
                            Send Message
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
                                <path d="M5 12h14M13 6l6 6-6 6"/>
                            </svg>
                        </button>

                        <p class="pbh-contact-form-note">We typically respond within one business day.</p>
                    </form>
                </div>

                <aside class="pbh-contact-info-side">
                    <div>
                        <h2>Contact Us</h2>

                        <div class="pbh-contact-info-row">
                            <svg class="pbh-contact-info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <div>
                                <div class="pbh-contact-address">6600 France Ave S<br>Suite 415<br>Edina, MN 55435</div>
                                <a href="https://www.google.com/maps/place/Pinnacle+Behavioral+Healthcare+%7C+Edina" class="pbh-contact-directions" target="_blank" rel="noopener">Get Directions</a>
                            </div>
                        </div>

                        <div class="pbh-contact-info-row">
                            <svg class="pbh-contact-info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.1 4.22 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            <div class="pbh-contact-phone">
                                <a href="tel:9522487858">(952) 248-7858</a>
                            </div>
                        </div>

                        <div class="pbh-contact-socials">
                            <a href="#" aria-label="Facebook">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.78-3.89 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0 0 22 12z"/></svg>
                            </a>
                            <a href="#" aria-label="Instagram">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" aria-hidden="true"><rect x="2.5" y="2.5" width="19" height="19" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.4" cy="6.6" r="1.1" fill="currentColor" stroke="none"/></svg>
                            </a>
                            <a href="#" aria-label="X">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-7.2l-5.6-7.3L4 22H1l8.1-9.3L.9 2h7.4l5 6.7L18.9 2zm-1.3 18h2L6.5 4H4.4l13.2 16z"/></svg>
                            </a>
                        </div>
                    </div>
                    <div class="pbh-contact-info-footer-bar"></div>
                </aside>

            </div>
        </div>
    </section>

    <section class="pbh-contact-segments">
        <div class="pbh-contact-wrap">
            <div class="pbh-contact-section-head">
                <h2>Not sure where to start?</h2>
                <p>Choose the option below that matches you, and we'll route you straight to the right form — no need to fill out the general contact form above.</p>
            </div>

            <div class="pbh-contact-segment-grid">
                <a href="<?php echo esc_url(home_url('/new-patients/')); ?>" class="pbh-contact-segment-card">
                    <div class="pbh-contact-segment-icon">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M22 11h-6"/></svg>
                    </div>
                    <h3>New Patients</h3>
                    <p>Starting care for the first time? Tell us about your needs and get matched with a provider.</p>
                    <span>Start Intake →</span>
                </a>

                <a href="<?php echo esc_url(home_url('/existing-patients/')); ?>" class="pbh-contact-segment-card">
                    <div class="pbh-contact-segment-icon">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 11 3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <h3>Existing Patients</h3>
                    <p>Already a patient? Request an appointment, a callback, or a prescription refill.</p>
                    <span>Go to Patient Portal →</span>
                </a>

                <a href="<?php echo esc_url(home_url('/telehealth/')); ?>" class="pbh-contact-segment-card">
                    <div class="pbh-contact-segment-icon">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9 12 2l9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg>
                    </div>
                    <h3>Telehealth Visit</h3>
                    <p>Prefer to be seen from home? Request a secure video appointment.</p>
                    <span>Request Telehealth →</span>
                </a>

                <a href="<?php echo esc_url(home_url('/insurance-verification/')); ?>" class="pbh-contact-segment-card">
                    <div class="pbh-contact-segment-icon">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4.5 8-11V5l-8-3-8 3v6c0 6.5-8 11-8 11z"/></svg>
                    </div>
                    <h3>Insurance Verification</h3>
                    <p>Check your coverage and benefits with our team before your first visit.</p>
                    <span>Verify Insurance →</span>
                </a>

                <a href="<?php echo esc_url(home_url('/provider-matching/')); ?>" class="pbh-contact-segment-card">
                    <div class="pbh-contact-segment-icon">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/></svg>
                    </div>
                    <h3>Provider Matching</h3>
                    <p>Tell us what you're looking for and we'll match you with the right psychiatrist or therapist.</p>
                    <span>Find My Provider →</span>
                </a>

               <a href="<?php echo esc_url(home_url('/existing-patients/?request=callback#reqGrid') ); ?>"class="pbh-contact-segment-card" >
                    <div class="pbh-contact-segment-icon">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                    </div>
                    <h3>Request a Callback</h3>
                    <p>Short on time? Leave your number and a quick note — we'll call you back.</p>
                    <span>Request Callback →</span>
                </a>
            </div>
        </div>
    </section>

    <section class="pbh-contact-map">
        <div class="pbh-contact-wrap pbh-contact-map-head">
            <h2>Visit Our Edina Office</h2>
            <p>6600 France Ave S, Suite 415, Edina, MN 55435</p>
        </div>
        <iframe
            class="pbh-contact-map-frame"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11308.137382154!2d-93.330313!3d44.88195!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87f62404bb8525e5%3A0x63a55b283e08ad5e!2sPinnacle%20Behavioral%20Healthcare%20%7C%20Edina!5e0!3m2!1sen!2sng!4v1786715929504!5m2!1sen!2sng"
            allowfullscreen
            loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin"
            title="Pinnacle Behavioral Healthcare Edina location map">
        </iframe>
    </section>
</main>
<style>
  /*
 * PBH Contact Page
 * Completely isolated stylesheet.
 * Every selector is prefixed with .pbh-contact- so it does not
 * intentionally target the existing theme's contact classes.
 */

.pbh-contact-page {
    --pbh-white: #fff;
    --pbh-cloud: #f7fbfd;
    --pbh-ink: #233240;
    --pbh-muted: #6b7b87;
    --pbh-faint: #93a2ac;
    --pbh-navy: #0e2a43;
    --pbh-navy-deep: #0a2038;
    --pbh-sky: #2ca9da;
    --pbh-sky-deep: #1b8fbd;
    --pbh-card-blue-1: #e4f6fd;
    --pbh-card-blue-2: #cdeaf8;
    --pbh-sand: #e2984e;
    --pbh-line: #e4ebef;
    color: var(--pbh-ink);
    background: var(--pbh-white);
    font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
}

.pbh-contact-page *,
.pbh-contact-page *::before,
.pbh-contact-page *::after {
    box-sizing: border-box;
}

.pbh-contact-page a {
    color: inherit;
    text-decoration: none;
}

.pbh-contact-page img {
    max-width: 100%;
    display: block;
}

.pbh-contact-page h1,
.pbh-contact-page h2,
.pbh-contact-page h3 {
    font-family: "Poppins", sans-serif;
    font-weight: 700;
    letter-spacing: -0.01em;
}

.pbh-contact-wrap {
    width: min(1180px, calc(100% - 64px));
    margin: 0 auto;
}

.pbh-contact-intro {
    padding: 56px 0 8px;
    text-align: center;
}

.pbh-contact-intro h1 {
    margin: 0;
    color: var(--pbh-navy);
    font-size: clamp(28px, 3.6vw, 38px);
}

.pbh-contact-intro p {
    max-width: 560px;
    margin: 14px auto 0;
    color: var(--pbh-muted);
    font-size: 16px;
}

.pbh-contact-notice {
    width: min(760px, calc(100% - 44px));
    margin: 24px auto 0;
    padding: 14px 18px;
    border-radius: 10px;
    font-size: 14px;
}

.pbh-contact-notice--success {
    color: #155724;
    background: #eaf8ee;
    border: 1px solid #b9e5c4;
}

.pbh-contact-notice--error {
    color: #842029;
    background: #fff1f2;
    border: 1px solid #f1b8be;
}

.pbh-contact-main {
    padding: 52px 0 90px;
}

.pbh-contact-grid {
    display: grid;
    grid-template-columns: 1.25fr 1fr;
    border: 1px solid var(--pbh-line);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 30px 70px -40px rgba(14, 42, 67, .22);
}

.pbh-contact-form-side {
    padding: 52px 48px;
    background: var(--pbh-white);
}

.pbh-contact-field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
}

.pbh-contact-field {
    margin-bottom: 34px;
}

.pbh-contact-field label {
    display: block;
    font-size: 14.5px;
    color: var(--pbh-muted);
}

.pbh-contact-field label span {
    color: var(--pbh-sand);
    font-style: normal;
}

.pbh-contact-field input,
.pbh-contact-field select,
.pbh-contact-field textarea {
    display: block;
    width: 100%;
    margin: 0;
    border: 0;
    border-bottom: 1px solid var(--pbh-line);
    border-radius: 0;
    background: transparent;
    padding: 12px 0 10px;
    color: var(--pbh-ink);
    font-size: 15px;
    font-family: "Inter", sans-serif;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    box-shadow: none;
}

.pbh-contact-field select {
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='9' viewBox='0 0 14 9'><path d='M1 1l6 6 6-6' stroke='%236B7B87' stroke-width='1.6' fill='none' stroke-linecap='round' stroke-linejoin='round'/></svg>");
    background-repeat: no-repeat;
    background-position: right 4px center;
    padding-right: 24px;
}

.pbh-contact-field textarea {
    resize: vertical;
    min-height: 70px;
}

.pbh-contact-field input:focus,
.pbh-contact-field select:focus,
.pbh-contact-field textarea:focus {
    border-bottom-color: var(--pbh-sky);
}

.pbh-contact-submit {
    margin-top: 6px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    border: 0;
    border-radius: 100px;
    background: var(--pbh-sky);
    color: #fff;
    padding: 15px 34px;
    font-family: "Inter", sans-serif;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 10px 26px -8px rgba(44, 169, 218, .55);
    transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
}

.pbh-contact-submit:hover {
    transform: translateY(-1px);
    background: var(--pbh-sky-deep);
    box-shadow: 0 12px 30px -8px rgba(44, 169, 218, .65);
}

.pbh-contact-submit:focus-visible,
.pbh-contact-segment-card:focus-visible,
.pbh-contact-socials a:focus-visible {
    outline: 2px solid var(--pbh-sky);
    outline-offset: 3px;
}

.pbh-contact-form-note {
    margin: 14px 0 0;
    color: var(--pbh-faint);
    font-size: 12.5px;
}

.pbh-contact-info-side {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 52px 46px 0;
    background: linear-gradient(150deg, var(--pbh-card-blue-1), var(--pbh-card-blue-2));
}

.pbh-contact-info-side h2 {
    margin: 0;
    color: var(--pbh-sky-deep);
    font-size: 28px;
}

.pbh-contact-info-row {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-top: 26px;
}

.pbh-contact-info-icon {
    width: 22px;
    height: 22px;
    flex: 0 0 22px;
    margin-top: 2px;
    color: var(--pbh-navy);
}

.pbh-contact-address {
    color: var(--pbh-navy);
    font-size: 15.5px;
    font-weight: 700;
    line-height: 1.55;
}

.pbh-contact-directions {
    display: inline-block;
    margin-top: 4px;
    color: var(--pbh-navy);
    font-size: 14.5px;
    font-weight: 700;
    text-decoration: underline !important;
}

.pbh-contact-phone,
.pbh-contact-phone a {
    color: var(--pbh-navy);
    font-size: 16px;
    font-weight: 700;
}

.pbh-contact-socials {
    display: flex;
    gap: 14px;
    margin-top: 30px;
}

.pbh-contact-socials a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #fff;
    color: var(--pbh-navy);
    box-shadow: 0 4px 12px rgba(14, 42, 67, .12);
    transition: transform .15s ease, background .15s ease;
}

.pbh-contact-socials a:hover {
    transform: translateY(-2px);
    background: #fff;
}

.pbh-contact-info-footer-bar {
    height: 14px;
    margin-top: 40px;
    background: var(--pbh-navy);
}

.pbh-contact-segments {
    padding: 80px 0;
    background: var(--pbh-cloud);
    border-top: 1px solid var(--pbh-line);
}

.pbh-contact-section-head {
    max-width: 600px;
    margin: 0 auto 44px;
    text-align: center;
}

.pbh-contact-section-head h2 {
    margin: 0;
    color: var(--pbh-navy);
    font-size: clamp(24px, 3vw, 32px);
}

.pbh-contact-section-head p {
    margin: 12px 0 0;
    color: var(--pbh-muted);
    font-size: 15.5px;
}

.pbh-contact-segment-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.pbh-contact-segment-card {
    display: flex;
    flex-direction: column;
    gap: 14px;
    min-height: 245px;
    padding: 28px 24px;
    border: 1px solid var(--pbh-line);
    border-radius: 16px;
    background: #fff;
    transition: border-color .15s ease, transform .15s ease, box-shadow .15s ease;
}

.pbh-contact-segment-card:hover {
    border-color: var(--pbh-sky);
    transform: translateY(-3px);
    box-shadow: 0 16px 30px -18px rgba(14, 42, 67, .3);
}

.pbh-contact-segment-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--pbh-card-blue-1);
    color: var(--pbh-sky-deep);
}

.pbh-contact-segment-card h3 {
    margin: 0;
    color: var(--pbh-navy);
    font-size: 16.5px;
}

.pbh-contact-segment-card p {
    flex-grow: 1;
    margin: 0;
    color: var(--pbh-muted);
    font-size: 13.5px;
}

.pbh-contact-segment-card > span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--pbh-sky-deep);
    font-size: 13.5px;
    font-weight: 700;
}

.pbh-contact-map {
    padding: 0;
}

.pbh-contact-map-head {
    padding: 64px 0 30px;
    text-align: center;
}

.pbh-contact-map-head h2 {
    margin: 0;
    color: var(--pbh-navy);
    font-size: clamp(24px, 3vw, 32px);
}

.pbh-contact-map-head p {
    margin: 10px 0 0;
    color: var(--pbh-muted);
    font-size: 15.5px;
}

.pbh-contact-map-frame {
    display: block;
    width: 100%;
    height: 420px;
    border: 0;
}

@media (max-width: 900px) {
    .pbh-contact-grid {
        grid-template-columns: 1fr;
    }

    .pbh-contact-segment-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 820px) {
    .pbh-contact-segment-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 560px) {
    .pbh-contact-wrap {
        width: min(100% - 44px, 1180px);
    }

    .pbh-contact-field-row {
        grid-template-columns: 1fr;
        gap: 0;
    }

    .pbh-contact-form-side {
        padding: 40px 26px;
    }

    .pbh-contact-info-side {
        padding: 40px 26px 0;
    }

    .pbh-contact-segment-grid {
        grid-template-columns: 1fr;
    }

    .pbh-contact-submit {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 420px) {
    .pbh-contact-intro {
        padding-top: 40px;
    }

    .pbh-contact-main {
        padding-top: 38px;
    }
}

</style>
<script>
   (function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('.pbh-contact-form');

        if (!form) {
            return;
        }

        form.addEventListener('submit', function () {
            var button = form.querySelector('.pbh-contact-submit');

            if (!button) {
                return;
            }

            button.disabled = true;
            button.setAttribute('aria-busy', 'true');
            button.dataset.originalText = button.textContent.trim();
            button.firstChild.textContent = 'Sending… ';
        });
    });
}());
 
</script>
<?php get_footer(); ?>
