<?php
/**
 * Template Name: Service Pillar
 *
 * Long-form service page template (NeuroStar TMS, and similar deep-dive
 * service pages): full-bleed hero photo, a "Book a Consultation" banner,
 * alternating-color fact-strip blocks down the left column with a sticky
 * table-of-contents sidebar, a video embed, an FAQ accordion, and a
 * closing contact form.
 *
 * Create a Page in wp-admin, assign this template, and fill in the
 * fields below.
 */

get_header();

$banner_image_url = $banner_image['url'] ?? get_template_directory_uri() . '/assets/images/back.webp';
$nero_image_url = $nero_image['url'] ?? get_template_directory_uri() . '/assets/images/neuro-star-logo-300x116.webp';
$hero_image = get_field('hero_image');
$hero_image_alt = $hero_image['alt'] ?? get_the_title();



$banner_cta_link = get_field('banner_cta_link') ?: '#contact-form';

$fact_strip = get_field('fact_strip');
if (empty($fact_strip)) {
    $fact_strip = [ 
         ['icon' => 'pill', 'heading' => 'Patients Are Awake And Alert During Sessions', 'description' => 'You will be awake and aware of everything during treatment. You will be able to return to normal activities immediately after your sessions.'],
           ['icon' => 'calendar', 'heading' => '36 total treatments over 4-7 weeks', 'description' => 'Sessions tend to last 19-37 minutes. You can do sessions 5-7 times a week.'],
        ['icon' => 'brain', 'heading' => 'Trans-Cranial Magnetic Stimulation', 'description' => 'TMS therapy uses magnetic fields, stimulating nerve cells in targeted areas of your brain.'],
      
    ];
}

$video_url = get_field('video_url');

$faq_heading = get_field('faq_heading') ?: 'Frequently Asked Questions (FAQs)';
$faq_intro = get_field('faq_intro');
$faqs = get_field('faqs');
if (empty($faqs)) {
    $faqs = [
        ['question' => 'What is NeuroStar TMS (Transcranial Magnetic Stimulation)?', 'answer' => 'NeuroStar TMS, or Transcranial Magnetic Stimulation, is an FDA-cleared treatment for the source of your depression – your brain.  It uses focused magnetic pulses to reignite inactive synapses in your brain, leading to improved function. Mood regulation is intricately linked to certain areas in your brain, and ”waking” up these connections can have lasting positive effects and make long-term remission from depression a reality.'],
        ['question' => 'How does NeuroStar TMS work?', 'answer' => 'NeuroStar TMS works by using magnetic fields to stimulate nerve cells in targeted areas of your brain. This stimulation can help improve mood and reduce symptoms of depression.'],
        ['question' => 'Is NeuroStar TMS safe?', 'answer' => 'Yes, NeuroStar TMS is a safe and non-invasive treatment option for depression. It has been cleared by the FDA and has been shown to be effective in clinical studies.'],
        ['question' => 'What are the side effects of NeuroStar TMS?', 'answer' => 'The most common side effects of NeuroStar TMS are mild scalp discomfort or headache during treatment. These side effects are usually temporary and go away after the session.'],
        ['question' => 'How long does a NeuroStar TMS session last?', 'answer' => 'A typical NeuroStar TMS session lasts about 19-37 minutes, depending on the specific protocol being used.'],
        ['question' => 'How many sessions will I need?', 'answer' => 'Most patients undergo a total of 36 treatments over 4-7 weeks, with sessions typically scheduled 5-7 times per week. Your provider will create a personalized treatment plan based on your needs.'],

    ];
}

$sidebar_links = get_field('sidebar_links');
if (empty($sidebar_links)) {
    $sidebar_links = [
        ['label' => 'Candidates', 'anchor' => 'candidates'],
        ['label' => 'Conditions Treated', 'anchor' => 'conditions-treated'],
        ['label' => 'How It Works', 'anchor' => 'how-it-works'],
        ['label' => 'Insurance Coverage', 'anchor' => 'insurance-coverage'],
        ['label' => 'Safety and Side Effects', 'anchor' => 'safety'],
        ['label' => 'Benefits', 'anchor' => 'benefits'],
    ];
}

