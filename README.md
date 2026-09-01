# Pinnacle Theme

A custom WordPress theme built for Pinnacle Behavioral Healthcare, featuring a modern, responsive design with support for behavioral health services, telehealth, provider management, and patient intake systems.

## Theme Overview

**Theme Name:** Pinnacle Theme  
**Author:** Right  
**Version:** 1.0  
**Description:** Custom WordPress theme for Pinnacle Behavioral Healthcare

This theme is designed to showcase behavioral health services, manage provider information, handle patient intake, schedule appointments, and provide comprehensive patient resources.

## Key Features

- **Responsive Design** - Fully responsive layout optimized for all devices
- **Service Showcase** - Display behavioral health services including therapy, psychiatric medication management, and NeuroStar TMS
- **Provider Directory** - Dedicated provider pages and booking functionality
- **Patient Intake System** - Multi-step intake forms for new patients
- **Appointment Scheduling** - Integration with appointment booking systems
- **Insurance Management** - Insurance verification and acceptance pages
- **Telehealth Support** - Telehealth consultation modals and pages
- **Blog & Testimonials** - Blog post management and patient testimonials
- **Search Functionality** - Full-site search capabilities
- **Contact Management** - Contact forms with map integration
- **Custom Post Types** - Blog posts, providers, services, and Spravato treatments

## File Structure

### Root Template Files
- **index.php** - Main homepage template
- **header.php** - Site header with navigation
- **footer.php** - Site footer
- **functions.php** - Theme setup, enqueuing scripts/styles, and custom functionality
- **style.css** - Main stylesheet with CSS variables and design system

### Page Templates
- **page-new-patients.php** - New patient landing page
- **page-existing-patients.php** - Existing patient resources
- **page-adhd-testing.php** - ADHD testing information
- **page-faq.php** - Frequently asked questions
- **page-insurance-accepted.php** - Insurance information
- **page-make-payment.php** - Patient payment page
- **page-edina.php** - Edina location page
- **page-pbh-contact.php** - Contact page
- **page-pbh-insurance.php** - Insurance verification page
- **page-service-detail.php** - Service detail template
- **page-brain-health-series.php** - Brain health series information
- **page-testimonials.php** - Testimonials gallery

### Specialized Pages
- **new-patients-page.php** - New patient intake entry point
- **contact.php** - Contact page template
- **blog.php** - Blog listing template
- **services.php** - Services overview page
- **providers.php** - Provider directory
- **search.php** - Search results page
- **cart.php** - WooCommerce cart (if applicable)
- **individual-psychotherapy-in-minneapolis.php** - Service-specific page
- **neurostar-advanced-tms-therapy-in-minneapolis.php** - NeuroStar service page
- **telehealth-psychiatric-medication-management-in-minneapolis.php** - Telehealth service page
- **spravato.php** - Spravato treatment information

### Custom Post Type Templates
- **single-blog_post.php** - Individual blog post template
- **single-provider.php** - Individual provider profile
- **single-spravato.php** - Individual Spravato treatment post

### Template Parts (`template-parts/`)

#### Home Section (`home/`)
- **hero.php** - Hero banner section
- **staff-announcement.php** - Staff announcements
- **feature-banner.php** - Feature highlight banner
- **why-choose-us.php** - Why choose Pinnacle section
- **feature-icons.php** - Feature icons grid
- **services.php** - Services preview
- **testimonials.php** - Testimonials section
- **neurostar-feature.php** - NeuroStar feature section
- **brain-series.php** - Brain health series section
- **service-highlights-carousel.php** - Service carousel
- **specialists.php** - Specialists showcase
- **supplement-brands-banner.php** - Supplement brands banner
- **news.php** - News/blog preview
- **about.php** - About section
- **appointment-form.php** - Appointment booking form

#### Contact Section (`contact/`)
- **contact.php** - Main contact section
- **contact-form.php** - Contact form component
- **contact-map.php** - Location map

#### Providers Section (`providers/`)
- **providers-banner.php** - Providers banner
- **providers-grid.php** - Provider grid display
- **booking-form.php** - Provider booking form

#### Services Section (`services/`)
- **services-banner.php** - Services section banner
- **services-list.php** - Services list display
- **services-supplement-banner.php** - Supplement banner

#### Other
- **quick-stats.php** - Quick statistics display

### Assets

#### Stylesheets (`assets/css/`)
- **new-patients.css** - New patient page styles
- **pbh-contact-page.css** - Contact page styles
- **pbh-insurance-verification.css** - Insurance verification page styles

