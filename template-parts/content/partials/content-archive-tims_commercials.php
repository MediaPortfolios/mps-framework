<?php
/**
 * TV Shows archive HTML output.
 *
 * @package WordPress
 * @subpackage Bloomosphere
 * @since Bloomosphere 1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( have_posts() ) : ?>
<article class="global-wrapper" role="index">
    <header class="entry-header">
        <?php echo sprintf( '<h1 class="entry-title">%1s</h1>', esc_html__( 'TV Shows', 'mpsf' ) ); ?>
    </header>
    <ul class="video-grid television"><?php while ( have_posts() ) : the_post();

    $client     = get_field( 'mpsf_television_client' );
    $title      = get_field( 'mpsf_television_title' );
    $director   = get_field( 'mpsf_television_director' );
    $image      = get_field( 'mpsf_television_thumbnail' );
    $vimeo      = get_field( 'mpsf_television_vimeo_id' );
    $size       = 'video-medium';
    $thumb      = $image['sizes'][ $size ];
    $srcset     = wp_get_attachment_image_srcset( $image['ID'], $size );
    $width      = $image['sizes'][ $size . '-width' ];
    $height     = $image['sizes'][ $size . '-height' ];
    $vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $vimeo ) );

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
    } ?>
        <li id="<?php echo 'television-' . get_the_ID(); ?>" class="television-video<?php if ( $director ) { echo ' television-has-director'; } ?>">
            <figure><a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank">
                <img src="<?php echo $thumb; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                <figcaption>
                    <?php echo sprintf( '<h3 class="archives-image-title">%1s</h3>', $heading ); ?>
                </figcaption>
            </a></figure>
        </li>
        <?php endwhile; ?>
    </ul>
</article>
<?php endif; ?>