<?php
/**
 * Template filters.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template filters.
 */
class Template_Filters {

	/**
	 * Constructor magic method.
	 */
	public function __construct() {

        // Image names in the media picker.
        add_filter( 'image_size_names_choose', [ $this, 'image_size_choose' ] );

        // Dark mode body class.
        add_filter( 'body_class', [ $this, 'dark_mode' ] );
        add_filter( 'admin_body_class', [ $this, 'dark_mode' ] );

    }

    /**
     * Image sizes to insert into posts.
     */
    public function image_size_choose( $size_names ) {

        global $_wp_additional_image_sizes;

		$sizes = [
            'thumbnail'     => esc_html__( 'Thumbnail', 'mpsf' ),
            'thumb-large'   => esc_html__( 'Large Thumb', 'mpsf' ),
            'thumb-x-large' => esc_html__( 'XL Thumb', 'mpsf' ),
			'medium'        => esc_html__( 'Medium', 'mpsf' ),
            'large'         => esc_html__( 'Large', 'mpsf' ),
            'video-small'   => esc_html__( 'Video Small', 'mpsf' ),
            'video-medium'  => esc_html__( 'Video Medium', 'mpsf' ),
            'video-large'   => esc_html__( 'Video Large', 'mpsf' ),
            'intro-small'   => esc_html__( 'Intro Small', 'mpsf' ),
            'intro-medium'  => esc_html__( 'Intro Medium', 'mpsf' ),
            'intro-large'   => esc_html__( 'Intro Large', 'mpsf' ),
            'slide-small'   => esc_html__( 'Slide Small', 'mpsf' ),
            'slide-medium'  => esc_html__( 'Slide Medium', 'mpsf' ),
            'slide-large'   => esc_html__( 'Slide Large', 'mpsf' )
		];

		$insert_sizes = apply_filters( 'mpsf_insert_image_sizes', $sizes );
		return $insert_sizes;

    }

    /**
     * Add a body class if in dark mode.
     *
     * @param  array $classes
     * @return array
     */
    public function dark_mode( $classes ) {

        if ( class_exists( 'acf_pro' ) && is_plugin_active( 'mpsf-plugin/mpsf-plugin.php' ) ) {

            $dark_mode = get_field( 'mpsf_dark_mode', 'option' );

            if ( ! is_admin() && $dark_mode ) {

                $classes[] = 'dark-mode';
                return $classes;

            } elseif ( is_admin() && $dark_mode ) {
                // $classes = 'dark-mode';
                return $classes;
            }

            return $classes;

        } else {
            return $classes;
        }

    }

}

new Template_Filters;