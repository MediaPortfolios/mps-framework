<?php
/**
 * Content HTML template.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Content HTML template.
 */
class Content {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {

        $this->partials();

    }

    /**
	 * Content partials.
     *
     * @since  1.0.0
	 */
    public function partials() {

        $contact_page = get_page_by_path( 'contact' );
		$contact_id   = $contact_page->ID;

        if ( is_front_page() && is_home() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'home' );
        } elseif ( is_front_page() && class_exists( 'ACF_Pro' ) && is_page_template( 'page-templates/page-showcase.php' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'showcase' );
        } elseif ( is_front_page() && class_exists( 'ACF_Pro' ) ) {
            $partial = null;
        } elseif ( is_home() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'home' );
        } elseif ( is_post_type_archive( 'films' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content-archive', 'films' );
        } elseif ( is_post_type_archive( 'television' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content-archive', 'television' );
        } elseif ( is_archive() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'archive' );
        } elseif ( is_search() ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'search' );
        } elseif ( is_singular( 'films' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content-single', 'films' );
        } elseif ( is_singular( 'television' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content-single', 'television' );
        } elseif ( is_page() && class_exists( 'ACF_Pro' ) && is_page_template( 'page-templates/page-showcase.php' ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'showcase' );
        } elseif ( class_exists( 'ACF_Pro' ) && ( is_page_template( 'page-templates/page-contact.php' ) || is_page( $contact_page->ID ) ) ) {
            $partial = get_template_part( 'template-parts/content/partials/content', 'page-contact' );
        } else {
            $partial = get_template_part( 'template-parts/content/partials/content', 'singular' );
        }

        $content = apply_filters( 'mpsf_content_part', $partial );

        echo $content;

    }

}

new Content;