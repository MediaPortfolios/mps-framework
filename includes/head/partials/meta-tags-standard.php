<?php
/**
 * Standard meta tags.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

global $post; ?>

<meta name="title" content="<?php do_action( 'controlled_chaos_meta_title' ); ?>" />
<meta name="description" content="<?php do_action( 'controlled_chaos_meta_description' ); ?>" />
<meta name="author" content="<?php do_action( 'controlled_chaos_meta_author' ); ?>" />
