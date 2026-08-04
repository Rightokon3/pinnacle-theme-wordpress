<?php
/**
 * Quick Facts band — three columns: location, history, dispensary offer.
 * Include on the front page with: get_template_part('template-parts/quick-facts');
 */
?>
<section class="quick-facts">
    <div class="quick-facts__inner">

        <div class="quick-facts__item">
            <h2 class="quick-facts__title">Serving Minneapolis And The Twin Cities Area</h2>
            <p class="quick-facts__text">
                Pinnacle Behavioral Healthcare specializes in the treatment of adults with
                mental health disorders. Our goal is to help people facing emotional
                distress reach their greatest potential.
            </p>
            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="quick-facts__cta">
                View Services <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="quick-facts__item">
            <h2 class="quick-facts__title">Helping The Community Since 2015</h2>
            <p class="quick-facts__text">
                Dr. Maya Whitfield founded our practice to give patients access to a
                genuinely high level of mental healthcare, built around real
                relationships with providers.
            </p>
            <a href="<?php echo esc_url(home_url('/providers/')); ?>" class="quick-facts__cta">
                Read About Us <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="quick-facts__item">
            <h2 class="quick-facts__title">10% Off Your First Supplement Order</h2>
            <p class="quick-facts__text">
                We only carry supplements from reputable, quality-tested brands, so you
                can trust what you're adding to your care plan. Offer code:
                <strong>WELCOME10</strong>
            </p>
            <a href="<?php echo esc_url(home_url('/dispensary/')); ?>" class="quick-facts__cta">
                Shop Now <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

    </div>
</section>