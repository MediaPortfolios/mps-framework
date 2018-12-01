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

/**
 * Conditional title tag.
 */
$title      = sprintf( '<h1 class="site-title" itemprop="name">%1$s</h1>', get_bloginfo( 'name' ) );
$site_title = apply_filters( 'mpsf_site_title', $title );

/**
 * Site descrition, if any.
 */
$description = get_bloginfo( 'description' );
if ( ! empty( $description ) ) {
    $description = sprintf( '<p class="site-description" itemprop="description">%1s</p>', esc_html__( get_bloginfo( 'description' ) ) );
} else {
    $description = null;
}
$site_description = apply_filters( 'mpsf_site_description', $description );

/**
 * Output header content.
 */
do_action( 'mpsf_before_header_content' ); ?>
<header class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
    <div class="header-content">
        <div class="site-title-description">
            <?php echo $site_title; ?>
            <?php echo $site_description; ?>
        </div>
    </div><!-- header-content -->
</header>
<?php do_action( 'mpsf_after_header_content' ); ?>