<?php
/**
 * Footer / Contact page — Contact Form 7 version.
 */

$footer_contact_form_id = '9275c51';
?>

<div class="contact-form">

    <?php
    if ( function_exists( 'do_shortcode' ) ) {

        echo do_shortcode(
            '[contact-form-7 id="' . esc_attr( $footer_contact_form_id ) . '"]'
        );

    }
    ?>

</div>