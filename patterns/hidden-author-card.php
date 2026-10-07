<?php
/**
 * Title: Author card
 * Slug: bubbledew/hidden-author-card
 * Inserter: no
 * Description: Avatar, "Written by" line, author name and biography in a card under a post.
 * Viewport Width: 800
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Author card"},"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","right":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m"},"blockGap":"var:preset|spacing|m","margin":{"top":"var:preset|spacing|xl"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group is-style-card" style="margin-top:var(--wp--preset--spacing--xl);padding-top:var(--wp--preset--spacing--m);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)"><!-- wp:avatar {"size":64,"isLink":true} /-->

<!-- wp:group {"metadata":{"name":"Author details"},"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","textTransform":"uppercase","letterSpacing":"0.08em"}},"textColor":"contrast-dark","fontSize":"xs"} -->
<p class="has-contrast-dark-color has-text-color has-xs-font-size" style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( 'Written by', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:post-author-name {"isLink":true,"style":{"typography":{"fontWeight":"700"}},"fontSize":"l","fontFamily":"heading"} /-->

<!-- wp:post-author-biography {"fontSize":"s"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
