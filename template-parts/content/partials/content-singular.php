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
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'mpsf_before_article' ); ?>
        <article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>
            <div class="entry-content" itemprop="articleBody">
                <?php do_action( 'mpsf_before_content' ); ?>
                <?php the_content(); ?>
                <?php do_action( 'mpsf_after_content' ); ?>
            </div><!-- entry-content -->
        </article>
        <?php do_action( 'mpsf_after_article' ); ?>
    <?php endwhile; endif; ?>
	</main>
	<?php do_action( 'mpsf_after_main' ); ?>