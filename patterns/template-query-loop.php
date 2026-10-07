<?php
/**
 * Title: Posts list
 * Slug: bubbledew/template-query-loop
 * Categories: query, posts
 * Block Types: core/query
 * Description: Post cards with a category badge, featured image, title, excerpt and meta, followed by pagination.
 * Viewport Width: 1280
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"layout":{"type":"constrained"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|xl"}},"layout":{"type":"default"}} -->
<!-- wp:group {"metadata":{"name":"Post card"},"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|l","right":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m"},"blockGap":"var:preset|spacing|s"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)"><!-- wp:post-terms {"term":"category","className":"is-style-name-tag"} /-->

<!-- wp:post-featured-image {"aspectRatio":"16/9","className":"is-style-pebble"} /-->

<!-- wp:post-title {"isLink":true,"fontSize":"xl"} /-->

<!-- wp:post-excerpt {"moreText":"<?php esc_attr_e( 'Keep reading', 'bubbledew' ); ?>","showMoreOnNewLine":true} /-->

<!-- wp:group {"metadata":{"name":"Post meta"},"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"textColor":"contrast-dark","fontSize":"xs","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-contrast-dark-color has-text-color has-xs-font-size"><!-- wp:post-date {"isLink":true} /-->

<!-- wp:post-comments-link {"className":"dot-before"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:group {"metadata":{"name":"Pagination"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--l)"><!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:group -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p><?php echo esc_html_x( 'No posts were found.', 'Message shown when a query returns nothing.', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
