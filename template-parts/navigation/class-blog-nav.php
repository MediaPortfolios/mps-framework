<?php
/**
 * Blog pages navigation.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Blog pages navigation.
 */
class Blog_Nav {

    /**
	 * Constructor magic method.
	 */
	public function __construct() {

		add_action( 'mpsf_before_footer', [ $this, 'nav' ], 20 );

	}

	/**
	 * Get navigation style.
	 */
	public function nav() {

		if ( ! is_front_page() ) {
			get_template_part( 'template-parts/navigation/partials/posts-nav' );
		}

	}

}

new Blog_Nav;