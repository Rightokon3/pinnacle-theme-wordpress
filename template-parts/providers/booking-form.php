<?php
$current_provider_id = get_the_ID();
?>

<section
    class="provider-booking-section"
    data-provider-id="<?php echo esc_attr($current_provider_id); ?>"
>

    <?php
    echo do_shortcode(
        '[contact-form-7 id="f756eed" title="Provider Booking Form"]'
    );
    ?>

</section>