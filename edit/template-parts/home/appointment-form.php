<?php
/**
 * Appointment booking card, used inside the hero section.
 * Expects $args['title'] and $args['services'] (array of ['service_name' => '']).
 *
 * The form posts nowhere yet — assets/js/appointment-form.js swaps it for a
 * thank-you message on submit. Wire up the real handler when the booking
 * backend is ready (e.g. an admin-post.php action or REST endpoint).
 */

$title    = $args['title'] ?? 'Book a Consultation';
$services = $args['services'] ?? [];
?>

<div class="appointment-form" data-appointment-form>
    <div class="appointment-form__inner">
        <h2 class="appointment-form__title"><?php echo esc_html($title); ?></h2>

        <form class="appointment-form__form" novalidate data-appointment-form-fields>
            <label class="appointment-form__field">
                <span class="sr-only">Full Name</span>
                <input type="text" name="full_name" required placeholder="Name*" class="appointment-form__input">
            </label>

            <label class="appointment-form__field">
                <span class="sr-only">Phone Number</span>
                <input type="tel" name="phone_number" required placeholder="Phone Number*" class="appointment-form__input">
            </label>

            <label class="appointment-form__field appointment-form__field--select">
                <span class="sr-only">Choose Service</span>
                <select name="service" required class="appointment-form__input appointment-form__select">
                    <option value="" disabled selected>Choose Service*</option>
                    <?php foreach ($services as $service) : ?>
                        <option value="<?php echo esc_attr($service['service_name']); ?>">
                            <?php echo esc_html($service['service_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <button type="submit" class="appointment-form__submit">
                <span>SUBMIT</span>
                <svg class="appointment-form__submit-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M2 8H14M14 8L9 3M14 8L9 13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>

        <p class="appointment-form__success" role="status" hidden data-appointment-form-success>
            Thanks — we've received your request and will call you shortly to confirm.
        </p>
    </div>
</div>