<?php
/**
 * Front page with showcase.
 *
 * Template Name: Project Showcase
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since 1.0.0
 */
namespace MPS_Framework;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

class Showcase {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

		// Begin HTML and get <head> section.
		get_header();

		// Content templates.
		require get_theme_file_path( '/template-parts/content/content.php' );

		// Load scripts and close HTML.
		get_footer();

	}

}

// Run the Showcase class.
new Showcase;