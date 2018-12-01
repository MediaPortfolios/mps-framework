<?php
/**
 * Post comments form status.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since  1.0.0
 */

namespace MPS_Framework;

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Post comments form status.
 */
class Media_Portfolios_Framework_Comments_Status {

    /**
	 * Constructor magic method.
	 */
    public function __construct() {

        // No comments.
        $this->none();

        // Comments closed.
        $this->closed();

    }

    /**
     * No comments.
     * 
     * @since  1.0.0
     */
    public static function none() {

        $comments_none = apply_filters( 'mpsf_comments_none', sprintf( '<p class="comments-none-closed"><span class="comments-none">%1s</span></p>', __( 'Be the first to comment!', 'mpsf' ) ) );

        return $comments_none;

    }

    /**
     * Comments closed.
     * 
     * @since  1.0.0
     */
    public static function closed() {

        $comments_closed = apply_filters( 'mpsf_comments_closed', sprintf( '<p class="comments-none-closed"><span class="comments-closed">%1s</span>.</p>', __( 'Comments are closed for this post', 'mpsf' ) ) );

        return $comments_closed;

    }

}

$controlled_chaos_comments_status = new Media_Portfolios_Framework_Comments_Status;