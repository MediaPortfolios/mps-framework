<?php
/**
 * Media Portfolios Framework functions.
 *
 * @package    WordPress
 * @subpackage Media_Portfolios_Framework
 * @author     Greg Sweet <greg@ccdzine.com>
 * @copyright  Copyright (c) 2017 - 2018, Greg Sweet
 * @link       https://github.com/ControlledChaos/mpsf-theme
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 * @since      Controlled Chaos 1.0.0
 */

namespace MPS_Framework;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Controlled Chaos functions class.
 *
 * @since  1.0.0
 * @access public
 */
final class Functions {

	/**
	 * Return the instance of the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {

			$instance = new self;

			// Theme dependencies.
			$instance->dependencies();

		}

		return $instance;
	}

	/**
	 * Constructor magic method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Swap html 'no-js' class with 'js'.
		add_action( 'wp_head', [ $this, 'js_detect' ], 0 );

		// Page loader.
        add_action( 'mpsf_loader', [ $this, 'loader' ], 1 );

		// Controlled Chaos theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Remove unpopular meta tags.
		add_action( 'init', [ $this, 'head_cleanup' ] );

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Footer scripts.
		add_action( 'wp_footer', [ $this, 'footer_scripts' ], 20 );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );

		// Admin styles.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ] );

		// Login styles.
		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );

		// Login heading URL.
		add_filter( 'login_headerurl', [ $this, 'login_url' ] );

		// Login heading.
		add_filter( 'login_headertitle', [ $this, 'login_heading' ] );

		// Remove the user admin color scheme picker.
		remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

		// jQuery UI fallback for HTML5 Contact Form 7 form fields.
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

	}

	/**
	 * Replace 'no-js' class with 'js' in the <html> element when JavaScript is detected.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function js_detect() {

		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

	}

	/**
	 * Page loader.
     *
     * @since  1.0.0
	 */
    public function loader() {

        if ( is_front_page() && is_home() ) {
            $loading = get_bloginfo( 'name' );
        } elseif ( is_front_page() ) {
            $loading = get_bloginfo( 'name' );
        } elseif ( is_home() ) {
            $loading = get_bloginfo( 'name' );
        } elseif ( is_post_type_archive( 'films' ) ) {
            $loading = __( 'Loading Films', 'mpsf' );
        } elseif ( is_post_type_archive( 'television' ) ) {
            $loading = __( 'Loading TV Shows', 'mpsf' );
        } elseif ( is_archive() ) {
            $loading = __( 'Loading Archives', 'mpsf' );
        } elseif ( is_search() ) {
            $loading = __( 'Loading Search Results', 'mpsf' );
        } elseif ( is_singular( 'films' ) ) {
            $loading = __( 'Loading Film', 'mpsf' );
        } elseif ( is_singular( 'television' ) ) {
            $loading = __( 'Loading TV Shows', 'mpsf' );
        } else {
            $loading = __( 'Loading', 'mpsf' );
        }

        echo sprintf(
            '<div class="loader"><div class="spinner"></div><div class="loading">%1s</div></div>',
            $loading
		);

    }

	/**
	 * Theme setup.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {

		/**
		 * Load domain for translation.
		 *
		 * @since 1.0.0
		 */
		load_theme_textdomain( 'mpsf' );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// HTML 5 tags support.
		add_theme_support( 'html5', [
			'search-form',
			'gscreenery',
			'caption'
		 ] );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add image sizes.
		 *
		 * Three sizes per aspect ratio so that WordPress
		 * will use srcset for responsive images.
		 *
		 * @since 1.0.0
		 */

		// Set default sizes in options tabe.
		update_option( 'thumbnail_size_w', 160 );
		update_option( 'thumbnail_size_h', 160 );
		update_option( 'medium_size_w', 320 );
		update_option( 'medium_size_h', 240 );
		update_option( 'large_size_w', 1024 );
		update_option( 'large_size_h', 768 );

		// 1:1 Square.
		add_image_size( 'thumb-large', 240, 240, true );
		add_image_size( 'thumb-x-large', 320, 320, true );

		// 1:1 Square intro images.
		add_image_size( 'intro-small', 480, 480, true );
		add_image_size( 'intro-medium', 640, 640, true );
		add_image_size( 'intro-large', 768, 768, true );

		// 4:3 Standard monitor background slides.
		add_image_size( 'slide-small', 640, 480, true );
		add_image_size( 'slide-medium', 1024, 768, true );
		add_image_size( 'slide-large', 2048, 1536, true );

		// 16:9 HD Video.
		add_image_size( 'video-small', 640, 360, true );
		add_image_size( 'video-medium', 960, 540, true );
		add_image_size( 'video-large', 1280, 720, true );

		// Add image size for meta tags if companion plugin is not activated.
		if ( ! is_plugin_active( 'mpsf-plugin/mpsf-plugin.php' ) ) {
			add_image_size( __( 'meta-image', 'mpsf' ), 1200, 630, true );
		}

		 /**
		 * Set content width.
		 *
		 * @since 1.0.0
		 */

		if ( ! isset( $content_width ) ) {
			$content_width = 1280;
		}

		/**
		 * Register theme menus.
		 *
		 * @since  1.0.0
		 */
		register_nav_menus( [
			'main'  => __( 'Main Menu', 'mpsf' ),
			'admin' => __( 'Admin Header Menu', 'mpsf' )
		] );

