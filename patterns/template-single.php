<?php
/**
 * Title: Single post
 * Slug: bubbledew/template-single
 * Categories: posts
 * Inserter: no
 * Description: Category pills, title, meta row, featured image, content and tags for a single post.
 * Viewport Width: 1280
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"tagName":"article","metadata":{"name":"Post"},"className":"bubbledew-single","style":{"spacing":{"blockGap":"var:preset|spacing|m"}},"layout":{"type":"constrained"}} -->
<article class="wp-block-group bubbledew-single"><!-- wp:group {"metadata":{"name":"Post header"},"style":{"spacing":{"blockGap":"var:preset|spacing|s"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category","className":"is-style-pills"} /-->

<!-- wp:post-title {"level":1} /-->

<!-- wp:group {"metadata":{"name":"Post meta"},"style":{"spacing":{"blockGap":"var:preset|spacing|xs"},"typography":{"fontWeight":"700"}},"textColor":"contrast-dark","fontSize":"xs","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-contrast-dark-color has-text-color has-xs-font-size" style="font-weight:700"><!-- wp:post-author-name {"isLink":true} /-->

<!-- wp:post-date {"isLink":true,"className":"dot-before"} /-->

<!-- wp:post-comments-link {"className":"dot-before"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:post-featured-image {"aspectRatio":"16/9","className":"is-style-pebble"} /-->

<!-- wp:post-content {"layout":{"type":"constrained"}} /-->

<!-- wp:post-terms {"term":"post_tag","prefix":"<?php esc_attr_e( 'Tagged', 'bubbledew' ); ?> ","className":"is-style-pills","style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}}} /--></article>
<!-- /wp:group -->
