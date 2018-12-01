<?php
/**
 * Singular HTML output.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */
namespace MPS_Framework;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

    do_action( 'mpsf_before_main' ); ?>
    
	<main class="main" role="main" itemscope itemprop="mainContentOfPage">
		<?php do_action( 'mpsf_before_article' ); ?>
        <article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
            <header class="entry-header">
                <?php echo sprintf( '<h1 class="entry-title">%1s</h1>', esc_html__( 'Nothing Found' ) ); ?>
            </header>
            <div class="entry-content" itemprop="articleBody">
            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mpsf' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
            <?php else : ?>
                <p><?php _e( 'No content available at this time. Maybe try searching&hellip;', 'mpsf' ); ?></p>
            <?php
                get_search_form();
            endif; ?>
            </div><!-- entry-content -->
        </article>
		<?php do_action( 'mpsf_after_article' ); ?>
	</main>
	<?php do_action( 'mpsf_after_main' ); ?>