$contact_heading = get_field('contact_heading') ?: 'Contact Us';

/** Feather-style inline icons — add a case here for new icon choices. */
function pinnacle_pillar_icon(string $icon): string {

    $icons = [

        /* =========================
         * PILL / MEDICATION
         * ========================= */
        'pill' => '
            <svg
                width="72"
                height="72"
                viewBox="0 0 72 72"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
            >
                <!-- Capsule 1 -->
                <g transform="rotate(-45 29 43)">
                    <rect
                        x="12"
                        y="36"
                        width="34"
                        height="14"
                        rx="7"
                        stroke="currentColor"
                        stroke-width="2"
                    />
                    <path
                        d="M29 36V50"
                        stroke="currentColor"
                        stroke-width="2"
                    />
                </g>

                <!-- Capsule 2 -->
                <g transform="rotate(-45 43 28)">
                    <rect
                        x="27"
                        y="21"
                        width="34"
                        height="14"
                        rx="7"
                        stroke="currentColor"
                        stroke-width="2"
                    />
                    <path
                        d="M44 21V35"
                        stroke="currentColor"
                        stroke-width="2"
                    />
                </g>
            </svg>
        ',


        /* =========================
         * BRAIN / TMS
         * ========================= */
        'brain' => '
            <svg
                width="72"
                height="72"
                viewBox="0 0 72 72"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
            >

                <!-- TMS Coil -->
                <circle
                    cx="24"
                    cy="18"
                    r="10"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <circle
                    cx="24"
                    cy="18"
                    r="5"
                    stroke="currentColor"
                    stroke-width="1.7"
                />

                <!-- Coil handle -->
                <path
                    d="M30 25L38 33"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

                <path
                    d="M35 30L42 23"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

                <!-- Head -->
                <path
                    d="
                        M44 20
                        C37 20 32 25 32 32
                        C32 38 35 42 39 45
                        L39 53
                        C39 56 36 59 32 61
                    "
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <!-- Face -->
                <path
                    d="
                        M44 21
                        C50 21 54 25 54 30
                        L59 32
                        L54 35
                        L54 40
                        L49 40
                        C47 43 44 44 40 44
                    "
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <!-- Brain -->
                <path
                    d="
                        M37 29
                        C35 27 36 24 39 24
                        C41 22 44 24 44 26
                        C47 24 50 26 49 29
                        C52 30 51 33 49 34
                        C47 36 44 35 43 33
                        C41 36 38 35 38 32
                    "
                    stroke="currentColor"
                    stroke-width="1.6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <!-- Brain details -->
                <path
                    d="M39 27C41 28 41 30 40 32"
                    stroke="currentColor"
                    stroke-width="1.4"
                    stroke-linecap="round"
                />

                <path
                    d="M44 26C43 29 45 30 47 30"
                    stroke="currentColor"
                    stroke-width="1.4"
                    stroke-linecap="round"
                />

                <path
                    d="M43 33C45 32 47 33 48 34"
                    stroke="currentColor"
                    stroke-width="1.4"
                    stroke-linecap="round"
                />

                <!-- Neck / shoulder -->
                <path
                    d="
                        M39 53
                        C38 57 34 59 29 61
                        M29 61
                        C36 63 45 62 51 58
                    "
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

            </svg>
        ',


        /* =========================
         * CALENDAR
         * ========================= */
        'calendar' => '
            <svg
                width="72"
                height="72"
                viewBox="0 0 72 72"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
            >

                <!-- Calendar -->
                <rect
                    x="10"
                    y="17"
                    width="52"
                    height="45"
                    rx="4"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <!-- Header -->
                <path
                    d="M10 30H62"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <!-- Rings -->
                <rect
                    x="17"
                    y="9"
                    width="6"
                    height="15"
                    rx="3"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <rect
                    x="30"
                    y="9"
                    width="6"
                    height="15"
                    rx="3"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <rect
                    x="43"
                    y="9"
                    width="6"
                    height="15"
                    rx="3"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <rect
                    x="56"
                    y="9"
                    width="6"
                    height="15"
                    rx="3"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <!-- Date squares -->
                <rect x="18" y="36" width="7" height="7" rx="1"
                    stroke="currentColor" stroke-width="1.7"/>

                <rect x="32.5" y="36" width="7" height="7" rx="1"
                    stroke="currentColor" stroke-width="1.7"/>

                <rect x="47" y="36" width="7" height="7" rx="1"
                    stroke="currentColor" stroke-width="1.7"/>

                <rect x="18" y="48" width="7" height="7" rx="1"
                    stroke="currentColor" stroke-width="1.7"/>

                <rect x="32.5" y="48" width="7" height="7" rx="1"
                    stroke="currentColor" stroke-width="1.7"/>

                <rect x="47" y="48" width="7" height="7" rx="1"
                    stroke="currentColor" stroke-width="1.7"/>

            </svg>
        ',


        /* =========================
         * CLOCK
         * ========================= */
        'clock' => '
            <svg
                width="72"
                height="72"
                viewBox="0 0 72 72"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
            >
                <circle
                    cx="36"
                    cy="36"
                    r="25"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <path
                    d="M36 21V36L46 42"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <circle
                    cx="36"
                    cy="36"
                    r="2"
                    fill="currentColor"
                />
            </svg>
        ',


        /* =========================
         * CHECK
         * ========================= */
        'check' => '
            <svg
                width="72"
                height="72"
                viewBox="0 0 72 72"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
            >
                <circle
                    cx="36"
                    cy="36"
                    r="25"
                    stroke="currentColor"
                    stroke-width="2"
                />

                <path
                    d="M23 36L31 44L49 26"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        ',
    ];

    return $icons[$icon] ?? $icons['brain'];
}
?>

