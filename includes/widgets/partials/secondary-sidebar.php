<?php
/**
 * Secondary sidebar.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

register_sidebar( array(
    'name'          => __( 'Secondary Sidebar', 'mpsf' ),
    'id'            => 'secondary-sidebar',
    'description'   => __( 'Sidebar that displays on the Two Sidebars template', 'mpsf' ),
    'before_widget' => '<div id="%1$s" class="widget secondary-sidebar-widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
) );