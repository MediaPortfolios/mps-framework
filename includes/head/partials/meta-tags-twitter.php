<?php
/**
 * Twitter card meta tags.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!-- Twitter Card meta data -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:domain" content="<?php echo esc_url( home_url() ); ?>">
<meta name="twitter:site" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
<meta name="twitter:title" content="<?php do_action( 'controlled_chaos_meta_title' ); ?>" />
<meta name="twitter:description" content="<?php do_action( 'controlled_chaos_meta_description' ); ?>" />
<meta name="twitter:url" content="<?php echo get_the_permalink(); ?>" />
<meta name="twitter:image:src" content="<?php do_action( 'controlled_chaos_meta_image' ); ?>" />
