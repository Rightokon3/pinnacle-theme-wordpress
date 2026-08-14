<?php
/**
 * Contact page — Google Maps embed (no API key required, uses the
 * plain "?output=embed" iframe form) with a floating business-info
 * card. Pure PHP; no JS dependency, since the embed is just an iframe.
 *
 * Expects $args['latitude'], $args['longitude'], $args['business_name'],
 * $args['address_lines'] (array of ['line' => '']).
 */

$latitude      = $args['latitude'] ?? 44.882068;
$longitude     = $args['longitude'] ?? -93.329916;
$business_name = $args['business_name'] ?? 'Pinnacle Behavioral Healthcare';
$address_lines = $args['address_lines'] ?? [];

$map_query        = urlencode($latitude . ',' . $longitude);
$embed_src        = "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2827.0343504523153!2d-93.3303132!3d44.8819499!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87f62404bb8525e5%3A0x63a55b283e08ad5e!2sPinnacle%20Behavioral%20Healthcare%20%7C%20Edina!5e0!3m2!1sen!2sng!4v1786718131153!5m2!1sen!2sng";
$large_map_href    = "https://www.google.com/maps/search/?api=1&query={$map_query}";
$directions_href  = "https://www.google.com/maps/dir/?api=1&destination={$map_query}";
?>

<div class="contact-map">
    <iframe
        title="Map showing <?php echo esc_attr($business_name); ?>"
        src="<?php echo esc_url($embed_src); ?>"
        class="contact-map__iframe"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
    ></iframe>

    <div class="contact-map__card">
        <div class="contact-map__card-top">
            <div>
                <p class="contact-map__name"><?php echo esc_html($business_name); ?></p>
                <?php foreach ($address_lines as $line) : ?>
                    <p class="contact-map__address-line"><?php echo esc_html($line['line']); ?></p>
                <?php endforeach; ?>
            </div>

            <a
                href="<?php echo esc_url($large_map_href); ?>"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Open full map"
                class="contact-map__external"
            >
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                    <polyline points="15 3 21 3 21 9"/>
                    <line x1="10" y1="14" x2="21" y2="3"/>
                </svg>
            </a>
        </div>

        <a
            href="<?php echo esc_url($directions_href); ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="contact-map__directions"
        >
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polygon points="3 11 22 2 13 21 11 13 3 11"/>
            </svg>
            Get Directions
        </a>
    </div>

    <p class="contact-map__attribution">Map data &copy;Google</p>
</div>