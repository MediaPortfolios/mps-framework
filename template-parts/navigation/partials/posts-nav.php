<?php
/**
 * Blog pages standard navigation.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( is_search() ) {
    $prev = __( 'Previous Results', 'mpsf' );
    $next = __( 'More Results', 'mpsf' );
} else {
    $prev = __( 'Previous Page', 'mpsf' );
    $next = __( 'Next Page', 'mpsf' );
}

$prev_posts = apply_filters( 'mpsf_prev_posts_label', sprintf( '<span>%1s</span>', $prev ) );
$next_posts = apply_filters( 'mpsf_next_posts_label', sprintf( '<span>%1s</span>', $next ) );
?>
<nav class="posts-nav global-wrapper">
	<span class="prev-page" rel="prev"><?php previous_posts_link( $prev_posts ); ?></span>
	<span class="next-page" rel="next"><?php next_posts_link( $next_posts ); ?></span>
</nav>