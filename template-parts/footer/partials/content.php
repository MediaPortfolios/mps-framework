<?php
/**
 * Footer HTML and content output.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

do_action( 'mpsf_before_footer_content' );

    echo '<div class="footer-content global-wrapper footer-wrapper">', "\r";

        $copyright_text = sprintf(
            '<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s</span></p>',
            esc_html__( 'Copyright ', 'mpsf' ),
            get_the_time( 'Y' ),
            get_bloginfo( 'name' ) . esc_html__( '. All rights reserved.', 'mpsf' )
        );

        $copyright = apply_filters( 'mpsf_copyright_text', $copyright_text );
        echo $copyright, "\r";

    echo '</div><!-- footer-content -->', "\r";

do_action( 'mpsf_after_footer_content' );