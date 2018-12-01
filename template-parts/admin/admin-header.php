<?php
/**
 * Admin header template.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace TIMS_Clean;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Admin header variables.
 *
 * @since 1.0.0
 */

// Get the site title.
$title       = get_bloginfo( 'name' );

// Get the site tagline.
$description = get_bloginfo( 'description' );

// Return null if no site title.
if ( ! empty( $title ) ) {
    $title = get_bloginfo( 'name' );
} else {
    $title =  null;
}

// Return a reminder if no site tagline.
if ( ! empty( $description ) ) {
    $description = get_bloginfo( 'description' );
} else {
    $description = null;
}

// Get the admin menu registered in `class-admin-pages.php`.
$menu = 'admin-header';

// Apply filters to the variables.
$title       = apply_filters( 'mpsf_admin_header_title', $title );
$description = apply_filters( 'mpsf_admin_header_description', $description );
$menu        = apply_filters( 'mpsf_admin_header_menu', $menu );
?>
<?php do_action( 'mpsf_before_admin_header' ); ?>
<header class="mpsf-admin-header">
    <?php do_action( 'mpsf_before_admin_site_branding' ); ?>
    <div class="admin-site-branding">
        <p class="admin-site-title" itemprop="name"><a href="<?php echo admin_url(); ?>"><?php echo $title; ?></a></p>
        <p class="admin-site-description"><?php echo $description; ?></p>
    </div>
    <?php do_action( 'mpsf_after_admin_site_branding' ); ?>
    <?php do_action( 'mpsf_before_admin_navigation' ); ?>
    <nav class="admin-navigation">
        <?php wp_nav_menu(
            array(
                'theme_location'  => $menu,
                'container'       => false,
                'menu_id'         => 'admin-navigation-list',
                'menu_class'      => 'admin-navigation-list',
                'before'          => '',
                'after'           => '',
                'fallback_cb'     => ''
            )
        ); ?>
    </nav>
    <?php do_action( 'mpsf_after_admin_navigation' ); ?>
</header>
<?php do_action( 'mpsf_after_admin_header' ); ?>