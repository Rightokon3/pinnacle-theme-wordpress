<?php
/**
 * Contact page — free OpenStreetMap embed (no API key required) with a
 * floating business-info card. Pure PHP; no JS dependency, since the OSM
 * embed is just an iframe.
 *
 * Expects $args['latitude'], $args['longitude'], $args['business_name'],
 * $args['address_lines'] (array of ['line' => '']).
 */

$latitude      = $args['latitude'] ?? 44.9778;
$longitude     = $args['longitude'] ?? -93.265;
$business_name = $args['business_name'] ?? 'Pinnacle Behavioral Healthcare';
$address_lines = $args['address_lines'] ?? [];
$zoom_offset   = 0.01;

$bbox = implode(',', [
    $longitude - $zoom_offset,
    $latitude - ($zoom_offset * 0.6),
    $longitude + $zoom_offset,
    $latitude + ($zoom_offset * 0.6),
]);

$embed_src       = "https://www.openstreetmap.org/export/embed.html?bbox={$bbox}&layer=mapnik&marker={$latitude},{$longitude}";
$large_map_href  = "https://www.openstreetmap.org/?mlat={$latitude}&mlon={$longitude}#map=16/{$latitude}/{$longitude}";
$directions_href = "https://www.openstreetmap.org/directions?to={$latitude}%2C{$longitude}";
?>

<div class="contact-map">
    <iframe
        title="Map showing <?php echo esc_attr($business_name); ?>"
        src="<?php echo esc_url($embed_src); ?>"
        class="contact-map__iframe"
        loading="lazy"
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

    <p class="contact-map__attribution">&copy; OpenStreetMap contributors</p>
</div>