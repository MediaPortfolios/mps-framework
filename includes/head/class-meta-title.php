<?php
/**
 * Title meta tag.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

class Media_Portfolios_Framework_Meta_Title {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

		add_action( 'controlled_chaos_meta_title', [ $this, 'title' ] );

	}

	/**
	 * Title meta tag.
	 * 
	 * @since  1.0.0
	 */
	public function title() {

		if ( is_front_page() ) {
			$title = bloginfo( 'name' );
		} else {
			$title = the_title();
		}

		echo $title;

	}

}

// Run the Media_Portfolios_Framework_Meta_Title class.
$controlled_chaos_meta_title = new Media_Portfolios_Framework_Meta_Title;