<section class="providers-banner" style="background-image:url('<?php echo esc_url($banner_image_url); ?>');">
    <div class="providers-banner__overlay">
        <div class="providers-banner__inner">
            <h1 class="providers-banner__title">NeuroStar Advanced TMS Therapy in Minneapolis</h1>
        </div>
        <div class="nero-logo">
            <img src="<?php echo esc_url($nero_image_url); ?>" alt="NeuroStar Advanced TMS Therapy logo" width="300" height="116">
        </div>
    </div>
</section>

<div class="providers-breadcrumb-container">
    <p class="providers-banner__breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span aria-hidden="true">&raquo;</span>
        <span>NeuroStar Advanced TMS Therapy in Minneapolis</span>
    </p>
</div>

<section class="share-section">
    <h2 class="share-section__title">Share and Enjoy!</h2>
    <div class="share-section__buttons">
        <span class="share-section__label">SHARE</span>
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
    </div>
</section>

<section class="service-detail">
    <div class="service-detail__grid">

        <div class="service-detail__main">
            
                <div class="service-detail__content">
                
                </div>
                <div class="service-detail__content">
                    <p>
                   Are you looking for alternative therapy for major depressive disorder (MDD), obsessive-compulsive disorder (OCD), or major depressive disorder with anxious depression? Prescription medications do not always work, or you have side effects that you do not want to have to live with. You may have been offered electroconvulsive therapy (ECT) but are afraid of the treatment. It is not unreasonable to look for other types of therapy, and NeuroStar Advanced TMS Therapy in Edina may be exactly what you need. Our team of dedicated mental health providers at <a href="<?php echo esc_url(home_url('/'));?>" style="color: #0073aa; text-decoration: none;" target="_blank" rel="noopener noreferrer">Pinnacle Behavioral Healthcare</a> are ready to help you get started by bringing TMS therapy to 55435.
                    </p>
                </div>

            <?php if (!empty($requirements)) : ?>
                <div class="service-detail__requirements">
                    <h2>What You'll Need</h2>
                    <ul>
                        <?php foreach ($requirements as $req) : ?>
                            <li><?php echo esc_html($req['item'] ?? ''); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <aside class="service-detail__sidebar">

            <?php
            // "Home" services nav card — same list on every service page,
            // current page highlighted. Uses the shared Services Page
            // options (services-page > services_list) so it only needs
            // editing in one place.
            $related_services = get_field('services_list', 'option');
            if (!empty($related_services)) :
            ?>
                <div class="service-nav-card">
                    <h3 class="service-nav-card__heading">Home</h3>
                    <ul class="service-nav-card__list">
                        <?php foreach ($related_services as $related) :
                            $is_current = isset($related['title']) && $related['title'] === get_the_title();
                        ?>
                            <li>
                                <a href="<?php echo esc_url($related['link']['url'] ?? '#'); ?>" class="<?php echo $is_current ? 'is-current' : ''; ?>">
                                    <span><?php echo esc_html($related['title'] ?? ''); ?></span>
                                    <svg class="service-nav-card__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                        <polyline points="12 5 19 12 12 19"/>
                                    </svg>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php
            /**
             * Contact form card.
             * TODO: this markup posts to itself for now — wire up real
             * handling before launch (e.g. a plugin like WPForms/Contact
             * Form 7, or a custom admin-post.php action that emails the
             * clinic and redirects back with a success message).
             */
            ?>


        </aside>

    </div>
