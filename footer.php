</main>

<footer class="site-footer">
    <div class="site-footer__top">

        <!-- brand column -->
        <div class="footer-brand">
            <div class="footer-brand__logo-card">
                <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/Pinnacle_Logo.webp'); ?>"
                    alt="Pinnacle"
                    class="footer-brand__logo"
                >
            </div>

            <!--
                Partner badge: swap the src below for the official logo file
                your device partner (e.g. Neuronetics) provides to authorized
                providers — don't use a scraped or screenshotted copy.
            -->
            <div class="footer-brand__partner">
                <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/neuro-star-logo-300x116.webp'); ?>"
                    alt="NeuroStar Advanced Therapy for Mental Health"
                    class="footer-brand__partner-logo"
                >
                <blockquote class="footer-brand__quote">
                    &ldquo;We&rsquo;re proud to be part of a top-rated TMS treatment network.&rdquo;
                </blockquote>
            </div>

            <p class="footer-brand__tagline">
                An Accurate Diagnosis Can Be One Of The Most Important Steps You&rsquo;ll Take.
            </p>

            <div class="footer-brand__socials">
                <a href="#" aria-label="Facebook" class="footer-social-icon">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="#" aria-label="Instagram" class="footer-social-icon">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                <a href="#" aria-label="Twitter / X" class="footer-social-icon">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="4" x2="20" y2="20"/><line x1="20" y1="4" x2="4" y2="20"/></svg>
                </a>
            </div>
        </div>

        <!-- important links -->
        <nav class="footer-links" aria-label="Important Links">
            <h3 class="footer-heading">Important Links</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/providers/')); ?>">Providers</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></li>
                <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">News &amp; Articles</a></li>
                <li><a href="<?php echo esc_url(home_url('/privacy/')); ?>">Privacy</a></li>
            </ul>
        </nav>

        <!-- contact info -->
        <div class="footer-contact">
            <h3 class="footer-heading">Contact Info</h3>
            <p class="footer-contact__address">
                500 Wellness Blvd<br>
                Suite 200<br>
                Minneapolis, MN 55401
            </p>
            <p>
                <a href="https://www.openstreetmap.org/directions?to=44.9778%2C-93.265" target="_blank" rel="noopener noreferrer">
                    Get Directions
                </a>
            </p>
            <p>
                <a href="tel:+15551234567">(952) 295-9448</a>
            </p>
        </div>

    </div>

    <!-- disclaimer — placeholder; replace with your own reviewed clinical/legal copy -->
    <div class="site-footer__disclaimer">
        <p>
            Placeholder disclaimer text: this section is reserved for treatment
            indications, safety information, and any other regulatory or legal copy
            your organization is required to display. It should be reviewed and
            supplied by your clinical and legal teams before this site goes live —
            do not publish with this placeholder in place.
        </p>
    </div>

    <div class="site-footer__bottom">
        <p>&copy; <?php echo date('Y'); ?> Pinnacle Behavioral Healthcare. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>