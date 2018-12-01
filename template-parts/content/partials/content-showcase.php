<?php
/**
 * Front page HTML output.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

// namespace MPS_Framework;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div id="content" class="site-content global-wrapper page-wrapper">
    <?php do_action( 'mpsf_before_main' ); ?>
    <main class="main" role="main" itemscope itemprop="mainContentOfPage">
        <?php // Check for the Advanced Custom Fields plugin.
        if ( class_exists( 'acf' ) ) :
            $heading = get_field( 'mpsf_showcase_heading', 'option' );
            $posts   = get_field( 'mpsf_showcase_number', 'option' );
            if ( $heading && is_front_page() ) {
                $heading = sprintf( '<h2 class="entry-title">%1s</h2>', esc_html( $heading ) );
            } elseif ( $heading ) {
                $heading = sprintf( '<h1 class="entry-title">%1s</h1>', esc_html( $heading ) );
            } elseif ( is_front_page() ) {
                $heading = sprintf( '<h2 class="entry-title">%1s</h2>', esc_html__( 'Project Showcase', 'mpsf' ) );
            } else {
                $heading = sprintf( '<h1 class="entry-title">%1s</h1>', esc_html__( 'Project Showcase', 'mpsf' ) );
            } ?>
            <header class="entry-header">
                <?php echo $heading; ?>
            </header>
            <?php $projects = get_field( 'mpsf_showcase_projects', 'option' );
            if ( $projects ) : ?>
            <ul class="video-grid showcase">
                <?php foreach ( $projects as $project ) :
                $id = $project['mpsf_showcase_project'];
                // Films variables.
                if ( 'films' == get_post_type( $id ) ) {
                    $type       = 'film';
                    $flag       = __( 'Film', 'mpsf' );
                    $heading    = get_the_title( $id );
                    $director   = get_field( 'mpsf_project_director', $id );
                    $image      = get_field( 'mpsf_project_image', $id );
                    $vimeo      = get_field( 'mpsf_project_vimeo_id', $id );
                    $size       = 'video-medium';
                    $srcset     = wp_get_attachment_image_srcset( $image['ID'], $size );
                    $width      = $image['sizes'][ $size . '-width' ];
                    $height     = $image['sizes'][ $size . '-height' ];
                    $gallery    = get_field( 'mpsf_project_gallery' );
                    $vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $vimeo ) );

                    if ( $image ) {
                        $thumb = $image['sizes'][ $size ];
                    } elseif ( $vimeo_data ) {
                        $thumb = $vimeo_data->thumbnail_url;
                    } else {
                        $thumb = get_parent_theme_file_uri( '/assets/images/video-placeholder.jpg' );
                    }

                    if ( ! $vimeo_data ) {
                        $vimeo = '';
                    } else {
                        $vimeo = $vimeo_data->video_id;
                    }

                    if ( $heading && $director ) {
                        $caption = $heading . '<br />Directed by ' . $director;
                    } elseif ( $heading ) {
                        $caption = $heading;
                    } else {
                        $caption = '';
                    }

                // TV Shows variables.
                } elseif ( 'television' == get_post_type( $id ) ) {
                    $type = 'television';
                    $flag       = __( 'TV Show', 'mpsf' );
                    $client     = get_field( 'mpsf_television_client', $id );
                    $title      = get_field( 'mpsf_television_title', $id );
                    $director   = get_field( 'mpsf_television_director', $id );
                    $image      = get_field( 'mpsf_television_thumbnail', $id );
                    $vimeo      = get_field( 'mpsf_television_vimeo_id', $id );
                    $size       = 'video-medium';
                    $thumb      = $image['sizes'][ $size ];
                    $srcset     = wp_get_attachment_image_srcset( $image['ID'], $size );
                    $width      = $image['sizes'][ $size . '-width' ];
                    $height     = $image['sizes'][ $size . '-height' ];
                    $vimeo_dns  = checkdnsrr( 'vimeo.com' );
                    if ( $vimeo_dns ) {
                        $vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $vimeo ) );
                    } else {
                        $vimeo_data = null;
                    }

                    if ( $image ) {
                        $thumb = $image['sizes'][ $size ];
                    } elseif ( $vimeo_data ) {
                        $thumb = $vimeo_data->thumbnail_url;
                    } else {
                        $thumb = get_parent_theme_file_uri( '/assets/images/video-placeholder.jpg' );
                    }

                    if ( ! $vimeo_data ) {
                        $vimeo = null;
                    } else {
                        $vimeo = $vimeo_data->video_id;
                    }

                    if ( $title && $director ) {
                        $caption = $client . '<br />' . $title . '<br />Dirercted by ' . $director;
                    } elseif ( $title ) {
                        $caption = $client . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;' . $title;
                    } elseif ( $director ) {
                        $caption = $client . '<br />Dirercted by ' . $director;
                    } else {
                        $caption = $client . $title;
                    }

                    if ( $title ) {
                        $heading = $client . ' | ' . $title;
                    } else {
                        $heading = $client;
                    }
                } ?>
                <li id="<?php echo 'project-' . $id; ?>" class="<?php echo $type; ?>">
                    <figure class="">
                        <a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank">
                            <span class="showcase-flag"><?php echo $flag; ?></span>
                            <img class="" src="<?php echo $thumb; ?>" />
                            <figcaption>
                                <h3><?php echo $heading; ?></h3>
                            </figcaption>
                        </a>
                    </figure>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else : ?>
            <?php endif; ?>
            <?php if ( is_front_page() ) : ?>
            <div class="view-all showcase">
                <?php get_template_part( 'template-parts/navigation/partials/navigation', 'main' ); ?>
            </div>
            <?php endif; ?>
        <?php else : ?>
            <p><?php _e( 'No projects available at this time. If you are a site administrator please activare the Advanced Custom Fields Pro plugin.', 'mpsf' ); ?></p>
        <?php endif; ?>
    </main>
    <?php do_action( 'mpsf_after_main' ); ?>
</div>