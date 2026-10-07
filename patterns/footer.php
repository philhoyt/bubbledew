<?php
/**
 * Title: Footer
 * Slug: bubbledew/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Site footer with logo, copyright, site title, and navigation.
 * Viewport Width: 1280
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Footer band"},"className":"bubbledew-band bubbledew-band--footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|l"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group bubbledew-band bubbledew-band--footer" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l)"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:site-logo /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"s"} -->
<p class="has-s-font-size">©</p>
<!-- /wp:paragraph -->

<!-- wp:site-title {"level":0,"isLink":false} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:navigation {"className":"bubbledew-pills","overlayMenu":"never"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
