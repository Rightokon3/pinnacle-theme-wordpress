<?php
/**
 * Contact page — contact form card.
 *
 * The form posts nowhere yet — assets/js/contact-form.js swaps it for a
 * thank-you message on submit, same pattern as
 * assets/js/appointment-form.js. Wire up the real handler when the
 * contact-form backend is ready (e.g. an admin-post.php action or REST
 * endpoint).
 */
?>

<div class="contact-form" data-contact-form>
    <form class="contact-form__form" novalidate data-contact-form-fields>
        <div class="contact-form__row">
            <label class="contact-form__field">
                <span class="sr-only">First Name</span>
                <input type="text" name="first_name" required placeholder="First Name*" class="contact-form__input">
            </label>

            <label class="contact-form__field">
                <span class="sr-only">Last Name</span>
                <input type="text" name="last_name" required placeholder="Last Name*" class="contact-form__input">
            </label>
        </div>

        <label class="contact-form__field">
            <span class="sr-only">Email Address</span>
            <input type="email" name="email" required placeholder="Email Address*" class="contact-form__input">
        </label>

        <label class="contact-form__field">
            <span class="sr-only">Message</span>
            <textarea name="message" required rows="4" placeholder="Message*" class="contact-form__input contact-form__textarea"></textarea>
        </label>

        <button type="submit" class="contact-form__submit">
            <span>Send Message</span>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>

    <p class="contact-form__success" role="status" hidden data-contact-form-success>
        Thanks for reaching out — we'll get back to you shortly.
    </p>
</div>