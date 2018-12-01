<?php
/**
 * Site branding.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

echo '</footer>', "\r";

do_action( 'mpsf_after_footer' );