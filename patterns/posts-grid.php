<?php
/**
 * Title: Posts grid
 * Slug: bubbledew/posts-grid
 * Categories: query, posts
 * Block Types: core/query
 * Description: The latest posts as two columns of tilted cards with name-tag badges, pebble images, titles and dates.
 * Viewport Width: 1080
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:query {"queryId":31,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[]},"metadata":{"name":"Posts grid"},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|l"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<!-- wp:group {"metadata":{"name":"Post card"},"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|l","right":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m"},"blockGap":"var:preset|spacing|s"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)"><!-- wp:post-terms {"term":"category","className":"is-style-name-tag"} /-->

<!-- wp:post-featured-image {"aspectRatio":"4/3","className":"is-style-pebble"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"l"} /-->

<!-- wp:post-date {"isLink":true,"textColor":"contrast-dark","fontSize":"xs"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p><?php echo esc_html_x( 'No posts were found.', 'Message shown when a query returns nothing.', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
