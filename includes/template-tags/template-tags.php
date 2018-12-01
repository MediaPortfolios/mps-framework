<?php
/**
 * Template tag functions
 * 
 * Convert static class methods to more traditional tags.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since 1.0.0
 */
namespace MPS_Framework;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Page template function
 * 
 * This is used to conditionally get ass standard templates.
 * 
 * @since 1.0.0
 * @return void
 */
if ( ! function_exists( 'mpsf_template' ) ) :

	function mpsf_template() {

		$mpsf_template = require get_theme_file_path( '/template-parts/content/content.php' );

		return $mpsf_template;

	}

endif;