		/**
		 * Add stylesheet for the content editor.
		 *
		 * @since 1.0.0
		 */
		add_editor_style( '/assets/css/editor-style.css', [ 'mpsf-admin-theme' ], '', 'screen' );

	}

	/**
	 * Clean up meta tags from the <head>.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function head_cleanup() {

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_site_icon', 99 );
	}

	/**
	 * Frontend scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {

		wp_enqueue_script( 'jquery' );

		// HTML 5 support.
		wp_enqueue_script( 'mpsf-html5',  get_theme_file_uri( '/assets/js/html5.min.js' ), [], '' );
		wp_script_add_data( 'mpsf-html5', 'conditional', 'lt IE 9' );

	}

	/**
	 * Admin scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {}

	/**
	 * Frontend styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {

		// Theme sylesheet.
		wp_enqueue_style( 'mpsf-style', get_theme_file_uri( 'style.css' ), [], '', 'screen' );

		$google = checkdnsrr( 'google.com' );

		if ( $google ) {
			wp_enqueue_style( 'mpsf-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', [], null, 'screen' );
		}

		wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/zry0ihc.css', [], null, 'screen' );

	}

	/**
	 * Admin styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_styles() {

		/**
		 * Check if we and/or Google are online. If so, get Google fonts
		 * from their servers. Otherwise, get them from the theme directory.
		 */
		$google = checkdnsrr( 'google.com' );

		if ( $google ) {
			wp_enqueue_style( 'mpsf-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', [], null, 'screen' );
		}

		wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/zry0ihc.css', [], null, 'screen' );

		// Admin styles.
		wp_enqueue_style( 'mpsf-admin-theme',  get_theme_file_uri( '/assets/css/admin.css' ), [], '', 'screen' );

	}

	/**
	 * Login styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function login_styles() {

		/**
		 * Check if we and/or Google are online. If so, get Google fonts
		 * from their servers. Otherwise, get them from the theme directory.
		 */
		$google = checkdnsrr( 'google.com' );

		if ( $google ) {
			wp_enqueue_style( 'mpsf-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', [], null, 'screen' );
		}

		wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/zry0ihc.css', [], null, 'screen' );

		wp_enqueue_style( 'mpsf-theme-login', get_theme_file_uri( '/assets/css/login.css' ), [], '', 'screen' );

	}

	/**
	 * Login heading URL.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return string Returns the URL of the site.
	 */
	public function login_url() {

		return site_url();

	}

	/**
	 * Login heading.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return string Returns the name of the site.
	 */
	public function login_heading() {

		return get_bloginfo( 'name' );;

	}

	/**
	 * Theme dependencies.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// Set up the <head> element.
		require_once get_theme_file_path( '/includes/head/class-head.php' );

		// Set up Scema attributes for the <body> element.
		require_once get_theme_file_path( '/includes/template-tags/class-body-schema.php' );

		// Post type functionality.
		require_once get_theme_file_path( '/includes/post-types/class-post-types.php' );

		// Get template tags.
		require_once get_theme_file_path( '/includes/template-tags/template-tags.php' );

		// Get template filters.
		include get_theme_file_path( '/includes/filters/class-template-filters.php' );

		// Blog navigation.
		if ( ! is_singular() ) {
			require get_theme_file_path( '/template-parts/navigation/class-blog-nav.php' );
		}

	}

	/**
	 * Footer scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function footer_scripts() {

		$scripts = '<script>';

		$scripts .= 'jQuery(window).load(function(){jQuery(".loader").fadeOut(350);});';

		$scripts .='jQuery(document).ready(function () {
			jQuery(".menu-open").click(function () {
				jQuery(".main-nav-menu").addClass("open");
				jQuery(".menu-open, .menu-close").attr("aria-expanded", function (i, attr) {
					return attr == "true" ? "false" : "true"
				});
			});
			jQuery(".menu-close").click(function () {
				jQuery(".main-nav-menu").removeClass("open");
				jQuery(".menu-open, .menu-close").attr("aria-expanded", function (i, attr) {
					return attr == "true" ? "false" : "true"
				});
			});
		});';

		$scripts.= 'jQuery( "a[href*=\'#\']:not([href=\'#\'])" ).click( function() {
		if ( location.pathname.replace(/^\//, "" ) == this.pathname.replace( /^\//, "" ) && location.hostname == this.hostname ) {
		var target = jQuery(this.hash);
		target = target.length ? target : jQuery( "[name=\' + this.hash.slice(1) + \']" );
			if ( target.length ) {
			jQuery( "html, body" ).animate({
				scrollTop: target.offset().top
			}, 500);
			return false;
			}
		}
		});';

		$scripts .= 'jQuery(document).ready( function($) {';

		if ( is_singular( 'films' ) ) {
			$scripts .= '$(".single-film-video").fitVids();';
		} elseif ( is_singular( 'television' ) ) {
			$scripts .= '$(".single-television-video").fitVids();';
		}

		$scripts .= '});';

		$scripts .= '</script>';

		echo $scripts;

	}

}

/**
 * Gets the instance of the Functions class.
 *
 * This function is useful for quickly grabbing data
 * used throughout the theme.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function mpsf_theme() {

	$mpsf_theme = Functions::get_instance();

	return $mpsf_theme;

}

// Run the Functions class.
mpsf_theme();