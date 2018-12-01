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
$title      = sprintf( '<h1 class="site-title" itemprop="name">%1$s</h1>', esc_html( get_bloginfo( 'name' ) ) );
$site_title = apply_filters( 'mpsf_site_title', $title );

/**
 * Site descrition, if any.
 */
$description = get_bloginfo( 'description' );
if ( ! empty( $description ) ) {
    $description = sprintf( '<p class="site-description" itemprop="description">%1s</p>', esc_html__( get_bloginfo( 'description' ) ) );
} else {
    $description = sprintf( '<p class="site-description" itemprop="description">%1s</p>', __( 'Director of Photography', 'mpsf' ) );
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
        <a class="intro-enter" href="#content"><svg x="0px" y="0px" viewBox="0 0 44.2975 59.999" id="arrow" width="100%" height="100%"><path d="m 18.1495,4 0,42.342 -11.321,-11.321 c -1.562,-1.562 -4.095,-1.562 -5.657,0 -1.562,1.562 -1.562,4.095 0,5.657 l 18.149,18.149 c 0,0 0,0 0,0 0.186,0.186 0.392,0.352 0.611,0.499 0.089,0.06 0.187,0.1 0.279,0.152 0.135,0.075 0.266,0.156 0.41,0.216 0.117,0.048 0.238,0.074 0.358,0.111 0.129,0.04 0.255,0.089 0.39,0.116 0.204,0.04 0.411,0.054 0.618,0.062 0.055,0.002 0.106,0.016 0.162,0.016 0.062,0 0.12,-0.016 0.181,-0.018 0.2,-0.009 0.4,-0.021 0.598,-0.061 0.143,-0.028 0.275,-0.079 0.412,-0.122 0.112,-0.035 0.226,-0.059 0.335,-0.104 0.155,-0.064 0.299,-0.15 0.443,-0.233 0.081,-0.046 0.167,-0.081 0.246,-0.133 0.223,-0.148 0.43,-0.317 0.618,-0.506 l 18.144,-18.144 c 0.781,-0.781 1.172,-1.805 1.172,-2.829 0,-1.024 -0.391,-2.047 -1.172,-2.829 -1.562,-1.562 -4.095,-1.562 -5.656,0 l -11.32,11.321 0,-42.341 c 0,-2.209 -1.791,-4 -4,-4 -2.209,0 -4,1.791 -4,4 z" /></svg><span class="screen-reader-text"><?php esc_html_e( 'Skip to Content', 'mpsf' ) ?></span></a>
    </div><!-- header-content -->
</header>
<?php do_action( 'mpsf_after_header_content' ); ?>