#### JavaScript (`assets/js/`)
- **main.js** - Main JavaScript file
- **nav-dropdown.js** - Navigation dropdown functionality
- **mobile-nav.js** - Mobile navigation
- **homepage.js** - Homepage-specific scripts
- **new-patients.js** - New patient page scripts
- **new-patients-intake.js** - New patient intake form handling
- **appointment-form.js** - Appointment form functionality
- **contact-form.js** - Contact form handling
- **intake-selector.js** - Intake selector functionality
- **intake.js** - Intake form processing
- **provider-booking.js** - Provider booking system
- **service-highlights-carousel.js** - Carousel functionality
- **testimonials.js** - Testimonials slider
- **why-choose-carousel.js** - Why choose section carousel
- **telehealth-consult-modal.js** - Telehealth modal handling
- **faq-accordion.js** - FAQ accordion functionality
- **search.js** - Search functionality
- **edina.js** - Edina location page scripts
- **pbh-contact-page.js** - Contact page scripts
- **pbh-insurance-verification.js** - Insurance verification scripts

#### Images (`assets/images/`)
- Theme images and graphics

## Design System

### Color Palette
- **Primary Blue:** `#1583C7`
- **Primary Dark Blue:** `#0E5F94`
- **Primary Light Blue:** `#4FA8DE`
- **Surface Blue:** `#EAF5FC`
- **Ink (Text):** `#1F2937`
- **Ink Soft (Secondary Text):** `#5B6472`
- **Color One:** `#28a9e1`
- **Color Two:** `#084575`

### Typography
- **Headings:** Poppins font family
- **Body Text:** Inter font family
- **Font Size:** Responsive with proper hierarchy

### Effects
- **Card Shadow:** `0 10px 30px -12px rgba(15, 60, 90, 0.18)`

## Theme Setup & Functions

The theme includes comprehensive setup in `functions.php`:

- **Theme Support:** Adds support for title tags, post thumbnails, custom logos, HTML5 elements
- **Navigation Menus:** Registers primary menu for site navigation
- **Asset Enqueuing:** Loads all stylesheets and scripts with proper dependencies
- **Custom Post Types:** Support for blog posts, providers, services, and Spravato treatments
- **Advanced Custom Fields (ACF):** Integration for flexible content management
- **WooCommerce Support:** E-commerce functionality for services/products
- **Form Routing:** Intelligent form handling and submission routing

## Installation & Setup

1. **Place Theme Files**
   ```bash
   cp -r pinnacle-theme /path/to/wordpress/wp-content/themes/
   ```

2. **Activate Theme**
   - Log into WordPress Admin
   - Navigate to Appearance > Themes
   - Activate "Pinnacle Theme"

3. **Install Required Plugins**
   - Advanced Custom Fields (ACF) Pro - for flexible field groups
   - WooCommerce (if using e-commerce features)
   - Any contact form plugins (Gravity Forms, WPForms, etc.)

4. **Configure Theme Options**
   - Set up menu locations
   - Configure ACF field groups
   - Set featured images for posts and pages

## Development

### JavaScript Dependencies
- Vanilla JavaScript (no framework dependencies required)
- jQuery (if needed, loaded by WordPress core)

### CSS Architecture
- CSS Variables for theming
- Responsive design with mobile-first approach
- Smooth scrolling enabled site-wide

### Code Standards
- PHP 7.2+ compatible
- WordPress coding standards followed
- Proper escaping and sanitization for security

## Key Pages & Their Functions

| Page | Purpose |
|------|---------|
| Homepage | Main landing page with all home template parts |
| New Patients | Intake system for new patient onboarding |
| Existing Patients | Resources and information for current patients |
| Providers | Directory and profiles of behavioral health professionals |
| Services | Comprehensive service listings |
| Blog | Mental health articles and educational content |
| Contact | Contact forms and location information |
| Insurance | Insurance verification and acceptance information |
| FAQ | Frequently asked questions |
| Telehealth | Virtual consultation scheduling |

## Custom Forms

The theme includes several custom form implementations:
- **New Patient Intake Forms** - Multi-step intake process
- **Appointment Booking** - Schedule appointments with providers
- **Contact Forms** - General inquiries and requests
- **Insurance Verification** - Patient insurance lookup
- **Service Selection** - Service intake routing

## Performance Considerations

- CSS and JS files are enqueued with proper versioning
- Responsive images for better loading performance
- Modular template part structure for easier caching
- Minimized HTTP requests through consolidated assets

## Security

- Proper use of WordPress nonces for form security
- Data sanitization and escaping
- Role-based access control integration
- Protection against common WordPress vulnerabilities

## Support & Customization

For theme customization:
1. Create a child theme to preserve updates
2. Use hooks and filters provided by parent theme
3. Extend functionality via `functions.php` in child theme
4. Modify template parts as needed

## Version History

- **v1.0** - Initial release with full Pinnacle Behavioral Healthcare feature set

---

**Last Updated:** September 2026
