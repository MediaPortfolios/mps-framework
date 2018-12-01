<?php
/**
 * Contact page HTML output.
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
		<?php do_action( 'mpsf_before_article' );
		$contact_info = get_field( 'mpsf_contact_info' );
		if ( $contact_info ) {
			$title_class = '';
		} else {
			$title_class = '';
		} ?>
        <article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title ' . $title_class . '">', '</h1>' ); ?>
            </header>
            <div class="entry-content" itemprop="articleBody">
				<?php do_action( 'mpsf_before_content' ); ?>
				<div class="info-page-content">
					<?php if ( $contact_info ) { echo get_field( 'mpsf_contact_info' ); } ?>
					<?php if ( have_rows( 'mpsf_agency' ) ) :  while ( have_rows( 'mpsf_agency' ) ) : the_row(); ?>
					<div class="agency-content">
						<h3><span><?php echo get_sub_field( 'mpsf_agency_name' ); ?></span></h3>
						<?php if ( have_rows( 'mpsf_agents' ) ) : ?>
						<ul class="agents-list">
							<?php while ( have_rows( 'mpsf_agents' ) ) : the_row();
							$name  = get_sub_field( 'mpsf_agent_name' );
							$dept  = get_sub_field( 'mpsf_agent_department' );
							$phone = get_sub_field( 'mpsf_agent_phone' );
							$email = get_sub_field( 'mpsf_agent_email' ); ?>
							<li>
								<span class="agent agent-department"><?php echo $dept; ?></span> | <span class="agent agent-name"><?php echo $name; ?></span>
								<br /><a class="agent-email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
								<br /><a class="agent-tel" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
						<?php if ( get_sub_field( 'mpsf_agency_info' ) ) { ?>
						<div class="agency-info">
							<div class="agency-info-image">
								<?php $image  = get_sub_field( 'mpsf_agency_logo' );
								if ( ! empty( $image ) ) { ?>
									<img class="agency-logo" src="<?php echo $image; ?>" alt="<?php echo get_sub_field( 'mpsf_agency_name' ); ?>" />
								<?php } ?>
							</div>
							<div class="agency-info-content">
								<?php echo get_sub_field( 'mpsf_agency_info' ); ?>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php endwhile; endif; ?>
					<div class="resume-link">
						<?php the_field( 'mpsf_resume_notice' ); ?>
						<?php
						$type = get_field( 'mpsf_resume_type' );
						$link = get_field( 'mpsf_resume_link' );
						$file = get_field( 'mpsf_resume_file' );
						if ( 'url' == $type ) {
							$url   = $link;
							$title = __( 'Download Resume', 'mpsf' );
						} elseif ( 'file' == $type ) {
							$url   = $file['url'];
							$title = __( 'Download Resume', 'mpsf' );
						} ?>
						<p><a class="button resume-link-button tooltip" href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a></p>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php do_action( 'mpsf_after_content' ); ?>
            </div><!-- entry-content -->
        </article>
        <?php do_action( 'mpsf_after_article' ); ?>
    <?php endwhile; endif; ?>
	</main>
	<?php do_action( 'mpsf_after_main' ); ?>