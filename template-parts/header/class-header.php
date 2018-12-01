<?php
/**
 * Header HTML template.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Header HTML template.
 */
class Header {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {

        add_action( 'mpsf_header', [ $this, 'partials' ] );

    }

    /**
	 * Header partials.
     *
     * @since  1.0.0
	 */
    public function partials() {

        if ( is_front_page() && is_page_template( 'page-templates/page-showcase.php' ) ) {

            echo '<div class="intro-content showcase">';
            echo '<div class="intro-content-wrap">';

            // Site branding and before/after header content actions.
            get_template_part( 'template-parts/header/partials/front-showcase' );

            echo '</div>';
            echo '</div>';

		} elseif ( is_front_page() ) {

            echo '<div class="intro-content default">';
            echo '<div class="intro-content-wrap">';

            // Site branding and before/after header content actions.
            get_template_part( 'template-parts/header/partials/front-default' );

            // Main navigation menu.
            get_template_part( 'template-parts/navigation/partials/navigation', 'main' );

            echo '</div>';
            echo '</div>';

		} else {

			echo '<div class="global-wrapper header-wrap">';

            // Site branding and before/after header content actions.
            get_template_part( 'template-parts/header/partials/site-branding' );

            // Main navigation menu.
            get_template_part( 'template-parts/navigation/partials/navigation', 'main' );

            echo '</div>';

		}

    }

}

// Run the Header class.
new Header;