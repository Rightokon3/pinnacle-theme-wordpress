<?php
/**
 * Appointment booking card.
 *
 * Contact Form 7 handles submission.
 * WP Mail SMTP handles delivery.
 */

$title    = $args['title'] ?? 'Book a Consultation';
$services = $args['services'] ?? [];
?>

<div class="appointment-form" data-appointment-form>

    <div class="appointment-form__inner">

        <h2 class="appointment-form__title">
            <?php echo esc_html($title); ?>
        </h2>


        <?php
        /*
         * Contact Form 7 form.
         *
         * IMPORTANT:
         * Replace 1234 with your actual Homepage Appointment Form ID.
         */

        echo do_shortcode(
            '[contact-form-7 id="fe63ef3" title="Homepage Appointment Form"]'
        );
        ?>


    </div>

</div>