<?php
/**
 * Template Name: Make Payment
 * Template Post Type: page
 */

get_header();
?>

<main id="primary" class="site-main payment-page">

    <!-- =====================================================
         PAYMENT HERO
         ===================================================== -->

    <section class="payment-hero">

        <div class="payment-hero__overlay"></div>

        <div class="payment-hero__content">

            <h1>Make Payment</h1>

        </div>

    </section>


    <!-- =====================================================
         PAYMENT CONTENT
         ===================================================== -->

    <section class="payment-section">

        <div class="payment-section__inner">


            <!-- =================================================
                 LEFT COLUMN
                 ================================================= -->

            <div class="payment-info">

<section class="share-section">
    <h2 class="share-section__title">Share and Enjoy !</h2>
    <div class="share-section__buttons">
        <span class="share-section__label">SHARES</span>
        <a class="share-btn share-btn--facebook" href="https://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>" aria-label="Share on Facebook" target="_blank" rel="noopener">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/></svg>
        </a>
        <a class="share-btn share-btn--pinterest" href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" aria-label="Share on Pinterest" target="_blank" rel="noopener">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.5 2 2 6.5 2 12c0 4.2 2.6 7.8 6.3 9.3-.1-.8-.2-2 0-2.9l1.4-6s-.4-.7-.4-1.8c0-1.7 1-2.9 2.2-2.9 1 0 1.5.8 1.5 1.7 0 1-.7 2.6-1 4-.3 1.2.6 2.2 1.8 2.2 2.1 0 3.7-2.3 3.7-5.5 0-2.9-2.1-4.9-5-4.9-3.4 0-5.5 2.6-5.5 5.2 0 1 .4 2.1.9 2.7.1.1.1.2.1.3-.1.4-.3 1.2-.3 1.4-.1.2-.2.3-.4.2-1.5-.7-2.4-2.9-2.4-4.6 0-3.8 2.7-7.2 7.9-7.2 4.1 0 7.4 3 7.4 6.9 0 4.1-2.6 7.4-6.2 7.4-1.2 0-2.4-.6-2.7-1.4l-.8 2.9c-.3 1-1 2.3-1.5 3.1 1.1.3 2.3.5 3.5.5 5.5 0 10-4.5 10-10S17.5 2 12 2z"/></svg>
        </a>
        <button type="button" class="share-btn share-btn--pdf" onclick="window.print()" aria-label="Print / Save as PDF">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9V2h9l5 5v2"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        </button>
        <button type="button" class="share-btn share-btn--copy" data-copy-link="<?php echo esc_url(get_permalink()); ?>" aria-label="Copy link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        </button>
        <button type="button" class="share-btn share-btn--more" aria-label="More sharing options">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </button>
    </div>
</section>


                <div class="payment-description">

                    <p>
                        You can now make payments, or make partial payments
                        either using your PayPal account, or using your
                        credit/debit card.
                    </p>

                    <p>
                        Choose a pre-defined amount or enter another amount
                        and click on the Pay Now button.
                    </p>

                </div>

            </div>


            <!-- =================================================
                 RIGHT COLUMN
                 ================================================= -->

            <div class="payment-card">

                <h2>Enter Amount You Would Like To Pay</h2>


                <form
                    class="payment-form"
                    method="post"
                    action=""
                >

                    <!-- Amount -->

                    <div class="payment-form__field payment-form__amount">

                        <label for="payment_amount">
                            Other Amount:
                        </label>

                        <input
                            type="number"
                            id="payment_amount"
                            name="payment_amount"
                            min="0"
                            step="0.01"
                            inputmode="decimal"
                        >

                    </div>


                    <!-- Patient -->

                    <div class="payment-form__field">

                        <label for="patient_account">
                            Patient's name or WRS account number:
                        </label>

                        <input
                            type="text"
                            id="patient_account"
                            name="patient_account"
                            placeholder="Patient's name or WRS account number"
                            autocomplete="off"
                        >

                    </div>


                    <!-- Email -->

                    <div class="payment-form__field">

                        <label for="payment_email">
                            Email Address:
                        </label>

                        <input
                            type="email"
                            id="payment_email"
                            name="payment_email"
                            placeholder="Email Address"
                            autocomplete="email"
                        >

                    </div>


                    <!-- PayPal -->

                    <button
                        type="button"
                        class="payment-button payment-button--paypal"
                        id="paypal-payment-button"
                    >
                        PayPal
                    </button>


                    <!-- Card -->

                    <button
                        type="button"
                        class="payment-button payment-button--card"
                        id="card-payment-button"
                    >
                        <span class="payment-button__icon">
                            ▭
                        </span>

                        Debit or Credit Card
                    </button>


                    <div class="payment-powered">
                        Powered by <strong>PayPal</strong>
                    </div>

                </form>

            </div>

        </div>

    </section>

</main>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const paypalButton = document.getElementById('paypal-payment-button');
    const cardButton = document.getElementById('card-payment-button');

    function validatePaymentForm() {

        const amount = document.getElementById('payment_amount');
        const patient = document.getElementById('patient_account');
        const email = document.getElementById('payment_email');

        if (!amount.value || parseFloat(amount.value) <= 0) {
            alert('Please enter a payment amount.');
            amount.focus();
            return false;
        }

        if (!patient.value.trim()) {
            alert('Please enter the patient name or WRS account number.');
            patient.focus();
            return false;
        }

        if (!email.value.trim()) {
            alert('Please enter your email address.');
            email.focus();
            return false;
        }

        return true;
    }


    paypalButton.addEventListener('click', function () {

        if (!validatePaymentForm()) {
            return;
        }

        /*
         * PayPal integration goes here.
         *
         * Do NOT put PayPal secret keys in this file.
         */

        console.log('PayPal payment ready.');

    });


    cardButton.addEventListener('click', function () {

        if (!validatePaymentForm()) {
            return;
        }

        /*
         * Credit/debit card payment integration goes here.
         */

        console.log('Card payment ready.');

    });

});
</script>
<?php get_template_part('template-parts/contact/contact'); ?>

<?php
get_footer();
?>