</section>


<div class="pillar-page">
    <div class="pillar-page__grid">

        <div class="pillar-page__main">

            <div class="pillar-fact-strip">
                <?php foreach ($fact_strip as $i => $fact) :
                    $variant = $i % 2 === 0 ? 'navy' : 'purple';
                ?>
                    <div class="pillar-fact pillar-fact--<?php echo esc_attr($variant); ?>" id="<?php echo esc_attr(sanitize_title($fact['heading'] ?? 'fact-' . $i)); ?>">
                        <span class="pillar-fact__icon"><?php echo pinnacle_pillar_icon($fact['icon'] ?? 'brain'); ?></span>
                        <h2 class="pillar-fact__heading"><?php echo esc_html($fact['heading'] ?? ''); ?></h2>
                        <p class="pillar-fact__description"><?php echo esc_html($fact['description'] ?? ''); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- =========================================================
     NEUROSTAR TMS INFORMATION CONTENT
     ========================================================= -->

<section class="tms-page-content">

    <!-- What Is TMS Therapy -->
    <article class="tms-page-section">

        <div class="tms-page-section__image">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/PinnacleBH2024_1_-00526_1.webp'); ?>"
                alt="TMS therapy treatment room"
                loading="lazy"
            >
        </div>

        <div class="tms-page-section__content">

            <h2>What Is TMS Therapy?</h2>

            <p>
                TMS stands for transcranial magnetic stimulation. It is a
                non-invasive treatment that uses magnetic fields to stimulate
                nerve cells in specific areas of your brain. A metal coil is
                placed against your scalp to generate rapidly alternating
                magnetic fields, gently stimulating areas of the brain with
                diminished activity.
            </p>

            <p>
                Patients in Minneapolis who undergo through TMS therapy
                typically find that with increased brain activity, their
                symptoms of depression and anxiety lessen greatly and may
                even go into remission.
            </p>

            <p>
                TMS therapy has been getting quite a bit of attention for the
                treatment of major depressive disorder (MDD). It works in
                addition to prescription medication, or you can choose to use
                it in place of medication, if pharmaceuticals have not worked
                for you or have given you severe side effects.
            </p>

            <p>
                TMS therapy has also proven to be helpful in treating MDD with
                anxious depression and for people struggling with obsessive-
                compulsive disorder (OCD).
            </p>

        </div>

    </article>


    <!-- What Is NeuroStar Advanced Therapy -->
    <article class="tms-page-section">

        <div class="tms-page-section__image">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/Adolescent_Treatment_-_Side-1-1024x697.jpg'); ?>"
                alt="NeuroStar Advanced TMS Therapy"
                loading="lazy"
            >
        </div>

        <div class="tms-page-section__content">

            <h2>What Is NeuroStar Advanced Therapy?</h2>

            <p>
                NeuroStar Advanced TMS Therapy is a proprietary application
                of transcranial magnetic stimulation. The NeuroStar device
                held against a patient's scalp has patented Contact Sensing
                technology to help ensure that the specific dosage you need
                is always used for your treatment sessions.
            </p>

            <p>
                NeuroStar Advanced TMS Therapy is cleared by the U.S. Food
                and Drug Administration for the treatment of major depressive
                disorder (MDD), obsessive-compulsive disorder (OCD), and
                major depressive disorder with anxious depression.
            </p>

            <p>
                Prior to starting NeuroStar Advanced TMS therapy treatments
                in Minneapolis, your provider can determine whether this
                treatment is appropriate for your individual needs.
            </p>

        </div>

    </article>


    <!-- Candidate -->
    <article class="tms-page-section">

        <div class="tms-page-section__image">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/PinnacleBH2024_1_-00522_1.webp'); ?>"
                alt="Patient receiving TMS therapy"
                loading="lazy"
            >
        </div>

        <div class="tms-page-section__content">

            <h2>Am I A Good Candidate for TMS Therapy?</h2>

            <p>
                While most people are eligible for TMS therapy, those who are
                not include anyone with a seizure disorder; anyone with a
                metal plate or other metal in their skull or brain from
                previous surgeries; or anyone with an implanted electrical
                device like a pacemaker or a cochlear implant.
            </p>

        </div>

    </article>


    <!-- Procedure -->
    <article class="tms-page-section">

        <div class="tms-page-section__image">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/NS_Treatment_Straight_On_Square-1-1024x1024.jpg'); ?>"
                alt="TMS therapy procedure"
                loading="lazy"
            >
        </div>

        <div class="tms-page-section__content">

            <h2>TMS Therapy Procedure Process and Results</h2>

            <p>
                Treatment sessions with NeuroStar Advanced TMS Therapy are
                relatively quick. Since the treatment is non-invasive, you
                are not placed under anesthesia. You remain comfortably seated
                and are awake during a treatment session.
            </p>

            <p>
                You may feel a tapping sensation on your scalp during the
                treatment, but there will be no pain. You may feel some warmth
                in the area stimulated, but this side effect dissipates
                rapidly over the first 12 to 24 hours after a session.
            </p>

            <p>
                Most people tolerate TMS treatments very well. There are no
                restrictions to your activity after a session and you can
                return to your regular activities immediately.
            </p>

            <p>
                A course of TMS therapy typically runs from four to six weeks,
                with sessions five to seven times per week. While you probably
                will not feel a sudden major improvement, you will notice a
                gradual reduction in your symptoms as the affected areas of
                your brain slowly become more active.
            </p>

        </div>

    </article>


    <!-- Closing TMS Section -->
    <article class="tms-page-section">

        <div class="tms-page-section__image">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/PinnacleBH2024_1_-00512_1.webp'); ?>"
                alt="NeuroStar TMS therapy equipment"
                loading="lazy"
            >
        </div>

        <div class="tms-page-section__content">

            <h2>
                Choose NeuroStar Advanced TMS Therapy For Depression
                Treatment in Minneapolis
            </h2>

            <p>
                After you have struggled with prescription medication
                treatments for major depressive disorder (MDD), obsessive-
                compulsive disorder (OCD), or major depressive disorder with
                anxious depression, you deserve the chance to try NeuroStar
                Advanced TMS Therapy in 55435.
            </p>

            <p>
                This treatment can help restore better function to your brain
                cells, which will, in turn, improve your mood and help you to
                better regulate your emotions and behavior.
            </p>

            <p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                    Contact Pinnacle Behavioral Healthcare
                </a>
                today for a consultation and take the first step toward a
                better you.
            </p>

        </div>

    </article>

