<?php
/**
 * Begin content wrapper.
 *
 * @package WordPress
 * @subpackage Media_Portfolios_Framework
 * @since 1.0.0
 */
namespace MPS_Framework;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$content_wrapper_class = apply_filters( 'mpsf_content_wrapper_class', '' );

?>
<div id="content" class="site-content global-wrapper page-wrapper <?php echo $content_wrapper_class; ?>">