</section>


<!-- =========================================================
     EXISTING FAQ — LEAVE THIS EXACTLY AS IT IS
     ========================================================= -->

<div class="pillar-faq" id="faq">

            <?php if ($video_url) : ?>
                <div class="pillar-video">
                    <div class="pillar-video__frame">
                        <iframe
                            src="<?php echo esc_url($video_url); ?>"
                            title="<?php echo esc_attr(get_the_title()); ?> video"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"
                        ></iframe>
                    </div>
                </div>
            <?php endif; ?>
            <!-- NeuroStar YouTube Video -->
<div class="pillar-video tms-youtube-video">
    <div class="tms-youtube-video__wrapper">
        <iframe
            src="https://www.youtube.com/embed/DDJWUzqAzHE"
            title="How does NeuroStar work for people with depression?"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
        </iframe>
    </div>
</div>

            <div class="pillar-faq" id="faq">
                <h2 class="pillar-faq__heading"><?php echo esc_html($faq_heading); ?></h2>
                <?php if ($faq_intro) : ?>
                    <p class="pillar-faq__intro"><?php echo esc_html($faq_intro); ?></p>
                <?php endif; ?>

                <div class="pillar-faq__list">
                    <?php foreach ($faqs as $faq) : ?>
                        <div class="pillar-faq__item">
                            <button type="button" class="pillar-faq__question">
                                <span><?php echo esc_html($faq['question'] ?? ''); ?></span>
                                <span class="pillar-faq__toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="pillar-faq__answer">
                                <p><?php echo esc_html($faq['answer'] ?? ''); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

        

    </div>
    <aside class="pillar-sidebar">

    <!-- TMS Treatments -->
    <div class="pillar-sidebar__inner">

        <h2 class="pillar-sidebar__title">
            TMS Treatments
        </h2>

        <ul class="pillar-sidebar__list">

            <?php foreach ($sidebar_links as $link) : ?>

                <li>
                    <a href="#<?php echo esc_attr($link['anchor'] ?? ''); ?>">

                        <?php echo esc_html($link['label'] ?? ''); ?>

                        <svg
                            width="14"
                            height="14"
                            viewBox="0 0 16 16"
                            fill="none"
                            aria-hidden="true"
                        >
                            <path
                                d="M2 8H14M14 8L9 3M14 8L9 13"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </a>
                </li>

            <?php endforeach; ?>

        </ul>

    </div>


    <!-- Contact Us -->
    <div class="pillar-contact" id="contact-form">

        <h2 class="pillar-contact__heading">
            <?php echo esc_html($contact_heading); ?>
        </h2>

        <form class="pillar-contact__form" method="post">

            <div class="pillar-contact__row">

                <label class="pillar-contact__field">
                    <span class="sr-only">First Name</span>

                    <input
                        type="text"
                        name="first_name"
                        placeholder="First Name*"
                        required
                        class="pillar-contact__input"
                    >
                </label>


                <label class="pillar-contact__field">
                    <span class="sr-only">Last Name</span>

                    <input
                        type="text"
                        name="last_name"
                        placeholder="Last Name*"
                        required
                        class="pillar-contact__input"
                    >
                </label>

            </div>


            <div class="pillar-contact__row">

                <label class="pillar-contact__field">
                    <span class="sr-only">Phone Number</span>

                    <input
                        type="tel"
                        name="phone"
                        placeholder="Phone Number*"
                        required
                        class="pillar-contact__input"
                    >
                </label>


                <label class="pillar-contact__field">
                    <span class="sr-only">Email Address</span>

                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address*"
                        required
                        class="pillar-contact__input"
                    >
                </label>

            </div>


            <label class="pillar-contact__field">

                <span class="sr-only">Message</span>

                <textarea
                    name="message"
                    placeholder="Message*"
                    rows="4"
                    required
                    class="pillar-contact__input pillar-contact__textarea"
                ></textarea>

            </label>


            <button
                type="submit"
                class="pillar-contact__submit"
            >

                SEND MESSAGE

                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    aria-hidden="true"
                >
                    <path
                        d="M2 8H14M14 8L9 3M14 8L9 13"
                        stroke="currentColor"
                        stroke-width="1.6"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

            </button>

        </form>

    </div>

</aside>
</div>

<?php get_footer(); ?>